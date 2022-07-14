<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Notification extends CI_Controller {
    
    public function __construct() 
    {       
         parent:: __construct();
         $this->load->model('Notification_model'); 
         $this->load->helper(array('url', 'form', 'cache_expire'));

         if(!($this->session->userdata('logged_in')['id'])) {
            $this->session->set_flashdata('error', 'Nu esti logat.');
            redirect(base_url('login'));
        }
    }
    
    public function index() {      
        if (!is_cache_valid(md5('notification+index'), 300)){
            $this->db->cache_delete('notification');
            $this->db->cache_delete('notification', 'index');
        }

        if($this->session->has_userdata('postTimeoutMarkAll') && (time() - $this->session->userdata('postTimeoutMarkAll')) < 3600) 
        {
            $this->session->set_userdata('postTimeoutMarkAll', time());
            $this->Notification_model->readNotifications($this->session->userdata('logged_in')['id']);
            $this->db->cache_delete('notification');
            $this->db->cache_delete('notification', 'index');
        }

        $data["notification"] = $this->Notification_model->getNotificationsByUser($this->session->userdata('logged_in')['id']);       
        $data["main_content"] = 'notification_view';
        $this->load->view('includes/template.php', $data);
    }

    public function markall() {
        if(!($this->session->userdata('logged_in')['id'])) {
            $this->session->set_flashdata('error', 'Nu esti logat.');
            redirect(base_url('login'));
        }

        if($this->session->has_userdata('postTmNotification') && (time() - $this->session->userdata('postTmNotification') ) < 600) 
        {
                $this->session->set_flashdata("error", "Trebuie sa mai astepti <span id='restofseconds'>".(round((3600-(time()-$this->session->userdata('postTmNotification')))/60))."</span> minute pentru a marca toate notificarile ca citite.");
                redirect(base_url("notification"));
        }
        else
        {
            $this->Notification_model->readNotificationsAll($this->session->userdata('logged_in')['id']);
            $this->db->cache_delete('notification');
            $this->db->cache_delete('notification', 'index');
            $this->session->set_userdata('postTmNotification', time()); 

            $this->session->set_flashdata('success', 'Ai marcat toate notificarile ca citite.');
            redirect(base_url("notification"));
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