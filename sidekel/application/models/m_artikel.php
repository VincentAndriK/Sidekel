<?php
class M_artikel extends CI_Model {

  function __construct(){
		parent::__construct();
		$this->_table='tbl_artikel';
	
		//get instance
		$this->CI = get_instance();
	}
	public function get_artikel_flexigrid()
    {
        //Build contents query
        $this->db->select('*,ref_kategori_artikel.deskripsi as kategori')->from($this->_table);
		$this->db->join('ref_kategori_artikel','tbl_artikel.id_kategori_artikel = ref_kategori_artikel.id_kategori_artikel ');
        $this->CI->flexigrid->build_query();

        //Get contents
        $return['records'] = $this->db->get();

        //Build count query
        $this->db->select("count(id_artikel) as record_count")->from($this->_table);
        $this->CI->flexigrid->build_query(FALSE);
        $record_count = $this->db->get();
        $row = $record_count->row();

        //Get Record Count
        $return['record_count'] = $row->record_count;

        //Return all
        return $return;
    }
	public function get_kategori_artikel_flexigrid()
    {
        //Build contents query
        $this->db->select('*')->from('ref_kategori_artikel');
		$this->CI->flexigrid->build_query();

        //Get contents
        $return['records'] = $this->db->get();

        //Build count query
        $this->db->select("count(id_kategori_artikel) as record_count")->from('ref_kategori_artikel');
        $this->CI->flexigrid->build_query(FALSE);
        $record_count = $this->db->get();
        $row = $record_count->row();

        //Get Record Count
        $return['record_count'] = $row->record_count;

        //Return all
        return $return;
    }
	function insertArtikel($data){
		$this->db->insert($this->_table, $data);
	}
	
	function deleteArtikel($id,$gambar,$thumb){	
		unlink($gambar);		
		unlink($thumb);		
		$this->db->where('id_artikel', $id);	
		$this->db->delete($this->_table);
	}
	  
	function updateArtikel($where, $data){
		$this->db->where($where);
		$this->db->update($this->_table, $data);
		return $this->db->affected_rows();
	}
  
    function getArtikelByIdArtikel($id)
	{	
		 $this->db->select('tbl_artikel.*,ref_kategori_artikel.deskripsi as kategori')->from($this->_table);
		 $this->db->join('ref_kategori_artikel','tbl_artikel.id_kategori_artikel = ref_kategori_artikel.id_kategori_artikel ');
		 $this->db->where('id_artikel',$id);
		 
		 $this->db->limit(1,0);
		 return  $this->db->get()->row();
		//return $this->db->get_where($this->_table,array('id_artikel' => $id))->row();
	}
 
	
	/////////////////////////////////////JANGAN DIHAPUS YAAA/////////////////////////////////////

	function getGambarByIdArtikel($id)
	{
		$this->db->select('gambar');
		$this->db->where('id_artikel', $id);
		$this->db->limit(1);
		$q = $this->db->get('tbl_artikel');
		//if id is unique we want just one row to be returned
		$data = array_shift($q->result_array());
		$result = $data['gambar'];	
		return  $result;	
	}
	
	function getThumbByIdArtikel($id)
	{
		$this->db->select('thumb');
		$this->db->where('id_artikel', $id);
		$this->db->limit(1);
		$q = $this->db->get('tbl_artikel');
		//if id is unique we want just one row to be returned
		$data = array_shift($q->result_array());
		$result = $data['thumb'];	
		return  $result;	
	}
	
	function getKategori()
	{
		$records = $this->db->get('ref_kategori_artikel');
   		$data=array();
        foreach ($records->result() as $row)
        {	
			$data[''] = '--Pilih--';
        	$data[$row->id_kategori_artikel] = $row->deskripsi;
        }
        return ($data);
	}
	function insertKategori($data){
		$this->db->insert('ref_kategori_artikel', $data);
	}
	function getKategoriByIdKategori($id)
	{	
		 $this->db->select('*')->from('ref_kategori_artikel');
		 $this->db->where('id_kategori_artikel', $id);
		 $this->db->limit(1,0);
		 return  $this->db->get()->row();
		//return $this->db->get_where($this->_table,array('id_artikel' => $id))->row();
	}
	function updateKategori($where, $data){
		$this->db->where($where);
		$this->db->update('ref_kategori_artikel', $data);
		return $this->db->affected_rows();
	}
	function deleteKategori($id){
		$this->db->where('id_kategori_artikel', $id);	
		$this->db->delete('ref_kategori_artikel');
	}
	
	
	//////////////////////////////////////// FRONT END ///////////////////////////////
	public function getRowArtikel(){
		 $this->db->select('
		 tbl_artikel.*,
		 ref_kategori_artikel.deskripsi as kategori
		 ')->from($this->_table);
		 $this->db->join('ref_kategori_artikel','tbl_artikel.id_kategori_artikel = ref_kategori_artikel.id_kategori_artikel ');
		 $this->db->order_by('tbl_artikel.waktu','desc');
		 return $this->db->get()->result();
	}
	
	public function getRecentArtikel(){
		 $this->db->select('
		 tbl_artikel.*,
		 ref_kategori_artikel.deskripsi as kategori
		 ')->from($this->_table);
		 $this->db->join('ref_kategori_artikel','tbl_artikel.id_kategori_artikel = ref_kategori_artikel.id_kategori_artikel ');
		 $this->db->order_by('tbl_artikel.waktu','desc');
		 $this->db->limit(5,0);
		 
		 return $this->db->get()->result();
	}
	
	public function getArtikelNumRow(){
		 $this->db->select('
		 tbl_artikel.*,
		 ref_kategori_artikel.deskripsi as kategori
		 ')->from($this->_table,6,0);
		 $this->db->join('ref_kategori_artikel','tbl_artikel.id_kategori_artikel = ref_kategori_artikel.id_kategori_artikel ');
		 $this->db->order_by('tbl_artikel.waktu','desc');
		return $this->db->get()->num_rows();
	}
	
	public function getAllArtikel(){
		 $this->db->select('
		 tbl_artikel.*,
		 ref_kategori_artikel.deskripsi as kategori
		 ')->from($this->_table,6,0);
		 $this->db->join('ref_kategori_artikel','tbl_artikel.id_kategori_artikel = ref_kategori_artikel.id_kategori_artikel ');
		 $this->db->order_by('tbl_artikel.waktu','desc');
	}

}
?>