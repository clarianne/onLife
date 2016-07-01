<?php

	class Admin_model extends CI_Model{

		public function dist_add($dist_data){
        $this->load->database();
        $this->db->insert("distributor", $dist_data); 
        //$this->db->insert_batch("author",$all_authors); 
	    }

	    public function prod_add($prod_data){

	    	$this->load->database();
	    	$this->db->insert("product", $prod_data);

	    }

	    public function viewAll_dist_activated(){
		$this->load->database();

		$query = $this->db->query("SELECT l.lfsi_id, l.fname, l.lname, l.address, l.contact_num FROM distributor l WHERE l.dist_status = 'ACTIVATED' ORDER BY l.lfsi_id");

		return $query->result(); 

		}

        public function viewAll_dist_deactivated(){
        $this->load->database();

        $query = $this->db->query("SELECT l.lfsi_id, l.fname, l.lname, l.address, l.contact_num FROM distributor l WHERE l.dist_status = 'DEACTIVATED' ORDER BY l.lfsi_id");

        return $query->result(); 

        }

        public function viewAll_prod_avail(){
        $this->load->database();

        $query = $this->db->query("SELECT p.product_code, p.prod_name, p.prod_category, p.dist_price, p.ret_price, p.prod_desc FROM product p WHERE p.prod_avail = 'AVAILABLE' ORDER BY p.product_code");

        return $query->result(); 

        }

        public function viewAll_prod_notavail(){
        $this->load->database();

        $query = $this->db->query("SELECT p.product_code, p.prod_name, p.prod_category, p.dist_price, p.ret_price, p.prod_desc FROM product p WHERE p.prod_avail = 'NOT AVAILABLE' ORDER BY p.product_code");

        return $query->result(); 

        }

        public function viewAll_orders_unreleased(){
            $this->load->database();

            $query = $this->db->query("SELECT * FROM `order` WHERE status ='UNRELEASED' ORDER BY order_date ASC");

            return $query->result();   
        }

        public function view_unr_orders_count(){
            $this->load->database();

            $query = $this->db->query("SELECT * FROM `order` WHERE status ='UNRELEASED'");

            return $query->num_rows();

        }

        public function viewAll_orders_released(){
            $this->load->database();

            $query = $this->db->query("SELECT * FROM `order` WHERE status ='RELEASED' ORDER BY order_date DESC");

            return $query->result();
        }

        //  SEARCH (PRODUCT, DISTRIBUTOR, ORDER)

        public function search_prod_avail($word){
            $this->load->database();
            $sql = "SELECT p.product_code, p.prod_name, p.prod_category, p.dist_price, p.ret_price, p.prod_desc FROM product p WHERE p.prod_avail = 'AVAILABLE'";

            if($word!=''){
                
                $sql=$sql." AND (p.product_code like '%$word%'
                                OR p.prod_name like '%$word%'
                                OR p.prod_category like '%$word%'
                                OR p.dist_price like '%$word%'
                                OR p.ret_price like '%$word%'
                                OR p.prod_desc like '%$word%')";
            }

            $sql = $sql."  GROUP BY p.prod_category ORDER BY p.product_code";

            $query = $this->db->query($sql);
            return $query->result();
        }

        public function search_prod_notavail($word){
            $this->load->database();
            $sql = "SELECT p.product_code, p.prod_name, p.prod_category, p.dist_price, p.ret_price, p.prod_desc FROM product p WHERE p.prod_avail = 'NOT AVAILABLE'";

            if($word!=''){
                
                $sql=$sql." AND (p.product_code like '%$word%'
                                OR p.prod_name like '%$word%'
                                OR p.prod_category like '%$word%'
                                OR p.dist_price like '%$word%'
                                OR p.ret_price like '%$word%'
                                OR p.prod_desc like '%$word%')";
            }

            $sql = $sql."  GROUP BY p.prod_category ORDER BY p.product_code";

            $query = $this->db->query($sql);
            return $query->result();
        }


        public function search_dist_activated($word){
            $this->load->database();
            $sql = "SELECT l.lfsi_id, l.fname, l.lname, l.address, l.contact_num FROM distributor l WHERE l.dist_status = 'ACTIVATED'";

            if($word!=''){
                
                $sql=$sql." AND (l.lfsi_id like '%$word%'
                                OR l.fname like '%$word%'
                                OR l.lname like '%$word%'
                                OR l.address like '%$word%'
                                OR l.contact_num like '%$word%'
                                )";
            }

            $sql = $sql."  ORDER BY l.lfsi_id";

            $query = $this->db->query($sql);
            return $query->result();
        }

        public function search_dist_deactivated($word){
            $this->load->database();
            $sql = "SELECT l.lfsi_id, l.fname, l.lname, l.address, l.contact_num FROM distributor l WHERE l.dist_status = 'DEACTIVATED'";

            if($word!=''){
                
                $sql=$sql." AND (l.lfsi_id like '%$word%'
                                OR l.fname like '%$word%'
                                OR l.lname like '%$word%'
                                OR l.address like '%$word%'
                                OR l.contact_num like '%$word%'
                                )";
            }

            $sql = $sql."  ORDER BY l.lfsi_id";

            $query = $this->db->query($sql);
            return $query->result();
        }

        public function search_orders_r($word){
            $this->load->database();
            $sql = "SELECT * FROM `order` WHERE status ='RELEASED'";

            if($word!=''){
                
                $sql=$sql." AND (order_id like '%$word%'
                                OR lfsi_id like '%$word%'
                                OR order_date like '%$word%'
                                OR release_date like '%$word%'
                                )";
            }

            $sql = $sql."  ORDER BY order_date DESC";

            $query = $this->db->query($sql);
            return $query->result();
        }

        public function search_orders_unr($word){
            $this->load->database();
            $sql = "SELECT * FROM `order` WHERE status ='UNRELEASED'";

            if($word!=''){
                
                $sql=$sql." AND (order_id like '%$word%'
                                OR lfsi_id like '%$word%'
                                OR order_date like '%$word%'
                                )";
            }

            $sql = $sql."  ORDER BY order_date DESC";

            $query = $this->db->query($sql);
            return $query->result();
        }


        // update

        public function dist_update($distributor_updated_data, $previous_lfsiid){
        $this->load->database();
        //$lfsi_id = $this->db->escape_like_str($previous_lfsiid);

        $this->db->where('lfsi_id', $previous_lfsiid);
        $this->db->update('distributor', $distributor_updated_data);
        
        }

        public function prod_update($product_updated_data, $previous_prodcode){
        $this->load->database();
        //$prod_code = $this->db->escape_like_str($previous_prodcode);

        $this->db->where('product_code', $previous_prodcode);
        $this->db->update('product', $product_updated_data);
        
        }

        public function order_update($released_order_data, $order_id){
        $this->load->database();
        //$prod_code = $this->db->escape_like_str($previous_prodcode);

        $this->db->where('order_id', $order_id);
        $this->db->update('order', $released_order_data);
        
        }

        public function release_update($order_id){
            $this->load->database();

            $stmt = "UPDATE `order` SET `release_date` = NOW() 
                        WHERE `order_id`= '$order_id'";

            $query = $this->db->query($stmt);
            return true;
        }

        public function view_five_unreleased(){
            $this->load->database();

            $query = $this->db->query("SELECT order.order_id, order.order_date, distributor.fname, distributor.lname FROM `order`, distributor WHERE order.lfsi_id = distributor.lfsi_id AND order.status = 'UNRELEASED' ORDER BY order.order_date DESC LIMIT 15");

            return $query->result();
        }

        public function view_five_released(){
            $this->load->database();

            $query = $this->db->query("SELECT order.order_id, order.order_date, distributor.fname, distributor.lname, order.release_date FROM `order`, distributor WHERE order.lfsi_id = distributor.lfsi_id AND order.status ='RELEASED' ORDER BY order.release_date ASC LIMIT 15");

            return $query->result();
        }

	}

?>