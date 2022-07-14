<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Contact_model extends CI_model {

    function __construct()
    {
        parent::__construct();
    }

    public function getTicketAllInfo($tID) {
        $this->db->cache_on();
        $query = $this->db->query("SELECT * FROM tickets WHERE `id` = ? LIMIT 1", array($tID));

        if($query->num_rows()) return $query->result();
        else return false;
    }

    public function getTickets($limit_per_page, $start_index) {
        $this->db->cache_on();
        $query = $this->db->query("SELECT id, clientid, type, status, time, message FROM tickets ORDER BY status ASC, id DESC LIMIT $start_index, $limit_per_page");

        if($query->num_rows()) return $query->result();
        else return false;
    }

    public function getTotalTickets() {
        $this->db->cache_on();
        $query = $this->db->query("SELECT COUNT(id) AS TOTAL FROM tickets");

        if($query->num_rows()) return $query->result()[0]->TOTAL;
        else return false;
    }

    public function getTicketsBy($user, $limit_per_page, $start_index) {
        $this->db->cache_on();
        $query = $this->db->query("SELECT id, clientid, type, status, time, message FROM tickets WHERE `clientid` = ? ORDER BY status ASC, id DESC LIMIT $start_index, $limit_per_page", array($user));

        if($query->num_rows()) return $query->result();
        else return false;
    }

    public function getLastTicketsBy($user) {
        $this->db->cache_on();
        $query = $this->db->query("SELECT `id`, `message`, `type`, `time` FROM tickets WHERE `clientid` = ? ORDER BY id DESC LIMIT 5", array($user));
        
        if($query->num_rows()) return $query->result();
        else return false;
    }

    public function getTotalTicketsBy($user) {
        $this->db->cache_on();
        $query = $this->db->query("SELECT COUNT(id) AS TOTAL FROM tickets WHERE `clientid` = ?", array($user));

        if($query->num_rows()) return $query->result()[0]->TOTAL;
        else return false;
    }

    public function getTicketInfo($tID, $retrieve) {
        $this->db->cache_on();
        $query = $this->db->query("SELECT $retrieve FROM tickets WHERE `id` = ? LIMIT 1", array($tID));

        if($query->num_rows()) return $query->result()[0]->$retrieve;
        else return false;
    }

    public function getTicketComments($ticketID) {
        $this->db->cache_on();
        $query = $this->db->query("SELECT * FROM reply_tickets WHERE `tid` = ? AND `hide` = 0 ORDER BY id ASC", array($ticketID));

        if($query->num_rows()) return $query->result();
        else return false;
    }

    public function getUserInfo($uID) {
    	$this->db->cache_on();
        $query = $this->db->query("SELECT id, nume, prenume, phone, born_date, location, regdate FROM users WHERE id = ? LIMIT 1", array($uID)); 

        if($query->num_rows()) return $query->result()[0];
        else return false;
    }

    public function insertTicket($userID, $reason, $description) {
        if($reason == "suportclienti") $reason = 1;
        elseif($reason == "tehnic") $reason = 2;
        elseif($reason == "financiar") $reason = 3;
        elseif($reason == "sesizari") $reason = 4;
        elseif($reason == "feedback") $reason = 5;
        
        $this->db->query("INSERT INTO `tickets` (`clientid`, `message`, `type`, `postedip`) VALUES (?, ?, ?, ?)", array($userID, $description, $reason, $this->input->ip_address()));
    }

    public function insertComment($text, $user, $tID) {
        $this->db->query("INSERT INTO `reply_tickets` (`text`, `clientid`, `tid`) VALUES (?, ?, ?)", array($text, $user, $tID));
    }

    public function openTicket($tID) {
        $this->db->query("UPDATE `tickets` SET `status` = 0 WHERE `id` = ? LIMIT 1", array($tID));
    }

    public function changeCategory($newCategory, $tID) {
        $this->db->query("UPDATE `tickets` SET `type` = ? WHERE `id` = ? LIMIT 1", array($newCategory, $tID));
    }

    public function closeTicket($tID) {
        $this->db->query("UPDATE `tickets` SET `status` = 1 WHERE `id` = ? LIMIT 1", array($tID));
    }
}