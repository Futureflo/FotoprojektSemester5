<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );
class Order extends CI_Controller {

	public function index() {
		$this->load->template ( 'order/single_order_view' );
	}
	public function showSingleOrder($orde_id) {
		$this->load->model('order_model');
		$data['order'] = $this->order_model->getSingleOrderById($orde_id);
 		$this->load->template ( 'order/single_order_view', $data );		
	}
	
	public function product_types()
	{
		$this->load->model('product_type_model');
		$data['product_types'] = $this->product_type_model->getAllProductType();
		$this->load->template ( 'admin/product_type_view', $data );
	}
}

abstract class ProuctStatus
{
	const undefined	= 0;
	const locked	= 1;
	const approved	= 2;
	const deleted	= 3;
}