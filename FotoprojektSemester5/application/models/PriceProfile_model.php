<?php
class PriceProfile_model extends CI_Model {
	Public function __construct() {
		parent::__construct ();
	}
	Public function getAllPriceProfiles() {
		$query = $this->db->get ( "price_profile" );
		return $query->result ();
	}
	Public function getPriceProfilesByUser($user_id) {
		$this->db->where ( 'prpr_user_id', $user_id );
		$query = $this->db->get ( "price_profile" );
		return $query->result ();
	}
	Public function getPriceProfileById($prpr_id) {
		$this->db->where ( 'prpr_id', $prpr_id );
		$query = $this->db->get ( "price_profile" );
		return $query->result ();
	}
	Public function getPricesById($prpr_id) {
		$this->db->join ( 'product_type', 'prty_id = prpt_prty_id', 'INNER' );
		$this->db->where ( 'prpt_prpr_id', $prpr_id );
		$this->db->where ( 'prty_status', ProductTypeStatus::activ );
		$query = $this->db->get ( "price_product_type" );
		return $query->result ();
	}
	Public function getPricesByPrinterId($prsu_id) {
		$this->db->join ( 'product_type', 'prty_id = prsp_prty_id', 'INNER' );
		$this->db->where ( 'prsp_prsu_id', $prsu_id );
		$this->db->where ( 'prty_status', ProductTypeStatus::activ );
		$query = $this->db->get ( "print_supplier_price" );
		return $query->result ();
	}
	Public function getPriceByProductType($prpr_id, $prty_id) {
		$this->db->join ( 'product_type', 'prty_id = prpt_prty_id', 'INNER' );
		$this->db->where ( 'prpt_prpr_id', $prpr_id );
		$this->db->where ( 'prpt_prty_id', $prty_id );
		$this->db->where ( 'prty_status', ProductTypeStatus::activ );
		$query = $this->db->get ( "price_product_type" );
		return $query->result ();
	}
	Public function getPriceByPrinterId($prsu_id, $prty_id) {
		$this->db->join ( 'product_type', 'prty_id = prsp_prty_id', 'INNER' );
		$this->db->where ( 'prsp_prsu_id', $prsu_id );
		$this->db->where ( 'prsp_prty_id', $prty_id );
		$this->db->where ( 'prty_status', ProductTypeStatus::activ );
		$query = $this->db->get ( "price_product_type" );
		return $query->result ();
	}
	
	// insert price_profile
	function insert_price_profile($data) {
		return $this->db->insert ( 'product', $data );
	}
	
	// delete price_profile
	function update_price_profile($prpr_id, $data) {
		$this->db->where ( 'prpr_id', $prpr_id );
		$this->db->update ( 'price_profile', $data );
	}
	
	// delete price_profile
	function delete_price_profile($prpr_id) {
		return $this->db->delete ( 'price_profile', array (
				'prpr_id' => $prpr_id 
		) );
	}
	
	// insert price_product_type
	function insert_price_product_type($data) {
		return $this->db->insert ( 'price_product_type', $data );
	}
	// insert print_supplier_price
	function insert_print_supplier_price($data) {
		return $this->db->insert ( 'print_supplier_price', $data );
	}
}
?>