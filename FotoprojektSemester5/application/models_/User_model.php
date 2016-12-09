<?php 
   Class User_model extends CI_Model {
	
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
      function delete_user($user_id)
      {
      	return $this->db->delete('user', array('user_id' => $user_id));
      }
      //update usere status
      function update_userStatus($user_confirmcode){
      $this->db->set('user_status', 2, FALSE);
      $this->db->where('user_confirm_code', $user_confirmcode);
      $this->db->update('user');
      }
   } 
?>
