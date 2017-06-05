<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class C_sensus extends CI_Controller {

    function  __construct()
    {
		parent::__construct();

        //Load flexigrid helper and library
        $this->load->helper('flexigrid_helper');
        $this->load->library('flexigrid');
        $this->load->helper('form');
        $this->load->model('m_sensus');
		$this->load->model('m_indikator_kesejahteraan');
		$this->load->model('m_pertanyaan_sensus');
		$this->load->model('m_jawaban_sensus');
		$this->load->model('m_pilihan_jawaban');
    }

    function index()    {
		$session['hasil'] = $this->session->userdata('logged_in');
		$role = $session['hasil']->role;
		if($this->session->userdata('logged_in') AND $role == 'Pengelola Sensus')
		{
			$this->lists();
		}else
			redirect('c_login', 'refresh');
        	
    }
	
	function tampil_pertanyaan_sensus($id)
	{
		$session['hasil'] = $this->session->userdata('logged_in');
		$role = $session['hasil']->role;
		if($this->session->userdata('logged_in') AND $role == 'Pengelola Sensus')
		{
			$data['id_pertanyaan'] = $id;
			
			$data['page_title'] = 'Tampil Pertanyaan Sensus';
			$data['pertanyaan'] = $this->m_pertanyaan_sensus->getPertanyaan($id);
			$data['menu'] = $this->load->view('menu/v_indikatorkesejahteraan', $data, TRUE);
			$data['content'] = $this->load->view('data_sensus/v_detil', $data, TRUE);
        
			$this->load->view('utama', $data);
		}else
			redirect('c_login', 'refresh');
	}

    function lists() {
        $colModel['id_sensus'] = array('ID',20,TRUE,'center',0);	
		$colModel['tanggal_sensus'] = array('Tanggal Sensus',120,TRUE,'left',2);
		$colModel['keterangan'] = array('Keterangan',120,TRUE,'left',2);
        $colModel['aksi'] = array('Tambah Pertanyaan',140,FALSE,'center',0);
        $colModel['aksi2'] = array('Mulai Sensus',140,FALSE,'center',0);
        $colModel['aksi3'] = array('Aksi',140,FALSE,'center',0);
		
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

        $grid_js = build_grid_js('flex1',site_url('indikatorkesejahteraan/c_sensus/load_data'),$colModel,'id_sensus','asc',$gridParams,$buttons);

		$data['js_grid'] = $grid_js;

        $data['page_title'] = 'DATA SENSUS';		
		$data['menu'] = $this->load->view('menu/v_indikatorkesejahteraan', $data, TRUE);
        $data['content'] = $this->load->view('data_sensus/v_list', $data, TRUE);
        $this->load->view('utama', $data);
    }

    function load_data() {	
		$this->load->library('flexigrid');
        $valid_fields = array('id_sensus','tanggal_sensus','keterangan');

		$this->flexigrid->validate_post('id_sensus','ASC',$valid_fields);
		$records = $this->m_sensus->get_data_sensus_flexigrid();
	
		$this->output->set_header($this->config->item('json_header'));
	
		$record_items = array();
		
		foreach ($records['records']->result() as $row)
		{
			$record_items[] = array(
				$row->id_sensus,
				$row->id_sensus,
				date('d-m-Y',strtotime($row->tanggal_sensus)),
				$row->keterangan,
				
				'
				<button type="submit" class="btn btn-primary btn-xs btn-block" title="Tambah Pertanyaan Sensus" onclick="tambah_data_sensus(\''.$row->id_sensus.'\')"/><i class="fa fa-plus-square"></i></button>
				',
				'
				<button type="submit" class="btn btn-success btn-xs btn-block" title="Mulai Sensus" onclick="tambah_jawaban_sensus(\''.$row->id_sensus.'\')"/><i class="fa fa-play"></i></button>
				',
				'
				<button type="submit" class="btn btn-default btn-xs" title="Edit" onclick="edit_data_sensus(\''.$row->id_sensus.'\')"/><i class="fa fa-pencil"></i></button>				
				<button type="submit" class="btn btn-info btn-xs" title="Tampil Pertanyaan Sensus" onclick="tampil_pertanyaan_sensus(\''.$row->id_sensus.'\')"/><i class="fa fa-eye"></i></button>
				'
				//<button type="submit" class="btn btn-danger btn-xs" title="hapus" onclick="hapus_sensus(\''.$row->id_sensus.'\')"/><i class="fa fa-trash-o"></i></button>
			);  
		}
		//Print please
		$this->output->set_output($this->flexigrid->json_build($records['record_count'],$record_items));
    }
	 
    function add(){		
		$session['hasil'] = $this->session->userdata('logged_in');
		$role = $session['hasil']->role;
		if($this->session->userdata('logged_in') AND $role == 'Pengelola Sensus')
		{			
			$data['page_title'] = 'Tambah Data Sensus';
			$data['menu'] = $this->load->view('menu/v_indikatorkesejahteraan', $data, TRUE);
			$data['content'] = $this->load->view('data_sensus/v_tambah', $data, TRUE);
		
			$this->load->view('utama', $data);
		}else
			redirect('c_login', 'refresh');
        
    }
	
	function simpan_data_sensus() {
		
		$tanggal_sensus = $this->input->post('tanggal_sensus', TRUE);
		$keterangan = $this->input->post('keterangan', TRUE);
		
		$this->form_validation->set_rules('tanggal_sensus','keterangan');
		
		if ($this->form_validation->run() == TRUE)
		{
			$data = array
			(
				'tanggal_sensus' => date('Y-m-d', strtotime($tanggal_sensus)),
				'keterangan' => $keterangan
			);
			$this->m_sensus->insertDataSensus($data);	
			
        }
		redirect('indikatorkesejahteraan/c_sensus','refresh');
    }
	
	function getCiri(){	
			$id_indikator = $this->input->post('tes_1');
			$data['deskripsi'] = $this->m_indikator_kesejahteraan->get_ciri_dinamic($id_indikator);
			$this->load->view('data_sensus/ciri_pembeda',$data);
	}
	
	function tambah_pertanyaan($id){
		$session['hasil'] = $this->session->userdata('logged_in');
		$role = $session['hasil']->role;
		if($this->session->userdata('logged_in') AND $role == 'Pengelola Sensus')
		{			
			$data['hasil'] = $this->m_sensus->getDataSensusByIdSensus($id);
			$data['indikator'] = $this->m_indikator_kesejahteraan->getPertama();
			$data['page_title'] = 'Tambah Pertanyaan Sensus';
			$data['menu'] = $this->load->view('menu/v_indikatorkesejahteraan', $data, TRUE);
			$data['content'] = $this->load->view('data_sensus/v_tambah_pertanyaan', $data, TRUE);
			$this->load->view('utama', $data);
		}else
			redirect('c_login', 'refresh');
    }
	
	function simpan_tambah_pertanyaan() {
		
		$data['id_sensus'] = $this->input->post('id_sensus');
		$data['id_indikator'] = $this->input->post('tes_1');
		$data1['id_sensus'] = $this->input->post('id_sensus');
		$data1['id_indikator'] = $this->input->post('tes_1');
		$data['pertanyaan'] = $this->input->post('pertanyaan_1');
		$this->m_pertanyaan_sensus->insertPertanyaanSensus($data);
		$data1['id_pertanyaan'] = $this->db->insert_id();
		$rows = $this->input->post('rows');
		for($i=1;$i<=$rows;$i++)
		{
			$data1['deskripsi'] = $this->input->post('jawaban_'.$i);
			$data1['bobot'] = $this->input->post('nilai_'.$i);
			
			$this->m_pilihan_jawaban->insertPilihanJawaban($data1);
		} 
		
		redirect('indikatorkesejahteraan/c_sensus', 'refresh');
	}
	
	/* function simpan_tambah_pertanyaan_lagi($id) {
		
		$data['id_sensus'] = $this->input->post('id_sensus');
		$data['id_indikator'] = $this->input->post('tes_1');
		$data1['id_sensus'] = $this->input->post('id_sensus');
		$data1['id_indikator'] = $this->input->post('tes_1');
		$data['pertanyaan'] = $this->input->post('pertanyaan_1');
		$this->m_pertanyaan_sensus->insertPertanyaanSensus($data);
		$data1['id_pertanyaan'] = $this->db->insert_id();
		$rows = $this->input->post('rows');
		for($i=1;$i<=$rows;$i++)
		{
			$data1['deskripsi'] = $this->input->post('jawaban_'.$i);
			$data1['bobot'] = $this->input->post('nilai_'.$i);
			
			$this->m_pilihan_jawaban->insertPilihanJawaban($data1);
		} 
		//redirect('indikatorkesejahteraan/c_sensus/tambah_pertanyaan/'.$id.'/', 'refresh');
		echo json_encode($data);
		
	} */ 
	
	
    function edit($id){
		$session['hasil'] = $this->session->userdata('logged_in');
		$role = $session['hasil']->role;
		if($this->session->userdata('logged_in') AND $role == 'Pengelola Sensus')
		{
			
			$data['hasil'] = $this->m_sensus-> getDataSensusByIdSensus($id);
			$data['page_title'] = 'Edit Data Sensus';
			$data['menu'] = $this->load->view('menu/v_indikatorkesejahteraan', $data, TRUE);
			$data['content'] = $this->load->view('data_sensus/v_ubah', $data, TRUE);
        
			$this->load->view('utama', $data);
		}else
			redirect('c_login', 'refresh');
    }
	
	function update_data_sensus() {	
		
		$id_sensus = $this->input->post('id_sensus', TRUE);
		$tanggal_sensus = $this->input->post('tanggal_sensus', TRUE);
		$keterangan = $this->input->post('keterangan', TRUE);
		
		
		$this->form_validation->set_rules('id_sensus', 'id_sensus', 'required');
		$this->form_validation->set_rules('tanggal_sensus', 'tanggal_sensus', 'required');
		$this->form_validation->set_rules('keterangan', 'keterangan', 'required');

		if ($this->form_validation->run() == TRUE)
		{
			$data = array(
					'id_sensus' => $id_sensus,
					'tanggal_sensus' => date('Y-m-d',strtotime($tanggal_sensus)),
					'keterangan' => $keterangan
				);
	
		  	$result = $this->m_sensus->updateDataSensus(array('id_sensus' => $id_sensus), $data);
			
		  	redirect('indikatorkesejahteraan/c_sensus','refresh');
		}
		else $this->edit($id_sensus);
    }
	
	function delete(){
        $post = explode(",", $this->input->post('items'));
        array_pop($post); $sucess=0;
        foreach($post as $id){
            $this->m_sensus->deleteDataSensus($id);
            $sucess++;
        }
		//$this->m_sensus->updateIsDelete($id);
		
        redirect('indikatorkesejahteraan/c_sensus', 'refresh');
    }
	
	function TanggalExist()
	{	
		$deskripsi = $this->input->post('tanggal_sensus');
		$cek = $this->m_sensus->getTanggalExist($deskripsi);
		if($cek == TRUE)
		{	echo true;	}
		else
		{	echo false;	}
	}
	
}
?>