<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class C_artikel extends CI_Controller {

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
			$this->load->helper('text');
			$this->load->model('m_artikel');
			$this->load->model('m_user');
			$this->load->model('m_pages');			
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
	
	$colModel['No'] = array('No',35,TRUE,'center',0);
    $colModel['judul_artikel'] = array('Judul Artikel',300,TRUE,'center',2);
	
	$colModel['waktu'] = array('Waktu Artikel',100,TRUE,'center',2);
	$colModel['kategori'] = array('Kategori',200,TRUE,'center',2);
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
            'height' => 400,
            'rp' => 10,
            'rpOptions' => '[10,20,30,40]',
            'pagestat' => 'Displaying: {from} to {to} of {total} items.',
            'blockOpacity' => 0.5,
            'title' => '',
            'showTableToggleBtn' => false
	);

        $grid_js = build_grid_js('flex1',site_url('admin/c_artikel/load_data'),$colModel,'waktu','desc',$gridParams,$buttons);

		$data['js_grid'] = $grid_js;

        $data['page_title'] = 'ARTIKEL';		
		$data['menu'] = $this->load->view('menu/v_admin', $data, TRUE);
        $data['content'] = $this->load->view('artikel/v_list', $data, TRUE);
        $this->load->view('utama', $data);
    }

    function load_data() {

        $this->load->library('flexigrid');
        $valid_fields = array('judul_artikel','waktu','kategori');

		$this->flexigrid->validate_post('judul_artikel','DESC',$valid_fields);
		$records = $this->m_artikel->get_artikel_flexigrid();
	
		$this->output->set_header($this->config->item('json_header'));
	
		$record_items = array();
		$counter=0;
		foreach ($records['records']->result() as $row)
		{
			$counter++;
			$record_items[] = array(
				$row->id_artikel,
				$counter,
                $row->judul_artikel,
				//substr($row->isi_artikel,0,10),
				date('j-m-Y ',strtotime($row->waktu)),
                $row->kategori,
//				'<input type="button" value="Edit" class="ubah" onclick="edit_artikel(\''.$row->id_artikel.'\')"/>'
				'<button type="submit" class="btn btn-default btn-xs" title="Edit" onclick="edit_artikel(\''.$row->id_artikel.'\')"/>
			<i class="fa fa-pencil"></i>
			</button>'
			);  
		}
		//Print please
		$this->output->set_output($this->flexigrid->json_build($records['record_count'],$record_items));
    }
    
	function lists_kategori() {
	
	$colModel['No'] = array('No',35,TRUE,'center',0);
    $colModel['deskripsi'] = array('Deskripsi',300,TRUE,'center',2);
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
            'height' => 400,
            'rp' => 10,
            'rpOptions' => '[10,20,30,40]',
            'pagestat' => 'Displaying: {from} to {to} of {total} items.',
            'blockOpacity' => 0.5,
            'title' => '',
            'showTableToggleBtn' => false
	);

        $grid_js = build_grid_js('flex1',site_url('admin/c_artikel/load_data_kategori'),$colModel,'No','desc',$gridParams,$buttons);

		$data['js_grid'] = $grid_js;

        $data['page_title'] = 'KATEGORI ARTIKEL';		
		$data['menu'] = $this->load->view('menu/v_admin', $data, TRUE);
        $data['content'] = $this->load->view('artikel/v_list_kategori', $data, TRUE);
        $this->load->view('utama', $data);
    }

    function load_data_kategori() {

        $this->load->library('flexigrid');
        $valid_fields = array('deskripsi');

		$this->flexigrid->validate_post('deskripsi','DESC',$valid_fields);
		$records = $this->m_artikel->get_kategori_artikel_flexigrid();
	
		$this->output->set_header($this->config->item('json_header'));
	
		$record_items = array();
		$counter=0;
		foreach ($records['records']->result() as $row)
		{
			$counter++;
			$record_items[] = array(
				$row->id_kategori_artikel,
				$counter,
                $row->deskripsi,
				'<button type="submit" class="btn btn-default btn-xs" title="Edit" onclick="edit_kategori(\''.$row->id_kategori_artikel.'\')"/>
			<i class="fa fa-pencil"></i>
			</button>'
			);  
		}
		//Print please
		$this->output->set_output($this->flexigrid->json_build($records['record_count'],$record_items));
    }
    
    function add(){
		$session['hasil'] = $this->session->userdata('logged_in');
		$role = $session['hasil']->role;
		if($this->session->userdata('logged_in') AND $role == 'Administrator')
		{	
			$s['cek'] = $this->session->userdata('logged_in');
			$x = $s['cek']->id_pengguna;
			
			$data['hasil'] = $this->m_user->getUserByIdPengguna($x);
			$data['kategori'] = $this->m_artikel->getKategori();
			$data['page_title'] = 'TAMBAH ARTIKEL';
			$data['menu'] = $this->load->view('menu/v_admin', $data, TRUE);
			$data['content'] = $this->load->view('artikel/v_tambah', $data, TRUE);		
			$this->load->view('utama', $data);
		}else
			redirect('c_login', 'refresh');   
        
    }    
	
	function add_kategori(){
		$session['hasil'] = $this->session->userdata('logged_in');
		$role = $session['hasil']->role;
		if($this->session->userdata('logged_in') AND $role == 'Administrator')
		{	
			$data['page_title'] = 'TAMBAH KATEGORI';
			$data['menu'] = $this->load->view('menu/v_admin', $data, TRUE);
			$data['content'] = $this->load->view('artikel/v_tambah_kategori', $data, TRUE);		
			$this->load->view('utama', $data);
		}else
			redirect('c_login', 'refresh');   
        
    }
	
	function simpan_artikel() {
	
		$s['cek'] = $this->session->userdata('logged_in');
		$x = $s['cek']->nama_pengguna;
		
		$judul = $this->input->post('judul', TRUE);
		$gambar = $this->input->post('gambar', TRUE);
		$artikel = $this->input->post('isi', TRUE);
		$id_kategori_artikel = $this->input->post('id_kategori_artikel', TRUE);
		$user = $x;
		 
		$this->form_validation->set_rules('judul', 'Judul Artikel', 'required');
		
		
		//UPLOAD GAMBAR ARTIKEL
		$newfile = $this->input->post('image-data', TRUE);
		
		define('UPLOAD_DIR', 'uploads/artikel/');
		$img = $newfile;
		$img = str_replace('data:image/jpeg;base64,', '', $img);
		$img = str_replace(' ', '+', $img);
		$data = base64_decode($img);		
		
		
		$namaFile = sha1(date("Y-m-d H:i:s").'ajengtindakpundi?');
		$file = UPLOAD_DIR . $namaFile . '.jpg';
		$success = file_put_contents($file, $data);
		
		$path_gambar_artikel = $file;
		$this->createThumbnail($path_gambar_artikel);
		
		if ($this->form_validation->run() == TRUE)
		{
			$data = array(
				'penulis' => $user,
				'gambar' => $path_gambar_artikel,
				'thumb' => UPLOAD_DIR . $namaFile . '_thumb.jpg',
				'judul_artikel' => $judul,
				'isi_artikel' => $artikel,
				'id_kategori_artikel' => $id_kategori_artikel
			);
	
			$this->m_artikel->insertArtikel($data);
			$url='web/c_home/get_detail_artikel/';
			$dataPages = array(
				'url' => $url.mysql_insert_id(),
				'title' => $judul,
				'content' => $artikel	
			);
			$this->m_pages->insertPages($dataPages);
			
			$this->session->set_flashdata('message', 'Data berhasil ditambahkan !');
			redirect('admin/c_artikel','refresh');
        }
		else $this->add();
    }

	function simpan_kategori() {
		$deskripsi = $this->input->post('deskripsi', TRUE);
		
		$this->form_validation->set_rules('deskripsi', 'Nama Kategori', 'required');

		if ($this->form_validation->run() == TRUE)
		{
					
			$data = array(
				'deskripsi' => $deskripsi
			);
			$this->m_artikel->insertKategori($data);	
			redirect('admin/c_artikel/lists_kategori','refresh');
			
        }
		else $this->add();
    }
	
	function edit($id){
		$session['hasil'] = $this->session->userdata('logged_in');
		$role = $session['hasil']->role;
		if($this->session->userdata('logged_in') AND $role == 'Administrator')
		{			
			$data['kategori'] = $this->m_artikel->getKategori();
			
			$data['hasil'] = $this->m_artikel->getArtikelByIdArtikel($id);        		
			$data['page_title'] = 'UBAH ARTIKEL';
			$data['menu'] = $this->load->view('menu/v_admin', $data, TRUE);
			$data['content'] = $this->load->view('artikel/v_ubah', $data, TRUE);
			
			$this->load->view('utama', $data);
		}else
			redirect('c_login', 'refresh');   
    }
	
	function edit_kategori($id){
		$session['hasil'] = $this->session->userdata('logged_in');
		$role = $session['hasil']->role;
		if($this->session->userdata('logged_in') AND $role == 'Administrator')
		{
			$data['hasil'] = $this->m_artikel->getKategoriByIdKategori($id);
			$data['page_title'] = 'UBAH KATEGORI';
			$data['menu'] = $this->load->view('menu/v_admin', $data, TRUE);
			$data['content'] = $this->load->view('artikel/v_ubah_kategori', $data, TRUE);	
       
			$this->load->view('utama', $data);
		}else
			redirect('c_login', 'refresh'); 
    }
	
	function update_artikel() {	
	
		$s['cek'] = $this->session->userdata('logged_in');
		$x = $s['cek']->nama_pengguna;
		
		$idb = $this->input->post('id_artikel', TRUE);		
		$gambar = $this->input->post('gambar', TRUE);
		$judulB = $this->input->post('judul_artikel', TRUE);
		$artikel = $this->input->post('isi_artikel', TRUE);
		$gambar_lama = $this->input->post('gambar', TRUE);
		$thumb_lama = $this->input->post('thumb', TRUE);
		
		$id_kategori_artikel = $this->input->post('id_kategori_artikel', TRUE);
		$user = $x;
		
		$this->form_validation->set_rules('judul_artikel', 'Judul Artikel', 'required');
		
		unlink($gambar_lama);
		unlink($thumb_lama);
		
		
		//UPLOAD GAMBAR ARTIKEL
		$newfile = $this->input->post('image-data', TRUE);
		
		define('UPLOAD_DIR', 'uploads/artikel/');
		$img = $newfile;
		$img = str_replace('data:image/jpeg;base64,', '', $img);
		$img = str_replace(' ', '+', $img);
		$data = base64_decode($img);		
		
		
		$namaFile = sha1(date("Y-m-d H:i:s").'ajengtindakpundi?');
		$file = UPLOAD_DIR . $namaFile . '.jpg';
		$success = file_put_contents($file, $data);
		
		$path_gambar_artikel = $file;		
		$this->createThumbnail($path_gambar_artikel);
		
		if ($this->form_validation->run() == TRUE){
			$data = array(
			'penulis' => $user,
			'gambar' => $path_gambar_artikel,
			'thumb' => UPLOAD_DIR . $namaFile . '_thumb.jpg',
			'judul_artikel' => $judulB,
			'isi_artikel' => $artikel,
			'id_kategori_artikel' => $id_kategori_artikel		
			);
			$result = $this->m_artikel->updateArtikel(array('id_artikel' => $idb), $data);
			$url='web/c_home/get_detail_artikel/';
			$dataPages = array(
				'url' => $url.$idb,
				'title' => $judulB,
				'content' => $artikel	
			);
			$result = $this->m_pages->updatePages(array('url' => $url.$idb), $dataPages);
			$this->session->set_flashdata('message', 'Ubah data berhasil dilakukan !');
			redirect('admin/c_artikel','refresh');
		}
		else $this->edit($idb);
    }
	
	function update_kategori() {	
	
		$id_kategori_artikel = $this->input->post('id_kategori_artikel', TRUE);
		$deskripsi = $this->input->post('deskripsi', TRUE);
		
		$this->form_validation->set_rules('deskripsi', 'Deskripsi', 'required');

		if ($this->form_validation->run() == TRUE)
		{
			$data = array(
					'deskripsi' => $deskripsi
				);
	
		  	$result = $this->m_artikel->updateKategori(array('id_kategori_artikel' => $id_kategori_artikel), $data);
			
		  	redirect('admin/c_artikel/lists_kategori','refresh');
		}
		else $this->edit($id_agama);
    }
    function delete(){
	$url='web/c_home/get_detail_artikel/';
        $post = explode(",", $this->input->post('items'));
        array_pop($post); $sucess=0;
        foreach($post as $id){
            $urlx=$url.$id;
            $this->m_pages->deletePages($urlx);
            $gambar = $this->m_artikel->getGambarByIdArtikel($id);
            $gambar = $this->m_artikel->getThumbByIdArtikel($id);
            $this->m_artikel->deleteArtikel($id,$gambar,$thumb);
	    		
            $sucess++;
        }
		
        redirect('admin/c_artikel', 'refresh');
    }
	
	function delete_kategori()    {
        $post = explode(",", $this->input->post('items'));
        array_pop($post); $sucess=0;
        foreach($post as $id){
            $this->m_artikel->deleteKategori($id);
            $sucess++;
        }
		
        redirect('admin/c_artikel/lists_kategori','refresh');
    }
	
	function createThumbnail($path)
    {
        $config['image_library']    = "gd2";    
        $config['source_image']     = $path;   
        $config['create_thumb']     = TRUE;      
        $config['maintain_ratio']   = TRUE;      
        $config['width'] = "250";      
        $config['height'] = "250";
        $this->load->library('image_lib',$config);
        if(!$this->image_lib->resize())
        {
            echo $this->image_lib->display_errors();
        }      

    }
}
?>