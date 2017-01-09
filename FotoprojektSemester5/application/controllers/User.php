<?php
include_once (dirname(__FILE__) . "/ProductType.php");
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

		$user_id = $this->session->userdata('user_id');
		
		$user = $this->user_model->get_user_by_id($user_id);
		$address = $this->user_model->get_address_by_id($user_id);
		


		$data['user_title'] = $user[0]->user_title;
		$data['user_name'] = $user[0]->user_name;
		$data['user_firstname'] = $user[0]->user_firstname;
		$data['user_email'] = $user[0]->user_email;
		$data['user_birthday'] = $user[0]->user_birthday;
		
		$data['adre_name'] = $address[0]->adre_name;
		$data['adre_street'] = $address[0]->adre_street;
		$data['adre_zip'] = $address[0]->adre_zip;
		$data['adre_city'] = $address[0]->adre_city;
		
		$this->load->template ( 'user/single_user_view', $data );
	}
	
	public function changeEmail(){
		$user_id = $this->session->userdata('user_id');
		$email = $this->input->post('user_email');
		$this->form_validation->set_rules('user_email', 'Email ID', 'trim|required|valid_email|is_unique[user.user_email]');
		if ($this->form_validation->run() == FALSE)
		{
			// fails
			$this->session->set_flashdata ( 'emailChange', 'Die E-Mail Adresse exisitiert bereits oder ist nicht konformgerecht.' );
		}
		else
		{
			$emailChanged = $this->order_model->update_userEmailByID($user_id,$email);
			if ($emailChanged == 1){
				$this->session->set_flashdata ( 'emailChange', 'Die E-Mail Adresse wurde erfolgreich geändert.' );
			}
			else 
			{
				$this->session->set_flashdata ( 'emailChange', 'Die E-Mail Adresse konnte nicht geändert werden. Versuchen Sie es später noch einmal.' );
			}
		}
	}
	
	
	function getNewPassword() {
		$newPassword = $this->input->post ( "user_newPassword" );
		$newCPassword = $this->input->post ( "user_newCPassword" );
		$user_id = $this->input->post ( 'user_id' );
		$this->form_validation->set_rules ( 'user_newPassword', 'New Password', 'trim|required|matches[user_newCPassword]' );
		$this->form_validation->set_rules ( 'user_newCPassword', 'Confirm New Password', 'trim|required' );
		if ($this->form_validation->run () == FALSE) {
			// validation fail
			$this->session->set_flashdata ( 'pwChange', 'Das Passwort mit dem wiederholten Passwort übereinstimmen' );
				
		} else {
				
			$this->changePassword ( $user_id, $newPassword );
		}
	}
	private function changePassword($user_id, $newPassword) {
		$algo = 'sha256';
		$newSalt = generate_salt ( 10 );
		$newHashpw = generate_hash ( $newSalt, $newPassword, $algo );
		$this->user_model->update_userPassword ( $user_id, $newHashpw, $newSalt, UserStatus::activated );
		$this->session->set_flashdata ( 'pwChange', 'Ihr Passwort wurde erfolgreich geändert' );
	}
	
	public function myOrders() {
		
		$this->load->model('order_model');
		$user_id = $this->session->userdata('user_id');
		$orders = $this->order_model->getAllOrdersByUser($user_id);
		
		
		$data['userid'] = $user_id;
		$data['orders'] = $orders;
		$this->load->template ( 'user/my_order_view', $data );
	}


// 	public function userProfile(){
// 	$id = $this->session->userdata('user_id');
	
// 	$user = $this->order_model->get_user_by_id($user_id);
// 	$address = $this->order_model->get_address_by_id($user_id);
	
// 	$data['user_title'] = $user[0]->user_title;
// 	$data['user_name'] = $user[0]->user_name;
// 	$data['user_firstname'] = $user[0]->user_firstname;
// 	$data['user_email'] = $user[0]->user_email;
// 	$data['user_birthday'] = $user[0]->user_birthday;

// 	$data['adre_name'] = $user[0]->adre_name;
// 	$data['adre_street'] = $user[0]->adre_street;
// 	$data['adre_zip'] = $user[0]->adre_zip;
// 	$data['adre_city'] = $user[0]->adre_city;
	
// 	$this->load->view('user/profile_view', $data);
	
// 	}
	
	function logout() {
		// destroy session
		$data = array (
				'login' => '',
				'user_name' => '',
				'user_id' => '',
				'user_email' => '',
				'user_firstname' => '',
				'user_status' => '',
				'user_role' => ''
				
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