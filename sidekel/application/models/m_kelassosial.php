<?php
class M_kelassosial extends CI_Model {

  function __construct()
  {
    parent::__construct();
    $this->_table='ref_kelas_sosial';
	
    //get instance
    $this->CI = get_instance();
  }
	public function get_kelas_sosial_flexigrid()
    {
        //Build contents query
        $this->db->select('*')->from($this->_table);
        $this->CI->flexigrid->build_query();

        //Get contents
        $return['records'] = $this->db->get();

        //Build count query
        $this->db->select("count(id_kelas_sosial) as record_count")->from($this->_table);
        $this->CI->flexigrid->build_query(FALSE);
        $record_count = $this->db->get();
        $row = $record_count->row();

        //Get Record Count
        $return['record_count'] = $row->record_count;

        //Return all
        return $return;
    }
  function insertKelas_sosial($data)
  {
    $this->db->insert($this->_table, $data);
  }
  
  function deleteKelas_sosial($id)
  {
    $this->db->where('id_kelas_sosial', $id);
    $this->db->delete($this->_table);
  }
  
  function getKelas_sosialByIdkelsos($id)
  {	
    return $this->db->get_where($this->_table,array('id_kelas_sosial' => $id))->row();
  }
  
  function updateKelas_sosial($where, $data)
  {
    $this->db->where($where);
    $this->db->update($this->_table, $data);
    return $this->db->affected_rows();
  }
  
  function getNilaiAwal($id_kelas_sosial)
  {
		$this->db->select('id_kelas_sosial,nilai_awal');
		$this->db->where('id_kelas_sosial',$id_kelas_sosial);
		$q = $this->db->get('ref_kelas_sosial');
		$ret = $q->row();
		return $ret->nilai_awal;
  }
  
  function getNilaiAkhir($id_kelas_sosial)
  {
		$this->db->select('id_kelas_sosial,nilai_akhir');
		$this->db->where('id_kelas_sosial',$id_kelas_sosial);
		$q = $this->db->get('ref_kelas_sosial');
		$ret = $q->row();
		return $ret->nilai_akhir;
  }
  
  function getDeskripsi($id_kelas_sosial)
  {
		$this->db->select('id_kelas_sosial,deskripsi');
		$this->db->where('id_kelas_sosial',$id_kelas_sosial);
		$q = $this->db->get('ref_kelas_sosial');
		$ret = $q->row();
		return $ret->deskripsi;
  }
}
?>