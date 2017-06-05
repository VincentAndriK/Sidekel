<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//session_start();

class C_grafik_pemetaankemiskinan extends CI_Controller {

    function  __construct()
    {
		parent::__construct();
        $this->load->helper('form'); 
		$this->load->model('m_user'); 
		$this->load->model('m_sensus'); 
		$this->load->model('m_pemetaankemiskinan');     
		$this->load->model('statistik/m_kemiskinan');
		$this->load->model('m_logo'); 
		$this->load->model('m_keluarga'); 
    }
	   
	
	function index()
    {				
		$data['page_title'] = 'Grafik Pemetaan Kemiskinan';	
		$data['konten_logo'] = $this->m_logo->getLogo();
		$data['sensus'] = $this->m_sensus->get_sensus();
		$data['jumlah_penduduk'] = $this->m_pemetaankemiskinan->getTotalPenduduk();
		$data['jumlah_penduduk_status_tidakdiketahui'] = $this->m_pemetaankemiskinan->getTotalPendudukByKelasSosial('0');
		$data['jumlah_penduduk_status_kaya'] = $this->m_pemetaankemiskinan->getTotalPendudukByKelasSosial('1');
		$data['jumlah_penduduk_status_sedang'] = $this->m_pemetaankemiskinan->getTotalPendudukByKelasSosial('2');
		$data['jumlah_penduduk_status_miskin'] = $this->m_pemetaankemiskinan->getTotalPendudukByKelasSosial('3');
		$data['jumlah_penduduk_status_sangatmiskin'] = $this->m_pemetaankemiskinan->getTotalPendudukByKelasSosial('4');
		$data['menu'] = $this->load->view('menu/v_indikatorkesejahteraan', $data, TRUE);
		
		$data['jumlah_status_tidakdiketahui'] = $this->m_kemiskinan->getKelasSosial0();
		$data['jumlah_status_kaya'] = $this->m_kemiskinan->getKelasSosial1();
		$data['jumlah_status_sedang'] = $this->m_kemiskinan->getKelasSosial2();
		$data['jumlah_status_miskin'] = $this->m_kemiskinan->getKelasSosial3();
		$data['jumlah_status_sangatmiskin'] = $this->m_kemiskinan->getKelasSosial4();
		
		$data['content'] = $this->load->view('v_grafik_pemetaankemiskinan', $data, TRUE);
		if($this->session->userdata('logged_in'))
		{
			$this->load->view('utama', $data);
		}else
			redirect('c_login', 'refresh');     
	}			
}
?>