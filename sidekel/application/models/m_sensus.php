<?php
class M_sensus extends CI_Model {

   function __construct()
  {
    parent::__construct();
    $this->_table='tbl_sensus';
	
    //get instance
    $this->CI = get_instance();
  }
	public function get_data_sensus_flexigrid()
    {
        //Build contents query
        $this->db->select('*')->from($this->_table);
        $this->db->where('id_sensus !=', 0);
		//$this->db->where('is_delete !=', 1);
        $this->CI->flexigrid->build_query();

        //Get contents
        $return['records'] = $this->db->get();

        //Build count query
        $this->db->select("count(id_sensus) as record_count")->from($this->_table);
        $this->db->where('id_sensus !=', 0);
		//$this->db->where('is_delete !=', 1);
        $this->CI->flexigrid->build_query(FALSE);
        $record_count = $this->db->get();
        $row = $record_count->row();

        //Get Record Count
        $return['record_count'] = $row->record_count;

        //Return all
        return $return;
    }
  function insertDataSensus($data)
  {
    $this->db->insert($this->_table, $data);
  }
  
  function deleteDataSensus($id)
  {
    $this->db->where('id_sensus', $id);
    $this->db->delete($this->_table);
  }
  
  function getDataSensusByIdSensus($id) //edit
  {	
    return $this->db->get_where($this->_table,array('id_sensus' => $id))->row();
  }
  
  function updateDataSensus($where, $data) //update
  {
    $this->db->where($where);
    $this->db->update($this->_table, $data);
    return $this->db->affected_rows();
  }
  
	function cekFIleExist($deskripsi)
	{	
		return $this->db->get_where($this->_table,array('tanggal_sensus' => $deskripsi))->row();
	}
	
	function getTanggalExist($deskripsi)
	{
		$this->db->select('id_sensus');
		$this->db->where('tanggal_sensus', $tanggal_sensus);
		$q = $this->db->get('tbl_sensus');
		//if id is unique we want just one row to be returned
		$data = array_shift($q->result_array());
		$result = $data['id_sensus'];	
		if($result == NULL)
		{	
			return FALSE;
		}
		else return TRUE;
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
	
	function get_sensus() 
	{      
		$this->db->where('id_sensus <>','0');
      	$records = $this->db->get('tbl_sensus');
   		$data=array();
        foreach ($records->result() as $row)
        {	
			$data[''] = '--Pilih--';
        	$data[$row->id_sensus] = $row->keterangan;
        }
        return ($data);
    }
}
?>