<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );
include_once (dirname ( __FILE__ ) . "/Product.php");
class Event extends CI_Controller {
	public function __construct() {
		parent::__construct ();
		$this->load->library ( 'session' );
		$this->load->library ( array (
				'form_validation' 
		) );
	}
	public function index() {
		$this->load->model ( 'event_model' );
		$this->load->model ( 'printers_model' );
		$data ['price_profiles'] = PriceProfile::getAllPriceProfiles ();
		
		$user_id = $this->session->userdata ( 'user_id' );
		$data ['printers'] = $this->printers_model->getPrintersForUser ( $user_id );
		
		$this->load->template ( 'event/new_event_view', $data );
	}
	public function showSingleEvent($shortcode) {
		$this->load->model ( 'event_model' );
		$event = $this->event_model->getSingleEventByShortcode ( $shortcode );
		$data ['event'] = $event [0];
		
		$data ['products_pbl'] = Event::getProductsFromEvent ( $event [0], false );
		$data ['products_prv'] = Event::getProductsFromEvent ( $event [0], true );
		
		$this->load->template ( 'event/single_event_view', $data );
	}
	public function deleteEvent() {
		$CI = & get_instance ();
		$CI->load->model ( 'event_model' );
		if (isset ( $_POST ['chk_group'] )) {
			$optionArray = $_POST ['chk_group'];
			$oki = 0;
			for($i = 0; $i < count ( $optionArray ); $i ++) {
				$ok = $CI->event_model->delete_event ( $optionArray [$i] );
				if ($ok) {
					$oki = $oki + 1;
				} else {
					$oki = $oki - 1;
				}
			}
			
			if ($oki >= 1) {
				$this->session->set_flashdata ( 'msgReg', '<div class="alert alert-success text-center"> Die Aktion wurde erfolgreich ausgeführt! </div>' );
			} else {
				$this->session->set_flashdata ( 'msgReg', '<div class="alert alert-danger text-center">Leider hat das nicht geklappt!</div>' );
			}
		}
		
		$this->showEvents ();
	}
	public function showEvents() {
		$this->load->model ( 'event_model' );
		$id = $this->session->userdata ( 'user_id' );
		$email = $this->session->userdata ( 'user_email' );
		$data ['events'] = $this->event_model->getEventsFromUserandEmail ( $id, $email );
		$this->load->template ( 'event/all_event_view', $data );
	}
	public function editEvent($id = -1) {
		if ($id == - 1)
			redirect ( '/checkout', 'refresh' );
		if ($this->input->post('submit')== "back")
			redirect ( '/event/uebersicht/', 'refresh' );
		$this->load->model ( 'event_model' );
		$this->load->model ( 'printers_model' );

		$data ['price_profiles'] = PriceProfile::getAllPriceProfiles ();		
		$user_id = $this->session->userdata ( 'user_id' );
		$data ['printers'] = $this->printers_model->getPrintersForUser ( $user_id );
		$data ['event'] = $this->event_model->getSingleEventById ( $id )[0];

		$this->load->template ( 'event/edit_event', $data );
	}
	
	// Methoden um den Status zu aendern
	public function lockEventById($even_id) {
		$this->changeEventStatus ( $even_id, EventStatus::locked );
		$this->session->set_flashdata ( 'msgReg', '<div class="alert alert-success text-center"> Dein Event wurde erfolgreich gesperrt! </div>' );
	}
	public function unlockEventById($even_id) {
		$this->changeEventStatus ( $even_id, EventStatus::prv );
		$this->session->set_flashdata ( 'msgReg', '<div class="alert alert-success text-center"> Dein Event wurde erfolgreich entsperrt! </div>' );
	}
	public function changeStateToPublicById($even_id) {
		$this->changeEventStatus ( $even_id, EventStatus::pbl );
		$this->session->set_flashdata ( 'msgReg', '<div class="alert alert-success text-center"> Dein Event wurde &ouml;ffentlich gestellt! </div>' );
	}
	public function changeStateToPrivateById($even_id) {
		$this->changeEventStatus ( $even_id, EventStatus::prv );
		$this->session->set_flashdata ( 'msgReg', '<div class="alert alert-success text-center"> Dein Event wurde privat gestellt! </div>' );
	}
	public function deleteEventById($even_id) {
		$this->changeEventStatus ( $even_id, EventStatus::deleted );
		$this->load->model ( 'event_model' );
		$id = $this->session->userdata ( 'user_id' );
		$data ['events'] = $this->event_model->getEventsFromUser ( $id );
		$data ['message'] = "<div class='alert alert-success'>Dein Event wurde erfolgreich gelöscht</div>";
		$this->load->template ( 'event/all_event_view', $data );
	}
	public function changeEventStatus($even_id, $even_status) {
		$CI = & get_instance ();
		$CI->load->model ( 'event_model' );
		
		$event = $CI->event_model->getSingleEventById ( $even_id, false );
		
		if (isset ( $event [0] )) {
			
			if ($event [0]->even_status == EventStatus::locked) {
				$event [0]->even_status = EventStatus::prv;
			} else
				$event [0]->even_status = $even_status;
			
			$CI->event_model->update_event ( $even_id, $event [0] );
		}
	}
	public static function getAllPublicEvents() {
		$CI = & get_instance ();
		$CI->load->model ( 'event_model' );
		
		$events = $CI->event_model->getAllPublicEvents ();
		
		foreach ( $events as $event ) {
			$event->products_pbl = Event::getProductsFromEvent ( $event, false );
			$event->products_prv = Event::getProductsFromEvent ( $event, true );
		}
		
		return $events;
	}
	public static function getSingleEventById($even_id) {
		$CI = & get_instance ();
		$CI->load->model ( 'event_model' );
		
		$event = $CI->event_model->getSingleEventById ( $even_id );
		return $event [0];
	}
	public static function getProductsFromEvent($event, $private = false) {
		$CI = & get_instance ();
		$CI->load->model ( 'event_model' );
		$products = $CI->event_model->getProductsFromEvent ( $event->even_id, $private );
		foreach ( $products as $product => $p ) {
			$products [$product] = Product::getProduct ( $p->prod_id, true );
		}
		return $products;
	}
	public static function searchEvents($search) {
		$CI = & get_instance ();
		$CI->load->model ( 'event_model' );
		
		$events = $CI->event_model->search ( $search );
		foreach ( $events as $event ) {
			$event->products_pbl = Event::getProductsFromEvent ( $event, false );
			$event->products_prv = Event::getProductsFromEvent ( $event, true );
		}
		
		return $events;
	}
	function newEvent() {
		$user_id = $this->session->userdata ( 'user_id' );
		
		if ($user_id) {
			
			// set form validation rules
			$this->form_validation->set_rules ( 'even_name', 'Event Name', 'trim|required|min_length[3]|max_length[30]' );
			$this->form_validation->set_rules ( 'even_password', 'Event Password', 'trim|required|min_length[3]|max_length[30]' );
			$this->form_validation->set_rules ( 'even_host_email', 'E-Mail Adresse', 'trim|required|min_length[3]|max_length[100]' );
			$this->form_validation->set_rules ( 'even_date', 'Datum', 'trim|required|min_length[10]|max_length[10]' );
			$this->form_validation->set_rules ( 'even_status', 'Öffentlich', '' );
			// $this->form_validation->set_rules('even_url', 'Password', 'trim|required|matches[user_cpassword]');
			// $this->form_validation->set_rules('even_user_id', 'Confirm Password', 'trim|required');
			// $this->form_validation->set_rules('even_status', 'Confirm Password', 'trim|required');
			
			$even_prpr_id = $this->input->post ( 'even_prpr_id' );
			$even_prsu_id = $this->input->post ( 'even_prsu_id' );
			$even_password = $this->input->post ( 'even_password' );
			$even_host_email = $this->input->post ( 'even_host_email' );
			
			$even_status = $this->input->post ( 'even_status' );
			if (isset ( $even_status ))
				$even_status = EventStatus::prv;
			else
				$even_status = EventStatus::pbl;
				
				// submit
			if ($this->form_validation->run () == FALSE) {
				// fails
				$this->load->view ( 'event/new_event_view' );
			} else {
				// insert event details into db
				$data = array (
						'even_name' => $this->input->post ( 'even_name' ),
						'even_date' => $this->input->post ( 'even_date' ),
						'even_status' => $even_status,
						'even_url' => '',
						'even_user_id' => $user_id,
						'even_prpr_id' => $even_prpr_id,
						'even_password' => $even_password,
						'even_host_email' => $even_host_email,
						'even_prsu_id' => $even_prsu_id 
				);
				
				$this->load->model ( 'event_model' );
				if ($this->event_model->insert_event ( $data )) {
					Event::generate_url ( $data );
					$this->session->set_flashdata ( 'msg', '<div class="alert alert-success text-center">Event angelegt!</div>' );
					redirect ( 'event/' . $data ['even_url'] );
				} else {
					// error
					$this->session->set_flashdata ( 'msg', '<div class="alert alert-danger text-center">Oops! Error.  Please try again later!!!</div>' );
					redirect ( 'event/' );
				}
			}
		} else {
			// error
			$this->session->set_flashdata ( 'msg', '<div class="alert alert-danger text-center">Bitte anmelden!!!</div>' );
			redirect ( 'event/' );
		}
	}
	function generate_url(&$data) {
		$this->load->model ( 'event_model' );
		$id = $this->event_model->get_max_id ();
		$even_id = $id;
		$even_url = base_convert ( $even_id, 20, 36 );
		$data ['even_url'] = $even_url;
		$this->event_model->update_event ( $id, $data );
	}
	//
	// Alle Gültigen Formate für die Kombination aus Preisprofil und Druckerei
	//
	function getProductVariantsForPrinterPriceProfile($prpr_id, $prsu_id) {
		$user_commision = $this->session->userdata ( 'user_commision' );
		$this->load->model ( 'product_model' );
		$product_variants = $this->product_model->getProductVariantsForPrinterPriceProfile ( $prsu_id, $prpr_id );
		foreach ( $product_variants as $product_variant ) {
			$product_variant->price = Product::getPrice ( $prpr_id, $product_variant->prty_id, $prsu_id, $user_commision );
		}
		return $product_variants;
	}
	function getProductVariantsForPrinterPriceProfileAsJson() {
		$prpr_id = $this->input->post ( 'priceid' );
		$prsu_id = $this->input->post ( 'printerid' );
		
		$data = $this->getProductVariantsForPrinterPriceProfile ( $prpr_id, $prsu_id );
		
		echo json_encode ( $data );
	}
}
abstract class EventStatus {
	const undefined = 0;
	const locked = 1;
	const prv = 2;
	const pbl = 3;
	const deleted = 4;
}
?>