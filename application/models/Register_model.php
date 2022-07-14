<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Register_model extends CI_model {

    function __construct() {
        parent::__construct();
    }

    function checkExistingUser($email) {
        $query = $this->db->query("SELECT `email`,`phone` FROM `users` WHERE `email` = ? LIMIT 1", array($email));

        if($query->num_rows()) return TRUE;
        else return FALSE;
    }

    function insertTempUser($finalkey, $email, $password, $firstname, $lastname, $phone) {
    	$this->db->query("INSERT INTO `validateuser` (ukey, regdate, email, password, phone, nume, prenume) VALUES (?, ?, ?, ?, ?, ?, ?)", array($finalkey, time()+1800, $email, md5($password), $phone, $firstname, $lastname));
    }


    function isValidKey($key) {
        $query = $this->db->query("SELECT * FROM `validateuser` WHERE `ukey` = ? AND `used` = 0 LIMIT 1", array($key));
        $qq = $query->row();
        if($query->num_rows()) 
        {
            if($qq->regdate > time())
            {	
            	if($this->Register_model->checkExistingUser($qq->email) == TRUE) {
            		return false; 
            	}
            	$this->db->query("UPDATE `validateuser` SET `used` = 1 WHERE `ukey` = ? LIMIT 1", array($key));
            	$this->db->query("INSERT INTO `users` (email, password, phone, nume, prenume, regdate) VALUES (?, ?, ?, ?, ?, ?)", array($qq->email, $qq->password, $qq->phone, $qq->nume, $qq->prenume, date('Y-m-d H:i:s')));

                return true;
            }
            else return false;
        }
        else return false;
    }    
}