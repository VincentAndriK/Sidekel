<?php
class M_galeri extends CI_Model {

  function __construct()
  {
    parent::__construct();
    $this->_table='tbl_galeri';
	
    //get instance
    $this->CI = get_instance();
  }
	public function get_galeri_flexigrid()
    {
        //Build contents query
        $this->db->select('id_galeri, judul, kategori, url')->from($this->_table);
        $this->db->where('id_galeri !=', 0);
		$this->db->order_by("create_time", "desc");
        $this->CI->flexigrid->build_query();

        //Get contents
        $return['records'] = $this->db->get();

        //Build count query
        $this->db->select("count(id_galeri) as record_count")->from($this->_table);        
        $this->db->where('id_galeri !=', 0);
        $this->CI->flexigrid->build_query(FALSE);
        $record_count = $this->db->get();
        $row = $record_count->row();

        //Get Record Count
        $return['record_count'] = $row->record_count;

        //Return all
        return $return;
    }
  function insertGaleri($data)
  {
    $this->db->insert($this->_table, $data);
  }
  
  function deleteGaleri($id,$gambar)
  {
    unlink($gambar);
    $this->db->where('id_galeri', $id);
    $this->db->delete($this->_table);
  }

  function get_galeri($id){
    return $this->db->get_where('tbl_galeri',array('id_galeri' => $id))->row();
  }
  
  function updateGaleri($where, $data) //update
  {
    $this->db->where('id_galeri = ',$where);
    $this->db->update($this->_table, $data);
    return $this->db->affected_rows();
  }
  function getGambarByIdGaleri($id,$gambar){
    $this->db->select('url');
    $this->db->where('id_galeri', $id);
    $this->db->limit(1);
    $q = $this->db->get('tbl_galeri');
    //if id is unique we want just one row to be returned
    $data = array_shift($q->result_array());
    $result = $data['url'];  
    return  $result;  
  }

  function getAllGaleri(){
    $this->db->select('tbl_galeri.*')->from($this->_table);
    $this->db->order_by("create_time", "desc");
  }

  function getAllGaleriNumRows(){
    $this->db->select('tbl_galeri.*')->from($this->_table);
    return $this->db->get()->num_rows();
  }
  
  function getAllGaleriBeranda(){
    $this->db->select('*')->from($this->_table);
    $this->db->order_by("create_time", "desc");
	$this->db->limit(4,0);
    $q = $this->db->get();
    return $q->result();
  }

  public function fetch_galeri($limit, $start) {
        $this->db->limit($limit, $start);
        $query = $this->db->get("tbl_galeri");

        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
   }
	/*function cekFIleExist($deskripsi)
	{	
		return $this->db->get_where($this->_table,array('deskripsi' => $deskripsi))->row();
	}*/
}
?>