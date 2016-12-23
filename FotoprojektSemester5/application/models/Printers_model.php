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
}
?>
