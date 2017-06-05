<?php
class M_rss extends CI_Model {

	function __construct()
	{
	parent::__construct();
	$this->_table='tbl_pages';
	//get instance
	$this->CI = get_instance();
	}
  
    function get_posts()
	{
		$this->db->select('*')->from($this->_table);
		$this->db->where('url <>','web/c_sejarah');
		$this->db->where('url <>','web/c_demografi');
		$this->db->where('url <>','web/c_visimisi');
		$this->db->order_by("updated", "desc");
		$this->db->limit(10,0);
		return $this->db->get()->result();
	}
}

?>