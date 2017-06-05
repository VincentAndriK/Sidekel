<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class C_indikator_kesejahteraan extends CI_Controller {

    function  __construct()
    {
		parent::__construct();

        //Load flexigrid helper and library
        $this->load->helper('flexigrid_helper');
        $this->load->library('flexigrid');
        $this->load->helper('form');
        $this->load->model('m_indikator_kesejahteraan');
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

    function lists() {
        $colModel['id_indikator'] = array('ID',20,TRUE,'center',0);	
		$colModel['deskripsi'] = array('Deskripsi',220,TRUE,'left',2);
		$colModel['bobot'] = array('Bobot',50,TRUE,'left',2);
        $colModel['aksi'] = array('AKSI',60,FALSE,'center',0);
		
		//Populate flexigrid buttons..
        //$buttons[] = array('Select All','check','btn');
		//$buttons[] = array('separator');
        //$buttons[] = array('DeSelect All','uncheck','btn');
        //$buttons[] = array('separator');
		$buttons[] = array('Add','add','btn');
        $buttons[] = array('separator');
        //$buttons[] = array('Delete Selected Items','delete','btn');
        //$buttons[] = array('separator');
       		
        $gridParams = array(
            'height' => 300,
            'rp' => 10,
            'rpOptions' => '[10,20,30,40]',
            'pagestat' => 'Displaying: {from} to {to} of {total} items.',
            'blockOpacity' => 0.5,
            'title' => '',
            'showTableToggleBtn' => false
	);

        $grid_js = build_grid_js('flex1',site_url('indikatorkesejahteraan/c_indikator_kesejahteraan/load_data'),$colModel,'id_indikator','asc',$gridParams,$buttons);

		$data['js_grid'] = $grid_js;

        $data['page_title'] = 'DATA INDIKATOR KESEJAHTERAAN';		
		$data['menu'] = $this->load->view('menu/v_indikatorkesejahteraan', $data, TRUE);
        $data['content'] = $this->load->view('indikatorkesejahteraan/v_list', $data, TRUE);
        $this->load->view('utama', $data);
    }

    function load_data() {	
		$this->load->library('flexigrid');
        $valid_fields = array('id_indikator','deskripsi','bobot');

		$this->flexigrid->validate_post('id_indikator','ASC',$valid_fields);
		$records = $this->m_indikator_kesejahteraan->get_indikator_kesejahteraan_flexigrid();
	
		$this->output->set_header($this->config->item('json_header'));
	
		$record_items = array();
		
		foreach ($records['records']->result() as $row)
		{
			$record_items[] = array(
				$row->id_indikator,
				$row->id_indikator,
				$row->deskripsi,
				$row->bobot,
				'<button type="submit" class="btn btn-default btn-xs" title="Edit" onclick="edit_indikator_kesejahteraan(\''.$row->id_indikator.'\')"/><i class="fa fa-pencil"></i></button>
				<button type="submit" class="btn btn-danger btn-xs" title="hapus" onclick="hapus_indikator(\''.$row->id_indikator.'\')"/><i class="fa fa-trash-o"></i></button>
				'
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
			$data['page_title'] = 'Tambah Indikator Kesejahteraan';
			$data['menu'] = $this->load->view('menu/v_indikatorkesejahteraan', $data, TRUE);
			$data['content'] = $this->load->view('indikatorkesejahteraan/v_tambah', $data, TRUE);
		
			$this->load->view('utama', $data);
		}else
			redirect('c_login', 'refresh');
        
    }
	
	function simpan_indikator_kesejahteraan() {
		$deskripsi = $this->input->post('deskripsi', TRUE);
		$bobot = $this->input->post('bobot', TRUE);
		
		$this->form_validation->set_rules('deskripsi', 'bobot', 'required');

		if ($this->form_validation->run() == TRUE)
		{
			$result['hasil'] = $this->m_indikator_kesejahteraan->cekFIleExist($deskripsi);				
			
			if ($result['hasil'] == NULL) {				
				$data = array(
					'deskripsi' => $deskripsi,
					'bobot'=> $bobot
				);

			$this->m_indikator_kesejahteraan->insertIndikatorKesejahteraan($data);	
			redirect('indikatorkesejahteraan/c_indikator_kesejahteraan','refresh');
			}			
			else $this->add();
        }
		else $this->add();
    }

    function edit($id){
		$session['hasil'] = $this->session->userdata('logged_in');
		$role = $session['hasil']->role;
		if($this->session->userdata('logged_in') AND $role == 'Pengelola Sensus')
		{
			$data['hasil'] = $this->m_indikator_kesejahteraan->getIndikatorKesejahteraanByIdIndikator($id);
			$data['page_title'] = 'Edit Indikator Kesejahteraan';
			$data['menu'] = $this->load->view('menu/v_indikatorkesejahteraan', $data, TRUE);
			$data['content'] = $this->load->view('indikatorkesejahteraan/v_ubah', $data, TRUE);
        
			$this->load->view('utama', $data);
		}else
			redirect('c_login', 'refresh');
    }
	
	function update_indikator_kesejahteraan() {	
	
		$id_indikator = $this->input->post('id_indikator', TRUE);
		$deskripsi = $this->input->post('deskripsi', TRUE);
		$bobot = $this->input->post('bobot', TRUE);
		
		$this->form_validation->set_rules('deskripsi', 'Deskripsi', 'required');
		$this->form_validation->set_rules('bobot', 'Bobot', 'required');

		if ($this->form_validation->run() == TRUE)
		{
			$data = array(
					'deskripsi' => $deskripsi,
					'bobot' => $bobot
				);
	
		  	$result = $this->m_indikator_kesejahteraan->updateIndikatorKesejahteraan(array('id_indikator' => $id_indikator), $data);
			
		  	redirect('indikatorkesejahteraan/c_indikator_kesejahteraan','refresh');
		}
		else $this->edit($id_indikator);
    }
	
	function delete($id)    {
       /*  $post = explode(",", $this->input->post('items'));
        array_pop($post); $sucess=0;
        foreach($post as $id){
            $this->m_indikator_kesejahteraan->deleteIndikatorKesejahteraan($id);
            $sucess++;
        } */
		$this->m_indikator_kesejahteraan->updateIsDelete($id);
        redirect('indikatorkesejahteraan/c_indikator_kesejahteraan', 'refresh');
    }
	
	function DeskripsiExist()
	{	
		$deskripsi = $this->input->post('deskripsi');
		$cek = $this->m_indikator_kesejahteraan->getDeskripsiExist($deskripsi);
		if($cek == TRUE)
		{	echo true;	}
		else
		{	echo false;	}
	}
	

}
?>