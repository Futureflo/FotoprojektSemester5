<?php 
   Class event_model extends CI_Model {
	
      Public function __construct() { 
         parent::__construct(); 
      } 
      
      Public function getSingleEventByShortcode($shortcode){
      	$this->db->join('user', 'user_id = even_user_id', 'INNER JOIN');
      	$this->db->where('even_url', $shortcode);
      	$query = $this->db->get("event");
      	return $query->result();
      }
      
      Public function getProductsFromEvent($even_id){
      	$this->db->join('product_variant', 'prod_id = prva_prod_id', 'INNER');
      	$this->db->join('product_type', 'prty_id = prva_prty_id', 'INNER');
      	$this->db->where('prod_even_id', $even_id);
      	$query = $this->db->get("product");
      	return $query->result();
      }
		
   } 
?>