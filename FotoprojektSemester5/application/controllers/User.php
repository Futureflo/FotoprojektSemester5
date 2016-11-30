<?php 
   class User extends CI_Controller {
  
   	public function __construct()
   	{
   		parent::__construct();
   		$this->load->library('session');
   	}
   	
      public function index() { 

      	$this->load->model('user_model');
      	$data['users'] = $this->user_model->getAllUsers();
      	

      	$this->load->view('general/header_view');
      	$this->load->view('general/navbar_visitor_view');
		$this->load->view('user/allUsers_view', $data);
      	$this->load->view('general/footer_view');
      	
      } 

      function logout()
      {
      	// destroy session
      	$data = array('login' => '', 'uname' => '', 'uid' => '');
      	$this->session->unset_userdata($data);
      	$this->session->sess_destroy();
      	redirect('home/index');
      }
   } 
?>