<?php

if ( ! defined('BASEPATH')) redirect(base_url());

class Programaridoctor extends CI_Controller {
    
    public function __construct() 
    {       
        parent:: __construct();
        
        $this->load->helper(array('url', 'cache_expire', 'htmlpurifier'));
        $this->load->model('Programaridoctor_model');     

        if(!($this->session->userdata('logged_in')['id'])) {
            $this->session->set_flashdata('error', 'Nu esti logat.');
            redirect(base_url('login'));
        }

        if(getUserData($this->session->userdata('logged_in')['id'], "doctor") == 0) {
            $this->session->set_flashdata('error', 'Nu ai permisiunea necesara.');
            redirect(base_url(''));
        }
    }
        
    public function index() {
        if (!is_cache_valid(md5('Programaridoctori+index'), 600)){
            $this->db->cache_delete('Programaridoctor');
            $this->db->cache_delete('Programaridoctor', 'index');
        }

        $doctorID = getUserData($this->session->userdata('logged_in')['id'], "id");
        $data["todayAppointments"] = $this->Programaridoctor_model->getTodayAppointments($doctorID);
        $data["tomorrowAppointments"] = $this->Programaridoctor_model->getFutureAppointments($doctorID);
        $data["personalInformations"] = $this->Programaridoctor_model->getUserInfo($doctorID)[0];
        $data["yesterdayAppointments"] = $this->Programaridoctor_model->getYesterdayAppointments($doctorID);

    	$data['main_content'] = 'programaridoctor_view';
        $this->load->view('includes/template.php', $data);
    }

    public function addinfotoappointment() {
        if($this->session->has_userdata('postTimeoutUpdateAppointmentD') && (time() - $this->session->userdata('postTimeoutUpdateAppointmentD') ) < 120) {
            $this->session->set_flashdata("error", "Trebuie sa mai astepti <span id='restofseconds'>".(120-(time()-$this->session->userdata('postTimeoutUpdateAppointmentD')))."</span> secunde pana sa poti face asta.");
            redirect(base_url('profile/'.$userID));
        }

        $appointmentID = (int)html_purify($this->input->post('appointmentID'), false);
        $diagnostic = strip_tags(html_purify($this->input->post('diagnostic', TRUE), false));
        $treatment = strip_tags(html_purify($this->input->post('treatment', TRUE), false));
        $recommandation = strip_tags(html_purify($this->input->post('recommandation', TRUE), false));
        $nextAppointment = strip_tags(html_purify($this->input->post('next_appointment', TRUE), false));
        $moreInformations = strip_tags(html_purify($this->input->post('more_informations', TRUE), false));
        
        if($this->session->userdata('logged_in')['id'] ==  $this->Programaridoctor_model->getAppointmentDoctor($appointmentID)) {
            if($this->Programaridoctor_model->getAppointmentDetails($appointmentID) == false) {
                $this->db->query("INSERT INTO `appointments_results` (`appointmentID`, `diagnostic`, `treatment`, `recommandation`, `next_appointment`, `more_informations`) VALUES (?, ?, ?, ?, ?, ?)", array($appointmentID, $diagnostic, $treatment, $recommandation, $nextAppointment, $moreInformations));

                $this->session->set_userdata('postTimeoutUpdateAppointmentD', time());
                $this->db->cache_delete('programari', 'view');
            }
            else {
                $value = $this->Programaridoctor_model->getAppointmentDetails($appointmentID);
                $this->db->query("UPDATE `appointments_results` SET diagnostic = ?, treatment = ?, recommandation = ?, next_appointment = ?, more_informations = ? WHERE `id` = ? AND appointmentID = ?", array($value->id, $appointmentID));

                $this->session->set_userdata('postTimeoutUpdateAppointmentD', time());
                $this->db->cache_delete('programari', 'view');
            }

            $this->session->set_flashdata('success', 'Ai actualizat cu succes informatiile programarii.');
            redirect(base_url('programari/view/'.$appointmentID));

        } else {
            $this->session->set_flashdata('error', 'Nu esti doctorul atribuit acestei programari.');
            redirect(base_url('programari/view/'.$appointmentID));
        }

        $this->session->set_flashdata('error', 'Nu ai permisiunea necesara.');
        redirect(base_url(''));
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
