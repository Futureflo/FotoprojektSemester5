<?php
include_once (dirname ( __DIR__ ) . "/controllers/ProductType.php");
include_once (dirname ( __DIR__ ) . "/controllers/PriceProfileStatus.php");
class PriceProfile_model extends CI_Model {
	Public function __construct() {
		parent::__construct ();
	}
	Public function getAllPriceProfiles() {
		$this->db->join ( 'user', 'user_id = prpr_user_id', 'INNER JOIN' );
		$this->db->where ( 'prpr_status', PriceProfileStatus::activ );
		$query = $this->db->get ( "price_profile" );
		return $query->result ();
	}
	Public function getPriceProfilesByUser($user_id) {
		$this->db->join ( 'user', 'user_id = prpr_user_id', 'INNER JOIN' );
		$this->db->where ( 'prpr_user_id', $user_id );
		$this->db->where ( 'prpr_status', PriceProfileStatus::activ );
		$query = $this->db->get ( "price_profile" );
		return $query->result ();
	}
	Public function getAllArichvedPriceProfiles() {
		$this->db->join ( 'user', 'user_id = prpr_user_id', 'INNER JOIN' );
		$this->db->where ( 'prpr_status', PriceProfileStatus::deleted );
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
		$this->db->insert ( 'price_profile', $data );
		return $this->db->insert_id ();
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
	//
	// Druckereipreise
	//
	// insert price_product_type
	function insert_price_product_type($data) {
		return $this->db->insert ( 'price_product_type', $data );
	}
	// update price_product_type
	function update_price_product_type($data) {
		$this->db->where ( 'prpt_prpr_id', $data ['prpt_prpr_id'] );
		$this->db->where ( 'prpt_prty_id', $data ['prpt_prty_id'] );
		return $this->db->update ( 'price_product_type', $data );
	}
	
	// delete price_product_type
	function delete_price_product_type($data) {
		return $this->db->delete ( 'price_product_type', array (
				'prpt_prpr_id' => $data ['prpt_prpr_id'],
				'prpt_prty_id' => $data ['prpt_prty_id'] 
		) );
	}
	
	//
	// Druckereipreise
	//
	// insert print_supplier_price
	function insert_print_supplier_price($data) {
		return $this->db->insert ( 'print_supplier_price', $data );
	}
	
	// update print_supplier_price
	function update_print_supplier_price($data) {
		$this->db->where ( 'prsp_prsu_id', $data ['prsp_prsu_id'] );
		$this->db->where ( 'prsp_prty_id', $data ['prsp_prty_id'] );
		return $this->db->update ( 'print_supplier_price', $data );
	}
	
	// delete print_supplier_price
	function delete_print_supplier_price($data) {
		return $this->db->delete ( 'print_supplier_price', array (
				'prsp_prsu_id' => $data ['prsp_prsu_id'],
				'prsp_prty_id' => $data ['prsp_prty_id'] 
		) );
	}
}
?>