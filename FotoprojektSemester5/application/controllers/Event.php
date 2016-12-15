<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );

class Event extends CI_Controller {
	const base_path = "/Images/";
	
	public function __construct() {
		parent::__construct ();
 		$this->load->library ( 'session' );
		$this->load->library(array('form_validation'));
	}
	public function index() {
		$this->load->model('event_model');
		$this->load->template ( 'event/new_event_view' );
	}
	public function showSingleEvent($shortcode) {
      	$this->load->model('event_model');
      	$event = $this->event_model->getSingleEventByShortcode($shortcode);
      	$data['event'] = $event;
      	$products = $this->event_model->getProductsFromEvent($event[0]->even_id);
      	
      	foreach ($products as $p)	{
      		$date=date_create($p->prod_date);
      		$path = Event::base_path . date_format($date,"o/m") . "/" . $p->prod_filepath;
      		$p->prod_filepath  = $path;
      	}
      	
      	$data['products'] = $products;
      	
		$this->load->template ( 'event/single_event_view', $data );
	}
	
	function newEvent()
	{
		$user_id = $this->session->userdata('user_id');
		
		if($user_id)
		{
		
			// set form validation rules
	 		$this->form_validation->set_rules('even_name', 'Event Name', 'trim|required|min_length[3]|max_length[30]');
	 		$this->form_validation->set_rules('even_date', 'Datum', 'trim|required|min_length[10]|max_length[10]');
	 		$this->form_validation->set_rules('even_status', 'Öffentlich', '');
	// 		$this->form_validation->set_rules('even_url', 'Password', 'trim|required|matches[user_cpassword]');
	// 		$this->form_validation->set_rules('even_user_id', 'Confirm Password', 'trim|required');
	// 		$this->form_validation->set_rules('even_status', 'Confirm Password', 'trim|required');
		
	 		$even_status = $this->input->post('even_status'); 
	 		if(isset($even_status)) $even_status = EventStatus::prv;
	 		else $even_status = EventStatus::pbl;
	 			
			// submit
			if ($this->form_validation->run() == FALSE)
			{
				// fails
				$this->load->view( 'event/new_event_view');
			}
			else
			{
				//insert event details into db
				$data = array(
						'even_name' => $this->input->post('even_name'),
						'even_date' => $this->input->post('even_date'),
						'even_status' => $even_status,
	 					'even_url' => '',
						'even_user_id' => $user_id
				);
	
				$this->load->model('event_model');
				if ($this->event_model->insert_event($data))
				{
					Event::generate_url($data);
					$this->session->set_flashdata('msg','<div class="alert alert-success text-center">Event angelegt!</div>');
					redirect('event/' . $data['even_url']);
				}
				else
				{
					// error
					$this->session->set_flashdata('msg','<div class="alert alert-danger text-center">Oops! Error.  Please try again later!!!</div>');
					redirect('event/');
		
				}
			}
		}
		else
		{
			// error
			$this->session->set_flashdata('msg','<div class="alert alert-danger text-center">Bitte anmelden!!!</div>');
			redirect('event/');
		}
		
	}
	
	function generate_url(&$data)
	{
		$this->load->model('event_model');
		$id = $this->event_model->get_max_id();
		$even_id = $id;
		$even_url = base_convert($even_id,20,36);
		$data['even_url']  = $even_url;
		$this->event_model->update_event($id, $data);
	}
}

abstract class EventStatus
{
	const undefined	= 0; 
	const locked	= 1;
	const prv	= 2;
	const pbl 	= 3;
	const deleted	= 4;
}
?>