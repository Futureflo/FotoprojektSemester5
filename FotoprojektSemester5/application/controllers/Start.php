<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Start extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
	}
	

	public function index()
	{	
		$this->load->library(array('form_validation'));
		$this->load->template ( 'start_view' );
	}

}
