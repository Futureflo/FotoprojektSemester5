<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );
include_once (dirname(__FILE__) . "/ProductType.php");
class PriceProfile extends CI_Controller {

	public function index() {
		$this->price_profiles();
	}
	
	public function showSinglePriceProfile($prpr_id)
	{
		$data['price_profile'] = PriceProfile::getPriceProfile($prpr_id);
		$this->load->template ( 'price/single_price_profile_view.php', $data);
	}

	public function price_profiles()
	{
		$data['price_profiles'] = PriceProfile::getAllPriceProfiles();
		$this->load->template ( 'admin/price_profile_view', $data );
	}
	
	// Alle Preisprofile des Systems und des Benutzers/Fotograf laden
	public static function getAllPriceProfiles()
	{
		$CI =& get_instance();
		$CI->load->model('PriceProfile_model');
		$user_id = $CI->session->userdata('user_id');
		$price_profiles_sys = $CI->PriceProfile_model->getPriceProfilesByUser(0);
		// Wenn der Benutzer gesetzt ist dann können die Profile geladen werden
		if($user_id != 0)
		{
			$price_profiles_user = $CI->PriceProfile_model->getPriceProfilesByUser($user_id);
			$price_profiles = array_merge($price_profiles_sys, $price_profiles_user);
		}
		else $price_profiles = $price_profiles_sys; 
		
		foreach ($price_profiles as $price_profile){
			$price_profile = PriceProfile::getPriceProfile($price_profile->prpr_id);
		}
		
		return $price_profiles;
	}
	
	//Liefert Preisprofil mit Preisen
	public static function getPriceProfile($prpr_id)
	{
		$CI =& get_instance();
		$price_profile[0]->prices = $prices;
		return $price_profile[0];
	}
	
	//Liefert Preisen aus Format und Preisprofil
	public static function getPriceByProductType($prpr_id, $prty_id)
	{
		$CI =& get_instance();
		return $price[0];
	}
	
}