<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Search_distributor_model extends CI_Model{
	public function __construct(){

	}

	public function get_distributors( $search = "" ) {

		$search = trim($search);

		date_default_timezone_set('Asia/Manila');
		$date_now = date("Y-m-d", time());

		$result = array();
		$search = strtolower($search);
		$temp_search = explode(" ", $search);
		$where = "( ";
		$where2 = "( ";
		for( $i = 0; $i < count($temp_search); $i++ ){
			$where = $where . "LOWER(lfsi_id) LIKE '%" . $temp_search[$i] . "%' OR ";
			$where = $where . "LOWER(fname) LIKE '%" . $temp_search[$i] . "%' OR ";
			$where = $where . "LOWER(lname) LIKE '%" . $temp_search[$i] . "%' OR ";
			$where = $where . "LOWER(address) LIKE '%" . $temp_search[$i] . "%' OR ";
			$where = $where . "LOWER(contact_num) LIKE '%" . $temp_search[$i] . "%' OR ";
			$where = $where . "LOWER(email_add) LIKE '%" . $temp_search[$i] . "%')";

		}				
		$query = $this->db->query("SELECT *
									FROM distributor
									WHERE ${where}
									ORDER BY distributor.lfsi_id ASC");

		$result_array = $query->result();

		date_default_timezone_set('Asia/Manila');
		$date_now = date("Y-m-d", time());

		foreach ($result_array as $data) {
			$idnum = $data->lfsi_id;
		}
		return $result_array;
	}

}

?>