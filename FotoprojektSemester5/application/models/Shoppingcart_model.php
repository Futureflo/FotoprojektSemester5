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
		if (isset ( $return [0] ))
			return $return [0];
		else
			return NULL;
	}
	public function getShoppingCartById($shca_id) {
		// initialize return variable
		$return = array ();
		
		// get Shoppingcart by a specific ID
		$this->db->where ( 'shca_id', $shca_id );
		$query = $this->db->get ( 'shopping_cart' );
		$return = $query->result ();
		return $return [0];
	}
	public function getShoppingCartPositions($shca_id) {
		// initialize return variable
		$return = array ();
		
		// get the items of a specific shoppingCart
		$this->db->where ( 'scpo_shca_id', $shca_id );
		$this->db->order_by ( 'scpo_prod_id, scpo_prty_id' );
		$query = $this->db->get ( 'shopping_cart_position' );
		$return = $query->result ();
		return $return;
	}
	// Get a specific shopping cart position
	public function getShoppingCartPosition($scpo_shca_id, $scpo_prod_id, $scpo_prty_id) {
		
		// get the items of a specific shoppingCart
		$this->db->where ( 'scpo_shca_id', $scpo_shca_id );
		$this->db->where ( 'scpo_prod_id', $scpo_prod_id );
		$this->db->where ( 'scpo_prty_id', $scpo_prty_id );
		$query = $this->db->get ( 'shopping_cart_position' );
		$return = $query->result ();
		$rowcount = $query->num_rows();
		if($rowcount == 0)
			return null;
		return $return [0];
	}
	
	// Shopping Cart
	// insert shopping_cart
	function insert_shopping_cart($data) {
		$this->db->insert ( 'shopping_cart', $data );
		return $this->db->insert_id ();
	}
	
	// update shopping_cart
	function update_shopping_cart($shopping_cart) {
		$this->db->where ( 'shca_id', $shopping_cart->shca_id );
		$this->db->update ( 'shopping_cart', $shopping_cart );
	}
	
	// delete shopping_cart
	function delete_shopping_cart($shca_id) {
		return $this->db->delete ( 'shopping_cart', array (
				'shca_id' => $shca_id 
		) );
	}
	
	// Shopping Cart Position
	// insert shopping_cart_position
	function insert_shopping_cart_position($data) {
		$this->db->insert ( 'shopping_cart_position', $data );
		return $this->db->insert_id ();
	}
	
	// update shopping_cart_position
	function update_shopping_cart_position($shopping_cart_position) {
		$this->db->where ( 'scpo_shca_id', $shopping_cart_position->scpo_shca_id );
		$this->db->where ( 'scpo_prod_id', $shopping_cart_position->scpo_prod_id );
		$this->db->where ( 'scpo_prty_id', $shopping_cart_position->scpo_prty_id );
		$this->db->update ( 'shopping_cart_position', $shopping_cart_position );
	}
	
	// delete shopping_cart_position
	function delete_shopping_cart_position($scpo_shca_id, $scpo_prod_id, $scpo_prty_id) {
		return $this->db->delete ( 'shopping_cart_position', array (
				'scpo_shca_id' => $scpo_shca_id,
				'scpo_prod_id' => $scpo_prod_id,
				'scpo_prty_id' => $scpo_prty_id 
		) );
	}
}
?>
