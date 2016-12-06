<?php 
   Class user_model extends CI_Model {
	
      Public function __construct() { 
         parent::__construct(); 
      } 
            
      Public function getAllUsers(){
      	$this->db->join('user_role', 'usro_id = user_role_id', 'LEFT OUTER');
      	$query = $this->db->get("user");
      	return $query->result();
      }
		
      function get_user($email)
      {
       	$this->db->where('user_email', $email);
      	$query = $this->db->get('user');
      	return $query->result();
      }
      
      // get user
      function get_user_by_id($id)
      {
      	$this->db->where('user_id', $id);
      	$query = $this->db->get('user');
      	return $query->result();
      }
     
      // insert
      function insert_user($data)
      {
      	return $this->db->insert('user', $data);
      }
      //delete user
      function get_delete_user($id)
      {
      	return $this->db->delete('user', $user_id);
      }
   } 
?>
