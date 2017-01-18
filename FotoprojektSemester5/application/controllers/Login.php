<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );
include_once (dirname ( __FILE__ ) . "/User.php");
class Login extends CI_Controller {
	public function __construct() {
		parent::__construct ();
		$this->load->helper ( array (
				'form',
				'html',
				'hash_helper' 
		) );
		$this->load->library ( array (
				'form_validation' 
		) );
		$this->load->database ();
		$this->load->model ( 'user_model' );
	}
	public function index() {
		// get form input
		$email = $this->input->post ( "user_email" );
		$password = $this->input->post ( "user_password" );
		
		// form validation
		$this->form_validation->set_rules ( "user_email", "Email-ID", "trim|required|valid_email|callback_user_exists" );
		$this->form_validation->set_rules ( "user_password", "Password", "trim|required" );
		
		if ($this->form_validation->run () == FALSE) {
			// validation fail
			$this->session->set_flashdata ( 'msg', 'Falsche E-Mail-Adresse oder Passwort' );
			redirect ( "/" );
		} else {
			$uresult = $this->user_model->get_user ( $email );
			$status = $uresult [0]->user_status;
			switch ($status) {
				
				case UserStatus::unconfirmed :
					$this->session->set_flashdata ( 'msg', 'Sie müssen ihre E-Mail-Adresse bestätigen bevor Sie sich einloggen' );
					redirect ( "/" );
					break;
				case UserStatus::locked :
					
					$this->session->set_flashdata ( 'msg', 'Ihr Account wurde gesperrt, da Sie Ihr Passwort zu oft falsch eingegeben haben. Kontaktieren Sie den Admin oder setzten Sie ihr Passwort über "Passwort vergessen" zurück' );
					redirect ( "/" );
					
					break;
				case UserStatus::lockedByAdmin :
					
					$this->session->set_flashdata ( 'msg', 'Ihr Account wurde gesperrt. Kontaktieren Sie bitte den Admin' );
					redirect ( "/" );
					
					break;
				
				case UserStatus::deleted :
					// message for deleted user
					$this->session->set_flashdata ( 'msg', 'Ihr Account wurde gelöscht. Kontaktieren Sie bitte den Admin' );
					redirect ( "/" );
					
					break;
				
				case UserStatus::activated :
					
					// check for user credentials
					$user_salt = $uresult [0]->user_salt;
					$algo = 'sha256';
					
					$hashpw = generate_hash ( $user_salt, $password, $algo );
					$user_password = $uresult [0]->user_password;
					
					if (strcmp ( $hashpw, $user_password ) == 0) {						
						// reset password attemps
						$this->user_model->update_userPasswordAttempt ( $email, 0 );
						
						//check shoppingcart and transfer positions
						$user_id = $this->session->userdata ( 'user_id' );
						if($user_id != null){
							$this->load->model ( 'shoppingcart_model' );								
							$cart = $this->shoppingcart_model->getShoppingCart ( $user_id );
							
							//destroy AnonymousUser session
							$data = array (
									'login' => '',
									'user_id' => '',
									'user_role' => ''
							);
							$this->session->unset_userdata ( $data );
							$this->session->sess_destroy ();
						}
						
						// set session
						$sess_data = array (
								'login' => TRUE,
								'user_id' => $uresult [0]->user_id,
								'user_email' => $uresult [0]->user_email,
								'user_name' => $uresult [0]->user_name,
								'user_firstname' => $uresult [0]->user_firstname,
								'user_status' => $uresult [0]->user_status,
								'user_role' => $uresult [0]->user_role_id
						);
						$this->session->set_userdata ( $sess_data );
						redirect ( $_SERVER ['HTTP_REFERER'] );
					} else {
						
						$passwordAttempt = $uresult [0]->user_passwordattempt;
						if ($passwordAttempt == null) {
							$passwordAttempt = 0;
						}
						$passwordAttempt ++;
						
						$this->user_model->update_userPasswordAttempt ( $email, $passwordAttempt );
						if ($passwordAttempt > 4) {
							$this->user_model->update_userStatusByID ( $uresult [0]->user_id, UserStatus::locked );
						} else {
							$this->session->set_flashdata ( 'msg', 'Falsche E-Mail-Adresse oder Passwort' );
						}
						
						redirect ( "/" );
					}
					
					break;
				default :
					// default
					$this->session->set_flashdata ( 'msg', 'Allgemeiner Fehler bei der Anmeldung. Kontaktieren Sie bitte den Admin!' );
					redirect ( "/" );
					
					break;
			}
		}
	}
	public function confirmAccount($user_confirmcode) {
		$confrimcodeExists = $this->user_model->update_userStatus ( $user_confirmcode );
		if ($confrimcodeExists == 1) {
			$this->session->set_flashdata ( 'msg', 'Ihre E-Mail wurde erfolgreich bestätigt' );
			redirect ( '/' );
		} else {
			redirect ( '/' );
		}
	}
	public function forgotPassword() {
		$user_email = $this->input->post ( "email" );
		
		$this->form_validation->set_rules ( 'email', '"Email"', 'trim|required|valid_email|callback_user_exists' );
		$this->form_validation->set_message ( 'user_exists', 'Das Passwort kann nicht zurückgesetzt werden, weil kein Benutzer mit der angegebenen E-Mail-Adresse gefunden wurde' );
		
		if ($this->form_validation->run () == FALSE) {
			$this->load->template ( 'user/password_forgot_view' );
		} else {
			// ceck first if user wasn't lockedByAdmin
			$uresult = $this->user_model->get_user ( $user_email );
			if ($uresult [0]->user_status == UserStatus::lockedByAdmin) {
				$this->session->set_flashdata ( 'pwlocked', 'Solange ihr Account gesperrt ist können Sie ihr Passwort nicht zurück setzen. Kontaktieren Sie bitte den Admin für weitere Informationen' );
				redirect ( "login/forgotPassword" );
			} else {
				// check if restoreCode allready exists
				do {
					$restoreCode = generate_salt ( 10 );
					$CodeExists = $this->user_model->exists ( 'user_passwordrestore', $restoreCode );
				} while ( $CodeExists == true );
				
				$this->user_model->update_userRestoreCode ( $user_email, $restoreCode );
				$this->sendPassowrdForgotEmail ( $user_email, $restoreCode );
				$this->load->template ( 'user/success_password_forgot_view' );
			}
		}
	}
	function sendPassowrdForgotEmail($user_email, $PassowrdForgotCode) {
		$this->load->library ( 'email' );
		
		$this->email->from ( 'noReply@snapUp.de', 'SnapUp' );
		$this->email->to ( $user_email );
		$this->email->subject ( 'SnapUp Passwort zurücksetzen' );
		$this->email->message ( 'Sie können unter dem Folgenden Link ihr neues Passwort eingeben ' . base_url () . "login/restorePassword/" . $PassowrdForgotCode );
		$this->email->send ();
	}
	function user_exists($str) {
		$field_value = $str; // this is redundant, but it's to show you how
		                     // the content of the fields gets automatically passed to the method
		
		if ($this->user_model->mail_exists ( $field_value )) {
			return TRUE;
		} else {
			return FALSE;
		}
	}
	function restorePassword($user_passwordrestore) {
		$uresult = $this->user_model->get_UserByRestoreCode ( $user_passwordrestore );
		
		if ($uresult [0] != Null) {
			$data ['user_id'] = $uresult [0]->user_id;
			
			$this->load->template ( 'user/password_reset_view', $data );
		} else {
			redirect ( '/' );
		}
	}
	function getNewPassword() {
		$newPassword = $this->input->post ( "user_newPassword" );
		$newCPassword = $this->input->post ( "user_newCPassword" );
		$user_id = $this->input->post ( 'user_id' );
		$this->form_validation->set_rules ( 'user_newPassword', 'New Password', 'trim|required|matches[user_newCPassword]' );
		$this->form_validation->set_rules ( 'user_newCPassword', 'Confirm New Password', 'trim|required' );
		if ($this->form_validation->run () == FALSE) {
			// validation fail
			// $this->session->set_flashdata ( 'msg', 'Das Passwort mit dem wiederholten Passwort übereinstimmen' );
		} else {
			
			$this->changePassword ( $user_id, $newPassword );
			$this->user_model->update_unsetUserRestoreCode ( $user_id );
				
			redirect ( "/" );
		}
	}
	private function changePassword($user_id, $newPassword) {
		$algo = 'sha256';
		$newSalt = generate_salt ( 10 );
		$newHashpw = generate_hash ( $newSalt, $newPassword, $algo );
		$this->user_model->update_userPassword ( $user_id, $newHashpw, $newSalt, UserStatus::activated );
		$this->session->set_flashdata ( 'msg', 'Ihr Passwort wurde erfolgreich geändert' );
	}
}