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
	public function index() {
		// get form input
		$email = $this->input->post ( "user_email" );
		$password = $this->input->post ( "user_password" );
		
		// form validation
		$this->form_validation->set_rules ( "user_email", "Email-ID", "trim|required" );
		$this->form_validation->set_rules ( "user_password", "Password", "trim|required" );
		
		$uresult = $this->user_model->get_user ( $email );
		
		if ($this->form_validation->run () == FALSE) {
			// validation fail
			
			redirect ( "start/" );
		} 
		else {
			$status = $uresult [0]->user_status;
			switch ($status) {
				
				case 1 :
					$this->session->set_flashdata ( 'msg', 'Sie müssen ihre E-Mail-Adresse bestätigen bevor Sie sich einloggen' );
					redirect ( "start/" );
					break;
				case 3 :
					
					$this->session->set_flashdata ( 'msg', 'Ihr Account wurde gesperrt, da Sie Ihr Passwort zu oft falsch eingegeben haben. Kontaktieren Sie den Admin oder setzten Sie ihr Password über "Password vergessen" zurück' );						
					redirect ( "start/" );
						
					break;
				case 2 :
					
					// check for user credentials
					$user_salt = $uresult [0]->user_salt;
					$algo = 'sha256';
					
					$hashpw = generate_hash ( $user_salt, $password, $algo );
					$user_password = $uresult [0]->user_password;
					
					if (strcmp ( $hashpw, $user_password ) == 0) {
						//reset password attemps
						$this->user_model->update_userPasswordAttempt ( $email, 0 );
						
						// set session
						$sess_data = array (
								'login' => TRUE,
								'user_id' => $uresult [0]->user_id,
								'user_email' => $uresult [0]->user_email,
								'user_name' => $uresult [0]->user_name,
								'user_name' => $uresult [0]->user_firstname,
								'user_status' => $uresult [0]->user_status,
								'user_role' => $uresult [0]->user_role 
						);
						$this->session->set_userdata ( $sess_data );
						redirect ( "start/" );
					} else {
						
						$passwordAttempt = $uresult[0]->user_passwordattempt;
						if($passwordAttempt == null){
							$passwordAttempt = 0;
						}
						$passwordAttempt++;
							
						$this->user_model->update_userPasswordAttempt ( $email, $passwordAttempt );
						if ($passwordAttempt > 5) {
							$this->user_model->update_userStatusByID ( $uresult [0]->user_id, 3 );
						}
						else {
							$this->session->set_flashdata ( 'msg', 'Falsche E-Mail-Adresse oder Passwort' );
						}
						
						redirect ( "start/" );
					}
					
					break;
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
    
 public  function forgotPassword(){
    	$user_email = $this->input->post("email");
    	 
    	$this->form_validation->set_rules('email', '"Email"', 'trim|required|valid_email|callback_user_exists');
    	$this->form_validation->set_message('user_exists','Das Passwort kann nicht zurückgesetzt werden, weil kein Benutzer mit der angegebenen E-Mail-Adresse gefunden wurde');
    
    	if ($this->form_validation->run() == FALSE)
    	{
     		$this->load->template('user/password_forgot_view');
    	}
    	else
    	{
    		$restoreCode = generate_salt(10);
    		
    		$this->user_model->update_userRestoreCode($user_email,$restoreCode);
    		$this->sendPassowrdForgotEmail($user_email,$restoreCode);
     		$this->load->template('user/success_password_forgot_view');
    	}
    }
    
    function sendPassowrdForgotEmail($user_email,$PassowrdForgotCode){
    
    	$this->load->library('email');
    
    	$this->email->from('noReply@snap-gallery.de', 'FPS5');
    	$this->email->to($user_email);
    	$this->email->subject('Snap-Gallery.de Password zurücksetzen');
    	$this->email->message('Sie können unter dem Folgenden Link ihr neues Password eingeben '. base_url()."login/restorePassword/".$PassowrdForgotCode);
    	 $this->email->send();
    	
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
    	
    	if ($uresult[0] != Null)
    	{
    		$data['user_id'] = $uresult[0]->user_id;
    		
    		$this->load->template('user/password_reset_view',$data);
    		
    	}
    	else {
//     		redirect ('start/');
    	}
    }
    
  function getNewPassword(){
  	
    	$newPassword = $this->input->post("user_newPassword");
    	$newCPassword = $this->input->post("user_newCPassword");
    	$user_id = $this->input->post('user_id');
    	$this->form_validation->set_rules('user_newPassword', 'New Password', 'trim|required|matches[user_newCPassword]');
    	$this->form_validation->set_rules('user_newCPassword', 'Confirm New Password', 'trim|required');
    	if ($this->form_validation->run() == FALSE)
    	{
    		//$this->load->view('user/password_reset_view');
    		// validation fail    		
    		 }
    	else
    	{   		
    		
    		$this->changePassword($user_id,$newPassword);
    	}
    }
    
private     function changePassword($user_id,$newPassword){
    	$algo = 'sha256';
    	$newSalt = generate_salt(10);
    	$newHashpw = generate_hash($newSalt,$newPassword, $algo);
    	echo "salt:".$newSalt."   hesh:".$newHashpw;
    	$this->user_model->update_userPassword($user_id, $newHashpw,$newSalt);
    	
    }
    
}