<?php

if ( ! defined('BASEPATH')) redirect(base_url());

class Reviews_model extends CI_model {
    
    function __construct()
    {
        parent::__construct();
    }
    
    public function getLastReviews($limit) {
        $this->db->cache_on();

        $query = $this->db->query("SELECT * FROM `reviews` ORDER BY `id` DESC LIMIT ?", array($limit)); 

        if($query->num_rows()) return $query->result();
        else return false;
    }


    public function getLastReviewsByUser($limit, $id) {
        $this->db->cache_on();

        $query = $this->db->query("SELECT * FROM `reviews` WHERE `clientID` = ? ORDER BY `id` DESC LIMIT ?", array($id, $limit)); 

        if($query->num_rows()) return $query->result();
        else return false;
    }

    

}