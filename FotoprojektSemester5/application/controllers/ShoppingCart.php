<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );
include_once (dirname ( __FILE__ ) . "/Product.php");
class ShoppingCart extends CI_Controller {
	public function __construct() {
		parent::__construct ();
		$this->load->library ( array (
				'form_validation' 
		) );
		$this->load->model ( 'shoppingcart_model' );
	}
	public function index() {
		$this->load->template ( 'order/single_order_view' );
	}
	function insert() {
		$scpo_prod_id = $this->input->post ( 'scpo_prod_id' );
		$scpo_prty_id = $this->input->post ( 'scpo_prty_id' );
		$scpo_amount = $this->input->post ( 'scpo_amount' );
		$user_id = $this->session->userdata ( 'user_id' );
		$shca_id = 0;
		
		// // Shoppingcart-Kopf suchen/anlegen
		$shopping_cart = $this->shoppingcart_model->getShoppingCart ( $user_id );
		if (! isset ( $shopping_cart )) {
			
			$shopping_cart = array (
					'shca_id' => 0,
					'shca_commission' => 0,
					'shca_sum' => 0,
					'shca_delivery_charge' => 0,
					'shca_user_id' => $user_id 
			);
			$shca_id = $this->shoppingcart_model->insert_shopping_cart ( $shopping_cart );
		} else {
			$shca_id = $shopping_cart->shca_id;
		}
		
		// Wenn Warenkorb vorhanden, die Positon im Warenkorb anlegen
		if ($shca_id) {
			$shopping_cart_position = $this->shoppingcart_model->getShoppingCartPosition ( $shca_id, $scpo_prod_id, $scpo_prty_id );
			if (isset ( $shopping_cart_position )) {
				$shopping_cart_position->scpo_amount = $shopping_cart_position->scpo_amount + $scpo_amount;
				$this->shoppingcart_model->update_shopping_cart_position ( $shopping_cart_position );
			} else {
				$shopping_cart_position = array (
						'scpo_shca_id' => $shca_id,
						'scpo_prod_id' => $scpo_prod_id,
						'scpo_prty_id' => $scpo_prty_id,
						'scpo_amount' => $scpo_amount 
				);
				$this->shoppingcart_model->insert_shopping_cart_position ( $shopping_cart_position );
			}
			
			$this->session->set_flashdata ( 'msg', '<div class="alert alert-success text-center">Postion angelegt!</div>' );
		}
		
		// Jetzt den Warenkorb aktualisieren
		
		// Testseite wieder aufrufen
		redirect ( 'Product/ShowSinglePicture/' . $scpo_prod_id );
	}
	public static function getSingleShoppingCartById($shca_id) {
		$CI = & get_instance ();
		$CI->load->model ( 'shoppingcart_model' );
		
		$user_id = $CI->session->userdata ( 'user_id' );
		$cart = $CI->shoppingcart_model->getShoppingCartById ( $shca_id );
		
		$shca_id = $cart->shca_id;
		$shoppingcart_positions = $CI->shoppingcart_model->getShoppingCartPositions ( $shca_id );
		
		foreach ( $shoppingcart_positions as $shoppingcart_position ) {
			$prod_id = $shoppingcart_position->scpo_prod_id;
			$prty_id = $shoppingcart_position->scpo_prty_id;
			
			$shoppingcart_position->product_variant = Product::getProductVariant ( $prod_id, $prty_id );
		}
		$cart->shoppingcart_positions = $shoppingcart_positions;
		return $cart;
	}
}
