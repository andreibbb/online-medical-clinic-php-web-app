<?php

if ( ! defined('BASEPATH')) redirect(base_url());

class Locations extends CI_Controller {
    
    public function __construct() 
    {       
        parent:: __construct();
        $this->load->helper(array('cache_expire'));
    }
        
    public function index()
    {       
    	if (!is_cache_valid(md5('locations+index'), 3600)){
            $this->db->cache_delete('locations');
        }

    	$data['clinic_posX'] = get_info("Value","panel_assets", "ID", 1);
    	$data['clinic_posY'] = get_info("Value","panel_assets", "ID", 2);
        $data['main_content'] = 'locations_view';
        $this->load->view('includes/template.php', $data);
    }
}
