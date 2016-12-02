<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );
class Picture extends CI_Controller {
	// 	https://www.tutorialspoint.com/codeigniter/codeigniter_tempdata.htm
	// 'item' will be erased after 300 seconds(5 minutes)
	// 	$this->session->mark_as_temp('item',300);

	
	public function index() {
		$this->load->template ( 'errors/404' );
	}
	public function showSinglePicture($picuri) {
		$data = array();
		$this->load->template ( 'picture/single_picture_view', $data );
	}
}
