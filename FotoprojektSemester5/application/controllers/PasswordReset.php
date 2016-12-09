<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PasswordReset extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
	}


	public function index()
	{
		$this->load->template ( 'user/password_reset_view' );
	}

}
?>