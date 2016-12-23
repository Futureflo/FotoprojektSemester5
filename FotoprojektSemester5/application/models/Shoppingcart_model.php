<?php
class Shoppingcart_model extends CI_Model {
	Public function __construct() {
		parent::__construct ();
	}
	public function getShoppingCart($user_id) {
		// initialize return variable
		$return = array ();
		
		// get Shoppingcart of a specific user
		$this->db->where ( 'shca_user_id', $user_id );
		$query = $this->db->get ( 'shopping_cart' );
		$return = $query->result ();
		return $return;
	}
	public function getShoppingCartPositions($shca_id) {
		// initialize return variable
		$return = array ();
		
		// get the items of a specific shoppingCart
		$this->db->where ( 'scpo_shca_id', $shca_id );
		$query = $this->db->get ( 'shopping_cart_position' );
		$return = $query->result ();
		return $return;
	}
}
?>
