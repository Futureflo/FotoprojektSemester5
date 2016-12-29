<?php
class Product_type_model extends CI_Model {
	Public function __construct() {
		parent::__construct ();
	}
	Public function get_product_type() {
		$query = $this->db->get ( "product_type" );
		return $query->result ();
	}
	
	// get user
	function get_product_type_by_id($id) {
		$this->db->where ( 'prty_id', $id );
		$query = $this->db->get ( 'product_type' );
		return $query->result ();
	}
	function getAllProductType() {
		$this->db->join ( 'user', 'user_id = prty_user_id', 'INNER JOIN' );
		$query = $this->db->get ( 'product_type' );
		return $query->result ();
	}
	function getAllProductTypeForUser($user_id) {
		$this->db->where ( 'prty_user_id', $user_id );
		$this->db->or_where ( 'prty_user_id', 0 );
		$this->db->join ( 'user', 'user_id = prty_user_id', 'INNER JOIN' );
		$query = $this->db->get ( 'product_type' );
		return $query->result ();
	}
	function getAllUnusedProductTypeByPriceProfile($user_id, $prty_ids) {
		if (isset ( $prty_ids [0] )) {
			$this->db->where_not_in ( 'prty_id', $prty_ids );
		}
		$this->db->where ( 'prty_user_id', $user_id );
		$query = $this->db->get ( 'product_type' );
		return $query->result ();
	}
	
	// insert product_type
	function insert_product_type($data) {
		return $this->db->insert ( 'product_type', $data );
	}
	
	// delete product_type
	function update_product_type($prty_id, $data) {
		$this->db->where ( 'prpr_id', $prty_id );
		$this->db->update ( 'product_type', $data );
	}
	
	// delete product_type
	function delete_product_type($prty_id) {
		return $this->db->delete ( 'product_type', array (
				'prty_id' => $prty_id 
		) );
	}
}
?>