<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );
class Newsletter extends CI_Controller {
	
	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * http://example.com/index.php/welcome
	 * - or -
	 * http://example.com/index.php/welcome/index
	 * - or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 *
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function __construct() {
		parent::__construct ();
		$this->load->helper ( array (
				'form' 
		) );
		$this->load->library ( array (
				'form_validation' 
		) );
		$this->load->database ();
		$this->load->model ( 'user_model' );
	}
	public function index() {
		$this->load->template ( 'newsletter/newsletter_view.php' );
	}
	public function addUnregistered() {
		$this->form_validation->set_rules ( "email", "Email-ID", "trim|required|valid_email" );
		$email = $this->input->post ( 'email' );
		$neleData = array (
				'nele_status' => 1,
				'nele_email' => $email 
		);
		if ($this->form_validation->run () == FALSE) {
			// validation fail
			$this->load->template ( 'newsletter/newsletter_view' );
		} else {
			if ($this->user_model->mail_exists ( $email )) {
				$result_user = $this->user_model->get_user ( $email );
				$userID = $result_user [0]->user_id;
				$this->user_model->update_addUserToNewsletter ( $userID );
				$this->load->template ( 'newsletter/success_newsletter_view.php', $neleData );
			} else {
				$this->user_model->insert_UserToNewsletter ( $neleData );
				$this->load->template ( 'newsletter/success_newsletter_view.php', $neleData );
			}
		}
	}
	public function call_unregister_view() {
		$this->load->template ( 'newsletter/newsletterunregister_view.php' );
	}
	public function unregister() {
		$this->form_validation->set_rules ( "email", "Email-ID", "trim|required|valid_email|callback_is_user_already_registered" );
		$this->form_validation->set_message ( 'is_user_already_registered', 'E-Mail kann nicht abgemeldet werden, da E-Mail nicht bekannt.' );
		$email = $this->input->post ( 'email' );
		$neleData = array (
				'nele_email' => $email 
		);
		if ($this->form_validation->run () == FALSE) {
			// validation fail
			$this->load->template ( 'newsletter/newsletterunregister_view' );
		} else {
			if ($this->user_model->mail_exists ( $email )) {
				$result_user = $this->user_model->get_user ( $email );
				$userID = $result_user [0]->user_id;
				$this->user_model->update_unregisterUserToNewsletter ( $userID );
				$this->load->template ( 'newsletter/success_unregister_newsletter_view.php', $neleData );
			} else {
				$this->user_model->update_NewsletterStatusUnregister ( $email );
				$this->load->template ( 'newsletter/success_unregister_newsletter_view.php', $neleData );
			}
		}
	}
	function is_user_already_registered($email) {
		$field_value = $email; // this is redundant, but it's to show you how
		                       // the content of the fields gets automatically passed to the method
		if ($this->user_model->mail_exists ( $email )) {
			$result_user = $this->user_model->get_user ( $email );
			$userID = $result_user [0]->user_id;
			$userNewsletter = $result_user [0]->user_newsletter;
			if ($userNewsletter == FALSE) {
				return TRUE;
			}
		} elseif ($this->user_model->checkNewsletterEmail ( $email ) == True) {
			return TRUE;
		} else {
			return FALSE;
		}
	}
}
