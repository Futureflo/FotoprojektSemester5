<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );
include_once (dirname ( __FILE__ ) . "/UserRole.php");
include_once (dirname ( __FILE__ ) . "/Product.php");
class Shoppingcart extends CI_Controller {
	public function __construct() {
		parent::__construct ();
		$this->load->model('user_model');
		
		$this->load->library ( array (
				'form_validation' 
		) );
		$this->load->model ( 'shoppingcart_model' );
	}
	public function index() {
		
		$user_id = $this->session->userdata ( 'user_id' );
		// ceck if user is logged in 
		if ($user_id == Null){
			$this->creatAnonymousUser();
			$user_id = $this->session->userdata ( 'user_id' );

		}
			
		$cart = $this->shoppingcart_model->getShoppingCart ( $user_id );
		if (! isset ( $cart )) {
			
			$shopping_cart = array (
					'shca_id' => 0,
					// 'shca_commission' => 0,
					// 'shca_sum' => 0,
					// 'shca_delivery_charge' => 0,
					'shca_user_id' => $user_id 
			);
			$shca_id = $this->shoppingcart_model->insert_shopping_cart ( $shopping_cart );
			$cart->shoppingcart_positions = array ();
		} else
			$shca_id = $cart->shca_id;
		
		$shoppingcart_positions = $this->shoppingcart_model->getShoppingCartPositions ( $shca_id );
		
		foreach ( $shoppingcart_positions as $shoppingcart_position ) {
			$prod_id = $shoppingcart_position->scpo_prod_id;
			$prty_id = $shoppingcart_position->scpo_prty_id;
			
			$shoppingcart_position->product_variant = Product::getProductVariant ( $prod_id, $prty_id );
		}
		$cart->shoppingcart_positions = $shoppingcart_positions;
		$data ['userid'] = $user_id;
		$data ['shcaid'] = $shca_id;
		$data ['cart'] = $cart;
 		$this->load->template ( 'checkout/checkout_view', $data );
		
	}
	// if costumer is not logged in -> create anonymous user
	function creatAnonymousUser(){

		// insert AnonymousUser in db
		$data = array ('user_role_id' => UserRole::AnonymousUser);
		$user_id = $this->user_model->insert_user ( $data );
		// set session
		$sess_data = array (
				'login' => FALSE,
				'user_id' => $user_id
		);
		$this->session->set_userdata ( $sess_data );

		
	}
	
	function insert() {
		$scpo_prod_id = $this->input->post ( 'scpo_prod_id' );
		$scpo_prty_id = $this->input->post ( 'scpo_prty_id' );

		//MB: special from single_event_view 
		if(isset($_POST['beschreibungSelect'])){			
			$parts = explode("-", $_POST['beschreibungSelect']);
			if(count($parts) == 2){
				$scpo_prod_id = $parts[0];
				$scpo_prty_id = $parts[1];
			}
		}


		$scpo_amount = $this->input->post ( 'scpo_amount' );
		$user_id = $this->session->userdata ( 'user_id' );
		$shca_id = 0;
		
		if ($user_id == Null){			
			$this->creatAnonymousUser();
			$user_id = $this->session->userdata ( 'user_id' );
		}		
		
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
		if(isset($_POST['beschreibungSelect']) == false) //if beschriebungsSelect isset don't redirect (from single_event_view)
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

	
	public function overview() {
		$this->load->model ( 'shoppingcart_model' );
		$this->load->model ( 'adress_model' );
		
		$user_id = $this->session->userdata ( 'user_id' );
		$cart = $this->shoppingcart_model->getShoppingCart ( $user_id );
		
		$shca_id = $cart->shca_id;
		
		$shoppingcart_positions = $this->shoppingcart_model->getShoppingCartPositions ( $shca_id );
		
		foreach ( $shoppingcart_positions as $shoppingcart_position ) {
			$prod_id = $shoppingcart_position->scpo_prod_id;
			$prty_id = $shoppingcart_position->scpo_prty_id;
			
			$shoppingcart_position->product_variant = Product::getProductVariant ( $prod_id, $prty_id );
		}
		$cart->shoppingcart_positions = $shoppingcart_positions;
		$data ['userid'] = $user_id;
		$data ['shcaid'] = $shca_id;
		$data ['cart'] = $cart;
		$data ['adresses'] = $this->adress_model->getAdressesForUser ( $user_id );
		$this->load->template ( 'checkout/checkout_overview', $data );
	}
	public function guest() {
		$this->load->template ( 'checkout/checkout_guest.php' );
	}
	public function payment() {
		$this->load->template ( 'checkout/checkout_payment.php' );
	}
	public function customer() {
		$this->load->model ( 'user_model' );
		$this->load->model ( 'adress_model' );
		
		$user_id = $this->session->userdata ( 'user_id' );
		
		$user = $this->user_model->get_user_by_id ( $user_id );
		$address = $this->user_model->get_address_by_id ( $user_id );
		
		$data ['user_title'] = $user [0]->user_title;
		$data ['user_name'] = $user [0]->user_name;
		$data ['user_firstname'] = $user [0]->user_firstname;
		
		$data ['adre_name'] = $address [0]->adre_name;
		$data ['adre_street'] = $address [0]->adre_street;
		$data ['adre_zip'] = $address [0]->adre_zip;
		$data ['adre_city'] = $address [0]->adre_city;
		
		$this->load->template ( 'checkout/checkout_customer.php', $data );
	}
}
