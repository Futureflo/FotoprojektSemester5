<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );
class Checkout extends CI_Controller {
	public function index() {
		$this->load->template ( 'checkout/checkout_view' );
	}
	
	
	/**
	 * Method to pack Zip.
	 * #Author: Severin
	 */
	public function packZip() {
		// Mehtod
	}
	
	/**
	 * Method to unpack Zip.
	 * #Author: Severin
	 */
	public function unpackZip() {
		// Mehtod
	}
}
?>