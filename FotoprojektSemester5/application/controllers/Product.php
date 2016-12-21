<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );
include_once (dirname(__FILE__) . "/PriceProfile.php");
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
	public function showSinglePicture($prod_id) {
		$data['product']  = Product::getProduct($prod_id);
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
	
	public static function getProduct($prod_id)
	{
		$CI =& get_instance();
		$CI->load->model('product_model');
		$product = $CI->product_model->getSingleProduct($prod_id);
 		$product[0]->product_variants = Product::getProductVariants($prod_id);
 		$product[0]->prod_filepath = Product::buildFilePath($product[0]);
		return $product[0];
	}
	
	
	public static function getProductVariants($prod_id)
	{
		$CI =& get_instance();
		$CI->load->model('product_model');
		$product_variants = $CI->product_model->getProductVariants($prod_id);
		
		//Preis aus Preisprofil besorgen
		foreach ($product_variants as $product_variant) {
			$product_variant->price = PriceProfile::getPriceByProductType($product_variant->prod_even_id, $product_variant->prva_prty_id);
		}

		return $product_variants;
	}
	
	function insert()
	{
		$this->form_validation->set_rules('dateiupload', 'Dateiname', 'trim|required|min_length[3]|max_length[30]');
		
		$dateiupload = $this->input->post('dateiupload');
			
		if($dateiupload)
		{
			// set form validation rules
			$prod_name =  get_name($dateiupload);
			$prod_status = ProductStatus::locked;
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

abstract class ProductStatus
{
	const undefined	= 0;
	const locked	= 1;
	const approved	= 2;
	const deleted	= 3;
}
