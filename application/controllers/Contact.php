<?php

if ( ! defined('BASEPATH')) redirect(base_url());

class Contact extends CI_Controller {
    public function __construct() 
    {       
        parent:: __construct();

        if(!($this->session->userdata('logged_in')["id"])) {
            $this->session->set_flashdata('error', 'Nu esti logat.');
            redirect(base_url("login"));
        }


        if (!is_cache_valid(md5('contact'), 450)){
            $this->db->cache_delete('contact', 'lista');
        }

        $this->load->helper(array('url', 'cache_expire', 'htmlpurifier'));
        $this->load->model("Contact_model");

        if(!($this->session->userdata('logged_in')["id"])) {
            $this->session->set_flashdata('error', 'Nu esti logat.');
            redirect(base_url("login"));
        }
    }

    public function index() {
        redirect(base_url("contact/lista"));
    }

	function containsWord($str, $word)
    {
		return !!preg_match('#\\b' . preg_quote($word, '#') . '\\b#i', $str);
	}

    public function view() {
        $ticketID = $this->Contact_model->getTicketInfo($this->uri->segment(3), "id");

        if(!is_numeric($ticketID)) {
            $this->session->set_flashdata('error', 'Ticket inexistent.');
            redirect(base_url("contact/lista"));
        }

        $ticketStarter = $this->Contact_model->getTicketInfo($ticketID, "clientid");
        $ticketReasonID = $this->Contact_model->getTicketInfo($ticketID, "type");
        $permissionChecker = getUserData($this->session->userdata("logged_in")["id"], "devowner");
        $data["permissionChecker"] = $permissionChecker;

        if($ticketStarter == $this->session->userdata("logged_in")["id"] || $permissionChecker > 0)
        {   
            $data["comment"]            = $this->Contact_model->getTicketComments($ticketID);
            $data["ticketID"]           = $ticketID;

            $ticketInfo = $this->Contact_model->getTicketAllInfo($ticketID);
            $data["ticketIP"]           = $ticketInfo[0]->postedip;
            $data["ticketStatus"]       = $ticketInfo[0]->status;
            $data["ticketReason"]       = getContactReason($ticketInfo[0]->type);
            $data["ticketType"]         = $ticketInfo[0]->type;
            $data["ticketDescription"]  = $ticketInfo[0]->message;
            $data["ticketStarterDate"]  = $ticketInfo[0]->time;
            $data["ticketStarter"]      = $ticketStarter;
            $data["ticketStarterInfo"]  = $this->Contact_model->getUserInfo($ticketStarter);
            $data["lastTicketsBy"]      = $this->Contact_model->getLastTicketsBy($ticketStarter);
        }
        else {
            $this->session->set_flashdata('error', 'Nu ai gradul administrativ necesar pentru a vedea acest ticket.');
            redirect(base_url("contact/lista"));
        }

        $data["main_content"] = 'contact/ticket_view';
        $this->load->view('includes/template.php', $data);
    }

    public function create() {

        $data["main_content"] = 'contact/ticket_create';
        $this->load->view('includes/template.php', $data);
    }

    public function createticket() {
        $asset                = [];
        $asset["description"] = html_purify($this->input->post("currentDescription"));
        $asset["reason"]      = strtolower(strip_non_utf($this->input->post("reason")));

        if(in_array(strtolower($asset["reason"]), array("suportclienti", "tehnic", "financiar", "sesizari", "feedback"))) {
            if(strlen($asset["description"]) > 10) {
                if($this->session->has_userdata('createTicketTimeout') && (time() - $this->session->userdata('createTicketTimeout') ) < 900) {
                    $this->session->set_flashdata("error", "Trebuie sa mai astepti <span id='restofseconds'>".(900-(time()-$this->session->userdata('createTicketTimeout')))."</span> secunde de la ultimul ticket creat pentru a face altul.");
                    redirect(base_url("contact/lista"));
                } 

                $this->Contact_model->insertTicket($this->session->userdata("logged_in")["id"], $asset["reason"], $asset["description"]);
                $this->session->set_userdata('createTicketTimeout', time());
                
                $this->db->cache_delete('contact', 'lista');                
                $this->session->set_flashdata('success', 'Ai creat cu succes.');
                redirect(base_url("contact/lista"));
            } else {
                $this->session->set_flashdata('error', 'Mesajul tau trebuie sa contina cel putin 10 caractere.');
                redirect(base_url("contact/create"));
            }
        } else { 
            $this->session->set_flashdata('error', 'Motiv invalid.');
            redirect(base_url("contact/create"));            
        }
    }

    public function lista() {
        $this->load->library('pagination');

        if (!is_numeric($this->uri->segment(3)) && $this->uri->segment(3) != null) {
            $this->session->set_flashdata('error', 'ID invalid.');
            redirect(base_url());
        }

	    $permissionChecker = getUserData($this->session->userdata('logged_in')["id"], "devowner");

        $data["results"] = array();
        $params = array();
        $limit_per_page = 20;
        $start_index        = ((int)$this->uri->segment(3)) ? (int)$this->uri->segment(3) : 0;

        if($permissionChecker >= 1) 
        {
            $total_records = $this->Contact_model->getTotalTickets();
        }
        else
        {
            $total_records = $this->Contact_model->getTotalTicketsBy($this->session->userdata('logged_in')["id"]);
        }

        if($start_index < 0 || $start_index > $total_records) $start_index = 0;

        if ($total_records > 0) 
        {
            // get current page records
            if($permissionChecker >= 1) 
	        {
                $data["results"] = $this->Contact_model->getTickets($limit_per_page, $start_index);
	        }
	        else
	        {
	        	$data["results"] = $this->Contact_model->getTicketsBy($this->session->userdata('logged_in')["id"], $limit_per_page, $start_index);
	        } 
            
            $config['base_url'] = base_url() . 'contact/lista';
            $config['total_rows'] = $total_records;
            $config['per_page'] = $limit_per_page;
            $config["uri_segment"] = 3;

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

        $data["main_content"] = 'contact/tickets_view';
        $this->load->view('includes/template.php', $data);
    }

    private function insertcomment() {
        $ticketID = $this->Contact_model->getTicketInfo($this->uri->segment(3), "id");

        if(!is_numeric($ticketID) || get_info('status', 'tickets', 'id', $this->uri->segment(3)) != 0) {
            $this->session->set_flashdata('error', 'Ticket inexistent.');
            redirect(base_url("contact/lista"));
        }

        $ticketStarterName = $this->Contact_model->getTicketInfo($ticketID, "clientid");
        if($ticketStarterName != $this->session->userdata("logged_in")["id"])
  		{
            if(getUserData($this->session->userdata("logged_in")["id"], "devowner") < 1) 
	        {
	            $this->session->set_flashdata('error', 'Nu ai permisiunea necesara pentru a face aceasta actiune.');
                redirect(base_url("contact/lista"));
	        }
        }

        $postandclose = $this->input->post("postandclose");
        $postinput = $this->input->post('comment');

        if(isset($postandclose)) {
            $new_comment = "" . $postinput . "<br><b>Admin action:</b> Topic closed!";
            $comment = html_purify($new_comment);
        }
        else {
            $comment = html_purify($postinput);
        }

        $comment = nl2br($comment);
        
        if(!strlen($comment)) {
            $this->session->set_flashdata("error", "Nu poti sa introduci un comentariu gol.");
            redirect(base_url("contact/view/" . $ticketID));
        }

        if($this->session->has_userdata('postTimeout') && (time() - $this->session->userdata('postTimeout') ) < 15) {
            $this->session->set_flashdata("error", "Trebuie sa mai astepti <span id='restofseconds'>".(15-(time()-$this->session->userdata('postTimeout')))."</span> secunde de la ultima actiune.");
            redirect(base_url("contact/view/" . $ticketID));
        } else {
            $this->Contact_model->insertComment($comment, $this->session->userdata("logged_in")["id"], $ticketID);

            if(isset($postandclose) && getUserData($this->session->userdata("logged_in")["id"], "devowner") > 0) {
                $this->Contact_model->closeTicket($ticketID);
            }
            
            insertNotification(get_info("clientid", "tickets", "id", $this->uri->segment(3)), "Administratorul ". getUserFullName($this->session->userdata("logged_in")["id"]) . " a adaugat un nou comentariu in ticket-ul tau.", "contact/view/".$ticketID);

            $this->db->cache_delete('contact', 'lista');
            $this->db->cache_delete('contact', 'view');
            $this->session->set_userdata('postTimeout', time());   
            redirect(base_url("contact/view/" . $ticketID));
        }
    }

    public function changeCategory() {
        if(getUserData($this->session->userdata("logged_in")["id"], "devowner") > 0) {
            $newCategory = (int)$this->input->post("newCategory");
            $tID         = (int)$this->input->post("ticketID");

            if(get_info('id', 'tickets', 'id', $tID) < 0 || !is_numeric(get_info('id', 'tickets', 'id', $tID)) || get_info('status', 'tickets', 'id', $tID) != 0) {
                $this->session->set_flashdata('error', 'Reclamatie invalida.');
                redirect(base_url('complaint/lista'));
            }

            if($this->session->has_userdata('postTimeoutCategorie') && (time() - $this->session->userdata('postTimeoutCategorie') ) < 10) {
                $this->session->set_flashdata("error", "Trebuie sa mai astepti <span id='restofseconds'>".(10-(time()-$this->session->userdata('postTimeoutCategorie')))."</span> secunde de la ultima actiune.");
                redirect(base_url("contact/view/" . $tID));
            }

            if(in_array($newCategory, array("1", "2", "3", "4", "5"))) {
                
                $this->Contact_model->changeCategory($newCategory, $tID);

                panel_log($this->session->userdata("logged_in")["id"] . " " . getUserFullName($this->session->userdata("logged_in")["id"]) . " a editat categoria ticketului ID:" . $tID . "", $this->session->userdata("logged_in")["id"]);
                
                $this->Contact_model->insertComment("<b>Admin action:</b> Categorie schimbata in '" . getContactReason($newCategory) . "'.", $this->session->userdata("logged_in")["id"], $tID);
                $this->session->set_userdata('postTimeoutCategorie', time()); 

                $this->db->cache_delete('contact', 'view');
                $this->session->set_flashdata("success", "Ai schimbat cu succes categoria.");
                redirect(base_url("contact/view/" . $tID));
            } else {
                $this->session->set_flashdata("error", "Categorie invalida.");
                redirect(base_url());
            }
        }
    }
    
    function editpost() {
        if(!($this->session->userdata('logged_in')["id"])) {
            $this->session->set_flashdata('error', 'Nu esti logat.');
            redirect(base_url("login"));
        }

        if($this->session->has_userdata('postTimeoutedit') && (time() - $this->session->userdata('postTimeoutedit') ) < 15) {
            echo "_t43SCZq3czbhyy";
        } else 
        {
            $ticketid = html_purify($this->input->post('ticketid', true), false);

                $cid = html_purify($this->input->post('postcid', true), false);

                if(getUserData($this->session->userdata('logged_in')["id"], "devowner") > 0) {
                    $this->session->set_userdata('postTimeoutedit', time());         
                    $textnou = html_purify($this->input->post('postnou'));
                    $query = $this->db->query("UPDATE `reply_tickets` SET `text` = ?, `lasteditby` = ?, `lastedit` = ? WHERE `id` = ? LIMIT 1", array($textnou, $this->session->userdata('logged_in')["id"], time(), $cid));
                    panel_log(getUserFullName($this->session->userdata("logged_in")["id"]) . " si-a editat comentariul cu idul ".$cid." din ticketul cu id: " . $ticketid .".", getUserData($this->session->userdata("logged_in")["id"], "id"));
                    $this->db->cache_delete('contact', 'view', $ticketid);
                } elseif($this->session->userdata('logged_in')["id"] == get_info("clientid", "reply_tickets", "id", $cid) && get_info("time", "reply_tickets", "id", $cid) + 900 < time()) {
                    $this->session->set_userdata('postTimeoutedit', time());         
                    $textnou = html_purify($this->input->post('postnou'));
                    $query = $this->db->query("UPDATE `reply_tickets` SET `text` = ?, `lasteditby` = ?, `lastedit` = ? WHERE `id` = ? LIMIT 1", array($textnou, $this->session->userdata('logged_in')["id"], time(), $cid));
                    panel_log(getUserFullName($this->session->userdata("logged_in")["id"]) . " si-a editat comentariul cu idul ".$cid." din ticketul cu id: " . $ticketid .".", getUserData($this->session->userdata("logged_in")["id"], "id"));
                    $this->db->cache_delete('contact', 'view', $ticketid);
                } else {
                echo "_t43SCZq3czbhyy";
                }
        }
    }

    function deletepost() {
        if(!($this->session->userdata('logged_in')["id"])) {
            $this->session->set_flashdata('error', 'Nu esti logat.');
            redirect(base_url("login"));
        }

        if($this->session->has_userdata('postTimeoutdelete') && (time() - $this->session->userdata('postTimeoutdelete') ) < 15) {
            echo "_tb32wfvs65jghxx";
        } else 
        {
            $ticketid = html_purify($this->input->post('ticketid', true), false);

                $cid = html_purify($this->input->post('postcid', true), false);

                if(getUserData($this->session->userdata('logged_in')["id"], "devowner") > 0 || ($this->session->userdata('logged_in')["id"] == get_info("clientid", "reply_tickets", "id", $cid) && get_info("time", "reply_tickets", "id", $cid) + 900 > time())) { 
                    $this->session->set_userdata('postTimeoutdelete', time());      
                    panel_log(getUserFullName($this->session->userdata("logged_in")["id"]) . " si-a sters comentariul din ticketul cu id: " . $ticketid .".", getUserData($this->session->userdata("logged_in")["id"], "id"));
                    $query = $this->db->query("UPDATE `reply_tickets` SET `hide` = 1 WHERE `id` = ? LIMIT 1", array($cid));
                    $this->db->cache_delete('contact', 'view', $ticketid);
                    }
                    else
                    {
                        echo "_tb32wfvs65jghxx";
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

