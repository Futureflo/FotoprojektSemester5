<?php
class User extends CI_Controller {
	public function __construct() {
		parent::__construct ();
		$this->load->library ( 'session' );
		$this->load->model('user_model');
		
	}
	public function index() {
		$this->load->template ( 'user/settings_view' );
	}
	public function showSingleUser($userid) {
		$data = array (
				"userid" => $userid 
		);
		$this->load->template ( 'user/single_user_view', $data );
	}
	function confirmAccount($user_confirmcode){
		
		$confrimcodeExists= $this->user_model->update_userStatus($user_confirmcode);
		echo $confrimcodeExists;
		echo $user_confirmcode;
		if ($confrimcodeExists == 1)
		{
			echo "Account ist bestätigt";
		}
		else {
			echo"Account ist nicht bestätigt";
		}
	}
	
	function logout() {
		// destroy session
		$data = array (
				'login' => '',
				'user_name' => '',
				'user_id' => '' 
		);
		$this->session->unset_userdata ( $data );
		$this->session->sess_destroy ();
		redirect ( 'start' );
	}
}
?>