<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );
class Checkout extends CI_Controller {

	
	public function index() {
		$this->load->template ( 'checkout/checkout_view' );
	}
	
	
	
}
?>