<?php
include_once (dirname ( __FILE__ ) . "/ProductType.php");
class User extends CI_Controller {
	public function __construct() {
		parent::__construct ();
		$this->load->library ( 'session' );
		$this->load->model ( 'user_model' );
		$this->load->model ( 'Product_type_model' );
	}
	public function index() {
		$this->load->template ( 'user/settings_view' );
	}
	public function call_change_email_view() {
		$user_id = $this->session->userdata ( 'user_id' );
		$user = $this->user_model->get_user_by_id ( $user_id );
		$data ['user_email'] = $user [0]->user_email;
		$this->load->template ( 'user/email_change_view', $data );
	}
	public function call_change_password_view() {
		$user_id = $this->session->userdata ( 'user_id' );
		$user = $this->user_model->get_user_by_id ( $user_id );
		$this->load->template ( 'user/password_change_view', $data );
	}
	public function showSingleUser($userid) {
		$user_id = $this->session->userdata ( 'user_id' );
		
		$user = $this->user_model->get_user_by_id ( $user_id );
		$address = $this->user_model->get_address_by_id ( $user_id );
		
		$data ['user_title'] = $user [0]->user_title;
		$data ['user_name'] = $user [0]->user_name;
		$data ['user_firstname'] = $user [0]->user_firstname;
		$data ['user_email'] = $user [0]->user_email;
		$data ['user_birthday'] = $user [0]->user_birthday;
		
		$data ['adre_name'] = $address [0]->adre_name;
		$data ['adre_street'] = $address [0]->adre_street;
		$data ['adre_zip'] = $address [0]->adre_zip;
		$data ['adre_city'] = $address [0]->adre_city;
		
		$adressId = $address [0]->adre_id;
		$this->load->template ( 'user/single_user_view', $data );
		
		// changeUserData
		$title = $this->input->post ( 'gender' );
		$name = $this->input->post ( 'lastname' );
		$firstname = $this->input->post ( 'firstname' );
		$fullname = $firstname . " " . $name;
		$zip = $this->input->post ( 'zip' );
		$city = $this->input->post ( 'city' );
		$street = $this->input->post ( 'street' );
		$birthday = $this->input->post ( 'birthday' );
		
		$this->form_validation->set_rules ( 'firstname', 'Vorname', 'trim|required|min_length[3]|max_length[30]' );
		$this->form_validation->set_rules ( 'lastname', 'Nachname', 'trim|required|min_length[3]|max_length[30]' );
		$this->form_validation->set_rules ( 'zip', 'PLZ', 'trim|required' );
		$this->form_validation->set_rules ( 'city', 'Stadt', 'trim|required' );
		$this->form_validation->set_rules ( 'street', 'Straße', 'trim|required' );
		$this->form_validation->set_rules ( 'birthday', 'Geburtsdatum', 'required' );
		// submit
		if ($this->form_validation->run () == FALSE) {
		} else {
			$data = array (
					'user_id' => $user_id = $this->session->userdata ( 'user_id' ),
					'user_firstname' => $title,
					'user_firstname' => $firstname,
					'user_name' => $name,
					'user_birthday' => $birthday 
			);
			// insert User in db
			$UserIsSet = $this->user_model->update_user ( $data );
			
			// insert address
			$address = array (
					'adre_id' => $adressId,
					'adre_user_id' => $user_id,
					'adre_zip' => $zip,
					'adre_city' => $city,
					'adre_street' => $streetAndNr,
					'adre_name' => $fullname 
			);
			$addressIsSet = $this->adress_model->updateAdress ( $address );
		}
	}
	public function changeEmail() {
		$user_id = $this->session->userdata ( 'user_id' );
		$new_email = $this->input->post ( 'new_email' );
		$confirm_email = $this->input->post ( 'confirm_email' );
		$this->form_validation->set_rules ( 'new_email', 'E-Mail', 'trim|required|valid_email|is_unique[user.user_email]' );
		$this->form_validation->set_rules ( 'confirm_email', 'E-Mail', 'trim|required|valid_email|matches[new_email]|is_unique[user.user_email]' );
		
		$this->form_validation->set_message ( 'is_unique', 'Es existiert bereits ein Benutzer mit der angegebenen E-Mail Adresse' );
		$this->form_validation->set_message ( 'matches', 'Die angegebenen E-Mail Adressen stimmen nicht überein' );
		
		if ($this->form_validation->run () == FALSE) {
			// fails
			$user_id = $this->session->userdata ( 'user_id' );
			$user = $this->user_model->get_user_by_id ( $user_id );
			$data ['user_email'] = $user [0]->user_email;
			$this->load->template ( 'user/email_change_view.php', $data );
		} else {
			$emailChanged = $this->user_model->update_userEmailByID ( $user_id, $new_email );
			if ($emailChanged == 1) {
				$this->session->set_flashdata ( 'emailChange', 'Die E-Mail Adresse wurde erfolgreich geändert.' );
			} else {
				$this->session->set_flashdata ( 'emailChange', 'Die E-Mail Adresse konnte nicht geändert werden. Versuchen Sie es später noch einmal.' );
			}
			
			$user_id = $this->session->userdata ( 'user_id' );
			
			$user = $this->user_model->get_user_by_id ( $user_id );
			$address = $this->user_model->get_address_by_id ( $user_id );
			
			$data ['user_title'] = $user [0]->user_title;
			$data ['user_name'] = $user [0]->user_name;
			$data ['user_firstname'] = $user [0]->user_firstname;
			$data ['user_email'] = $user [0]->user_email;
			$data ['user_birthday'] = $user [0]->user_birthday;
			
			$data ['adre_name'] = $address [0]->adre_name;
			$data ['adre_street'] = $address [0]->adre_street;
			$data ['adre_zip'] = $address [0]->adre_zip;
			$data ['adre_city'] = $address [0]->adre_city;
			
			$adressId = $address [0]->adre_id;
			$this->load->template ( 'user/single_user_view', $data );
			$this->load->template ( 'user/single_user_view', $data );
		}
	}
	function getNewPassword() {
		$newPassword = $this->input->post ( "user_newPassword" );
		$newCPassword = $this->input->post ( "user_newCPassword" );
		$user_id = $this->input->post ( 'user_id' );
		$this->form_validation->set_rules ( 'user_newPassword', 'New Password', 'trim|required|matches[user_newCPassword]|min_length[6]' );
		$this->form_validation->set_rules ( 'user_newCPassword', 'Confirm New Password', 'trim|required|min_length[6]' );
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
		$this->load->model ( 'order_model' );
		$user_id = $this->session->userdata ( 'user_id' );
		$orders = $this->order_model->getAllOrdersByUser ( $user_id );
		
		$data ['userid'] = $user_id;
		$data ['orders'] = $orders;
		$this->load->template ( 'user/my_order_view', $data );
	}
	public function deleteUser() {
		$user_id = $this->session->userdata ( 'user_id' );
		$this->user_model->update_userStatusByID ( $user_id, UserStatus::deleted );
		$this->logout ();
	}
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
		redirect ( '/' );
	}
}
abstract class UserStatus {
	const undefined = 0;
	const unconfirmed = 1;
	const activated = 2;
	const locked = 3;
	const deleted = 4;
	const lockedByAdmin = 5;
}
?>