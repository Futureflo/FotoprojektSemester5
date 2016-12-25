<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );
include_once (dirname ( __FILE__ ) . "/ShoppingCart.php");
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
	public function newOrder() {
		$this->load->model ( 'adress_model' );
		$this->load->model ( 'shoppingcart_model' );
		
		$orde_user_id = $this->session->userdata ( 'user_id' );
		$shca_id = $this->input->post ( 'shca_id' );
		$orde_de_adre_id = $this->input->post ( 'orde_de_adre_id' );
		$orde_in_adre_id = $this->input->post ( 'orde_in_adre_id' );
		$orde_pain_id = 1;
		$orde_prsu_id = 0;
		
		// Liefer- und Rechnungsadressdaten ermitteln
		$orde_de_adre = $this->adress_model->getSingleAdress ( $orde_de_adre_id );
		$orde_in_adre = $this->adress_model->getSingleAdress ( $orde_in_adre_id );
		
		$orde_delivery_charge = 0;
		$orde_commission = 0;
		
		// Warenwert berechnen
		$orde_sum = Order::calcOrder ( $shca_id );
		
		if ($orde_user_id) {
			
			$order = array (
					'orde_id' => 0,
					'orde_no' => "",
					'orde_date' => date ( "Y-m-d H:i:s" ),
					'orde_user_id' => $orde_user_id,
					'orde_pain_id' => $orde_pain_id,
					'orde_delivery_charge' => $orde_delivery_charge,
					'orde_commission' => $orde_commission,
					'orde_sum' => $orde_sum,
					'orde_prsu_id' => $orde_prsu_id,
					
					'orde_de_adre_name' => $orde_de_adre->adre_name,
					'orde_de_adre_street' => $orde_de_adre->adre_street,
					'orde_de_adre_zip' => $orde_de_adre->adre_zip,
					'orde_de_adre_city' => $orde_de_adre->adre_city,
					'orde_de_adre_coun_id' => $orde_de_adre->adre_coun_id,
					
					'orde_in_adre_name' => $orde_in_adre->adre_name,
					'orde_in_adre_street' => $orde_in_adre->adre_street,
					'orde_in_adre_zip' => $orde_in_adre->adre_zip,
					'orde_in_adre_city' => $orde_in_adre->adre_city,
					'orde_in_adre_coun_id' => $orde_in_adre->adre_coun_id 
			);
			
			// Bestellung anlegen
			$orde_id = $this->order_model->insert_order ( $order );
			if ($orde_id) {
				// Positionen anlegen
				$this->insert_position ( $orde_id, $shca_id );
			}
			
			$order ['orde_id'] = $orde_id;
			$order ['orde_no'] = $this->buildOrderNumber ( $order );
			$this->order_model->update_order ( $orde_id, $order );
			
			// Warenkorb löschen
			$this->shoppingcart_model->delete_shopping_cart ( $shca_id );
			
			redirect ( 'user/myOrders' );
		}
	}
	public function insert_position($orde_id, $shca_id) {
		if (! isset ( $GLOBALS ['shopping_cart'] )) {
			$GLOBALS ['shopping_cart'] = ShoppingCart::getSingleShoppingCartById ( $shca_id );
		}
		// Für jede Positon im Warenkorb eine Bestellpostion anlegen
		foreach ( $GLOBALS ['shopping_cart']->shoppingcart_positions as $shoppingcart_position ) {
			$product_variant = $shoppingcart_position->product_variant;
			$order_position = array (
					'orpo_orde_id' => $orde_id,
					'orpo_prod_id' => $shoppingcart_position->scpo_prod_id,
					'orpo_amount' => $shoppingcart_position->scpo_amount,
					'orpo_price' => $product_variant->price ['price_sum'],
					'orpo_prty_id' => $shoppingcart_position->scpo_prty_id 
			);
			
			$this->order_model->insert_order_position ( $order_position );
		}
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
	public function buildOrderNumber($order) {
		$order_no = sprintf ( "%06d", $order ['orde_id'] );
		return $order_no;
	}
}
