<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );
include_once (dirname ( __FILE__ ) . "/Shoppingcart.php");
class Order extends CI_Controller {
	private static $shopping_cart;
	public function __construct() {
		parent::__construct ();
		$this->load->model ( 'order_model' );
	}
	public function index() {
		$this->load->template ( 'order/single_order_view' );
	}
	public function showSingleOrder($orde_id) {
		$data ['order'] = $this->order_model->getSingleOrderById ( $orde_id );
		$this->load->template ( 'order/single_order_view', $data );
	}
	
	// Warenwert aus Warenkorb für Bestellung ermitteln
	public static function calcOrder($shca_id) {
		$orde_sum = 0;
		if (! isset ( $GLOBALS ['shopping_cart'] )) {
			$GLOBALS ['shopping_cart'] = ShoppingCart::getSingleShoppingCartById ( $shca_id );
		}
		$shopping_cart = ShoppingCart::getSingleShoppingCartById ( $shca_id );
		foreach ( $GLOBALS ['shopping_cart']->shoppingcart_positions as $shoppingcart_position ) {
			$product_variant = $shoppingcart_position->product_variant;
			
			$price_sum = $product_variant->price ['price_sum'];
			$orde_sum += $price_sum;
		}
		return $orde_sum;
	}
	public static function buildOrderNumber($order) {
		$order_no = sprintf ( "%06d", $order ['orde_id'] );
		return $order_no;
	}
}
