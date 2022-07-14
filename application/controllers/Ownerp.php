<?php



if ( ! defined('BASEPATH')) redirect(base_url());



/**

* Admin

* 

* 

* @package    T4P

* @subpackage Controller

*/





class Ownerp extends CI_Controller {



    public function __construct() 

    {       

        parent:: __construct();

        $this->load->model("Ownerp_model");

        $this->load->helper(array('url', 'cache_expire', 'htmlpurifier'));

        $this->db2 = $this->load->database('mydb2', TRUE);
        
       if(!($this->session->userdata('logged_in')["id"])) {
            $this->session->set_flashdata('error', 'Nu esti logat.');
            redirect(base_url());
        }        

        
        if(getUserData($this->session->userdata('logged_in')["id"], "Admin") < 7) {
            $this->session->set_flashdata('error', 'Nu esti owner.');
            redirect(base_url());
        }
    }



    public function index() {

        $serverHost                 = 150;

        $webHost                    = 30;

        if(!is_cache_valid(md5('ownerp'), 600)) {
            $this->db->cache_delete('ownerp');
        }

        $data["totalBrut"]          = $this->Ownerp_model->getTotalBrut();

        $data["totalNet"]           = $this->Ownerp_model->getTotalBrut() - $this->Ownerp_model->getTotalBrut() * 25 / 100;

        $data["donation"]           = $this->Ownerp_model->getDonations();

        $data["lastLogs"]           = $this->Ownerp_model->getPanelLogs(25);

        $data['newAccountsToday'] = $this->Ownerp_model->getInformation("newAccountsToday");


        $data["main_content"] = 'ownerp_view';

        $this->load->view('includes/template.php', $data);

    }

    /*
    public function givemedals() {
        //$query = $this->db->query("SELECT id,panelmedals,QuestType FROM `users`", array($player));
        if($query->num_rows())
            $nfo1 = $query->result();
        //print_r($nfo1);

        foreach($nfo1 as $row) {
            if($row->QuestType >= 5) {
                $arr1=explode("|", $row->panelmedals);
                $newarr=$arr1[0]."|1|0|0|0|0";
                //$this->db->query("UPDATE `users` SET `panelmedals` = ? WHERE `id` = ?", array($newarr, $row->id));
            }
        }
    }
    */



    public function insertnews() {
        if(!($this->session->userdata('logged_in')['id'])) {
            $this->session->set_flashdata('error', 'Nu esti logat.');
            redirect(base_url('login'));
        }
        
        if(getUserData($this->session->userdata('logged_in')["id"], "Admin") <= 5) {
            $this->session->set_flashdata('error', 'Nu esti admin.');
            redirect(base_url());
        }
        
        $text       = $this->input->post("update");
        $versiune   = htmlentities($this->input->post("versiune"));
        
        if($text !== null && $versiune !== null) {
            $this->Ownerp_model->insertNews($this->session->userdata("logged_in")["id"], $versiune, $text);

            panel_log(getUserData($this->session->userdata("logged_in")["id"], "name") . " a inserat un news pe panel", $this->session->userdata("logged_in")["id"]);
            redirect(base_url("ownerp"));
        } else {
            $this->session->set_flashdata('error', 'Campuri goale');
            redirect(base_url());
        }
    }


    public function newAnnouncement() {
        if(!($this->session->userdata('logged_in')['id'])) {
            $this->session->set_flashdata('error', 'Nu esti logat.');
            redirect(base_url('login'));
        }

        if(getUserData($this->session->userdata('logged_in')["id"], "Admin") < 7) {

            $this->session->set_flashdata('error', 'Nu ai gradul administrativ necesar penrtu a face acest lucru.');

            redirect(base_url());
        }

        if($this->session->has_userdata('postTimeoutglobalAnnounce') && (time() - $this->session->userdata('postTimeoutglobalAnnounce') ) < 60) {
            $this->session->set_flashdata("error", "Trebuie sa mai astepti <span id='restofseconds'>".(60-(time()-$this->session->userdata('postTimeoutglobalAnnounce')))."</span> secunde de la ultima actiune.");
            redirect(base_url("ownerp"));
        } 
        else
        {
            $announcement = xss_clean(html_purify($this->input->post("globalannouncement"), false));

            if(strlen($announcement) > 5 && strlen($announcement) < 300) {
                $this->Ownerp_model->update_global_announcement($announcement);
                $this->db->cache_delete('default', 'index');
                $this->session->set_userdata('postTimeoutglobalAnnounce', time()); 
                $this->session->set_flashdata('success', 'Mesajul a fost introdus cu succes.');
                redirect(base_url("ownerp"));
            }       
            elseif(strlen($announcement) < 5) {
                $this->Ownerp_model->update_global_announcement($announcement);
                $this->db->cache_delete('default', 'index');
                $this->session->set_userdata('postTimeoutglobalAnnounce', time());
                $this->session->set_flashdata('error', 'Mesajul a fost introdus cu succes.');
                redirect(base_url("ownerp"));
            }
            else {
                $this->session->set_flashdata('error', 'Mesajul este prea lung pentru a fi inserat.');
                redirect(base_url("ownerp"));
            }
        }

    }

    

    public function setppvalue() {

                if(getUserData($this->session->userdata('logged_in')["id"], "Admin") < 7) {

            $this->session->set_flashdata('error', 'Nu esti owner.');

            redirect(base_url());
        }

        $new_pp                     = (int)$this->input->post("ppvalue");

        

        if($new_pp !== null && $new_pp > 0) {

            

            $this->Ownerp_model->set_pp($new_pp);

            

            panel_log(getUserData($this->session->userdata("logged_in")["id"], "name") . " a setat valoarea unui euro in ".$new_pp." PP.", $this->session->userdata("logged_in")["id"]);

            $this->session->set_flashdata('success', 'Ai setat cu succes PP.');



            $this->db->cache_delete_all();

            redirect(base_url("ownerp"));

        }

    }

    public function setppvaluesms() {

                if(getUserData($this->session->userdata('logged_in')["id"], "Admin") < 7) {

            $this->session->set_flashdata('error', 'Nu esti owner.');

            redirect(base_url());
        }

        $new_pp                     = (int)$this->input->post("ppvalue");

        

        if($new_pp !== null && $new_pp > 0) {

            

            $this->Ownerp_model->set_pp_sms($new_pp);

            

            panel_log(getUserData($this->session->userdata("logged_in")["id"], "name") . " a setat valoarea unui euro in ".$new_pp." PP.", $this->session->userdata("logged_in")["id"]);

            $this->session->set_flashdata('success', 'Ai setat cu succes PP.');



            $this->db->cache_delete_all();

            redirect(base_url("ownerp"));

        }

    }

    public function insertUpdate() {
        if(!($this->session->userdata('logged_in')['id'])) {
            $this->session->set_flashdata('error', 'Nu esti logat.');
            redirect(base_url('login'));
        }
        
        if(getUserData($this->session->userdata('logged_in')["id"], "Admin") <= 5) {
            $this->session->set_flashdata('error', 'Nu esti admin.');
            redirect(base_url());
        }
        
        $text       = $this->input->post("update");
        $versiune   = htmlentities($this->input->post("versiune"));
        
        if($text !== null && $versiune !== null) {
            $this->Update_model->insertUpdate($this->session->userdata("logged_in")["id"], strip_non_utf($versiune), strip_non_utf($text));

            panel_log(getUserData($this->session->userdata("logged_in")["id"], "name") . " a inserat un update", $this->session->userdata("logged_in")["id"]);
            redirect(base_url("ownerp"));
        } else {
            $this->session->set_flashdata('error', 'Campuri goale');
            redirect(base_url("ownerp"));
        }
    }
    

    public function flushcache() {
        
        if(getUserData($this->session->userdata('logged_in')["id"], "Admin") < 7) {

            $this->session->set_flashdata('error', 'Nu esti owner.');

            redirect(base_url());
        }

        panel_log(getUserData($this->session->userdata("logged_in")["id"], "name") . " a sters tot cache-ul.", $this->session->userdata("logged_in")["id"]);

        $this->session->set_flashdata('success', 'Ai sters cu succes cache-ul.');

        $this->db->cache_delete_all();
        $this->db2->cache_delete_all();

        redirect(base_url("ownerp"));

    }

    

    public function switchmaintenance() {
               if(getUserData($this->session->userdata('logged_in')["id"], "Admin") < 7) {

            $this->session->set_flashdata('error', 'Nu esti owner.');

            redirect(base_url());
        }

        if(get_info("Value", "panel_assets", "Name", "Maintenance") == 0) {

            panel_log(getUserData($this->session->userdata("logged_in")["id"], "name") . " a pornit mentenanta.", $this->session->userdata("logged_in")["id"]);

            $this->session->set_flashdata('success', 'Ai pornit mentenanta.');

            $this->Ownerp_model->toggle_maintenance(1);

        }

        elseif(get_info("Value", "panel_assets", "Name", "Maintenance") == 1) {

            panel_log(getUserData($this->session->userdata("logged_in")["id"], "name") . " a oprit mentenanta.", $this->session->userdata("logged_in")["id"]);

            $this->session->set_flashdata('success', 'Ai oprit mentenanta.');

            $this->Ownerp_model->toggle_maintenance(0);

        }

        

        $this->db->cache_delete_all();

        redirect(base_url("ownerp"));

    }

    

    public function addshopitem() {

                  if(getUserData($this->session->userdata('logged_in')["id"], "Admin") < 7) {

            $this->session->set_flashdata('error', 'Nu esti owner.');

            redirect(base_url());
        }

        $title          = $this->input->post('itemtitle');

        $description    = $this->input->post('itemdescription');

        $price          = $this->input->post('itemprice');

        

        if($title !== null && $description !== null & $price !== null) {

            if($price < 0) {

                $this->session->set_flashdata('error', 'Pretul nu poate fi negativ.');

                redirect(base_url("ownerp"));

            }

            

            panel_log(getUserData($this->session->userdata("logged_in")["id"], "name") . " a inserat un nou obiect in shop:" . $title, $this->session->userdata("logged_in")["id"]);

            $this->Ownerp_model->add_item($title, $description, $price);

            

            $this->db->cache_delete("shop", "index");

            

            $this->session->set_flashdata('success', 'Ai inserat cu succes in shop '.$title);

            redirect(base_url("ownerp"));

        } else {

            $this->session->set_flashdata('error', 'Campuri invalide.');

            redirect(base_url("ownerp"));

        }

    }

        public function addvideo() {

            if(getUserData($this->session->userdata('logged_in')["id"], "Admin") < 6) {

            $this->session->set_flashdata('error', 'Nu esti owner.');

            redirect(base_url());
        }

        $ytid          = $this->input->post('youtubeID');

        $pieces = explode("=", $ytid);

        if($ytid !== null) {



            

            panel_log(getUserData($this->session->userdata("logged_in")["id"], "name") . " a inserat un video:" . $title, $this->session->userdata("logged_in")["id"]);

            $this->Ownerp_model->add_video($pieces[1], getUserData($this->session->userdata("logged_in")["id"], "name"));

            

            $this->db->cache_delete("youtube_videos", "index");

            

            $this->session->set_flashdata('success', 'Ai inserat cu succes video '.$title);

            redirect(base_url("ownerp"));

        } else {

            $this->session->set_flashdata('error', 'Campuri invalide.');

            redirect(base_url("ownerp"));

        }

    }



    public function sendpush() {

                        if(getUserData($this->session->userdata('logged_in')["id"], "Admin") < 7) {

            $this->session->set_flashdata('error', 'Nu esti owner.');

            redirect(base_url());
        }

        $title          = $this->input->post("pushtitle");

        $content        = $this->input->post("pushcontent");

        $redirect_to    = $this->input->post("redirectto");

        

        if($title !== null && $content !== null && $redirect_to !== null) {

            $push_user      = $this->Ownerp_model->get_push_users();

            foreach($push_user as $user) {

                send_onesignal($title, $content, $user->OneSignalID, $redirect_to);

            }

            

            $this->session->set_flashdata('success', 'Ai trimis notificarea cu succes.');

            redirect(base_url("ownerp"));

        }

        else {

            $this->session->set_flashdata('error', 'Nu ai completat cum trb.');

            redirect(base_url("ownerp"));

        }

    }

    

    public function deleteitem() {

                       if(getUserData($this->session->userdata('logged_in')["id"], "Admin") < 7) {

            $this->session->set_flashdata('error', 'Nu esti owner.');

            redirect(base_url());
        }

        $item       = (int)$this->uri->segment(3);

        

        if(get_info("ID", "shop", "ID", $item) == $item) {

            $this->Ownerp_model->delete_item($item);

            panel_log(getUserData($this->session->userdata("logged_in")["id"], "name") . " a sters din shop obiectul $item.", $this->session->userdata("logged_in")["id"]);



            $this->db->cache_delete("shop", "index");

            

            $this->session->set_flashdata('success', 'Ai sters cu succes din shop id:'.$item);

            redirect(base_url("shop"));

        } else {

            $this->session->set_flashdata('error', 'Obiect invalid.');

            redirect(base_url("ownerp"));

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