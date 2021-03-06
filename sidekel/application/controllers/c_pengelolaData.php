<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//session_start();

class C_pengelolaData extends CI_Controller {

    function  __construct()
    {
		parent::__construct();
        $this->load->helper('form'); 
		$this->load->model('m_user'); 
		$this->load->model('m_kalkulasi');     
		$this->load->model('statistik/m_kk');	
		$this->load->model('m_logo');		
		$this->load->model('m_surat');		
		$this->load->model('m_kelahiran');		
		$this->load->model('m_meninggal');		
		$this->load->model('m_bsm');		
		$this->load->model('m_kondisi_kehamilan');		
		$this->load->model('m_gizi_buruk');		
    }
	   
	
	function index()
    {				
		$data['page_title'] = 'Pengelola Data';	
		$data['konten_logo'] = $this->m_logo->getLogo();
		$data['jumlah_penduduk'] = $this->m_kalkulasi->getTotalPenduduk();
		$data['jumlah_penduduk_laki'] = $this->m_kalkulasi->getTotalPendudukByKelamin('1');
		$data['jumlah_penduduk_perempuan'] = $this->m_kalkulasi->getTotalPendudukByKelamin('2');
		$data['menu'] = $this->load->view('menu/v_pengelolaData', $data, TRUE);
		
		$data['jumlah_kk_perempuan'] = $this->m_kk->getKkPerempuan();
		$data['jumlah_kk_laki'] = $this->m_kk->getKkLaki();	

		
		$data['surat'] = $this->m_surat->total_surat();		
		$data['kelahiran'] = $this->m_kelahiran->total_kelahiran();		
		$data['meninggal'] = $this->m_meninggal->total_meninggal();		
		$data['bsm'] = $this->m_bsm->total_bsm();		
		$data['kehamilan'] = $this->m_kondisi_kehamilan->total_kehamilan();		
		$data['gizi_buruk'] = $this->m_gizi_buruk->total_gizi_buruk();		
		
		$data['content'] = $this->load->view('v_pengelolaData', $data, TRUE);
		if($this->session->userdata('logged_in'))
		{
			$this->load->view('utama', $data);
		}else
			redirect('c_login', 'refresh');       
    }
}
?>