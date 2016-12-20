<?php 
   Class Order_model extends CI_Model {
	
   	Public function __construct() {
   			parent::__construct();
   		}
   	
   		Public function getProductsFromOrder($orde_id){
   			$this->db->join('product_variant', 'prod_id = prva_prod_id', 'LEFT OUTER');
   			$this->db->join('product_type', 'prty_id = prva_prty_id', 'LEFT OUTER');
   			
   			$this->db->where('orde_id', $orde_id);
   			$query = $this->db->get("product");
   			return $query->result();
   		}
   	
   		Public function getSingleOrderById($id){
   			$this->db->join('user', 'user_id = orde_user_id', 'INNER');
   			$this->db->where('orde_id', $id);
   			$query = $this->db->get("order");
   			return $query->result();
   		}
   	
   		// return all orders
   		public function getAllOrders()
   		{
   			$query = $this->db->get("order");
   			return $query->result();
   		}
   		
   		// return all orderPositions from a specific user
   		public function getAllOrdersByUser($user_id)
   		{
   			$this->db->where('orde_user_id', $user_id);
   			$query = $this->db->get("order");
   			
   			$orders = $query->result();
   			foreach ($orders as $o)	{
     			$o->order_position = $this->getAllOrderPositions($o->orde_id);
  			}
 
   			return $orders;
   		}
   			
   		// return all orderPositions
   		public function getAllOrderPositions($orde_id)
   		{
   			$this->db->join('product', 'orpo_prod_id = prod_id', 'LEFT OUTER');
   			$this->db->join('event', 'even_id = prod_even_id', 'INNER');
   			$this->db->join('product_variant', 'orpo_prod_id = prva_prod_id', 'LEFT OUTER');
   			$this->db->join('product_type', 'prty_id = prva_prty_id', 'LEFT OUTER');
   			$this->db->where('orpo_orde_id', $orde_id);
   			$query = $this->db->get("order_position");
   			
   			return $query->result();
   		}
   	
   		// insert order
   		function insert_order($data)
   		{
   			return $this->db->insert('order', $data);
   		}
   	
   		// update order
   		function update_order($id, $data)
   		{
   			$this->db->where('orde_id', $id);
   			$this->db->update('order', $data);
   		}
   	
   		// delete order
   		function delete_order($orde_id)
   		{
   			return $this->db->delete('order', array('orde_id' => $orde_id));
   		}
   	
   		// get MAX-ID
   		function get_max_id(){
   			$maxid = 0;
   			$row = $this->db->query('SELECT MAX(orde_id) AS `maxid` FROM order')->row();
   			if ($row) $maxid = $row->maxid;
   			return $maxid;
   		}
   } 
?>