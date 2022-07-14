<?php

if ( ! defined('BASEPATH')) redirect(base_url());

class Programari_model extends CI_model {
    
    function __construct()
    {
        parent::__construct();
    }
    
    public function getDoctorInfo($doctorID) {
        $this->db->cache_on();

        $query = $this->db->query("SELECT id, nume, prenume, phone, picture_path, languages, born_date, location, doctor_type1, doctor_type2, doctor_type3, doctor_type4, rating_value, rating_number FROM users WHERE `doctor` = 1 AND id = ? LIMIT 1", array($doctorID)); 

        if($query->num_rows()) return $query->result();
        else return false;
    }

    public function getPatientInfo($patientID) {
        $this->db->cache_on();

        $query = $this->db->query("SELECT id, nume, prenume, phone, picture_path, born_date, location, doctor FROM users WHERE id = ? LIMIT 1", array($patientID)); 

        if($query->num_rows()) return $query->result();
        else return false;
    }

    public function sendAppointment($userID, $doctorID, $choicedDate, $choicedHour, $contactOption, $moreInformations) {
        $query = $this->db->query("INSERT INTO `appointments` (`clientid`, `doctorid`, `date`, `hour`, `more_info`, `contactoption`, `requested_time`) VALUES (?, ?, ?, ?, ?, ?, ?);", array($userID, $doctorID, $choicedDate, $choicedHour, $moreInformations, $contactOption, date('Y-m-d H:i:s')));

        if($query) return true;
        else return false;
    }

    public function getAppointmentDetails($appointmentID) {
        $this->db->cache_on();

        $query = $this->db->query("SELECT * FROM `appointments_results` WHERE `appointmentID` = ? ORDER BY `id` DESC LIMIT 1", array($appointmentID)); 

        if($query->num_rows()) return $query->result()[0];
        else return false;
    }

    public function getFutureAppointments($clientID) {
        $this->db->cache_on();

        $query = $this->db->query("SELECT * FROM appointments WHERE clientid = ? AND `date` >= ?  ORDER BY `date` ASC", array($clientID, date('m/d/Y'))); 

        if($query->num_rows()) return $query->result();
        else return false;
    }

    public function getAppointment($appointmentID) {
        $this->db->cache_on();

        $query = $this->db->query("SELECT * FROM appointments WHERE id = ? LIMIT 1", array($appointmentID)); 

        if($query->num_rows()) return $query->result()[0];
        else return false;
    }

    public function getOldAppointments($clientID) {
        $this->db->cache_on();

        $query = $this->db->query("SELECT * FROM appointments WHERE clientid = ? AND `date` <= ? ORDER BY `date` DESC LIMIT 20", array($clientID, date('m/d/Y', strtotime('-1 days')))); 

        if($query->num_rows()) return $query->result();
        else return false;
    }

    public function updateDoctorRating($ratingNumber, $doctorID) {
        $query = $this->db->query("UPDATE `users` SET rating_value = rating_value + ?, rating_number = rating_number + 1 WHERE id = ?", array($ratingNumber, $doctorID));
    }

    public function insertIntoReviews($doctorID, $clientID, $text, $ratingValue) {
        $query = $this->db->query("INSERT INTO `reviews` (`doctorID`, `clientID`, `text`, `ratingValue`, `addedDate`) VALUES (?, ?, ?, ?, ?)", array($doctorID, $clientID, $text, $ratingValue, date('Y-m-d H:i:s')));
    }

    public function updateReviewedAppointment($appointmentID) {
        $query = $this->db->query("UPDATE `appointments` SET `reviewed` = 1 WHERE id = ?", array($appointmentID));
    }

    public function getTotalAppointments() {
        $this->db->cache_on();
        $query = $this->db->query("SELECT COUNT(id) AS TOTAL FROM `appointments`");
        
        if($query->num_rows()) return $query->result()[0]->TOTAL;
        else return false;
    }
    
    public function getAllAppointments($limit_per_page, $start_index) {
        $this->db->cache_on();

        $query = $this->db->query("SELECT * FROM `appointments` ORDER BY `verified` ASC, `id` DESC LIMIT $start_index, $limit_per_page"); 
        if($query->num_rows()) return $query->result();
        else return false;
    }

    public function getWorkingTime() {
        $this->db->cache_on();
        $query = $this->db->query("SELECT * FROM `working_hours`");
        
        if($query->num_rows()) return $query->result();
        else return false;
    }

    public function checkDoctorAvailable($doctor, $date, $string) {
        $string = "%".$string;
        $query = $this->db->query("SELECT `id` FROM `appointments` WHERE `doctorid` = ? AND `date` = ? AND `verified` = 1 AND `confirmed_hour` LIKE ? LIMIT 1", array($doctor, $date, $string));

        if(!$query->num_rows()) return "true";
        else return "false";
    }
}
