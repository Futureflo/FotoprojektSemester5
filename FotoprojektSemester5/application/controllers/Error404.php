<?php
class Error404 extends CI_Controller {
	public function __construct() {
		parent::__construct ();
	}
	public function index() {
		$this->load->template ( 'errors/html/error_404.php' );
	}
}
?>