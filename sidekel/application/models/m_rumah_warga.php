<?php
class M_rumah_warga extends CI_Model {

  function __construct()
  {
    parent::__construct();
    $this->_table='tbl_keluarga';
    $this->load->library('Excel_generator');
	
    //get instance
    $this->CI = get_instance();
  }
	public function get_keluarga_flexigrid()
    {
        //Build contents query
      
		
		$this->db->select('
		tbl_keluarga.*,
		tbl_penduduk.nama,
		tbl_penduduk.nik,
		ref_rt.nomor_rt,
		ref_rw.nomor_rw,
		ref_dusun.nama_dusun
		')->from($this->_table);
		
		$this->db->join('tbl_penduduk','tbl_penduduk.id_penduduk = tbl_keluarga.id_kepala_keluarga');	
		$this->db->join('ref_rt','ref_rt.id_rt = tbl_keluarga.id_rt');
		$this->db->join('ref_rw','ref_rw.id_rw = tbl_keluarga.id_rw');
		$this->db->join('ref_dusun','ref_dusun.id_dusun = tbl_keluarga.id_dusun');
		$this->db->join('ref_status_penduduk','tbl_penduduk.id_status_penduduk = ref_status_penduduk.id_status_penduduk');
		$this->db->where('ref_status_penduduk.deskripsi <>','Meninggal');
		
		
	   $this->CI->flexigrid->build_query();
		
        //Get contents
         $return['records'] = $this->db->get();

        //Build count query
        $this->db->select("count(id_keluarga) as record_count")->from($this->_table);  
		$this->db->join('tbl_penduduk','tbl_penduduk.id_penduduk = tbl_keluarga.id_kepala_keluarga');	
		$this->db->join('ref_rt','ref_rt.id_rt = tbl_keluarga.id_rt');
		$this->db->join('ref_rw','ref_rw.id_rw = tbl_keluarga.id_rw');
		$this->db->join('ref_dusun','ref_dusun.id_dusun = tbl_keluarga.id_dusun');
		$this->db->join('ref_status_penduduk','tbl_penduduk.id_status_penduduk = ref_status_penduduk.id_status_penduduk');
		$this->db->where('ref_status_penduduk.deskripsi <>','Meninggal');		 
        $record_count = $this->db->get();
        $row = $record_count->row();

        //Get Record Count
        $return['record_count'] = $row->record_count; 
		
		$this->CI->flexigrid->build_query(TRUE);	

        //Return all
        return $return;
    }
	
	function get_dataForExportExcel()
	{
		$this->db->select('
		tbl_keluarga.*,
		tbl_penduduk.nama,
		ref_rt.nomor_rt,
		ref_rw.nomor_rw,
		ref_dusun.nama_dusun
		')->from($this->_table);
		
		$this->db->join('tbl_penduduk','tbl_penduduk.id_penduduk = tbl_keluarga.id_kepala_keluarga');	
		$this->db->join('ref_rt','ref_rt.id_rt = tbl_keluarga.id_rt');
		$this->db->join('ref_rw','ref_rw.id_rw = tbl_keluarga.id_rw');
		$this->db->join('ref_dusun','ref_dusun.id_dusun = tbl_keluarga.id_dusun');
		
		$query = $this->db->get();
        $this->excel_generator->set_query($query);
	}
	
  function insertKeluarga($data)
  {
    $this->db->insert($this->_table, $data);
  }
  
   function insertPenduduk($data)
  {
    $this->db->insert('tbl_penduduk', $data);
  }
  function insertHubKel($data)
  {
    $this->db->insert('tbl_hub_kel', $data);
  }
  function getIdPendudukByIdKeluarga($id)
  {
	$count=0;
    $this->db->select('id_penduduk');
	$this->db->where('id_keluarga',$id);
	$records = $this->db->get('tbl_hub_kel');
	$data=array();
	foreach ($records->result() as $row)
	{	
		$data[$count] = $row->id_penduduk;
		$count++;
	}
	return ($data);
  }
  
  function deleteKeluarga($id)
  {
  
	//$count=0;
	
/* 	//langkah 1
	$this->db->select('id_penduduk');
	$this->db->where('id_keluarga',$id);
	$records = $this->db->get('tbl_hub_kel');
	foreach ($records->result() as $row)
	{	
		//hapus semua hub_kel
		$this->db->where('id_penduduk', $row->id_penduduk);
		$this->db->delete('tbl_hub_kel');
		
		//hapus semua penduduk
		//$data = $this->m_keluarga->getIdPendudukByIdKeluarga($id);
		$this->db->where('id_penduduk', $row->id_penduduk);
		$this->db->delete('tbl_penduduk');
		//$count++;
	} */
	
	//langkah 2 (gak usah pake perulangan, pasti terhapus semua)
	$this->db->where('id_keluarga', $id);    
    $this->db->delete($this->_table);
	
	
  }
  
  function getphotoKeluarga($id)
  {
	$nik = $this->getNIKByKK($id);
	$this->db->select('photo');
	$this->db->where('nik',$nik);
	
	$q = $this->db->get('data_penduduk');
	return $q->result();
  }
  
  function getAll()
  {
	$this->db->select('tbl_keluarga.no_kk,
	tbl_keluarga.koordinat,
	tbl_penduduk.nama,
	tbl_hasil_sensus.status')->from('tbl_keluarga');
	$this->db->join('tbl_penduduk','tbl_penduduk.id_penduduk = tbl_keluarga.id_kepala_keluarga');
	$this->db->join('tbl_hasil_sensus','tbl_hasil_sensus.id_keluarga = tbl_keluarga.id_keluarga');
	$q = $this->db->get();
	return $q->result();
  }
  
   function tampilPolygon()
  {
	$this->db->select('
	tbl_keluarga.koordinat_polygon,')
	->from('tbl_keluarga');
	$this->db->group_by('tbl_keluarga.id_keluarga');
	$q = $this->db->get();
	return $q->result(); 
  }
  
  function getKeluargaById($id)
  {	
    
		$this->db->select('
		tbl_keluarga.*,
		tbl_penduduk.nama,
		ref_rt.nomor_rt,
		ref_rw.nomor_rw,
		ref_dusun.nama_dusun
		')->from($this->_table);
		
		$this->db->join('tbl_penduduk','tbl_penduduk.id_penduduk = tbl_keluarga.id_kepala_keluarga');	
		$this->db->join('ref_rt','ref_rt.id_rt = tbl_keluarga.id_rt');
		$this->db->join('ref_rw','ref_rw.id_rw = tbl_keluarga.id_rw');
		$this->db->join('ref_dusun','ref_dusun.id_dusun = tbl_keluarga.id_dusun');		
		$this->db->where('tbl_keluarga.id_keluarga', $id);
		$q = $this->db->get();
		return $q->row();
		//return $this->db->get_where($this->_table,array('id_keluarga' => $id))->row();
  }
  function getIdKepalaKeluargaByIdKeluarga($id)
	{
		$this->db->select('id_kepala_keluarga');
		$this->db->where('id_keluarga', $id);
		$q = $this->db->get('tbl_keluarga');
		//if id is unique we want just one row to be returned
		$data = array_shift($q->result_array());
		$result = $data['id_kepala_keluarga'];
		if ($result == NULL)
		{
			return 'tidak ditemukan';
		}
		else
		{			
			return  $result;
		}
	}
   function getPendudukByIdKepalaKeluarga($id)
  {	
	$id_kepala_keluarga=$this->getIdKepalaKeluargaByIdKeluarga($id);
    return $this->db->get_where('tbl_penduduk',array('id_penduduk' => $id_kepala_keluarga))->row();
  }
  
  
  
  function updateKoordinat($id_keluarga,$data) //update
	{
		$data = array('koordinat_polygon' => $data);
		$this->db->where('id_keluarga',$id_keluarga);
		$this->db->update('tbl_keluarga',$data); 
	}
	
  function updateKoordinatMarker($id_keluarga,$data) //update
	{
		$data = array('koordinat_marker' => $data);
		$this->db->where('id_keluarga',$id_keluarga);
		$this->db->update('tbl_keluarga',$data); 
	}

  function updateHapus($id_keluarga) //update
	{
		$data = array('koordinat_polygon' => '');
		$this->db->where('id_keluarga',$id_keluarga);
		$this->db->update('tbl_keluarga',$data); 
	}
	
	function updateHapuslala($id_keluarga) //update
	{
		$data = array('koordinat_marker' => '');
		$this->db->where('id_keluarga',$id_keluarga);
		$this->db->update('tbl_keluarga',$data); 
	}
	
	function getKel($id){
		$this->db->select('*')->from($this->_table);
		$this->db->where('id_keluarga',$id);
		$query = $this->db->get();
		return $query;
	}
  
}
?>