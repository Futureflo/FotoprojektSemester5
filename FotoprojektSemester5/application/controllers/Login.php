<?php
class Login extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form','html','hash_helper'));
		$this->load->library(array( 'form_validation'));
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
			$uresult = $this->user_model->get_user($email);
			// ceck E-Mail-Confirmation
			if (1 == $uresult[0]-> user_status){
				$this->session->set_flashdata('msg', 'Sie müssen ihre E-Mail-Adresse bestätigen bevor Sie sich einloggen');
				redirect("start/");
			}
			else{
				// check for user credentials
			$user_salt = $uresult[0]-> user_salt;
			$algo = 'sha256';
			
			$hashpw = generate_hash($user_salt, $password, $algo);
			$user_password =  $uresult[0]->user_password;
			
			if (strcmp($hashpw , $user_password) == 0) 
			{
				// set session
 				$sess_data = array('login' => TRUE, 'user_name' =>  $uresult[0]->user_firstname, 'user_id' =>  $uresult[0]->user_id);			
 				$this->session->set_userdata($sess_data);				
				redirect("start/");
			}
			else
			{
				$this->session->set_flashdata('msg', 'Falsche E-Mail-Adresse oder Passwort');
				redirect("start/");
			}
		}
		}
    }
}