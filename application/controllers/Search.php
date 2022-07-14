<?php

if ( ! defined('BASEPATH')) redirect(base_url());

class Search extends CI_Controller {
    
    public function __construct() 
    {       
        parent:: __construct();
        
        $this->load->helper(array('url', 'cache_expire', 'htmlpurifier'));
        $this->load->model('Search_model');
        
        if (!is_cache_valid(md5('search'), 180)){
            $this->db->cache_delete('search');
        }
    }
        
    function index()
    {       
        $data['searchedtop'] = null;

        if($this->input->post('after') == "after") { 
            $username = html_purify(strip_non_utf($this->input->post('searchPlayer')), false);

            if(strlen($username) < 3)
            {
                $this->session->set_flashdata('error', 'Introdu minim 3 caractere pentru a cauta un jucator.');              
                redirect(base_url("search"));
            }

            $data['searchedtop'] = $this->Search_model->searchPlayers($username);
        }

        $data['main_content'] = 'search_view';
        $this->load->view('includes/template.php', $data);
    }
    
    function searchPlayers() {
        $username       = html_purify(strip_non_utf($this->input->post("username")), false);
        $data['searchedtop'] = $this->Search_model->searchPlayers($username);

        $data['main_content'] = 'search_view';
        $this->load->view('includes/template.php', $data);
    }

}
