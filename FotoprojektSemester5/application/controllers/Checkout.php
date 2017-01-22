<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );
include_once (dirname ( __FILE__ ) . "/Product.php");
include_once (dirname ( __FILE__ ) . "/Order.php");
include_once (dirname ( __FILE__ ) . "/Shoppingcart.php");


require APPPATH.'libraries/vendor/autoload.php';
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Transaction;
use PayPal\Api\ShippingAddress;

use PayPal\Api\ExecutePayment;
use PayPal\Api\PaymentExecution;

class Checkout extends CI_Controller {
	public function __construct() {
		parent::__construct ();

		$this->load->helper('form');
        $this->load->library('form_validation');
	}

	public function index()
	{
		if ($this->input->post('action') == "back") {
            $_SESSION['order_step'] = "0";
        	$_SESSION['order'] = array();
            redirect('/checkout', 'refresh');
            return;
		}

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
				$this->paypal();
				break;	
			case '4':
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
					//user selected same delivery adress as invoice adress...
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
           	 	redirect('/checkout', 'refresh');


        	}
        	else{        		

				$this->load->model ( 'adress_model' );
				
				$user = lh_getUser();

				$adresses = $this->adress_model->getAdressesForUser($user['user_id']);
				$prefferedInvoice = $this->adress_model->getPreferedInvoiceAdress($user['user_id']);
				$prefferedDelivery = $this->adress_model->getPreferedDeliveryAdress($user['user_id']);

				//Prepare Delivery/Invoice Adresses
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
           	 	redirect('/checkout', 'refresh');
            }
		}
	}

	private function payment()
	{
		if(isset($_POST['payment'])){
			//Load Order From Session
        	$order = $_SESSION['order'];

			$order['orde_payment'] = $_POST['payment'];

			if($order['orde_payment'] == "Vorkasse")
    			$order['orde_payed'] = 0;//wird nicht benötigt


			//Save Order To Session | Set next Step
			$_SESSION['order'] = $order;
        	$_SESSION['order_step'] = "2";
			
       	 	redirect('/checkout', 'refresh');
		}else{
			$this->load->template ( 'checkout/stepthree_payment' );
		}		
	}
	private function check()
	{		
		//Load Order From Session
    	$order = $_SESSION['order'];

		if(isset($_POST['confirmed'])){
			if($order['orde_payment'] == "Vorkasse"){
	    		$_SESSION['order_step'] = "4";	
           	 	redirect('/checkout', 'refresh');
			}
			
	    	else{
	    		$_SESSION['order_step'] = "3";
	    		//Weiterleitung nach Paypal	
           	 	redirect('/checkout', 'refresh');
	    	}
		}
		else{	
			$this->load->model ( 'shoppingcart_model' );
			$this->load->model ( 'Product_type_model' );
			$this->load->model ( 'country_model' );
			
			$user_id = $this->session->userdata ( 'user_id' );
			$data ['userid'] = $user_id;


			$cart = $this->shoppingcart_model->getShoppingCart ( $user_id );		
			$shca_id = $cart->shca_id;
			$shoppingcart_positions = $this->shoppingcart_model->getShoppingCartPositions ( $shca_id );
				
			$CartHasDigitalPosition = false;
			$CartHasAnalogPosition = false;

			$productTypes = $this->Product_type_model->getAllProductType();

			foreach ( $shoppingcart_positions as $shoppingcart_position ) {
				$prod_id = $shoppingcart_position->scpo_prod_id;
				$prty_id = $shoppingcart_position->scpo_prty_id;
				
				//set ProductType Type for Shoppingcartposition
				foreach ($productTypes as $productType) {
					if($prty_id == $productType->prty_id)
					{
						$shoppingcart_position->scpo_prty_type = $productType->prty_type;
					}
				}

				if($shoppingcart_position->scpo_prty_type == ProductPrintType::download)
					$CartHasDigitalPosition = true;
				if($shoppingcart_position->scpo_prty_type == ProductPrintType::prints)
					$CartHasAnalogPosition = true;

				$shoppingcart_position->product_variant = Product::getProductVariant ( $prod_id, $prty_id );
			}
			//Complete Order & enrich order with countrynicename
			$order['orde_in_adre_coun_nicename'] = $this->country_model->getCountryByID($order['orde_in_adre_coun_id'])->coun_nicename;
			$order['orde_de_adre_coun_nicename'] = $this->country_model->getCountryByID($order['orde_de_adre_coun_id'])->coun_nicename;
			
			//Set OrderType 
			//"Art der Bestellung (digital, druck, gemischt)
			//1 = druck 
			//2 = digital
			//3 = gemischt"
			if($CartHasDigitalPosition && $CartHasAnalogPosition)
				$order['orde_type'] = 3;	
			if($CartHasDigitalPosition && !$CartHasAnalogPosition)
				$order['orde_type'] = 2;
			if(!$CartHasDigitalPosition && $CartHasAnalogPosition)
				$order['orde_type'] = 1;

			$cart->shoppingcart_positions = $shoppingcart_positions;
			$data ['shcaid'] = $shca_id;

			$data ['cart'] = $cart;
			
        	//calculate order
        	$order['orde_delivery_charge'] = -1;//wird nicht benötigt ?? Versandkosten für die jeweilige Bestellung
    		$order['orde_commission'] = -1;//wird nicht benötigt ?? "Provisionzuschlag für diese Bestellung (berechnet sich aus der gesamt Bestellungssumme, prozentualer Anteil"
    		
			$sum_values = Order::calcOrder ( $shca_id );
			//log_message("debug", "order_sum:" . $orde_value [0]);
	        $order["orde_sum"] = $sum_values [0];
	        $order["orde_commission"] = $sum_values [1];

			$order['orde_date'] = date ( "Y-m-d H:i:s" );

			$data['order'] = $order;
			//echo '<script type="text/javascript">alert('.$order['orde_type'].');</script>';

			$this->load->template ( 'checkout/stepfour_overview',$data);	

		    unset($order['orde_in_adre_coun_nicename']);
		    unset($order['orde_de_adre_coun_nicename']);
			$_SESSION['order'] = $order;
		}	
	}
	public function paypal()
	{

		$this->load->model ( 'country_model' );

		//Load Order From Session
    	$order = $_SESSION['order'];


		$apiContext = new \PayPal\Rest\ApiContext(
		    new \PayPal\Auth\OAuthTokenCredential(
		        'ARL1SCLBSvi9ZzuZmfoaUSx4DSohIrV4Eb-pae0NhgN-DBGMKxigllaqZcv-0fpPEl_VHqLHgiRb_-vJ',     // ClientID
		        'EGRxMQghElNNlifxzX5TGld0BHcCaMS6-kuq62Lqd1axEuQ-kWLtJ_pn0zWC0vCh4ZS8yDtjGjOas4hu'      // ClientSecret
		    )
		);

		// # Create Payment using PayPal as payment method
		// This sample code demonstrates how you can process a 
		// PayPal Account based Payment.
		// API used: /v1/payments/payment


		// ### Payer
		// A resource representing a Payer that funds a payment
		// For paypal account payments, set payment method
		// to 'paypal'.
		$payer = new Payer();
		$payer->setPaymentMethod("paypal");


		// #Shipping Adress
		$shipping_address = new ShippingAddress();

		$shipping_address->setCity($order['orde_de_adre_city']);
		$shipping_address->setCountryCode($this->country_model->getCountryByID($order['orde_in_adre_coun_id'])->coun_iso);
		$shipping_address->setPostalCode($order['orde_de_adre_zip'] );
		$shipping_address->setLine1($order['orde_de_adre_street']);
		//$shipping_address->setState('State');
		$shipping_address->setRecipientName($order['orde_de_adre_name']);


		$item = new Item(); 
		$item->setName('Snap-Up Bilder') 
		->setCurrency('EUR') 
		//->setSku("1")
		->setPrice($order["orde_sum"])
		->setQuantity(1);

		$itemList = new ItemList(); 
		$itemList->setItems(array($item));
		$itemList->setShippingAddress($shipping_address);

	

		// ### Amount
		// Lets you specify a payment amount.
		// You can also specify additional details
		// such as shipping, tax.
		$amount = new Amount();
		$amount->setCurrency("EUR")
		    ->setTotal($order["orde_sum"]);

		// ### Transaction
		// A transaction defines the contract of a
		// payment - what is the payment for and who
		// is fulfilling it. 
		$transaction = new Transaction();
		$transaction->setAmount($amount)
			->setItemList($itemList)
		    ->setDescription("Snap-Up Einkauf " . $order["orde_date"]);

		// ### Redirect urls
		// Set the urls that the buyer must be redirected to after 
		// payment approval/ cancellation.
		$baseUrl = base_url();
		$redirectUrls = new RedirectUrls();
		$redirectUrls->setReturnUrl($baseUrl."checkout/paypalconfirm/")
		    ->setCancelUrl($baseUrl."checkout/paypalabort/");

		// ### Payment
		// A Payment Resource; create one using
		// the above types and intent set to 'sale'
		$payment = new Payment();
		$payment->setIntent("sale")
		    ->setPayer($payer)
		    ->setRedirectUrls($redirectUrls)
		    ->setTransactions(array($transaction));


		// For Sample Purposes Only.
		$request = clone $payment;

		// ### Create Payment
		// Create a payment by calling the 'create' method
		// passing it a valid apiContext.
		// (See bootstrap.php for more on `ApiContext`)
		// The return object contains the state and the
		// url to which the buyer must be redirected to
		// for payment approval
		try {
		    $payment->create($apiContext);

            redirect( $payment->getApprovalLink() , 'refresh');
		} catch (PayPal\Exception\PayPalConnectionException $ex) {
			log_message('error', 'Executed Payment');
			log_message('error', 'Request:.' .$request);
			log_message('error', 'Response: '. $ex);
			log_message('error', 'Code: '.  $ex->getCode());
			log_message('error', 'Data: '.  $ex->getData());
            redirect( base_url() , 'refresh'); //TODO Fehler.
		}	catch (Exception $ex) {
		    // NOTE: PLEASE DO NOT USE RESULTPRINTER CLASS IN YOUR ORIGINAL CODE. FOR SAMPLE ONLY
		    
			log_message('error', 'Created Payment Using PayPal.');
			log_message('error', 'request:.' .$request);
			log_message('error', 'Exception:.' .$ex);
			//TODO FEHLER
			//ResultPrinter::printError("Created Payment Using PayPal. Please visit the URL to Approve.", "Payment", null, $request, $ex);
            redirect( base_url() , 'refresh');
		}

		// ### Get redirect url
		// The API response provides the url that you must redirect
		// the buyer to. Retrieve the url from the $payment->getApprovalLink()
		// method
		//$data["approvalUrl"] = $payment->getApprovalLink();
		//$data["request"] = $request;
		//$data["err"] = $ex;
		//$this->load->template ( 'checkout/paypal',$data);

		

		//hier kommt paypal an
		//orde_payed setzen
		//orde_payment_information -> mail speichern
		$order = $_SESSION['order'];
		$order['orde_payed'] = 1;
    	$_SESSION['order_step'] = "4";	
		$_SESSION['order'] = $order;
	}


	public function paypalconfirm(){
		log_message('debug', 'paypalconfirm called');

	    $apiContext = new \PayPal\Rest\ApiContext(
		    new \PayPal\Auth\OAuthTokenCredential(
		        'ARL1SCLBSvi9ZzuZmfoaUSx4DSohIrV4Eb-pae0NhgN-DBGMKxigllaqZcv-0fpPEl_VHqLHgiRb_-vJ',     // ClientID
		        'EGRxMQghElNNlifxzX5TGld0BHcCaMS6-kuq62Lqd1axEuQ-kWLtJ_pn0zWC0vCh4ZS8yDtjGjOas4hu'      // ClientSecret
		    )
		);
	    // Get the payment Object by passing paymentId
	    // payment id was previously stored in session in
	    // CreatePaymentUsingPayPal.php
	    $paymentId = $_GET['paymentId'];
		log_message('debug', 'PaymentID: '.$paymentId );
	    $payment = Payment::get($paymentId, $apiContext);
		log_message('debug', 'PaymentID from PaymentObj: '. $payment->getId());


	    // ### Payment Execute
	    // PaymentExecution object includes information necessary
	    // to execute a PayPal account payment.
	    // The payer_id is added to the request query parameters
	    // when the user is redirected from paypal back to your site
	    $execution = new PaymentExecution();
		log_message('debug', 'PayerID: '.$_GET['PayerID'] );
	    $execution->setPayerId($_GET['PayerID']);


	    try {
	        // Execute the payment
	        // (See bootstrap.php for more on `ApiContext`)
	        $result = $payment->execute($execution, $apiContext);

	        // NOTE: PLEASE DO NOT USE RESULTPRINTER CLASS IN YOUR ORIGINAL CODE. FOR SAMPLE ONLY
	        //ResultPrinter::printResult("Executed Payment", "Payment", $payment->getId(), $execution, $result);
			log_message('debug', 'Executed Payment');
			log_message('debug', 'PaymentID: '. $payment->getId());
			log_message('debug', 'Request:.' .$execution);
			log_message('debug', 'Result:.' .$result);
	        echo 'printResult("Executed Payment'.$payment->getId()."|". $execution."|". $resul;
	        try {
	            $payment = Payment::get($paymentId, $apiContext);
	        } 
	        catch (Exception $ex) {
	            // NOTE: PLEASE DO NOT USE RESULTPRINTER CLASS IN YOUR ORIGINAL CODE. FOR SAMPLE ONLY
	            //ResultPrinter::printError("Get Payment", "Payment", null, null, $ex);
				log_message('error', 'Get Payment');
				log_message('error', 'Response: '. $ex);
	            echo 'printError("Get Payment'.$ex;
	            exit(1);
	        }
	    } catch (PayPal\Exception\PayPalConnectionException $ex) {
			log_message('error', 'Executed Payment');
			log_message('error', 'Response: '. $ex);
			log_message('error', 'Code: '.  $ex->getCode());
			log_message('error', 'Data: '.  $ex->getData());
		    die($ex);
		}
		catch (Exception $ex) {
	        // NOTE: PLEASE DO NOT USE RESULTPRINTER CLASS IN YOUR ORIGINAL CODE. FOR SAMPLE ONLY
	        //ResultPrinter::printError("Executed Payment", "Payment", null, null, $ex);
			log_message('error', 'Executed Payment');
			log_message('error', 'Response: '. $ex);
	        echo 'printError("Executed Payment'.$ex;
	        exit(1);
	    }

	    // NOTE: PLEASE DO NOT USE RESULTPRINTER CLASS IN YOUR ORIGINAL CODE. FOR SAMPLE ONLY
	    //ResultPrinter::printResult("Get Payment", "Payment", $payment->getId(), null, $payment);
	    echo 'printResult("Get Payment';
		log_message('debug', 'Get Payment');
		log_message('debug', 'PaymentID: '. $payment->getId());
		log_message('debug', 'Result:.' .$payment);
		$this->finish();
	}

	public function paypalabort(){
		echo "paypalabort";
	}

			

	private function finish($payed = 0)
	{
		$order = $_SESSION['order'];
		$this->load->model ( 'shoppingcart_model' );
		$this->load->model ( 'order_model' );

		$user_id = $this->session->userdata ( 'user_id' );
		$cart = $this->shoppingcart_model->getShoppingCart ( $user_id );		
		$shca_id = $cart->shca_id;

		//Submit Order to DB
    	$order['orde_user_id'] = $user_id;
    	//$order['orde_pain_id'] = -1; //wird nicht benötigt ??"Bezahlungsinformations ID zeit auf die Bezahlungsinformationen in der Tabelle payment_information"
    	//$order['orde_delivery_charge'] = -1;//wird nicht benötigt ?? Versandkosten für die jeweilige Bestellung
    	//$order['orde_commission'] = -1;//wird nicht benötigt ?? "Provisionzuschlag für diese Bestellung (berechnet sich aus der gesamt Bestellungssumme, prozentualer Anteil"

		//$order["orde_sum"] = Order::calcOrder ( $shca_id );

		// Bestellung anlegen
		$orde_id = $this->order_model->insert_order ( $order );
		if ($orde_id) {
			// Positionen anlegen
			$this->insert_positions ( $orde_id, $shca_id );
		}
		
		$order ['orde_id'] = $orde_id;
		$order ['orde_no'] = Order::buildOrderNumber ( $order );
		$order['orde_payed'] = $payed;
		$this->order_model->update_order ( $orde_id, $order );
		
		//send Mail to User & to all Shippers
		
		//Delete Order & Shoppingcart + Redirect to start
		$this->shoppingcart_model->delete_shopping_cart ( $shca_id );
		$_SESSION['order_step'] = "";
		$_SESSION['order'] = array();
		$this->load->template ( 'checkout/stepfive_finish' );

		$this->load->helper('html');
		echo meta('refresh', '3;'.base_url().'user/myOrders', 'equiv');
		
	}

	public function insert_positions($orde_id, $shca_id) {
		$this->load->model ( 'order_model' );
		$shopping_cart = ShoppingCart::getSingleShoppingCartById ( $shca_id );
		// Für jede Positon im Warenkorb eine Bestellpostion anlegen
		foreach ( $shopping_cart->shoppingcart_positions as $shoppingcart_position ) {
			$product_variant = $shoppingcart_position->product_variant;
			$order_position = array (
					'orpo_orde_id' => $orde_id,
					'orpo_prod_id' => $shoppingcart_position->scpo_prod_id,
					'orpo_amount' => $shoppingcart_position->scpo_amount,
					'orpo_price' => $product_variant->price ['price_sum'],
					//'orpo_prsu_id' => $shoppingcart_position->spco_prsu_id,
					'orpo_prsu_id' => 1, //DUMMY!!!! TODO: aus Shoppingcart anlegen
					'orpo_prty_id' => $shoppingcart_position->scpo_prty_id 
			);
			
			$this->order_model->insert_order_position ( $order_position );
		}
	}

	public function reset()
	{
		$_SESSION['order_step'] = "";
		$_SESSION['order'] = array();
		redirect("checkout");
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