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
      	$this->db->where('user_confirmcode', $user_confirmcode);
      	$this->db->update('user');
		return $afftectedRows = $this->db->affected_rows();      	
      }
      
      //set restorecode
      function update_userRestoreCode($user_id,$user_passwordrestore){      	 
      	$this->db->set('user_passwordrestore', $user_passwordrestore, FALSE);
      	$this->db->where('user_id', $user_id);
      	$this->db->update('user');
      }
      
      //passwordRestore     			
      function get_UserByRestoreCode($user_passwordrestore){	 
      	$this->db->where('user_passwordrestore', $user_passwordrestore);
      	$query = $this->db->get('user');
      	return $query->result();
      }
      
      //change Password
      function update_userPassword($user_id, $user_password,$user_salt){
      	$this->db->set('user_password', $user_password, FALSE);
      	$this->db->set('user_salt', $user_salt, FALSE);
      	$this->db->where('user_id', $user_id);
      	return $this->db->update('user');
      }

      public function update_user($usrArray){
         if(empty($usrArray) || !isset($usrArray["user_id"]))
            return FALSE;
         $this->db->where('user_id', $usrArray["user_id"]);
         unset($usrArray["user_id"]);
         return $this->db->update('user', $usrArray);
      }

      public function mail_exists($field_value){
         $this->db->where ( 'user_email', $field_value );
         $query = $this->db->get ( 'user' );
         
         if ($query->num_rows () > 0) {
            //user exists already
            return TRUE;
         }
         else{
            return FALSE;
         }
      }
   } 
?>
