<?php

if ( ! defined('BASEPATH')) redirect(base_url());

class Programare extends CI_Controller {
    
    public function __construct() 
    {       
        parent:: __construct();
        
        $this->load->helper(array('url', 'cache_expire', 'htmlpurifier'));
        $this->load->model('Programare_model');     

        if(!($this->session->userdata('logged_in')['id'])) {
            $this->session->set_flashdata('error', 'Nu esti logat.');
            redirect(base_url('login'));
        }
    }
        
    public function index() {
    	redirect(base_url("programare/new"));		
    }

    public function new() {   
    	$idDoctor = (int)html_purify($this->uri->segment(3), false);

    	if($idDoctor < 1) {
    		$this->session->set_flashdata('error', 'ID invalid!');
    		redirect(base_url("medici"));
    	}

    	if(!is_numeric($idDoctor) || getUserData($idDoctor, "doctor") != "1") {
    		$this->session->set_flashdata('error', 'Doctorul cautat nu a fost gasit in baza de date!');
            redirect(base_url("medici"));		
    	}

    	$data["doctorInfo"] = $this->Programare_model->getDoctorInfo($idDoctor)[0];
    	$data["patientInfo"] = $this->Programare_model->getPatientInfo($this->session->userdata('logged_in')["id"])[0];

        $data['main_content'] = 'programare_create_view';
        $this->load->view('includes/template.php', $data);
    }

    public function send() {       
    	$doctorID = (int)html_purify($this->input->post('doctorID'), false);

        if($doctorID < 1) {
            $this->session->set_flashdata('error', 'ID invalid!');
            redirect(base_url("medici"));
        }

        if(!is_numeric($doctorID) || getUserData($doctorID, "doctor") != "1") {
            $this->session->set_flashdata('error', 'Doctorul cautat nu a fost gasit in baza de date!');
            redirect(base_url("medici"));       
        }

    	if($this->session->has_userdata('postTimeoutpw') && (time() - $this->session->userdata('postTimeoutpw') ) < 10) {
            $this->session->set_flashdata("error", "Trebuie sa mai astepti <span id='restofseconds'>".(round((3600-(time()-$this->session->userdata('postTimeoutpw')))/60))."</span> minute de la ultima programare pentru a face alta!");
            redirect(base_url("programare/new/".$doctorID.""));
        }

        $choicedDate = html_purify($this->input->post('appdate'), false);
        if($choicedDate < date('m/d/Y')) {
            $this->session->set_flashdata('error', 'Nu poti face o programare pentru o data din trecut!');
            redirect(base_url("programare/new/".$doctorID.""));
        }
        
		$choicedHour = html_purify($this->input->post('oraradio'), false);

        if($choicedHour == "pana12") {
            $value = $this->Programare_model->getAppointmentsByDate($doctorID, $choicedHour);
            if($value > 5) 
            {
                $this->session->set_flashdata('error', 'Sunt deja prea multe solicitari de programari in asteptare pentru intervalul orar '.interval_orar($choicedHour).' din ziua '.$choicedDate.'!<br>Incearca alt interval orar sau alta data.');
                redirect(base_url("programare/new/".$doctorID.""));
            }
        } elseif ($choicedHour == "intre1417") {
            $value = $this->Programare_model->getAppointmentsByDate($doctorID, $choicedHour);
            if($value > 3) 
            {
                $this->session->set_flashdata('error', 'Sunt deja prea multe solicitari de programari in asteptare pentru intervalul orar '.interval_orar($choicedHour).' din ziua '.$choicedDate.'!<br>Incearca alt interval orar sau alta data.');
                redirect(base_url("programare/new/".$doctorID.""));
            }
        } elseif ($choicedHour == "dupa17") {
            $value = $this->Programare_model->getAppointmentsByDate($doctorID, $choicedHour);
            if($value > 6) 
            {
                $this->session->set_flashdata('error', 'Sunt deja prea multe solicitari de programari in asteptare pentru intervalul orar '.interval_orar($choicedHour).' din ziua '.$choicedDate.'!<br>Incearca alt interval orar sau alta data.');
                redirect(base_url("programare/new/".$doctorID.""));
            }
        }
		$moreInformations = html_purify($this->input->post('alteinfo'), false);
		$contactOption = html_purify($this->input->post('contactOption'), false);

        $this->session->set_userdata('postTimeoutpw', time());

		if($this->Programare_model->sendAppointment(getUserData($this->session->userdata('logged_in')["id"], "id"), $doctorID, $choicedDate, $choicedHour, $contactOption, $moreInformations) != false) {
            $this->db->cache_delete('programari');
            $this->db->cache_delete('programari', 'index');

			$this->session->set_flashdata('success', 'Solicitarea dvs. a fost trimisa cu succes! Vei primi o notificare pe website sau vei fi contactat cand aceasta va fi acceptata!');
			redirect(base_url("profile/".$this->session->userdata('logged_in')["id"].""));
		} else {
			$this->session->set_flashdata('error', 'Eroare la transmiterea datelor catre baza de date!');
            redirect(base_url("programare/new/".$doctorID.""));
		}
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
