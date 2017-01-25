<?php
class Product_model extends CI_Model {
	Public function __construct() {
		parent::__construct ();
	}
	Public function getAllProducts($even_id = 0) {
		$this->db->distinct ();
		
		$this->db->select ( 'prod_filepath, prod_name, prod_date' );
		
		if ($even_id != 0) {
			$this->db->where ( 'prod_even_id', $even_id );
		}
		$query = $this->db->get ( "product" );
		return $query->result ();
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
		$this->db->join ( 'event', 'prod_even_id = even_id', 'INNER JOIN' );
		$this->db->join ( 'price_product_type', 'prpt_prpr_id = even_prpr_id', 'INNER JOIN' );
		$this->db->join ( 'print_supplier_price', 'prsp_prsu_id = even_prsu_id', 'INNER JOIN' );
		$this->db->join ( 'product_type', 'prty_id = prsp_prty_id AND prty_id = prpt_prty_id', 'INNER JOIN' );
		$this->db->where ( 'prod_id', $prod_id );
		$query = $this->db->get ( "product" );
		
		return $query->result ();
	}
	Public function getProductVariantsForPrinterPriceProfile($prsp_id, $prpr_id) {
		$this->db->join ( 'price_product_type', 'prty_id = prpt_prty_id', 'INNER JOIN' );
		$this->db->join ( 'print_supplier_price', 'prty_id = prsp_prty_id', 'INNER JOIN' );
		$this->db->where ( 'prsp_prsu_id', $prsp_id );
		$this->db->where ( 'prpt_prpr_id', $prpr_id );
		$query = $this->db->get ( "product_type" );
		return $query->result ();
	}
	Public function getProductVariant($prod_id, $prty_id) {
		$this->db->join ( 'event', 'prod_even_id = even_id', 'INNER JOIN' );
		$this->db->join ( 'price_product_type', 'prpt_prpr_id = even_prpr_id', 'INNER JOIN' );
		$this->db->join ( 'print_supplier_price', 'prsp_prsu_id = even_prsu_id', 'INNER JOIN' );
		$this->db->join ( 'product_type', 'prty_id = prsp_prty_id AND prty_id = prpt_prty_id', 'INNER JOIN' );
		$this->db->where ( 'prod_id', $prod_id );
		$this->db->where ( 'prty_id', $prty_id );
		$query = $this->db->get ( "product" );
		$result = $query->result ();
		return $result [0];
	}
	Public function getUsedFileSize($user_id) {
		$this->db->join ( 'event', 'prod_even_id = even_id', 'INNER JOIN' );
		$this->db->where ( 'even_user_id', $user_id );
		$this->db->where ( 'prod_filesize IS NOT NULL' );
		$this->db->select_sum ( 'prod_filesize' );
		$query = $this->db->get ( 'product' );
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

	
	Public function getAllActiveProductsForEvent($even_id) {
		$this->db->where ( 'prod_even_id', $even_id );
		$this->db->where ( 'prod_status!=', "3" );
		$query = $this->db->get ( "product" );
		return $query->result ();
	}
	
}
?>