<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Distributor extends CI_Controller{

		public function __construct(){
			parent::__construct();
			$this->load->library('cart');
			$this->load->library('javascript');
			$this->load->library('session');
			$new_order_id;
			
		}

		public function index(){

			$is_logged_in = $this->is_logged_in();
			if($is_logged_in) {
				$this->dist_index();
			}

			else {
				$this->load->model('distributor/dist_model');
				$data['sql2'] = $this->dist_model->viewAll_prod_rand();
				$data['flag'] = $data['sql2'];
				$this->load->view('distributor/home_index.php', $data);
			}

		}

		public function dist_index(){

			$is_logged_in = $this->is_logged_in();
			if( !$is_logged_in ){
				$this->load->model('distributor/dist_model');
				$data['sql2'] = $this->dist_model->viewAll_prod_rand();
				$data['flag'] = $data['sql2'];
				$this->load->view('distributor/home_index.php', $data);
			} else {
				$this->no_cache();
				$data['user'] = $is_logged_in;
				$userid = $this->session->userdata('user');

				$this->load->model('distributor/dist_model');
				$data['sql2'] = $this->dist_model->viewAll_prod_rand();
				$data['flag'] = $data['sql2'];
				
				$this->load->model('distributor/check_dist_model');
				$data['info'] = $this->check_dist_model->get_info($userid);
				$this->load->view('distributor/dist_index', $data);
			}
		}

		public function shop_dist(){

			$is_logged_in = $this->is_logged_in();
			if( !$is_logged_in ){
				$this->load->model('distributor/dist_model');
				$this->load->library('javascript');
				if($this->input->post('search_products')!=''){
					$word = $this->db->escape_str($this->input->post('search'));

					$words = explode(" ", $word);
					$data['sql2'] = array();
					foreach ($words as $keyword) {
						$query_result = $this->dist_model->search_prod($keyword);
						foreach($query_result as $entry){
							if(!in_array($entry, $data['sql2'])){
								array_push($data['sql2'], $entry);
						    }
						}
					}
					$data['flag'] = $data['sql2'];
					if (count($data['sql2']) == 0){
						$data['sql2'] = $this->dist_model->viewAll_prod();
					}
					$this->load->view('distributor/shop_dist_out',$data);

				}else{
					$data['sql2'] = $this->dist_model->viewAll_prod();
					$data['flag'] = $data['sql2'];
					$this->load->view('distributor/shop_dist_out',$data);
				}
			} else {
				$this->no_cache();
				$data['user'] = $is_logged_in;
				$this->load->model('distributor/dist_model');
				$this->load->library('javascript');
				$userid = $this->session->userdata('user');
				
				$this->load->model('distributor/check_dist_model');
				$data['info'] = $this->check_dist_model->get_info($userid);
				
				if($this->input->post('search_products')!=''){
					$word = $this->db->escape_str($this->input->post('search'));

					$words = explode(" ", $word);
					$data['sql2'] = array();
					foreach ($words as $keyword) {
						$query_result = $this->dist_model->search_prod($keyword);
						foreach($query_result as $entry){
							if(!in_array($entry, $data['sql2'])){
								array_push($data['sql2'], $entry);
						    }
						}
					}
					$data['flag'] = $data['sql2'];
					if (count($data['sql2']) == 0){
						$data['sql2'] = $this->dist_model->viewAll_prod();
					}
					$this->load->view('distributor/shop_dist',$data);

				}else{
					$data['sql2'] = $this->dist_model->viewAll_prod();
					$data['flag'] = $data['sql2'];
					$this->load->view('distributor/shop_dist',$data);
				}
			}

		}

		public function show_product(){	

			$is_logged_in = $this->is_logged_in();
			if( !$is_logged_in ){
				$this->load->model('administrator/admin_model');
				$this->load->library('javascript');

				$this->load->model('distributor/dist_model');
				$data['sql2'] = $this->dist_model->viewAll_prod_rand();
				$data['flag'] = $data['sql2'];
				
				$this->load->model('distributor/update_info_model'); 
				$prod_code = $this->input->post('product_code');
				if (!$prod_code) redirect ("dist/shop_dist");
				$data['update_details'] = $this->update_info_model->get_prod_update_details($prod_code);		
				$this->load->view('distributor/show_product_out', $data);
			} else {
				$this->no_cache();
				$data['user'] = $is_logged_in;
				$this->load->model('administrator/admin_model');
				$this->load->library('javascript');
				$userid = $this->session->userdata('user');
				
				$this->load->model('distributor/check_dist_model');
				$data['info'] = $this->check_dist_model->get_info($userid);

				$this->load->model('distributor/dist_model');
				$data['sql2'] = $this->dist_model->viewAll_prod_rand();
				$data['flag'] = $data['sql2'];
				
				$this->load->model('distributor/update_info_model'); 
				$prod_code = $this->input->post('product_code');
				if (!$prod_code) redirect ("dist/shop_dist");
				$data['update_details'] = $this->update_info_model->get_prod_update_details($prod_code);		
				$this->load->view('distributor/show_product', $data);
			}
				
		}
		public function login($message=''){
			$is_logged_in = $this->is_logged_in();
			$this->no_cache();
			if( $is_logged_in ){
				redirect('distributor/dist_index', 'refresh');
			} else {
				$this->load->view('distributor/login');
			}
			
			}
		

		public function check_dist(){

			$this->load->model('distributor/check_dist_model');
			
			$user_count = $this->check_dist_model->check_username();
			$email = $this->input->post('uname');
			
			if( $user_count != 1 ){
				echo "Username does not exist!";
			} else {
				$pass_count = $this->check_dist_model->check_password();
				
				if( $pass_count != 1 ){
					echo "Password does not match with the email address!";
				} else {
					$this->session->set_userdata('user', $email);
					echo "1";
				}
			}
		}

		
	public function logout()
		{

			$this->session->sess_destroy();
			redirect('dist/index');
		}

		public function add_to_cart(){

			$product_code = $this->input->post('product_code');
			$prod_name = $this->input->post('prod_name');
			$dist_price = $this->input->post('dist_price');
			$quantity = $this->input->post('quantity');

			$cart_data = array(
				'id' => $product_code,
				'qty' => $quantity,
				'price' => $dist_price,
				'name' => $prod_name,
			);

			$this->cart->insert($cart_data);

			redirect('dist/cart');

		}

		function remove($rowid) {
		// Check rowid value.
			
			if ($rowid==="all"){
			// Destroy data which store in session.
			$this->cart->destroy();
			}else{
			$rowid = $this->input->post('rowid');
			// Destroy selected rowid in session.
			$data = array(
			'rowid' => $rowid,
			'qty' => 0,
			);
			// Update cart data, after cancel.
			$this->cart->update($data);
			}

			// This will show cancel data in cart.
			redirect('dist/cart');
		}

		function update_cart(){

			$rowid = $this->input->post('rowid');
			$quantity = $this->input->post('quantity');

			$data=array(
		        'rowid'=> $rowid,
		        'qty'=> $quantity,
	    	);

		    $this->cart->update($data);  

		    redirect('dist/cart');
		}

		public function place_order_execution(){

	       	$this->load->model('distributor/dist_model'); 
			$lfsi_id = $this->input->post('lfsi_id');
			$status = $this->input->post('status');
			$order_total = $this->input->post('order_total');
			
			$order_data = array (
				'lfsi_id' => $lfsi_id,
				'order_total' => $order_total,
				'status' => $status,

			);

			$new_order_id = $this->dist_model->add_order($order_data);
			$order_items = $this->input->post('order_items');
			$all_items = array ();
			
			for ($i=0; $i < count($order_items); $i++) {

				$entry = array (
					'order_id' => $new_order_id,
					'product_code' => $order_items[$i][0],
					'quantity' => $order_items[$i][1],
					'item_price' => $order_items[$i][2],
				);
				
				if(!in_array($entry, $all_items)){
					array_push($all_items, $entry);
				}
			}

			$this->dist_model->add_order_item($all_items);
			$this->cart->destroy(); 
    	}


		public function dist_cart(){

			$is_logged_in = $this->is_logged_in();
			if( !$is_logged_in ){
				redirect('/dist/login', 'refresh');
			} else {
				$this->no_cache();
				$data['user'] = $is_logged_in;
				$this->load->model('administrator/admin_model');
				$this->load->library('javascript');
				$userid = $this->session->userdata('user');
				$this->load->model('distributor/check_dist_model');
				$this->load->model('distributor/dist_model');
				
				//$this->load->model('distributor/')

				if($this->input->post('search_products')!=''){
					$word = $this->db->escape_str($this->input->post('search'));

					$words = explode(" ", $word);
					$data['sql2'] = array();
					foreach ($words as $keyword) {
						$query_result = $this->dist_model->search_prod($keyword);
						foreach($query_result as $entry){
							if(!in_array($entry, $data['sql2'])){
								array_push($data['sql2'], $entry);
						    }
						}
					}
					$data['flag'] = $data['sql2'];
					if (count($data['sql2']) == 0){
						$data['sql2'] = $this->dist_model->viewAll_prod_rand2();
					}
					$data['cart_info'] = $this->dist_model->view_cart($order_id, $userid);
					$data['info'] = $this->check_dist_model->get_info($userid);	
					$this->load->view('distributor/shop_dist',$data);

				}else{
					$data['sql2'] = $this->dist_model->viewAll_prod_rand2();
					$order_id = '1';
					$data['cart_info'] = $this->dist_model->view_cart($order_id, $userid);
					$data['flag'] = $data['sql2'];
					$data['info'] = $this->check_dist_model->get_info($userid);	
					$this->load->view('distributor/cart', $data);
					
				}
			}

		}

		public function checkout(){

			$is_logged_in = $this->is_logged_in();
			if( !$is_logged_in ){
				redirect('/dist/login', 'refresh');
			} else {
				$this->no_cache();
				$data['user'] = $is_logged_in;
				$this->load->model('administrator/admin_model');
				$this->load->library('javascript');
				$userid = $this->session->userdata('user');
				$this->load->model('distributor/check_dist_model');
				$this->load->model('distributor/dist_model');

				if($this->input->post('search_products')!=''){
					$word = $this->db->escape_str($this->input->post('search'));

					$words = explode(" ", $word);
					$data['sql2'] = array();
					foreach ($words as $keyword) {
						$query_result = $this->dist_model->search_prod($keyword);
						foreach($query_result as $entry){
							if(!in_array($entry, $data['sql2'])){
								array_push($data['sql2'], $entry);
						    }
						}
					}
					$data['flag'] = $data['sql2'];
					if (count($data['sql2']) == 0){
						$data['sql2'] = $this->dist_model->viewAll_prod_rand2();
					}
					$data['info'] = $this->check_dist_model->get_info($userid);	
					$this->load->view('distributor/shop_dist',$data);

				}else{
					$data['sql2'] = $this->dist_model->viewAll_prod_rand2();
					$data['flag'] = $data['sql2'];
					$data['info'] = $this->check_dist_model->get_info($userid);	
					$this->load->view('distributor/checkout', $data);
					
				}
			}

		}

		public function checkout_success(){

			$is_logged_in = $this->is_logged_in();
			if( !$is_logged_in ){
				redirect('/dist/login', 'refresh');
			} else {
				$this->no_cache();
				$data['user'] = $is_logged_in;
				$this->load->model('administrator/admin_model');
				$this->load->library('javascript');
				$userid = $this->session->userdata('user');
				$this->load->model('distributor/check_dist_model');
				$this->load->model('distributor/dist_model');

				if($this->input->post('search_products')!=''){
					$word = $this->db->escape_str($this->input->post('search'));

					$words = explode(" ", $word);
					$data['sql2'] = array();
					foreach ($words as $keyword) {
						$query_result = $this->dist_model->search_prod($keyword);
						foreach($query_result as $entry){
							if(!in_array($entry, $data['sql2'])){
								array_push($data['sql2'], $entry);
						    }
						}
					}
					$data['flag'] = $data['sql2'];
					if (count($data['sql2']) == 0){
						$data['sql2'] = $this->dist_model->viewAll_prod_rand2();
					}
					$data['info'] = $this->check_dist_model->get_info($userid);	
					$this->load->view('distributor/shop_dist',$data);

				}else{
					$data['sql2'] = $this->dist_model->viewAll_prod_rand2();
					$data['flag'] = $data['sql2'];
					$data['info'] = $this->check_dist_model->get_info($userid);	
					$this->load->view('distributor/checkout_success', $data);
					
				}
			}

		}

		public function profile(){

			$is_logged_in = $this->is_logged_in();
			if( !$is_logged_in ){
				redirect('/dist/login', 'refresh');
			} else {
				$this->no_cache();
				$data['user'] = $is_logged_in;
				$this->load->model('distributor/dist_model');
				$this->load->library('javascript');
				$userid = $this->session->userdata('user');
				$this->load->model('distributor/dist_model');
				$data['unr_count'] = $this->dist_model->view_unr_orders_count($userid);

				$data['unr_5'] = $this->dist_model->view_five_unreleased($userid);
				$data['r_5'] = $this->dist_model->view_five_released($userid);
				$data['info'] = $this->check_dist_model->get_info($userid);	
				$this->load->view('distributor/profile.php', $data);
					
				}
			

		}

		public function r_orders(){

			$is_logged_in = $this->is_logged_in();
			if( !$is_logged_in ){
				redirect('/dist/login', 'refresh');
			} else {
				$this->no_cache();
				$data['user'] = $is_logged_in;
				$this->load->model('distributor/dist_model');
				$this->load->library('javascript');
				$userid = $this->session->userdata('user');
				$data['unr_count'] = $this->dist_model->view_unr_orders_count($userid);
				$data['info'] = $this->check_dist_model->get_info($userid);	
				
				if($this->input->post('search_orders')!=''){
					//$filter = $this->input->post('filter');
					$word = $this->db->escape_str($this->input->post('search'));

					$words = explode(" ", $word);
					$data['sql2'] = array();
					foreach ($words as $keyword) {
						$query_result = $this->dist_model->search_orders_r($keyword, $userid);
						foreach($query_result as $entry){
							if(!in_array($entry, $data['sql2'])){
								array_push($data['sql2'], $entry);
						    }
						}
					}
					$data['flag'] = $data['sql2'];
					if (count($data['sql2']) == 0){
						$data['sql2'] = $this->dist_model->viewAll_orders_released($userid);
					}
					$this->load->view('distributor/r_orders',$data);

				}else{
					$data['sql2'] = $this->dist_model->viewAll_orders_released($userid);
					$data['flag'] = $data['sql2'];
					$this->load->view('distributor/r_orders',$data);
				}
			}

		}


		public function unr_orders(){
			$is_logged_in = $this->is_logged_in();
			if( !$is_logged_in ){
				redirect('/dist/login', 'refresh');
			} else {
				$this->no_cache();
				$data['user'] = $is_logged_in;
				$this->load->model('distributor/dist_model');
				$this->load->library('javascript');
				$userid = $this->session->userdata('user');
				$data['unr_count'] = $this->dist_model->view_unr_orders_count($userid);
				$data['info'] = $this->check_dist_model->get_info($userid);	
				
				if($this->input->post('search_orders')!=''){
					//$filter = $this->input->post('filter');
					$word = $this->db->escape_str($this->input->post('search'));

					$words = explode(" ", $word);
					$data['sql2'] = array();
					foreach ($words as $keyword) {
						$query_result = $this->dist_model->search_orders_unr($keyword, $userid);
						foreach($query_result as $entry){
							if(!in_array($entry, $data['sql2'])){
								array_push($data['sql2'], $entry);
						    }
						}
					}
					$data['flag'] = $data['sql2'];
					if (count($data['sql2']) == 0){
						$data['sql2'] = $this->dist_model->viewAll_orders_unreleased($userid);
					}
					$this->load->view('distributor/unr_orders',$data);

				}else{
					$data['sql2'] = $this->dist_model->viewAll_orders_unreleased($userid);
					$data['flag'] = $data['sql2'];
					$this->load->view('distributor/unr_orders',$data);
				}
			}
		}

		public function view_orders_unreleased(){

			$is_logged_in = $this->is_logged_in();
			if( !$is_logged_in ){
				redirect('/dist/login', 'refresh');
			} else {
				$this->no_cache();
				$data['user'] = $is_logged_in;
				$this->load->model('distributor/dist_model');
				$this->load->library('javascript');
				$userid = $this->session->userdata('user');
				$data['unr_count'] = $this->dist_model->view_unr_orders_count($userid);
				$data['info'] = $this->check_dist_model->get_info($userid);	
				
				$this->load->model('distributor/update_info_model'); 
				$order_id = $this->input->post('order_id');
				$lfsi_id = $this->input->post('lfsi_id');
				//$product_code = $this->input->post('product_code');
				$data['update_details'] = $this->update_info_model->get_order_details_unreleased($order_id, $lfsi_id/*, $product_code*/);		
				$this->load->view('distributor/view_orders_unr', $data);
			}
		}

		public function view_orders_released(){

			$is_logged_in = $this->is_logged_in();
			if( !$is_logged_in ){
				redirect('/dist/login', 'refresh');
			} else {
				$this->no_cache();
				$data['user'] = $is_logged_in;
				$this->load->model('distributor/dist_model');
				$this->load->library('javascript');
				$userid = $this->session->userdata('user');
				$data['unr_count'] = $this->dist_model->view_unr_orders_count($userid);
				$data['info'] = $this->check_dist_model->get_info($userid);	
				
				$this->load->model('distributor/update_info_model'); 
				$order_id = $this->input->post('order_id');
				$lfsi_id = $this->input->post('lfsi_id');
				//$product_code = $this->input->post('product_code');
				$data['update_details'] = $this->update_info_model->get_order_details_released($order_id, $lfsi_id/*, $product_code*/);		
				$this->load->view('distributor/view_orders_r', $data);
			}


		}



		public function update_billing(){

			$is_logged_in = $this->is_logged_in();
			if( !$is_logged_in ){
				redirect('/dist/login', 'refresh');
			} else {
				$this->no_cache();
				$data['user'] = $is_logged_in;
				$this->load->model('distributor/dist_model');
				$this->load->library('javascript');
				$userid = $this->session->userdata('user');

				//$data['unr_5'] = $this->dist_model->view_five_unreleased($userid);
				//$data['r_5'] = $this->dist_model->view_five_released($userid);
				$data['info'] = $this->check_dist_model->get_info($userid);	
				$this->load->view('distributor/update_billing.php', $data);
					
				}
			

		}

		public function update_login(){

			$is_logged_in = $this->is_logged_in();
			if( !$is_logged_in ){
				redirect('/dist/login', 'refresh');
			} else {
				$this->no_cache();
				$data['user'] = $is_logged_in;
				$this->load->model('distributor/dist_model');
				$this->load->library('javascript');
				$userid = $this->session->userdata('user');

				$data['info'] = $this->check_dist_model->get_info($userid);	
				$this->load->view('distributor/update_login.php', $data);
					
				}
			

		}

		public function update_billing_execution(){
			// loads the model php file which will interact with the database
	       	$this->load->model('distributor/dist_model'); 
			$lfsi_id = $this->input->post('lfsi_id');
			$address = $this->input->post('address');
			$contact_num = $this->input->post('contact_num');
			
			$billing_data = array (
				'address' => $address,
				'contact_num' => $contact_num,
			);

			$this->dist_model->update_billing($billing_data, $lfsi_id);

    	}

    	public function update_login_execution(){
			// loads the model php file which will interact with the database
	       	$this->load->model('distributor/dist_model'); 
			$lfsi_id = $this->input->post('lfsi_id');
			$email_add = $this->input->post('email_add');
			$password = SHA1($this->input->post('password'));
			
			
			$login_data = array (
				'email_add' => $email_add,
				'password' => $password,
			);

			$this->dist_model->update_login($login_data, $lfsi_id);

			//$this->logout();

    	}

    	public function print_order(){
			$is_logged_in = $this->is_logged_in();
			if( !$is_logged_in ){
				redirect('/dist/login', 'refresh');
			} else {
				// loads the model php file which will interact with the database
				$lfsi_id = $this->input->post('lfsi_id');
				$order_id = $this->input->post('order_id');
				$this->load->model('distributor/print_order_model');

				$data['order_list'] = $this->print_order_model->get_order_array($order_id, $lfsi_id);

				$this->load->view('distributor/print_order_form', $data);	
			}
		}

		public function contact(){

			$is_logged_in = $this->is_logged_in();
			if( !$is_logged_in ){
				$this->load->view('distributor/contact_unreg');
			} else {
				$this->no_cache();
				$data['user'] = $is_logged_in;
				$userid = $this->session->userdata('user');
				
				$this->load->model('distributor/check_dist_model');
				$data['info'] = $this->check_dist_model->get_info($userid);
				$this->load->view('distributor/contact_reg', $data);
			}

		}

		public function signup(){

			$this->load->view('distributor/signup.php');

		}

		public function checkpassword(){
			if(!$this->is_logged_in()){
				$this->load->library('form_validation');
				//field name, error message, validation rules
				
				$this->form_validation->set_rules('password', 'Password',
					'trim|alpha_numeric|required|min_length[6]|max_length[32]');
				
				if($this->form_validation->run() == FALSE){
					echo "1";
				}
				else{
					echo "0";
				}
			}

			else redirect('dist/dist_index', 'refresh');
		}

			public function checkemail(){

				if(!$this->is_logged_in()){
					$this->load->library('form_validation');
					//field name, error message, validation rules
					$email = $this->input->post('email');
					//$this->form_validation->set_rules('email','Email',
					//	'trim|required|valid_email|max_length[50]');
						
						//if($this->form_validation->run() == FALSE){
						//	echo '1';
						//}
						//else {
							$this->load->model('distributor/registration_model');
							$in_user = $this->registration_model->check_email_user($email);
							if($in_user[0]->count == 1){
								echo '2';
							}
							else{
								echo $in_user[0]->count;
							}
						//}
				}

				else redirect('borrower/home', 'refresh');

			}

			public function checklfsi_id(){
				if(!$this->is_logged_in()){
					$lfsi_id = $this->input->post('lfsi_id');		//store the result into the variable idnumber
					$this->load->library('form_validation');		//loads the library that validates the form
					//field name, error message, validation rules
					
					//$this->form_validation->set_rules('lfsi_id','LFSIID', 'trim|required|max_length[10]|xss_clean|callback_lfsiid_check');		//sets the rules for the validation form

					//if($this->form_validation->run() == FALSE){		//something is wrong with the validation
					//	echo '3';
					//}
					//else{
						$this->load->model('distributor/registration_model');		//loads the model of the registration
						$in_user = $this->registration_model->checklfsi_id($lfsi_id);		//store the result from the function
						$in_dist = $this->registration_model->checklfsi_id_dist($lfsi_id);
						if($in_user[0]->count == 1){
							echo '1';
						}
						else if($in_dist[0]->count == 0){
							echo '2';
						}
						else{
							echo '0';
						}
				//}

				}else redirect('dist/dist_index', 'refresh');
				
		}

		public function lfsiid_check($str)
			{
				if(!$this->is_logged_in()){
					if(preg_match( '/(^\D{1}\d{1}-\d{7}$)/' ,$str)){
						return TRUE;
						}
					else{
						$this->form_validation->set_message('lfsiid_check','Invalid id number.');
						return FALSE;
						}
				}else redirect('dist/dist_index', 'refresh');
			}

		public function registration(){
			if(!$this->is_logged_in()){
				$this->load->model('distributor/verification_model');

				$email = $this->input->post('email');
				$lfsi_id = $this->input->post('lfsi_id');
				$password = SHA1($this->input->post('password'));
				$onlife_status = $this->input->post('onlife_status');

				$signup_data = array (
					'lfsi_id' => $lfsi_id,
					'email_add' => $email,
					'onlife_status' => $onlife_status,
					'password' => $password,
				);

				$this->verification_model->add_account($signup_data, $lfsi_id);

				/*if($this->verification_model->send_verification_email($lfsi_id, $email, $password)){
					$this->verification_model->insert_user( $email, $lfsi_id, $password );
					echo "sent";
				}
				else echo "failed";*/
			}else redirect('dist/dist_index', 'refresh');
		}

		/*public function validate_email($lfsi_id, $verification_code){
			if(!$this->is_logged_in()){
					$this->load->model('distributor/verification_model');
					
					$validated = $this->verification_model->validate_email($lfsi_id, $verification_code);
					
					if($validated === true){
						//echo 'YOUR ACCOUNT HAS BEEN VERIFIED YEY';
						$this->login('verified');
					}
					else{
						$this->login('done');
					}
			}else redirect('dist/dist_index', 'refresh');
		}*/

		public function update_profile(){

			$this->load->view('customer/update_profile.php');

		}

		public function no_cache(){
			$this->output->set_header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT');
			$this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate');
			$this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate, no-transform, max-age=0, post-check=0, pre-check=0");
			$this->output->set_header('Pragma: no-cache');
		}

		public function is_logged_in(){
			$this->load->model("distributor/check_dist_model");
			$user = $this->session->userdata('user');
			$is_valid = $this->check_dist_model->check_session_validity($user);
			
			if($is_valid){
				return true;
			}
			else{
				$this->session->sess_destroy();
				return false;
			}
		}

	}



?>