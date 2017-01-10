<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );
include_once (dirname ( __FILE__ ) . "/ProductType.php");
class PriceProfile extends CI_Controller {
	public function index() {
		$this->price_profiles ();
	}
	public function showSinglePriceProfile($prpr_id) {
		$price_profile = PriceProfile::getPriceProfile ( $prpr_id );
		
		$user_id = $price_profile->prpr_user_id;
		
		// nicht verwendete IDs speichern und in der Auswahl ausschließen
		$prty_ids = array ();
		foreach ( $price_profile->prices as $price ) {
			array_push ( $prty_ids, $price->prpt_prty_id );
		}
		$this->load->model ( 'product_type_model' );
		
		$price_profile->unused_prty = $this->product_type_model->getAllUnusedProductTypeByPriceProfile ( $user_id, $prty_ids );
		$data ['price_profile'] = $price_profile;
		$this->load->template ( 'price/single_price_profile_view.php', $data );
	}
	public function price_profiles() {
		$data ['price_profiles'] = PriceProfile::getAllPriceProfiles ();
		$this->load->template ( 'admin/price_profile_view', $data );
	}
	
	// Alle Preisprofile des Systems und des Benutzers/Fotograf laden
	public static function getAllPriceProfiles() {
		$CI = & get_instance ();
		$CI->load->model ( 'PriceProfile_model' );
		$CI->load->model ( 'User_model' );
		$user_id = $CI->session->userdata ( 'user_id' );
		
		$user = $CI->User_model->get_user_by_id ( $user_id );
		if ($user [0]->user_role_id == UserRole::Admin)
			$price_profiles = $CI->PriceProfile_model->getAllPriceProfiles ();
		else {
			
			$price_profiles_sys = $CI->PriceProfile_model->getPriceProfilesByUser ( 0 );
			
			// Wenn der Benutzer gesetzt ist dann können die Profile geladen werden
			if ($user_id != 0) {
				$price_profiles_user = $CI->PriceProfile_model->getPriceProfilesByUser ( $user_id );
				// $price_profiles = $price_profiles_user;
				$price_profiles = array_merge ( $price_profiles_sys, $price_profiles_user );
			} else
				$price_profiles = $price_profiles_sys;
		}
		
		foreach ( $price_profiles as $price_profile ) {
			$price_profile = PriceProfile::getPriceProfile ( $price_profile->prpr_id );
		}
		
		return $price_profiles;
	}
	
	// Liefert Preisprofil mit Preisen
	public static function getPriceProfile($prpr_id) {
		$CI = & get_instance ();
		$CI->load->model ( 'PriceProfile_model' );
		$price_profile = $CI->PriceProfile_model->getPriceProfileById ( $prpr_id );
		$prices = $CI->PriceProfile_model->getPricesById ( $prpr_id );
		$price_profile [0]->prices = $prices;
		return $price_profile [0];
	}
	
	// Liefert Preisen aus Format und Preisprofil
	public static function getPriceByProductType($prpr_id, $prty_id) {
		$CI = & get_instance ();
		$CI->load->model ( 'PriceProfile_model' );
		$price = $CI->PriceProfile_model->getPriceByProductType ( $prpr_id, $prty_id );
		if (isset ( $price [0] )) {
			return $price [0];
		} else {
			return NULL;
		}
	}
	
	// Liefert Preisen aus Format und Printer
	public static function getPriceByPrinter($prsu_id, $prty_id) {
		$CI = & get_instance ();
		$CI->load->model ( 'PriceProfile_model' );
		$price = $CI->PriceProfile_model->getPriceByPrinter ( $prsu_id, $prty_id );
		if (isset ( $price [0] )) {
			return $price [0];
		} else {
			return NULL;
		}
	}
	public function addPriceProductType() {
		$this->load->model ( 'PriceProfile_model' );
		$prpr_id = $this->input->post ( 'prpt_prpr_id' );
		$data = array (
				'prpt_prpr_id' => $prpr_id,
				'prpt_prty_id' => $this->input->post ( 'prpt_prty_id' ),
				'prpt_price' => $this->input->post ( 'prpt_price' ) 
		);
		
		$price_profile = $this->PriceProfile_model->insert_price_product_type ( $data );
		redirect ( 'PriceProfile/showSinglePriceProfile/' . $prpr_id );
	}
	public function addPricePrinter() {
		$this->load->model ( 'PriceProfile_model' );
		$prsu_id = $this->input->post ( 'prsu_id' );
		$data = array (
				'prsp_prsu_id' => $prsu_id,
				'prsp_prty_id' => $this->input->post ( 'prsp_prty_id' ),
				'prsp_price' => $this->input->post ( 'prsp_price' ) 
		);
		
		$price_profile = $this->PriceProfile_model->insert_print_supplier_price ( $data );
		redirect ( 'Printers/showPrinterPrice/' . $prsu_id );
	}
}
