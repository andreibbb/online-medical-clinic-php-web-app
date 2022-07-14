<?php

if ( ! defined('BASEPATH')) redirect(base_url());

class Reviews extends CI_Controller {
    
    public function __construct() 
    {       
        parent:: __construct();
        
        $this->load->helper(array('url', 'cache_expire', 'htmlpurifier'));
        $this->load->model('Reviews_model');
    }

    public function index() {
        if (!is_cache_valid(md5('reviews+index'), 1800)){
            $this->db->cache_delete('reviews');
            $this->db->cache_delete('reviews', 'index');               
        }

        $data["last5reviews"] = $this->Reviews_model->getLastReviews(5);
        if($this->session->userdata('logged_in')['id']) {
            $data["last5reviewsByUser"] = $this->Reviews_model->getLastReviewsByUser(5, $this->session->userdata('logged_in')['id']);
        }

        $data['main_content'] = 'reviews_view';
        $this->load->view('includes/template.php', $data);
    }

}
