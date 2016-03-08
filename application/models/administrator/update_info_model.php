<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Update_info_model extends CI_Model{
	public function __construct(){
			
	}

	/*
	*	Gets the details of the product/distributor that will be updated
	*/
	public function get_dist_update_details($id) {

		$this->load->database();
		$query = $this->db->query("SELECT * FROM distributor WHERE lfsi_id = '$id'");
		
		$result = $query->row();

		return $result;
	}

	public function get_prod_update_details($id) {

		$this->load->database();
		$query = $this->db->query("SELECT * FROM product WHERE product_code = '$id'");
		
		$result = $query->row();

		return $result;
	}
}

?>