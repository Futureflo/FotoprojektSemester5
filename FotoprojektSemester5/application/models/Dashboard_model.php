<?php
class Dashboard_model extends CI_Model {
	Public function __construct() {
		parent::__construct ();
	}

	public function getInformations() {
		$this->db->join ( 'user', 'orde_user_id = user_id' );
		$this->db->group_by("orde_id");
		$query = $this->db->get ( "order" );
		return $query->result ();
	}
	
	public function getInformationsByUserID($userID) {
		$this->db->where ( 'user_id', $userID );
		$this->db->join ( 'order_position', 'orpo_orde_id = orde_id');
		$this->db->join ( 'product', 'orpo_prod_id = prod_id');
		$this->db->join ( 'event', 'prod_even_id = even_id');
		$this->db->join ( 'user', 'even_user_id = user_id');
		$this->db->group_by("orde_id");
		$query = $this->db->get ( "order" );
		return $query->result ();
	}
}
?>