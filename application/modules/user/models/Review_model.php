<?php
class Review_model extends CI_Model {
	function __construct(){            
	  	parent::__construct();
        $this->load->database();
	}
    public function get_all_reviews(){
        $reviews = $this->db->get('reviews');
        return $reviews->result();
    }
    public function get_reviews($id=""){
        $this->db->where('movie_id', $id);
        $reviews = $this->db->get('reviews');
        return $reviews->result();
    }
    public function insertRow($table, $data){
        $this->db->insert($table, $data);
        return  $this->db->insert_id();
    }

}
