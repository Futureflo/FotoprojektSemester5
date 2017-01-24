<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );
include_once (dirname ( __DIR__ ) . "/controllers/User.php");
class User_model extends CI_Model {
	Public function __construct() {
		parent::__construct ();
	}
	// get all aktiv Users
	Public function getAllUsers() {
		$this->db->join ( 'user_role', 'usro_id = user_role_id', 'LEFT OUTER' );
		$this->db->where ( 'user_status !=', UserStatus::deleted );
		$query = $this->db->get ( "user" );
		return $query->result ();
	}
	Public function getAllPhotographer($with_system = false) {
		$this->db->where ( 'user_role_id', UserRole::Photograph );
		if ($with_system)
			$this->db->or_where ( 'user_id', 0 );
		$query = $this->db->get ( "user" );
		return $query->result ();
	}
	
	// get deleted user
	Public function get_AllArchivedUsers() {
		$this->db->join ( 'user_role', 'usro_id = user_role_id', 'LEFT OUTER' );
		$this->db->where ( 'user_status', UserStatus::deleted );
		$query = $this->db->get ( "user" );
		return $query->result ();
	}
	
	// get user by email
	function get_user($email) {
		$this->db->where ( 'user_email', $email );
		$query = $this->db->get ( 'user' );
		return $query->result ();
	}
	
	// get user by id
	function get_user_by_id($id) {
		$this->db->where ( 'user_id', $id );
		$query = $this->db->get ( 'user' );
		return $query->result ();
	}
	
	// get useraddress by id
	function get_address_by_id($id) {
		$this->db->where ( 'adre_user_id', $id );
		$query = $this->db->get ( 'adress' );
		return $query->result ();
	}
	
	// get user by passwordRestoreCode
	function get_UserByRestoreCode($user_passwordrestore) {
		$this->db->where ( 'user_passwordrestore', $user_passwordrestore );
		$query = $this->db->get ( 'user' );
		return $query->result ();
	}
	
	// set restorecode
	function update_userRestoreCode($user_email, $user_passwordrestore) {
		$this->db->set ( 'user_passwordrestore', $user_passwordrestore );
		$this->db->where ( 'user_email', $user_email );
		$this->db->update ( 'user' );
		return $afftectedRows = $this->db->affected_rows ();
	}
	
	// unset restorecode
	function update_unsetUserRestoreCode($user_id) {
		$this->db->set ( 'user_passwordrestore', "" );
		$this->db->where ( 'user_id', $user_id );
		$this->db->update ( 'user' );
		return $afftectedRows = $this->db->affected_rows ();
	}
	
	// insert new User
	function insert_user($data) {
		 
		$this->db->insert ( 'user', $data );
		$user_id = $this->db->insert_id ();
		return $user_id;
	}
	
	// insert new Useraddress
	function insert_address($data) {
		return $this->db->insert ( 'adress', $data );
	}
	
	// insert new Bankaccount
	function insert_bankaccount($data) {
		return $this->db->insert ( 'payment_information', $data );
	}
	
	// delete user
	function delete_user($user_id) {
		return $this->db->delete ( 'user', array (
				'user_id' => $user_id 
		) );
	}
	// update user status
	function update_userStatus($user_confirmcode) {
		$this->db->set ( 'user_status', UserStatus::activated, FALSE );
		$this->db->where ( 'user_confirmcode', $user_confirmcode );
		$this->db->update ( 'user' );
		return $afftectedRows = $this->db->affected_rows ();
	}
	// update user tradelicense
	function update_userTradelicenseByID($user_id, $user_tradelicenseurl) {
		$this->db->set ( 'user_tradelicenseurl', $user_tradelicenseurl );
		$this->db->where ( 'user_id', $user_id );
		$this->db->update ( 'user' );
		return $afftectedRows = $this->db->affected_rows ();
	}
	// update user status by id
	function update_userStatusByID($user_id, $user_status) {
		$this->db->set ( 'user_status', $user_status );
		$this->db->where ( 'user_id', $user_id );
		$this->db->update ( 'user' );
		return $afftectedRows = $this->db->affected_rows ();
	}
	function update_userPasswordAttempt($user_email, $user_passwordattempt) {
		$this->db->set ( 'user_passwordattempt', $user_passwordattempt );
		$this->db->where ( 'user_email', $user_email );
		$this->db->update ( 'user' );
		return $afftectedRows = $this->db->affected_rows ();
	}
	
	// update user email by id
	function update_userEmailByID($user_id, $user_email) {
		$this->db->set ( 'user_email', $user_email );
		$this->db->where ( 'user_id', $user_id );
		$this->db->update ( 'user' );
		return $afftectedRows = $this->db->affected_rows ();
	}
	
	// change Password
	function update_userPassword($user_id, $user_password, $user_salt, $user_status) {
		$this->db->set ( 'user_status', $user_status );
		$this->db->set ( 'user_password', $user_password );
		$this->db->set ( 'user_salt', $user_salt );
		$this->db->where ( 'user_id', $user_id );
		return $this->db->update ( 'user' );
	}
	public function update_user($usrArray) {
		if (empty ( $usrArray ) || ! isset ( $usrArray ["user_id"] ))
			return FALSE;
		$this->db->where ( 'user_id', $usrArray ["user_id"] );
		unset ( $usrArray ["user_id"] );
		return $this->db->update ( 'user', $usrArray );
	}
	public function exists($key, $value) {
		$this->db->where ( $key, $value );
		$query = $this->db->get ( 'user' );
		
		if ($query->num_rows () != 0) {
			// value exists already
			return TRUE;
		} else {
			return FALSE;
		}
	}
	public function mail_exists($field_value) {
		$this->db->where ( 'user_email', $field_value );
		$query = $this->db->get ( 'user' );
		
		if ($query->num_rows () > 0) {
			// user exists already
			return TRUE;
		} else {
			return FALSE;
		}
	}
	
	// add User to Newsletter
	function update_addUserToNewsletter($user_id) {
		$this->db->set ( 'user_newsletter', TRUE );
		$this->db->where ( 'user_id', $user_id );
		$this->db->update ( 'user' );
		return $afftectedRows = $this->db->affected_rows ();
	}
	
	// add User to Newsletter
	function update_unregisterUserToNewsletter($user_id) {
		$this->db->set ( 'user_newsletter', FALSE );
		$this->db->where ( 'user_id', $user_id );
		$this->db->update ( 'user' );
		return $afftectedRows = $this->db->affected_rows ();
	}
	
	// add unkonwn User to Newsletter
	function insert_UserToNewsletter($data) {
		return $this->db->insert ( 'newsletter', $data );
	}
	
	// add unkonwn User to Newsletter
	function update_NewsletterStatusUnregister($email) {
		$this->db->set ( 'user_newsletter', false );
		$this->db->where ( 'user_id', $email );
		$this->db->update ( 'user' );
		$returnUserNele = $afftectedRows = $this->db->affected_rows ();
		
		$this->db->set ( 'nele_status', FALSE );
		$this->db->where ( 'nele_email', $email );
		$this->db->update ( 'newsletter' );
		return $afftectedRows = $this->db->affected_rows ();
	}
	function checkNewsletterEmail($email) {
		$this->db->where ( 'nele_email', $email );
		$query = $this->db->get ( 'newsletter' );
		if ($query->num_rows () > 0) {
			// email exists already
			return TRUE;
		} else {
			return FALSE;
		}
	}
	
	// get all UserEmails Newsletter
	function getNewsletterEmailsFromExistingUser() {
		 $this->db->select('user_title as Anrede, user_name as Nachname, user_firstname as Vorname, user_email as E_Mail');
		 $this->db->from('user');
		 $this->db->where ( 'user_newsletter', TRUE );		 	
		 $query = $this->db->get();
		 return $query;		 	
	}
	// get all UserEmails Newsletter
	function getNewsletterEmailsFromUnkownUser() {
		$this->db->select('nele_email as E_Mail');
		$this->db->from('newsletter');
		$query = $this->db->get();
		return $query;
	}
	// get Abo
	function getAbo($user_id) {
		$this->db->join ( 'abo_fotograf', 'user_abof_id = abof_id' );
		$this->db->where ( 'user_id', $user_id );
		$query = $this->db->get ( 'user' );
		$query = $this->db->get();
		return $result [0];
	}
}
?>
