<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Register extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Register_model'); 
        $this->load->helper(array('url', 'htmlpurifier'));
        $this->load->library('user_agent', 'recaptcha');

        if($this->session->userdata('logged_in') !== null) {
            $this->session->set_flashdata('error', 'Esti deja logat, nu iti poti crea un cont nou cat timp esti logat.');
            redirect(base_url());
        }
    }

    public function index()
    {
        $this->load->library('form_validation');

        $data = array(
            'widget' => $this->recaptcha->getWidget(),
            'script' => $this->recaptcha->getScriptTag(),
        );

        $data["main_content"] = 'register_view';
        $this->load->view('includes/template.php', $data);
    }

    function validate_user() {
    	$email = html_purify($this->input->post('email'), false);

        if($this->Register_model->checkExistingUser($email) == TRUE)
        {
        	$this->form_validation->set_message('validate_user', 'Email-ul este deja folosit de un alt utilizator.');
        	return FALSE;
        } 
        else
        {
        	return TRUE;
        }	
    }

    function check_password() {
        $pwd = $this->input->post('password');

        if (strlen($pwd) < 6) {
            $error = "Parola trebuie sa contina minim 6 caractere";
        }

        if (!preg_match("#[0-9]+#", $pwd)) {
            $error .= "<br>Parola trebuie sa includa cel putin un numar.";
        }

        if (!preg_match("#[a-zA-Z]+#", $pwd)) {
            $error .= "<br>Parola trebuie sa contina cel putin o litera.";
        }     

        if(isset($error)) {
            $this->form_validation->set_message('check_password', ''.$error.'');
            return FALSE;
        } else
            return TRUE;
    }

    function validate_captcha() {
        $recaptcha = $this->input->post('g-recaptcha-response');

        if (!empty($recaptcha)) {
            $response = $this->recaptcha->verifyResponse($recaptcha);
            if (!isset($response['success']) || $response['success'] != "1" || strlen($response["error-codes"]) > 1) {
                   return FALSE;
            }
        } else {
            return FALSE;
         }

        return TRUE;
    }

    public function new() {
    	$this->load->library('form_validation');
        $this->form_validation->set_rules('email', 'email', 'trim|valid_email|required|callback_validate_user|xss_clean|max_length[30]');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean|callback_check_password|min_length[6]|max_length[30]');
        $this->form_validation->set_rules('passwordr', 'Re-enter password', 'trim|required|xss_clean|max_length[30]|matches[password]');
        $this->form_validation->set_rules('nume', 'Nume', 'trim|required|xss_clean|max_length[30]');
        $this->form_validation->set_rules('prenume', 'Prenume', 'trim|required|xss_clean|max_length[30]');
        $this->form_validation->set_rules('telefon', 'Telefon', 'trim|required|xss_clean|max_length[12]');    
        $this->form_validation->set_rules('g-recaptcha-response', 'recaptcha validation', 'callback_validate_captcha|required');
        $this->form_validation->set_message('validate_captcha', 'Please check the the captcha form.');      

        if($this->form_validation->run() == FALSE)
        {
            $data = array(
                'widget' => $this->recaptcha->getWidget(),
                'script' => $this->recaptcha->getScriptTag(),
            );

            $data["main_content"] = 'register_view';
            $this->load->view('includes/template.php', $data);
        }
        else
        {
        	$email = html_purify($this->input->post('email'), false);
        	$password = html_purify($this->input->post('password'), false);
        	$firstname = html_purify($this->input->post('nume'), false);
        	$lastname = html_purify($this->input->post('prenume'), false);
        	$phone = html_purify($this->input->post('telefon'), false);

        	$first = md5(uniqid());
        	$finalkey = $first . md5($first);

        	$this->Register_model->insertTempUser($finalkey, $email, $password, $firstname, $lastname, $phone);     

        	$msg = 
                        "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Strict//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd\">
                            <html xmlns=\"http://www.w3.org/1999/xhtml\" dir=\"ltr\">
                            <head>
                                <meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />
                                <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\"/>
                                <title></title>
                            </head>
                            <body><br>
                                Salut 
                                ". $firstname . " " . $lastname .",<br>
                                Ai primit acest email pentru ca ai solicitat inregistrarea contului tau pe website-ul clinicii Medicare.<br>
                                Daca nu doresti sa iti creezi contul, poti ignora/sterge acest email.<br>
                                Pentru a-ti crea contul da click pe link-ul de mai jos in maximum 30 de minute de la primirea acestui email: <br>
                                <a href=\"" . base_url("register/check/$finalkey") . "\">" . base_url("register/check/$finalkey") . "</a>
                                <br>
                                Cu stima,<br>
                                Echipa Medicare.
                            </body>
                        </html>";

            $this->load->library('email');
            $this->email->set_mailtype("html");
            $this->email->from('postmaster@medi-care-brasov.ro', 'clinica medicare');
            $this->email->to('' . $email  . '');
            $this->email->subject("Creare cont clinica MediCare");
            $this->email->message($msg);
            $this->email->send();

            $this->db->query("DELETE FROM `validateuser` WHERE regdate < ?", array(time()-86400)); 
            $this->session->set_flashdata('success', 'Mail-ul pentru activarea contului a fost trimis cu succes pe adresa de email: '.$email.'.');
            redirect(base_url(""));		
        }
    }

    public function check() {
        $uniqueKey = $this->uri->segment(3);

        if($this->Register_model->isValidKey($uniqueKey)) {
            $this->session->set_flashdata('success', 'Ti-ai activat contul cu succes. Acum te poti loga.');
            redirect(base_url(""));   
        } else {
            $this->session->set_flashdata('error', 'Cheie invalida.');
            redirect(base_url(""));
        }
    }
    

    public function _remap($method,$args)
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
?>