<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Adminpanel_model extends CI_model {

    function __construct()
    {
        parent::__construct();
    }

    public function getBySearchedData($mail, $nume, $prenume, $phone) {        
        if(strlen($email) > 1 && strlen($phone) > 1 && strlen($nume) > 2 && strlen($prenume) > 2) {            
            $query = $this->db->query("SELECT id, nume, prenume, phone, email, location FROM users WHERE email = ? AND phone = ? AND nume = ? AND prenume = ?", array($mail, $phone, $nume, $prenume));
        }
        elseif(strlen($mail) > 1 && strlen($phone) > 1) {
            $query = $this->db->query("SELECT id, nume, prenume, phone, email, location FROM users WHERE email = ? AND phone = ?", array($mail, $phone));
            
            if($query->num_rows()) return $query;
                else return false;
        }
        else {
            $query = $this->db->query("SELECT id, nume, prenume, phone, email, location FROM users WHERE email = ? OR phone = ? OR nume = ? AND prenume = ?", array($mail, $phone, $nume, $prenume));
        }

        if(!$query->num_rows())
            $query = $this->db->query("SELECT id, nume, prenume, phone, email, location FROM users WHERE email = ? OR phone = ? OR prenume = ? AND nume = ?", array($mail, $phone, $nume, $prenume));

        if($query->num_rows()) return $query;
        else return false;
    }

    public function getWaitingAppointments() {
        $this->db->cache_on();
        $query=$this->db->query("SELECT COUNT(`id`) as waitingAppointments FROM `appointments` WHERE `verified` = 0");

        if($query->num_rows()) return $query->result()[0]->waitingAppointments;
        else return false;
    }
}