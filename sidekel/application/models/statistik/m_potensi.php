<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_potensi extends CI_Model {

    function __construct(){
        // Call the Model constructor
        parent::__construct();
		$this->load->library('subquery');
    }
    
	
	function getDataDetil(){
		$query = "
			SELECT 			
				ref_ped_sub.deskripsi,
				count(tbl_ped.id_ped_sub) as jumlah			
			FROM tbl_ped
			JOIN ref_ped_sub ON tbl_ped.id_ped_sub = ref_ped_sub.id_ped_sub
			GROUP BY ref_ped_sub.id_ped_sub
		 
		 ";
		$query = $this->db->query($query);
		return $query->result();
	}	
	
	function getDataKategori(){
		$query = "
			SELECT 			
				ref_ped_kategori.deskripsi,
				count(ref_ped_sub.id_ped_kategori) as jumlah			
			FROM ref_ped_sub
			JOIN ref_ped_kategori ON ref_ped_sub.id_ped_kategori = ref_ped_kategori.id_ped_kategori
			GROUP BY ref_ped_kategori.id_ped_kategori
		 
		 ";
		$query = $this->db->query($query);
		return $query->result();
	}
}