<?php
/*============================================================+
* File name   : print_inventory_model.php
* Last Update : 2013-01-30
*
* Description : Generate PDF for Inventory Report
*
* Author: CMSC 128 AB-6L A.Y.2013-14
*
============================================================+
*/	
	class Print_order_model extends CI_Model{
		public function __construct(){
			
		}

		public function get_order_array($order_id, $lfsi_id) {

			$this->load->database();

			$query = $this->db->query("SELECT o.order_id, o.order_date, o.order_total, d.fname, d.lname FROM `order` o, `distributor` d where o.order_id = '$order_id' AND d.lfsi_id = '$lfsi_id'");
			
			$result = $query->row();

			$query2 = $this->db->query("SELECT i.product_code, p.prod_name, p.dist_price, i.quantity, i.quantity * p.dist_price as 'item_price' FROM `order_items` i, `product` p, `order` o WHERE o.order_id = '$order_id' AND i.product_code = p.product_code"); 

			//multiply the price

			$result->product = $query2->result();

			return $result;
		}

		
	}
	/* 	End of file print_inventory_model.php
	* 	Location: ./application/models/print_inventory_model.php 
	*/
?>