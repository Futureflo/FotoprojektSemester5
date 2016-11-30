<?php 
   Class event_model extends CI_Model {
	
      Public function __construct() { 
         parent::__construct(); 
      } 
      
      Public function getSingleEventByShortcode($shortcode){
      	$this->db->where('even_url', $shortcode);
      	$query = $this->db->get("event");
      	return $query->result();
      }
		
   } 
?>