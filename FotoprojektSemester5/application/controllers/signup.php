<?php
class signup extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form'));
		$this->load->library(array('session', 'form_validation'));
		$this->load->database();
		$this->load->model('user_model');
	}
	
	function index()
	{
		// set form validation rules
		$this->form_validation->set_rules('user_firstname', 'First Name', 'trim|required|alpha|min_length[3]|max_length[30]');
		$this->form_validation->set_rules('user_name', 'Last Name', 'trim|required|alpha|min_length[3]|max_length[30]');
		$this->form_validation->set_rules('user_email', 'Email ID', 'trim|required|valid_email|is_unique[user.user_email]');
		$this->form_validation->set_rules('user_password', 'Password', 'trim|required|matches[user_cpassword]');
		$this->form_validation->set_rules('user_cpassword', 'Confirm Password', 'trim|required');
		
		// submit
		if ($this->form_validation->run() == FALSE)
        {
			// fails
			$this->load->view('user/signup_view');
        }
		else
		{
			//insert user details into db
			$data = array(
				'user_firstname' => $this->input->post('user_firstname'),
				'user_name' => $this->input->post('user_name'),
				'user_email' => $this->input->post('user_email'),
				'user_password' => $this->input->post('user_password'),
				'user_role_id' => 2
			);
			
			if ($this->user_model->insert_user($data))
			{
				$this->session->set_flashdata('msg','<div class="alert alert-success text-center">You are Successfully Registered! Please login to access your Profile!</div>');
<<<<<<< HEAD
				redirect('login');
=======
				redirect('signup/index');
>>>>>>> branch 'master' of https://github.com/Futureflo/FotoprojektSemester5.git
			}
			else
			{
				// error
				$this->session->set_flashdata('msg','<div class="alert alert-danger text-center">Oops! Error.  Please try again later!!!</div>');
<<<<<<< HEAD
				redirect('login');
=======
				redirect('signup/index');
>>>>>>> branch 'master' of https://github.com/Futureflo/FotoprojektSemester5.git
			}
		}
	}
}