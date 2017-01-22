<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );
include_once (dirname ( __DIR__ ) . "/controllers/PrintersCreation.php");
class PrintersCreation_model extends CI_Model {
	Public function __construct() {
		parent::__construct ();
	}
	
	// insert printer
	function insert_printer($data) {
		$this->db->insert ( 'print_supplier', $data );
		return $this->db->insert_id ();
	}
	// insert address
	function insert_address($data) {
		$this->db->insert ( 'adress', $data );
		return $this->db->insert_id ();
	}
}
?>