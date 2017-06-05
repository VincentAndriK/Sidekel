<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class C_pertanyaan_sensus extends CI_Controller {

    function  __construct()
    {
		parent::__construct();

        //Load flexigrid helper and library
        $this->load->helper('flexigrid_helper');
        $this->load->library('flexigrid');
        $this->load->helper('form');
		$this->load->helper('download');
        $this->load->helper('file');
		$this->load->model('m_pertanyaan_sensus');
		$this->load->model('m_indikator_kesejahteraan');
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

    function lists() {
        $colModel['id_pertanyaan'] = array('ID',20,TRUE,'center',0);	
		$colModel['indikator'] = array('Indikator',150,TRUE,'left',2);
		$colModel['tanggal'] = array('Tanggal Sensus',120,TRUE,'left',2);
		$colModel['pertanyaan'] = array('Pertanyaan',320,TRUE,'left',2);
        $colModel['aksi'] = array('AKSI',70,FALSE,'center',0);
		
		//Populate flexigrid buttons..
        $buttons[] = array('Select All','check','btn');
		$buttons[] = array('separator');
        $buttons[] = array('DeSelect All','uncheck','btn');
        //$buttons[] = array('separator');
		//$buttons[] = array('Add','add','btn');
        //$buttons[] = array('separator');
        //$buttons[] = array('Delete Selected Items','delete','btn');
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

        $grid_js = build_grid_js('flex1',site_url('indikatorkesejahteraan/c_pertanyaan_sensus/load_data'),$colModel,'id_pertanyaan','asc',$gridParams,$buttons);

		$data['js_grid'] = $grid_js;

        $data['page_title'] = 'DATA PERTANYAAN SENSUS';		
		$data['menu'] = $this->load->view('menu/v_indikatorkesejahteraan', $data, TRUE);
        $data['content'] = $this->load->view('data_sensus/v_list_pertanyaan', $data, TRUE);
        $this->load->view('utama', $data);
    }

    function load_data() {	
		$this->load->library('flexigrid');
        $valid_fields = array('id_pertanyaan','indikator','id_sensus','pertanyaan');

		$this->flexigrid->validate_post('id_pertanyaan','ASC',$valid_fields);
		$records = $this->m_pertanyaan_sensus->get_pertanyaan_sensus_flexigrid();
	
		$this->output->set_header($this->config->item('json_header'));
	
		$record_items = array();
		
		foreach ($records['records']->result() as $row)
		{
			$record_items[] = array(
				$row->id_pertanyaan,
				$row->id_pertanyaan,
				$row->indikator,
				$row->tanggal,
				$row->pertanyaan,
				'<button type="submit" class="btn btn-default btn-xs" title="Edit" onclick="edit_pertanyaan_sensus(\''.$row->id_pertanyaan.'\')"/><i class="fa fa-pencil"></i></button>
				<button type="submit" class="btn btn-danger btn-xs" title="hapus" onclick="hapus_pertanyaan(\''.$row->id_pertanyaan.'\')"/><i class="fa fa-trash-o"></i></button>
				'
			);  
		}
		//Print please
		$this->output->set_output($this->flexigrid->json_build($records['record_count'],$record_items));
    }
	
	 function ImportToExcel()//f
	{
		if($this->session->userdata('logged_in'))
		{
			$data['flashmessage'] = '1';
			$s['cek'] = $this->session->userdata('logged_in');
			$data['page_title'] = 'Import Pertanyaan Sensus';
			$data['menu'] = $this->load->view('menu/v_indikatorkesejahteraan', $data, TRUE);
			$data['content'] = $this->load->view('data_sensus/v_import', $data, TRUE);		
			
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
				
				redirect('indikatorkesejahteraan/c_pertanyaan_sensus', 'refresh');
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
					$result['cek_pertanyaan'] = $this->m_pertanyaan_sensus->cekPertanyaanExist($data['cells'][$i][2]);
					
					$indikator = $data['cells'][$i][1];
					$id_indikator = $this->m_pertanyaan_sensus->getIdIndikator($indikator);
					
					
					//$id_pertanyaan = $this->cekNull($id_pertanyaan);
					
					$sensus = $data['cells'] [$i] [3];
					$id_sensus = $this->m_pertanyaan_sensus->getIdSensus($sensus);
					
					
					/* if($data['cells'][$i][4] == '')
					{
						break;
					}
					else
					{
						$pilihan1 = $data['cells'] [$i] [4];	
					}
					
					if($data['cells'][$i][5] == '')
					{
						break;
					}
					else
					{
						$bobot1 = $data['cells'] [$i] [5];
					}
					
					 if($data['cells'][$i][6] == '')
					{
						break;
					}
					else
					{
						$pilihan2 = $data['cells'] [$i] [6];
					}
					
					if($data['cells'][$i][7] == '')
					{
						break;
					}
					else
					{
						$bobot2 = $data['cells'] [$i] [7];
					}
					
					if($data['cells'][$i][8] == '')
					{
						break;
					}
					else
					{
						$pilihan3 = $data['cells'] [$i] [8];
					}
					
					if($data['cells'][$i][9] == '')
					{
						break;
					}
					else
					{
						$bobot3 = $data['cells'] [$i] [9];
					}
					
					if($data['cells'][$i][10] == '')
					{
						break;
					}
					else
					{
						$pilihan4 = $data['cells'] [$i] [10];
					}
					
					if($data['cells'][$i][11] == '')
					{
						break;
					}
					else
					{
						$bobot4 = $data['cells'] [$i] [11];
					}
					
					if($data['cells'][$i][12] == '')
					{
						break;
					}
					else
					{
						$pilihan5 = $data['cells'] [$i] [12];
					}
					
					if($data['cells'][$i][13] == '')
					{
						break;
					}
					else
					{
						$bobot5 = $data['cells'] [$i] [13];
					} */
					
					$dataPertanyaan = Array(
						'id_indikator' => $id_indikator,
						'pertanyaan' => $data['cells'][$i][2],
						'id_sensus' => $id_sensus
						);
						$this->m_pertanyaan_sensus->insertPertanyaanSensus($dataPertanyaan); 
						
						$pertanyaan = $data['cells'] [$i] [2];
						$id_pertanyaan = $this->m_pertanyaan_sensus->getIdPertanyaan($pertanyaan);
					$j =4;
					do
					{
						if($data['cells'] [$i] [$j] == '')
						{
							break;
						}
						else
						{
							$k = $j+1;
							$pilihan1 = $data['cells'] [$i] [$j];
							$bobot1 = $data['cells'] [$i] [$k];
							$dataPilihan = Array(
							'id_indikator' => $id_indikator,
							'id_sensus' => $id_sensus,
							'id_pertanyaan' => $id_pertanyaan,
							'deskripsi' => $pilihan1,
							'bobot' => $bobot1
							);
							$this->m_pilihan_jawaban->insertPilihanJawaban($dataPilihan);
						}
						$j = $j + 2;
					}while($j <= 13);
					
					
					//Insert Data Pertanyaan Sensus
						
					//Insert Data Pilihan Jawaban
					
						
				}
			}          
            delete_files($upload_data['file_path']);
            redirect('indikatorkesejahteraan/c_pertanyaan_sensus', 'refresh');
		}
			
	}
	
	function cekNull($parameter)
	{
		if($parameter==NULL)
		{return 0;}
		else return $parameter;
	}

    function edit($id){
		$session['hasil'] = $this->session->userdata('logged_in');
		$role = $session['hasil']->role;
		if($this->session->userdata('logged_in') AND $role == 'Pengelola Sensus')
		{
			$data['id_indikator'] = $this->m_indikator_kesejahteraan->get_indikator();
			$data['pilihan'] =$this->m_pertanyaan_sensus->getPertanyaanEdit($id);
			
			$data['hasil'] = $this->m_pertanyaan_sensus-> getPertanyaanSensusByIdPertanyaan($id);
			
			
			
			$data['page_title'] = 'Edit Pertanyaan Sensus';
			$data['menu'] = $this->load->view('menu/v_indikatorkesejahteraan', $data, TRUE);
			$data['content'] = $this->load->view('data_sensus/v_ubah_pertanyaan', $data, TRUE);
        
			$this->load->view('utama', $data);
		}else
			redirect('c_login', 'refresh');
    }
	
	function update_pertanyaan_sensus() {	
		
		$id_pertanyaan = $this->input->post('id_pertanyaan', TRUE);
		$id_indikator = $this->input->post('id_indikator', TRUE);
		$id_sensus = $this->input->post('id_sensus', TRUE);
		$pertanyaan = $this->input->post('pertanyaan', TRUE);
		$row = $this->input->post('rows');
		$data = array(
				'id_pertanyaan' => $id_pertanyaan,
				'id_indikator' => $id_indikator,
				'id_sensus' => $id_sensus,
				'pertanyaan' => $pertanyaan);
		$result = $this->m_pertanyaan_sensus->updatePertanyaanSensus(array('id_pertanyaan' => $id_pertanyaan), $data);
		$data3['pilihan'] =$this->m_pertanyaan_sensus->getPertanyaanEdit($id_pertanyaan);
		$temp = count($data3['pilihan']);
		for($i=1;$i<=$temp;$i++)
		{
			$id = $this->input->post('id_'.$i);
			$deskripsi = $this->input->post('Pilihan_'.$i);
			$bobot = $this->input->post('Bobot_'.$i);
			$data1 = array(
				'id' => $id,
				'id_pertanyaan' => $id_pertanyaan,
				'id_indikator' => $id_indikator,
				'id_sensus' => $id_sensus,
				'deskripsi' => $deskripsi,
				'bobot' => $bobot);
		$result1 = $this->m_pilihan_jawaban->updatePilihanJawaban(array('id_pertanyaan' => $id_pertanyaan),array('id' => $id), $data1);
			
		}
		$row = $this->input->post('rows');	
		for($i=1;$i<=$row;$i++)
		{
			$desc = $this->input->post('jawaban_'.$i);
			$nil = $this->input->post('nilai_'.$i);
			$data2 = array(
				'id_pertanyaan' => $id_pertanyaan,
				'id_indikator' => $id_indikator,
				'id_sensus' => $id_sensus,
				'deskripsi' => $desc,
				'bobot' => $nil);
				//echo json_encode($data2);
			$result2 = $this->m_pilihan_jawaban->insertPilihanJawaban($data2);			
		}
		redirect('indikatorkesejahteraan/c_pertanyaan_sensus','refresh');
			
		
    }
	
	function delete($id)    {
        /* $post = explode(",", $this->input->post('items'));
        array_pop($post); $sucess=0;
        foreach($post as $id){
			$this->m_pilihan_jawaban->deletePilihanJawaban($id);
            $this->m_pertanyaan_sensus->deletePertanyaanSensus($id);
            $sucess++;
        } */
		$this->m_pertanyaan_sensus->updateIsDelete($id);
        redirect('indikatorkesejahteraan/c_pertanyaan_sensus', 'refresh');
    }
}
?>