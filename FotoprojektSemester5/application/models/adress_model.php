	<?php
	class adress_model extends CI_Model {
		
		// TODO:
		// Prefered Adress? Muss beim Update (neu setzten wenn Prefered Adress bearbeitet wird), Add (option neue adresse als bevorzugte direkt einzutragen), Delete(Falls Adresse als prefered eingetragen -> austragen)
		Public function __construct() {
			parent::__construct ();
		}
		Public function getAllAdresses() {
			
			// initialize return variable
			$return = array ();
			
			// Get Adresses from DB
			$query = $this->db->get ( 'adress' );
			
			if ($query->num_rows () > 0) {
				
				$return = $query->result ();
				
				// bind countries
				$return = bindCountries ( $return );
			}
			
			return $return;
		}
		Public function getAdressesForUser($userid) {
			
			// initialize return variable
			$return = array ();
			
			// Get Adresses from DB for User
			$this->db->where ( 'adre_user_id', $userid );
			$query = $this->db->get ( 'adress' );
			
			if ($query->num_rows () > 0) {
				
				$return = $query->result ();
				
				// bind countrie
				$return = $this->bindCountries($return);
			}
			
			return $return;
		}
		Public function deactivateAdress($adressObj) {
			// $this->db->update('adress', $adressObj, "adre_activated = 'false'");
			echo "NOT IMPLEMENTED YET!";
		}
		Public function updateAdress($adressObj) {
			deactivateAdress ( $adressObj );
			addAdressObj ( $adressObj );
		}
		public function addAdressObj($adressObj) {
			$this->db->insert ( 'adress', $adressObj );
		}
		public function addAdressSingle($adre_id, $adre_name, $adre_street, $adre_zip, $adre_city, $adre_user_id, $adre_coun_id) {
			$adress = array ();
			$adress->adre_id = $adre_id;
			$adress->adre_name = $adre_name;
			$adress->adre_street = $adre_street;
			$adress->adre_zip = $adre_zip;
			$adress->adre_city = $adre_city;
			$adress->adre_user_id = $adre_user_id;
			$adress->adre_coun_id = $adre_coun_id;
			addAdressObj ( $adress );
		}
		
		// Local Helper Classes
		private function bindCountries($adresses) {
			$this->load->model ( 'country_model' );
			$allCountries = $this->country_model->getAllCountries ();
			
			foreach ( $adresses as $singleAdress ) {
				
				$singleAdress->countrie = array ();
				
				foreach ( $allCountries as $countrie ) {
					if ($countrie->coun_id == $singleAdress->adre_coun_id) {
						$singleAdress->countrie = $countrie;
						break;
					}
				}
			}
			
			return $adresses;
		}
	}
	?>