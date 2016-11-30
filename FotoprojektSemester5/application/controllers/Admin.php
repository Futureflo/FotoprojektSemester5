<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );
class Admin extends CI_Controller {
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
}
?>