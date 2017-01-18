<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );
include_once (dirname ( __FILE__ ) . "/Product.php");
class Checkout extends CI_Controller {
	public function __construct() {
		parent::__construct ();

		$this->load->helper('form');
        $this->load->library('form_validation');
	}

	public function index()
	{
		$orderstep = "";
		if(isset($_SESSION['order_step']))
			$orderstep = $_SESSION['order_step'];
		switch ($orderstep) {
			default:
				$_SESSION['order'] = array();
				$this->adress();
				break;

			case '1':
				$this->payment();
				break;	

			case '2':
				$this->check();
				break;	

			case '3':
				$this->finish();
				break;
			
		}
		 
	}
	private function adress(){
		//Preparing Countryoptions
		$this->load->model ( 'country_model' );
		$data['countryoptions'] = ""; //initialize
		foreach ($this->country_model->getAllCountries() as $country) {
			$selected = "";
			//preselect Germany
			if($country->coun_iso == "DE")
				$selected = " selected ";
			$data['countryoptions'] .= "<option value=\"".$country->coun_id."\" ".$selected.">".$country->coun_nicename."</option>";
		}

		//if user is logged in
		if(lh_isUserLoggedin()){
			//usr submit form
        	if(isset($_POST['invoiceAdressID'])){ 

				$this->load->model ( 'adress_model' );
				$invoiceAdress = $this->adress_model->getSingleAdress($_POST['invoiceAdressID']);

				if($_POST['deliveryAdressID'] != 0){
					//if user chose different delivery adress
					$deliveryAdress = $this->adress_model->getSingleAdress($_POST['deliveryAdressID']);
				}
				else{
					//user selected same as invoice adress...
					$deliveryAdress = $invoiceAdress;
				}

            	$order = array();     
            		
            	$order['orde_de_adre_name'] = $deliveryAdress->adre_name;
            	$order['orde_de_adre_street'] = $deliveryAdress->adre_street;
            	$order['orde_de_adre_zip'] = $deliveryAdress->adre_zip;
            	$order['orde_de_adre_city'] = $deliveryAdress->adre_city;
            	$order['orde_de_adre_coun_id'] = $deliveryAdress->adre_coun_id;

            	$order['orde_in_adre_name'] = $invoiceAdress->adre_name;
            	$order['orde_in_adre_street'] = $invoiceAdress->adre_street;
            	$order['orde_in_adre_zip'] = $invoiceAdress->adre_zip;
            	$order['orde_in_adre_city'] = $invoiceAdress->adre_city;
            	$order['orde_in_adre_coun_id'] = $invoiceAdress->adre_coun_id;

            	$_SESSION['order'] = $order;
            	$_SESSION['order_step'] = "1";
				$this->payment();


        	}
        	else{        		

				$this->load->model ( 'adress_model' );
				
				$user = lh_getUser();

				$adresses = $this->adress_model->getAdressesForUser($user['user_id']);
				$prefferedInvoice = $this->adress_model->getPreferedInvoiceAdress($user['user_id']);
				$prefferedDelivery = $this->adress_model->getPreferedDeliveryAdress($user['user_id']);

				//Prepare Options
				$data['invoiceAdressesOptions'] = "";
				$data['deliveryAdressesOptions'] = "";
				
				
				if (count ( $adresses ) == 0) {
				$data['invoiceAdressesOptions'] = $data['deliveryAdressesOptions'] = "<option value='-1'>Keine Adresse vorhanden - bitte unter Benutzereinstellungen hinzuf&uuml;gen</option>";
				} else {
					foreach ( $adresses as $adress ) {
						$inoiceSelected = "";
						if ($prefferedInvoice == $adress->adre_id){
							$inoiceSelected = " selected ";
						}

						$data['invoiceAdressesOptions'] .= '<option' . $inoiceSelected . ' value=' . $adress->adre_id . '>' . $adress->adre_name . ', ' . $adress->adre_street . ', ' . $adress->adre_city . ', ' . $adress->adre_zip . ' ' . $adress->country->coun_nicename."</option>";

						$deliverySelected = "";
						if ($prefferedDelivery == $adress->adre_id){
							$deliverySelected = " selected ";
						}

						$data['deliveryAdressesOptions'] .= '<option' . $deliverySelected . ' value=' . $adress->adre_id . '>' . $adress->adre_name . ', ' . $adress->adre_street . ', ' . $adress->adre_city . ', ' . $adress->adre_zip . ' ' . $adress->country->coun_nicename."</option>";
					}
				}							
				
				$this->load->template ( 'checkout/steptwo_adress_registered',$data );
        	}
		}
		else {

        	$this->form_validation->set_rules('inv_vorname', 'Rechnungsadresse-Vorname', 'required');
        	$this->form_validation->set_rules('inv_nachname', 'Rechnungsadresse-Nachname', 'required');
        	$this->form_validation->set_rules('inv_street', 'Rechnungsadresse-Straße', 'required');
        	$this->form_validation->set_rules('inv_plz', 'Rechnungsadresse-Postleitzahl', 'required|integer');
        	$this->form_validation->set_rules('inv_city', 'Rechnungsadresse-Straße', 'required');
        	$this->form_validation->set_rules('birthday', 'Geburtsdatum', 'required');
        	$this->form_validation->set_rules('mail', 'Email', 'required|valid_email');

        	if($this->input->post('hiddenDifferentDeliveryAdress') == "true"){
	        	$this->form_validation->set_rules('del_vorname', 'Lieferadresse-Vorname', 'required');
	        	$this->form_validation->set_rules('del_nachname', 'Lieferadresse-Nachname', 'required');
	        	$this->form_validation->set_rules('del_street', 'Lieferadresse-Straße', 'required');
	        	$this->form_validation->set_rules('del_plz', 'Lieferadresse-Postleitzahl', 'required|integer');
	        	$this->form_validation->set_rules('del_city', 'Lieferadresse-Straße', 'required');
        	}

            if ($this->form_validation->run() == FALSE)
            {
				$this->load->template ( 'checkout/steptwo_adress_guest', $data);
            }
            else
            {
            	//$order = array();
            	//$order['orde_type'] = 3; //WOHER??...
            	//$order['orde_no'] = -1;
            	//$order['orde_user_id'] = -1;
            	//$order['orde_pain_id'] = -1;
            	//$order['orde_delivery_charge'] = -1;
            	//$order['orde_commission'] = -1;
            	//$order['orde_sum'] = -1;
            	//$order['orde_prsu_id'] = -1;    
            	
            	$order['orde_in_adre_name'] = $this->input->post('inv_vorname')." ".$this->input->post('inv_nachname');
            	$order['orde_in_adre_street'] = $this->input->post('inv_street');
            	$order['orde_in_adre_zip'] = $this->input->post('inv_plz');
            	$order['orde_in_adre_city'] = $this->input->post('inv_city');
            	$order['orde_in_adre_coun_id'] = $this->input->post('inv_country');

	        	if($this->input->post('hiddenDifferentDeliveryAdress') == "true"){
		        	$order['orde_de_adre_name'] = $this->input->post('del_vorname')." ".$this->input->post('del_nachname');
		        	$order['orde_de_adre_street'] = $this->input->post('del_street');
		        	$order['orde_de_adre_zip'] = $this->input->post('del_plz');
		        	$order['orde_de_adre_city'] = $this->input->post('del_city');
		        	$order['orde_de_adre_coun_id'] = $this->input->post('del_country');
	        	}
	        	else{
	            	$order['orde_de_adre_name'] = $this->input->post('inv_vorname')." ".$this->input->post('inv_nachname');
	            	$order['orde_de_adre_street'] = $this->input->post('inv_street');
	            	$order['orde_de_adre_zip'] = $this->input->post('inv_plz');
	            	$order['orde_de_adre_city'] = $this->input->post('inv_city');
	            	$order['orde_de_adre_coun_id'] = $this->input->post('inv_country');
	        	}

            	$_SESSION['order'] = $order;
            	$_SESSION['order_step'] = "1";
				$this->payment();
            }
		}
	}

	private function payment()
	{
		if(isset($_POST['payment'])){
        	
        	$order = $_SESSION['order'];

			$order['payment'] = $_POST['payment'];

			$_SESSION['order'] = $order;

        	$_SESSION['order_step'] = "2";
			
			$this->check();
		}else{
			$this->load->template ( 'checkout/stepthree_payment' );
		}		
	}
	private function check()
	{

		$this->load->model ( 'shoppingcart_model' );
		$this->load->model ( 'adress_model' );
		$this->load->model ( 'country_model' );

		//enrich order with countrynicename
		$order = $_SESSION['order'];
		$order['orde_in_adre_coun_nicename'] = $this->country_model->getCountryByID($order['orde_in_adre_coun_id'])->coun_nicename;
		$order['orde_de_adre_coun_nicename'] = $this->country_model->getCountryByID($order['orde_de_adre_coun_id'])->coun_nicename;
		$data['order'] = $order;

		
		
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
		$this->load->template ( 'checkout/stepfour_overview',$data);
		
	}

	private function finish()
	{
		$this->load->template ( 'checkout/stepfive_finish' );
		
	}

	////ALLES AB HIER ALT!!!!!
//
	//public function stepone() {
	//	$this->load->model ( 'user_model' );
	//	$this->load->model ( 'adress_model' );
	//	
	//	$user_id = $this->session->userdata ( 'user_id' );
	//	
	//	$user = $this->user_model->get_user_by_id ( $user_id );
	//	$address = $this->user_model->get_address_by_id ( $user_id );
	//	
	//	$data ['user_title'] = $user [0]->user_title;
	//	$data ['user_name'] = $user [0]->user_name;
	//	$data ['user_firstname'] = $user [0]->user_firstname;
	//	
	//	$data ['adre_name'] = $address [0]->adre_name;
	//	$data ['adre_street'] = $address [0]->adre_street;
	//	$data ['adre_zip'] = $address [0]->adre_zip;
	//	$data ['adre_city'] = $address [0]->adre_city;
	//	
	//	$this->load->template ( 'checkout/checkout_customer.php', $data );
	//}
	//public function stepone2() {
	//	$this->load->template ( 'checkout/checkout_guest.php' );
	//}
	//public function stepone3() {
	//	$this->load->template ( 'checkout/checkout_login.php' );
	//}
	//public function stepone4() {
	//	$this->load->model ( 'shoppingcart_model' );
	//	$this->load->model ( 'adress_model' );
	//	
	//	$user_id = $this->session->userdata ( 'user_id' );
	//	$cart = $this->shoppingcart_model->getShoppingCart ( $user_id );
	//	
	//	$shca_id = $cart->shca_id;
	//	
	//	$shoppingcart_positions = $this->shoppingcart_model->getShoppingCartPositions ( $shca_id );
	//	
	//	foreach ( $shoppingcart_positions as $shoppingcart_position ) {
	//		$prod_id = $shoppingcart_position->scpo_prod_id;
	//		$prty_id = $shoppingcart_position->scpo_prty_id;
	//		
	//		$shoppingcart_position->product_variant = Product::getProductVariant ( $prod_id, $prty_id );
	//	}
	//	$cart->shoppingcart_positions = $shoppingcart_positions;
	//	$data ['userid'] = $user_id;
	//	$data ['shcaid'] = $shca_id;
	//	$data ['cart'] = $cart;
	//	$data ['adresses'] = $this->adress_model->getAdressesForUser ( $user_id );
	//	$this->load->template ( 'checkout/checkout_overview', $data );
	//}
	//public function stepone5() {
	//	$this->load->template ( 'checkout/checkout_payment.php' );
	//}
//
	//public function stepone6() {
	//	$this->load->template ( 'checkout/checkout_view.php' );
	//}
//
//
//
//
	//public function overview() {
	//	$this->load->model ( 'shoppingcart_model' );
	//	$this->load->model ( 'adress_model' );
	//	
	//	$user_id = $this->session->userdata ( 'user_id' );
	//	$cart = $this->shoppingcart_model->getShoppingCart ( $user_id );
	//	
	//	$shca_id = $cart->shca_id;
	//	
	//	$shoppingcart_positions = $this->shoppingcart_model->getShoppingCartPositions ( $shca_id );
	//	
	//	foreach ( $shoppingcart_positions as $shoppingcart_position ) {
	//		$prod_id = $shoppingcart_position->scpo_prod_id;
	//		$prty_id = $shoppingcart_position->scpo_prty_id;
	//		
	//		$shoppingcart_position->product_variant = Product::getProductVariant ( $prod_id, $prty_id );
	//	}
	//	$cart->shoppingcart_positions = $shoppingcart_positions;
	//	$data ['userid'] = $user_id;
	//	$data ['shcaid'] = $shca_id;
	//	$data ['cart'] = $cart;
	//	$data ['adresses'] = $this->adress_model->getAdressesForUser ( $user_id );
	//	$this->load->template ( 'checkout/checkout_overview', $data );
	//}
	//public function guest() {
	//	$this->load->template ( 'checkout/checkout_guest.php' );
	//}
	//public function payment_() {
	//	$this->load->template ( 'checkout/checkout_payment.php' );
	//}
	//public function customer() {
	//	$this->load->model ( 'user_model' );
	//	$this->load->model ( 'adress_model' );
	//	
	//	$user_id = $this->session->userdata ( 'user_id' );
	//	
	//	$user = $this->user_model->get_user_by_id ( $user_id );
	//	$address = $this->user_model->get_address_by_id ( $user_id );
	//	
	//	$data ['user_title'] = $user [0]->user_title;
	//	$data ['user_name'] = $user [0]->user_name;
	//	$data ['user_firstname'] = $user [0]->user_firstname;
	//	
	//	$data ['adre_name'] = $address [0]->adre_name;
	//	$data ['adre_street'] = $address [0]->adre_street;
	//	$data ['adre_zip'] = $address [0]->adre_zip;
	//	$data ['adre_city'] = $address [0]->adre_city;
	//	
	//	$this->load->template ( 'checkout/checkout_customer.php', $data );
	//}
}
?>