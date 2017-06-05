<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//session_start();

class C_pengelolaAset extends CI_Controller {

    function  __construct()
    {
		parent::__construct();
        $this->load->helper('form'); 
		$this->load->model('m_user'); 
        $this->load->model('m_peta');	
		$this->load->model('m_logo');		
		$this->load->model('aset/m_tanah');		
		$this->load->model('aset/m_bangunan');		
		$this->load->model('aset/m_aset');		
    }
	   
	
	function index()
    {		

		$data['peta'] = $this->m_peta->getPeta();
		$data['base_url']=$this->config->item('base_url');
		$data['page_title'] = 'Pengelola Aset';	
		$data['konten_logo'] = $this->m_logo->getLogo();
		$data['tanah'] = $this->m_tanah->getCount();
		$data['bangunan'] = $this->m_bangunan->getCount();
		$data['aset'] = $this->m_aset->getCount();
		
		$data['menu'] = $this->load->view('menu/v_pengelolaAset', $data, TRUE);
		
		
		
		$data['content'] = $this->load->view('aset/v_pengelolaAset', $data, TRUE);
		if($this->session->userdata('logged_in'))
		{
			$this->load->view('utama', $data);
		}else
			redirect('c_login', 'refresh');       
    }
	
	

}
?>