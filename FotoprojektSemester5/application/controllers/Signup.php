<?php
class Signup extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form', 'hash_helper'));
		$this->load->library(array('form_validation'));
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
			$salt = generate_salt(10);
			$algo = 'sha256';
			$hashpw = generate_hash($salt, $this->input->post('user_password'),$algo);
			//createConfirmCode
			$confirmCode = generate_salt(10);
			
			//insert user details into db
			$data = array(
				'user_firstname' => $this->input->post('user_firstname'),
				'user_name' => $this->input->post('user_name'),
				'user_email' => $this->input->post('user_email'),
				'user_password' => $hashpw,
				'user_role_id' => 2,
				'user_status' => 1,	
				'user_salt' => $salt,
				'user_confirmcode' => $confirmCode	
			);
			
			if ($this->user_model->insert_user($data))
			{
				$this->session->set_flashdata('msg','<div class="alert alert-success text-center">You are Successfully Registered! Please login to access your Profile!</div>');
				$this->sendConfirmEmail($this->input->post('user_email'),$confirmCode);
// 				redirect('login/');	
			}
			else
			{
				// error
				$this->session->set_flashdata('msg','<div class="alert alert-danger text-center">Oops! Error.  Please try again later!!!</div>');
				redirect('signup/');

			}
		}
	}
	
	function sendConfirmEmail($user_email,$confirmCode){

		$this->load->library('email');
		
		$this->email->from('noReply@snap-gallery.de', 'FPS5');
		$this->email->to($user_email);
		$this->email->subject('Bestätigung zu Ihrem FPS5 Account');
		$this->email->message('Testing the email class. '. base_url()."User/confirmAccount/".$confirmCode);
		echo base_url()."AccountConfirmation/".$confirmCode;
		echo $this->email->send();		
	}
}