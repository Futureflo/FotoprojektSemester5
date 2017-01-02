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
		$data ['products'] = Event::getProductsFromEvent ( $event [0] );
		
		$this->load->template ( 'event/single_event_view', $data );
	}
	public function lockEventById($even_id) {
		$CI = & get_instance ();
		$CI->load->model ( 'event_model' );
		
		$event = $CI->event_model->getSingleEventById ( $even_id );
		
		if (isset ( $event [0] )) {
			$event [0]->even_status = EventStatus::locked;
			$CI->event_model->update_event ( $even_id, $event [0] );
		}
	}
	public static function getAllPublicEvents() {
		$CI = & get_instance ();
		$CI->load->model ( 'event_model' );
		
		$events = $CI->event_model->getAllPublicEvents ();
		
		foreach ( $events as $event ) {
			$event->products = Event::getProductsFromEvent ( $event );
		}
		
		return $events;
	}
	public static function getSingleEventById($even_id) {
		$CI = & get_instance ();
		$CI->load->model ( 'event_model' );
		
		$event = $CI->event_model->getSingleEventById ( $even_id );
		return $event [0];
	}
	public static function getProductsFromEvent($event) {
		$CI = & get_instance ();
		$CI->load->model ( 'event_model' );
		$products = $CI->event_model->getProductsFromEvent ( $event->even_id );
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
			$event->products = Event::getProductsFromEvent ( $event );
		}
		
		return $events;
	}
	function newEvent() {
		$user_id = $this->session->userdata ( 'user_id' );
		
		if ($user_id) {
			
			// set form validation rules
			$this->form_validation->set_rules ( 'even_name', 'Event Name', 'trim|required|min_length[3]|max_length[30]' );
			$this->form_validation->set_rules ( 'even_date', 'Datum', 'trim|required|min_length[10]|max_length[10]' );
			$this->form_validation->set_rules ( 'even_status', 'Öffentlich', '' );
			// $this->form_validation->set_rules('even_url', 'Password', 'trim|required|matches[user_cpassword]');
			// $this->form_validation->set_rules('even_user_id', 'Confirm Password', 'trim|required');
			// $this->form_validation->set_rules('even_status', 'Confirm Password', 'trim|required');
			
			$even_prpr_id = $this->input->post ( 'even_prpr_id' );
			$even_prsu_id = $this->input->post ( 'even_prsu_id' );
			
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
}
abstract class EventStatus {
	const undefined = 0;
	const locked = 1;
	const prv = 2;
	const pbl = 3;
	const deleted = 4;
}
?>