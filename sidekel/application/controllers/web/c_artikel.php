<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
session_start();

class C_artikel extends CI_Controller {

    public function  __construct()
    {
		parent::__construct();
		$this->load->model('m_artikel');
		$this->load->model('m_logo');
		$this->load->model('m_desa');
		$this->load->model('m_sosmed');
		$this->load->helper('text');
		$this->load->library('pagination');
		$this->load->model('sso/m_sso');
    }
	
	function index()
    {
		$data['data_sso'] = $this->m_sso->getSso(1);
		$data['sosmed'] = $this->m_sosmed->getRow(1);
		$data['desa'] = $this->m_desa->getDesa();
		
    	$data['konten_logo'] = $this->m_logo->getLogo();
		$data['artikel'] = $this->m_artikel->getRowArtikel();
		
		//pagination
		$config['base_url'] =base_url().'/web/c_artikel/index';
		$config['total_rows'] = $this->m_artikel->getArtikelNumRow(); //$this->db->get('tbl_berita')->num_rows();
		$config['per_page'] = '5';
		$config['num_links'] = 3;
		$config['uri_segment'] = 4;
		$config['full_tag_open'] = '<ul class="pagination pagination-md">'; 
		$config['full_tag_close'] = '</ul>'; 
		$config['num_tag_open'] = '<li>'; 
		$config['num_tag_close'] = '</li>'; 
		$config['cur_tag_open'] = '<li class="active"><span>'; 
		$config['cur_tag_close'] = '<span class="sr-only">(current)</span></span></li>'; 
		$config['prev_tag_open'] = '<li>'; 
		$config['prev_tag_close'] = '</li>'; 
		$config['next_tag_open'] = '<li>'; 
		$config['next_tag_close'] = '</li>'; 
		$config['first_link'] = '&laquo;'; 
		$config['prev_link'] = '&lsaquo;'; 
		$config['last_link'] = '&raquo;'; 
		$config['next_link'] = '&rsaquo;'; 
		$config['first_tag_open'] = '<li>'; 
		$config['first_tag_close'] = '</li>'; 
		$config['last_tag_open'] = '<li>';
		$config['last_tag_close'] = '</li>';
		$this->pagination->initialize($config);        
		$pag = $this->db->get($this->m_artikel->getAllArtikel(), $config['per_page'], $this->uri->segment(4));  //$this->m_berita->berita_all( $config['per_page']); //      
		//$pag = $this->m_berita->berita_all( 6,4); //      
		$data['artikel'] = $pag->result();
		
		$data['logo'] = $this->load->view('v_logo', $data, TRUE);
		$data['menu'] = $this->load->view('v_navbar', $data, TRUE);
		$data['content'] = $this->load->view('web/artikel',$data,TRUE);
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