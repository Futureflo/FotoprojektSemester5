<?php
include_once (dirname ( __FILE__ ) . "/ProductType.php");
class User extends CI_Controller {
	public function __construct() {
		parent::__construct ();
		$this->load->library ( 'session' );
		$this->load->model ( 'user_model' );
		$this->load->model ( 'adress_model' );
		$this->load->model ( 'Product_type_model' );
		$this->load->helper ( array (
				'hash_helper',
				'login_helper' 
		) );
		lh_checkAccess ();
	}
	public function index() {
		$this->load->template ( 'user/settings_view' );
	}
	public function overviewPhotographer() {
		$this->load->template ( 'user/overviewPhotographer' );
	}
	public function dashboard() {
		$this->load->model ( 'Dashboard_model' );
		$user_id = $this->session->userdata ( 'user_id' );
		$data ['orders'] = $this->Dashboard_model->getInformationsByUserID ( $user_id );
		$data ['DashboardViewHeader'] = "Umsatzanzeige";
		$this->load->template ( 'admin/dashboard', $data );
	}
	public function call_change_email_view() {
		$user_id = $this->session->userdata ( 'user_id' );
		$user = $this->user_model->get_user_by_id ( $user_id );
		$data ['user_email'] = $user [0]->user_email;
		$this->load->template ( 'user/email_change_view', $data );
	}
	public function call_change_address_view() {
		$data ['firstname'] = "";
		$data ['name'] = "";
		$data ['zip'] = "";
		$data ['city'] = "";
		$data ['street'] = "";
		$this->load->template ( 'user/address_change_view', $data );
	}
	public function call_change_passwordSettings_view() {
		$user_id = $this->session->userdata ( 'user_id' );
		
		$user = $this->user_model->get_user_by_id ( $user_id );
		$this->load->template ( 'user/passwordSettings_change_view' );
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
		
		$data ['adre_id'] = $address [0]->adre_id;
		$data ['adre_name'] = $address [0]->adre_name;
		$data ['adre_street'] = $address [0]->adre_street;
		$data ['adre_zip'] = $address [0]->adre_zip;
		$data ['adre_city'] = $address [0]->adre_city;
		
		$data ['adre'] = $address;
		
		$adressId = $address [0]->adre_id;
		$this->load->template ( 'user/single_user_view', $data );
	}
	public function changeUserDataAdress() {
		// changeUserData
		$title = $this->input->post ( 'gender' );
		$name = $this->input->post ( 'lastname' );
		$firstname = $this->input->post ( 'firstname' );
		$adressId = $this->input->post ( 'adressID' );
		$fullname = $this->input->post ( 'fullname' );
		$zip = $this->input->post ( 'zip' );
		$city = $this->input->post ( 'city' );
		$streetAndNr = $this->input->post ( 'street' );
		$birthday = $this->input->post ( 'birthday' );
		
		$this->form_validation->set_rules ( 'firstname', 'Vorname', 'trim|required|min_length[3]|max_length[30]' );
		$this->form_validation->set_rules ( 'lastname', 'Nachname', 'trim|required|min_length[3]|max_length[30]' );
		$this->form_validation->set_rules ( 'zip', 'PLZ', 'trim|required' );
		$this->form_validation->set_rules ( 'city', 'Stadt', 'trim|required' );
		$this->form_validation->set_rules ( 'street', 'Straße', 'trim|required' );
		$this->form_validation->set_rules ( 'birthday', 'Geburtsdatum', 'required' );
		$this->form_validation->set_rules ( 'fullname', 'Adressname', 'required' );
		
		// submit
		if ($this->form_validation->run () == FALSE) {
			$user_id = $this->session->userdata ( 'user_id' );
			$user = $this->user_model->get_user_by_id ( $user_id );
			$address = $this->user_model->get_address_by_id ( $user_id );
			
			$data ['user_title'] = $user [0]->user_title;
			$data ['user_name'] = $user [0]->user_name;
			$data ['user_firstname'] = $user [0]->user_firstname;
			$data ['user_email'] = $user [0]->user_email;
			$data ['user_birthday'] = $user [0]->user_birthday;
			
			$data ['adre_id'] = $address [0]->adre_id;
			$data ['adre_name'] = $address [0]->adre_name;
			$data ['adre_street'] = $address [0]->adre_street;
			$data ['adre_zip'] = $address [0]->adre_zip;
			$data ['adre_city'] = $address [0]->adre_city;
			
			$data ['adre'] = $address;
			
			$adressId = $address [0]->adre_id;
			$this->load->template ( 'user/single_user_view', $data );
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
			
			$addressIsSet = $this->adress_model->update_adress ( $address );
			
			$user = $this->user_model->get_user_by_id ( $user_id );
			$address = $this->user_model->get_address_by_id ( $user_id );
			
			$data ['user_title'] = $user [0]->user_title;
			$data ['user_name'] = $user [0]->user_name;
			$data ['user_firstname'] = $user [0]->user_firstname;
			$data ['user_email'] = $user [0]->user_email;
			$data ['user_birthday'] = $user [0]->user_birthday;
			
			$data ['adre_id'] = $address [0]->adre_id;
			$data ['adre_name'] = $address [0]->adre_name;
			$data ['adre_street'] = $address [0]->adre_street;
			$data ['adre_zip'] = $address [0]->adre_zip;
			$data ['adre_city'] = $address [0]->adre_city;
			
			$data ['adre'] = $address;
			$this->session->set_flashdata ( 'contactChange', 'Die Kontaktdaten wurde geändert.' );
			$this->load->template ( 'user/single_user_view', $data );
		}
	}
	public function newAddress() {
		$user_id = $this->session->userdata ( 'user_id' );
		$new_street = $this->input->post ( 'street' );
		$new_plz = $this->input->post ( 'zip' );
		$new_city = $this->input->post ( 'city' );
		$name = $this->input->post ( 'name' );
		$firstname = $this->input->post ( 'firstname' );
		$fullname = $firstname . " " . $name;
		
		$this->form_validation->set_rules ( 'firstname', 'Vorname', 'required' );
		$this->form_validation->set_rules ( 'name', 'Nachname', 'required' );
		$this->form_validation->set_rules ( 'street', 'Straße', 'trim|required' );
		$this->form_validation->set_rules ( 'zip', 'PLZ', 'trim|required' );
		$this->form_validation->set_rules ( 'city', 'Stadt', 'trim|required' );
		
		if ($this->form_validation->run () == FALSE) {
			// validation fail
			$this->load->template ( 'user/address_change_view' );
		} else {
			
			$address = array (
					'adre_user_id' => $user_id,
					'adre_zip' => $new_plz,
					'adre_city' => $new_city,
					'adre_street' => $new_street,
					'adre_name' => $fullname,
					'adre_coun_id' => '80',
					'adre_status' => '1' 
			);
			
			$this->user_model->insert_address ( $address );
			
			$user_id = $this->session->userdata ( 'user_id' );
			$user = $this->user_model->get_user_by_id ( $user_id );
			$address = $this->user_model->get_address_by_id ( $user_id );
			
			$data ['user_title'] = $user [0]->user_title;
			$data ['user_name'] = $user [0]->user_name;
			$data ['user_firstname'] = $user [0]->user_firstname;
			$data ['user_email'] = $user [0]->user_email;
			$data ['user_birthday'] = $user [0]->user_birthday;
			
			$data ['adre_id'] = $address [0]->adre_id;
			$data ['adre_name'] = $address [0]->adre_name;
			$data ['adre_street'] = $address [0]->adre_street;
			$data ['adre_zip'] = $address [0]->adre_zip;
			$data ['adre_city'] = $address [0]->adre_city;
			
			$adressId = $address [0]->adre_id;
			
			$data ['adre'] = $address;
			$this->session->set_flashdata ( 'contactChange', 'Eine neue Adresse wurde hinzugefügt' );
			$this->load->template ( 'user/single_user_view', $data );
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
				$this->session->set_userdata ( 'user_email', $new_email );
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
			
			$data ['adre_id'] = $address [0]->adre_id;
			$data ['adre_name'] = $address [0]->adre_name;
			$data ['adre_street'] = $address [0]->adre_street;
			$data ['adre_zip'] = $address [0]->adre_zip;
			$data ['adre_city'] = $address [0]->adre_city;
			
			$data ['adre'] = $address;
			$adressId = $address [0]->adre_id;
			$this->load->template ( 'user/single_user_view', $data );
		}
	}
	function changePassword() {
		$user_id = $this->session->userdata ( 'user_id' );
		$oldPassword = $this->input->post ( "old_newPassword" );
		$newPassword = $this->input->post ( "user_newPassword" );
		$newCPassword = $this->input->post ( "user_newCPassword" );
		$this->form_validation->set_rules ( 'user_oldPassword', 'Old Password', 'trim|required|callback_verify_password' );
		$this->form_validation->set_rules ( 'user_newPassword', 'New Password', 'trim|required' );
		$this->form_validation->set_rules ( 'user_newCPassword', 'Confirm New Password', 'trim|matches[user_newPassword]|required|min_length[6]' );
		
		$this->form_validation->set_message ( 'verify_password', 'Das Passwort ist nicht korrekt' );
		$this->form_validation->set_message ( 'matches', 'Die eingegebenen Passwörter stimmen nicht überein' );
		
		if ($this->form_validation->run () == FALSE) {
			// validation fail
			// $this->session->set_flashdata ( 'msg', 'Das Passwort mit dem wiederholten Passwort übereinstimmen' );
			$user_id = $this->session->userdata ( 'user_id' );
			
			$user = $this->user_model->get_user_by_id ( $user_id );
			$this->load->template ( 'user/passwordSettings_change_view' );
		} else {
			
			$this->setNewPassword ( $user_id, $newPassword );
			$this->user_model->update_unsetUserRestoreCode ( $user_id );
			
			$user = $this->user_model->get_user_by_id ( $user_id );
			$address = $this->user_model->get_address_by_id ( $user_id );
			
			$data ['user_title'] = $user [0]->user_title;
			$data ['user_name'] = $user [0]->user_name;
			$data ['user_firstname'] = $user [0]->user_firstname;
			$data ['user_email'] = $user [0]->user_email;
			$data ['user_birthday'] = $user [0]->user_birthday;
			
			$data ['adre_id'] = $address [0]->adre_id;
			$data ['adre_name'] = $address [0]->adre_name;
			$data ['adre_street'] = $address [0]->adre_street;
			$data ['adre_zip'] = $address [0]->adre_zip;
			$data ['adre_city'] = $address [0]->adre_city;
			
			$data ['adre'] = $address;
			$adressId = $address [0]->adre_id;
			$this->load->template ( 'user/single_user_view', $data );
		}
		
		// $newPassword = $this->input->post ( "user_newPassword" );
		// $newCPassword = $this->input->post ( "user_newCPassword" );
		// $user_id = $this->session->userdata ( 'user_id' );
		// $this->form_validation->set_rules ( 'user_newPassword', 'New Password', 'trim|required|matches[user_newCPassword]|min_length[6]' );
		// $this->form_validation->set_rules ( 'user_newCPassword', 'Confirm New Password', 'trim|required|min_length[6]' );
		// if ($this->form_validation->run () == FALSE) {
		// // validation fail
		// $this->session->set_flashdata ( 'pwChange', 'Das Passwort mit dem wiederholten Passwort übereinstimmen' );
		// } else {
		
		// $this->changePassword ( $user_id, $newPassword );
		// }
	}
	private function setNewPassword($user_id, $newPassword) {
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
	function verify_password($oldPassword) {
		$user_id = $this->session->userdata ( 'user_id' );
		
		$user = $this->user_model->get_user_by_id ( $user_id );
		$user_salt = $user [0]->user_salt;
		$algo = 'sha256';
		
		$hashpw = generate_hash ( $user_salt, $oldPassword, $algo );
		$user_password = $user [0]->user_password;
		
		if (strcmp ( $hashpw, $user_password ) == 0) {
			return true;
		} else {
			return false;
		}
	}
	function photographer_dashboard() {
		lh_checkAccess ( 1 );
		$this->load->model ( 'product_model' );
		$user_id = $this->session->userdata ( 'user_id' );
		$abo = $this->user_model->getAbo ( $user_id );
		$size = $this->product_model->getUsedFileSize ( $user_id );
		$size->prod_filesize = round ( $size->prod_filesize / 1024 / 1024, 2 );
		$abo->abof_space = round ( $abo->abof_space / 1024 / 1024, 2 );
		$data ['size'] = $size;
		$data ['abo'] = $abo;
		
		$this->load->template ( 'user/photographer_dashboard', $data );
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