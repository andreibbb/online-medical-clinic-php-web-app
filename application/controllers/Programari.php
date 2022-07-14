<?php

if ( ! defined('BASEPATH')) redirect(base_url());

class Programari extends CI_Controller {
    
    public function __construct() 
    {       
        parent:: __construct();
        
        $this->load->helper(array('url', 'cache_expire', 'htmlpurifier'));
        $this->load->model('Programari_model');     

        if(!($this->session->userdata('logged_in')['id'])) {
            $this->session->set_flashdata('error', 'Nu esti logat.');
            redirect(base_url('login'));
        }
    }
        
    public function index() {
        if (!is_cache_valid(md5('programari+index'), 600)){
            $this->db->cache_delete('programari');
            $this->db->cache_delete('programari', 'index');
        }

        $patientID = getUserData($this->session->userdata('logged_in')['id'], "id");
        $data["futureAppointments"] = $this->Programari_model->getFutureAppointments($patientID);
        $data["oldAppointments"] = $this->Programari_model->getOldAppointments($patientID);
        $data["personalInformations"] = $this->Programari_model->getPatientInfo($patientID)[0];

    	$data['main_content'] = 'programari_view';
        $this->load->view('includes/template.php', $data);
    }

    public function admin() {
        if (!is_cache_valid(md5('programari+admin'), 300)){
            $this->db->cache_delete('programari');
            $this->db->cache_delete('programari', 'admin');
        }

        if(getUserData($this->session->userdata('logged_in')['id'], "devowner") < 1) {
            $this->session->set_flashdata('error', 'Nu ai permisiunea necesara pentru a vedea aceasta pagina.');
            redirect(base_url(''));
        }

        $this->load->library('pagination');

        $data['results'] = array();
        
        $params             = array();
        $limit_per_page     = 40;
        $start_index        = ((int)$this->uri->segment(3)) ? (int)$this->uri->segment(3) : 0;
        $total_records      = $this->Programari_model->getTotalAppointments();
        if($start_index < 0 || $start_index > $total_records) $start_index = 0;
        
        if ($total_records > 0) 
        {
            // get current page records
            $data['results'] = $this->Programari_model->getAllAppointments($limit_per_page, $start_index);

            $config['base_url'] = base_url() . 'programari/admin/';
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

        $data['main_content'] = 'programari_admin_view';
        $this->load->view('includes/template.php', $data);
    }

    public function view() {
        if (!is_cache_valid(md5('programari+view'), 600)){
            $this->db->cache_delete('programari', 'view');
        }

        $appointmentID = (int)html_purify($this->uri->segment(3), false);

        if(!is_numeric($appointmentID)) {
            $this->session->set_flashdata('error', 'Programarea pe care incerci sa o accesezi nu exista.');
            redirect(base_url('programari'));
        }

        $appointmentInfo = $this->Programari_model->getAppointment($appointmentID);

        if($appointmentInfo == false) {
            $this->session->set_flashdata('error', 'Programarea pe care incerci sa o accesezi nu exista.');
            redirect(base_url('programari'));
        }

        $patientID = getUserData($this->session->userdata('logged_in')['id'], "id");

        if($appointmentInfo->clientid != $patientID && getUserData($this->session->userdata('logged_in')['id'], "doctor") == 0 && getUserData($this->session->userdata('logged_in')['id'], "devowner") == 0) {
            $this->session->set_flashdata('error', 'Nu ai permisiunea necesara pentru a vedea aceasta programare.');
            redirect(base_url());
        }

        $data['appointmentInfo'] = $appointmentInfo;
        $data['doctorInfo'] = $this->Programari_model->getDoctorInfo($appointmentInfo->doctorid)[0];
        $data["personalInformations"] = $this->Programari_model->getPatientInfo($patientID)[0];
        $data["appointmentDetails"] = $this->Programari_model->getAppointmentDetails($appointmentInfo->id);

        $data['main_content'] = 'programari_single_view';
        $this->load->view('includes/template.php', $data);
    }
       
    public function aview() {
        if (!is_cache_valid(md5('programari+aview'), 600)){
            $this->db->cache_delete('programari', 'aview');
        }

        $appointmentID = (int)html_purify($this->uri->segment(3), false);

        if(!is_numeric($appointmentID)) {
            $this->session->set_flashdata('error', 'Programarea pe care incerci sa o accesezi nu exista.');
            redirect(base_url('programari'));
        }

        $appointmentInfo = $this->Programari_model->getAppointment($appointmentID);

        if($appointmentInfo == false) {
            $this->session->set_flashdata('error', 'Programarea pe care incerci sa o accesezi nu exista.');
            redirect(base_url('programari'));
        }

        $patientID = getUserData($this->session->userdata('logged_in')['id'], "id");

        if(getUserData($this->session->userdata('logged_in')['id'], "devowner") < 1) {
            $this->session->set_flashdata('error', 'Nu ai permisiunea necesara pentru a vedea aceasta pagina.');
            redirect(base_url(''));
        }

        $data['appointmentInfo'] = $appointmentInfo;
        $data['doctorInfo'] = $this->Programari_model->getDoctorInfo($appointmentInfo->doctorid)[0];
        $data["personalInformations"] = $this->Programari_model->getPatientInfo($patientID)[0];
        $data["appointmentDetails"] = $this->Programari_model->getAppointmentDetails($appointmentInfo->id);
        $data["workingHours"] = $this->Programari_model->getWorkingTime();
        $data["isHourAvailableByTimeAndDoctor"] = null;

        $hourIndex = 0;
        foreach($data["workingHours"] as $row) {
            if($this->Programari_model->checkDoctorAvailable($appointmentInfo->doctorid, $appointmentInfo->date, "".$row->hour.":".$row->minute."") == "true") {
                $data["isHourAvailableByTimeAndDoctor"][$hourIndex] = 1;
            } else {
                $data["isHourAvailableByTimeAndDoctor"][$hourIndex] = 0;
            }           
            //print_r($data["isHourAvailableByTimeAndDoctor"][$hourIndex]);
            //echo " - "; echo "".$row->hour.":".$row->minute.""; echo "<br>";

            $hourIndex = $hourIndex + 1;
        }
        //print_r($appointmentInfo->doctorid); echo "<br>";
        //print_r($appointmentInfo->date); echo "<br>"; 
        //return 43;

        $data['main_content'] = 'programari_asingle_view';
        $this->load->view('includes/template.php', $data);
    }
        

    public function addreview() {

        $postAppointmentID = (int)html_purify($this->input->post('idAppointment'), false);
        $patientID = (int)html_purify($this->input->post('patientID'), false);
        $doctorID = (int)html_purify($this->input->post('doctorID'), false);        
        $appointmentInfo = $this->Programari_model->getAppointment($postAppointmentID);

        if($appointmentInfo->clientid != $this->session->userdata('logged_in')['id'] || $this->session->userdata('logged_in')['id'] != $patientID) { 
            $this->session->set_flashdata('error', 'Nu poti lasa o recenzie la o programare care nu este pe numele tau!');
            redirect(base_url('programari/view/'.$postAppointmentID.''));
        }

        if($appointmentInfo->date >= date('m/d/Y', strtotime('-1 days'))) { 
            $this->session->set_flashdata('error', 'Nu poti lasa un review pentru o programare ce va avea loc in viitor!');
            redirect(base_url('programari/view/'.$postAppointmentID.''));
        }      

        if($appointmentInfo->reviewd > 0) {
            $this->session->set_flashdata('error', 'Ai acordat deja o recenzie pentru aceasta programare!');
            redirect(base_url('programari/view/'.$postAppointmentID.''));
        }

        if(getUserData($this->session->userdata('logged_in')['id'], "doctor") != 0) { 
            $this->session->set_flashdata('error', 'Nu poti lasa o recenzie in calitate de doctor!');
            redirect(base_url('programari/view/'.$postAppointmentID.''));
        }      

        if($appointmentInfo->date <= date('m/d/Y', strtotime('-30 days'))) { 
            $this->session->set_flashdata('error', 'Poti lasa o recenzie in maximum 30 de zile de la data programarii.');
            redirect(base_url('programari/view/'.$postAppointmentID.''));
        }


        $ratingValue = (int)html_purify($this->input->post('notaservicii'), false);
        $message = html_purify(strip_tags($this->input->post('reviewmessage')), false);

        if(!is_numeric($ratingValue) || $ratingValue < 0 || $ratingValue > 5) {
            $this->session->set_flashdata('error', 'Form error.');
            redirect(base_url('programari/view/'.$postAppointmentID.''));
        }

        $this->Programari_model->updateDoctorRating($ratingValue, $doctorID);
        $this->Programari_model->insertIntoReviews($doctorID, $patientID, $message, $ratingValue);
        $this->Programari_model->updateReviewedAppointment($appointmentInfo->id);

        $this->db->cache_delete('programari', 'view');
        
        $this->session->set_flashdata('success', 'Ai trimis recenzia cu succes!');
        redirect(base_url('programari/view/'.$postAppointmentID.''));
    }
    
    public function acceptappointment() {
        if(getUserData($this->session->userdata('logged_in')['id'], "devowner") < 1) {
            $this->session->set_flashdata('error', 'Nu ai permisiunea necesara pentru a vedea aceasta pagina.');
            redirect(base_url(''));
        }

        $appointmentID = (int)html_purify($this->input->post('appointmentID'), false);

        if($this->session->has_userdata('postTimeoutAppointmentChange') && (time() - $this->session->userdata('postTimeoutAppointmentChange') ) < 30) {
            $this->session->set_flashdata("error", "Trebuie sa mai astepti <span id='restofseconds'>".(30-(time()-$this->session->userdata('postTimeoutpw')))."</span> minute de la ultima actiune pentru a face asta!");
            redirect(base_url("programare/aview/".$appointmentID.""));
        }

        $getAppointment = $this->Programari_model->getAppointment($appointmentID);

        if($getAppointment != false) {
            $choicedHour = html_purify($this->input->post('choicenHour'), false);
            $this->db->query("UPDATE `appointments` SET `verified` = 1, `confirmed_hour` = ? WHERE id = ?", array($choicedHour, $appointmentID));

            $this->db->cache_delete('programari', 'aview');
            $this->db->cache_delete('programari', 'admin');
            $this->db->cache_delete('programari', 'index');
            
            insertNotification($getAppointment->clientid, "Programarea ta (ID:".$appointmentID.") la medicul ".getUserFullName($getAppointment->doctorid)." pentru ziua de ".$getAppointment->date." a fost acceptata pentru ora: ".$choicedHour.".", "programari/view/".$appointmentID);
            
            $this->session->set_flashdata('success', 'Programarea a fost acceptata cu succes!');
            redirect(base_url('programari/aview/'.$appointmentID));
        }
        else {
            $this->session->set_flashdata('error', 'Programarea nu a fost gasita.');
            redirect(base_url('programari/admin'));
        }

        $this->session->set_flashdata('error', 'Error!');
        redirect(base_url('programari/admin'));
    }

    public function cancelappointment() {
        if(getUserData($this->session->userdata('logged_in')['id'], "devowner") < 1) {
            $this->session->set_flashdata('error', 'Nu ai permisiunea necesara pentru a vedea aceasta pagina.');
            redirect(base_url(''));
        }

        $appointmentID = (int)html_purify($this->input->post('appointmentID'), false);

        if($this->session->has_userdata('postTimeoutAppointmentChange') && (time() - $this->session->userdata('postTimeoutAppointmentChange') ) < 30) {
            $this->session->set_flashdata("error", "Trebuie sa mai astepti <span id='restofseconds'>".(30-(time()-$this->session->userdata('postTimeoutpw')))."</span> minute de la ultima actiune pentru a face asta!");
            redirect(base_url("programare/aview/".$appointmentID.""));
        }

        $getAppointment = $this->Programari_model->getAppointment($appointmentID);

        if($getAppointment != false) {
            $this->db->query("UPDATE `appointments` SET `verified` = 2, `confirmed_hour` = 0 WHERE id = ?", array($appointmentID));

            $this->db->cache_delete('programari', 'aview');
            $this->db->cache_delete('programari', 'admin');
            $this->db->cache_delete('programari', 'index');
            
            insertNotification($getAppointment->clientid, "Programarea ta (ID:".$appointmentID.") la medicul ".getUserFullName($getAppointment->doctorid)." pentru ziua de ".$getAppointment->date." a fost anulata.", "programari/view/".$appointmentID);
            
            $this->session->set_flashdata('success', 'Programarea a fost anulata cu succes!');
            redirect(base_url('programari/aview/'.$appointmentID));
        }
        else {
            $this->session->set_flashdata('error', 'Programarea nu a fost gasita.');
            redirect(base_url('programari/admin'));
        }

        $this->session->set_flashdata('error', 'Error!');
        redirect(base_url('programari/admin'));
    }

    public function changedate() {
        if(getUserData($this->session->userdata('logged_in')['id'], "devowner") < 1) {
            $this->session->set_flashdata('error', 'Nu ai permisiunea necesara pentru a vedea aceasta pagina.');
            redirect(base_url(''));
        }

        $appointmentID = (int)html_purify($this->input->post('appointmentID'), false);

        if($this->session->has_userdata('postTimeoutAppointmentChange') && (time() - $this->session->userdata('postTimeoutAppointmentChange') ) < 30) {
            $this->session->set_flashdata("error", "Trebuie sa mai astepti <span id='restofseconds'>".(30-(time()-$this->session->userdata('postTimeoutpw')))."</span> minute de la ultima actiune pentru a face asta!");
            redirect(base_url("programare/aview/".$appointmentID.""));
        }

        $getAppointment = $this->Programari_model->getAppointment($appointmentID);

        if($getAppointment != false) {
            $newDate = html_purify($this->input->post('appdate'), false);
            $this->db->query("UPDATE `appointments` SET `date` = ?, `verified` = 0, confirmed_hour = NULL WHERE id = ?", array($newDate, $appointmentID));

            insertNotification($getAppointment->clientid, "Programarea ta (ID:".$appointmentID.") la medicul ".getUserFullName($getAppointment->doctorid)." pentru ziua de ".$getAppointment->date." a fost schimbata pentru noua data de:".$newDate.".", "programari/view/".$appointmentID);
            
            $this->db->cache_delete('programari', 'aview');
            $this->db->cache_delete('programari', 'admin');
            $this->db->cache_delete('programari', 'index');
        
            $this->session->set_flashdata('success', 'Data programarii a fost schimbata cu succes!');
            redirect(base_url('programari/aview/'.$appointmentID));
        }
        else {
            $this->session->set_flashdata('error', 'Programarea nu a fost gasita.');
            redirect(base_url('programari/admin'));
        }

        $this->session->set_flashdata('error', 'Error!');
        redirect(base_url('programari/admin'));
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
