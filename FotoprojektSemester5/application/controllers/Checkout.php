<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );
class Checkout extends CI_Controller {
	public function index() {
		$this->load->model ( 'shoppingcart_model' );
		
		$user_id = $this->session->userdata ( 'user_id' );
		$cart = $this->shoppingcart_model->getShoppingCart ( $user_id );
		
		$shca_id = $cart->shca_id;
		$shoppingcart_positions = $this->shoppingcart_model->getShoppingCartPositions ( $shca_id );
		
		$data ['userid'] = $user_id;
		$data ['shcaid'] = $shca_id;
		$data ['shoppingcartpositions'] = $shoppingcart_positions;
		$this->load->template ( 'checkout/checkout_view', $data );
	}
}
?>