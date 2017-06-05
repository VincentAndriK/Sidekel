<?php
class M_pemetaankemiskinan extends CI_Model {

  function __construct()
  {
    parent::__construct();
    $this->_table='tbl_hasil_sensus';
	
    //get instance
    $this->CI = get_instance();
  }
	public function getTotalPenduduk()
    {
        //Build contents query
        $this->db->select('*')->from($this->_table);
		$this->db->where('tbl_hasil_sensus.is_new', 0);
        $record_count = $this->db->get();
        return $record_count->num_rows();	
    }
	
	public function getTotalPendudukByKelasSosial($id_kelas_sosial)
    {
        //Build contents query
        $this->db->select('*')->from($this->_table)->where('id_kelas_sosial',$id_kelas_sosial);
      
        $record_count = $this->db->get();
		return $record_count->num_rows();	
    }

    
}
?>