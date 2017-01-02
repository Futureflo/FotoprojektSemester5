<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );
include_once (dirname ( __FILE__ ) . "/Product.php");
class Checkout extends CI_Controller {
	public function index() {
		$this->load->model ( 'shoppingcart_model' );
		
		$user_id = $this->session->userdata ( 'user_id' );
		$cart = $this->shoppingcart_model->getShoppingCart ( $user_id );
		
		$shca_id = $cart->shca_id;
		
		$shoppingcart_positions = $this->shoppingcart_model->getShoppingCartPositions ( $shca_id );
		
		foreach ( $shoppingcart_positions as $shoppingcart_position ) {
			$prod_id = $shoppingcart_position->scpo_prod_id;
			$prty_id = $shoppingcart_position->scpo_prty_id;
			
			$shoppingcart_position->product_variant = Product::getProductVariant ( $prod_id, $prty_id );
		}
		// Müsste hier nicht jede Shoppingcart_position noch den $shoppingcart_positions zugeördnet werden?
		$cart->shoppingcart_positions = $shoppingcart_positions;
		$data ['userid'] = $user_id;
		$data ['shcaid'] = $shca_id;
		$data ['cart'] = $cart;
		$this->load->template ( 'checkout/checkout_view', $data );
	}
}
?>