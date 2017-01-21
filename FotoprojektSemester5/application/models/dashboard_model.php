<?php
class dashboard_model extends CI_Model {
	Public function __construct() {
		parent::__construct ();
	}
	
	public function getInformations() {
		$this->db->join ( 'user', 'orde_user_id = user_id' );
		$query = $this->db->get ( "order" );
		return $query->result ();
	}
}	
?>