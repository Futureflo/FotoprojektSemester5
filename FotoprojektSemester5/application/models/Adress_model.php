	<?php
	class Adress_model extends CI_Model {
		private static $allAdresses;
		Public function __construct() {
			parent::__construct ();
		}
		/**
		 * Return all adresses
		 *
		 * @param
		 *        	boolean OnlyActive: True -> returns only active adresses, False -> also inactive adresses
		 * @return array of all Adresses (with/without active)
		 */
		Public function getAllAdresses($onlyActive = TRUE) {
			
			// initialize return variable
			$return = array ();
			
			// Get Adresses from DB
			if ($onlyActive) {
				$this->db->where ( 'adre_status', 1 );
			}
			$query = $this->db->get ( 'adress' );
			
			if ($query->num_rows () > 0) {
				
				$return = $query->result ();
				
				// bind countries to adresses as "country"
				$return = $this->bindCountries ( $return );
			}
			
			return $return;
		}
		Public function getSingleAdress($adre_id) {
			if (! isset ( $GLOBALS ["allAdresses"] )) {
				$GLOBALS ["allAdresses"] = $this->getAllAdresses ( true );
			}
			
			foreach ( $GLOBALS ["allAdresses"] as $adress ) {
				if ($adress->adre_id == $adre_id) {
					return $adress;
				}
			}
			
			return NULL;
		}
		/**
		 * Return all adresses for specific user
		 *
		 * @param
		 *        	int UserID
		 * @param
		 *        	boolean OnlyActive: True -> returns only active adresses, False -> also inactive adresses
		 * @return array of all Adresses (with/without active)
		 */
		Public function getAdressesForUser($userid, $onlyActive = TRUE) {
			
			// initialize return variable
			$return = array ();
			
			// Get Adresses from DB for User
			$this->db->where ( 'adre_user_id', $userid );
			if ($onlyActive) {
				$this->db->where ( 'adre_status', 1 );
			}
			$query = $this->db->get ( 'adress' );
			
			if ($query->num_rows () > 0) {
				
				$return = $query->result ();
				
				// bind countries to adresses as "country"
				$return = $this->bindCountries ( $return );
			}
			
			return $return;
		}
		/**
		 * Deactivate a Adress, look if Adress is set as prefered in user table and unset (set to 0);
		 *
		 * @param
		 *        	int addrID - ID of adress to deactivate
		 * @return boolean - if update worked
		 */
		Public function deactivateAdressByID($addrID) {
			$this->db->set ( 'adre_status', 0 );
			$this->db->where ( 'adre_id', $addrID );
			$updateWorked = $this->db->update ( 'adress' );
			
			if ($updateWorked) {
				$this->load->model ( 'User_model' );
				
				// updated adress - look if adress was as prefered adress in usr and unset
				// as deliver
				$deliveryAdressQuery = $this->db->get_where ( 'user', array (
						'user_dead_default' => $id 
				) );
				if ($deliveryAdressQuery->num_rows () == 1) {
					// usr has adress as preffered delivery adress
					$deliveryAdressResult = $deliveryAdressQuery->result ();
					$userArray = array (
							'user_id' => $deliveryAdressResult [0]->user_id,
							'user_dead_default' => 0 
					);
					$this->User_model->update_user ( $userArray );
				}
				
				// as invoice
				$invoiceAdressQuery = $this->db->get_where ( 'user', array (
						'user_inad_default' => $id 
				) );
				if ($invoiceAdressQuery->num_rows () == 1) {
					// usr has adress as preffered invoice adress
					$invoiceAdressResult = $invoiceAdressQuery->result ();
					$userArray = array (
							'user_id' => $invoiceAdressResult [0]->user_id,
							'user_inad_default' => 0 
					);
					$this->User_model->update_user ( $userArray );
				}
			} else { // didn't work...
				return $updateWorked;
			}
		}
		Public function activateAdressByID($id) {
			$this->db->set ( 'adre_status', 1 );
			$this->db->where ( 'adre_id', $id );
			return $this->db->update ( 'adress' );
		}
		public function addAdressObj($adressArr, $setAsPreferedInvoice = FALSE, $setAsPreferedDelivery = FALSE) {
			// TODO:übeprüfe ob user bevorzugte adresse hat, wenn nicht -> eintragen
			if ($this->db->insert ( 'adress', $adressArr )) {
				$newID = $this->db->insert_id ();
				$this->load->model ( 'User_model' );
				
				// if no prefered adress is existing for usr, set new as prefered
				if ($this->getPreferedInvoiceAdress ( $adressArr ["adre_user_id"] ) == 0)
					$setAsPreferedInvoice = TRUE;
				if ($this->getPreferedDeliveryAdress ( $adressArr ["adre_user_id"] ) == 0)
					$setAsPreferedDelivery = TRUE;
				
				if ($setAsPreferedInvoice) {
					$userArray = array (
							'user_id' => $adressArr ["adre_user_id"],
							'user_inad_default' => $newID 
					);
					$this->User_model->update_user ( $userArray );
				}
				
				if ($setAsPreferedDelivery) {
					$userArray = array (
							'user_id' => $adressArr ["adre_user_id"],
							'user_dead_default' => $newID 
					);
					$this->User_model->update_user ( $userArray );
				}
				
				return true;
			} else {
				return false;
			}
		}
		public function addAdressSingle($adre_name, $adre_street, $adre_zip, $adre_city, $adre_user_id, $adre_coun_id, $adre_status = 1, $setAsPreferedInvoice = FALSE, $setAsPreferedDelivery = FALSE) {
			$adress = array ();
			$adress ["adre_name"] = $adre_name;
			$adress ["adre_street"] = $adre_street;
			$adress ["adre_zip"] = $adre_zip;
			$adress ["adre_city"] = $adre_city;
			$adress ["adre_user_id"] = $adre_user_id;
			$adress ["adre_coun_id"] = $adre_coun_id;
			$adress ["adre_status"] = $adre_status;
			$this->addAdressObj ( $adress, $setAsPreferedInvoice, $setAsPreferedDelivery );
		}
		// Public function updateAdress($adressObj) {
		// // TODO:überprüfe ob alte als bevorzugt eingetragen, wenn ja -> überschreiben
		// deactivateAdress ( $adressObj->adre_id );
		// addAdressObj ( $adressObj );
		// }
		
		// TODO: NACH USER UMZIEHEN SOBALD DER FERTIG IST
		Public function getPreferedDeliveryAdress($userid) {
			$query = $this->db->get_where ( 'user', array (
					'user_id' => $userid 
			) );
			$result = $query->result ();
			if ($query->num_rows () == 1) {
				if ($result [0]->user_dead_default == null)
					return 0;
				else
					return $result [0]->user_dead_default;
			} else {
				return - 1; // user not found
			}
		}
		Public function getPreferedInvoiceAdress($userid) {
			$query = $this->db->get_where ( 'user', array (
					'user_id' => $userid 
			) );
			$result = $query->result ();
			if ($query->num_rows () == 1) {
				if ($result [0]->user_inad_default == null)
					return 0;
				else
					return $result [0]->user_inad_default;
			} else {
				return - 1; // user not found
			}
		}
		
		// Local Helper Classes
		private function bindCountries($adresses) {
			$this->load->model ( 'country_model' );
			$allCountries = $this->country_model->getAllCountries ();
			
			foreach ( $adresses as $singleAdress ) {
				
				$singleAdress->country = array ();
				
				foreach ( $allCountries as $country ) {
					if ($country->coun_id == $singleAdress->adre_coun_id) {
						$singleAdress->country = $country;
						break;
					}
				}
			}
			
			return $adresses;
		}
	}
	?>