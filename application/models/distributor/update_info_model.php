<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Update_info_model extends CI_Model{
	public function __construct(){
			
	}

	public function get_prod_update_details($id) {

		$this->load->database();
		$query = $this->db->query("SELECT * FROM product WHERE product_code = '$id'");
		
		$result = $query->row();

		return $result;
	}

	public function get_order_details_unreleased($order_id, $lfsi_id){

		$this->load->database();

		$query = $this->db->query("SELECT o.order_id, o.order_date, o.order_total FROM `order` o, `distributor` d where o.order_id = '$order_id' AND d.lfsi_id = '$lfsi_id'");
		
		$result = $query->row();

		$query2 = $this->db->query("SELECT i.product_code, p.prod_name, p.dist_price, i.quantity, i.quantity * p.dist_price as 'item_price' FROM `order_items` i, `product` p, `order` o WHERE o.order_id = '$order_id' AND i.order_id=o.order_id AND i.product_code = p.product_code"); 

		//multiply the price

		$result->product = $query2->result();

		return $result;
	}

	public function get_order_details_released($order_id, $lfsi_id){

		$this->load->database();

		$query = $this->db->query("SELECT o.order_id, o.order_date, o.order_total, o.release_date FROM `order` o, `distributor` d where o.order_id = '$order_id' AND d.lfsi_id = '$lfsi_id'");
		
		$result = $query->row();

		$query2 = $this->db->query("SELECT i.product_code, p.prod_name, p.dist_price, i.quantity, i.quantity * p.dist_price as 'item_price' FROM `order_items` i, `product` p, `order` o WHERE o.order_id = '$order_id' AND i.order_id=o.order_id AND i.product_code = p.product_code"); 

		//multiply the price

		$result->product = $query2->result();

		return $result;
	}
}

?>