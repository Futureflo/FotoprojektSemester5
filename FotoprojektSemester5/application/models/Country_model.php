<?php
class Country_model extends CI_Model {

	private static $allCountries;


	Public function __construct() {
		parent::__construct ();
	
	}

	Public function getAllCountries() {

		if(isset($GLOBALS["allCountries"]) == false){
      	$query = $this->db->get('country');
			$GLOBALS["allCountries"] = $query->result();
		}

		return $GLOBALS["allCountries"];
		
	}

}
?>