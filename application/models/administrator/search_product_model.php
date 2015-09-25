<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Search_product_model extends CI_Model{
	public function __construct(){

	}

	public function get_products( $search = "" ) {

		$search = trim($search);

		date_default_timezone_set('Asia/Manila');
		$date_now = date("Y-m-d", time());

		$result = array();
		$search = strtolower($search);
		$temp_search = explode(" ", $search);
		$where = "( ";
		$where2 = "( ";
		for( $i = 0; $i < count($temp_search); $i++ ){
			$where = $where . "LOWER(product_code) LIKE '%" . $temp_search[$i] . "%' OR ";
			$where = $where . "LOWER(prod_name) LIKE '%" . $temp_search[$i] . "%' OR ";
			$where = $where . "dist_price LIKE '%" . $temp_search[$i] . "%' OR ";
			$where = $where . "ret_price LIKE '%" . $temp_search[$i] . "%' OR ";
			$where = $where . "LOWER(prod_desc) LIKE '%" . $temp_search[$i] . "%' OR ";
			$where = $where . "LOWER(length) LIKE '%" . $temp_search[$i] . "%' OR ";
			$where = $where . "LOWER(width) LIKE '%" . $temp_search[$i] . "%' OR ";
			$where = $where . "LOWER(height) LIKE '%" . $temp_search[$i] . "%' OR ";
			$where = $where . "LOWER(weight) LIKE '%" . $temp_search[$i] . "%' OR ";
			$where = $where . "LOWER(imgurl) LIKE '%" . $temp_search[$i] . "%')";

		}				
		$query = $this->db->query("SELECT *
									FROM product
									WHERE ${where}
									ORDER BY product.prod_category ASC");

		$result_array = $query->result();

		date_default_timezone_set('Asia/Manila');
		$date_now = date("Y-m-d", time());

		foreach ($result_array as $data) {
			$idnum = $data->product_code;
		}
		return $result_array;
	}

}

?>