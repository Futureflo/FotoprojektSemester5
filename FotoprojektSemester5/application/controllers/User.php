<?php 
   class User extends CI_Controller {
  
      public function index() { 

      	$this->load->model('user_model');
      	$data['users'] = $this->user_model->getAllUsers();
      	

      	$this->load->view('general/header_view');
      	$this->load->view('general/navbar_visitor_view');
		$this->load->view('user/allUsers_view', $data);
      	$this->load->view('general/footer_view');
      	
      } 

   } 
?>