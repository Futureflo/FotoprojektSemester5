<?php
include_once (dirname ( __DIR__ ) . "/controllers/Product.php");
class Event_model extends CI_Model {
	Public function __construct() {
		parent::__construct ();
	}
	Public function getSingleEventByShortcode($shortcode) {
		$this->db->join ( 'user', 'user_id = even_user_id', 'INNER JOIN' );
		$this->db->where ( 'even_url', $shortcode );
		$query = $this->db->get ( "event" );
		return $query->result ();
	}
	Public function getProductsFromEvent($even_id, $private = false) {
		// $this->db->join('product_variant', 'prod_id = prva_prod_id', 'LEFT OUTER');
		// $this->db->join('product_type', 'prty_id = prva_prty_id', 'LEFT OUTER');
		$this->db->where ( 'prod_even_id', $even_id );
		if ($private == true) {
			$status = array (
					ProductStatus::prv_approved,
					ProductStatus::prv_locked 
			);
			$this->db->where_in ( 'prod_status', $status );
		} else
			$this->db->where ( 'prod_status', ProductStatus::pbl );
		$query = $this->db->get ( "product" );
		return $query->result ();
	}
	public function getAllArchivedEvents() {
		$this->db->where ( 'even_status =', 4 );
		$this->db->join ( 'user', 'even_user_id = user_id' );
		$query = $this->db->get ( "event" );
		return $query->result ();
	}
	Public function getSingleEventById($id) {
		$this->db->where ( 'even_id', $id );
		$this->db->join ( 'user', 'even_user_id = user_id' );
		$query = $this->db->get ( "event" );
		return $query->result ();
	}
	public function getEventsFromUser($id) {
		$this->db->where ( 'even_user_id', $id );
		$query = $this->db->get ( "event" );
		return $query->result ();
	}
	public function getEventsFromUserandEmail($id,$email) {
		$this->db->where ( 'even_user_id', $id );
		$this->db->or_where ( 'even_host_email', $email );
		$query = $this->db->get ( "event" );
		return $query->result ();
	}
	public function getAllEvents() {
		$query = $this->db->get ( "event" );
		return $query->result ();
	}
	public function getAllActivEvents() {
		$this->db->where ( 'even_status !=', 4 );
		$this->db->join ( 'user', 'even_user_id = user_id' );
		$query = $this->db->get ( "event" );
		return $query->result ();
	}
	public function getAllPublicEvents() {
		$this->db->where ( 'even_status', EventStatus::pbl );
		$query = $this->db->get ( "event" );
		return $query->result ();
	}
	public function search($even_name) {
		$this->db->like ( 'even_name', $even_name );
		$query = $this->db->get ( "event" );
		return $query->result ();
	}
	public function checkCode($event_id, $code) {
		$this->db->where ( 'even_id', $event_id );
		$this->db->where ( 'even_password', $code );
		$query = $this->db->get ( "event" );
		if ($query->result ()) {
			return true;
		}
		return false;
	}
	
	// insert
	function insert_event($data) {
		return $this->db->insert ( 'event', $data );
	}
	
	// delete user
	function update_event($id, $data) {
		$this->db->where ( 'even_id', $id );
		$this->db->update ( 'event', $data );
	}
	
	// delete user
	function delete_event($even_id) {
		return $this->db->update ( 'event', array (
				'even_status' => 4 
		), "even_id = " . $even_id . "" );
	}
	
	// get MAX-ID
	function get_max_id() {
		$maxid = 0;
		$row = $this->db->query ( 'SELECT MAX(even_id) AS `maxid` FROM event' )->row ();
		if ($row)
			$maxid = $row->maxid;
		return $maxid;
	}
}
?>