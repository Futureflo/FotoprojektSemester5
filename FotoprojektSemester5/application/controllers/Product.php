<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );
include_once (dirname ( __FILE__ ) . "/PriceProfile.php");
include_once (dirname ( __FILE__ ) . "/Event.php");
include_once (dirname ( __FILE__ ) . "/WaterMark.php");
class Product extends CI_Controller {
	const base_path = "/Images/";
	private static $event;
	public function __construct() {
		parent::__construct ();
		$this->load->library ( 'session' );
		$this->load->library ( array (
				'form_validation' 
		) );
	}
	public function index() {
		$this->load->template ( 'errors/404' );
	}
	public function showSinglePicture($prod_id) {
		$data ['product'] = Product::getProduct ( $prod_id );
		$this->load->template ( 'product/single_picture_view', $data );
	}
	public static function buildFilePath($p, $thumb = false) {
		// Datum-String in Datum umwandeln
		$date = date_create ( $p->prod_date );
		
		if ($thumb == true) {
			
			$filename = Product::get_name ( $p->prod_filepath ) . '_thumb' . Product::get_fileext ( $p->prod_filepath );
		} else {
			$filename = $p->prod_filepath;
		}
		
		// Dateipfad erstellen. Bsp.: "/Images/2016/12/001.png"
		$path = Product::base_path . date_format ( $date, "o/m" ) . "/" . $filename;
		return $path;
	}
	public static function getProduct($prod_id, $thumb = false) {
		$CI = & get_instance ();
		$CI->load->model ( 'product_model' );
		$product = $CI->product_model->getSingleProduct ( $prod_id );
		$product [0]->product_variants = Product::getProductVariants ( $prod_id );
		$product [0]->prod_filepath = Product::buildFilePath ( $product [0], $thumb );
		return $product [0];
	}
	public static function getProductVariants($prod_id) {
		$CI = & get_instance ();
		$CI->load->model ( 'product_model' );
		$product_variants = $CI->product_model->getProductVariants ( $prod_id );
		
		// Varianten zu Produkt laden
		foreach ( $product_variants as $product_variant => $pv ) {
			
			// $pv->price = Product::getVariantPrice ( $pv );
			$product_variants [$product_variant]->price = Product::getVariantPrice ( $pv );
			// $product_variants [$product_variant] = Product::getProductVariant ( $prod_id, $pv->prty_id );
		}
		
		return $product_variants;
	}
	public static function getProductVariant($prod_id, $prty_id) {
		$CI = & get_instance ();
		$CI->load->model ( 'product_model' );
		$pv = $CI->product_model->getProductVariant ( $prod_id, $prty_id );
		$pv->price = Product::getVariantPrice ( $pv );
		
		return $pv;
	}
	public static function getPrintersProductPrice($prsu_id, $prty_id) {
		$CI = & get_instance ();
		$CI->load->model ( 'printers_model' );
		$PrinterPrice = $CI->printers_model->getPrinterPriceByProducttype ( $prsu_id, $prty_id );
		if ($PrinterPrice)
			return $PrinterPrice->prsp_price;
		else
			return NULL;
	}
	public static function getVariantPrice($product_variant) {
		// Basispreis aus Preisprofil
		// event-Cache
		if (isset ( $GLOBALS ["event"] ) == false) {
			$event = Event::getSingleEventById ( $product_variant->prod_even_id );
			$GLOBALS ["event"] = $event;
		} else {
			$event = $GLOBALS ["event"];
		}
		
		$prpr_id = $event->even_prpr_id;
		$prty_id = $product_variant->prty_id;
		$prsu_id = $event->even_prsu_id;
		$user_commision = $event->user_commision;
		
		return Product::getPrice ( $prpr_id, $prty_id, $prsu_id, $user_commision );
	}
	public static function getPrice($prpr_id, $prty_id, $prsu_id, $user_commision) {
		// Basispreis
		$profile = PriceProfile::getPriceByProductType ( $prpr_id, $prty_id );
		if (isset ( $profile ))
			$price_basic = $profile->prpt_price;
		else {
			$price_basic = 0;
		}
		
		// Preisaufschlag Fotograf
		if (isset ( $product_variant->prva_price_specific )) {
			$prva_price_specific = $product_variant->prva_price_specific;
		} else {
			$prva_price_specific = 0;
		}
		
		// Preisaufschlag von Druckerei
		$price_supplier = Product::getPrintersProductPrice ( $prsu_id, $prty_id );
		if (! isset ( $price_supplier )) {
			$price_supplier = 0;
		}
		// Preis zusammensetzen
		$price_sum = floatval ( $price_basic ) + floatval ( $prva_price_specific ) + floatval ( $price_supplier );
		
		// Provision ergänzen
		$price_provision = floatval ( $price_sum ) * floatval ( $user_commision );
		$price_provision = round ( $price_provision, 2 );
		$price_sum = $price_sum + floatval ( $price_provision );
		$price_sum = round ( $price_sum, 2 );
		
		$price = array (
				'price_basic' => $price_basic,
				'price_specific' => $prva_price_specific,
				'price_supplier' => $price_supplier,
				'price_provision' => $price_provision,
				'price_sum' => $price_sum 
		);
		
		return $price;
	}
	public function insert() {
		// $this->form_validation->set_rules('dateiupload', 'Dateiname', 'trim|required|min_length[3]|max_length[30]');
		
		// Konstanten setzten
		// Administatoren und Fotografen uploaden öffentliche Bilder
		// Alle anderen Uploads werden bis zur Freigabe gesperrt erstmal
		$userrolle = $this->session->user_role;
		switch ($userrolle) {
			case UserRole::Admin :
			case UserRole::Photograph :
				$prod_status = ProductStatus::pbl;
				break;
			default :
				$prod_status = ProductStatus::prv_locked;
				break;
		}
		
		$prod_date = date ( "Y-m-d H:i:s" );
		
		// Event laden
		$prod_even_id = $this->input->post ( 'even_id' );
		$this->load->model ( 'event_model' );
		$event = $this->event_model->getSingleEventById ( $prod_even_id );
		
		$files = $_FILES;
		$cpt = count ( $_FILES ['dateiupload'] ['name'] );
		for($i = 0; $i < $cpt; $i ++) {
			// Dateidaten können geändert werden
			$filename = $files ['dateiupload'] ['name'] [$i];
			
			if ($filename) {
				$prod_name = Product::get_name ( $filename );
				$prod_filepath = $filename;
				$prod_filesize = $files ['dateiupload'] ['size'] [$i];
				
				$data = array (
						'prod_date' => $prod_date,
						'prod_even_id' => $prod_even_id,
						'prod_name' => $prod_name,
						'prod_status' => $prod_status,
						'prod_filepath' => $prod_filepath,
						'prod_filesize' => $prod_filesize 
				);
				
				$this->load->model ( 'product_model' );
				
				// Produkt einfügen
				$new_prod_id = $this->product_model->insert_product ( $data );
				
				// Den neuen Dateinamen aus der ID des Bildes generieren
				$new_filename = $new_prod_id . Product::get_fileext ( $filename );
				$data ['prod_filepath'] = $new_filename;
				$files ['dateiupload'] ['name'] [$i] = $new_filename;
				
				// Den neuen Dateinamen in der Datenbank abspeichern
				$this->product_model->update_product ( $new_prod_id, $data );
				
				$file = array (
						'name' => $files ['dateiupload'] ['name'] [$i],
						'type' => $files ['dateiupload'] ['type'] [$i],
						'tmp_name' => $files ['dateiupload'] ['tmp_name'] [$i],
						'error' => $files ['dateiupload'] ['error'] [$i],
						'size' => $files ['dateiupload'] ['size'] [$i] 
				);
				
				// Originalbild hochladen
				$this->upload ( '..' . Product::base_path, $file );
				
				$newPath = $this->upload ( '.' . Product::base_path, $file );
				
				// // Wasserzeichen hochladen erzeugen
				Watermarkdemo::watermark ( $newPath );
				Watermarkdemo::thumb ( $newPath );
				
				//
			} else {
				// error
				$this->session->set_flashdata ( 'upload_file', '<div class="alert alert-danger text-center">Keine Datei ausgewählt!!!</div>' );
			}
		}
		
		// Eventseite neu laden
		redirect ( 'event/' . $event [0]->even_url );
	}
	static function get_name($filename) {
		$name = "";
		$pos = strpos ( $filename, "\\" );
		$pos2 = strrpos ( $filename, "." );
		
		$name = substr ( $filename, $pos, $pos2 );
		return $name;
	}
	static function get_fileext($filename) {
		$pos2 = strrpos ( $filename, "." );
		
		$ext = substr ( $filename, $pos2, strlen ( $filename ) - $pos2 );
		return $ext;
	}
	function upload($path, $file) {
		// Monat und Jahr für Uploadordner festlegen
		$month = date ( 'm' );
		$year = date ( 'Y' );
		
		$upload_path = $path . $year . '/' . $month . '/';
		
		// Verzeichnis anlegen wenn nicht vorhanden
		if (! file_exists ( $upload_path )) {
			mkdir ( $upload_path, 0777, true );
		}
		
		// Upload-Einstellungen setzten
		$config ['upload_path'] = $upload_path;
		$config ['allowed_types'] = 'gif|jpg|png';
		$this->load->library ( 'upload', $config );
		$this->upload->initialize ( $config );
		// Den Kontainer für den Upload füllen
		$_FILES ['dateiupload'] ['name'] = $file ['name'];
		$_FILES ['dateiupload'] ['type'] = $file ['type'];
		$_FILES ['dateiupload'] ['tmp_name'] = $file ['tmp_name'];
		$_FILES ['dateiupload'] ['error'] = $file ['error'];
		$_FILES ['dateiupload'] ['size'] = $file ['size'];
		
		// Jetzt der Upload einer einzelner Datei
		if (! $this->upload->do_upload ( 'dateiupload' )) {
			$this->session->set_flashdata ( 'upload', $this->upload->display_errors () );
		} else {
			$finfo = $this->upload->data ();
			$this->session->set_flashdata ( 'upload', '<div class="alert alert-success text-center"> ' . $finfo ['file_name'] . ' hochgeladen!</div>' );
		}
		
		return $upload_path . $file ['name'];
	}
	function insert_product_variant($prod_id, $event) {
		$prpr_id = $event->even_prpr_id;
		$this->load->model ( 'product_model' );
		$price_profile = PriceProfile::getPriceProfile ( $prpr_id );
		// Zu allen Formaten im Preisprofil wird eine Variante angelegt
		foreach ( $price_profile->prices as $price ) {
			$data = array (
					'prva_prod_id' => $prod_id,
					'prva_prty_id' => $price->prpt_prty_id 
			);
			$this->product_model->insert_product_variant ( $data );
		}
	}
	function approveProducts() {
		$CI = & get_instance ();
		$CI->load->model ( 'product_model' );
		$products = $this->input->post ( 'products' );
		
		foreach ( $products as $product ) {
			$data = array (
					'prod_status' => $product->prod_status 
			);
			$CI->product_model->update_product ( $product->prod_id, $data );
		}
	}
}
abstract class ProductStatus {
	const undefined = 0;
	const pbl = 1;
	const prv_locked = 2;
	const prv_approved = 3;
	const deleted = 4;
}
