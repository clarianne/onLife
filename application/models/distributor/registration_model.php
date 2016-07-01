<?php


/*
*	Filename: registration_model.php
*	Project Name: ICS Library System
*	Created by: Borrower's Team
*
*/


if(! defined('BASEPATH')) exit ('No direct script access allowed');

class Registration_model extends CI_Model{
	
	public function _construct(){
		parent :: _construct();
	}
	
	/**
	*	function that checks if the input idnumber exists in the database
	*/
	public function checklfsi_id($lfsi_id)
	{
		$this->load->database();

		$query = $this->db->query("SELECT count(lfsi_id) AS count 
								   FROM user WHERE lfsi_id LIKE '$lfsi_id'");//title

		$result = $query->result();
		return $result;
	}


	/**
	*	function that checks if the input idnumber exists in the database
	*/
	public function checklfsi_id_dist($lfsi_id)
	{
		$this->load->database();

		$query = $this->db->query( "SELECT count(lfsi_id) AS count 
									FROM distributor WHERE lfsi_id LIKE '$lfsi_id'" );//title
		
		$result = $query->result();
		return $result;
	}


	/**
	*	function that checks if the input email exists in the database
	*/
	public function check_email_user($email)
	{
		$this->load->database();

		$query = $this->db->query( "SELECT count(email_add) AS count 
									FROM user WHERE email_add LIKE '$email'" );//title

		$result = $query->result();
		return $result;
	}


	/**
	*	function that ckecks if the input email exists in the database and user's status is DEACTIVATED
	*/
	public function resend_email_verification($email)
	{
		$this->load->database();

		//select count, deacivated
		$query = $this->db->query( "SELECT count(email) as count FROM borrower 
								   WHERE email LIKE '$email' AND status LIKE 'DEACTIVATED'");
		
		$result = $query->result();
		return $result;
	}


	/**
	*	function that checks if the input idnumber exists in the sample table
	*/
	public function idnumber_exist_check($idnumber)
	{
		$query = $this->db->get_where('sample', array('idnumber' => $idnumber));

		if($query->num_rows() > 0)
		{
			return FALSE;
		}

		$query->free_result();
		return TRUE;
	}	


	/**
	*	function that checks if the input idnumber exists in the borrower table
	*/

	public function idnumber_borrower_check($idnumber)
	{
		$query = $this->db->get_where('borrower', array('idnumber' => $idnumber));

		if($query->num_rows() > 0)
		{
			$query->free_result();
			return TRUE;
		}

		$query->free_result();
		return FALSE;
	}


	/**
	*	function that checks if the input email exists in the borrower table
	*/
	public function email_exist($email)
	{
		$query = $this->db->get_where('borrower', array('email' => $email));

		if($query->num_rows() > 0)
		{
			$query->free_result();
			return TRUE;
		}

		$query->free_result();
		return FALSE;
	}

}


	/* 	End of registration_model.php
	* 	Location: ./application/models/user/registration_model.php 
	*/
