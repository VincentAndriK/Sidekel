<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class C_hasil_sensus extends CI_Controller {

    function  __construct()
    {
		parent::__construct();

        //Load flexigrid helper and library
        $this->load->helper('flexigrid_helper');
        $this->load->library('flexigrid');
        $this->load->helper('form');
		$this->load->model('m_hasil_sensus');
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
        $colModel['id_hasil'] = array('ID',20,TRUE,'center',0);	
		$colModel['id_sensus'] = array('ID Sensus',120,TRUE,'left',2);
		$colModel['id_keluarga'] = array('ID Keluarga',120,TRUE,'left',2);
		$colModel['total_nilai'] = array('Total nilai',220,TRUE,'left',2);
		$colModel['id_kelas_sosial'] = array('ID Kelas Sosial',120,TRUE,'left',2);
        $colModel['aksi'] = array('AKSI',90,FALSE,'center',0);
		
		
		
		
		//Populate flexigrid buttons..
        $buttons[] = array('Select All','check','btn');
		$buttons[] = array('separator');
        $buttons[] = array('DeSelect All','uncheck','btn');
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

        $grid_js = build_grid_js('flex1',site_url('indikatorkesejahteraan/c_hasil_sensus/load_data'),$colModel,'id_hasil','asc',$gridParams,$buttons);

		$data['js_grid'] = $grid_js;

        $data['page_title'] = 'DATA HASIL SENSUS';		
		$data['menu'] = $this->load->view('menu/v_indikatorkesejahteraan', $data, TRUE);
        $data['content'] = $this->load->view('data_hasil_sensus/v_list', $data, TRUE);
        $this->load->view('utama', $data);
    }

    function load_data() {	
		$this->load->library('flexigrid');
        $valid_fields = array('id_hasil','id_sensus','id_keluarga','total_nilai','status');

		$this->flexigrid->validate_post('id_hasil','ASC',$valid_fields);
		$records = $this->m_hasil_sensus->get_hasil_sensus_flexigrid();
	
		$this->output->set_header($this->config->item('json_header'));
	
		$record_items = array();
		
		foreach ($records['records']->result() as $row)
		{
			$record_items[] = array(
				$row->id_hasil,
				$row->id_hasil,
				$row->id_sensus,
				$row->id_keluarga,
				$row->total_nilai,
				$row->id_kelas_sosial,
				'<button type="submit" class="btn btn-default btn-xs" title="Edit" onclick="edit_jawaban_sensus(\''.$row->id_hasil.'\')"/><i class="fa fa-pencil"></i></button>
				'
				//<button type="submit" class="btn btn-info btn-xs" title="Tampil Jawaban Sensus" onclick="tampil_jawaban_sensus(\''.$row->id_jawaban.'\')"/><i class="fa fa-eye"></i></button>
			);  
		}
		//Print please
		$this->output->set_output($this->flexigrid->json_build($records['record_count'],$record_items));
    }
}
?>