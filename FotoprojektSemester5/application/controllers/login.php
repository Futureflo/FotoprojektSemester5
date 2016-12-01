<?php
class login extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form','url','html'));
		$this->load->library(array('session', 'form_validation'));
		$this->load->database();
		$this->load->model('user_model');
	}
    public function index()
    {
		// get form input
		$email = $this->input->post("user_email");
        $password = $this->input->post("user_password");

		// form validation
		$this->form_validation->set_rules("user_email", "Email-ID", "trim|required");
		$this->form_validation->set_rules("user_password", "Password", "trim|required");
		
		if ($this->form_validation->run() == FALSE)
        {
			// validation fail
			$this->load->view('user/login_view');
		}
		else
		{
			// check for user credentials
			$userdata = $this->user_model->get_user($email, $password);
			if (count($userdata) > 0)
			{
				// set session
				
// 				$sess_data = array('login' => TRUE, 'user_firstname' => $userdata[1], 'user_id' => $userdata[0]);
				
 				$sess_data = array('login' => TRUE, 'uname' => $userdata->user_firstname, 'uid' => $userdata->user_id);
				$this->session->set_userdata($sess_data);
				redirect("profile/");
			}
			else
			{
				$this->session->set_flashdata('msg', '<div class="alert alert-danger text-center">Wrong Email-ID or Password!</div>');
				redirect('login/');
			}
		}
    }
}