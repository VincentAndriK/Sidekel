<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
session_start();

class C_jurnal_warga extends CI_Controller {

    public function  __construct()
    {
		parent::__construct();		
        $this->load->helper('form');
		$this->load->helper('captcha');
		$this->load->model('m_jurnal_warga');
		$this->load->model('m_pages');
		$this->load->model('m_logo');
		$this->load->model('m_desa');
		$this->load->model('m_sosmed');
		$this->load->model('sso/m_sso');
    }
	
	function index()
    {
		$data['sosmed'] = $this->m_sosmed->getRow(1);
		$data['desa'] = $this->m_desa->getDesa();
		// loading captcha helper
		
		//validating form fields
		
		$this->form_validation->set_rules('userCaptcha', 'Captcha', 'required|callback_check_captcha');
		$userCaptcha = $this->input->post('userCaptcha');
		if ($this->form_validation->run() == false){
		  // numeric random number for captcha
		  $random_number = substr(number_format(time() * rand(),0,'',''),0,6);
		  // setting up captcha config
		  $vals = array(
				 'word' => $random_number,
				 'img_path' => './captcha/',
				 'img_url' => base_url().'captcha/',
				 'img_width' => 100,
				 'img_height' => 32,
				 'expiration' => 7200
				);
		  $data['captcha'] = create_captcha($vals);
		  $this->session->set_userdata('captchaWord',$data['captcha']['word']);
		
		//$data['data_sso'] = $this->m_sso->getSso(1);	
		$data['konten_logo'] = $this->m_logo->getLogo();
		$data['logo'] = $this->load->view('v_logo', $data, TRUE);
		$data['menu'] = $this->load->view('v_navbar', $data, TRUE);
		$data['content'] = $this->load->view('web/jurnal_warga',$data,TRUE);
		$temp['footer'] = $this->load->view('v_footer',$data,TRUE);
		$this->load->view('templateHome',$temp);
		}
		else {
		  // do your stuff here.
		  
		  $this->simpan_jurnal();
		  echo 'I m here clered all validations';
		}
	}
	
	  public function check_captcha($str){
		$word = $this->session->userdata('captchaWord');
		if(strcmp(strtoupper($str),strtoupper($word)) == 0){
		  return true;
		}
		else{
		  $this->session->set_flashdata('error', 'Kode verivikasi yang anda masukan salah !');
		  return false;
		}
	  }


	function simpan_jurnal() {
		$penulis = $this->input->post('penulis', TRUE);
		$judul = $this->input->post('judul', TRUE);
		$gambar = $this->input->post('gambar', TRUE);
		$berita = $this->input->post('isi', TRUE);
		$user = $this->input->post('id_pengguna', TRUE);
		 
		$this->form_validation->set_rules('penulis', 'Penulis Berita', 'required');
		$this->form_validation->set_rules('judul', 'Judul Berita', 'required');

		
		//UPLOAD GAMBAR BERITA
		$newfile = $this->input->post('image-data', TRUE);
		
		define('UPLOAD_DIR', 'uploads/berita/');
		$img = $newfile;
		$img = str_replace('data:image/jpeg;base64,', '', $img);
		$img = str_replace(' ', '+', $img);
		$data = base64_decode($img);		
		
		
		$namaFile = sha1(date("Y-m-d H:i:s").'ajengtindakpundi?');
		$file = UPLOAD_DIR . $namaFile . '.jpg';
		$success = file_put_contents($file, $data);
		
		/* $namaFile = str_replace(' ', '+', $judul);
		$file = UPLOAD_DIR . $namaFile . '.jpg';
		$success = file_put_contents($file, $data);
		
		$path_gambar_berita = $file; */
		$path_gambar_berita = $file;
		$this->createThumbnail($path_gambar_berita);
		
		if ($this->form_validation->run() == TRUE)
		{
			$data = array(
				'id_pengguna' => 0,
				'gambar' => $path_gambar_berita,
				'thumb' => UPLOAD_DIR . $namaFile . '_thumb.jpg',
				'penulis' => $penulis,
				'judul_berita' => $judul,
				'isi_berita' => $berita,
				'is_publish' => 'Tidak',
				'is_masyarakat' => 'Ya'
			);
	
			$this->m_jurnal_warga->insertJurnalWarga($data);
			$url='web/c_home/get_detail_berita/';
			$dataPages = array(
				'url' => $url.mysql_insert_id(),
				'title' => $judul,
				'content' => $berita	
			);
			$this->m_pages->insertPages($dataPages);
			$this->session->set_flashdata('message', 'Berita berhasil ditambahkan dan akan ditampilkan setelah mendapat persetujuan !');
			redirect('web/c_jurnal_warga','refresh');
        }
		else $this->index();
    }
	
		
	function createThumbnail($path)
    {
        $config['image_library']    = "gd2";    
        $config['source_image']     = $path;   
        $config['create_thumb']     = TRUE;      
        $config['maintain_ratio']   = TRUE;      
        $config['width'] = "100";      
        $config['height'] = "100";
        $this->load->library('image_lib',$config);
        if(!$this->image_lib->resize())
        {
            echo $this->image_lib->display_errors();
        }      

    }
}
?>