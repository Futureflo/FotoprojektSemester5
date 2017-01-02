<?php
class Printers_model extends CI_Model {
	private static $allPrinters;
	private static $allPrinterPrices;
	Public function __construct() {
		parent::__construct ();
	}
	Public function getAllPrinters() {
		
		// initialize return array
		$return = array ();
		
		// Get Printers from DB
		if (isset ( $GLOBALS ["allPrinters"] ) == false) {
			
			$this->db->join ( 'adress', 'prsu_adre_id = adre_id', 'INNER JOIN' );
			$query = $this->db->get ( 'print_supplier' );
			
			if ($query->num_rows () > 0) {
				
				$GLOBALS ["allPrinters"] = $query->result ();
			}
		}
		
		// Get Printer_Prices from DB
		if (isset ( $GLOBALS ["allPrinterPrices"] ) == false) {
			
			$query = $this->db->get ( 'print_supplier_price' );
			
			if ($query->num_rows () > 0) {
				
				$GLOBALS ["allPrinterPrices"] = $query->result ();
			}
		}
		$return = $GLOBALS ["allPrinters"];
		
		foreach ( $GLOBALS ["allPrinters"] as $Printer ) {
			$printerPrices = array ();
			foreach ( $GLOBALS ["allPrinterPrices"] as $PrinterPrice ) {
				if ($Printer->prsu_id == $PrinterPrice->prsp_prsu_id) {
					array_push ( $printerPrices, $PrinterPrice );
				}
			}
			$Printer->Prices = $printerPrices;
		}
		
		return $return;
	}
	Public function getSystemPrinters() {
		return $this->getPrintersForUser ( 0 );
	}
	Public function getPrintersForUser($userid, $withSystemPrinter = FALSE) {
		$Printers = array ();
		
		if (! isset ( $GLOBALS ["allPrinters"] ))
			$GLOBALS ["allPrinters"] = $this->getAllPrinters ();
		
		foreach ( $GLOBALS ["allPrinters"] as $Printer ) {
			if ($Printer->prsu_user_id == $userid || $Printer->prsu_user_id == 0) {
				array_push ( $Printers, $Printer );
			}
		}
		return $Printers;
	}
	public function getPrinterPriceByProducttype($prsu_id, $prty_id) {
		$Price = array ();
		
		if (! isset ( $GLOBALS ["allPrinterPrices"] )) {
			if (! isset ( $GLOBALS ["allPrinters"] ))
				$GLOBALS ["allPrinters"] = $this->getAllPrinters ();
		}
		foreach ( $GLOBALS ["allPrinterPrices"] as $PrinterPrice ) {
			if ($PrinterPrice->prsp_prsu_id == $prsu_id && $PrinterPrice->prsp_prty_id == $prty_id)
				return $PrinterPrice;
		}
	}
	
	// get deleted printer
	Public function get_AllArchivedPrinters() {
		// $this->db->join ( 'user_role', 'usro_id = user_role_id', 'LEFT OUTER' );
		$this->db->where ( 'user_status', UserStatus::deleted );
		$query = $this->db->get ( "user" );
		return $query->result ();
	}
	
	// get printer by email
	function get_printer($email) {
		$this->db->where ( 'prsu_email', $email );
		$query = $this->db->get ( 'print_suppliers' );
		return $query->result ();
	}
	
	// get printer by id
	function get_printer_by_id($id) {
		$this->db->where ( 'prsu_id', $id );
		$query = $this->db->get ( 'print_suppliers' );
		return $query->result ();
	}
	
	// get printeraddress by id
	function get_address_by_id($prsu_adre_id) {
		$this->db->where ( 'adre_id', $prsu_adre_id );
		$query = $this->db->get ( 'adress' );
		return $query->result ();
	}
	
	// insert new printer
	function insert_printer($data) {
		return $this->db->insert ( 'print_supplier', $data );
	}
	
	// delete printer
	function delete_printer($prsu_id) {
		return $this->db->delete ( 'print_supplier', array (
				'prsu_id' => $prsu_id 
		) );
	}
	
	// update user status by id
	function update_userStatusByID($user_id, $user_status) {
		$this->db->set ( 'user_status', $user_status );
		$this->db->where ( 'user_id', $user_id );
		$this->db->update ( 'user' );
		return $affectedRows = $this->db->affected_rows ();
	}
	
	// update user email by id
	function update_userEmailByID($user_id, $user_email) {
		$this->db->set ( 'user_email', $user_email );
		$this->db->where ( 'user_id', $user_id );
		$this->db->update ( 'user' );
		return $affectedRows = $this->db->affected_rows ();
	}
	public function update_user($usrArray) {
		if (empty ( $usrArray ) || ! isset ( $usrArray ["user_id"] ))
			return FALSE;
		$this->db->where ( 'user_id', $usrArray ["user_id"] );
		unset ( $usrArray ["user_id"] );
		return $this->db->update ( 'user', $usrArray );
	}
}
?>
