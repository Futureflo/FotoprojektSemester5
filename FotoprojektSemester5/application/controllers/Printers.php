<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );
class Printers extends CI_Controller {
	public function showPrinterPrice($prsu_id) {
		$this->load->model ( 'Printers_model' );
		
		$printer = Printers::getPrinter ( $prsu_id );
		$user_id = $printer->prsu_user_id;
		
		// nicht verwendete IDs speichern und in der Auswahl ausschließen
		$prty_ids = array ();
		foreach ( $printer->prices as $price ) {
			array_push ( $prty_ids, $price->prsp_prty_id );
		}
		
		$this->load->model ( 'product_type_model' );
		$printer->unused_prty = $this->product_type_model->getAllUnusedProductTypeByPrinter ( $printer->prsu_id, $prty_ids );
		$data ['printer'] = $printer;
		$this->load->template ( 'printers/single_printers_view.php', $data );
	}
	public static function getPrinter($prsu_id) {
		$CI = & get_instance ();
		$CI->load->model ( 'Printers_model' );
		$CI->load->model ( 'PriceProfile_model' );
		$printer = $CI->Printers_model->get_printer_by_id ( $prsu_id );
		$prices = $CI->PriceProfile_model->getPricesByPrinterId ( $prsu_id );
		$printer [0]->prices = $prices;
		return $printer [0];
	}
}
abstract class PrinterStatus {
	const undefined = 0;
	const activated = 1;
	const deleted = 2;
}
?>