<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class News extends CI_Controller {
    
    public function __construct() 
    {       
         parent:: __construct();
         $this->load->model('News_model');  
         $this->load->helper(array('url', 'form', 'htmlpurifier', 'cache_expire'));
    }
    
    public function index() {
         redirect(base_url("news/lista"));
    }

    public function lista() {
    	if (!is_cache_valid(md5('news'), 1800)){
            $this->db->cache_delete('news');
        }

        $data["news"] = $this->News_model->getNews();

        $data["main_content"]   = 'news_view';
        $this->load->view('includes/template.php', $data);         
    }
    
    public function insertNews() {
        if(!($this->session->userdata('logged_in')['id'])) {
            $this->session->set_flashdata('error', 'Nu esti logat.');
            redirect(base_url('login'));
        }
        
        if(getUserData($this->session->userdata('logged_in')["id"], "devowner") < 1) {
            $this->session->set_flashdata('error', 'Nu ai permisiunea necesara pentru a face acest lucru.');
            redirect(base_url());
        }
        
        $text   = html_purify($this->input->post("text"), false);
        $titlu  = html_purify($this->input->post("titlu"), false);

        $config['upload_path']          = './assets/img/newsphoto/';
        $config['allowed_types']        = 'jpg|png';
        $config['max_size']             = 4096;
        $config['max_width']            = 19200;
        $config['max_height']           = 1080;
        $config['overwrite']     = FALSE;
        $config['file_ext_tolower'] = TRUE;
        $config['file_name'] = "n".$this->session->userdata('logged_in')["id"]."".time()."";
        $config['master_dim']       = 'width'; 
        $config['width']            = 355;

        $this->load->library('image_lib', $config);
        $this->image_lib->initialize($config);
        $this->image_lib->resize();

        $this->load->library('upload', $config);

            if(!$this->upload->do_upload('profilepicture'))
            {               
                $this->session->set_flashdata('error', ''.$this->upload->display_errors().'');
                redirect(base_url("news"));
            }
            else
            {
                    $data_info = $this->upload->data();
                    $configer =  array(
                      'image_library'   => 'gd2',
                      'source_image'    =>  $data_info['full_path'],
                      'maintain_ratio'  =>  TRUE,
                      'width'           =>  355,
                    );
                    $this->image_lib->clear();
                    $this->image_lib->initialize($configer);
                    $this->image_lib->resize();
                
                if($text !== null && $titlu !== null && $data_info['file_name']) {
                    $this->News_model->insertNewsDB($titlu, $this->session->userdata("logged_in")["id"], $text, $data_info['file_name']);

                    panel_log("uID: ". getUserData($this->session->userdata("logged_in")["id"], "id") . " a inserat o stire noua.", $this->session->userdata("logged_in")["id"]);
                    $this->session->set_flashdata('success', 'Ai inserat stirea cu succes!');
                    redirect(base_url("news/lista"));

                } else {
                    $this->session->set_flashdata('error', 'Nu ai completat campurile!');
                    redirect(base_url("news/lista"));
                }
            }
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