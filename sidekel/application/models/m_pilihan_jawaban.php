<?php
class M_pilihan_jawaban extends CI_Model {

   function __construct()
  {
    parent::__construct();
    $this->_table='tbl_pilihan_jawaban';
	
    //get instance
    $this->CI = get_instance();
  }
  function insertPilihanJawaban($data)
  {
    $this->db->insert($this->_table, $data);
  }
  
  function deletePilihanJawaban($id)
  {
    $this->db->where('id_pertanyaan', $id);
    $this->db->delete($this->_table);
  }
  
  function getPilihanJawabanByIdPilihanJawaban($id) //edit
  {	
    return $this->db->get_where($this->_table,array('id_pilihan' => $id))->row();
  }
  
  function updatePilihanJawaban($where,$where1, $data) //update
  {
    $this->db->where($where);
	$this->db->where($where1);
    $this->db->update($this->_table, $data);
    return $this->db->affected_rows();
  }
  
  function get_bobot($id,$deskripsi)
	{
		$this->db->select('bobot');
		$this->db->where('id_sensus',$id);
		$this->db->where('deskripsi',$deskripsi);
		$q = $this->db->get('tbl_pilihan_jawaban');
		$data = array_shift($q->result_array());
		return ($data['bobot']);
	}
 }