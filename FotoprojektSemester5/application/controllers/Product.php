<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );
class Product extends CI_Controller {
	const base_path = "/Images/";
	
	public function __construct() {
		parent::__construct ();
		$this->load->library ( 'session' );
		$this->load->library(array('form_validation'));
	}
	
	public function index() {
		$this->load->template ( 'errors/404' );
	}
	public function showSinglePicture($picuri) {
		$data = array();
		$this->load->template ( 'product/single_picture_view', $data );
	}
	
	public static function buildFilePath($p)
	{
		//Datum-String in Datum umwandeln
		$date=date_create($p->prod_date);
		//Dateipfad erstellen. Bsp.: "/Images/2016/12/001.png"
		$path = Product::base_path . date_format($date,"o/m") . "/" . $p->prod_filepath;
		return $path;
	}
	
	function insert()
	{
		$this->form_validation->set_rules('dateiupload', 'Dateiname', 'trim|required|min_length[3]|max_length[30]');
		
		$dateiupload = $this->input->post('dateiupload');
			
		if($dateiupload)
		{
			// set form validation rules
			$prod_name =  get_name($dateiupload);
			$prod_status = ProuctStatus::locked;
			$prod_date = date("Y-m-d");
			$prod_filepath = '';
			$prod_even_id = $this->input->post('even_id');
			
			upload();
					 	
			// submit
			if ($this->form_validation->run() == FALSE)
			{
				// fails
				$this->load->view( 'event/single_event_view');
			}
			else
			{
				//insert event details into db
				$data = array(
						'prod_date' => $prod_date,
						'prod_even_id' => $prod_even_id,
						'prod_name' => $prod_name,
						'prod_status' => $prod_status
// 						'prod_filepath' => $user_id
				);
	
				$this->load->model('product_model');
				if ($this->product_model->insert_product($data))
				{
				
					$config['upload_path']          = 'uploads/';
					$config['allowed_types']        = 'gif|jpg|png';
					$config['max_size']             = 100;
					$config['max_width']            = 1024;
					$config['max_height']           = 768;
	
					$this->load->library('upload', $config);
					$this->upload->initialize($config);
					
					if ( ! $this->upload->do_upload('dateiupload'))
					{
							$this->session->set_flashdata('msg',$this->upload->display_errors());
					}
					else
					{
							$data = array('dateiupload' => $this->upload->data());
							$this->session->set_flashdata('msg',$data);
							//$this->session->set_flashdata('msg','<div class="alert alert-success text-center">Product hochgeladen!</div>');
						
					}

					$this->load->model('event_model');
					$event = $this->event_model->getSingleEventById($prod_even_id);
					redirect('event/' . $event[0]->even_url);
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
			$this->session->set_flashdata('msg','<div class="alert alert-danger text-center">Keine Datei ausgewählt anmelden!!!</div>'.$dateiupload[0].'');
			redirect('event/' . $data['even_url']);
		}
	}
}

function get_name($filename)
{
	$name = "";
	$pos = strpos($filename, "\\");
	$pos2 = strrpos($filename, ".");

 	$name = substr($filename, $pos, $pos2); 
	return $name;
}

function upload()
{
	
}

abstract class ProuctStatus
{
	const undefined	= 0;
	const locked	= 1;
	const approved	= 2;
	const deleted	= 3;
}
