<?php

/**
* Class for the database access of the system
*
* @filename	sign.php
* @date created	27 01 2014
* @author	Adrian Leal
*/

class Delete_distributor_model extends CI_Model{

	public function check_combination(){
		$user = $this->session->userdata('user');
		$pass = sha1(trim($this->input->post('password')));
		$query = $this->db->query("SELECT COUNT(*) AS count 
									FROM admin
									WHERE username LIKE '${user}' 
										AND password LIKE '${pass}'");
		return $query->row()->count;
	}

	public function delete_distributor(){
		//for now, delete from the distributor DB directly; if customer module is ok, delete from user DB first
		$user = trim($this->input->post('lfsi_id'));
		$query = $this->db->query("DELETE FROM distributor
									WHERE lfsi_id LIKE '${user}'");
		//$query = $this->db->query("DELETE FROM reservation
									//WHERE idnumber LIKE '${user}'");

		// insert in log
		// Admin deleted an account	
	/*	$stmt = "INSERT INTO log( `action`, `time`, `idnumber`) 
						  VALUES( 'deleted an account', NOW(), 'Admin')";
		$this->db->query($stmt);

		// insert into log
		// Account deleted
		$stmt = "INSERT INTO log( `action`, `time`, `idnumber`) 
						  VALUES( 'account deleted', NOW(), '$user')";
		$this->db->query($stmt);

	}

	public function delete_reservations(){
		$user = trim($this->input->post('idnumber'));
		$query = $this->db->query("DELETE FROM reservation
									WHERE idnumber LIKE '${user}'");
	}*/

}
?>