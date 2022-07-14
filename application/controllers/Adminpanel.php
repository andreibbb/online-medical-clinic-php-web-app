<?php
if ( ! defined('BASEPATH')) redirect(base_url());

class Adminpanel extends CI_Controller {

    public function __construct() 
    {       
        parent:: __construct();
        $this->load->model("Adminpanel_model");
        $this->load->helper(array('url', 'cache_expire', 'htmlpurifier'));

       if(!($this->session->userdata('logged_in')["id"])) {
            $this->session->set_flashdata('error', 'Nu esti logat.');
            redirect(base_url());
        }    

        if(getUserData($this->session->userdata('logged_in')["id"], "devowner") == 0) {
            $this->session->set_flashdata('error', 'Nu ai permisiunile necesare pentru a vizualiza aceasta pagina.');
            redirect(base_url());
        }
    }

    public function index() {
        if(!is_cache_valid(md5('adminpanel'), 500)) {
            $this->db->cache_delete('adminpanel');
        }

        $data['searched'] = null;
        $data['waitingAppointments'] = $this->Adminpanel_model->getWaitingAppointments();
        
        // number of users setted on value "-1" to prevent appearing default on admin page text "no user found"
        $data['numberOfUsersFound'] = "-1";

        if(html_purify($this->input->post('checker'), false) == "yes") {

            $this->load->library('form_validation');
            $this->form_validation->set_rules('email', 'Email', 'trim|valid_email|max_length[30]');
            $this->form_validation->set_rules('nume', 'Nume', 'trim|xss_clean|max_length[30]');
            $this->form_validation->set_rules('prenume', 'Prenume', 'trim|xss_clean|max_length[30]');
            $this->form_validation->set_rules('phone', 'Telefon', 'trim|xss_clean|max_length[12]');       
            $this->form_validation->set_rules('callback_either', 'Completeaza cel putin un camp.', 'callback_validate_either');
          
            if($this->form_validation->run() != FALSE)
            {
                $searchQuery = $this->Adminpanel_model->getBySearchedData(html_purify($this->input->post('email'), false), html_purify($this->input->post('nume'), false), html_purify($this->input->post('prenume'), false), html_purify($this->input->post('phone'), false));
                if($searchQuery != false) {
                    $data['searched'] = $searchQuery->result();
                    $data['numberOfUsersFound'] = $searchQuery->num_rows();
                }
                else {
                    $data['numberOfUsersFound'] = 0;
                }
            }            
        }

        $data["main_content"] = 'adminpanel_view';
        $this->load->view('includes/template.php', $data);
    }

    function validate_either(){
        if(($this->input->post('nume') && $this->input->post('prenume')) || $this->input->post('phone') || $this->input->post('email')){
            return TRUE;
        }else{
            $this->form_validation->set_message('validate_either', 'Trebuie completat cel putin un camp pentru a putea cauta.');
            return FALSE;
        }
    }

    public function flushcache() {
        if(getUserData($this->session->userdata('logged_in')["id"], "devowner") < 1) {
            $this->session->set_flashdata('error', 'Nu esti owner.');
            redirect(base_url());
        }

        panel_log(getUserFullName($this->session->userdata("logged_in")["id"]) . " a sters tot cache-ul website-ului.", $this->session->userdata("logged_in")["id"]);

        $this->session->set_flashdata('success', 'Ai sters cu succes cache-ul.');

        $this->db->cache_delete_all();

        redirect(base_url(""));

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