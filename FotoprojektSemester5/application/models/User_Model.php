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
		
      function get_user($email, $pwd)
      {
      	$this->db->where('user_email', $email);
      	$this->db->where('user_password', md5($pwd));
      	$query = $this->db->get('user');
      	return $query->result();
      }
      
      // get user
      function get_user_by_id($id)
      {
      	$this->db->where('id', $id);
      	$query = $this->db->get('user');
      	return $query->result();
      }
      
      // insert
      function insert_user($data)
      {
      	return $this->db->insert('user', $data);
      }
   } 
?>
