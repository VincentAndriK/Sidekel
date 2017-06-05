<?php
class M_hasil_sensus extends CI_Model {

   function __construct()
  {
    parent::__construct();
    $this->_table='tbl_hasil_sensus';
	
    //get instance
    $this->CI = get_instance();
  }
	public function get_hasil_sensus_flexigrid()
    {
        $this->db->select('*')->from($this->_table) ;
        $this->db->where('id_hasil !=', 0);
		$this->CI->flexigrid->build_query();
		
		

        //Get contents
        $return['records'] = $this->db->get();
		
        //Build count query
        $this->db->select("count(id_hasil) as record_count")->from($this->_table);
        $this->db->where('id_hasil !=', 0);
        $this->CI->flexigrid->build_query(FALSE);
        $record_count = $this->db->get();
        $row = $record_count->row();

        //Get Record Count
        $return['record_count'] = $row->record_count;

        //Return all
        return $return;
    }
  function insertHasilSensus($data)
  {
    $this->db->insert($this->_table, $data);
  }
  
  function cekId($idkel,$data)
  {
	$this->db->where('id_keluarga',$idkel);
	$query = $this->db->get('tbl_hasil_sensus');
	if($query->num_rows() > 0)
	{
		$hasil = array('tbl_hasil_sensus.is_new' => 1);
		$this->db->where('id_keluarga',$idkel);
		$this->db->update('tbl_hasil_sensus',$hasil); 
		$this->insertHasilSensus($data);
	}
	else
	{
		$this->insertHasilSensus($data);
	}
  }
  
  function deleteHasilSensus($id,$id_sensus)
  {
    $this->db->where('id_keluarga', $id);
	$this->db->where('id_sensus', $id_sensus);
    $this->db->delete($this->_table);
  }
  
  function getHasilSensusByIdHasil($id) //edit
  {	
    return $this->db->get_where($this->_table,array('id_hasil' => $id))->row();
  }
  
  function updateHasilSensus($where,$data) //update
  {
    $this->db->where($where);
    $this->db->update($this->_table, $data);
    return $this->db->affected_rows();
  }
	
	function getJawaban($id)
	{
		$this->db->select(
		'tbl_hasil_sensus.* , 
		')->from('tbl_hasil_sensus');
		$this->db->where('tbl_hasil_sensus.id_hasil', $id);		
		$q = $this->db->get();
		return $q->result();
	}
	
	function getStatusByIDKeluarga($id_keluarga,$id_sensus)
	{
		$this->db->select(
		'
		tbl_hasil_sensus.*, 
		')->from('tbl_hasil_sensus');
		$this->db->where('tbl_hasil_sensus.id_keluarga', $id_keluarga);
		$this->db->where('tbl_hasil_sensus.id_sensus', $id_sensus);
		$q = $this->db->get();
		return $q->result();
	}
}
?>