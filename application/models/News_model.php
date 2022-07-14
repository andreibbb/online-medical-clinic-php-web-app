<?php

class News_model extends CI_model {
    
    function __construct()
    {
        parent::__construct();
    }
    
    public function getNews() {
    	$this->db->cache_on();
    	
		$query = $this->db->query("SELECT * FROM `news` ORDER BY `id` DESC");
		
        if($query->num_rows()) return $query->result();
        else return false;
	}

    public function insertNewsDB($title, $user, $text, $path) {
        $this->db->query("INSERT INTO `news` (`title`, `creatorid`, `text`, `photo_path`) VALUES (?, ?, ?, ?)", array($title, $user, $text, $path));
    }
}