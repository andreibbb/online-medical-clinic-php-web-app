<?php

if ( ! defined('BASEPATH')) redirect(base_url());


class Changeemail extends CI_Controller {
    
    public function __construct() 
    {       
        parent::__construct();
        $this->load->model('Changeemail_model'); 
        $this->load->helper(array('url'));
        $this->load->library('user_agent');
    }
    

    public function index() {
        if(!($this->session->userdata('logged_in')["id"])) {
            
            $this->session->set_flashdata('error', 'Nu esti logat.');
            redirect(base_url());
        }

        $data["main_content"] = 'changeemail_view';
        $session_data = $this->session->userdata('logged_in');
        $data['username'] = $session_data['username'];
        $this->load->helper(array('url'));
        $this->load->view('includes/template.php', $data);
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

    public function newe() 
    {
        $recoverKey = $this->uri->segment(3);

        if(get_info("name", "changemail", "ChangeMailKey", $recoverKey) != getUserData($this->session->userdata('logged_in')["id"], "name")) {
            
            $this->session->set_flashdata('error', 'Nu esti logat pe contul la care vrei sa schimbi mailul.');
            redirect(base_url());
        }

        if($this->session->has_userdata('postTimeoutMail') && (time() - $this->session->userdata('postTimeoutMail') ) < 86400) 
        {

                $this->session->set_flashdata("error", "Eroare. Iti poti schimba adresa de email o singura data pe zi.");

                redirect(base_url(""));
            } 
            else
            {
	           	if($this->Changeemail_model->isValidRecovery($recoverKey, time()) == $recoverKey && get_info("used", "changemail", "ChangeMailKey", $recoverKey) != 1) 
	            {
		                $newmail=get_info("email", "changemail", "ChangeMailKey", $recoverKey);
		                $newname=get_info("name", "changemail", "ChangeMailKey", $recoverKey);
		                $useru=getUserData($newname, "id");
		                $this->db->query("UPDATE users SET email = ? WHERE id = ?", array($newmail, $useru));
		                $this->db->query("UPDATE changemail SET used = ? WHERE `ChangeMailKey` = ? LIMIT 1", array(1, $recoverKey));
		                $this->session->set_userdata('postTimeoutMail', time());   
		                $this->session->set_flashdata('success', 'Noul tau e-mail este ' . htmlentities($newmail));
		                redirect(base_url("")); 
		            } 
		            else 
		            {
		                $this->session->set_flashdata('error', 'Cheie a fost deja folosita / a expirat sau este invalida.');
		                redirect(base_url(""));
		            }
	        }
    	}

    public function change() 
    {
        $username=getUserData($this->session->userdata('logged_in')["id"], "id");
        if($this->session->userdata('logged_in')["id"] > 0) 
            {
            $newemail = $this->input->post("newmail", true);
            $pass  = $this->input->post("password", true);

            if(strlen($newemail) > 0 && strlen($newemail) < 51 && strlen($pass) > 0 && strlen($pass) < 51) 
            {
                if (!filter_var($newemail, FILTER_VALIDATE_EMAIL)) {
                    $this->session->set_flashdata('error', 'Invalid EMail1.');
                    redirect(base_url("changeemail"));
                }                
                
                if(getUserData($this->session->userdata('logged_in')["id"], "Email") == $newemail) {
                    $this->session->set_flashdata('error', 'No email change detected.');
                    redirect(base_url("changeemail"));
                }

                if(getUserData($this->session->userdata('logged_in')["id"], "password") == md5($pass)) 
                {
                    if(getUserData($this->session->userdata('logged_in')["id"], "email") == "email@yahoo.com") 
                    {	
                        $this->db->query("UPDATE users SET email = ? WHERE id = ?", array($newemail, $this->session->userdata('logged_in')["id"]));
                        $this->session->set_userdata('postTimeoutMail', time());   
                        $this->session->set_flashdata('success', 'Ti-ai setat la cont noul tau e-mail: ' . htmlentities($newemail));
                        redirect(base_url(""));
                    }

                    $first = md5(uniqid());
                    $final_key = $first . md5($first);

                    $this->db->query("INSERT INTO changemail (`ChangeMailKey`, `userid`, `email`, `used`, `expire`) VALUES (?, ?, ?, ?, ?)", array($final_key, $username, $newemail, 0, time()+3600));

                    $msg = 
                        "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Strict//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd\">
                            <html xmlns=\"http://www.w3.org/1999/xhtml\" dir=\"ltr\">
                            <head>
                                <meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />
                                <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\"/>
                                <title></title>
                            </head>
                            <body>
                                Salut ". getUserFullName($username) . ",<br>
                                Ai primit acest email pentru ca ai solicitat schimbarea email-ului pe website-ul clincii MediCare.<br>
                                Daca nu doresti sa iti schimbi email-ul, poti ignora/sterge acest email.<br>
                                Pentru a-ti schimba email-ul cu noul email ". $newemail .", da click pe link-ul de mai jos: <br>
                                <a href=\"" . base_url("changeemail/newe/$final_key") . "\">" . base_url("changeemail/newe/$final_key") . "</a>
                                <br><br>
                                Cu stima,<br>
                                Echipa Eclipsed.
                            </body>
                        </html>";

                    $this->load->library('email');
                    $this->email->set_mailtype("html");
                    $this->email->from('medicare@gmail.com', 'medicare.ro');
                    $this->email->to('' . getUserData($username, "email") . '');
                    $this->email->subject("Schimbare email MediCare");
                    $this->email->message($msg);
                    $this->email->send();

                    $email1 = explode('@', $newemail);             
                    $first_part = $email1[0];                   
                    $domain = $email1[1];
                    $newemail = substr($first_part, 0, 4) . "****@" . substr($domain, 0, 10);
                    $this->session->set_flashdata('success', 'Codul de verificare a fost trimis catre ' . getUserData($username, "email") . '. Verifica inclusiv folderul SPAM.');
                    redirect(base_url(""));
                    
                } else {
                    $this->session->set_flashdata('error', 'Invalid password.');
                    redirect(base_url("changeemail"));
                }
            }
        }
    	}
    }
