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
	public function index() {
		$this->load->template ( 'newsletter/newsletter_view.php' );
	}

	public function addUnregistered() {
		$email = $this->input->post('email');
		
		$neleData = array(
				'nele_status' => 1,
				'nele_email' => $email
				);
		$this->user_model->insert_UserToNewsletter($neleData);
		$this->load->template ( 'newsletter/success_newsletter_view.php',$neleData );
	}
	public function call_unregister_view() {
		$this->load->template ( 'newsletter/newsletterunregister_view.php' );
	}
}
