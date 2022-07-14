<?php 
class Error404 extends CI_Controller 
{
    public function __construct() 
    {
        parent::__construct(); 
    } 

    public function index() 
    { 
        $this->output->set_status_header('404'); 

        $data["main_content"] = 'error404_view';

        $this->load->view('includes/template.php', $data);
    } 
} 