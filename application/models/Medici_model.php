<?php

if ( ! defined('BASEPATH')) redirect(base_url());

class Medici_model extends CI_model {
    
    function __construct()
    {
        parent::__construct();
    }

    public function getTotalMedics() {
        $this->db->cache_on();
        $query = $this->db->query("SELECT COUNT(id) AS TOTAL FROM users WHERE `doctor` = 1");
        
        if($query->num_rows()) return $query->result()[0]->TOTAL;
        else return false;
    }
    
    public function getAllMedics($limit_per_page, $start_index) {
        $this->db->cache_on();
        
        $query = $this->db->query("SELECT id, nume, prenume, phone, picture_path, languages, doctor_type1, doctor_type2, doctor_type3, doctor_type4, rating_value, rating_number FROM users WHERE `doctor` = 1 ORDER BY `id` ASC LIMIT $start_index, $limit_per_page"); 
        if($query->num_rows()) return $query->result();
        else return false;
    }

    public function getTotalMedicsWithFilters($doctorName = "null", $doctorType = "null") {
        $this->db->cache_on();

        if($doctorName != "null" && $doctorType == "null") {
            $doctorNameArray = explode(" ", $doctorName);
            $query = $this->db->query("SELECT COUNT(id) AS TOTAL FROM users WHERE `doctor` = 1 AND nume = ? AND prenume = ?", array($doctorNameArray[0], $doctorNameArray[1]));
            if($query->result()[0]->TOTAL == 0) {
                $query = $this->db->query("SELECT COUNT(id) AS TOTAL FROM users WHERE `doctor` = 1 AND prenume = ? AND nume = ? ", array($doctorNameArray[0], $doctorNameArray[1]));
            }

        } elseif($doctorName == "null" && $doctorType != "null") {
            $query = $this->db->query("SELECT COUNT(id) AS TOTAL FROM users WHERE `doctor` = 1 AND doctor_type1 = ? OR doctor_type2 = ? OR doctor_type3 = ? OR doctor_type4 = ?", array($doctorType, $doctorType, $doctorType, $doctorType));
        } elseif($doctorName != "null" && $doctorType != "null") {
        	$doctorNameArray = explode(" ", $doctorName);

        	$query = $this->db->query("SELECT COUNT(id) AS TOTAL FROM users WHERE `doctor` = 1  AND nume = ? AND prenume = ? AND doctor_type1 = ? OR doctor_type2 = ? OR doctor_type3 = ? OR doctor_type4 = ?", array($doctorNameArray[0], $doctorNameArray[1], $doctorType, $doctorType, $doctorType, $doctorType));

        	if($query->result()[0]->TOTAL == 0)
        		$query = $this->db->query("SELECT COUNT(id) AS TOTAL FROM users WHERE `doctor` = 1 AND nume = ? AND prenume = ? AND doctor_type1 = ? OR doctor_type2 = ? OR doctor_type3 = ? OR doctor_type4 = ?", array($doctorNameArray[1], $doctorNameArray[0], $doctorType, $doctorType, $doctorType, $doctorType));
        } else {
            $doctorNameArray = explode(" ", $doctorName);	
            $query = $this->db->query("SELECT COUNT(id) AS TOTAL FROM users WHERE `doctor` = 1 AND nume = ? AND prenume = ? AND doctor_type1 = ? OR doctor_type2 = ? OR doctor_type3 = ? OR doctor_type4 = ?", array($doctorNameArray[0], $doctorNameArray[1], $doctorType, $doctorType, $doctorType, $doctorType));

            if(!$query->num_rows())
                $query = $this->db->query("SELECT COUNT(id) AS TOTAL FROM users WHERE `doctor` = 1 AND nume = ? AND prenume = ?  AND doctor_type1 = ? OR doctor_type2 = ? OR doctor_type3 = ? OR doctor_type4 = ?", array($doctorNameArray[1], $doctorNameArray[0], $doctorType, $doctorType, $doctorType, $doctorType));
        }

        if($query->num_rows()) return $query->result()[0]->TOTAL;
        else return false;
    }

    public function getAllMedicsWithFilters($doctorName = "null", $doctorType = "null", $limit_per_page, $start_index) {
        $this->db->cache_on();

        if($doctorName != "null" && $doctorType == "null") {
            $doctorNameArray = explode(" ", $doctorName);

            $query = $this->db->query("SELECT id, nume, prenume, phone, picture_path, languages, doctor_type1, doctor_type2, doctor_type3, doctor_type4, rating_value, rating_number FROM users WHERE `doctor` = 1 AND nume = ? AND prenume = ? ORDER BY `id` ASC LIMIT $start_index, $limit_per_page", array($doctorNameArray[0], $doctorNameArray[1]));
            if(!$query->num_rows())
                $query = $this->db->query("SELECT id, nume, prenume, phone, picture_path, languages, doctor_type1, doctor_type2, doctor_type3, doctor_type4, rating_value, rating_number FROM users WHERE `doctor` = 1 AND nume = ? AND prenume = ? ORDER BY `id` ASC LIMIT $start_index, $limit_per_page", array($doctorNameArray[1], $doctorNameArray[0]));

        } elseif($doctorName == "null" && $doctorType != "null") {
            $query = $this->db->query("SELECT id, nume, prenume, phone, picture_path, languages, doctor_type1, doctor_type2, doctor_type3, doctor_type4, rating_value, rating_number FROM users WHERE `doctor` = 1 AND doctor_type1 = ? OR doctor_type2 = ? OR doctor_type3 = ? OR doctor_type4 = ? ORDER BY `id` ASC LIMIT $start_index, $limit_per_page", array($doctorType, $doctorType, $doctorType, $doctorType));
        } elseif($doctorName != "null" && $doctorType != "null") {
        	$doctorNameArray = explode(" ", $doctorName);

        	$query = $this->db->query("SELECT id, nume, prenume, phone, picture_path, languages, doctor_type1, doctor_type2, doctor_type3, doctor_type4, rating_value, rating_number FROM users WHERE `doctor` = 1  AND nume = ? AND prenume = ? AND doctor_type1 = ? OR doctor_type2 = ? OR doctor_type3 = ? OR doctor_type4 = ? ORDER BY `id` ASC LIMIT $start_index, $limit_per_page", array($doctorNameArray[0], $doctorNameArray[1], $doctorType, $doctorType, $doctorType, $doctorType));

        	if(!$query->num_rows())
        		$query = $this->db->query("SELECT id, nume, prenume, phone, picture_path, languages, doctor_type1, doctor_type2, doctor_type3, doctor_type4, rating_value, rating_number FROM users WHERE `doctor` = 1 AND nume = ? AND prenume = ? AND doctor_type1 = ? OR doctor_type2 = ? OR doctor_type3 = ? OR doctor_type4 = ? ORDER BY `id` ASC LIMIT $start_index, $limit_per_page", array($doctorNameArray[1], $doctorNameArray[0], $doctorType, $doctorType, $doctorType, $doctorType));

        } else {
            $query = $this->db->query("SELECT id, nume, prenume, phone, picture_path, languages, doctor_type1, doctor_type2, doctor_type3, doctor_type4, rating_value, rating_number FROM users WHERE `doctor` = 1 AND nume = ? AND prenume = ? ORDER BY `id` ASC LIMIT $start_index, $limit_per_page", array($doctorNameArray[1], $doctorNameArray[0]));

            if(!$query->num_rows())
                $query = $this->db->query("SELECT id, nume, prenume, phone, picture_path, languages, doctor_type1, doctor_type2, doctor_type3, doctor_type4, rating_value, rating_number FROM users WHERE `doctor` = 1 AND nume = ? AND prenume = ? ORDER BY `id` ASC LIMIT $start_index, $limit_per_page", array($doctorNameArray[0], $doctorNameArray[1]));
        }
            if($doctorName == "null" && $doctorType == "null") {
                $query = $this->db->query("SELECT id, nume, prenume, phone, picture_path, languages, doctor_type1, doctor_type2, doctor_type3, doctor_type4, rating_value, rating_number FROM users WHERE `doctor` = 1 ORDER BY `id` ASC LIMIT $start_index, $limit_per_page");
            }

        if($query->num_rows()) return $query->result();
        else return false;
    }


}