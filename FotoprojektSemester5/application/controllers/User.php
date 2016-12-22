<?php
class User extends CI_Controller {
	public function __construct() {
		parent::__construct ();
		$this->load->library ( 'session' );
		$this->load->model('user_model');
		$this->load->model('Product_type_model');
		
	}
	public function index() {
		$this->load->template ( 'user/settings_view' );
	}
	public function showSingleUser($userid) {
		$data = array (
				"userid" => $userid 
		);
		$this->load->template ( 'user/single_user_view', $data );
	}
	
	public function myOrders() {
		
		$this->load->model('order_model');
		$user_id = $this->session->userdata('user_id');
		$orders = $this->order_model->getAllOrdersByUser($user_id);
		
		
		$data['userid'] = $user_id;
		$data['orders'] = $orders;
		$this->load->template ( 'user/my_order_view', $data );
	}


	
	function logout() {
		// destroy session
		$data = array (
				'login' => '',
				'user_name' => '',
				'user_id' => '' 
		);
		$this->session->unset_userdata ( $data );
		$this->session->sess_destroy ();
		redirect ('start/');
	}
}
abstract class UserStatus
{
	const undefined = 0;
	const unconfirmed = 1;
	const activated = 2;
	const locked = 3;
	const deleted = 4;
	const lockedByAdmin = 5;
}
?>