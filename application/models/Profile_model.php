<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Profile_model extends CI_model {

    function __construct()
    {
        parent::__construct();
    }

    public function getProfileData($id, $data = "*, NULL AS password") {
        $this->db->cache_on();
        $query = $this->db->query("SELECT " . $data . " FROM `users` WHERE id = ? LIMIT 1", array($id));
        $result = $query->result_array();
        return $result;
    }   

    public function getLoggedData($id, $data = "*, NULL AS password") {
        $this->db->cache_on();
        $query = $this->db->query("SELECT " . $data . " FROM `users` WHERE id = ? LIMIT 1", array($id));
        $result = $query->result();
        return $result;
    }   
    

    public function getFutureAppointments($clientID) {
        $this->db->cache_on();
        $query = $this->db->query("SELECT * FROM appointments WHERE clientid = ? AND `date` >= ? LIMIT 1", array($clientID, date('m/d/Y', strtotime('-1 days')))); 

        if($query->num_rows()) return $query->result()[0];
        else return false;
    }
}