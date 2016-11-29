<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Start extends CI_Controller {

	public function index()
	{	

		$this->load->view('general/header');
		$this->load->view('general/navbar_visitor');
		$this->load->view('start');
		$this->load->view('general/footer');
	}
}
