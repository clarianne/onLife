<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Administrator extends CI_Controller{

		public function __construct(){
			parent::__construct();
			//$this->is_logged_in();
		}

		/*public function index(){

			//to add soon, if the user is logged in or not
			//if logged in:
			//$this->load->view('administrator/dashboard.php');
			//else
			//$this->load->view('administrator/login.php');
			$is_logged_in = $this->is_logged_in();
			if( !$is_logged_in ){
				redirect('/admin/login', 'refresh');
			} else {
			$this->load->view('administrator/dashboard'); }//for now hehe

		}*/

		public function add_dist(){
			
			$is_logged_in = $this->is_logged_in();
			if( !$is_logged_in ){
				redirect('/admin/login', 'refresh');
			} else {
				$this->no_cache();
				$data['user'] = $is_logged_in;
				
				//$this->load->model('admin/get_stats_model');
				$this->load->model('administrator/login_model');
				//$data['stats'] = $this->get_stats_model->get_library_stats();
				$data['info'] = $this->login_model->get_info();
				//$this->load->view('admin/admin_home_view', $data);
				$this->load->view('administrator/add_dist', $data);
			}

		}

		public function lfsiidchecker ($str) {

			$is_logged_in = $this->is_logged_in();
			if( !$is_logged_in ){
				redirect('/admin/login', 'refresh');
			} else {
				if (preg_match('/^[0-9]+$/',$str)) return true;
				else return false;
			}
		}

		/*
		*	Function that checks the input lfsiid.
		*/
		public function check_lfsiid(){

			$is_logged_in = $this->is_logged_in();
			if( !$is_logged_in ){
				redirect('/admin/login', 'refresh');
			} else {
				$preclass = $this->input->post('preclass');
				$lfsiid = $this->input->post('lfsiid');
				$new_lfsi_id = $preclass . $lfsiid;
				
				$this->load->library('form_validation');
				$this->form_validation->set_rules('lfsiid', 'LFSI ID','callback_lfsiidchecker');

				if ($this->form_validation->run() == false){
					echo '3';
				}
				else {
					$this->load->model('administrator/check_input_model');
					$num_lfsiID = $this->check_input_model->lfsiid_check($new_lfsi_id);
					
					if (intval($num_lfsiID) == 0) {
						echo '1';
					}
					else echo '2';
				}
			}
		}

		public function dist_add_execution(){
			// loads the model php file which will interact with the database
			$is_logged_in = $this->is_logged_in();
			if( !$is_logged_in ){
				redirect('/admin/login', 'refresh');
			} else {
		       	$this->load->model('administrator/admin_model'); 
				$lfsi_id = $this->input->post('lfsiid');
				$fname = $this->input->post('fname');
				$lname = $this->input->post('lname');
				$address = $this->input->post('address');
				$contact_num = $this->input->post('contact_num');
				$email_add = $this->input->post('email_add');

				
				$dist_data = array (
					'lfsi_id' => $lfsi_id,
					'fname' => $fname,
					'lname' => $lname,
					'address' => $address,
					'lname' => $lname,
					'contact_num' => $contact_num,
					'email_add' => $email_add,
				);
				

				$this->admin_model->dist_add($dist_data);
			}
	    }

		public function add_prod(){

			$is_logged_in = $this->is_logged_in();
			if( !$is_logged_in ){
				redirect('/admin/login', 'refresh');
			} else {
				$this->no_cache();
				$data['user'] = $is_logged_in;
				
				$this->load->model('administrator/login_model');
				$data['info'] = $this->login_model->get_info();
				$this->load->view('administrator/add_prod', $data);
			}

		}

		public function check_product_code(){
			$is_logged_in = $this->is_logged_in();
			if( !$is_logged_in ){
				redirect('/admin/login', 'refresh');
			} else {

				$product_code = $this->input->post('product_code');
				$this->load->model('administrator/check_input_model');
				$num_prodCode = $this->check_input_model->prod_code_check($product_code);
				
				if (intval($num_prodCode) == 0) {
					echo '1';
				}
				else echo '2';
			}
		}

		public function prod_add_execution(){
			// loads the model php file which will interact with the database
			$is_logged_in = $this->is_logged_in();
			if( !$is_logged_in ){
				redirect('/admin/login', 'refresh');
			} else {
		       	$this->load->model('administrator/admin_model'); 
				$product_code = $this->input->post('product_code');
				$prod_name = $this->input->post('prod_name');
				$prod_category = $this->input->post('prod_category');
				$dist_price = $this->input->post('dist_price');
				$ret_price = $this->input->post('ret_price');
				$prod_desc = $this->input->post('prod_desc');
				$length = $this->input->post('length');
				$width = $this->input->post('width');
				$height = $this->input->post('height');
				$weight = $this->input->post('weight');
				$imgurl = $this->input->post('imgurl');
				
				$prod_data = array (
					'product_code' => $product_code,
					'prod_name' => $prod_name,
					'prod_category' => $prod_category,
					'dist_price' => $dist_price,
					'ret_price' => $ret_price,
					'prod_desc' => $prod_desc,
					'length' => $length,
					'width' => $width,
					'height' => $height,
					'weight' => $weight,
					'imgurl' => $imgurl,
				);
				

				$this->admin_model->prod_add($prod_data);
			}
	    }

	    //for viewing and searching products
	    public function products(){
			$is_logged_in = $this->is_logged_in();
			if( !$is_logged_in ){
				redirect('/admin/login', 'refresh');
			} else {
				$this->no_cache();
				$data['user'] = $is_logged_in;
				
				$this->load->model('administrator/login_model');
				$data['info'] = $this->login_model->get_info();
				$this->load->model('administrator/search_product_model');
				$search = ""; 
				$data['products'] = $this->search_product_model->get_products( $search );
				$this->load->view('administrator/products', $data);
			}
		}

		public function distributors(){

			$is_logged_in = $this->is_logged_in();
			if( !$is_logged_in ){
				redirect('/admin/login', 'refresh');
			} else {
				$this->no_cache();
				$data['user'] = $is_logged_in;
				
				$this->load->model('administrator/login_model');
				$data['info'] = $this->login_model->get_info();
				$this->load->model('administrator/search_distributor_model');
				$search = ""; 
				$data['distributors'] = $this->search_distributor_model->get_distributors( $search );
				$this->load->view('administrator/distributors', $data);
			}

		}


		public function forgot_password(){

			$this->load->view('administrator/forgot_password');

		}

		/*public function login(){

			$this->load->view('administrator/login');

		}*/

		//logging in~

		/**
		* log in function for displaying login form
		*
		* @access	public
		* @param	none
		* @return	none
		*
		*/

		public function login(){
			$is_logged_in = $this->is_logged_in();
			$this->no_cache();
			if( $is_logged_in ){
				redirect('admin/dashboard', 'refresh');
			} else {
				$this->load->view('administrator/login');
			}
		}

		/**
		* log out function for logging administrator from the system
		*
		* @access	public
		* @param	none
		* @return	none
		*
		*/

		public function logout(){
			$this->session->sess_destroy();
			redirect('admin/login', 'refresh');
		}

		public function server_time(){

			$this->load->view('administrator/server_time');

		}

		/**
		* function for checking if the data from the form
		* is a valid admin or not
		*
		* @access	public
		* @param	none
		* @return	none
		*
		*/

		public function check_admin(){
			
			$this->load->model('administrator/check_admin_model');
			
			$user_count = $this->check_admin_model->check_username();
			
			if( $user_count != 1 ){
				echo "Username does not exist!";
			} else {
				$pass_count = $this->check_admin_model->check_password();
				
				if( $pass_count != 1 ){
					echo "Password does not match with the username!";
				} else {
					$this->session->set_userdata('user', $this->input->post('uname'));
					echo "1";
				}
			}
		}

		public function dashboard(){

			$is_logged_in = $this->is_logged_in();
			if( !$is_logged_in ){
				redirect('/admin/login', 'refresh');
			} else {
				$this->no_cache();
				$data['user'] = $is_logged_in;
				
				//$this->load->model('admin/get_stats_model');
				$this->load->model('administrator/login_model');
				//$data['stats'] = $this->get_stats_model->get_library_stats();
				$data['info'] = $this->login_model->get_info();
				//$this->load->view('admin/admin_home_view', $data);
				$this->load->view('administrator/dashboard', $data);
			}

			//$this->load->view('administrator/dashboard');

		}


		/**
		* function for displaying the home page
		* of the administrator logged in
		*
		* @access	public
		* @param	none
		* @return	none
		*
		*/

		/*public function home(){
			$is_logged_in = $this->is_logged_in();
			if( !$is_logged_in ){
				redirect('/admin/login', 'refresh');
			} else {
				$this->no_cache();
				$data['user'] = $is_logged_in;
				
				//$this->load->model('admin/get_stats_model');
				$this->load->model('administrator/login_model');
				//$data['stats'] = $this->get_stats_model->get_library_stats();
				$data['info'] = $this->login_model->get_info();
				//$this->load->view('admin/admin_home_view', $data);
				$this->load->view('administrator/dashboard', $data);
			}
		}*/

		/*
		*	function verification for displaying input text for:
		*		1. email
		*		2. password
		*	input text for email will be required and must be valid email
		*	input text for password will be required as well
		*	then it will call the function verify()
		*/

		public function no_cache(){
			$this->output->set_header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT');
			$this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate');
			$this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate, no-transform, max-age=0, post-check=0, pre-check=0");
			$this->output->set_header('Pragma: no-cache');
		}

		public function is_logged_in(){
			$this->load->model("administrator/check_admin_model");
			$user = $this->session->userdata('user');
			$is_valid = $this->check_admin_model->check_session_validity($user);
			
			if($is_valid){
				return true;
			}
			else{
				$this->session->sess_destroy();
				return false;
			}
		}

		public function orders(){

			$this->load->view('administrator/orders');

		}

		public function r_orders(){

			$is_logged_in = $this->is_logged_in();
			if( !$is_logged_in ){
				redirect('/admin/login', 'refresh');
			} else {
				$this->no_cache();
				$data['user'] = $is_logged_in;
				
				//$this->load->model('admin/get_stats_model');
				$this->load->model('administrator/login_model');
				//$data['stats'] = $this->get_stats_model->get_library_stats();
				$data['info'] = $this->login_model->get_info();
				//$this->load->view('admin/admin_home_view', $data);
				$this->load->view('administrator/r_orders', $data);
			}

		}


		public function unr_orders(){

			$is_logged_in = $this->is_logged_in();
			if( !$is_logged_in ){
				redirect('/admin/login', 'refresh');
			} else {
				$this->no_cache();
				$data['user'] = $is_logged_in;
				
				//$this->load->model('admin/get_stats_model');
				$this->load->model('administrator/login_model');
				//$data['stats'] = $this->get_stats_model->get_library_stats();
				$data['info'] = $this->login_model->get_info();
				//$this->load->view('admin/admin_home_view', $data);
				$this->load->view('administrator/unr_orders', $data);
			}

		}

		public function update_cust(){

			$is_logged_in = $this->is_logged_in();
			if( !$is_logged_in ){
				redirect('/admin/login', 'refresh');
			} else {
				$this->no_cache();
				$data['user'] = $is_logged_in;
				
				//$this->load->model('admin/get_stats_model');
				$this->load->model('administrator/login_model');
				//$data['stats'] = $this->get_stats_model->get_library_stats();
				$data['info'] = $this->login_model->get_info();
				//$this->load->view('admin/admin_home_view', $data);
				$this->load->view('administrator/update_cust', $data);
			}

		}

		public function update_prod(){

			$is_logged_in = $this->is_logged_in();
			if( !$is_logged_in ){
				redirect('/admin/login', 'refresh');
			} else {
				$this->no_cache();
				$data['user'] = $is_logged_in;
				
				//$this->load->model('admin/get_stats_model');
				$this->load->model('administrator/login_model');
				//$data['stats'] = $this->get_stats_model->get_library_stats();
				$data['info'] = $this->login_model->get_info();
				//$this->load->view('admin/admin_home_view', $data);
				$this->load->view('administrator/update_prod', $data);
			}
		}

	}

?>