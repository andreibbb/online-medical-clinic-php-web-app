<?php

if ( ! defined('BASEPATH')) redirect(base_url());

class Cauta extends CI_Controller {
    
    public function __construct() 
    {       
        parent:: __construct();
    }
        
    function index()
    {       
        $data['main_content'] = 'cauta_view';
        $this->load->view('includes/template.php', $data);
    }
}
