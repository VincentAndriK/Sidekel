<?php
class M_pertanyaan_sensus extends CI_Model {

   function __construct()
  {
    parent::__construct();
    $this->_table='tbl_pertanyaan_sensus';
	
    //get instance
    $this->CI = get_instance();
  }
	public function get_pertanyaan_sensus_flexigrid()
    {
        //Build contents query
        $this->db->select('ref_indikator_kesejahteraan.deskripsi as indikator,
		tbl_sensus.tanggal_sensus as tanggal,
		tbl_pertanyaan_sensus.*')->from($this->_table);
		$this->db->join('ref_indikator_kesejahteraan','ref_indikator_kesejahteraan.id_indikator = tbl_pertanyaan_sensus.id_indikator');
		$this->db->join('tbl_sensus','tbl_sensus.id_sensus = tbl_pertanyaan_sensus.id_sensus');
		//$this->db->join('ref_ciri_pembeda','ref_ciri_pembeda.id_ciri_pembeda = tbl_pertanyaan_sensus.id_ciri_pembeda ');
        $this->db->where('id_pertanyaan !=', 0);
		$this->db->where('tbl_pertanyaan_sensus.is_delete !=', 1);
        $this->CI->flexigrid->build_query();

        //Get contents
        $return['records'] = $this->db->get();

        //Build count query
        $this->db->select("count(id_pertanyaan) as record_count")->from($this->_table);
        $this->db->where('id_pertanyaan !=', 0);
		$this->db->where('tbl_pertanyaan_sensus.is_delete !=', 1);
        $this->CI->flexigrid->build_query(FALSE);
        $record_count = $this->db->get();
        $row = $record_count->row();

        //Get Record Count
        $return['record_count'] = $row->record_count;

        //Return all
        return $return;
    }
  function insertPertanyaanSensus($data)
  {
    $this->db->insert($this->_table, $data);
  }
  
  function deletePertanyaanSensus($id)
  {
    $this->db->where('id_pertanyaan', $id);
    $this->db->delete($this->_table);
  }
  
   function getPertanyaanSensusByIdPertanyaan($id) //edit
  {	
    return $this->db->get_where($this->_table,array('id_pertanyaan' => $id))->row();
  } 
  
  function getPertanyaanSensusEdit($id)
	{
		$this->db->select(
		'tbl_sensus.tanggal_sensus as tgl_sensus,
		ref_indikator_kesejahteraan.deskripsi as indikator,
		ref_indikator_kesejahteraan.bobot as bobot,
		ref_indikator_kesejahteraan.id_indikator as idInd,
		tbl_pertanyaan_sensus.* 
		')->from('tbl_pertanyaan_sensus');
		$this->db->join('tbl_sensus','tbl_sensus.id_sensus = tbl_pertanyaan_sensus.id_sensus');
		$this->db->join('ref_indikator_kesejahteraan','ref_indikator_kesejahteraan.id_indikator = tbl_pertanyaan_sensus.id_indikator ');
		//$this->db->join('ref_ciri_pembeda','ref_ciri_pembeda.id_indikator = tbl_pertanyaan_sensus.id_indikator ');
		
		$this->db->where('tbl_pertanyaan_sensus.id_pertanyaan', $id);
		$q = $this->db->get();
		return $q->result();
	}
  
  function updatePertanyaanSensus($where, $data) //update
  {
    $this->db->where($where);
    $this->db->update($this->_table, $data);
    return $this->db->affected_rows();
  }
  
	function cekFIleExist($deskripsi)
	{	
		return $this->db->get_where($this->_table,array('pertanyaan' => $deskripsi))->row();
	}
	
	function get_indikator() 
	{      
      	$records = $this->db->get('ref_indikator_kesejahteraan');
   		$data=array();
        foreach ($records->result() as $row)
        {	
			$data[''] = '--Pilih--';
        	$data[$row->id_indikator] = $row->deskripsi;
        }
        return ($data);
    }
	
	
	function getIdIndikator($deskripsi)
	{
		$this->db->select('id_indikator');
		$this->db->like('deskripsi', $deskripsi);
		$q = $this->db->get('ref_indikator_kesejahteraan');
		//if id is unique we want just one row to be returned
		$data = array_shift($q->result_array());
		$result = $data['id_indikator'];	
		return  $result;	
	}
	
	function getIdSensus($deskripsi)
	{
		$this->db->select('id_sensus');
		$this->db->like('keterangan', $deskripsi);
		$q = $this->db->get('tbl_sensus');
		//if id is unique we want just one row to be returned
		$data = array_shift($q->result_array());
		$result = $data['id_sensus'];	
		return  $result;	
	}
	
	function getIdPertanyaan($deskripsi)
	{
		 $this->db->select('id_pertanyaan');
		$this->db->where('pertanyaan', $deskripsi);
		$q = $this->db->get('tbl_pertanyaan_sensus');
		//if id is unique we want just one row to be returned
		$data = array_shift($q->result_array());
		$result = $data['id_pertanyaan'];	
		return  $result;	
		
		/*$query = $this->db->query('select tbl_pertanyaan_sensus.id_pertanyaan from tbl_pertanyaan_sensus where tbl_pertanyaan_sensus.pertanyaan = $deskripsi');
		return $query->result(); */
	}
	
	function getPertanyaanExist($pertanyaan)
	{
		$this->db->select('id_pertanyaan');
		$this->db->where('pertanyaan', $pertanyaan);
		$q = $this->db->get('tbl_pertanyaan_sensus');
		//if id is unique we want just one row to be returned
		$data = array_shift($q->result_array());
		$result = $data['id_pertanyaan'];	
		if($result == NULL)
		{	
			return FALSE;
		}
		else return TRUE;
	}
	
	function cekPertanyaanExist($pertanyaan)
	{	
		return $this->db->get_where('tbl_pertanyaan_sensus',array('pertanyaan' => $pertanyaan))->row();
	}
	
	function getPertanyaan($id)
	{
		$this->db->select(
		'tbl_sensus.tanggal_sensus as tgl_sensus,
		ref_indikator_kesejahteraan.deskripsi as indikator,
		ref_indikator_kesejahteraan.bobot as bobot,
		ref_indikator_kesejahteraan.id_indikator as idInd,
		tbl_pertanyaan_sensus.* 
		')->from('tbl_pertanyaan_sensus');
		$this->db->join('tbl_sensus','tbl_sensus.id_sensus = tbl_pertanyaan_sensus.id_sensus');
		$this->db->join('ref_indikator_kesejahteraan','ref_indikator_kesejahteraan.id_indikator = tbl_pertanyaan_sensus.id_indikator ');
		//$this->db->join('ref_ciri_pembeda','ref_ciri_pembeda.id_indikator = tbl_pertanyaan_sensus.id_indikator ');
		
		$this->db->where('tbl_pertanyaan_sensus.id_sensus', $id);
		$this->db->where('ref_indikator_kesejahteraan.is_delete !=', 1);
		$q = $this->db->get();
		return $q->result();
	}
	
	function getPertanyaanEdit($id)
	{
		$this->db->select(
		'tbl_sensus.tanggal_sensus as tgl_sensus,
		tbl_pilihan_jawaban.*,
		tbl_pertanyaan_sensus.* 
		')->from('tbl_pertanyaan_sensus');
		$this->db->join('tbl_sensus','tbl_sensus.id_sensus = tbl_pertanyaan_sensus.id_sensus');
		$this->db->join('tbl_pilihan_jawaban','tbl_pilihan_jawaban.id_pertanyaan = tbl_pertanyaan_sensus.id_pertanyaan');
		//$this->db->join('ref_ciri_pembeda','ref_ciri_pembeda.id_indikator = tbl_pertanyaan_sensus.id_indikator ');
		
		$this->db->where('tbl_pertanyaan_sensus.id_pertanyaan', $id);
		$q = $this->db->get();
		return $q->result();
	}
	
	function getJawaban($id)
	{
		
		$this->db->select('
		tbl_pilihan_jawaban.*
		')->from('tbl_pilihan_jawaban');
		$this->db->join('tbl_pertanyaan_sensus','tbl_pertanyaan_sensus.id_pertanyaan = tbl_pilihan_jawaban.id_pertanyaan ');
		$this->db->where('tbl_pilihan_jawaban.id_pertanyaan', $id);		
		//$this->db->group_by('tbl_pilihan_jawaban.id');
		$q = $this->db->get();
		return $q->result();
	}
	
	function getPertanyaanByIDKeluarga($id,$id_keluarga)
	{
		$this->db->select(
		'tbl_sensus.tanggal_sensus as tgl_sensus,
		ref_indikator_kesejahteraan.deskripsi as indikator,
		tbl_jawaban_sensus.jawaban as jawaban,
		tbl_jawaban_sensus.id_keluarga as id_keluarga,
		tbl_pertanyaan_sensus.* , 
		')->from('tbl_pertanyaan_sensus');
		$this->db->join('tbl_sensus','tbl_sensus.id_sensus = tbl_pertanyaan_sensus.id_sensus');
		$this->db->join('ref_indikator_kesejahteraan','ref_indikator_kesejahteraan.id_indikator = tbl_pertanyaan_sensus.id_indikator ');
		$this->db->join('tbl_jawaban_sensus','tbl_jawaban_sensus.id_pertanyaan_sensus = tbl_pertanyaan_sensus.id_pertanyaan ');
		$this->db->where('tbl_pertanyaan_sensus.id_sensus', $id);	
		$this->db->where('tbl_jawaban_sensus.id_keluarga', $id_keluarga);
		//$this->db->where('tbl_jawaban_sensus.is_locked', 0);
		$q = $this->db->get();
		return $q->result();
	}
	
	function get_Nomer($no_pertanyaan)
	{
		$this->db->select('id_pertanyaan');
		$this->db->where('no_pertanyaan',$no_pertanyaan);
		$q = $this->db->get('tbl_pertanyaan_sensus');
		$data = array_shift($q->result_array());
		return ($data['id_pertanyaan']);
	}
	
	function updateIsDelete($id_pertanyaan) //update
	{
		$data = array('is_delete' => 1);
		$this->db->where('id_pertanyaan',$id_pertanyaan);
		$this->db->update('tbl_pertanyaan_sensus',$data); 
	}
}
?>