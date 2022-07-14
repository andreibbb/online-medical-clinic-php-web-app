<?php
if ( ! defined("BASEPATH")) exit("No direct script access allowed");

class Logs_model extends CI_model
{
    public function __construct() {
        parent::__construct();
    }

    public function getTotalLogs($method, $userID) {
        $this->db->cache_on();

        if($method == "appointments")
        {
            $query = $this->db->query("SELECT * FROM appointments WHERE clientid = ?", array($userID));
        }
        elseif($method == "reviews")
        {
            $query = $this->db->query("SELECT * FROM reviews WHERE clientID = ?", array($userID));
        }
        elseif($method == "tickets")
        {
            $query = $this->db->query("SELECT * FROM tickets WHERE clientid = ?", array($userID));
        }
        elseif($method == "iplogs")
        {
            $query = $this->db->query("SELECT * FROM iplogs_panel WHERE uid = ?", array($userID));
        }

        return ($query->num_rows() ? $query->num_rows() : false);
    }


    public function getLog($method, $userid, $start, $limit) {
        $this->db->cache_on();

        if($method == "appointments")
        {
            $select = "*";
            $table  = "`appointments`";
            $where  = "`clientid` = $userid";
        }
        elseif($method == "reviews")
        {
            $select = "*";
            $table  = "`reviews`";
            $where  = "`clientID` = $userid";
        }
        elseif($method == "tickets")
        {
            $select = "*";
            $table  = "`tickets`";
            $where  = "`clientid` = $userid";
        }
        elseif($method == "iplogs")
        {
            $select = "*";
            $table  = "`iplogs_panel`";
            $where  = "`uid` = $userid";
        }
        

        $query = $this->db->query("SELECT $select FROM $table WHERE $where ORDER BY id DESC LIMIT $start, $limit");
        if($query->num_rows() > 0) return $query->result();
        else return false;
    }

}