<?php

/**
* Class for the database access of the system
*
* @filename	sign.php
* @date created	27 01 2014
* @author	Adrian Leal
*/

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Check_dist_model extends CI_Model{
	public function __construct(){
			
	}

	/**
	* Function for checking if the username is existing or not
	* 
	*
	* @access	public
	* @param	none
	* @return	none
	*
	*/

	public function check_username(){
		$username = $this->input->post('uname');
		$query = $this->db->query("SELECT * 
									FROM user 
									WHERE email_add LIKE '${username}'");
		return $query->num_rows();
	}

	/**
	* Function for checking if the username 
	* and password combination is correct
	*
	* @access	public
	* @param	none
	* @return	none
	*
	*/

	public function check_password(){
		$username =$this->input->post('uname');
		$password = sha1($this->input->post('pword'));

		$query = $this->db->query("	SELECT * 
									FROM user 
									WHERE email_add LIKE '${username}' 
										and password LIKE '${password}'");
		return $query->num_rows();
	}

	/**
	* Function for checking if the username is existing or not
	* 
	*
	* @access	public
	* @param	none
	* @return	none
	*
	*/

	public function check_session_validity($user){
		$query = $this->db->query("SELECT * 
									FROM user 
									WHERE email_add LIKE '${user}'");

		if($query->num_rows() == 1) return true;
		else return false;
	}

	
	public function get_info($userid){
		//$email_add = $this->input->post('email_add');
		$query = $this->db->query("SELECT d.lfsi_id, d.fname, d.lname, d.address, d.contact_num, u.email_add FROM distributor d, user u WHERE u.email_add LIKE '{$userid}' AND d.lfsi_id = u.lfsi_id");
		return $query->row();
	}
}
?>