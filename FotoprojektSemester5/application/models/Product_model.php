<?php 
   Class Product_model extends CI_Model {
	
      Public function __construct() { 
         parent::__construct(); 
      } 
      
      Public function getProductsByEvent($even_id){
      	$this->db->join('product_variant', 'prod_id = prva_prod_id', 'INNER JOIN');
      	$this->db->where('prod_even_id', $even_id);
      	$query = $this->db->get("product");
      	return $query->result();
      }
      
      // insert
      function insert_product($data)
      {
      	return $this->db->insert('product', $data);
      }
      
      //delete user
      function update_product($id, $data)
      {
      	$this->db->where('prod_id', $id);
      	$this->db->update('product', $data);
      }
      
      //delete user
      function delete_product($even_id)
      {
      	return $this->db->delete('product', array('prod_id' => $prod_id));
      }
      
      // get MAX-ID
      function get_max_id(){
      	$maxid = 0;
      	$row = $this->db->query('SELECT MAX(prod_id) AS `maxid` FROM product')->row();
      	if ($row)  $maxid = $row->maxid;
      	return $maxid;
      }
      
     		
   } 
?>