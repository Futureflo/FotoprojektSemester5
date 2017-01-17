<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );
include_once (dirname ( __FILE__ ) . "/Event.php");
class Start extends CI_Controller {
	public function __construct() {
		parent::__construct ();
	}
	public function index() {
		$data ['events'] = Event::getAllPublicEvents ();
		$data ['allevents'] = Event::searchEvents ( '' );
		$this->load->template ( 'start_view', $data );
	}
	public function search() {
		$search = $this->uri->segment ( 3 );
		
		if (strpos ( $search, '%20' ) !== false) {
			$search = str_replace ( '%20', ' ', $search );
		}
		
		$data ['events'] = Event::searchEvents ( $search );
		echo json_encode ( $data );
	}
	public function checkCode() {
		$code = $this->input->post ( 'event_code' );
		$event_id = $this->input->post ( 'event_id' );
		$this->load->model ( 'event_model' );
		$checked = $this->event_model->checkCode ( $event_id, $code );
		echo $checked;
		if ($checked) {
			$this->load->template ( 'start_view' );
		} else {
			$this->load->template ( 'user/signup_view' );
		}
	}
}
