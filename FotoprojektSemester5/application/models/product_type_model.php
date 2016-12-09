<?php
Class product_type_model extends CI_Model {
	 
	Public function __construct() {
		parent::__construct();
	}

	Public function get_product_type(){
		$query = $this->db->get("product_type");
		return $query->result();
	}
	
	// get user
	function get_product_type_by_id($id)
	{
		$this->db->where('prty_id', $id);
		$query = $this->db->get('product_type');
		return $query->result();
	}
	
	function getAllProductType()
	{
		$query = $this->db->get('product_type');
		return $query->result();
	}
	 
}
abstract class ProductPrintType
{
	const Print = 0;
	const Download = 1;
}
?>