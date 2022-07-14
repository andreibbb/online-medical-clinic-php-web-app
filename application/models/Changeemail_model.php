<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Changeemail_model extends CI_model {
    
    function __construct()
    {
        parent::__construct();
    }
    
    public function changeMail($userID, $newmail, $lastKEY) {
        $this->db->query("INSERT INTO changemail (`ChangeMailKey`, `userid`, `email`, `used`, `expire`) VALUES (?, ?, ?, ?, ?)", array($lastKEY, $userID, $newmail, 0, time()+3600));
    }

    public function isValidRecovery($key, $timed) {
        $query = $this->db->query("SELECT ChangeMailKey FROM changemail WHERE `ChangeMailKey` = ? and `expire` > ? LIMIT 1", array($key, $timed));
        if($query->num_rows()) return true; else return false;
    }

}