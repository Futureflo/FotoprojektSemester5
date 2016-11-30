<?php
class User extends CI_Controller {
	public function __construct() {
		parent::__construct ();
		$this->load->library ( 'session' );
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
	function logout() {
		// destroy session
		$data = array (
				'login' => '',
				'uname' => '',
				'uid' => '' 
		);
		$this->session->unset_userdata ( $data );
		$this->session->sess_destroy ();
		redirect ( 'home/index' );
	}
}
?>