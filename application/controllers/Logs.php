<?php
if ( ! defined("BASEPATH")) exit("No direct script access allowed");

class Logs extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        
        $this->load->helper(array('url', 'cache_expire'));
        $this->load->library("pagination");
        $this->load->model('Logs_model');  
        
        
        if(!($this->session->userdata('logged_in')["id"])) {
            $this->session->set_flashdata('error', 'Nu esti logat.');
            redirect(base_url());
        }
        
    }
    
    public function index() {
        redirect(base_url());
    }


    public function appointments() {
        if (!is_cache_valid(md5('logs+appointments'), 300)){
            $this->db->cache_delete('logs', 'appointments');
        }
        
        $userID = (int)$this->uri->segment(3);
        if(!is_numeric($userID)) {
            $this->session->set_flashdata('error', 'Utilizator inexistent.');
            redirect(base_url());
        }

        if($this->session->userdata('logged_in')["id"] == $userID || getUserData($this->session->userdata('logged_in')["id"], "devowner") > 0 ||  getUserData($this->session->userdata('logged_in')["id"], "doctor") > 0) {
            if(getUserData($userID, "ID") > 0) {
            
                $data["th"] = "<th>#</th><th>Data crearii</th><th>Status</th><th>Metoda de contact</th><th>Doctor</th><th>Ora confirmata</th><th>View<th>";
                
                $params = array();
                $limit_per_page = 25;
                $start_index = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
                $total_records = $this->Logs_model->getTotalLogs("appointments", $userID);
                if($start_index < 0 || $start_index > $total_records) $start_index = 0;
                
                if ($total_records > 0) 
                {
                    // get current page records
                    $data["results"] = $this->Logs_model->getLog("appointments", $userID, $start_index, $limit_per_page);

                    $config['base_url'] = base_url() . 'logs/appointments/' . $player;
                    $config['total_rows'] = $total_records;
                    $config['per_page'] = $limit_per_page;
                    $config["uri_segment"] = 4;


                    $config['full_tag_open'] = '<br><center><ul class="pagination m0">';
                    $config['full_tag_close'] = '</ul></center>';

                    $config['first_link'] = 'First Page';
                    $config['first_tag_open'] = '<li>';
                    $config['first_tag_close'] = '</li>';

                    $config['last_link'] = 'Last Page';
                    $config['last_tag_open'] = '<li>';
                    $config['last_tag_close'] = '</li>';

                    $config['next_link'] = '»';
                    $config['next_tag_open'] = '<li>';
                    $config['next_tag_close'] = '</li>';

                    $config['prev_link'] = '«';
                    $config['prev_tag_open'] = '<li>';
                    $config['prev_tag_close'] = '</li>';

                    $config['cur_tag_open'] = '<li class="active"><a href="#">';
                    $config['cur_tag_close'] = '</a></li>';

                    $config['num_tag_open'] = '<li>';
                    $config['num_tag_close'] = '</li>';

                    $this->pagination->initialize($config);

                    $data["links"] = $this->pagination->create_links();
                }
                
            } else {
                $this->session->set_flashdata('error', 'Utilizator inexistent.');
                redirect(base_url());
            }
        } else {
            $this->session->set_flashdata('error', 'Nu ai permisiunea necesara.');
            redirect(base_url("profile/" . $userID));
        }
        
        $data['main_content'] = "logs_view";
        $this->load->view("includes/template.php", $data);
    }

    public function reviews() {
        if (!is_cache_valid(md5('logs+reviews'), 300)){
            $this->db->cache_delete('logs', 'reviews');
        }
        
        $userID = (int)$this->uri->segment(3);
        if(!is_numeric($userID)) {
            $this->session->set_flashdata('error', 'Utilizator inexistent.');
            redirect(base_url());
        }

        if($this->session->userdata('logged_in')["id"] == $userID || getUserData($this->session->userdata('logged_in')["id"], "devowner") > 0) {
            if(getUserData($userID, "ID") > 0) {
            
                $data["th"] = "<th>#</th><th>Doctor</th><th>Text</th><th>Nota</th><th>Data adaugarii</th><th>View<th>";
                
                $params = array();
                $limit_per_page = 25;
                $start_index = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
                $total_records = $this->Logs_model->getTotalLogs("reviews", $userID);
                if($start_index < 0 || $start_index > $total_records) $start_index = 0;
                
                if ($total_records > 0) 
                {
                    // get current page records
                    $data["results"] = $this->Logs_model->getLog("reviews", $userID, $start_index, $limit_per_page);

                    $config['base_url'] = base_url() . 'logs/reviews/' . $player;
                    $config['total_rows'] = $total_records;
                    $config['per_page'] = $limit_per_page;
                    $config["uri_segment"] = 4;


                    $config['full_tag_open'] = '<br><center><ul class="pagination m0">';
                    $config['full_tag_close'] = '</ul></center>';

                    $config['first_link'] = 'First Page';
                    $config['first_tag_open'] = '<li>';
                    $config['first_tag_close'] = '</li>';

                    $config['last_link'] = 'Last Page';
                    $config['last_tag_open'] = '<li>';
                    $config['last_tag_close'] = '</li>';

                    $config['next_link'] = '»';
                    $config['next_tag_open'] = '<li>';
                    $config['next_tag_close'] = '</li>';

                    $config['prev_link'] = '«';
                    $config['prev_tag_open'] = '<li>';
                    $config['prev_tag_close'] = '</li>';

                    $config['cur_tag_open'] = '<li class="active"><a href="#">';
                    $config['cur_tag_close'] = '</a></li>';

                    $config['num_tag_open'] = '<li>';
                    $config['num_tag_close'] = '</li>';

                    $this->pagination->initialize($config);

                    $data["links"] = $this->pagination->create_links();
                }
                
            } else {
                $this->session->set_flashdata('error', 'Jucator inexistent.');
                redirect(base_url());
            }
        } else {
            $this->session->set_flashdata('error', 'Nu ai permisiunea necesara.');
            redirect(base_url("profile/" . $userID));
        }
        
        $data['main_content'] = "logs_view";
        $this->load->view("includes/template.php", $data);
    }

    public function tickets() {
        if (!is_cache_valid(md5('logs+tickets'), 300)){
            $this->db->cache_delete('logs', 'tickets');
        }
        
        $userID = (int)$this->uri->segment(3);
        if(!is_numeric($userID)) {
            $this->session->set_flashdata('error', 'Utilizator inexistent.');
            redirect(base_url());
        }

        if($this->session->userdata('logged_in')["id"] == $userID || getUserData($this->session->userdata('logged_in')["id"], "devowner") > 0) {
            if(getUserData($userID, "ID") > 0) {
            
                $data["th"] = "<th>Categorie</th><th>#</th><th>Mesaj</th><th>Data adaugarii</th><th>Status</th><th>View<th>";
                
                $params = array();
                $limit_per_page = 25;
                $start_index = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
                $total_records = $this->Logs_model->getTotalLogs("tickets", $userID);
                if($start_index < 0 || $start_index > $total_records) $start_index = 0;
                
                if ($total_records > 0) 
                {
                    // get current page records
                    $data["results"] = $this->Logs_model->getLog("tickets", $userID, $start_index, $limit_per_page);

                    $config['base_url'] = base_url() . 'logs/reviews/' . $player;
                    $config['total_rows'] = $total_records;
                    $config['per_page'] = $limit_per_page;
                    $config["uri_segment"] = 4;


                    $config['full_tag_open'] = '<br><center><ul class="pagination m0">';
                    $config['full_tag_close'] = '</ul></center>';

                    $config['first_link'] = 'First Page';
                    $config['first_tag_open'] = '<li>';
                    $config['first_tag_close'] = '</li>';

                    $config['last_link'] = 'Last Page';
                    $config['last_tag_open'] = '<li>';
                    $config['last_tag_close'] = '</li>';

                    $config['next_link'] = '»';
                    $config['next_tag_open'] = '<li>';
                    $config['next_tag_close'] = '</li>';

                    $config['prev_link'] = '«';
                    $config['prev_tag_open'] = '<li>';
                    $config['prev_tag_close'] = '</li>';

                    $config['cur_tag_open'] = '<li class="active"><a href="#">';
                    $config['cur_tag_close'] = '</a></li>';

                    $config['num_tag_open'] = '<li>';
                    $config['num_tag_close'] = '</li>';

                    $this->pagination->initialize($config);

                    $data["links"] = $this->pagination->create_links();
                }
                
            } else {
                $this->session->set_flashdata('error', 'Jucator inexistent.');
                redirect(base_url());
            }
        } else {
            $this->session->set_flashdata('error', 'Nu ai permisiunea necesara.');
            redirect(base_url("profile/" . $userID));
        }
        
        $data['main_content'] = "logs_view";
        $this->load->view("includes/template.php", $data);
    }

    public function iplogs() {
        if (!is_cache_valid(md5('logs+ip'), 300)){
            $this->db->cache_delete('logs', 'ip');
        }
        
        $userID = (int)$this->uri->segment(3);
        if(!is_numeric($userID)) {
            $this->session->set_flashdata('error', 'Utilizator inexistent.');
            redirect(base_url());
        }

        if($this->session->userdata('logged_in')["id"] == $userID || getUserData($this->session->userdata('logged_in')["id"], "devowner") > 0) {
            if(getUserData($userID, "ID") > 0) {
            
                $data["th"] = "<th>#</th><th>IP</th><th>Location</th><th>ISP</th><th>Time</th>";
                
                $params = array();
                $limit_per_page = 25;
                $start_index = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
                $total_records = $this->Logs_model->getTotalLogs("iplogs", $userID);
                if($start_index < 0 || $start_index > $total_records) $start_index = 0;
                
                if ($total_records > 0) 
                {
                    // get current page records
                    $data["results"] = $this->Logs_model->getLog("iplogs", $userID, $start_index, $limit_per_page);

                    $config['base_url'] = base_url() . 'logs/iplogs/' . $player;
                    $config['total_rows'] = $total_records;
                    $config['per_page'] = $limit_per_page;
                    $config["uri_segment"] = 4;


                    $config['full_tag_open'] = '<br><center><ul class="pagination m0">';
                    $config['full_tag_close'] = '</ul></center>';

                    $config['first_link'] = 'First Page';
                    $config['first_tag_open'] = '<li>';
                    $config['first_tag_close'] = '</li>';

                    $config['last_link'] = 'Last Page';
                    $config['last_tag_open'] = '<li>';
                    $config['last_tag_close'] = '</li>';

                    $config['next_link'] = '»';
                    $config['next_tag_open'] = '<li>';
                    $config['next_tag_close'] = '</li>';

                    $config['prev_link'] = '«';
                    $config['prev_tag_open'] = '<li>';
                    $config['prev_tag_close'] = '</li>';

                    $config['cur_tag_open'] = '<li class="active"><a href="#">';
                    $config['cur_tag_close'] = '</a></li>';

                    $config['num_tag_open'] = '<li>';
                    $config['num_tag_close'] = '</li>';

                    $this->pagination->initialize($config);

                    $data["links"] = $this->pagination->create_links();
                }
                
            } else {
                $this->session->set_flashdata('error', 'Jucator inexistent.');
                redirect(base_url());
            }
        } else {
            $this->session->set_flashdata('error', 'Nu ai permisiunea necesara.');
            redirect(base_url("profile/" . $userID));
        }
        
        $data['main_content'] = "logs_view";
        $this->load->view("includes/template.php", $data);
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