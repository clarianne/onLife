<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Administrator extends CI_Controller{

		public function __construct(){
			parent::__construct();
		}

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
				$dist_status = $this->input->post('dist_status');

				
				$dist_data = array (
					'lfsi_id' => $lfsi_id,
					'fname' => $fname,
					'lname' => $lname,
					'address' => $address,
					'lname' => $lname,
					'contact_num' => $contact_num,
					'dist_status' => $dist_status
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
				$this->load->model('administrator/admin_model');
				$data['unr_count'] = $this->admin_model->view_unr_orders_count();
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
				//$imgurl = $this->input->post('imgurl');
				$prod_avail = $this->input->post('prod_avail');
				$imgurl = $this->upload_img();
				
				$prod_data = array (
					'product_code' => $product_code,
					'prod_name' => $prod_name,
					'prod_category' => $prod_category,
					'dist_price' => $dist_price,
					'ret_price' => $ret_price,
					'prod_desc' => $prod_desc,
					//'imgurl' => $imgurl,
					'prod_avail' => $prod_avail
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
				$this->load->model('administrator/admin_model');
				$this->load->library('javascript');
				$this->load->model('administrator/login_model');
				$data['info'] = $this->login_model->get_info();
				$this->load->model('administrator/admin_model');
				$data['unr_count'] = $this->admin_model->view_unr_orders_count();
				
				if($this->input->post('search_products')!=''){
					//$filter = $this->input->post('filter');
					$word = $this->db->escape_str($this->input->post('search'));

					$words = explode(" ", $word);
					$data['sql2'] = array();
					foreach ($words as $keyword) {
						$query_result = $this->admin_model->search_prod_avail($keyword);
						foreach($query_result as $entry){
							if(!in_array($entry, $data['sql2'])){
								array_push($data['sql2'], $entry);
						    }
						}
					}
					$data['flag'] = $data['sql2'];
					if (count($data['sql2']) == 0){
						$data['sql2'] = $this->admin_model->viewAll_prod_avail();
					}
					$this->load->view('administrator/products',$data);

				}else{
					$data['sql2'] = $this->admin_model->viewAll_prod_avail();
					$data['flag'] = $data['sql2'];
					$this->load->view('administrator/products',$data);
				}
			}
		}


		
		public function prod_archive(){
			$is_logged_in = $this->is_logged_in();
			if( !$is_logged_in ){
				redirect('/admin/login', 'refresh');
			} else {
				$this->no_cache();
				$data['user'] = $is_logged_in;
				$this->load->model('administrator/admin_model');
				$this->load->library('javascript');
				$this->load->model('administrator/login_model');
				$data['info'] = $this->login_model->get_info();
				$this->load->model('administrator/admin_model');
				$data['unr_count'] = $this->admin_model->view_unr_orders_count();
				
				if($this->input->post('search_products')!=''){
					//$filter = $this->input->post('filter');
					$word = $this->db->escape_str($this->input->post('search'));

					$words = explode(" ", $word);
					$data['sql2'] = array();
					foreach ($words as $keyword) {
						$query_result = $this->admin_model->search_prod_notavail($keyword);
						foreach($query_result as $entry){
							if(!in_array($entry, $data['sql2'])){
								array_push($data['sql2'], $entry);
						    }
						}
					}
					$data['flag'] = $data['sql2'];
					if (count($data['sql2']) == 0){
						$data['sql2'] = $this->admin_model->viewAll_prod_notavail();
					}
					$this->load->view('administrator/prod_archive',$data);

				}else{
					$data['sql2'] = $this->admin_model->viewAll_prod_notavail();
					$data['flag'] = $data['sql2'];
					$this->load->view('administrator/prod_archive',$data);
				}
			}
		}

		public function distributors(){

			$is_logged_in = $this->is_logged_in();
			if( !$is_logged_in ){
				redirect('/admin/login', 'refresh');
			} else {
				$this->no_cache();
				$data['user'] = $is_logged_in;
				$this->load->model('administrator/admin_model');
				$this->load->library('javascript');
				$this->load->model('administrator/login_model');
				$data['info'] = $this->login_model->get_info();
				$this->load->model('administrator/admin_model');
				$data['unr_count'] = $this->admin_model->view_unr_orders_count();
				
				if($this->input->post('search_distributors')!=''){
					//$filter = $this->input->post('filter');
					$word = $this->input->post('search');

					$words = explode(" ", $word);
					$data['sql2'] = array();
					foreach ($words as $keyword) {
						$query_result = $this->admin_model->search_dist_activated($keyword);
						foreach($query_result as $entry){
							if(!in_array($entry, $data['sql2'])){
								array_push($data['sql2'], $entry);
						    }
						}
					}
					$data['flag'] = $data['sql2'];
					if (count($data['sql2']) == 0){
						$data['sql2'] = $this->admin_model->viewAll_dist_activated();
					}
					$this->load->view('administrator/distributors',$data);

				}else{
					$data['sql2'] = $this->admin_model->viewAll_dist_activated();
					$data['flag'] = $data['sql2'];
					$this->load->view('administrator/distributors',$data);
				}
			}

		}

		public function dist_archive(){

			$is_logged_in = $this->is_logged_in();
			if( !$is_logged_in ){
				redirect('/admin/login', 'refresh');
			} else {
				$this->no_cache();
				$data['user'] = $is_logged_in;
				$this->load->model('administrator/admin_model');
				$this->load->library('javascript');
				$this->load->model('administrator/login_model');
				$data['info'] = $this->login_model->get_info();
				$this->load->model('administrator/admin_model');
				$data['unr_count'] = $this->admin_model->view_unr_orders_count();
				
				if($this->input->post('search_distributors')!=''){
					//$filter = $this->input->post('filter');
					$word = $this->input->post('search');

					$words = explode(" ", $word);
					$data['sql2'] = array();
					foreach ($words as $keyword) {
						$query_result = $this->admin_model->search_dist_deactivated($keyword);
						foreach($query_result as $entry){
							if(!in_array($entry, $data['sql2'])){
								array_push($data['sql2'], $entry);
						    }
						}
					}
					$data['flag'] = $data['sql2'];
					if (count($data['sql2']) == 0){
						$data['sql2'] = $this->admin_model->viewAll_dist_deactivated();
					}
					$this->load->view('administrator/dist_archive',$data);

				}else{
					$data['sql2'] = $this->admin_model->viewAll_dist_deactivated();
					$data['flag'] = $data['sql2'];
					$this->load->view('administrator/dist_archive',$data);
				}
			}

		}

		public function update_distributor(){	

			$is_logged_in = $this->is_logged_in();
			if( !$is_logged_in ){
				redirect('/admin/login', 'refresh');
			} else {
				$this->no_cache();
				$data['user'] = $is_logged_in;
				$this->load->model('administrator/admin_model');
				$this->load->library('javascript');
				$this->load->model('administrator/login_model');
				$data['info'] = $this->login_model->get_info();
				$this->load->model('administrator/admin_model');
				$data['unr_count'] = $this->admin_model->view_unr_orders_count();
				
				$this->load->model('administrator/update_info_model'); 
				$lfsi_id = $this->input->post('lfsi_id');
				if (!$lfsi_id) redirect ("admin/distributors");
				$data['update_details'] = $this->update_info_model->get_dist_update_details($lfsi_id);		
				$this->load->view('administrator/update_distributor', $data);
			}
				
		}

		public function update_product(){	

			$is_logged_in = $this->is_logged_in();
			if( !$is_logged_in ){
				redirect('/admin/login', 'refresh');
			} else {
				$this->no_cache();
				$data['user'] = $is_logged_in;
				$this->load->model('administrator/admin_model');
				$this->load->library('javascript');
				$this->load->model('administrator/login_model');
				$data['info'] = $this->login_model->get_info();
				$this->load->model('administrator/admin_model');
				$data['unr_count'] = $this->admin_model->view_unr_orders_count();
				
				$this->load->model('administrator/update_info_model'); 
				$product_code = $this->input->post('product_code');
				if (!$product_code) redirect ("admin/products");
				$data['update_details'] = $this->update_info_model->get_prod_update_details($product_code);		
				$this->load->view('administrator/update_product', $data);
			}
				
		}

		public function dist_update_execution(){
			// loads the model php file which will interact with the database
	       	$this->load->model('administrator/admin_model'); 
			$lfsi_id = $this->input->post('lfsi_id');
			$fname = $this->input->post('fname');
			$lname = $this->input->post('lname');
			$address = $this->input->post('address');
			$contact_num = $this->input->post('contact_num');
			$dist_status = $this->input->post('dist_status');
			$previous_lfsiid = $this->input->post('previous_lfsiid');
			
			$distributor_updated_data = array (
				'lfsi_id' => $lfsi_id,
				'fname' => $fname,
				'lname' => $lname,
				'address' => $address,
				'contact_num' => $contact_num,
				'dist_status' => $dist_status,
			);

			$this->admin_model->dist_update($distributor_updated_data, $previous_lfsiid);

    	}

    	public function prod_update_execution(){
			// loads the model php file which will interact with the database
	       	$this->load->model('administrator/admin_model'); 
			//$product_code = $this->input->post('product_code');
			$prod_name = $this->input->post('prod_name');
			$prod_category = $this->input->post('prod_category');
			$prod_desc = $this->input->post('prod_desc');
			$dist_price = $this->input->post('dist_price');
			$ret_price = $this->input->post('ret_price');
			$prod_desc = $this->input->post('prod_desc');
			$prod_avail = $this->input->post('prod_avail');
			//add imgurl soon
			$previous_prodcode = $this->input->post('previous_prodcode');
			
			$product_updated_data = array (
				'prod_name' => $prod_name,
				'prod_category' => $prod_category,
				'prod_desc' => $prod_desc,
				'ret_price' => $ret_price,
				'dist_price' => $dist_price,
				'prod_desc' => $prod_desc,
				'prod_avail' => $prod_avail,
			);

			$this->admin_model->prod_update($product_updated_data, $previous_prodcode);

    	}

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

		/*
		*	Function that checks the password of the user.
		*/
		public function check_password(){
			$is_logged_in = $this->is_logged_in();
			if( !$is_logged_in ){ return; }

			$this->load->model('administrator/delete_distributor_model');
			$pass_count = $this->delete_distributor_model->check_combination();
			if($pass_count != 1){echo "Password error!";}
			else{echo "1";}
			//return $this->delete_distributor_model->check_combination();
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
				$this->load->model('administrator/admin_model');
				$data['unr_count'] = $this->admin_model->view_unr_orders_count();
				$data['unr_5'] = $this->admin_model->view_five_unreleased();
				$data['r_5'] = $this->admin_model->view_five_released();
				//$this->load->view('admin/admin_home_view', $data);
				$this->load->view('administrator/dashboard', $data);
			}

		}

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

		public function r_orders(){

			$is_logged_in = $this->is_logged_in();
			if( !$is_logged_in ){
				redirect('/admin/login', 'refresh');
			} else {
				$this->no_cache();
				$data['user'] = $is_logged_in;
				$this->load->model('administrator/admin_model');
				$this->load->library('javascript');
				$this->load->model('administrator/login_model');
				$data['info'] = $this->login_model->get_info();
				$this->load->model('administrator/admin_model');
				$data['unr_count'] = $this->admin_model->view_unr_orders_count();
				
				if($this->input->post('search_orders')!=''){
					//$filter = $this->input->post('filter');
					$word = $this->db->escape_str($this->input->post('search'));

					$words = explode(" ", $word);
					$data['sql2'] = array();
					foreach ($words as $keyword) {
						$query_result = $this->admin_model->search_orders_r($keyword);
						foreach($query_result as $entry){
							if(!in_array($entry, $data['sql2'])){
								array_push($data['sql2'], $entry);
						    }
						}
					}
					$data['flag'] = $data['sql2'];
					if (count($data['sql2']) == 0){
						$data['sql2'] = $this->admin_model->viewAll_orders_released();
					}
					$this->load->view('administrator/r_orders',$data);

				}else{
					$data['sql2'] = $this->admin_model->viewAll_orders_released();
					$data['flag'] = $data['sql2'];
					$this->load->view('administrator/r_orders',$data);
				}
			}

		}


		public function unr_orders(){
			$is_logged_in = $this->is_logged_in();
			if( !$is_logged_in ){
				redirect('/admin/login', 'refresh');
			} else {
				$this->no_cache();
				$data['user'] = $is_logged_in;
				$this->load->model('administrator/admin_model');
				$this->load->library('javascript');
				$this->load->model('administrator/login_model');
				$data['info'] = $this->login_model->get_info();
				$this->load->model('administrator/admin_model');
				$data['unr_count'] = $this->admin_model->view_unr_orders_count();
				
				if($this->input->post('search_orders')!=''){
					//$filter = $this->input->post('filter');
					$word = $this->db->escape_str($this->input->post('search'));

					$words = explode(" ", $word);
					$data['sql2'] = array();
					foreach ($words as $keyword) {
						$query_result = $this->admin_model->search_orders_unr($keyword);
						foreach($query_result as $entry){
							if(!in_array($entry, $data['sql2'])){
								array_push($data['sql2'], $entry);
						    }
						}
					}
					$data['flag'] = $data['sql2'];
					if (count($data['sql2']) == 0){
						$data['sql2'] = $this->admin_model->viewAll_orders_unreleased();
					}
					$this->load->view('administrator/unr_orders',$data);

				}else{
					$data['sql2'] = $this->admin_model->viewAll_orders_unreleased();
					$data['flag'] = $data['sql2'];
					$this->load->view('administrator/unr_orders',$data);
				}
			}
		}

		public function view_orders_unreleased(){

			$is_logged_in = $this->is_logged_in();
			if( !$is_logged_in ){
				redirect('/admin/login', 'refresh');
			} else {
				$this->no_cache();
				$data['user'] = $is_logged_in;
				$this->load->model('administrator/admin_model');
				$this->load->library('javascript');
				$this->load->model('administrator/login_model');
				$data['info'] = $this->login_model->get_info();
				$this->load->model('administrator/admin_model');
				$data['unr_count'] = $this->admin_model->view_unr_orders_count();
				
				$this->load->model('administrator/update_info_model'); 
				$order_id = $this->input->post('order_id');
				$lfsi_id = $this->input->post('lfsi_id');
				//$product_code = $this->input->post('product_code');
				$data['update_details'] = $this->update_info_model->get_order_details_unreleased($order_id, $lfsi_id/*, $product_code*/);		
				$this->load->view('administrator/view_orders_unr', $data);
			}
		}

		public function view_orders_released(){

			$is_logged_in = $this->is_logged_in();
			if( !$is_logged_in ){
				redirect('/admin/login', 'refresh');
			} else {
				$this->no_cache();
				$data['user'] = $is_logged_in;
				$this->load->model('administrator/admin_model');
				$this->load->library('javascript');
				$this->load->model('administrator/login_model');
				$data['info'] = $this->login_model->get_info();
				$data['unr_count'] = $this->admin_model->view_unr_orders_count();
				
				$this->load->model('administrator/update_info_model'); 
				$order_id = $this->input->post('order_id');
				$lfsi_id = $this->input->post('lfsi_id');
				//$product_code = $this->input->post('product_code');
				$data['update_details'] = $this->update_info_model->get_order_details_released($order_id, $lfsi_id/*, $product_code*/);		
				$this->load->view('administrator/view_orders_r', $data);
			}


		}

		public function order_update_execution(){
			// loads the model php file which will interact with the database
	       	$this->load->model('administrator/admin_model'); 
			//$product_code = $this->input->post('product_code');
			$order_id = $this->input->post('order_id');
			$status = $this->input->post('status');
			//$release_date = $this->input->post('release_date');
			
			$released_order_data = array (
				'status' => $status,
			);


			$this->admin_model->order_update($released_order_data, $order_id);
			$this->admin_model->release_update($order_id);

    	}

    	public function upload_img(){

    		$type = explode('.', $_FILES["pic"]["name"]);
			$type = strtolower($type[count($type)-1]);
			$url = "./images/".uniqid(rand()).'.'.$type;
			if(in_array($type, array("jpg", "jpeg", "gif", "png")))
				if(is_uploaded_file($_FILES["pic"]["tmp_name"]))
					if(move_uploaded_file($_FILES["pic"]["tmp_name"],$url))
						return $url;
			return "";
    	}

	}

?>