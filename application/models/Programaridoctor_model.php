<?php

if ( ! defined('BASEPATH')) redirect(base_url());

class Programaridoctor_model extends CI_model {
    
    function __construct()
    {
        parent::__construct();
    }
    
    public function getTodayAppointments($doctorID) {
        $this->db->cache_on();

        $query = $this->db->query("SELECT * FROM appointments WHERE doctorid = ? AND `date` = ? AND `verified` = 1  ORDER BY `confirmed_hour` ASC", array($doctorID, date('m/d/Y'))); 

        if($query->num_rows()) return $query->result();
        else return false;
    }

    public function getYesterdayAppointments($doctorID) {
        $this->db->cache_on();

        $query = $this->db->query("SELECT * FROM appointments WHERE doctorid = ? AND `date` = ? AND `verified` = 1  ORDER BY `confirmed_hour` ASC", array($doctorID, date('m/d/Y', strtotime("-1 days")))); 

        if($query->num_rows()) return $query->result();
        else return false;
    }
    

    public function getFutureAppointments($doctorID) {
        $this->db->cache_on();

        $query = $this->db->query("SELECT * FROM appointments WHERE doctorid = ? AND `date` > ? AND `verified` = 1 ORDER BY `date` ASC, `confirmed_hour` ASC LIMIT 40", array($doctorID, date('m/d/Y'))); 

        if($query->num_rows()) return $query->result();
        else return false;
    }

    public function getUserInfo($patientID) {
        $this->db->cache_on();

        $query = $this->db->query("SELECT id, nume, prenume, phone, picture_path, born_date, location FROM users WHERE id = ? LIMIT 1", array($patientID)); 

        if($query->num_rows()) return $query->result();
        else return false;
    }

    
    public function getAppointmentDetails($appointmentID) {

        $query = $this->db->query("SELECT * FROM appointments_results WHERE appointmentID = ? ORDER BY `id` DESC LIMIT 1", array($appointmentID)); 

        if($query->num_rows()) return $query->result()[0];
        else return false;
    }

    public function getAppointmentDoctor($appointmentID) { 

        $query = $this->db->query("SELECT `doctorid` FROM appointments WHERE id = ? ORDER BY `id` DESC LIMIT 1", array($appointmentID)); 

        if($query->num_rows()) return $query->result()[0]->doctorid;
        else return false;
    }    


}
