<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class C_jawaban_sensus extends CI_Controller {

    function  __construct()
    {
		parent::__construct();

        //Load flexigrid helper and library
        $this->load->helper('flexigrid_helper');
        $this->load->library('flexigrid');
        $this->load->helper('form');
		$this->load->helper('url');
        $this->load->model('m_jawaban_sensus');
		$this->load->model('m_pertanyaan_sensus');
		$this->load->model('m_kelassosial');
		$this->load->model('m_indikator_kesejahteraan');
		$this->load->model('m_sensus');
		$this->load->model('m_keluarga');
		$this->load->model('m_hasil_sensus');
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
        $colModel['id_keluarga'] = array('ID Keluarga',70,TRUE,'center',0);	
		$colModel['tanggal'] = array('Tanggal Sensus',120,TRUE,'left',2);
		$colModel['nama'] = array('Nama Kepala Keluarga',180,TRUE,'left',2);
		$colModel['is_locked'] = array('Konfirmasi',90,TRUE,'left',2);
        $colModel['aksi'] = array('AKSI',90,FALSE,'center',0);
		
		
		
		
		//Populate flexigrid buttons..
        //$buttons[] = array('Select All','check','btn');
		//$buttons[] = array('separator');
        //$buttons[] = array('DeSelect All','uncheck','btn');
        //$buttons[] = array('separator');
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

        $grid_js = build_grid_js('flex1',site_url('indikatorkesejahteraan/c_jawaban_sensus/load_data'),$colModel,'id_jawaban','asc',$gridParams);

		$data['js_grid'] = $grid_js;

        $data['page_title'] = 'DAFTAR KELUARGA YANG TELAH MELAKSANAKAN SENSUS';		
		$data['menu'] = $this->load->view('menu/v_indikatorkesejahteraan', $data, TRUE);
        $data['content'] = $this->load->view('data_jawaban_sensus/v_list', $data, TRUE);
        $this->load->view('utama', $data);
    }
	/**/
	function TampilJawaban($id)
	{
		$session['hasil'] = $this->session->userdata('logged_in');
		$role = $session['hasil']->role;
		if($this->session->userdata('logged_in') AND $role == 'Pengelola Sensus')
		{
			$data['id_jawaban'] = $id;
			$data['page_title'] = 'Tampil Jawaban Sensus';
			$data['jawaban'] = $this->m_jawaban_sensus->getJawaban($id);
			$data['menu'] = $this->load->view('menu/v_indikatorkesejahteraan', $data, TRUE);
			$data['content'] = $this->load->view('data_jawaban_sensus/v_detil', $data, TRUE);
        
			$this->load->view('utama', $data);
		}else
			redirect('c_login', 'refresh');
	}

    function load_data() {	
		$this->load->library('flexigrid');
        $valid_fields = array('id_jawaban','id_sensus','id_keluarga','id_pertanyaan_sensus','jawaban');

		$this->flexigrid->validate_post('id_jawaban','ASC',$valid_fields);
		$records = $this->m_jawaban_sensus->get_jawaban_sensus_flexigrid();
	
		$this->output->set_header($this->config->item('json_header'));
	
		$record_items = array();
		
		foreach ($records['records']->result() as $row)
		{
			$record_items[] = array(
				$row->id_keluarga,
				$row->id_keluarga,
				date('d-m-Y',strtotime($row->tanggal)),
				$row->nama,
				$this->lock($row->is_locked),
				//$row->id_pertanyaan_sensus,
				//$row->jawaban,
				'
				<button type="submit" class="btn btn-default btn-xs" title="lihat jawaban sensus" onclick="tampil_konfirmasi_sensus(\''.$row->id_sensus.'\',\''.$row->id_keluarga.'\')"/><i class="fa fa-eye"></i></button>
				<button type="submit" class="btn btn-success btn-xs" title="konfirmasi jawaban sensus" onclick="konfirmasi_sensus(\''.$row->id_keluarga.'\',\''.$row->id_sensus.'\')"/><i class="fa fa-exchange"></i></button>
				'
				//<button type="submit" class="btn btn-success btn-xs" title="konfirmasi jawaban sensus" onclick="edit_konfirmasi(\''.$row->id_keluarga.'\')"/><i class="fa fa-exchange"></i></button>
				//<button type="submit" class="btn btn-info btn-xs" title="Tampil Jawaban Sensus" onclick="tampil_jawaban_sensus(\''.$row->id_jawaban.'\')"/><i class="fa fa-eye"></i></button>
				//<button data-toggle="modal" href="#dialog-print" type="submit" class="btn btn-primary btn-xs" title="Cetak Hasil Sensus" onclick="cetak(\''.$row->id_keluarga.'\',\''.$row->id_sensus.'\')"/><i class="fa fa-print"></i></button>
			);  
		}
		//Print please
		$this->output->set_output($this->flexigrid->json_build($records['record_count'],$record_items));
    }
    function lock($val){
		if($val==1) return 'OK';
		else if($val==0) return '-';
	}
    function add($id){		
		$session['hasil'] = $this->session->userdata('logged_in');
		$role = $session['hasil']->role;
		if($this->session->userdata('logged_in') AND $role == 'Pengelola Sensus')
		{	
			$no_kk = $this->input->post('no_kk', TRUE);
			$nik = $this->input->post('nik',TRUE);
			$data['hasil'] = $this->m_sensus->getDataSensusByIdSensus($id); 
			$data['pertanyaan'] =$this->m_pertanyaan_sensus->getPertanyaan($id);
			$data['fuck'] = count($data['pertanyaan']);
			//$data['checkciri'] = $this->m_pertanyaan_sensus->getJawaban($data['pertanyaan']->id_pertanyaan);
				
			$string = '';
			$i = 0;
			foreach($data['pertanyaan'] as $rows)
			{
				$string = $string.'
				<input name="indikator_'.$i.'" value="'.$rows->bobot.'" type="hidden"></input>
				<input name="idInd_'.$i.'" value="'.$rows->idInd.'" type="hidden"></input>
				<input name="id_'.$i.'" value="'.$rows->id_pertanyaan.'" type="hidden"></input>
				<input name="i" value="'.$i.'" type="hidden"></input>
				<label>'.$rows->pertanyaan.'</label> <br>
				';
				
				$arrJawaban = $this->m_pertanyaan_sensus->getJawaban($rows->id_pertanyaan);
				foreach($arrJawaban as $jawaban)
				{
					$string = $string.'
						
						<input name = "jawab_'.$i.'" type="radio"  value="'.$jawaban->deskripsi.'" required="required"> '.$jawaban->deskripsi.'<br>
					
					';
							
				}
				$i++;
			}   
			$data['string'] = $string;
			
			$data['page_title'] = 'Tambah Jawaban Sensus';
			$data['json_array'] = $this->autocomplete_KepalaKeluarga();	
			$data['menu'] = $this->load->view('menu/v_indikatorkesejahteraan', $data, TRUE);
			$data['content'] = $this->load->view('data_jawaban_sensus/v_tambah', $data, TRUE);
			$this->load->view('utama', $data);
		}else
			redirect('c_login', 'refresh');
        
    }
	
	function simpan_tambah_jawaban() {
		$data['id_sensus'] = $this->input->post('id_sensus');
		$data1['id_sensus'] = $this->input->post('id_sensus');
		$data['no_kk'] = $this->input->post('no_kk');
		$ciri = $this->input->post('ciri',TRUE);
		$data['id_keluarga'] = $this->m_keluarga->getIdKeluargaByNoKK1($data['no_kk']);
		$data1['id_keluarga'] = $this->m_keluarga->getIdKeluargaByNoKK1($data['no_kk']);
		$data['nama'] = $this->input->post('nama');
		$lenght = $this->input->post('i');
		for($i=0;$i<=$lenght;$i++)
		{
			$data['id_pertanyaan_sensus'] = $this->input->post('id_'.$i);
			$data['jawaban'] = $this->input->post('jawab_'.$i);
			$data['id_indikator'] = $this->input->post('idInd_'.$i);
			$data2['indikator'] = $this->input->post('indikator_'.$i);
			$data2['bobot'] = $this->m_pilihan_jawaban->get_bobot($data['id_sensus'],$data['jawaban']);
			$data['nilai_bobot'] = $data2['bobot'] * $data2['indikator'];
			$data['is_locked'] = 0;
			$this->m_jawaban_sensus->insertJawabanSensus($data); 
			
		}
		$this->total($data1['id_keluarga'],$data1['id_sensus']);
		redirect('indikatorkesejahteraan/c_jawaban_sensus', 'refresh');
	}
	
	function total($id,$id_sensus)
	{
		$data['total_nilai'] = $this->m_jawaban_sensus->total_nilai($id,$id_sensus);
		$data['id_keluarga'] = $id;
		$data['id_sensus'] = $id_sensus;
		if($data['total_nilai'] == $this->m_kelassosial->getNilaiAwal(0) && $data['total_nilai'] == $this->m_kelassosial->getNilaiAkhir(0))
		{
			$data['id_kelas_sosial'] = "0";
			$data['status'] = $this->m_kelassosial->getDeskripsi(0);
		}
		else if($data['total_nilai'] >= $this->m_kelassosial->getNilaiAwal(1) && $data['total_nilai'] <= $this->m_kelassosial->getNilaiAkhir(1))
		{
			$data['id_kelas_sosial'] = "1";
			$data['status'] = $this->m_kelassosial->getDeskripsi(1);
		}
		else if($data['total_nilai'] >= $this->m_kelassosial->getNilaiAwal(2) && $data['total_nilai'] <= $this->m_kelassosial->getNilaiAkhir(2))
		{
			$data['id_kelas_sosial'] = "2";
			$data['status'] = $this->m_kelassosial->getDeskripsi(2);
		}
		else if($data['total_nilai'] >= $this->m_kelassosial->getNilaiAwal(3) && $data['total_nilai'] <= $this->m_kelassosial->getNilaiAkhir(3))
		{
			$data['id_kelas_sosial'] = "3";
			$data['status'] = $this->m_kelassosial->getDeskripsi(3);
		} 
		else
		{
			$data['id_kelas_sosial'] = "4";
			$data['status'] = $this->m_kelassosial->getDeskripsi(4);
		} 
		$this->m_hasil_sensus->cekId($id,$data);
	}
	
	function totalEdit($id,$id_sensus)
	{
		$data['total_nilai'] = $this->m_jawaban_sensus->total_nilai($id,$id_sensus);
		$id_keluarga = $id;
		$data['id_sensus'] = $id_sensus;
		if($data['total_nilai'] == $this->m_kelassosial->getNilaiAwal(0) && $data['total_nilai'] == $this->m_kelassosial->getNilaiAkhir(0))
		{
			$data['id_kelas_sosial'] = "0";
			$data['status'] = $this->m_kelassosial->getDeskripsi(0);
		}
		else if($data['total_nilai'] >= $this->m_kelassosial->getNilaiAwal(1) && $data['total_nilai'] <= $this->m_kelassosial->getNilaiAkhir(1))
		{
			$data['id_kelas_sosial'] = "1";
			$data['status'] = $this->m_kelassosial->getDeskripsi(1);
		}
		else if($data['total_nilai'] >= $this->m_kelassosial->getNilaiAwal(2) && $data['total_nilai'] <= $this->m_kelassosial->getNilaiAkhir(2))
		{
			$data['id_kelas_sosial'] = "2";
			$data['status'] = $this->m_kelassosial->getDeskripsi(2);
		}
		else if($data['total_nilai'] >= $this->m_kelassosial->getNilaiAwal(3) && $data['total_nilai'] <= $this->m_kelassosial->getNilaiAkhir(3))
		{
			$data['id_kelas_sosial'] = "3";
			$data['status'] = $this->m_kelassosial->getDeskripsi(3);
		} 
		else
		{
			$data['id_kelas_sosial'] = "4";
			$data['status'] = $this->m_kelassosial->getDeskripsi(4);
		} 
		$arr = array ('id_keluarga' => $id_keluarga,
					'id_sensus' =>  $id_sensus);
		$this->m_hasil_sensus->updateHasilSensus($arr, $data);
	}
	
	

	
	public function autocomplete_KepalaKeluarga()
    {
        $nama = $this->input->post('nama',TRUE);
        $rows = $this->m_jawaban_sensus->getKepalaKeluargaLikeNama($nama);
        $json_array = array();
        foreach ($rows as $row)
		{
            $json_array[]= $row->no_kk.' | '.$row->nama.' | '.$row->nik ;
		}
        return json_encode($json_array);
    }

    function edit($id,$id_keluarga,$id_sensus){
		$session['hasil'] = $this->session->userdata('logged_in');
		$role = $session['hasil']->role;
		if($this->session->userdata('logged_in') AND $role == 'Pengelola Sensus')
		{
			$data['hasil'] = $this->m_jawaban_sensus->getJawabanSensusByIdPertanyaanSensus($id,$id_keluarga);
			$data['pertanyaan'] = $this->m_pertanyaan_sensus->getPertanyaanSensusEdit($id);
			$data['fuck'] = count($data['pertanyaan']);
			$data['jwb'] = $this->m_jawaban_sensus->getJawabanEdit($id_keluarga,$id,$id_sensus);	
			$string2 = '';
			$checked = '';
			$lalatx = $data['jwb'];
			foreach($data['jwb'] as $lala)
			{
				$checked = $lala->jawaban;
				$string2 = $string2.'
						
						<input name = "jawablala" id="lala" type="hidden"  value="'.$lala->jawaban.'"><br>
						
					
					';
			}
			$string = '';
			$i = 0;
			foreach($data['pertanyaan'] as $rows)
			{
				$string = $string.'
				<input name="indikator_'.$i.'" value="'.$rows->bobot.'" type="hidden"></input>
				<input name="idInd_'.$i.'" value="'.$rows->idInd.'" type="hidden"></input>
				<input name="id_'.$i.'" value="'.$rows->id_pertanyaan.'" type="hidden"></input>
				<input name="i" value="'.$i.'" type="hidden"></input>
				<label>'.$rows->pertanyaan.'</label> <br>
				';
				
				$arrJawaban = $this->m_pertanyaan_sensus->getJawaban($rows->id_pertanyaan);
				foreach($arrJawaban as $jawaban)
				{
					if($checked == $jawaban->deskripsi){
						$string = $string.'
						
						<input name = "jawab_'.$i.'" type="radio"  value="'.$jawaban->deskripsi.'" checked> '.$jawaban->deskripsi.'<br>
						
					
					';
					}else{
						$string = $string.'
						
						<input name = "jawab_'.$i.'" type="radio"  value="'.$jawaban->deskripsi.'"> '.$jawaban->deskripsi.'<br>
						
					
					';
					}
					
							
				}
				$i++;
			}   
			$data['string'] = $string;
			$data['string2'] = $string2;
			$data['page_title'] = 'Edit Jawaban Sensus';
			$data['menu'] = $this->load->view('menu/v_indikatorkesejahteraan', $data, TRUE);
			$data['content'] = $this->load->view('data_jawaban_sensus/v_ubah', $data, TRUE);
			$this->load->view('utama', $data);
		}else
			redirect('c_login', 'refresh');
    }
	
	function update_jawaban_sensus() {	
		
		$id_jawaban = $this->input->post('id_jawaban', TRUE);
		$id_sensus = $this->input->post('id_sensus', TRUE);
		$id_keluarga = $this->input->post('id_keluarga', TRUE);
		$id_pertanyaan_sensus = $this->input->post('id_pertanyaan_sensus', TRUE);
		$jawaban = $this->input->post('jawab_0', TRUE);
		$id_indikator = $this->input->post('idInd_0', TRUE);
		$indikator = $this->input->post('indikator_0');
		$bobot = $this->m_pilihan_jawaban->get_bobot($id_sensus,$jawaban);
		$nilai_bobot = $bobot * $indikator;
			$data = array(
					'id_jawaban' => $id_jawaban,
					'id_sensus' => $id_sensus,
					'id_indikator' => $id_indikator,
					'id_keluarga' => $id_keluarga,
					'id_pertanyaan_sensus' => $id_pertanyaan_sensus,
					'jawaban' => $jawaban,
					'nilai_bobot' => $nilai_bobot
				);
			//echo json_encode($jawaban);
			$arr = array ('id_jawaban' => $id_jawaban,
					'id_sensus' =>  $id_sensus);
		  $result = $this->m_jawaban_sensus->updateJawabanSensus($arr, $data);
		  $this->totalEdit($id_keluarga,$id_sensus);
		 redirect('indikatorkesejahteraan/c_jawaban_sensus/konfirmasi/'.$id_sensus.'/'.$id_keluarga);
    }
	
	function delete($id_keluarga,$id)    {
        /* $post = explode(",", $this->input->post('items'));
        array_pop($post); $sucess=0;
        foreach($post as $id){
            $this->m_jawaban_sensus->deleteJawabanSensus($id);
			$this->m_hasil_sensus->deleteHasilSensus($id);
            $sucess++; */
			$this->m_jawaban_sensus->deleteJawabanSensus($id_keluarga,$id);
			$this->m_hasil_sensus->deleteHasilSensus($id_keluarga,$id);
			redirect('indikatorkesejahteraan/c_jawaban_sensus', 'refresh');
    }
	
	function konfirmasi($id,$id_keluarga){		
		$session['hasil'] = $this->session->userdata('logged_in');
		$role = $session['hasil']->role;
		if($this->session->userdata('logged_in') AND $role == 'Pengelola Sensus')
		{	
			$data['pertanyaan'] = $this->m_pertanyaan_sensus->getPertanyaanByIDKeluarga($id,$id_keluarga);
			$data['locked']= $this->m_jawaban_sensus->getLock($id_keluarga);
			$data['status'] = $this->m_hasil_sensus->getStatusByIDKeluarga($id_keluarga,$id);
			$data['id_keluarga'] = $id_keluarga;
			$data['page_title'] = 'Konfirmasi Jawaban Sensus';
			$data['menu'] = $this->load->view('menu/v_indikatorkesejahteraan', $data, TRUE);
			$data['content'] = $this->load->view('data_jawaban_sensus/v_detil', $data, TRUE);
			//echo json_encode($data['locked']);
		
			$this->load->view('utama', $data);
		}else
			redirect('c_login', 'refresh');
        }
		
	function updateIsLock(){
		//$this->m_jawaban_sensus->updateIsLocked($id_keluarga);
		$id = $this->input->post('items');
		$success = 0;
		$lock = $this->m_jawaban_sensus->getLock($id);
		$this->m_jawaban_sensus->updateIsLocked($id,$lock);
		$success++;
		redirect('indikatorkesejahteraan/c_jawaban_sensus', 'refresh');
	}
}
?>