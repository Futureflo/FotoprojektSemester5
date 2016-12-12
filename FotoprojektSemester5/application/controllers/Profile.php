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
		
		$userdata = $this->user_model->get_user_by_id($this->session->userdata('user_id'));
		$data['user_name'] = $userdata[0]->user_firstname . " " . $userdata[0]->user_name;
		$data['user_email'] = $userdata[0]->user_email;
		$this->load->view('user/profile_view', $data);
	}
	
	function cangePassword(){
		
		$password = $this->input->post("user_password");
		$newPassword = $this->input->post("user_newPassword");
		$newCPassword = $this->input->post("user_newCPassword");
		
		$this->form_validation->set_rules('user_password', 'Password', 'trim|required');
		$this->form_validation->set_rules('user_newpassword', 'New Password', 'trim|required|matches[user_newcpassword]');
		$this->form_validation->set_rules('user_newcpassword', 'Confirm New Password', 'trim|required');
		
		if ($this->form_validation->run() == FALSE)
		{
			// validation fail
			$this->load->view('user/profile_view',$data);
		}
		else
		{
			$userdata = $this->user_model->get_user_by_id($this->session->userdata('user_id'));
			$user_salt = $$userdata[0]-> user_salt;
			$algo = 'sha256';
				
			$hashpw = generate_hash($user_salt, $password, $algo);
			$userpssword =  $$userdata[0]->user_password;
				
			if (strcmp($hashpw , $userpssword) == 0){
				$newSalt = generate_salt(10);
				$newHashpw = generate_hash($newSalt,$newPassword, $algo);
				$this->user_model->update_userPassword($user_id, $newHashpw);
			}
			
	}
	}

}