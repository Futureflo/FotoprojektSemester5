<?php 
   class User extends CI_Controller {
  
      public function index() { 

      	$this->load->model('user_model');
      	$data['users'] = $this->user_model->getAllUsers();
      	

      	$this->load->view('general/header');
      	$this->load->view('general/navbar_visitor');
		$this->load->view('user/allUsers', $data);
      	$this->load->view('general/footer');
      	
      } 

   } 
?>