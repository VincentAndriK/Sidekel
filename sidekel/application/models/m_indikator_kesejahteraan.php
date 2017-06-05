<?php
class M_indikator_kesejahteraan extends CI_Model {

   function __construct()
  {
    parent::__construct();
    $this->_table='ref_indikator_kesejahteraan';
	
    //get instance
    $this->CI = get_instance();
  }
	public function get_indikator_kesejahteraan_flexigrid()
    {
        //Build contents query
        $this->db->select('*')->from($this->_table);
        $this->db->where('id_indikator !=', 0);
		$this->db->where('is_delete !=', 1);
        $this->CI->flexigrid->build_query();

        //Get contents
        $return['records'] = $this->db->get();

        //Build count query
        $this->db->select("count(id_indikator) as record_count")->from($this->_table);
        $this->db->where('id_indikator !=', 0);
		$this->db->where('is_delete !=', 1);
        $this->CI->flexigrid->build_query(FALSE);
        $record_count = $this->db->get();
        $row = $record_count->row();

        //Get Record Count
        $return['record_count'] = $row->record_count;

        //Return all
        return $return;
    }
  function insertIndikatorKesejahteraan($data)
  {
    $this->db->insert($this->_table, $data);
  }
  
  function deleteIndikatorKesejahteraan($id)
  {
    $this->db->where('id_indikator', $id);
    $this->db->delete($this->_table);
  }
  
  function getIndikatorKesejahteraanByIdIndikator($id) //edit
  {	
    return $this->db->get_where($this->_table,array('id_indikator' => $id))->row();
  }
  
  function updateIndikatorKesejahteraan($where, $data) //update
  {
    $this->db->where($where);
    $this->db->update($this->_table, $data);
    return $this->db->affected_rows();
  }
  
	function cekFIleExist($deskripsi)
	{	
		return $this->db->get_where($this->_table,array('deskripsi' => $deskripsi))->row();
	}
	
	function getDeskripsiExist($deskripsi)
	{
		$this->db->select('id_indikator');
		$this->db->where('deskripsi', $deskripsi);
		$q = $this->db->get('ref_indikator_kesejahteraan');
		//if id is unique we want just one row to be returned
		$data = array_shift($q->result_array());
		$result = $data['id_indikator'];	
		if($result == NULL)
		{	
			return FALSE;
		}
		else return TRUE;
	}
	
	function get_bobot_indikator($id_indikator)
	{
		$this->db->select('id_indikator,bobot');
		$this->db->where('id_indikator',$id_indikator);
		$q = $this->db->get('ref_indikator_kesejahteraan');
		$data = array_shift($q->result_array());
		return ($data['bobot']);
	}
	
	function get_indikator() 
	{      
		$this->db->where('id_indikator <>','0');
      	$records = $this->db->get('ref_indikator_kesejahteraan');
   		$data=array();
        foreach ($records->result() as $row)
        {	
			$data[''] = '--Pilih--';
        	$data[$row->id_indikator] = $row->deskripsi;
        }
        return ($data);
    }
	
	function get_ciri($id_indikator)
	{
		$this->db->where('id_indikator',$id_indikator);
		$quer=$this->db->get('ref_ciri_pembeda');
		if($quer->num_rows() > 0)
			return $quer->result_array();
		else
			return array();
	}
	//rt = ciri
	function get_ciripembeda() 
	{      
		$this->db->where('id_ciri_pembeda !=','0');				
		$this->db->join('ref_indikator_kesejahteraan','ref_indikator_kesejahteraan.id_indikator = ref_ciri_pembeda.id_ciri_pembeda');
      	$records = $this->db->get('ref_ciri_pembeda');
   		$data=array();
        foreach ($records->result() as $row)
        {	
			$data[''] = '--Pilih--';
        	$data[$row->id_ciri_pembeda] = $row->deskripsi;
        }
        return ($data);
    }	
	
	function getPertama()
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
	
	function getKedua($id_indikator) 
	{      
		$this->db->where('id_ciri_pembeda !=','0');	
		$this->db->where('id_indikator',$id_indikator);		
      	$records = $this->db->get('ref_ciri_pembeda');
   		$data=array();
        foreach ($records->result() as $row)
        {	
			$data[''] = '--Pilih--';
        	$data[$row->id_ciri_pembeda] = $row->deskripsi;
        }
        return ($data);
    }
	
	function updateIsDelete($id_indikator) //update
	{
		$data = array('is_delete' => 1);
		$this->db->where('id_indikator',$id_indikator);
		$this->db->update('ref_indikator_kesejahteraan',$data); 
	}
}
?>