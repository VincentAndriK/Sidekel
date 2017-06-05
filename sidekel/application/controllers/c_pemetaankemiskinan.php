<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//session_start();

class C_pemetaankemiskinan extends CI_Controller {

    function  __construct()
    {
		parent::__construct();
        /* $this->load->helper('form'); 
		$this->load->model('m_user'); 
		$this->load->model('m_sensus'); */
		$this->load->model('m_pemetaankemiskinan');	   
		$this->load->model('statistik/m_kemiskinan');
		$this->load->model('m_logo'); 
		$this->load->model('m_peta');
		$this->load->model('m_keluarga'); 
		$this->load->model('m_cetak_kk');
    }
	   
	
	function index()
    {				
		$data['page_title'] = 'Pemetaan Kemiskinan';	
		$data['peta'] = $this->m_peta->getPeta();
		
		$data['batas_wilayah'] = $this->m_peta->getBatasWilayah();
		$data['konten_logo'] = $this->m_logo->getLogo();
		$data['jumlah_penduduk'] = $this->m_pemetaankemiskinan->getTotalPenduduk();
		$data['jumlah_status_tidakdiketahui'] = $this->m_kemiskinan->getKelasSosial0();
		$data['jumlah_status_kaya'] = $this->m_kemiskinan->getKelasSosial1();
		$data['jumlah_status_sedang'] = $this->m_kemiskinan->getKelasSosial2();
		$data['jumlah_status_miskin'] = $this->m_kemiskinan->getKelasSosial3();
		$data['jumlah_status_sangatmiskin'] = $this->m_kemiskinan->getKelasSosial4();
		$data['rumah'] = json_encode($this->m_keluarga->getAll());
		$data['marker'] = json_encode($this->m_keluarga->getAllMarker());
		$data['count'] = json_encode($this->m_keluarga->getCount());
		$data['status'] = json_encode($this->m_keluarga->getStatus());
		$data['anak'] = json_encode($this->m_keluarga->getAnak());
		$data['anakMiskin'] = $this->m_keluarga->getAnakMiskin();
		$data['anakMiskinlala'] = $this->m_keluarga->getAnakMiskinlala();
		$data['total'] = $data['anakMiskin']+$data['anakMiskinlala'];
		$data['menu'] = $this->load->view('menu/v_indikatorkesejahteraan', $data, TRUE);
		$data['content'] = $this->load->view('v_pemetaankemiskinan', $data, TRUE);
		//echo  $data['rumah'];
		//echo $data['anak'];
		/*  */if($this->session->userdata('logged_in'))
		{
			$this->load->view('utama', $data);
		}else
			redirect('c_login', 'refresh'); 
    }
}
?>