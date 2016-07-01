<?php

if(! defined('BASEPATH')) exit ('No direct script access allowed');

class Log_model extends CI_Model{
	
	public function _construct(){
		parent :: _construct();
	}

	/**
	*	function that finds the user from the borrower table using inputs username and password
	*/
	public function get_distributor($email_add, $password){
		$this->load->database();
		$password = sha1($password);

		$stmt = "SELECT * FROM `user` WHERE email_add = '{$email_add}' 
					AND password = '{$password}' AND onlife_status = 'ACTIVATED'";

		$query = $this->db->query($stmt);
		return $query->result();
	}


	/**
	*	function that gets the attributes of the user from the sample table using idnumber
	*/	
	public function get_info($lfsi_id){
		$this->load->database();

		$stmt = "SELECT * FROM `distributor` WHERE lfsi_id = '{$lfsi_id}'";

		$query = $this->db->query($stmt);
		return $query->result();
	}

	/**
	*	function that obtains the password from the borrower table using the input username
	*/
	public function get_password($email_add)
	{
		$this->load->database();

		$stmt = "SELECT lfsi_id, email_add, password FROM `user` 
					WHERE email_add = '{$email_add}'";

		$query = $this->db->query($stmt);
		return $query->result();
	}

	/**
	*	function that sets the lastsession of the borrower table using the input username
	*/
	public function set_last_session($email)
	{
		$this->load->database();

		$stmt = "UPDATE `user` SET `last_session` = NOW() 
					WHERE `lfsi_id`= '$email_add'";

		$query = $this->db->query($stmt);
		return true;
	}

	/**
	*	function that inserts to log table the current user
	*/
	public function update_log_login($username)
	{
		$this->load->database();

		//insert into log
		//user logged in
		$stmt = "INSERT INTO log( `action`, `time`, `lfsi_id`) 
					VALUES ('logged in', NOW(), '$email_add')";

		$query = $this->db->query($stmt);
		return true;
	}
		
}

?>