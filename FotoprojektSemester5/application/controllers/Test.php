<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Test extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('adress_model');
	}
	

	public function index()
	{	
		for ($i=0; $i < 5; $i++) { 
		echo "<br>";
		echo $this->country_model->getAllCountries()[0]->coun_id;
		sleep(1);
		}

	}

	public function countrie($id)
	{	
		$ret = $this->adress_model->getAdressesForUser($id);

		foreach ($ret as $row)
		{
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



}
