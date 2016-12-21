<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );
include_once (dirname(__FILE__) . "/ProductType.php");
include_once (dirname(__FILE__) . "/PriceProfile.php");
include_once (dirname(__FILE__) . "/User.php");
class Admin extends CI_Controller {
	public function __construct() {
		parent::__construct ();
		$this->load->model('User_model');
	}
	public function index() {
		$this->load->template ( 'admin/dashboard_view' );
	}
	public function users() {
		//$this->load->model ( 'user_model' );
		$data ['users'] = $this->User_model->getAllUsers ();
		
		$this->load->template ( 'admin/users_view', $data );
	}
	public function events() {
		$this->load->model ( 'Event_model' );
		$data ['events'] = $this->Event_model->getAllEvents();
		$this->load->template ( 'admin/events_view', $data);
	}
	public function printers() {
		$this->load->template ( 'admin/printers_view' );
	}

	public function product_types() {
		$data ['product_types'] = ProductType::getAllProductType();
		$this->load->template ( 'admin/product_type_view', $data );
	}
	
	public function price_profiles() {
		$data ['price_profiles'] = PriceProfile::getAllPriceProfiles();
		$this->load->template ( 'admin/price_profile_view', $data );
	}
	
	public function deleteUser(){
		$user_id = $this->input->post ( "userDelete_hidden_field" );
		$this->User_model->update_userStatusByID($user_id,UserStatus::deleted);
		$data = array('user_id'=> $user_id, 'users'=> $this->User_model->getAllUsers());
		$this->load->template ( 'admin/users_view', $data );
	}
	public function lockUser(){
		$user_id = $this->input->post ( "userLock_hidden_field" );
		$this->User_model->update_userStatusByID($user_id,UserStatus::locked);
		$data = array('user_id'=> $user_id, 'users'=> $this->User_model->getAllUsers());
		$this->load->template ( 'admin/users_view', $data );
	}
	public function unlockUser(){
		$user_id = $this->input->post ( "userUnlock_hidden_field" );
		$this->User_model->update_userStatusByID($user_id,UserStatus::activated);
		$data = array('user_id'=> $user_id, 'users'=> $this->User_model->getAllUsers());
		$this->load->template ( 'admin/users_view', $data );
	}

	
}
?>