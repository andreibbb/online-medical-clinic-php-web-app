<?php

if ( ! defined('BASEPATH')) redirect(base_url());

class Search_model extends CI_model {
    
    function __construct()
    {
        parent::__construct();
    }
    
    public function searchPlayers($username) {
        $username = str_replace("</p>", "", str_replace("<p>", "", $username));
        $username = "%".$username."%";
        $query = $this->db->query("SELECT id, name, Status, Model, Level, Admin, Helper, ConnectedTime, Member FROM users WHERE name LIKE ? ORDER BY `Level` DESC LIMIT 50", array($username));
            
        if($query->num_rows()) return $query->result();
    }

}