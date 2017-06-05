<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
session_start();

class C_logo extends CI_Controller {

    public function  __construct()
    {
		parent::__construct();
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
		$data['konten_logo'] = $this->m_logo->getLogo();
		$this->load->view('v_logo', $data);
	}
}
?>