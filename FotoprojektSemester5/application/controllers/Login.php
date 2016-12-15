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
 				$sess_data = array(	'login' => TRUE,
 									'user_id' =>  $uresult[0]->user_id,
 									'user_email' =>  $uresult[0]->user_email,
 									'user_name' =>  $uresult[0]->user_name,
 									'user_name' =>  $uresult[0]->user_firstname,
 									'user_status' =>  $uresult[0]->user_status,
 									'user_role' =>  $uresult[0]->user_role);			
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
    
    
    function confirmAccount($user_confirmcode){
    
    	$confrimcodeExists = $this->user_model->update_userStatus($user_confirmcode);
    	if ($confrimcodeExists == 1)
    	{
    		$this->session->set_flashdata('msg', 'Ihre E-Mail wurde erfolgreich bestätigt');
    		redirect ('start/');
    	}
    	else {
    		redirect ('start/');
    	}
    }
    
    function forgotPassword(){
    	$user_email = $this->input->post("user_email");
    	 
    
    	$this->form_validation->set_rules('email', '"Email"', 'trim|required|valid_email|callback_user_exists');
    	$this->form_validation->set_message('user_exists','Das Passwort kann nicht zurückgesetzt werden, weil kein Benutzer mit der angegebenen E-Mail-Adresse gefunden wurde');
    
    	if ($this->form_validation->run() == FALSE)
    	{
    		$this->load->template('user/password_forgot_view');
    	}
    	else
    	{
    		$PassowrdForgotCode = generate_salt(10);
    		$this->sendPassowrdForgotEmail($user_email,$PassowrdForgotCode);
    		$this->load->template('user/success_password_forgot_view');
    	}
    }
    
    function sendPassowrdForgotEmail($user_email,$PassowrdForgotCode){
    
    	$this->load->library('email');
    
    	$this->email->from('noReply@snap-gallery.de', 'FPS5');
    	$this->email->to($user_email);
    	$this->email->subject('Snap-Gallery.de Password zurücksetzen');
    	$this->email->message('Sie können unter dem Folgenden Link ihr neues Password eingeben '. base_url()."Login/restorePassword/".$PassowrdForgotCode);
    	echo $this->email->send();
    }
    
    function user_exists($str)
    {
    	$field_value = $str; //this is redundant, but it's to show you how
    	//the content of the fields gets automatically passed to the method
    
    	if($this->user_model->mail_exists($field_value))
    	{
    		return TRUE;
    	}
    	else
    	{
    		return FALSE;
    	}
    }
    
    function restorePassword($user_passwordrestore){
    	
    	$uresult = $this->user_model->get_UserByRestoreCode($user_passwordrestore);
    	if ($uresult[0] != NULL)
    	{
    		$this->load->template ( 'user/password_reset_view' );
    		$this->changePassword($user_id);
    	}
    	else {
    		redirect ('start/');
    	}
    }
    
   private function changePassword($user_id){
  
    	$newPassword = $this->input->post("user_newPassword");
    	$newCPassword = $this->input->post("user_newCPassword");
    	
    	$this->form_validation->set_rules('user_newpassword', 'New Password', 'trim|required|matches[user_newcpassword]');
    	$this->form_validation->set_rules('user_newcpassword', 'Confirm New Password', 'trim|required');
    	
    	if ($this->form_validation->run() == FALSE)
    	{
    		// validation fail
    		$this->load->template ( 'user/password_reset_view' );
    		 }
    	else
    	{
			$algo = 'sha256';
    		$newSalt = generate_salt(10);
    		$newHashpw = generate_hash($newSalt,$newPassword, $algo);
    		$this->user_model->update_userPassword($user_id, $newHashpw);
    		redirect('Login/');
    	}
    }
    
}