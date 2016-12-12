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
   	
   		public function getAllOrders()
   		{
   			$query = $this->db->get("order");
   			return $query->result();
   		}
   	
   		// insert
   		function insert_order($data)
   		{
   			return $this->db->insert('order', $data);
   		}
   	
   		//delete user
   		function update_order($id, $data)
   		{
   			$this->db->where('orde_id', $id);
   			$this->db->update('order', $data);
   		}
   	
   		//delete user
   		function delete_order($orde_id)
   		{
   			return $this->db->delete('order', array('orde_id' => orde_id));
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