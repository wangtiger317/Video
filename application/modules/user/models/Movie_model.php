<?php
class Movie_model extends CI_Model {
	function __construct(){            
	  	parent::__construct();
        $this->load->database();
	}
    public function get_all_movies(){
        $movies = $this->db->get('movies');
        return $movies->result();
    }

    public function get_movie_by_id($id=""){
        $this->db->where('id', $id);
        $quiz = $this->db->get('movies');
        return $quiz->result();
    }

    function delete($id='') {
        $this->db->where('id', $id);
        $this->db->delete('movies');
    }

    /**
     * This function is used to Insert record in table
     */
    public function insertRow($table, $data){
        $this->db->insert($table, $data);
        return  $this->db->insert_id();
    }

    /**
     * This function is used to Update record in table
     */
    public function updateRow($table, $col, $colVal, $data) {
        $this->db->where($col,$colVal);
        $this->db->update($table,$data);
        return true;
    }

    public function get_cover_video(){
        $movies = $this->db->get('cover_video');
        return $movies->result();
    }

    public function update_cover_video($data){
        $this->db->where('id', 1);
        $this->db->update('cover_video', $data);
        return true;
    }

    public function get_logo(){
        $movies = $this->db->get('logo_image');
        return $movies->result();
    }

    public function update_logo($data){
        $this->db->where('id', 1);
        $this->db->update('logo_image', $data);
        return true;
    }

    public function get_banner(){
        $this->db->where('id', 1);
        $movies = $this->db->get('banner_image');
        return $movies->result();
    }

    public function update_banner($data){
        $this->db->where('id', 1);
        $this->db->update('banner_image', $data);
        return true;
    }

}
