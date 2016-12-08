<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );
class Event extends CI_Controller {
	public function index() {
		$this->load->template ( 'event/new_event_view' );
	}
	public function showSingleEvent($shortcode) {
      	$this->load->model('event_model');
      	$event = $this->event_model->getSingleEventByShortcode($shortcode);
      	$data['event'] = $event;
      	$data['products'] = $this->event_model->getProductsFromEvent($event[0]->even_id);
      	
		$this->load->template ( 'event/single_event_view', $data );
	}
}
?>