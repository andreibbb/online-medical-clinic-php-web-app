<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Notification_model extends CI_model {
    
    function __construct()
    {
        parent::__construct();
    }

    public function getNotificationsByUser($user) {
        $this->db->cache_on();
        $query = $this->db->query("SELECT * FROM `notifications` WHERE `userid` = ? ORDER BY `ID` DESC LIMIT 50", array($user));
        
        if($query->num_rows()) return $query->result();
        else return false;
    }
    
    public function readNotifications($user) {
        $this->db->query("UPDATE `notifications` SET `readed_notification` = 1 WHERE userid = ?", array($user));
    }

    public function readNotificationsAll($user) {
        $this->db->query("UPDATE `notifications` SET `readed_notification` = 1 WHERE userid = ?", array($user));
    }
}