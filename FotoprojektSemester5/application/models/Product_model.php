<?php
class Product_model extends CI_Model {
	Public function __construct() {
		parent::__construct ();
	}
	Public function getProductsByEvent($even_id) {
		$this->db->join ( 'product_variant', 'prod_id = prva_prod_id', 'INNER JOIN' );
		$this->db->where ( 'prod_even_id', $even_id );
		$query = $this->db->get ( "product" );
		return $query->result ();
	}
	Public function getProductFilepath($prod_id) {
		$this->db->join ( 'product_type', 'prty_id = prva_prty_id', 'LEFT OUTER' );
		$this->db->join ( 'product_variant', 'prod_id = prva_prod_id', 'INNER JOIN' );
		$this->db->where ( 'prod_id', $prod_id );
		$query = $this->db->get ( "product" );
		return $query->result ();
	}
	Public function getSingleProduct($prod_id) {
		$this->db->where ( 'prod_id', $prod_id );
		$query = $this->db->get ( "product" );
		return $query->result ();
	}
	Public function getProductVariants($prod_id) {
		$this->db->join ( 'product_type', 'prty_id = prva_prty_id', 'LEFT OUTER' );
		$this->db->join ( 'product', 'prod_id = prva_prod_id', 'INNER JOIN' );
		$this->db->join ( 'event', 'prod_even_id = even_id', 'INNER JOIN' );
		$this->db->join ( 'print_supplier_price', 'prsp_prsu_id = even_prsu_id AND prsp_prty_id = prva_prty_id', 'INNER JOIN' );
		$this->db->where ( 'prva_prod_id', $prod_id );
		$query = $this->db->get ( "product_variant" );
		return $query->result ();
	}
	Public function getProductVariant($prod_id, $prty_id) {
		$this->db->join ( 'product_type', 'prty_id = prva_prty_id', 'LEFT OUTER' );
		$this->db->join ( 'product', 'prod_id = prva_prod_id', 'INNER JOIN' );
		$this->db->where ( 'prva_prod_id', $prod_id );
		$this->db->where ( 'prva_prty_id', $prty_id );
		$query = $this->db->get ( "product_variant" );
		$result = $query->result ();
		return $result [0];
	}
	
	// insert
	function insert_product($data) {
		$this->db->insert ( 'product', $data );
		return $this->db->insert_id ();
	}
	
	// delete product
	function update_product($id, $data) {
		$this->db->where ( 'prod_id', $id );
		$this->db->update ( 'product', $data );
	}
	
	// delete product
	function delete_product($even_id) {
		return $this->db->delete ( 'product', array (
				'prod_id' => $prod_id 
		) );
	}
	
	// get MAX-ID
	function get_max_id() {
		$maxid = 0;
		$row = $this->db->query ( 'SELECT MAX(prod_id) AS `maxid` FROM product' )->row ();
		if ($row)
			$maxid = $row->maxid;
		return $maxid;
	}
	
	// insert
	function insert_product_variant($data) {
		return $this->db->insert ( 'product_variant', $data );
	}
}
?>