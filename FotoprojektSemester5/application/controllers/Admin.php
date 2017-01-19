<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );
include_once (dirname ( __FILE__ ) . "/ProductType.php");
include_once (dirname ( __FILE__ ) . "/PriceProfile.php");
include_once (dirname ( __FILE__ ) . "/User.php");
include_once (dirname ( __FILE__ ) . "/Printers.php");
class Admin extends CI_Controller {
	public function __construct() {
		parent::__construct ();
		$this->load->model ( 'user_model' );
		$this->load->model ( 'event_model' );
		$data ['UsersViewHeader'] = "Alle Benutzer";
	}
	
	// Aufruf der Views
	public function index() {
		$this->load->template ( 'admin/dashboard_view' );
	}
	public function users() {
		$data ['users'] = $this->user_model->getAllUsers ();
		$data ['UsersViewHeader'] = "Alle Benutzer";
		$this->load->template ( 'admin/users_view', $data );
	}
<<<<<<< Updated upstream
	public function archivedUsers() {
		$data ['users'] = $this->user_model->get_AllArchivedUsers ();
		$data ['UsersViewHeader'] = "Archivierte Benutzer";
		$this->load->template ( 'admin/users_view', $data );
	}
=======
>>>>>>> Stashed changes
	public function events() {
		$data ['events'] = $this->event_model->getAllActivEvents ();
		$this->load->template ( 'admin/events_view', $data );
	}
	public function printers() {
		$this->load->model ( 'Printers_model' );
		$data ['PrintersViewHeader'] = "Druckereien";
<<<<<<< Updated upstream
		$data ['printers'] = $this->Printers_model->getAllActivPrinters ();
		$this->load->template ( 'admin/printers_view', $data );
	}
	public function archivedPrinters() {
		$this->load->model ( 'Printers_model' );
		$data ['PrintersViewHeader'] = "Archivierte Druckereien";
		$data ['printers'] = $this->Printers_model->getAllArchivedPrinters ();
=======
<<<<<<< Updated upstream
		$data ['printers'] = $this->Printers_model->getAllPrinters ();
=======
		$data ['printers'] = $this->Printers_model->getAllActivPrinters ();
>>>>>>> Stashed changes
		$this->load->template ( 'admin/printers_view', $data );
	}
	public function product_types() {
		redirect ( 'ProductType/product_types' );
	}
	public function price_profiles() {
		redirect ( 'PriceProfile/price_profiles' );
	}
	public function archivedUsers() {
		$data ['users'] = $this->user_model->get_AllArchivedUsers ();
		$data ['UsersViewHeader'] = "Archivierte Benutzer";
		$this->load->template ( 'admin/users_view', $data );
	}
	public function archivedEvents() {
		$data ['events'] = $this->event_model->getAllArchivedEvents ();
		$data ['EventsViewHeader'] = "Archivierte Events";
		$this->load->template ( 'admin/events_view', $data );
	}
	public function archivedPrinters() {
		$this->load->model ( 'Printers_model' );
		$data ['PrintersViewHeader'] = "Archivierte Druckereien";
		$data ['printers'] = $this->Printers_model->getAllArchivedPrinters ();
>>>>>>> Stashed changes
		$this->load->template ( 'admin/printers_view', $data );
	}
	public function archivedProduct_types() {
		$this->load->model ( 'product_type_model' );
		$this->load->model ( 'User_model' );
		$data ['ProductViewHeader'] = "Archivierte Druckereien";
		$data ['product_types'] = $this->ProductType->getAllArichvedProductType ();
		$this->load->template ( 'admin/product_type_view', $data );
	}
	public function archivedPrice_profiles() {
		$this->load->model ( 'price_type_model' );
	}
	
	
	// Funktionen für die View/Controller (DKM -> Wieso hier und nicht in de spez. Models/Controller?)
	public function deletePrinter() {
		$this->load->model ( 'Printers_model' );
		$prsu_id = $this->input->post ( "printerDelete_hidden_field" );
		$printerInformation = $this->Printers_model->get_printer_by_id ( $prsu_id );
		$data ['PrintersViewHeader'] = "Druckereien";
		$data ['message'] = "Die Druckerei mit dem Namen: \"" . $printerInformation [0]->adre_name . "\" wurde gelöscht";
		$this->Printers_model->update_printerStatusByID ( $prsu_id, PrinterStatus::deleted );
		$data ['printers'] = $this->Printers_model->getAllPrinters ();
		$this->load->template ( 'admin/printers_view', $data );
	}
	public function deleteUser() {
		$user_id = $this->input->post ( "userDelete_hidden_field" );
		$userInformation = $this->user_model->get_user_by_id ( $user_id );
		$data ['UsersViewHeader'] = "Alle Benutzer";
		$data ['message'] = "Der Benutzer mit der E-Mail Adresse: \"" . $userInformation [0]->user_email . "\" wurde gelöscht";
		$this->user_model->update_userStatusByID ( $user_id, UserStatus::deleted );
		$data ['users'] = $this->user_model->getAllUsers ();
		$this->load->template ( 'admin/users_view', $data );
	}
	public function lockUser() {
		$user_id = $this->input->post ( "userLock_hidden_field" );
		$userInformation = $this->user_model->get_user_by_id ( $user_id );
		$data ['UsersViewHeader'] = "Alle Benutzer";
		$data ['message'] = "Der Benutzer mit der E-Mail Adresse: \"" . $userInformation [0]->user_email . "\" wurde gesperrt";
		$this->user_model->update_userStatusByID ( $user_id, UserStatus::lockedByAdmin );
		$data ['users'] = $this->user_model->getAllUsers ();
		$this->load->template ( 'admin/users_view', $data );
	}
	public function unlockUser() {
		$user_id = $this->input->post ( "userUnlock_hidden_field" );
		$userInformation = $this->user_model->get_user_by_id ( $user_id );
		$data ['UsersViewHeader'] = "Alle Benutzer";
		$data ['message'] = "Der Benutzer mit der E-Mail Adresse: \"" . $userInformation [0]->user_email . "\" wurde wieder entsperrt";
		$this->user_model->update_userStatusByID ( $user_id, UserStatus::activated );
		$data ['users'] = $this->user_model->getAllUsers ();
		$this->load->template ( 'admin/users_view', $data );
	}
	public function recycleUser() {
		$user_id = $this->input->post ( "userRecycle_hidden_field" );
		$userInformation = $this->user_model->get_user_by_id ( $user_id );
		$data ['UsersViewHeader'] = "Archivierte Benutzer";
		$data ['message'] = "Der Benutzer mit der E-Mail Adresse: \"" . $userInformation [0]->user_email . "\" wurde wieder hergestellt";
		$this->user_model->update_userStatusByID ( $user_id, UserStatus::activated );
		$data ['users'] = $this->user_model->get_AllArchivedUsers ();
		$this->load->template ( 'admin/users_view', $data );
	}
	public function printers_creation() {
		$this->load->template ( 'admin/printers_creation_view' );
	}
}
?>