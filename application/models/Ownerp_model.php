<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* Admin
* 
* 
* @package    T4P
* @subpackage Model
*/

class Ownerp_model extends CI_model {

    function __construct()
    {
        parent::__construct();
    }

    public function insertNews($user, $versiune, $text) {
        $this->db->query("INSERT INTO s_updates (`versiune`, `autor`, `text`, `time`) VALUES (?,?,?,?)", array($versiune, $user, $text, date("Y-m-d H:i:s")));
    }

    public function getPanelLogs($numberof) {
        $this->db->cache_on();
        $query = $this->db->query("SELECT * FROM `panel_logs` ORDER BY `ID` DESC LIMIT ?", array($numberof));

        if($query->num_rows()) return $query->result();
        else return 0;
    }

    public function getTotalBrut() {
        $this->db->cache_on();
        $query = $this->db->query("SELECT SUM(`donateSUM`) AS TOTAL FROM `donations` WHERE `donateTime` > ?", array(date("Y-m-d H:i:s", time()-2592000)));

        if($query->num_rows()) return $query->result()[0]->TOTAL;
        else return 0;
    }

    public function getDonations() {
        $this->db->cache_on();
        $query = $this->db->query("SELECT donateSUM, donateTime FROM `donations` WHERE `donateTime` > ? ORDER BY `ID` ASC", array(date("Y-m-d H:i:s", time()-2592000)));

        if($query->num_rows()) return $query->result();
        else return 0;
    }
    
    public function add_item($title, $description, $price) {
        $this->db->query("INSERT INTO `shop` (`Title`, `Description`, `Price`, `Display`) VALUES (?, ?, ?, 1)", array($title, $description, $price));
    }

    public function add_video($youtubeID, $sampname) {
        $this->db->query("INSERT INTO `youtube_videos` (`ID`, `Y_ID`, `U_ID`, `Date`) VALUES (NULL, ?, ?, now())", array($youtubeID, getUserData($sampname, "id")));
    }
    
    public function toggle_maintenance($switch) {
        $this->db->query("UPDATE `panel_assets` SET `Value` = ? WHERE `Name` = 'Maintenance' LIMIT 1", array($switch));
    }
    
    public function set_pp($newpp) {
        $this->db->query("UPDATE `panel_assets` SET `Value` = ? WHERE `Name` = 'PremiumPoint' LIMIT 1", array($newpp));
    }

    public function set_pp_sms($newpp) {
        $this->db->query("UPDATE `panel_assets` SET `Value` = ? WHERE `Name` = 'PremiumPointSMS' LIMIT 1", array($newpp));
    }

    public function update_global_announcement($string) {
        $this->db->query("UPDATE `panel_assets` SET `Value` = ? WHERE `Name` = 'global_announce' LIMIT 1", array($string));
    }

    public function delete_item($item) {
        $this->db->query("UPDATE `shop` SET `Display` = 0 WHERE `ID` = ? LIMIT 1", array($item));
    }
    
    public function get_push_users() {
        $this->db->cache_on();
        $query = $this->db->query("SELECT OneSignalID FROM `users` WHERE OneSignalID != 'null'");

        if($query->num_rows()) return $query->result();
        else return false;
    }

    public function getInformation($information) {

        $this->db->cache_on();

        if($information == "newAccountsToday") {
            $date_now = date('Y-m-d');
            $query = $this->db->query("SELECT COUNT(`ID`) AS TOTAL FROM `users` WHERE `RegisterDate` >= ?", array($date_now));
        }

        $return = null;

        foreach($query->result() as $row) {
            $return .=  $row->TOTAL;
        }
        
        return $return;
    }

}