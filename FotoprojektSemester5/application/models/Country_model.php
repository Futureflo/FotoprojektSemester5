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

	public function getCountryByID($coun_id){
		if (! isset ( $GLOBALS ["allCountries"] )) {
			$GLOBALS ["allCountries"] = $this->getAllCountries ();
		}
		
		foreach ( $GLOBALS ["allCountries"] as $country ) {
			if ($country->coun_id == $coun_id) {
				return $country;
			}
		}		
        log_message('error', 'No Country found for ID '.$coun_id);
		return NULL;
	}

}
?>