<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Profile extends CI_Controller {

    public function __construct() 
    {       
        parent:: __construct();
        $this->load->model('Profile_model');  
        $this->load->helper(array('url', 'form', 'htmlpurifier', 'cache_expire'));
    }

    public function index() {

        if(!($this->uri->segment(2))) {
            $this->session->set_flashdata('error', 'Profil inexistent.');
            redirect(base_url());
        }

        $id_player = getUserData($this->uri->segment(2), "id");

        if($id_player < 0) {
            $this->session->set_flashdata('error', 'Utilizator inexistent.');
            redirect(base_url());
        }

        if($id_player != $this->session->userdata('logged_in')["id"] && getUserData($this->session->userdata('logged_in')["id"], "doctor") == 0 && getUserData($this->session->userdata('logged_in')["id"], "devowner") == 0) {
            $this->session->set_flashdata('error', 'Acces nepermis. Nu ai suficiente permisii pentru a accesa aceasta pagina.');
            redirect(base_url());
        }

        if (!is_cache_valid(md5('profile+' . $id_player . ''), 400)){
            $this->db->cache_delete('profile', $id_player);
        }

        if($id_player > 0) {
            $data['info'] = $this->Profile_model->getProfileData($id_player)[0];
            if(getUserData($id_player, "doctor") == 0) {
                $data["appointmentInfo"] = $this->Profile_model->getFutureAppointments($id_player);
            }
            $data['loggedin'] = $this->Profile_model->getLoggedData($this->session->userdata('logged_in')["id"])[0];

            $data["main_content"] = 'profile_view';
            $this->load->view('includes/template.php', $data); 
        } else {
            $this->session->set_flashdata('error', 'Profil inexistent.');
            redirect(base_url());
        }
    }

    public function editprofile() {
        if(!($this->session->userdata('logged_in')["id"])) {
            
            $this->session->set_flashdata('error', 'Nu esti logat.');
            redirect(base_url());
        }

        if (!is_cache_valid(md5('profile+editprofile'), 400)) {
            $this->db->cache_delete('profile', 'editprofile');
        }

        $data['info'] = $this->Profile_model->getProfileData($this->session->userdata('logged_in')["id"])[0];

        $data["main_content"] = 'editprofile_view';
        $this->load->view('includes/template.php', $data); 
    }

    public function updateprofile() {
        if(!($this->session->userdata('logged_in')["id"])) {
            $this->session->set_flashdata('error', 'Nu esti logat.');
            redirect(base_url());
        }

        $nume = html_purify($this->input->post('nume'), false);
        $prenume = html_purify($this->input->post('prenume'), false);
        $email = html_purify($this->input->post('email'), false);
        $birth = html_purify($this->input->post('birth1'), false);
        $telefon = html_purify($this->input->post('telefon'), false);
        $location = html_purify($this->input->post('location'), false);
        $adress = html_purify($this->input->post('adress'), false);
        $zipcode = html_purify($this->input->post('zipcode'), false);

        $this->db->query("UPDATE `users` SET `email` = ?, `nume` = ?, `prenume` = ?, `born_date` = ?, `phone` = ?, `location` = ?, `adress` = ?, `zipcode` = ? WHERE id = ?", array($email, $nume, $prenume, $birth, $telefon, $location, $adress, $zipcode, $this->session->userdata('logged_in')["id"]));
        $this->db->cache_delete('profile', $this->session->userdata('logged_in')["id"]);
        $this->db->cache_delete('profile', 'editprofile');

        $this->session->set_flashdata('success', 'Ti-ai schimbat poza de profil cu succes!');
        redirect(base_url('profile/editprofile'));
    }

    public function updatephoto()
    {
        if(!($this->session->userdata('logged_in')["id"])) {
            
            $this->session->set_flashdata('error', 'Nu esti logat.');
            redirect(base_url());
        }

        $config['upload_path']          = './assets/img/profilepictures/';
        $config['allowed_types']        = 'jpg|png';
        $config['max_size']             = 4096;
        $config['max_width']            = 10200;
        $config['max_height']           = 5000;
        $config['overwrite']     = FALSE;
        $config['file_ext_tolower'] = TRUE;
        $config['file_name'] = md5("uid".$this->session->userdata('logged_in')["id"]."".time()."");
        $config['master_dim']       = 'width'; 
        $config['width']            = 355;

        $this->load->library('image_lib', $config);
        $this->image_lib->initialize($config);
        $this->image_lib->resize();

        $this->load->library('upload', $config);

        if(!$this->upload->do_upload('profilepicture'))
        {               
            $this->session->set_flashdata('error', ''.$this->upload->display_errors().'');
            redirect(base_url('profile/editprofile'));
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

            $this->db->query("UPDATE `users` SET `picture_path` = ? WHERE `id` = ?", array($data_info['file_name'], $this->session->userdata('logged_in')["id"]));
            $this->db->cache_delete('profile', $this->session->userdata('logged_in')["id"]);
            $this->db->cache_delete('profile', 'editprofile');

            $this->session->set_flashdata('success', 'Ti-ai schimbat poza de profil cu succes!');
            redirect(base_url('profile/editprofile'));
        }
    }

    public function setdoctorroles() {
        if(!($this->session->userdata('logged_in')["id"])) {
            
            $this->session->set_flashdata('error', 'Nu esti logat.');
            redirect(base_url());
        }

        $userID = (int)html_purify($this->input->post("userID"), false);

        if(getUserData($this->session->userdata('logged_in')["id"], "devowner") < 1) {
            $this->session->set_flashdata('error', 'Nu ai permisiunea de a accesa acea pagina!');
            redirect(base_url('profile/'.$userID));
        }

        if($this->session->has_userdata('postTimeoutDoctorRole') && (time() - $this->session->userdata('postTimeoutDoctorRole') ) < 1) {
            $this->session->set_flashdata("error", "Trebuie sa mai astepti <span id='restofseconds'>".(60-(time()-$this->session->userdata('postTimeoutDoctorRole')))."</span> secunde pana sa poti face asta.");
            redirect(base_url('profile/'.$userID));
        }

        if(getUserData($userID, "id") < 0) {
            $this->session->set_flashdata('error', 'Utilizatorul nu exista!');
            redirect(base_url());
        }

        $this->load->library('form_validation');
        $this->form_validation->set_rules('specializare1', 'Prima specializare', 'differs[specializare2]|differs[specializare3]|differs[specializare4]|numeric|less_than[56]');
        $this->form_validation->set_rules('specializare2', 'A doua specializare', 'differs[specializare1]|differs[specializare3]|differs[specializare4]|numeric|less_than[56]');
        $this->form_validation->set_rules('specializare3', 'A treia specializare', 'differs[specializare1]|differs[specializare2]|differs[specializare4]|numeric|less_than[56]');
        $this->form_validation->set_rules('specializare4', 'A patra specializare', 'differs[specializare1]|differs[specializare2]|differs[specializare3]|numeric|less_than[56]');
          
        if($this->form_validation->run() == FALSE)
        {
            $data["main_content"] = 'profile_view';
            $this->load->view('includes/template.php', $data);
        }
        else
        {
            $firstType = (int)html_purify($this->input->post("specializare1"), false);
            $secondType = (int)html_purify($this->input->post("specializare2"), false);
            $thirdType = (int)html_purify($this->input->post("specializare3"), false);
            $fourthType = (int)html_purify($this->input->post("specializare4"), false);

            if(strlen($firstType) > 0 && strlen($secondType) > 0 && strlen($thirdType) > 0 && strlen($fourthType) > 0) {
                $this->db->query("UPDATE `users` SET `doctor_type1` = ?, `doctor_type2` = ?, `doctor_type3` = ?, `doctor_type4` = ? WHERE `id` = ?", array($firstType, $secondType, $thirdType, $fourthType, $userID));
            } elseif(strlen($firstType) > 0 && strlen($secondType) > 0 && strlen($thirdType) > 0) {
                $this->db->query("UPDATE `users` SET `doctor_type1` = ?, `doctor_type2` = ?, `doctor_type3` = ? = ? WHERE `id` = ?", array($firstType, $secondType, $thirdType, $userID));
            } elseif(strlen($firstType) > 0 && strlen($secondType) > 0) {
                $this->db->query("UPDATE `users` SET `doctor_type1` = ?, `doctor_type2` = ? WHERE `id` = ?", array($firstType, $secondType, $userID));
            } elseif(strlen($firstType) > 0) {
                $this->db->query("UPDATE `users` SET `doctor_type1` = ? WHERE `id` = ?", array($firstType, $userID));
            }

            $this->db->cache_delete('profile', $userID);
            $this->session->set_flashdata("error", "Succes ai setat tipul de doctor pentru user-ul cu ID: ".$userID."!");
            redirect(base_url('profile/'.$userID));

            $this->session->set_userdata('postTimeoutDoctorRole', time());
        }       

        $this->session->set_flashdata('error', 'Error!');
        redirect(base_url('profile/'.$userID));

    }

    public function setdoctor() {
        if(!($this->session->userdata('logged_in')["id"])) {
            
            $this->session->set_flashdata('error', 'Nu esti logat.');
            redirect(base_url());
        }

        $userID = (int)html_purify($this->input->post("userID"), false);

        if(getUserData($this->session->userdata('logged_in')["id"], "devowner") < 1) {
            $this->session->set_flashdata('error', 'Nu ai permisiunea de a accesa acea pagina!');
            redirect(base_url('profile/'.$userID));
        }

        if($this->session->has_userdata('postTimeoutaddDoctor') && (time() - $this->session->userdata('postTimeoutaddDoctor') ) < 1) {
            $this->session->set_flashdata("error", "Trebuie sa mai astepti <span id='restofseconds'>".(60-(time()-$this->session->userdata('postTimeoutaddDoctor')))."</span> secunde pana sa poti face asta.");
            redirect(base_url('profile/'.$userID));
        }  

        if(getUserData($userID, "id") < 0) {
            $this->session->set_flashdata('error', 'Utilizatorul nu exista!');
            redirect(base_url());
        }

        $this->db->cache_delete('profile', $userID);

        if(getUserData($userID, "doctor") > 0) {
            $this->db->query("UPDATE `users` SET `doctor` = 0 WHERE `id` = ?", array($userID));
            $this->session->set_userdata('postTimeoutaddDoctor', time());

            $this->session->set_flashdata("error", "Ai scos gradul de doctor pentru user-ul cu ID: ".$userID."!");
            redirect(base_url('profile/'.$userID));
        } else {
            $this->db->query("UPDATE `users` SET `doctor` = 1 WHERE `id` = ?", array($userID));
            $this->session->set_userdata('postTimeoutaddDoctor', time());

            $this->session->set_flashdata("error", "Ai setat gradul de doctor pentru user-ul cu ID: ".$userID."!");
            redirect(base_url('profile/'.$userID));
        }
       
        $this->session->set_flashdata("error", "Ai setat tipul de doctor pentru user-ul cu ID: ".$userID."!");
        redirect(base_url('profile/'.$userID));
    }

    public function setadmin() {
        if(!($this->session->userdata('logged_in')["id"])) {
            
            $this->session->set_flashdata('error', 'Nu esti logat.');
            redirect(base_url());
        }

        $userID = (int)html_purify($this->input->post("userID"), false);

        if(getUserData($this->session->userdata('logged_in')["id"], "devowner") < 1) {
            $this->session->set_flashdata('error', 'Nu ai permisiunea de a accesa acea pagina!');
            redirect(base_url('profile/'.$userID));
        }

        if($this->session->has_userdata('postTimeoutAddAdmin') && (time() - $this->session->userdata('postTimeoutAddAdmin') ) < 1) {
            $this->session->set_flashdata("error", "Trebuie sa mai astepti <span id='restofseconds'>".(60-(time()-$this->session->userdata('postTimeoutAddAdmin')))."</span> secunde pana sa poti face asta.");
            redirect(base_url('profile/'.$userID));
        }  

        if(getUserData($userID, "id") < 0) {
            $this->session->set_flashdata('error', 'Utilizatorul nu exista!');
            redirect(base_url());
        }

        $this->db->cache_delete('profile', $userID);

        if(getUserData($userID, "devowner") > 0) {
            $this->db->query("UPDATE `users` SET `devowner` = 0 WHERE `id` = ?", array($userID));
            $this->session->set_userdata('postTimeoutAddAdmin', time());

            $this->session->set_flashdata("error", "Ai scos gradul de doctor pentru user-ul cu ID: ".$userID."!");
            redirect(base_url('profile/'.$userID));
        } else {
            $this->db->query("UPDATE `users` SET `devowner` = 1 WHERE `id` = ?", array($userID));
            $this->session->set_userdata('postTimeoutAddAdmin', time());

            $this->session->set_flashdata("error", "Ai setat gradul de administrator pentru user-ul cu ID: ".$userID."!");
            redirect(base_url('profile/'.$userID));
        }
       
        $this->session->set_flashdata("error", "Ai setat tipul de administrator pentru user-ul cu ID: ".$userID."!");
        redirect(base_url('profile/'.$userID));
    }


    function _remap($method,$args)
    {
        if (method_exists($this, $method))
        {
            $this->$method($args);  
        } else {
            $this->index(str_replace("-", "_", $method),$args);
        }
    }
}