<?php

	class Check_input_model extends CI_Model{

		public function lfsiid_check($new_lfsi_id){

			$sql = "SELECT COUNT(lfsi_id) AS count
			FROM distributor
			WHERE lfsi_id LIKE '${new_lfsi_id}'";

			$query = $this->db->query($sql);
			return $query->row()->count;

		}

		public function prod_code_check($product_code){

			$sql = "SELECT COUNT(product_code) AS count
			FROM product
			WHERE product_code LIKE '${product_code}'";

			$query = $this->db->query($sql);
			return $query->row()->count;

		}

	}

?>