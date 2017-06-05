<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class C_statistik_pekerjaan extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('statistik/m_pekerjaan');
        $this->load->model('m_logo');
        $this->load->model('m_desa');
        $this->load->model('m_sosmed');
		$this->load->model('sso/m_sso');
    }
	
	function index()
    {
		$data['data_sso'] = $this->m_sso->getSso(1);
		$data['sosmed'] = $this->m_sosmed->getRow(1);
		$data['desa'] = $this->m_desa->getDesa();
		////////////////////////////////////////////////////////
		$pekerjaan[] = $this->m_pekerjaan->getDataPekerjaan();		  
		$json = json_encode($pekerjaan);	
		$json =	$this->m_pekerjaan->highchartJson($json);
		$data['json'] = $json;
		////////////////////////////////////////////////////////
		
		$data['result'] = $this->m_pekerjaan->getDataPekerjaanTable();		
		
		$data['jumlah'] = $this->m_pekerjaan->getJumlahPekerjaan(); 
		
		$data['konten_logo'] = $this->m_logo->getLogo();
		$data['logo'] = $this->load->view('v_logo', $data, TRUE);		
		$data['menu'] = $this->load->view('v_navbar', $data, TRUE);			
		$data['footer'] = $this->load->view('v_footer', $data, TRUE);	
		$data['statistik'] = $this->load->view('web/content/java_statistik/pekerjaan', $data, TRUE);
		$temp['content'] = $this->load->view('web/content/pekerjaan',$data,TRUE);
		
		$this->load->view('templateStatistik',$temp);
		
    }
}