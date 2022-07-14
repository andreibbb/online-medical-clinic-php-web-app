<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main_model extends CI_model {

    function __construct()
    {
        parent::__construct();
    }
    
    public function getNews() {
        $query = $this->db->query("SELECT * FROM `news` ORDER BY `id` DESC LIMIT 3");
        
        if($query->num_rows()) return $query->result();
        else return false;
    }

    public function getFutureAppointments($clientID) {
        $this->db->cache_on();
        $query = $this->db->query("SELECT * FROM appointments WHERE clientid = ? AND `date` >= ? LIMIT 1", array($clientID, date('m/d/Y', strtotime('-1 days')))); 

        if($query->num_rows()) return $query->result()[0];
        else return false;
    }

    public function getLoggedInLast24Hours() {
    	$this->db->cache_on();
        $query = $this->db->query("SELECT COUNT(id) as nrlogati24 FROM `users` WHERE last_login >= ?", array(date('Y-m-d H:i:s', strtotime('-1 days')))); 

        if($query->num_rows()) return $query->result()[0]->nrlogati24;
        else return false;
    }

    public function createdAccounts() {
    	$this->db->cache_on();
        $query = $this->db->query("SELECT COUNT(id) as total_users FROM `users`"); 

        if($query->num_rows()) return $query->result()[0]->total_users;
        else return false;
    }

   public function getAppointmentsInLast($last) {
    	$this->db->cache_on();
        $query = $this->db->query("SELECT COUNT(id) as appointmentslast FROM `appointments` WHERE `requested_time` >= ?", array(date('Y-m-d H:i:s', $last))); 

        if($query->num_rows()) return $query->result()[0]->appointmentslast;
        else return false;
    }


    public function numberOfDoctors() {
    	$this->db->cache_on();
        $query = $this->db->query("SELECT COUNT(id) as createdaccs FROM `users` WHERE `doctor` > 0"); 

        if($query->num_rows()) return $query->result()[0]->createdaccs;
        else return false;
    }
    
}