<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );
class Checkout extends CI_Controller {
	// 	https://www.tutorialspoint.com/codeigniter/codeigniter_tempdata.htm
	// 'item' will be erased after 300 seconds(5 minutes)
	// 	$this->session->mark_as_temp('item',300);
	
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