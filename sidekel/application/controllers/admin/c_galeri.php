<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class C_galeri extends CI_Controller {

    function  __construct()
    {
		parent::__construct();
		$session['hasil'] = $this->session->userdata('logged_in');
		$role = $session['hasil']->role;
		if($this->session->userdata('logged_in') AND $role == 'Administrator')
		{
			//Load flexigrid helper and library
			$this->load->helper('flexigrid_helper');
			$this->load->library('flexigrid');
			$this->load->helper('form');
			$this->load->helper('date');
			$this->load->model('m_galeri');			
		}else
			redirect('c_login/logout', 'refresh');

    }

    function index()    {
		$session['hasil'] = $this->session->userdata('logged_in');
		$role = $session['hasil']->role;
		if($this->session->userdata('logged_in') AND $role == 'Administrator')
		{
			$this->lists();
		}else
			redirect('c_login', 'refresh');
        	
    }

    function lists() {
        $colModel['id_galeri'] = array('No',30,TRUE,'center',0);
		$colModel['judul'] = array('Judul',130,TRUE,'center',2);
		$colModel['kategori'] = array('Kategori',130,TRUE,'center',2);
        $colModel['url'] = array('Url',250,TRUE,'center',2);
		//kurang penduduk
        $colModel['aksi'] = array('AKSI',60,FALSE,'center',0);
		
		//Populate flexigrid buttons..
        $buttons[] = array('Select All','check','btn');
		$buttons[] = array('separator');
        $buttons[] = array('DeSelect All','uncheck','btn');
        $buttons[] = array('separator');
		$buttons[] = array('Add','add','btn');
        $buttons[] = array('separator');
        $buttons[] = array('Delete Selected Items','delete','btn');
        $buttons[] = array('separator');
       		
        $gridParams = array(
            'height' => 300,
            'rp' => 10,
            'rpOptions' => '[10,20,30,40]',
            'pagestat' => 'Displaying: {from} to {to} of {total} items.',
            'blockOpacity' => 0.5,
            'title' => '',
            'showTableToggleBtn' => false
	);

        $grid_js = build_grid_js('flex1',site_url('admin/c_galeri/load_data'),$colModel,'id_galeri','asc',$gridParams,$buttons);

		$data['js_grid'] = $grid_js;

        $data['page_title'] = 'Data Galeri';		
		$data['menu'] = $this->load->view('menu/v_admin', $data, TRUE);
        $data['content'] = $this->load->view('galeri/v_list', $data, TRUE);
        $this->load->view('utama', $data);
        //echo json_encode($data);
    }

    function load_data() {	
		
        $this->load->library('flexigrid');
        $valid_fields = array('id_galeri','judul','kategori','url');

		$this->flexigrid->validate_post('id_galeri','ASC',$valid_fields);
		$records = $this->m_galeri->get_galeri_flexigrid();
	
		$this->output->set_header($this->config->item('json_header'));
	
		$record_items = array();
		$no=0;
		foreach ($records['records']->result() as $row)
		{
			$no++;
			$record_items[] = array(
				$row->id_galeri,
                $no,
                $row->judul,
				$row->kategori,
				$row->url,
//				'<input type="button" value="Edit" class="ubah" onclick="edit_dusun(\''.$row->id_dusun.'\')"/>'
                '<button type="submit" class="btn btn-default btn-xs" title="Edit" onclick="edit_galeri(\''.$row->id_galeri.'\')"/><i class="fa fa-pencil"></i></button>'
			);  
		}
		//Print please
		$this->output->set_output($this->flexigrid->json_build($records['record_count'],$record_items));
		//echo json_encode($records);
    }

    function add(){
		$session['hasil'] = $this->session->userdata('logged_in');
		$role = $session['hasil']->role;
		if($this->session->userdata('logged_in') AND $role == 'Administrator')
		{
			$data['page_title'] = 'Tambah Galeri';
			$data['menu'] = $this->load->view('menu/v_admin', $data, TRUE);
			$data['content'] = $this->load->view('galeri/v_tambah', $data, TRUE);
								
			$this->load->view('utama', $data);
		}else
			redirect('c_login', 'refresh');
        
    }
	
	function simpan_galeri() {
		$judul = $this->input->post('judul', TRUE);
		$kategori = $this->input->post('jenis', TRUE);
		$urlv = $this->input->post('url-video', TRUE);
		$nama = $this->input->post('nama', TRUE);
		if($kategori == "video"){
			$data = array(
					'judul' => $judul,
					'kategori' => $kategori,
					'url' => $urlv
				);
		}else{
			//UPLOAD LOGO KABUPATEN
			//UPLOAD GAMBAR ARTIKEL
			$newfile = $this->input->post('image-data', TRUE);
			
			define('UPLOAD_DIR', 'uploads/galeri/');
			$img = $newfile;

/*			$resize_settings['image_library'] = 'gd2';
			$resize_settings['source_image'] = $img;
			$resize_settings['maintain_ratio'] = false;
			$resize_settings['quality'] = '30%';
			$this->load->library('image_lib', $resize_settings);

			$resize_settings['width'] = '500';
			$resize_settings['height'] = '500';
			$resize_settings['new_image'] = $img;
			$this->image_lib->initialize($resize_settings);
			$this->image_lib->resize();*/

			$img = str_replace('data:image/jpeg;base64,', '', $img);
			$img = str_replace(' ', '+', $img);
			$data = base64_decode($img);		
			
			
			$namaFile = sha1(date("Y-m-d H:i:s").'ajengtindakpundi?');
			$file = UPLOAD_DIR . $namaFile . '.jpg';
			$success = file_put_contents($file, $data);
			
			$path_gambar_galeri = $file;
			$data = array(
				'judul' => $judul,
				'kategori' => $kategori,
				'url' => $path_gambar_galeri
			);
			$this->session->set_flashdata('message', 'Data berhasil ditambahkan !');
			
			//END UPLOAD LOGO KABUPATEN
			
		}
		$this->m_galeri->insertGaleri($data);
		redirect('admin/c_galeri','refresh');
		
 
    }

    function edit($id){
		$session['hasil'] = $this->session->userdata('logged_in');
		$role = $session['hasil']->role;
		if($this->session->userdata('logged_in') AND $role == 'Administrator')
		{
			$data['id_galeri'] = $id;
			$data['page_title'] = 'Ubah Data Galeri';
			$data['konten_galeri'] = $this->m_galeri->get_galeri($id);
			$data['menu'] = $this->load->view('menu/v_admin', $data, TRUE);
			$data['content'] = $this->load->view('galeri/v_ubah', $data, TRUE);
        
			$this->load->view('utama', $data);
			//echo json_encode($data['konten_galeri']);
		}else
			redirect('c_login', 'refresh');
    }

    function update_galeri() {
		$judul = $this->input->post('judul', TRUE);
		$kategori = $this->input->post('jenis', TRUE);
		$urlv = $this->input->post('url-video', TRUE);
		$nama = $this->input->post('nama', TRUE);
		$id = $this->input->post('id',TRUE);
		$gambar = $this->input->post('gambar',TRUE);

		if($kategori == "video"){
			$data = array(
					'judul' => $judul,
					'kategori' => $kategori,
					'url' => $urlv
				);
		}else{
			unlink($gambar);
			$newfile = $this->input->post('image-data', TRUE);
			
			define('UPLOAD_DIR', 'uploads/galeri/');
			$img = $newfile;
			$img = str_replace('data:image/jpeg;base64,', '', $img);
			$img = str_replace(' ', '+', $img);
			$data = base64_decode($img);		
			
			
			$namaFile = sha1(date("Y-m-d H:i:s").'ajengtindakpundi?');
			$file = UPLOAD_DIR . $namaFile . '.jpg';
			$success = file_put_contents($file, $data);
			
			$path_gambar_galeri = $file;
			$data = array(
				'judul' => $judul,
				'kategori' => $kategori,
				'url' => $path_gambar_galeri
			);
			$this->session->set_flashdata('message', 'Data berhasil diubah !');
			
			//END UPLOAD LOGO KABUPATEN
			
		}
		$this->m_galeri->updateGaleri($id,$data);
		redirect('admin/c_galeri','refresh');
		
 
    }

    function delete(){
        $post = explode(",", $this->input->post('items'));
        array_pop($post); $sucess=0;
        foreach($post as $id){
        	$gambar = $this->m_galeri->getGambarByIdGaleri($id);
            $this->m_galeri->deleteGaleri($id,$gambar);
	    		
            $sucess++;
        }
        redirect('admin/c_artikel', 'refresh');
    }
}
?>