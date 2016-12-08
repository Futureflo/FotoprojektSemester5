<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );
class Admin extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('user_model');
	}
	
	public function index() {
		$this->load->template ( 'admin/dashboard_view' );
	}
	public function users() {

		$this->load->model('user_model');
		$data['users'] = $this->user_model->getAllUsers();
		
		$this->load->template ( 'admin/users_view' ,$data);
	}
	public function events() {
		$this->load->template ( 'admin/events_view' );
	}
	public function printers() {
		$this->load->template ( 'admin/printers_view' );
	}
	public function deleteUser(){
		$user_id = $this->input->post("user_hidden_field");
		$this->user_model->delete_user($user_id);
		redirect("admin/users");
	}
	public function product_types()
	{
		$this->load->model('product_type_model');
		$data['product_types'] = $this->product_type_model->getAllProductType();
		$this->load->template ( 'admin/product_type_view', $data );
	}
}
?>