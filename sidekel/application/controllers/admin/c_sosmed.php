<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class C_sosmed extends CI_Controller {

    function  __construct()
    {
		parent::__construct();
		$session['hasil'] = $this->session->userdata('logged_in');
		$role = $session['hasil']->role;
		if($this->session->userdata('logged_in') AND $role == 'Administrator')
		{
			//Load flexigrid helper and library
			$this->load->helper('form');
			$this->load->model('m_sosmed');			
		}else
			redirect('c_login/logout', 'refresh');

    }

    function index()    {
		$session['hasil'] = $this->session->userdata('logged_in');
		$role = $session['hasil']->role;
		if($this->session->userdata('logged_in') AND $role == 'Administrator')
		{
			$this->edit(1);
		}else
			redirect('c_login', 'refresh'); 
        	
    }

    function edit($id){
		$session['hasil'] = $this->session->userdata('logged_in');
		$role = $session['hasil']->role;
		if($this->session->userdata('logged_in') AND $role == 'Administrator')
		{
			$data['hasil'] = $this->m_sosmed->getRow(1);
			$data['page_title'] = 'Pengaturan Sosial Media';
			$data['menu'] = $this->load->view('menu/v_admin', $data, TRUE);
			$data['content'] = $this->load->view('sosmed/v_ubah', $data, TRUE);
       
			$this->load->view('utama', $data);
		}else
			redirect('c_login', 'refresh'); 
    }
	
	function update() {	
	
		$link_facebook = $this->input->post('link_facebook', TRUE);
		$link_twitter = $this->input->post('link_twitter', TRUE);
		$widget_twitter = $this->input->post('widget_twitter', TRUE);
		
		////////Widget manipulation////////
			
			//$dt = str_replace("-","|",$dt);	$dt = str_replace("/","-",$dt);	
			$widget_twitter = explode('[removed]',trim($widget_twitter));
			$html = $widget_twitter[0];
		
		////////Widget manipulation////////
		
		$data = array(
				'link_facebook' => $link_facebook,
				'link_twitter' => $link_twitter,
				'widget_twitter' => $html
			);

		$result = $this->m_sosmed->updateRow(array('id_sosmed' => 1), $data);
		
		$this->session->set_flashdata('message', 'Pengaturan berhasil dilakukan !');
		redirect('admin/c_sosmed','refresh');
		
    }

}
?>