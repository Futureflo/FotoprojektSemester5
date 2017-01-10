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
		$data ['events'] = Event::searchEvents ( $search );
		echo json_encode ( $data );
	}
}
