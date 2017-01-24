<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );
include_once (dirname ( __FILE__ ) . "/ProductType.php");
include_once (dirname ( __FILE__ ) . "/PriceProfileStatus.php");
class PriceProfile extends CI_Controller {
	public function __construct() {
		parent::__construct ();
		$this->load->model ( 'product_type_model' );
		$this->load->model ( 'User_model' );
	}
	public function index() {
		$this->price_profiles ();
	}
	public function showSinglePriceProfile($prpr_id) {
		$price_profile = PriceProfile::getPriceProfile ( $prpr_id );
		
		$prpr_user_id = $price_profile->prpr_user_id;
		$user_id = $this->session->userdata ( 'user_id' );
		$user_role = $this->session->userdata ( 'user_role' );
		
		// nicht verwendete IDs speichern und in der Auswahl ausschließen
		$prty_ids = array ();
		foreach ( $price_profile->prices as $price ) {
			array_push ( $prty_ids, $price->prpt_prty_id );
		}
		$this->load->model ( 'product_type_model' );
		
		$price_profile->unused_prty = $this->product_type_model->getAllUnusedProductTypeByPriceProfile ( $prpr_user_id, $prty_ids );
		
		// Profile des eigenen Fotograf oder Administratoren dürfen Daten verändern
		if ($prpr_user_id == $user_id || $user_role == UserRole::Admin) {
			$price_profile->edit_flag = 1;
		} else
			$price_profile->edit_flag = 0;
		
		$data ['price_profile'] = $price_profile;
		$this->load->template ( 'price/single_price_profile_view.php', $data );
	}
	public function price_profiles() {
		$data ['PriceProfileHeader'] = "Preisprofile";
		$data ['price_profiles'] = PriceProfile::getAllPriceProfiles ();
		$data ['users'] = $this->usersForPriceProfile ();
		$data ['archive_flag'] = false;
		$this->load->template ( 'admin/price_profile_view', $data );
	}
	public function archivedPriceProfiles() {
		$data ['PriceProfileHeader'] = "Archivierte Preisprofile";
		$data ['price_profiles'] = PriceProfile::getAllArichvedPriceProfiles ();
		$data ['users'] = $this->usersForPriceProfile ();
		$data ['archive_flag'] = true;
		$this->load->template ( 'admin/price_profile_view', $data );
	}
	public static function getAllArichvedPriceProfiles() {
		$CI = & get_instance ();
		$CI->load->model ( 'PriceProfile_model' );
		$price_profiles = $CI->PriceProfile_model->getAllArichvedPriceProfiles ();
		foreach ( $price_profiles as $pr ) {
			$pr->edit_flag = 1;
		}
		
		return $price_profiles;
	}
	public function usersForPriceProfile() {
		$user_id = $this->session->userdata ( 'user_id' );
		$user = $this->User_model->get_user_by_id ( $user_id );
		if ($user [0]->user_role_id == UserRole::Admin) {
			$users = $this->User_model->getAllPhotographer ( true );
		} else {
			$users = $user;
		}
		return $users;
	}
	function newPriceProfile() {
		$prpr_id = $this->input->post ( 'prpr_id' );
		$prpr_user_id = $this->session->userdata ( 'user_id' );
		$prpr_description = $this->input->post ( 'prpr_description' );
		$user_role = $this->session->userdata ( 'user_role' );
		
		if ($prpr_user_id) {
			
			// Admins legen für System an
			if ($user_role == UserRole::Admin)
				$prpr_user_id = 0;
				
				// set form validation rules
			$this->form_validation->set_rules ( 'prpr_description', 'Preiprofil Name', 'trim|required|min_length[3]|max_length[30]' );
			
			// submit
			if ($this->form_validation->run () == FALSE) {
				// fails
				$this->load->redirect ( 'admin/priceprofile_creation' );
			} else {
				// insert priceprofile details into db
				$data = array (
						'prpr_user_id' => $prpr_user_id,
						'prpr_description' => $prpr_description,
						'prpr_status' => PriceProfileStatus::activ 
				);
				$this->load->model ( 'PriceProfile_model' );
				$new_prpr_id = $this->PriceProfile_model->insert_price_profile ( $data );
				if ($new_prpr_id) {
					
					// Alle Einträged des alten Profils kopieren
					if ($prpr_id) {
						$prices = $this->PriceProfile_model->getPricesById ( $prpr_id );
						foreach ( $prices as $price ) {
							
							$data = array (
									'prpt_prpr_id' => $new_prpr_id,
									'prpt_prty_id' => $price->prty_id,
									'prpt_price' => $price->prpt_price 
							);
							$price_profile = $this->PriceProfile_model->insert_price_product_type ( $data );
						}
					}
					$this->session->set_flashdata ( 'msg', '<div class="alert alert-success text-center">Preisprofil angelegt!</div>' );
					redirect ( 'PriceProfile/showSinglePriceProfile/' . $new_prpr_id );
				} else {
					// error
					$this->session->set_flashdata ( 'msg', '<div class="alert alert-danger text-center">Oops! Error.  Please try again later!!!</div>' );
					redirect ( 'admin/priceprofile_creation' );
				}
			}
		} else {
			// error
			$this->session->set_flashdata ( 'msg', '<div class="alert alert-danger text-center">Bitte anmelden!!!</div>' );
			redirect ( 'admin/priceprofile_creation' );
		}
	}
	function deletePriceProfile() {
		$prpr_id = $this->input->post ( 'prpr_id' );
		$prpr_user_id = $this->session->userdata ( 'user_id' );
		$prpr_description = $this->input->post ( 'prpr_description' );
		
		$this->load->model ( 'PriceProfile_model' );
		$data = array (
				'prpr_status' => PriceProfileStatus::deleted 
		);
		
		$this->PriceProfile_model->update_price_profile ( $prpr_id, $data );
		
		$this->session->set_flashdata ( 'PriceProfile', '<div class="alert alert-success text-center">Preisprofil: ' . $prpr_description . ' gelöscht!</div>' );
		redirect ( 'PriceProfile/price_profiles' );
	}
	function recyclePriceProfile() {
		$prpr_id = $this->input->post ( 'prpr_id' );
		$prpr_user_id = $this->session->userdata ( 'user_id' );
		$prpr_description = $this->input->post ( 'prpr_description' );
		
		$this->load->model ( 'PriceProfile_model' );
		$data = array (
				'prpr_status' => PriceProfileStatus::activ 
		);
		
		$this->PriceProfile_model->update_price_profile ( $prpr_id, $data );
		
		$this->session->set_flashdata ( 'PriceProfile', '<div class="alert alert-success text-center">Preisprofil: ' . $prpr_description . ' wiederhergestellt!</div>' );
	}
	
	// Alle Preisprofile des Systems und des Benutzers/Fotograf laden
	public static function getAllPriceProfiles() {
		$CI = & get_instance ();
		$CI->load->model ( 'PriceProfile_model' );
		$CI->load->model ( 'User_model' );
		$user_id = $CI->session->userdata ( 'user_id' );
		$user_role = $CI->session->userdata ( 'user_role' );
		
		if ($user_role == UserRole::Admin) {
			$price_profiles = $CI->PriceProfile_model->getAllPriceProfiles ();
			foreach ( $price_profiles as $p ) {
				$p->edit_flag = 1;
			}
		} else {
			
			$price_profiles_sys = $CI->PriceProfile_model->getPriceProfilesByUser ( 0 );
			foreach ( $price_profiles_sys as $p ) {
				$p->edit_flag = 0;
			}
			
			// Wenn der Benutzer gesetzt ist dann können die Profile geladen werden
			if ($user_id != 0) {
				$price_profiles_user = $CI->PriceProfile_model->getPriceProfilesByUser ( $user_id );
				foreach ( $price_profiles_user as $p ) {
					$p->edit_flag = 1;
				}
				$price_profiles = array_merge ( $price_profiles_sys, $price_profiles_user );
			} else {
				$price_profiles = $price_profiles_sys;
			}
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
	
	//
	// Preise Preisprofil
	//
	public function addPriceProductType() {
		$this->load->model ( 'PriceProfile_model' );
		$prty_description = $this->input->post ( 'prty_description' );
		$prpr_id = $this->input->post ( 'prpt_prpr_id' );
		$data = array (
				'prpt_prpr_id' => $prpr_id,
				'prpt_prty_id' => $this->input->post ( 'prpt_prty_id' ),
				'prpt_price' => $this->input->post ( 'prpt_price' ) 
		);
		
		$price_profile = $this->PriceProfile_model->insert_price_product_type ( $data );
		$this->session->set_flashdata ( 'PriceProfile', '<div class="alert alert-success text-center">Format: ' . $prty_description . ' hinzugefügt!</div>' );
		redirect ( 'PriceProfile/showSinglePriceProfile/' . $prpr_id );
	}
	public function updatePriceProductType() {
		$this->load->model ( 'PriceProfile_model' );
		$prty_description = $this->input->post ( 'prty_description' );
		$prpr_id = $this->input->post ( 'prpt_prpr_id' );
		$prpt_price = $this->input->post ( 'prpt_price' );
		$data = array (
				'prpt_prpr_id' => $prpr_id,
				'prpt_prty_id' => $this->input->post ( 'prty_id' ),
				'prpt_price' => $prpt_price 
		);
		$this->PriceProfile_model->update_price_product_type ( $data );
		
		$this->session->set_flashdata ( 'PriceProfile', '<div class="alert alert-success text-center">Format: ' . $prty_description . ' erfolgreich auf ' . $prpt_price . '€ geändert!</div>' );
		redirect ( 'PriceProfile/showSinglePriceProfile/' . $prpr_id );
	}
	public function deletePriceProductType() {
		$this->load->model ( 'PriceProfile_model' );
		$prty_description = $this->input->post ( 'prty_description' );
		$prpr_id = $this->input->post ( 'prpt_prpr_id' );
		$prpt_price = $this->input->post ( 'prpt_price' );
		$data = array (
				'prpt_prpr_id' => $prpr_id,
				'prpt_prty_id' => $this->input->post ( 'prty_id' ) 
		);
		$this->PriceProfile_model->delete_price_product_type ( $data );
		
		$this->session->set_flashdata ( 'PriceProfile', '<div class="alert alert-success text-center">Format: ' . $prty_description . ' gelöscht!</div>' );
		redirect ( 'PriceProfile/showSinglePriceProfile/' . $prpr_id );
	}
	
	//
	// Druckereipreise
	//
	public function addPricePrinter() {
		$this->load->model ( 'PriceProfile_model' );
		$prty_description = $this->input->post ( 'prty_description' );
		$prsu_id = $this->input->post ( 'prsu_id' );
		$data = array (
				'prsp_prsu_id' => $prsu_id,
				'prsp_prty_id' => $this->input->post ( 'prsp_prty_id' ),
				'prsp_price' => $this->input->post ( 'prsp_price' ) 
		);
		
		$price_profile = $this->PriceProfile_model->insert_print_supplier_price ( $data );
		$this->session->set_flashdata ( 'PriceProfile', '<div class="alert alert-success text-center">Format: ' . $prty_description . ' hinzugefügt!</div>' );
		redirect ( 'Printers/showPrinterPrice/' . $prsu_id );
	}
	public function updatePricePrinter() {
		$this->load->model ( 'PriceProfile_model' );
		$prty_description = $this->input->post ( 'prty_description' );
		$prsp_price = $this->input->post ( 'prsp_price' );
		$data = array (
				'prsp_prsu_id' => $prsu_id = $this->input->post ( 'prsu_id' ),
				'prsp_prty_id' => $this->input->post ( 'prty_id' ),
				'prsp_price' => $prsp_price 
		);
		
		$this->PriceProfile_model->update_print_supplier_price ( $data );
		
		$this->session->set_flashdata ( 'PrintSupplierPrice', '<div class="alert alert-success text-center">Format: ' . $prty_description . ' erfolgreich auf ' . $prsp_price . '€ geändert!</div>' );
		
		redirect ( 'Printers/showPrinterPrice/' . $prsu_id );
	}
	public function deletePricePrinter() {
		$this->load->model ( 'PriceProfile_model' );
		$prty_description = $this->input->post ( 'prty_description' );
		$prsp_price = $this->input->post ( 'prsp_price' );
		$data = array (
				'prsp_prsu_id' => $prsu_id = $this->input->post ( 'prsu_id' ),
				'prsp_prty_id' => $this->input->post ( 'prty_id' ),
				'prsp_price' => $prsp_price 
		);
		
		$this->PriceProfile_model->delete_print_supplier_price ( $data );
		
		$this->session->set_flashdata ( 'PrintSupplierPrice', '<div class="alert alert-success text-center">Format: ' . $prty_description . ' gelöscht!</div>' );
		
		redirect ( 'Printers/showPrinterPrice/' . $prsu_id );
	}
}
