<?php
class M_jawaban_sensus extends CI_Model {

   function __construct()
  {
    parent::__construct();
    $this->_table='tbl_jawaban_sensus';
	
    //get instance
    $this->CI = get_instance();
  }
	public function get_jawaban_sensus_flexigrid()
    {
        //Build contents query
        $this->db->select('tbl_sensus.tanggal_sensus as tanggal,
		tbl_pertanyaan_sensus.pertanyaan as pertanyaan,
		tbl_jawaban_sensus.*')->from($this->_table) ;
		$this->db->join('tbl_sensus','tbl_sensus.id_sensus = tbl_jawaban_sensus.id_sensus');
		$this->db->join('tbl_pertanyaan_sensus','tbl_pertanyaan_sensus.id_pertanyaan = tbl_jawaban_sensus.id_pertanyaan_sensus');
        //$this->db->where('id_jawaban !=', 0);
		//$this->db->where('is_locked !=',1);
		$this->db->group_by('tbl_jawaban_sensus.id_keluarga');
		$this->db->group_by('tbl_jawaban_sensus.id_sensus');
		$this->CI->flexigrid->build_query();
		
		

        //Get contents
        $return['records'] = $this->db->get();
		
        //Build count query
        $this->db->select("count(id_jawaban) as record_count")->from($this->_table);
        $this->db->where('id_jawaban !=', 0);
		//$this->db->where('is_locked !=',1);
        $this->CI->flexigrid->build_query(FALSE);
        $record_count = $this->db->get();
		$this->db->group_by('tbl_jawaban_sensus.id_keluarga');
		//$this->db->group_by('tbl_jawaban_sensus.id_sensus');
        $row = $record_count->row();

        //Get Record Count
        $return['record_count'] = $row->record_count;

        //Return all
        return $return;
    }
  function insertJawabanSensus($data)
  {
    $this->db->insert($this->_table, $data);
  }
  
  function deleteJawabanSensus($id,$id_sensus)
  {
    $this->db->where('id_keluarga', $id);
	$this->db->where('id_sensus', $id_sensus);
    $this->db->delete($this->_table);
  }
  
  function getJawabanSensusByIdPertanyaanSensus($id,$id_keluarga) //edit
  {	
    /* $this->db->select('tbl_jawaban_sensus.*')->from('tbl_jawaban_sensus');
	$this->db->where('id_pertanyaan_sensus',$id);
	$q = $this->db->get();
	return $q->result(); */
	return $this->db->get_where($this->_table,array('id_pertanyaan_sensus' => $id,'id_keluarga' => $id_keluarga))->row();
  }
  
  function updateJawabanSensus($where,$data) //update
  {
    $this->db->where($where);
    $this->db->update($this->_table, $data);
    return $this->db->affected_rows();
  }
  
	function cekFIleExist($deskripsi)
	{	
		return $this->db->get_where($this->_table,array('jawaban' => $deskripsi))->row();
	}
	
	function get_IdIndikator() 
	{      
		$this->db->where('id_indikator !=','0');
      	$records = $this->db->get('ref_indikator_kesejahteraan');
   		$data=array();
        foreach ($records->result() as $row)
        {	
			$data[''] = '--Pilih--';
        	$data[$row->id_indikator] = $row->deskripsi;
        }
        return ($data);
    }
	
	function getKepalaKeluargaLikeNama($nama)
	{
		$this->db->select('tbl_penduduk.nama, tbl_keluarga.no_kk, tbl_penduduk.nik');
		$this->db->join('tbl_penduduk','tbl_penduduk.id_penduduk = tbl_keluarga.id_kepala_keluarga','left');
		$this->db->join('ref_status_penduduk','tbl_penduduk.id_status_penduduk = ref_status_penduduk.id_status_penduduk');
		$this->db->where('ref_status_penduduk.deskripsi <>','Meninggal');
		$this->db->like('tbl_penduduk.nama', $nama);
		$query = $this->db->get('tbl_keluarga');
		return $query->result();
	}
	
	function getJawaban($id)
	{
		$this->db->select(
		'tbl_jawaban_sensus.* , 
		')->from('tbl_jawaban_sensus');
		$this->db->where('tbl_jawaban_sensus.id_sensus', $id);		
		$q = $this->db->get();
		return $q->result();
	}
	
	function getLocked($id,$idkel)
	{
		$this->db->select(
		'tbl_jawaban_sensus.is_locked , 
		')->from('tbl_jawaban_sensus');
		$this->db->where('tbl_jawaban_sensus.id_sensus', $id);
		$this->db->where('tbl_jawaban_sensus.id_keluarga', $idkel);
		$this->db->limit(1);
		$q = $this->db->get();
		return $q->row()->is_locked;
	}
	
	
	function total_nilai($id_keluarga,$id)
	{
		$this->db->select_sum('nilai_bobot');
		$this->db->where('id_keluarga',$id_keluarga);
		$this->db->where('id_sensus',$id);
		$this->db->group_by('id_keluarga');
		$q = $this->db->get('tbl_jawaban_sensus');
		return $q->row()->nilai_bobot;  
		
	}
	
	function getJawabanByIdKeluarga($id)
	{
		$this->db->select(
		'
		tbl_jawaban_sensus.*
		')->from('tbl_jawaban_sensus');
		$this->db->join('tbl_sensus','tbl_sensus.id_sensus = tbl_jawaban_sensus.id_sensus');
		$this->db->where('tbl_jawaban_sensus.id_keluarga', $id);		
		$q = $this->db->get();
		return $q->result();
	}
	
	function updateIsLocked($id_keluarga,$lock) //update
	{
		if($lock == 0)
		{
			$this->db->where(array('id_keluarga' => $id_keluarga));
			$this->db->update($this->_table, array('is_locked' => 1));
			return $this->db->affected_rows();
		}
		else if($lock == 1)
		{
			$this->db->where(array('id_keluarga' => $id_keluarga));
			$this->db->update($this->_table, array('is_locked' => 0));
			return $this->db->affected_rows();
		}
	}
	
	function getLock($id_keluarga)
	{
		$this->db->select('is_locked');
		$this->db->where('id_keluarga', $id_keluarga);
		//$this->db->where('id_sensus', $id);
		$this->db->limit(1);
		$q = $this->db->get('tbl_jawaban_sensus');
		//if id is unique we want just one row to be returned
		$data = array_shift($q->result_array());
		$result = $data['is_locked'];	
		return  $result;	
	}
	
	function getJawabanEdit($id_keluarga,$id_pertanyaan,$id_sensus)
	{
		$this->db->select('*')->from('tbl_jawaban_sensus');
		$this->db->where('id_keluarga',$id_keluarga);
		$this->db->where('id_pertanyaan_sensus',$id_pertanyaan);
		$this->db->where('id_sensus',$id_sensus);
		$q = $this->db->get();
		return $q->result();
    }
	
	function GetNamabyIdKeluarga($id_keluarga)
	{
		$this->db->select('id_jawaban,nama,no_kk');
		$this->db->where('tbl_jawaban_sensus.id_keluarga', $id_keluarga);
		$this->db->limit(1);
		$data=array();
		$query=$this->db->get('tbl_jawaban_sensus');
		if($query->num_rows()>0)
		{
			$data = $query->result();
		}
		$query->free_result();
		return $data;
	}
	
	function Laporan($id_keluarga,$id)
	{
		$this->db->select('ref_indikator_kesejahteraan.deskripsi,
		tbl_pertanyaan_sensus.pertanyaan,
		tbl_jawaban_sensus.jawaban,
		tbl_jawaban_sensus.nilai_bobot')->from('ref_indikator_kesejahteraan');
		$this->db->join('tbl_pertanyaan_sensus','tbl_pertanyaan_sensus.id_indikator = ref_indikator_kesejahteraan.id_indikator');
		$this->db->join('tbl_jawaban_sensus','tbl_jawaban_sensus.id_indikator = ref_indikator_kesejahteraan.id_indikator');
		$this->db->where('tbl_jawaban_sensus.id_keluarga',$id_keluarga);
		$this->db->where('tbl_pertanyaan_sensus.id_sensus',$id);
		$this->db->where('tbl_jawaban_sensus.id_sensus',$id);
		$q = $this->db->get();
		return $q->result();
	}
}
?>