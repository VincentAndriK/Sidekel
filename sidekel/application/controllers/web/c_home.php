<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
session_start();

class C_home extends CI_Controller {

    public function  __construct()
    {
		parent::__construct();
		$this->load->model('m_berita');
		$this->load->model('m_artikel');
		$this->load->model('m_logo');
		$this->load->model('m_desa');
		$this->load->model('m_sosmed');
		$this->load->model('m_slider_beranda');
		$this->load->helper('text');
		$this->load->model('sso/m_sso');
		$this->load->model('m_kalkulasi'); 
		$this->load->model('statistik/m_kk');
		$this->load->model('statistik/m_potensi');
		$this->load->model('m_galeri');
    }
	
	function index()
    {
		$data['data_sso'] = $this->m_sso->getSso(1);
		$data['sosmed'] = $this->m_sosmed->getRow(1);
		$data['desa'] = $this->m_desa->getDesa();
		
		/* $data['berita'] = $this->m_berita->get_recent_berita();
		$data['menu'] = $this->load->view('web/menu/home', $data, TRUE);		
		$temp['content'] = $this->load->view('web/home',$data,TRUE);
		$this->load->view('templateHome',$temp); */
		
		$data['konten_logo'] = $this->m_logo->getLogo();
		$data['slider_row'] = $this->m_slider_beranda->getSliderBerandaRow();
		$data['slider_beranda'] = $this->m_slider_beranda->getSliderBeranda();
		
		//$data['berita'] = $this->m_berita->get_recent_berita();
		$data['berita_gbr'] = $this->m_berita->get_gbr_berita();
		
		$data['berita'] = $this->m_berita->get_recent_berita_all();
		$data['berita_warga'] = $this->m_berita->get_recent_berita_warga();
		$data['jurnal_warga'] = $this->m_berita->get_recent_jurnal_warga();
		$data['artikel'] = $this->m_artikel->getRecentArtikel();
		
		$data['jumlah_penduduk'] = $this->m_kalkulasi->getTotalPenduduk();
		$data['jumlah_penduduk_laki'] = $this->m_kalkulasi->getTotalPendudukByKelamin('1');
		$data['jumlah_penduduk_perempuan'] = $this->m_kalkulasi->getTotalPendudukByKelamin('2');
		$data['jumlah_kk_perempuan'] = $this->m_kk->getKkPerempuan();
		$data['jumlah_kk_laki'] = $this->m_kk->getKkLaki();	
		
		$data['grafik_kategori'] 	= $this->m_potensi->getDataKategori();
		$data['grafik_detil'] 		= $this->m_potensi->getDataDetil();
		////////////////////////GALERI////////////////////////
		$array = array(
			'foto','video'
		);
		$data['galeri'] = $array;
		$data['konten_galeri'] = $this->m_galeri->getAllGaleriBeranda();
		////////////////////////GALERI////////////////////////
		$data['logo'] = $this->load->view('v_logo', $data, TRUE);
		$data['menu'] = $this->load->view('v_navbar', $data, TRUE);
		$data['slider'] = $this->load->view('v_slider', $data, TRUE);
		$data['content'] = $this->load->view('web/home',$data,TRUE);
		$temp['footer'] = $this->load->view('v_footer',$data,TRUE);
		$this->load->view('templateHome',$temp);
		
	}
	
	function get_detail_berita($id){
		$data['data_sso'] = $this->m_sso->getSso(1);
		$data['sosmed'] = $this->m_sosmed->getRow(1);
		$data['desa'] = $this->m_desa->getDesa();
		$data['konten_logo'] = $this->m_logo->getLogo();
		/* $data['berita'] = $this->m_berita->getBeritaByIdberita($id);
		$data['menu'] = $this->load->view('web/menu/berita', $data, TRUE);		
		$temp['content'] = $this->load->view('web/detail_berita',$data,TRUE);
		$this->load->view('templateHome',$temp); */
		$data['berita'] = $this->m_berita->getBeritaByIdberita($id);
		$data['logo'] = $this->load->view('v_logo', $data, TRUE);
		$data['menu'] = $this->load->view('v_navbar', $data, TRUE);
		$data['content'] = $this->load->view('web/detail_berita',$data,TRUE);
		$temp['footer'] = $this->load->view('v_footer',$data,TRUE);
		$this->load->view('templateHome',$temp);
	}
	
	function get_detail_artikel($id){
		$data['data_sso'] = $this->m_sso->getSso(1);
		$data['konten_logo'] = $this->m_logo->getLogo();
		$data['sosmed'] = $this->m_sosmed->getRow(1);
		$data['desa'] = $this->m_desa->getDesa();
		$data['artikel'] = $this->m_artikel->getArtikelByIdArtikel($id);
		
		$data['logo'] = $this->load->view('v_logo', $data, TRUE);
		$data['menu'] = $this->load->view('v_navbar', $data, TRUE);
		$data['content'] = $this->load->view('web/detail_artikel',$data,TRUE);
		$temp['footer'] = $this->load->view('v_footer',$data,TRUE);
		$this->load->view('templateHome',$temp);
	}
}
?>