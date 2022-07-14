<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class Main extends CI_Controller {

    public function __construct() 
    {   
        parent:: __construct();
        $this->load->model('Main_model');  
    }

    public function index()
    {
    	$data["last3news"] = $this->Main_model->getNews();
    	$data["usersLoggedInLast24Hours"] = $this->Main_model->getLoggedInLast24Hours();
    	$data["conturiCreate"] = $this->Main_model->createdAccounts();
    	$data["appointmentsInLast24Hours"] = $this->Main_model->getAppointmentsInLast(strtotime('-1 days'));
    	$data["appointmentsInLast30days"] = $this->Main_model->getAppointmentsInLast(strtotime('-30 days'));    	
    	$data["numberOfDoctors"] = $this->Main_model->numberOfDoctors();
    	

    	if($this->session->userdata('logged_in')['id']) {
    		$data["appointmentInfo"] = $this->Main_model->getFutureAppointments($this->session->userdata('logged_in')['id']);
    	}

        $data["main_content"] = 'main_view';
        $this->load->view('includes/template.php', $data);
    }

}