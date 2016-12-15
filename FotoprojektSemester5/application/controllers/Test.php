<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );
class Test extends CI_Controller {
	public function __construct() {
		parent::__construct ();
		$this->load->model ( 'Adress_model' );
		$this->load->model ( 'Country_model' );
		$this->load->model ( 'User_model' );
	}
	public function index() {
		for($i = 0; $i < 5; $i ++) {
			echo "<br>";
			echo $this->Country_model->getAllCountries () [0]->coun_id;
			//sleep ( 1 );
		}
	}
	public function countrie($id) {
		$ret = $this->adress_model->getAdressesForUser ( $id );
		
		foreach ( $ret as $row ) {
			echo $row->adre_id;
			echo "&nbsp";
			echo $row->adre_name;
			echo "&nbsp";
			echo $row->adre_street;
			echo "&nbsp";
			echo $row->adre_zip;
			echo "&nbsp";
			echo $row->adre_city;
			echo "&nbsp";
			echo $row->adre_user_id;
			echo "&nbsp";
			echo $row->adre_coun_id;
			echo "&nbsp";
			echo $row->countrie->coun_nicename;
			echo "&nbsp";
			echo $row->countrie->coun_iso;
			echo "<br>";
		}
	}
	public function addr() {
		// $this->Adress_model->deactivateAdressByID(1);
		$this->Adress_model->addAdressSingle ( "name", "adre_street", "adre_zip", "adre_city", 2, 1, 1, false, true );
		// echo "<p>" . $this->Adress_model->deactivateAdressByID ( 1 )."</p>";
		// echo "<p>" . $this->Adress_model->getPreferedInvoiceAdress ( 1 )."</p>";
		// $ret = $this->Adress_model->getAdressesForUser ( 1 );
		// foreach ( $ret as $row ) {
		// echo $row->adre_id;
		// echo "&nbsp";
		// echo $row->adre_name;
		// echo "&nbsp";
		// echo $row->adre_street;
		// echo "&nbsp";
		// echo $row->adre_zip;
		// echo "&nbsp";
		// echo $row->adre_city;
		// echo "&nbsp";
		// echo $row->adre_user_id;
		// echo "&nbsp";
		// echo $row->adre_status;
		// echo "&nbsp";
		// echo $row->adre_coun_id;
		// echo "&nbsp";
		// echo $row->countrie->coun_nicename;
		// echo "&nbsp";
		// echo $row->countrie->coun_iso;
		// echo "<br>";
		// }
	}
	public function login() {
		if (lh_isUserLoggedin ()) {
			echo "isLoggedIn!";
		} else {
			echo "isNotLoggedin!";
		}
	}
	public function usr() {
		echo $this->User_model->mail_exists ( "test@gmx.de" );
	}
	public function phpinfo() {
		echo phpinfo ();
	}
}
