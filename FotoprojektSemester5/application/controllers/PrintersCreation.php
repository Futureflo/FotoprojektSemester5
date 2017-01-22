<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );
class PrintersCreation extends CI_Controller {
	public function __construct() {
		parent::__construct ();
		$this->load->helper ( array (
				'form',
				'hash_helper',
				'html' 
		) );
		$this->load->library ( array (
				'form_validation' 
		) );
		$this->load->database ();
		$this->load->model ( 'user_model' );
		// $this->load->model ( 'adress_model' );
		$this->load->model ( 'PrintersCreation_model' );
	}
	function newPrinter() {
		$user_id = $this->session->userdata ( 'user_id' );
		$user_role = $this->session->userdata ( 'user_role' );
		
		$addressname = $this->input->post ( 'addressname' );
		$country = $this->input->post ( 'country' );
		$zip = $this->input->post ( 'zip' );
		$city = $this->input->post ( 'city' );
		$street = $this->input->post ( 'street' );
		$houseNr = $this->input->post ( 'housenumber' );
		$streetAndNr = $street . " " . $houseNr;
		$email = $this->input->post ( 'email' );
		$cemail = $this->input->post ( 'cemail' );
		
		if ($user_id) {
			
			// Admins legen für System an
			if ($user_role == UserRole::Admin)
				$prpr_user_id = 0;
				
				// set form validation rules
			$this->form_validation->set_rules ( 'addressname', 'Druckerei Name', 'trim|required|min_length[3]|max_length[30]' );
			$this->form_validation->set_rules ( 'email', 'E-Mail Addresse', 'trim|required|valid_email' );
			$this->form_validation->set_rules ( 'cemail', 'Bestätigung der E-Mail Addresse', 'trim|required|matches[email]' );
			$this->form_validation->set_rules ( 'zip', 'PLZ', 'trim|required' );
			$this->form_validation->set_rules ( 'city', 'Stadt', 'trim|required' );
			$this->form_validation->set_rules ( 'street', 'Straße', 'trim|required' );
			$this->form_validation->set_rules ( 'housenumber', 'Hausnummer', 'trim|required' );
			
			// submit
			if ($this->form_validation->run () == FALSE) {
				// fails
				redirect ( 'admin/printers_creation' );
			} else {
				
				// insert address details into db
				$address = array (
						'adre_user_id' => $user_id,
						'adre_zip' => $zip,
						'adre_city' => $city,
						'adre_street' => $streetAndNr,
						'adre_name' => $addressname,
						'adre_coun_id' => '80',
						'adre_status' => 1 
				);
				$address_id = $this->PrintersCreation_model->insert_address ( $address );
				
				// Get todays date for prsu_createdon
				date_default_timezone_set ( "Europe/Berlin" );
				$timestamp = date ( 'Y-m-d H:i:s', time () );
				
				// insert printer details into db
				$data = array (
						'prsu_email' => $email,
						'prsu_status' => 1,
						'prsu_createdon' => $timestamp,
						'prsu_user_id' => $user_id,
						'prsu_adre_id' => $address_id 
				);
				
				// insert Printer and address in db
				$prsu_id = $this->PrintersCreation_model->insert_printer ( $data );
				
				if ($address_id = ! NULL && $user_id = ! NULL) {
					// Printers::generate_url ( $data );
					// $data ['printers'] = $this->Printers_model->getAllArchivedPrinters ();
					// $this->load->template ( 'admin/printers', $data );
					redirect ( 'admin/printers' );
					$this->session->set_flashdata ( 'msg', '<div class="alert alert-success text-center">Druckerei angelegt!</div>' );
				} else {
					// error
					$this->session->set_flashdata ( 'msg', '<div class="alert alert-danger text-center">Oops! Error.  Please try again later!!!</div>' );
					redirect ( 'admin/printers_creation' );
				}
			}
		} else {
			// error
			$this->session->set_flashdata ( 'msg', '<div class="alert alert-danger text-center">Bitte anmelden!!!</div>' );
			redirect ( 'admin/printers_creation' );
		}
	}
}