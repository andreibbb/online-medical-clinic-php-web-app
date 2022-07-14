<?php

if ( ! defined('BASEPATH')) redirect(base_url());

class Medici extends CI_Controller {
    
    public function __construct() 
    {       
        parent:: __construct();
        
        $this->load->helper(array('url', 'cache_expire', 'htmlpurifier'));
        $this->load->model('Medici_model');
        
        if (!is_cache_valid(md5('medici'), 180)){
            $this->db->cache_delete('medici');
        }
    }

    public function index() {
        redirect(base_url('medici/lista'));
    }
        
    public function lista()
    {   
        $this->load->library('pagination');

        $data['results'] = array();
        
        $params             = array();
        $limit_per_page     = 10;
        $start_index        = ((int)$this->uri->segment(3)) ? (int)$this->uri->segment(3) : 0;
        $total_records      = $this->Medici_model->getTotalMedics();
        if($start_index < 0 || $start_index > $total_records) $start_index = 0;
        
        if ($total_records > 0) 
        {
            // get current page records
            $data['results'] = $this->Medici_model->getAllMedics($limit_per_page, $start_index);

            $config['base_url'] = base_url() . 'medici/lista';
            $config['total_rows'] = $total_records;
            $config['per_page'] = $limit_per_page;
            $config['uri_segment'] = 3;


            $config['full_tag_open'] = '<br><center><ul class="pagination m0">';
            $config['full_tag_close'] = '</ul></center>';

            $config['first_link'] = 'Prima pagina';
            $config['first_tag_open'] = '<li>';
            $config['first_tag_close'] = '</li>';

            $config['last_link'] = 'Ultima pagina';
            $config['last_tag_open'] = '<li>';
            $config['last_tag_close'] = '</li>';

            $config['next_link'] = 'Inainte';
            $config['next_tag_open'] = '<li>';
            $config['next_tag_close'] = '</li>';

            $config['prev_link'] = 'Inapoi';
            $config['prev_tag_open'] = '<li>';
            $config['prev_tag_close'] = '</li>';

            $config['cur_tag_open'] = '<li class="active"><a href="#">';
            $config['cur_tag_close'] = '</a></li>';

            $config['num_tag_open'] = '<li>';
            $config['num_tag_close'] = '</li>';

            $this->pagination->initialize($config);

            $data['links'] = $this->pagination->create_links();
        }

        $data['main_content'] = 'medici_view';
        $this->load->view('includes/template.php', $data);
    }
    
    public function filtre()
    {   
        $this->load->library('pagination');

        $doctorName = "null";
        $doctorType = "null";

        if(strlen(html_purify($this->input->post('doctorname'), false)) > 3) {
            $doctorName = html_purify($this->input->post('doctorname'), false);
        }
        
        if(html_purify($this->input->post('specializare'), false) > 0) {
            $doctorType = (int)html_purify($this->input->post('specializare'), false);
        }

        if($doctorName == null && $doctorType == null) {
            $this->session->set_flashdata("error", "Pentru a cauta doctor dupa nume/specializare trebuie sa selectezi cel putin un filtru de cautare.");
            redirect(base_url("medici"));
        }
        
        $data['results'] = array();
        
        $params             = array();
        $limit_per_page     = 10;
        $start_index        = ((int)$this->uri->segment(3)) ? (int)$this->uri->segment(3) : 0;
        if($doctorName != "null" && $doctorType == "null") {
            $total_records = $this->Medici_model->getTotalMedicsWithFilters($doctorName, "null");
        } elseif($doctorName == "null" && $doctorType != "null") {
            $total_records      = $this->Medici_model->getTotalMedicsWithFilters("null", $doctorType);
        } else {
            $total_records      = $this->Medici_model->getTotalMedicsWithFilters($doctorName, $doctorType);
        }

        $data['totalResults'] = $total_records;

        
        if($start_index < 0 || $start_index > $total_records) $start_index = 0;
        
        if ($total_records > 0) 
        {
            // get current page records
            if($doctorName != "null" && $doctorType == "null") {
                $data['results'] = $this->Medici_model->getAllMedicsWithFilters($doctorName, "null", $limit_per_page, $start_index);
            } elseif($doctorName == "null" && $doctorType != "null") {
                $data['results'] = $this->Medici_model->getAllMedicsWithFilters("null", $doctorType, $limit_per_page, $start_index);
            } else {
                $data['results'] = $this->Medici_model->getAllMedicsWithFilters($doctorName, $doctorType, $limit_per_page, $start_index);
            }            

            $config['base_url'] = base_url() . 'medici/filtre';
            $config['total_rows'] = $total_records;
            $config['per_page'] = $limit_per_page;
            $config['uri_segment'] = 3;


            $config['full_tag_open'] = '<br><center><ul class="pagination m0">';
            $config['full_tag_close'] = '</ul></center>';

            $config['first_link'] = 'First Page';
            $config['first_tag_open'] = '<li>';
            $config['first_tag_close'] = '</li>';

            $config['last_link'] = 'Last Page';
            $config['last_tag_open'] = '<li>';
            $config['last_tag_close'] = '</li>';

            $config['next_link'] = 'Next';
            $config['next_tag_open'] = '<li>';
            $config['next_tag_close'] = '</li>';

            $config['prev_link'] = 'Prev';
            $config['prev_tag_open'] = '<li>';
            $config['prev_tag_close'] = '</li>';

            $config['cur_tag_open'] = '<li class="active"><a href="#">';
            $config['cur_tag_close'] = '</a></li>';

            $config['num_tag_open'] = '<li>';
            $config['num_tag_close'] = '</li>';

            $this->pagination->initialize($config);

            $data['links'] = $this->pagination->create_links();
        }

        $data['main_content'] = 'medici_view';
        $this->load->view('includes/template.php', $data);
    }

}
