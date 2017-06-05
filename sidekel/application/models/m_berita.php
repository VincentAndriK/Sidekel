<?php
class M_berita extends CI_Model {

  function __construct(){
		parent::__construct();
		$this->_table='tbl_berita';
	
		//get instance
		$this->CI = get_instance();
	}
	public function get_berita_flexigrid()
    {
        //Build contents query
        $this->db->select('*')->from($this->_table);
        $this->db->where('is_masyarakat','Tidak');
        $this->CI->flexigrid->build_query();

        //Get contents
        $return['records'] = $this->db->get();

        //Build count query
        $this->db->select("count(id_berita) as record_count")->from($this->_table);
		$this->db->where('is_masyarakat','Tidak');
        $this->CI->flexigrid->build_query(FALSE);
        $record_count = $this->db->get();
        $row = $record_count->row();

        //Get Record Count
        $return['record_count'] = $row->record_count;

        //Return all
        return $return;
    }
	function insertBerita($data){
		$this->db->insert($this->_table, $data);
	}
	
	function deleteBerita($id,$gambar,$thumb){
		//unlink('uploads/berita/'.$gambar.'.jpg');		
		unlink($gambar);		
		unlink($thumb);		
		$this->db->where('id_berita', $id);	
		$this->db->delete($this->_table);
	}
	  
	function updateBerita($where, $data){
		$this->db->where($where);
		$this->db->update($this->_table, $data);
		return $this->db->affected_rows();
	}
  
    function getBeritaByIdberita($id)
	{	
		 $this->db->select('tbl_berita.*,tbl_pengguna.nama_pengguna as nama_pengguna')->from($this->_table);
		 $this->db->join('tbl_pengguna','tbl_berita.id_pengguna = tbl_pengguna.id_pengguna ');
		 $this->db->where('tbl_berita.id_berita', $id);
		 $this->db->where('tbl_berita.is_publish','Ya');
		 return  $this->db->get()->row();
		//return $this->db->get_where($this->_table,array('id_berita' => $id))->row();
	}
 
	/*public function get_recent_berita(){
		$this->db->order_by("waktu", "desc");
		$this->db->where('tbl_berita.is_publish','Ya');
		return $this->db->get('tbl_berita',5,0)->result();
	}
	
	public function get_recent_berita_all(){
		 $this->db->select('tbl_berita.*,tbl_pengguna.nama_pengguna as nama_pengguna')->from($this->_table);
		 $this->db->join('tbl_pengguna','tbl_berita.id_pengguna = tbl_pengguna.id_pengguna ');
		$this->db->order_by("waktu", "desc");
		return $this->db->get()->result();
	}
	
	public function berita_all(){
		 $this->db->select('tbl_berita.id_berita, 
		 tbl_berita.gambar, 
		 tbl_berita.judul_berita, 
		 tbl_berita.isi_berita, 
		 tbl_berita.waktu, 
		 tbl_berita.penulis, 
		 tbl_berita.is_publish, 
		 tbl_pengguna.nama_pengguna as nama_pengguna')->from($this->_table);
		 $this->db->join('tbl_pengguna','tbl_berita.id_pengguna = tbl_pengguna.id_pengguna ');
		 $this->db->where('tbl_berita.is_publish','Ya');
		 $this->db->order_by('tbl_berita.waktu','desc');
		
	}
	
	public function berita_all_numrows(){
		 $this->db->select('tbl_berita.id_pengguna, 
		 tbl_berita.gambar, 
		 tbl_berita.judul_berita, 
		 tbl_berita.isi_berita, 
		 tbl_berita.waktu, 
		 tbl_pengguna.nama_pengguna as nama_pengguna')->from($this->_table);
		 $this->db->join('tbl_pengguna','tbl_berita.id_pengguna = tbl_pengguna.id_pengguna ');
		 $this->db->where('tbl_berita.is_publish','Ya');
		 $this->db->order_by('tbl_berita.waktu','desc');
		return $this->db->get()->num_rows();
	}*/
	public function get_gbr_berita(){
		 $this->db->select('tbl_berita.id_berita, 
		 tbl_berita.gambar, 
		 tbl_berita.thumb, 
		 tbl_berita.judul_berita, 
		 tbl_berita.isi_berita, 
		 tbl_berita.waktu, 
		 tbl_berita.penulis, 
		 tbl_berita.is_publish, 
		 tbl_pengguna.nama_pengguna as nama_pengguna');
		 $this->db->join('tbl_pengguna','tbl_berita.id_pengguna = tbl_pengguna.id_pengguna');
		 $this->db->where('tbl_berita.is_publish','Ya');
		 $this->db->order_by('tbl_berita.waktu','desc');
		return $this->db->get($this->_table)->result();
	}
	public function get_recent_berita(){
		 $this->db->select('tbl_berita.id_berita, 
		 tbl_berita.gambar, 
		 tbl_berita.judul_berita, 
		 tbl_berita.isi_berita, 
		 tbl_berita.waktu, 
		 tbl_berita.penulis, 
		 tbl_berita.is_publish, 
		 tbl_pengguna.nama_pengguna as nama_pengguna');
		 $this->db->join('tbl_pengguna','tbl_berita.id_pengguna = tbl_pengguna.id_pengguna');
		 $this->db->where('tbl_berita.is_publish','Ya');
		 $this->db->order_by('tbl_berita.waktu','desc');
		return $this->db->get($this->_table,5,0)->result();
	}
	
	public function get_recent_berita_all(){
		 $this->db->select('tbl_berita.*,tbl_pengguna.nama_pengguna as nama_pengguna')->from($this->_table);
		 $this->db->join('tbl_pengguna','tbl_berita.id_pengguna = tbl_pengguna.id_pengguna ');
		 $this->db->where('tbl_berita.is_publish','Ya');
		$this->db->order_by("waktu", "desc");
		$this->db->limit(6,0);
		return $this->db->get()->result();
	}
	
	public function berita_all(){
		 $this->db->select('tbl_berita.id_berita, 
		 tbl_berita.gambar, 
		 tbl_berita.thumb, 
		 tbl_berita.judul_berita, 
		 tbl_berita.isi_berita, 
		 tbl_berita.waktu, 
		 tbl_berita.penulis, 
		 tbl_berita.is_publish, 
		 tbl_berita.is_masyarakat, 
		 tbl_pengguna.nama_pengguna as nama_pengguna')->from($this->_table);
		 $this->db->join('tbl_pengguna','tbl_berita.id_pengguna = tbl_pengguna.id_pengguna ');
		 $this->db->where('tbl_berita.is_publish','Ya');
		 $this->db->order_by('tbl_berita.waktu','desc');
	}
	
	public function berita_all_numrows(){
		 $this->db->select('tbl_berita.id_pengguna, 
		 tbl_berita.gambar, 
		 tbl_berita.judul_berita, 
		 tbl_berita.isi_berita, 
		 tbl_berita.waktu, 
		 tbl_pengguna.nama_pengguna as nama_pengguna')->from($this->_table);
		 $this->db->join('tbl_pengguna','tbl_berita.id_pengguna = tbl_pengguna.id_pengguna ');
		 $this->db->where('tbl_berita.is_publish','Ya');
		 $this->db->order_by('tbl_berita.waktu','desc');
		return $this->db->get()->num_rows();
	}
	
	public function get_recent_berita_warga(){
		$this->db->select('tbl_berita.*,tbl_pengguna.nama_pengguna as nama_pengguna')->from($this->_table);
		$this->db->join('tbl_pengguna','tbl_berita.id_pengguna = tbl_pengguna.id_pengguna ');
		$this->db->where('tbl_berita.is_publish','Ya');
		$this->db->where('tbl_berita.is_masyarakat','Tidak');
		$this->db->order_by("waktu", "desc");
		$this->db->limit(6,0);
		return $this->db->get()->result();
	}
	
	public function berita_warga(){
		 $this->db->select('tbl_berita.id_berita, 
		 tbl_berita.gambar, 
		 tbl_berita.judul_berita, 
		 tbl_berita.isi_berita, 
		 tbl_berita.waktu, 
		 tbl_berita.penulis, 
		 tbl_berita.is_publish, 
		 tbl_berita.is_masyarakat,
		 tbl_pengguna.nama_pengguna as nama_pengguna')->from($this->_table);
		 $this->db->join('tbl_pengguna','tbl_berita.id_pengguna = tbl_pengguna.id_pengguna ');
		 $this->db->where('tbl_berita.is_publish','Ya');
		 $this->db->where('tbl_berita.is_masyarakat','Tidak');
		 $this->db->order_by('tbl_berita.waktu','desc');
		
	}
	
	public function berita_warga_numrows(){
		 $this->db->select('tbl_berita.id_pengguna, 
		 tbl_berita.gambar, 
		 tbl_berita.judul_berita, 
		 tbl_berita.isi_berita, 
		 tbl_berita.waktu,
		 tbl_pengguna.nama_pengguna as nama_pengguna')->from($this->_table);
		 $this->db->join('tbl_pengguna','tbl_berita.id_pengguna = tbl_pengguna.id_pengguna ');
		 $this->db->where('tbl_berita.is_publish','Ya');
		 $this->db->where('tbl_berita.is_masyarakat','Tidak');
		 $this->db->order_by('tbl_berita.waktu','desc');
		return $this->db->get()->num_rows();
	}
	
	public function get_recent_jurnal_warga(){
		$this->db->select('tbl_berita.*,tbl_pengguna.nama_pengguna as nama_pengguna')->from($this->_table);
		$this->db->join('tbl_pengguna','tbl_berita.id_pengguna = tbl_pengguna.id_pengguna ');
		$this->db->where('tbl_berita.is_publish','Ya');
		$this->db->where('tbl_berita.is_masyarakat','Ya');
		$this->db->order_by("waktu", "desc");
		$this->db->limit(6,0);
		return $this->db->get()->result();
	}
	
	public function jurnal_warga(){
		 $this->db->select('tbl_berita.id_berita, 
		 tbl_berita.gambar, 
		 tbl_berita.judul_berita, 
		 tbl_berita.isi_berita, 
		 tbl_berita.waktu, 
		 tbl_berita.penulis, 
		 tbl_berita.is_publish,
		 tbl_berita.is_masyarakat, 
		 tbl_pengguna.nama_pengguna as nama_pengguna')->from($this->_table);
		 $this->db->join('tbl_pengguna','tbl_berita.id_pengguna = tbl_pengguna.id_pengguna ');
		 $this->db->where('tbl_berita.is_publish','Ya');
		 $this->db->where('tbl_berita.is_masyarakat','Ya');
		 $this->db->order_by('tbl_berita.waktu','desc');
	}
	
	public function jurnal_warga_numrows(){
		 $this->db->select('tbl_berita.id_pengguna, 
		 tbl_berita.gambar, 
		 tbl_berita.judul_berita, 
		 tbl_berita.isi_berita, 
		 tbl_berita.waktu, 
		 tbl_pengguna.nama_pengguna as nama_pengguna')->from($this->_table);
		 $this->db->join('tbl_pengguna','tbl_berita.id_pengguna = tbl_pengguna.id_pengguna ');
		 $this->db->where('tbl_berita.is_publish','Ya');
		 $this->db->where('tbl_berita.is_masyarakat','Ya');
		 $this->db->order_by('tbl_berita.waktu','desc');
		return $this->db->get()->num_rows();
	}
	
	
	/////////////////////////////////////JANGAN DIHAPUS YAAA/////////////////////////////////////

	function getGambarByIdBerita($id)
	{
		$this->db->select('gambar');
		$this->db->where('id_berita', $id);
		$this->db->limit(1);
		$q = $this->db->get('tbl_berita');
		//if id is unique we want just one row to be returned
		$data = array_shift($q->result_array());
		$result = $data['gambar'];	
		return  $result;	
	}
	function getThumbByIdBerita($id)
	{
		$this->db->select('thumb');
		$this->db->where('id_berita', $id);
		$this->db->limit(1);
		$q = $this->db->get('tbl_berita');
		//if id is unique we want just one row to be returned
		$data = array_shift($q->result_array());
		$result = $data['thumb'];	
		return  $result;	
	}
	
}
?>