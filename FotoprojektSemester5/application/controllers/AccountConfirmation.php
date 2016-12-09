<?php
class login extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form','html','hash_helper'));
		$this->load->database();
		$this->load->model('user_model');
	}
	public function index()
	{

	$uresult = $this->user_model->get_user($email);
		
		
	redirect("login/");
	}
}