<?php 
   Class PriceProfile_model extends CI_Model {
	
      Public function __construct() { 
         parent::__construct(); 
      } 
      
      Public function getPriceProfilesByUser($user_id){
      	$this->db->where('prpr_user_id', $user_id);
      	$query = $this->db->get("price_profile");
      	return $query->result();
      }
      
      Public function getPriceProfileById($prpr_id){
      	$this->db->where('prpr_id', $prpr_id);
      	$query = $this->db->get("price_profile");
      	return $query->result();
      }
      
      Public function getPricesById($prpr_id){
      	$this->db->join('product_type', 'prty_id = prpt_prty_id', 'INNER');
      	$this->db->where('prpt_prpr_id', $prpr_id);
      	$query = $this->db->get("price_product_type");
      	return $query->result();
      }

      // insert price_profile
      function insert_price_profile($data)
      {
      	return $this->db->insert('product', $data);
      }
      
      //delete price_profile
      function update_price_profile($prpr_id, $data)
      {
      	$this->db->where('prpr_id', $prpr_id);
      	$this->db->update('price_profile', $data);
      }
      
      //delete price_profile
      function delete_price_profile($prpr_id)
      {
      	return $this->db->delete('price_profile', array('prpr_id' => $prpr_id));
      }
     		
   } 
?>