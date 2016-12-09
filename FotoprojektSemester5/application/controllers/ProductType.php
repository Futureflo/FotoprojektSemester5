<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );
class ProductType extends CI_Controller {

	public function index() {
		$this->load->template ( 'product/single_product_type_view' );
	}
	public function showSingleProductType($prty_id) {
		$this->load->model('product_type_model');
		$data['product_type'] = $this->product_type_model->get_product_type_by_id($prty_id);
 		$this->load->template ( 'product/single_product_type_view', $data );		
	}
	
	public function product_types()
	{
		$this->load->model('product_type_model');
		$data['product_types'] = $this->product_type_model->getAllProductType();
		$this->load->template ( 'admin/product_type_view', $data );
	}
}
