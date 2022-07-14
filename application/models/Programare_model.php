<?php

if ( ! defined('BASEPATH')) redirect(base_url());

class Programare_model extends CI_model {
    
    function __construct()
    {
        parent::__construct();
    }
    
    public function getDoctorInfo($doctorID) {
    	$this->db->cache_on();

        $query = $this->db->query("SELECT id, nume, prenume, phone, picture_path, languages, born_date, location, doctor_type1, doctor_type2, doctor_type3, doctor_type4 FROM users WHERE `doctor` = 1 AND id = ? LIMIT 1", array($doctorID)); 

        if($query->num_rows()) return $query->result();
        else return false;
    }

    public function getPatientInfo($patientID) {
    	$this->db->cache_on();
        $query = $this->db->query("SELECT id, nume, prenume, phone, picture_path, born_date, location FROM users WHERE id = ? LIMIT 1", array($patientID)); 

        if($query->num_rows()) return $query->result();
        else return false;
    }

    public function sendAppointment($userID, $doctorID, $choicedDate, $choicedHour, $contactOption, $moreInformations) {
        $query = $this->db->query("INSERT INTO `appointments` (`clientid`, `doctorid`, `date`, `hour`, `more_info`, `contactoption`, `requested_time`) VALUES (?, ?, ?, ?, ?, ?, ?);", array($userID, $doctorID, $choicedDate, $choicedHour, $moreInformations, $contactOption, date('Y-m-d H:i:s')));

        if($query) return true;
        else return false;
    }

    public function getAppointmentsByDate($dID, $hour) {
    	$this->db->cache_on();
        $query = $this->db->query("SELECT COUNT(id) as countapp FROM appointments WHERE doctorID = ? AND hour = ? ORDER BY `id` DESC", array($dID, $hour)); 

        if($query->num_rows()) return $query->result()[0]->countapp;
        else return 0;
    }
}