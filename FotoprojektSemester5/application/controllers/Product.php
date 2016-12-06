<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );
class Product extends CI_Controller {

	public function index() {
		$this->load->template ( 'errors/404' );
	}
	public function showSinglePicture($picuri) {
		$data = array();
		$this->load->template ( 'product/single_picture_view', $data );
	}
}
