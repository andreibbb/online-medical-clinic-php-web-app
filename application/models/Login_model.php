<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login_model extends CI_model {
    
    function __construct()
    {
        parent::__construct();
    }
    
    public function recoverPassword($email, $lastKEY) {
        $this->db->query("INSERT INTO recover (RecoverKey, email, done, timeexpire) VALUES (?, ?, ?, ?)", array($lastKEY, $email, 0, time()+1800));
    }

    public function isValidRecovery($key) {
        $query = $this->db->query("SELECT RecoverKey, timeexpire FROM recover WHERE `RecoverKey` = ? LIMIT 1", array($key));
        if($query->num_rows()) 
        {
            if($query->row()->timeexpire > time())
                return true; 
                        else return false;
        }
        else return false;
    }
    
    public function addIPLog($userid, $ippanel) {
        $this->db->query("INSERT INTO `iplogs_panel` (uid, login_ip) VALUES (?, ?)", array($userid, $ippanel));
    }

    public function updateLoginDate($userid) {
        $this->db->query("UPDATE `users` SET last_login = ? WHERE `id` = ?", array(date('Y-m-d H:i:s'), $userid));
    }

    public function updateUser($key, $password) {
        $this->db->query("UPDATE `recover` SET `done` = 1 WHERE `RecoverKey` = ? LIMIT 1", array($key));
        
        $this->db->query("UPDATE `users` SET `password` = ? WHERE `name` = ? LIMIT 1", array(md5($password), get_info('name', 'recover', 'RecoverKey', $key)));
    }
    
    public function checkLogin($email, $password)
    {   
        $query = $this->db->query("SELECT id, email, password FROM `users` WHERE `email` = ? AND `password` = ? LIMIT 1", array($email, md5($password)));
        
        if($query->num_rows())
        {
            return $query->result()[0]->id . "|" . $query->result()[0]->email;
        }
            else return false;
    }
    
}