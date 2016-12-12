<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );
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
		echo "bka";
		
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
	public function deleteUser() {
		$user_id = $this->input->post ( "user_hidden_field" );
		$this->User_model->delete_user ( $user_id );
		$data = array('user_id'=> $user_id, 'users'=> $this->User_model->getAllUsers());
		$this->load->template ( 'admin/users_view', $data );
	}
	public function product_types() {
		$this->load->model ( 'Product_type_model' );
		$data ['product_types'] = $this->Product_type_model->getAllProductType ();
		$this->load->template ( 'admin/product_type_view', $data );
	}
}
?>