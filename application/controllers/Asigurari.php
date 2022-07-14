<?php

if ( ! defined('BASEPATH')) redirect(base_url());

class Asigurari extends CI_Controller {
    
    public function __construct() 
    {       
        parent:: __construct();
    }
    
    public function index() {
        $data["main_content"] = 'asigurari_view';

        $this->load->view('includes/template.php', $data);
    }

    function _remap($method,$args)
    {
        if (method_exists($this, $method))
        {
           $this->$method($args);
        }
        else
        {
            $this->index($method,$args);
        }
    }
    

}