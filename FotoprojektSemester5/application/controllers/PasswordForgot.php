<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PasswordForgot extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->library(array( 'form_validation'));
		$this->load->database();
		$this->load->model('user_model');
	}


	public function index()
	{
		// get form input
		$email = $this->input->post("user_email");
		
		if ($this->form_validation->run() == FALSE)
		{
			// validation fail
			$this->load->template ( 'user/password_forgot_view' );
		}
		else
		{
		}
		
	}

}
?>