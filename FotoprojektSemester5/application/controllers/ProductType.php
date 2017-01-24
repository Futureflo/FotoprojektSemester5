<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );
include_once (dirname ( __FILE__ ) . "/UserRole.php");
class ProductType extends CI_Controller {
	public function __construct() {
		parent::__construct ();
		$this->load->model ( 'product_type_model' );
		$this->load->model ( 'User_model' );
	}
	public function index() {
		$this->load->template ( 'product/single_product_type_view' );
	}
	public function showSingleProductType($prty_id) {
		$data ['product_type'] = $this->product_type_model->get_product_type_by_id ( $prty_id );
		$this->load->template ( 'product/single_product_type_view', $data );
	}
	public function ProductTypes() {
		$data ['ProductViewHeader'] = "Alle Formate";
		$product_types = ProductType::getAllProductType ();
		$data ['product_types'] = $product_types;
		$data ['users'] = $this->usersforProductType ();
		$data ['archive_flag'] = false;
		$this->load->template ( 'admin/product_type_view', $data );
	}
	public function archivedProductTypes() {
		$data ['ProductViewHeader'] = "Archivierte Formate";
		$data ['product_types'] = ProductType::getAllArichvedProductType ();
		$data ['users'] = $this->usersforProductType ();
		$data ['archive_flag'] = true;
		
		$this->load->template ( 'admin/product_type_view', $data );
	}
	public function usersForProductType() {
		$user_id = $this->session->userdata ( 'user_id' );
		$user = $this->User_model->get_user_by_id ( $user_id );
		if ($user [0]->user_role_id == UserRole::Admin) {
			$users = $this->User_model->getAllPhotographer ( true );
		} else {
			$users = $user;
		}
		return $users;
	}
	public static function getAllArichvedProductType() {
		$CI = & get_instance ();
		$CI->load->model ( 'product_type_model' );
		$product_types = $CI->product_type_model->getAllArichvedProductType ();
		foreach ( $product_types as $pt ) {
			$pt->edit_flag = 1;
		}
		
		return $product_types;
	}
	public static function getAllProductType() {
		$CI = & get_instance ();
		$CI->load->model ( 'product_type_model' );
		$user_id = $CI->session->userdata ( 'user_id' );
		$user = $CI->User_model->get_user_by_id ( $user_id );
		
		// Als Admin alle Formate mit Änderungsrecht zurückgeben
		if ($user [0]->user_role_id == UserRole::Admin) {
			$product_types = $CI->product_type_model->getAllActiveProductType ();
			foreach ( $product_types as $pt )
				$pt->edit_flag = 1;
		} else {
			
			// Alle aktiven Formate für den angemeldeten Benutzer
			$product_types_user = $CI->product_type_model->getAllActiveProductTypeForUser ( $user_id );
			foreach ( $product_types_user as $pt ) {
				$pt->edit_flag = 1;
			}
			// Alle aktiven System-Formate suchen
			$product_types_sys = $CI->product_type_model->getAllActiveProductTypeForUser ( 0 );
			foreach ( $product_types_sys as $pt )
				$pt->edit_flag = 0;
			
			$product_types = array_merge ( $product_types_sys, $product_types_user );
		}
		return $product_types;
	}
	public function addProductType() {
		$this->form_validation->set_rules ( 'prty_description', 'prty_description', 'trim|required|min_length[3]|max_length[30]' );
		if ($this->form_validation->run () == FALSE) {
			// fails
			$this->load->view ( 'ProductType\product_types' );
		} else {
			$this->load->model ( 'product_type_model' );
			$prpr_id = $this->input->post ( 'prpt_prpr_id' );
			$prty_description = $this->input->post ( 'prty_description' );
			$prty_type = $this->input->post ( 'prty_type' );
			$prty_height = $this->input->post ( 'prty_height' );
			$prty_width = $this->input->post ( 'prty_width' );
			$prty_user_id = $this->input->post ( 'prty_user_id' );
			
			$data = array (
					'prty_description' => $prty_description,
					'prty_type' => $prty_type,
					'prty_height' => $prty_height,
					'prty_width' => $prty_width,
					'prty_user_id' => $prty_user_id,
					'prty_status' => ProductTypeStatus::activ 
			);
			
			$price_profile = $this->product_type_model->insert_product_type ( $data );
			redirect ( 'ProductType\ProductTypes' );
		}
	}
	public function deleteProductType() {
		$prty_id = $this->input->post ( 'prty_id' );
		$prty_description = $this->input->post ( 'prty_description' );
		
		$this->load->model ( 'product_type_model' );
		$data = array (
				'prty_status' => ProductTypeStatus::deleted 
		);
		$this->product_type_model->update_product_type ( $prty_id, $data );
		redirect ( 'ProductType\ProductTypes' );
		$this->session->set_flashdata ( '', 'Format \"' . $prty_description . '\" gelöscht!' );
	}
	public function recycleProductType() {
		$prty_id = $this->input->post ( 'prty_id' );
		$prty_description = $this->input->post ( 'prty_description' );
		
		$this->load->model ( 'product_type_model' );
		$data = array (
				'prty_status' => ProductTypeStatus::activ 
		);
		$this->product_type_model->update_product_type ( $prty_id, $data );
		$this->session->set_flashdata ( '', 'Format \"' . $prty_description . '\" wiederhergestellt!' );
	}
}
abstract class ProductPrintType {
	const undefined = 0;
	const prints = 1;
	const download = 2;
	const mixed = 2;
	const article = 1;
}
abstract class ProductTypeStatus {
	const undefined = 0;
	const activ = 1;
	const deleted = 2;
}