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
		$search = $this->input->post ( 'search' );
		
		$data ['events'] = Event::searchEvents ( $search );
		echo json_encode ( $data );
	}
	public function checkCode() {
		$code = $this->input->post ( 'event_code' );
		$event_id = $this->input->post ( 'event_id' );
		$shortcode = $this->input->post ( 'shortcode' );
		$this->load->model ( 'event_model' );
		$checked = $this->event_model->checkCode ( $event_id, $code );
		
		if ($checked) {
			redirect ( $shortcode );
		} else {
			$this->session->set_flashdata ( 'wrong_code', 'Falscher Bestätigungscode!' );
			redirect ( '/' );
		}
	}
}