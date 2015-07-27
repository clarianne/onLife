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
		
		public function book_delete($data){
			$this->load->database();
			//$this->db->delete("librarymaterial",$data);
			$this->db->delete("librarymaterial","materialid = '". $data."'");
		}

	}

?>