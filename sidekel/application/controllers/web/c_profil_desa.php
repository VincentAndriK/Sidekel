<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
session_start();

class C_profil_desa extends CI_Controller {

    public function  __construct()
    {
		parent::__construct();
		$this->load->model('m_sejarah');
		$this->load->model('m_visimisi');
		$this->load->model('m_demografi');
		$this->load->model('m_logo');
		$this->load->model('m_desa');
		$this->load->model('m_sosmed');
		$this->load->helper('text');
		$this->load->model('sso/m_sso');
    }
	
	function index()
    {
		$data['data_sso'] = $this->m_sso->getSso(1);	
		$data['sosmed'] = $this->m_sosmed->getRow(1);
		$data['desa'] = $this->m_desa->getDesa();
		$data['konten_logo'] = $this->m_logo->getLogo();
		
		$data['sejarah'] = $this->m_sejarah->getSejarahByIdsejarah('1');
		
		$data['demografi'] = $this->m_demografi->getDemografiByIddemografi('1');
		$data['penduduk'] = $this->m_demografi->getKependudukan();
		$data['keluarga'] = $this->m_demografi->getKeluarga();
		
		$data['visimisi'] = $this->m_visimisi->getVisimisiByIdvisimisi('1');
		
		$data['logo'] = $this->load->view('v_logo', $data, TRUE);
		$data['menu'] = $this->load->view('v_navbar', $data, TRUE);
		$data['content'] = $this->load->view('web/profil_desa',$data,TRUE);
		$temp['footer'] = $this->load->view('v_footer',$data,TRUE);
		$this->load->view('templateHome',$temp);
		
	}
}
?>