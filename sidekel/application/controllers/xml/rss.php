<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//session_start();

class Rss extends CI_Controller {

    function  __construct()
    {
		parent::__construct(); 
		$this->load->helper(array('xml'));
		$this->load->model('m_rss');
    }
	   
	function index()
    {
		$data = array(
			'encoding' 			=> 'utf-8',
			'feed_name' 		=> 'Berita Desa',
			'feed_url' 			=> 'xml/rss',
			'page_description' 	=> 'SiDeKel (Sistem Informasi Desa dan Kelurahan)',
			'page_language' 	=> 'id',
			'posts' 			=> $this->m_rss->get_posts()
		);


		header("Content-Type: application/rss+xml");
		$this->load->vars($data);
		$this->load->view('web/rss');
	}
}
?>