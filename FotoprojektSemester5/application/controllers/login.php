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
			$uresult = $this->user_model->get_user($email, $password);
			if (count($uresult) > 0)
			{
				// set session
				$sess_data = array('login' => TRUE, 'uname' => $uresult[0]->fname, 'uid' => $uresult[0]->id);
				$this->session->set_userdata($sess_data);
				redirect("user/");
			}
			else
			{
				$this->session->set_flashdata('msg', '<div class="alert alert-danger text-center">Wrong Email-ID or Password!</div>');
				redirect('login/');
			}
		}
    }
}