<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include_once (dirname(__FILE__) . "/Event.php");

class Start extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
	}
	

	public function index()
	{	
		$this->load->model ( 'Event_model' );
		$data ['events'] = $this->Event_model->getAllPublicEvents();
		$this->load->template ( 'start_view', $data);
	}

}
