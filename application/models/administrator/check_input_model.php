<?php

	class Check_input_model extends CI_Model{

		public function lfsiid_check($lfsiid){

			$sql = "SELECT COUNT(lfsi_id) AS count
			FROM distributor
			WHERE lfsi_id LIKE '${lfsiid}'";

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