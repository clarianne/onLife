<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Customer extends CI_Controller{

		public function index(){

			//to add soon, if the user is logged in or not
			$this->load->view('customer/home_index.php');

		}

		public function cart(){

			$this->load->view('customer/cart.php');

		}

		public function checkout(){

			$this->load->view('customer/checkout.php');

		}

		public function forgot_password(){

			$this->load->view('customer/forgot_password.php');

		}

		public function login(){

			$this->load->view('customer/login.php');

		}

		public function product(){

			$this->load->view('customer/product.php');

		}

		public function profile(){

			$this->load->view('customer/profile.php');

		}

		public function search(){

			$this->load->view('customer/search.php');

		}

		public function signup(){

			$this->load->view('customer/signup.php');

		}

		public function update_profile(){

			$this->load->view('customer/update_profile.php');

		}

	}

?>