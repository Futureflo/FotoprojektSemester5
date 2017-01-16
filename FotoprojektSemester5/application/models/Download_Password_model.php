<?php
class Download_Password_model extends CI_Model {
	Public function __construct() {
		parent::__construct ();
	}

	Public function getDownloadPasswords() {
		$query = $this->db->get ( 'download_password' );
// 		$this->db->where ( 'orde_id', $orde_id );
// 		$query = $this->db->get ( "order" );
		return $query->result ();
	}
	
	Public function getDownloadPasswordStatusByPassword($downloadPassword) {
		$query = $this->db->get ( 'download_password' );
		$this->db->where ( 'dopa_password',  $downloadPassword);
		// TODO: select only Status
		return $query->result ();
	}
	
	Public function getDownloadPasswordOrderIDByPassword($downloadPassword) {
		$query = $this->db->get ( 'download_password' );
		$this->db->where ( 'dopa_password',  $downloadPassword);
		// TODO: select only orderID
		return $query->result ();
	}
	
	Public function getDownloadPasswordEntryByPassword($downloadPassword) {
		$query = $this->db->get ( 'download_password' );
		$this->db->where ( 'dopa_password',  $downloadPassword);
		return $query->result ();
	}
	
	Public function insertDownloadPassword($data) {
		$this->db->insert ( 'download_password', $data );
		return $this->db->insert_id ();
	}
}
?>