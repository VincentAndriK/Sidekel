<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class C_rumah_warga extends CI_Controller {

    function  __construct()
    {
		parent::__construct();

        //Load flexigrid helper and library
        $this->load->helper('flexigrid_helper');
        $this->load->library('flexigrid');
        $this->load->helper('form');
		$this->load->helper('url');
		$this->load->helper('download');
        $this->load->helper('file');
        $this->load->model('m_jawaban_sensus');
		$this->load->model('m_keluarga');
		$this->load->model('m_rumah_warga');
		$this->load->model('m_peta');
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
        $colModel['tbl_keluarga.id_keluarga'] = array('ID Keluarga',70,TRUE,'center',0);
        $colModel['no_kk'] = array('No KK',150,TRUE,'left',2);
		$colModel['tbl_penduduk.nama'] = array('Nama kepala keluarga',200,TRUE,'left',1);
		$colModel['tbl_keluarga.koordinat_polygon'] = array('Koordinat Polygon',200,TRUE,'left',1);
        $colModel['aksi'] = array('AKSI',120,FALSE,'center',0);
		
		//Populate flexigrid buttons..
        $buttons[] = array('Select All','check','btn');
		$buttons[] = array('separator');
        $buttons[] = array('DeSelect All','uncheck','btn');
        $buttons[] = array('separator');
		//$buttons[] = array('Add','add','btn');
        //$buttons[] = array('separator');
        //$buttons[] = array('Delete Selected Items','delete','btn');
        //$buttons[] = array('separator');
       		
        $gridParams = array(
            'height' => 400,
            'rp' => 15,
            'rpOptions' => '[10,20,30,40]',
            'pagestat' => 'Displaying: {from} to {to} of {total} items.',
            'blockOpacity' => 0.5,
            'title' => '',
            'showTableToggleBtn' => false
	);

        $grid_js = build_grid_js('flex1',site_url('indikatorkesejahteraan/c_rumah_warga/load_data'),$colModel,'tbl_keluarga.id_keluarga','asc',$gridParams,$buttons);
		
		$data['js_grid'] = $grid_js;

        $data['page_title'] = 'DATA KELUARGA';		
		$data['menu'] = $this->load->view('menu/v_indikatorkesejahteraan', $data, TRUE);
        $data['content'] = $this->load->view('rumah_warga/v_list', $data, TRUE);
        $this->load->view('utama', $data);
    }
	
	function ImportToExcel()//f
	{
		if($this->session->userdata('logged_in'))
		{
			$data['flashmessage'] = '1';
			$s['cek'] = $this->session->userdata('logged_in');
			$data['page_title'] = 'Import Koordinat Marker';
			$data['menu'] = $this->load->view('menu/v_indikatorkesejahteraan', $data, TRUE);
			$data['content'] = $this->load->view('rumah_warga/v_import', $data, TRUE);		
			
			$this->load->view('utama', $data);
		}else
			redirect('c_login', 'refresh');
	}
	
	function import_excel()//
	{
		$config['upload_path'] = "./temp_upload_excel/";
		$config['allowed_types'] = "xls|xlsx";
                
		$this->load->library('upload',$config);
		

		if ( ! $this->upload->do_upload())
		{
			if($this->session->userdata('logged_in'))
			{
				
				redirect('indikatorkesejahteraan/c_rumah_warga', 'refresh');
			}else
				redirect('c_login', 'refresh');
		}
		else
		{
            $data = array('error' => false);
			$upload_data = $this->upload->data();

            $this->load->library('excel_reader');
			$this->excel_reader->setOutputEncoding('CP1251');

			$file =  $upload_data['full_path'];
			$this->excel_reader->read($file);
			error_reporting(E_ALL ^ E_NOTICE);

			// Sheet 1
			$data = $this->excel_reader->sheets[0] ;         
			for ($i = 2; $i <= $data['numRows']; $i++) 
			{
				if($data['cells'][$i][1] == '') 
				break;
				else
				{	
					$id_keluarga = $data['cells'][$i][1];
					
					$koordinat = $data['cells'] [$i] [2];
					
					//Insert Data Koordinat Marker
						/* $dataKoordinat = Array(
						'koordinat_marker' => $koordinat
						);
						echo json_encode($koordinat); */
						$this->m_rumah_warga->updateKoordinatMarker($id_keluarga,$koordinat); 
				}
			}          
            delete_files($upload_data['file_path']);
            redirect('indikatorkesejahteraan/c_rumah_warga', 'refresh');
		}
			
	}

    function load_data() {	
		$this->load->library('flexigrid');
		$valid_fields = array('tbl_keluarga.id_keluarga','no_kk','tbl_penduduk.nama','alamat_jalan','ref_rt.nomor_rt','ref_rw.nomor_rw','ref_dusun.nama_dusun');
		//$valid_fields = array('id_keluarga');
		$this->flexigrid->validate_post('tbl_keluarga.id_keluarga','asc',$valid_fields);
		$records = $this->m_rumah_warga->get_keluarga_flexigrid();
	
		$this->output->set_header($this->config->item('json_header'));
	
			$record_items = array();	
		foreach ($records['records']->result() as $row)
		{
			$record_items[] = array(
				$row->id_keluarga,
                $row->id_keluarga,
				$row->no_kk,
                $row->nama,
				$row->koordinat_polygon,
				
'<button type="submit" class="btn btn-success btn-xs" title="Tambah Rumah Warga" onclick="tambah_data_rumah(\''.$row->id_keluarga.'\')"/><i class="fa fa-plus-square"></i></button>
<button type="submit" class="btn btn-default btn-xs" title="Edit" onclick="edit_keluarga(\''.$row->id_keluarga.'\')"/><i class="fa fa-pencil"></i></button>
<button type="submit" class="btn btn-danger btn-xs" title="hapus" onclick="hapus_koordinat(\''.$row->id_keluarga.'\')"/><i class="fa fa-trash-o"></i></button>
'
			);  
		}
		
		$this->output->set_output($this->flexigrid->json_build($records['record_count'],$record_items));
    }
    
    function add($id){		
		$session['hasil'] = $this->session->userdata('logged_in');
		$role = $session['hasil']->role;
		if($this->session->userdata('logged_in') AND $role == 'Pengelola Sensus')
		{	
			$data['peta'] = $this->m_peta->getPeta();
			$data['batas_wilayah'] = $this->m_peta->getBatasWilayah();
			$data['tampil'] = json_encode($this->m_rumah_warga->tampilPolygon());
			$data['penduduk'] = $this->m_rumah_warga->getPendudukByIdKepalaKeluarga($id);
			$data['id'] = $this->m_keluarga->getKeluargaById($id);
			$data['page_title'] = 'Tambah Rumah Warga';
			$data['menu'] = $this->load->view('menu/v_indikatorkesejahteraan');
			$data['content'] = $this->load->view('rumah_warga/v_tambah',$data,TRUE);
			$this->load->view('utama', $data);
			//echo $data['tampil'];
		}else
			redirect('c_login', 'refresh');
    }
	
	function simpan_rumah_warga() {
		$id_keluarga = $this->input->post('idd');
		$koordinat = $this->input->post('koor');
		$str = str_replace("(", "[", $koordinat);
                $str = str_replace(")", "]", $str);
                $newstring = substr_replace($str, "[", 0, 0);
                $replacement = "]]"; 
                $final = substr($newstring, 0, -1).$replacement;
		$result = $this->m_rumah_warga->updateKoordinat($id_keluarga,$final);
		//echo $final;
		redirect('indikatorkesejahteraan/c_rumah_warga', 'refresh');
	}

    function edit($id){
		$session['hasil'] = $this->session->userdata('logged_in');
		$role = $session['hasil']->role;
		if($this->session->userdata('logged_in') AND $role == 'Pengelola Sensus')
		{
			$data['peta'] = $this->m_peta->getPeta();
			$data['batas_wilayah'] = $this->m_peta->getBatasWilayah();
			$data['penduduk'] = $this->m_rumah_warga->getPendudukByIdKepalaKeluarga($id);
			$data['id'] = $this->m_keluarga->getKeluargaById($id);
			$data['kel'] = $this->m_keluarga->getKeluargaById($id);
			$data['kor'] = $data['kel']->koordinat_polygon;
			
			$str = str_replace("[", "(", $data['kel']->koordinat_polygon);
            $str = str_replace("]", ")", $str); 
            $newstring = substr_replace($str, "", 0, 0);
            $replacement = ""; 
            $final = substr($newstring, 0, -1).$replacement;
            $final = str_replace("((", "(", $final);
            $data['koordinat_asli'] = $final;
            $final = str_replace("(", "new google.maps.LatLng(", $final);

            $data['kor'] = $final;
			$data['page_title'] = 'Edit Rumah Warga';
			$data['menu'] = $this->load->view('menu/v_indikatorkesejahteraan');
			$data['content'] = $this->load->view('rumah_warga/v_ubah',$data,TRUE);
			$this->load->view('utama', $data);
		}else
			redirect('c_login', 'refresh');
    }
	
	function update_rumah_warga(){	
		$id_keluarga = $this->input->post('idd');
		$koordinat = $this->input->post('koor');
		$str = str_replace("(", "[", $koordinat);
                $str = str_replace(")", "]", $str);
                $newstring = substr_replace($str, "[", 0, 0);
                $replacement = "]]"; 
                $final = substr($newstring, 0, -1).$replacement;
		$result = $this->m_rumah_warga->updateKoordinat($id_keluarga,$final);
		redirect('indikatorkesejahteraan/c_rumah_warga', 'refresh');
    }
	
	function delete($id){
		$this->m_rumah_warga->updateHapus($id);
		//$this->m_rumah_warga->updateHapuslala($id);
		redirect('indikatorkesejahteraan/c_rumah_warga', 'refresh');
    }
}
?>