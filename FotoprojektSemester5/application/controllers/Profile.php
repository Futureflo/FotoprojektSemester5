<?php
class Profile extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->helper(array('html'));
		$this->load->database();
		$this->load->model('user_model');
	}
	
	function index()
	{
		$details = $this->user_model->get_user_by_id($this->session->userdata('user_id'));
		$data['user_name'] = $details[0]->user_firstname . " " . $details[0]->user_name;
		$data['user_email'] = $details[0]->user_email;
		$this->load->view('user/profile_view', $data);
	}
}