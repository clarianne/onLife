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

	    public function viewAll_dist(){
		$this->load->database();

		$query = $this->db->query("SELECT l.lfsi_id, l.fname, l.lname, l.address, l.contact_num, l.email_add FROM distributor l ORDER BY l.lfsi_id");

		return $query->result(); 

		}

        public function viewAll_prod(){
        $this->load->database();

        $query = $this->db->query("SELECT p.product_code, p.prod_name, p.prod_category, p.dist_price, p.ret_price, p.prod_desc FROM product p GROUP BY p.prod_category ORDER BY p.product_code");

        return $query->result(); 

        }

	   // public function search($filter, $type, $word, $access, $avail){
	    public function search_dist($word){
		$this->load->database();
		// $access2=0;
        //if($access==1 || $access==2) {$access2=4;}
        $sql = "SELECT l.lfsi_id, l.fname, l.lname, l.address, l.contact_num, l.email_add FROM distributor l ORDER BY l.lfsi_id";
        //$sql = $sql." GROUP BY a.materialid ORDER BY l.name";
        //echo $sql;
        $query = $this->db->query($sql);
       // var_dump($query);
        return $query->result();
		}

        public function search_prod($word){
        $this->load->database();
        // $access2=0;
        //if($access==1 || $access==2) {$access2=4;}
        $sql = "SELECT p.product_code, p.prod_name, p.prod_category, p.dist_price, p.ret_price, p.prod_desc FROM product p GROUP BY p.prod_category ORDER BY p.product_code";
        //$sql = $sql." GROUP BY a.materialid ORDER BY l.name";
        //echo $sql;
        $query = $this->db->query($sql);
       // var_dump($query);
        return $query->result();
        }

        public function dist_update($distributor_updated_data, $previous_lfsiid){
       // $this->load->database();
        //$lfsi_id = $this->db->escape_like_str($previous_lfsiid);

        $this->db->where('lfsi_id', $previous_lfsiid);
        $this->db->update('distributor', $distributor_updated_data);
      //  $this->db->where('lfsi_id', $library_material_data['lfsi_id']);
        
    }
		
		public function book_delete($data){
			$this->load->database();
			//$this->db->delete("librarymaterial",$data);
			$this->db->delete("librarymaterial","materialid = '". $data."'");
		}

	}

?>