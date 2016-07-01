<?php

	class Dist_model extends CI_Model{

        public function viewAll_prod(){
        $this->load->database();

        $query = $this->db->query("SELECT p.product_code, p.prod_name, p.prod_category, p.dist_price, p.ret_price, p.prod_desc FROM product p ORDER BY p.product_code");

        return $query->result(); 

        }

        public function viewAll_prod_rand(){
        $this->load->database();

        $query = $this->db->query("SELECT p.product_code, p.prod_name, p.prod_category, p.dist_price, p.ret_price, p.prod_desc FROM product p ORDER BY RAND() LIMIT 100");

        return $query->result(); 

        }

        public function viewAll_prod_rand2(){
        $this->load->database();

        $query = $this->db->query("SELECT p.product_code, p.prod_name, p.prod_category, p.dist_price, p.ret_price, p.prod_desc FROM product p ORDER BY RAND() LIMIT 2");

        return $query->result(); 

        }

        public function view_cart($order_id, $userid){
        $this->load->database();

        //$query = $this->db->query("SELECT o.order_id, o.order_date, FROM `order` o, `user` u, where o.order_id = '$order_id' AND d.email_address = '$userid'");
        
        //$result = $query->row();

        $query = $this->db->query("SELECT i.product_code, p.prod_name, p.dist_price, i.quantity, i.quantity * p.dist_price as 'item_price' FROM `order_items` i, `product` p, `order` o WHERE o.order_id = '$order_id' AND i.product_code = p.product_code"); 

        //$result->product = $query2->result();

        return $query->result();

        }

        public function search_prod($word){
        $this->load->database();
            $sql = "SELECT p.product_code, p.prod_name, p.prod_category, p.dist_price, p.ret_price, p.prod_desc FROM product p WHERE p.prod_avail = 'AVAILABLE'";

            if($word!=''){
                
                $sql=$sql." AND (p.prod_name like '%$word%'
                                OR p.prod_category like '%$word%'
                                OR p.dist_price like '%$word%'
                                OR p.ret_price like '%$word%'
                                OR p.prod_desc like '%$word%')";
            }

            $sql = $sql."  GROUP BY p.prod_category ORDER BY p.prod_name";

            $query = $this->db->query($sql);
            return $query->result();
        }

        public function add_order($order_data){
            $this->load->database();
            $this->db->set('order_date', 'NOW()', FALSE);
            $this->db->insert("order", $order_data);
            $new_order_id = $this->db->insert_id();

            return $new_order_id;

        }

        public function add_order_item($all_items){
            $this->load->database();
            $this->db->insert_batch("order_items",$all_items);

        }

        public function view_unr_orders_count($userid){
            $this->load->database();

            $query = $this->db->query("SELECT * FROM `order`, user WHERE user.email_add = '${userid}' AND order.lfsi_id = user.lfsi_id AND order.status = 'UNRELEASED'");

            return $query->num_rows();

        }

        public function viewAll_orders_unreleased($userid){
            $this->load->database();

            $query = $this->db->query("SELECT * FROM `order`, user WHERE user.email_add = '${userid}' AND order.lfsi_id = user.lfsi_id AND order.status = 'UNRELEASED' ORDER BY order_date ASC");

            return $query->result();   
        }

        public function viewAll_orders_released($userid){
            $this->load->database();

            $query = $this->db->query("SELECT * FROM `order`, user WHERE user.email_add = '${userid}' AND order.lfsi_id = user.lfsi_id AND order.status ='RELEASED' ORDER BY order_date DESC");

            return $query->result();
        }


        public function search_orders_r($word, $userid){
            $this->load->database();
            $sql = "SELECT * FROM `order`, user WHERE user.email_add = '${userid}' AND order.lfsi_id = user.lfsi_id AND status ='RELEASED'";

            if($word!=''){
                
                $sql=$sql." AND (order_id like '%$word%'
                                )";
            }

            $sql = $sql."  ORDER BY order_date DESC";

            $query = $this->db->query($sql);
            return $query->result();
        }

        public function search_orders_unr($word, $userid){
            $this->load->database();
            $sql = "SELECT * FROM `order`, user WHERE user.email_add = '${userid}' AND order.lfsi_id = user.lfsi_id AND status ='UNRELEASED'";

            if($word!=''){
                
                $sql=$sql." AND (order_id like '%$word%'
                                )";
            }

            $sql = $sql."  ORDER BY order_date DESC";

            $query = $this->db->query($sql);
            return $query->result();
        }
        public function view_five_unreleased($userid){
            $this->load->database();

            $query = $this->db->query("SELECT order.order_id, order.order_date FROM `order`, user WHERE user.email_add = '${userid}' AND order.lfsi_id = user.lfsi_id AND order.status = 'UNRELEASED' ORDER BY order.order_date DESC LIMIT 5");

            return $query->result();
        }

        public function view_five_released($userid){
            $this->load->database();

            $query = $this->db->query("SELECT order.order_id, order.order_date, order.release_date FROM `order`, user WHERE user.email_add = '${userid}' AND order.lfsi_id = user.lfsi_id AND order.status = 'RELEASED' ORDER BY order.order_date ASC LIMIT 5");

            return $query->result();
        }

        public function update_billing($billing_data, $lfsi_id){
        $this->load->database();

        $this->db->where('lfsi_id', $lfsi_id);
        $this->db->update('distributor', $billing_data);
        
        }

        public function update_login($login_data, $lfsi_id){
        $this->load->database();

        $this->db->where('lfsi_id', $lfsi_id);
        $this->db->update('user', $login_data);
        
        }

	}

?>