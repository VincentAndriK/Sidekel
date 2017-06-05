<?php
class M_sosmed extends CI_Model {

  function __construct()
  {
    parent::__construct();
    $this->_table='tbl_sosmed';
	
    //get instance
    $this->CI = get_instance();
  }
	  
  function getRow($id) //edit
  {	
    return $this->db->get_where($this->_table,array('id_sosmed' => $id))->row();
  }
  function updateRow($where, $data) //update
  {
    $this->db->where($where);
    $this->db->update($this->_table, $data);
    return $this->db->affected_rows();
  }
  
}
?>