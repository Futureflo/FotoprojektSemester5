<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PasswordForgot extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form', 'url'));
		$this->load->database();
		$this->load->model('User_model');
		$this->load->library('form_validation');
	}


	public function index() {
		// get form input
		$this->form_validation->set_rules('email', '"Email"', 'trim|required|valid_email|callback_user_exists');
		$this->form_validation->set_message('user_exists','Das Passwort kann nicht zurückgesetzt werden, weil kein Benutzer mit der angegebenen E-Mail-Adresse gefunden wurde');
		
		if ($this->form_validation->run() == FALSE)
		{
			$this->load->template('user/password_forgot_view');
		}
		else
		{
			$this->load->template('user/success_password_forgot_view');
		}
	}
	
	function user_exists($str)
	{
		$field_value = $str; //this is redundant, but it's to show you how
		//the content of the fields gets automatically passed to the method
	
		if($this->User_model->mail_exists($field_value))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}
		
	}
?>