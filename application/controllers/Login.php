<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* Login
* 
* 
* @package    T4P
* @subpackage Controller
*/

class Login extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Login_model'); 
        $this->load->helper(array('url', 'htmlpurifier'));
        $this->load->library('user_agent', 'recaptcha');

        if($this->session->userdata('logged_in') !== null) {
            $this->session->set_flashdata('error', 'Esti deja logat.');
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

        $data["main_content"] = 'login/login_view';
        $this->load->view('includes/template.php', $data);
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

    public function recover() {
        $this->load->library('form_validation');

        $this->form_validation->set_rules('email',      'Email',    'trim|required|valid_email|xss_clean');
        $this->form_validation->set_rules('telefon',      'Telefon',    'trim|required|xss_clean');
        

        $data["main_content"] = 'login/recover_view';
        $this->load->view('includes/template.php', $data);
    }

    public function recoverpassw() {
         if($this->session->has_userdata('postTimeoutpw') && (time() - $this->session->userdata('postTimeoutpw') ) < 3600) {

            $this->session->set_flashdata("error", "Trebuie sa mai astepti <span id='restofseconds'>".(3600-(time()-$this->session->userdata('postTimeoutpw')))."</span> secunde de la ultima cerere de resetare a parolei.");

            redirect(base_url(""));

            }

        $email      = strtolower(html_purify($this->input->post('email'), false));
        $phone      = html_purify($this->input->post('phone'), false);

        $userid = getUserData($email, "ID");
        $phone_checker = getUserData($phone, "ID"); 
        if($userid > 0 && $userid == $phone_checker && strlen($email) > 3) {
            $first = md5(uniqid());
            $final_key = $first . md5($first);
            $this->session->set_userdata('postTimeoutpw', time());   
            $this->Login_model->recoverPassword($email, $final_key);

                    $actuallyMail = strtolower($actuallyMail);

                    $msg = 
                        "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Strict//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd\">
                            <html xmlns=\"http://www.w3.org/1999/xhtml\" dir=\"ltr\">
                            <head>
                                <meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />
                                <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\"/>
                                <title></title>
                            </head>
                            <body>
                                <img src=\"https://i.imgur.com/577f1RG.png\"><br>
                                Salut 
                                "
                                . getUserData($userid, "nume") . "" . getUserData($userid, "prenume").",<br>
                                [RO] Ai primit acest email pentru ca ai solicitat resetarea parolei pe platforma website-ului MediCare.<br>
                                Daca nu doresti sa iti schimbi parola, poti ignora/sterge acest email.<br>
                                Pentru a-ti schimba parola, da click pe link-ul de mai jos: <br>
                                <a href=\"" . base_url("login/recoverchange/$final_key") . "\">" . base_url("login/recoverchange/$final_key") . "</a>
                                <br>
                                Cu stima,<br>
                                MediCare Romania.
                            </body>
                        </html>";

                    $this->load->library('email');
                    $this->email->set_mailtype("html");
                    $this->email->from('medicare@gmail.com', 'medicare.ro');
                    $this->email->to('' . $actuallyMail . '');
                    $this->email->subject("Recuperare parola cont MediCare");
                    $this->email->message($msg);
                    $this->email->send();
                    $this->session->set_flashdata('success', 'Codul de verificare a fost trimis catre ' . $email . '. Verifica inclusiv folderul SPAM.');
                    redirect(base_url("login/recover"));
                } else {
                    $this->session->set_flashdata('error', 'Nu am gasit cont in baza de date cu aceasta adresa de email sau numarul de telefon nu coincide cu cel al contului gasit.');
                    redirect(base_url("login/recover"));
            }
    }

    public function checkPassword($pwd) {

        if (strlen($pwd) < 8) {
            $error = "Parola trebuie sa contina minim 8 caractere";
        }

        if (!preg_match("#[0-9]+#", $pwd)) {
            $error .= "<br>Parola trebuie sa includa cel putin un numar";
        }

        if (!preg_match("#[a-zA-Z]+#", $pwd)) {
            $error .= "<br>Parola trebuie sa contina cel putin o litera";
        }     

        if(isset($error)) return $error; else return 5;
    }

    public function recoverchange() {
        $recoverKey = $this->uri->segment(3);

        if($this->Login_model->isValidRecovery($recoverKey)) {
            $data["main_content"] = 'login/change_view';
            $this->load->view('includes/template.php', $data);      
        } else {
            $this->session->set_flashdata('error', 'Cheie invalida.');
            redirect(base_url("login/recover"));
        }
    }

    public function changepassw() {
        $recoverKey                 = $this->uri->segment(3);
        $confirmationPassword       = $this->input->post('confirmpassword');
        $initialPassword            = $this->input->post('password');

        if($this->checkPassword($initialPassword) == 5)
        {
            if($confirmationPassword == $initialPassword) {
                $this->Login_model->updateUser($recoverKey, $initialPassword);

                $this->session->set_flashdata('succes', 'Ti-ai resetat parola cu succes.');
                redirect(base_url("login"));
            } else {
                $this->session->set_flashdata('error', 'Parola nu este aceeasi in ambele campuri.');
                redirect(base_url("login/recoverchange/$recoverKey"));
            }
        } else {
            $this->session->set_flashdata('error',  $this->checkPassword($initialPassword));
            redirect(base_url("login/recoverchange/$recoverKey"));
        }
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

    public function continueLogin()
    {   
        $this->load->library('form_validation');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|xss_clean|max_length[30]');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean');
        $this->form_validation->set_rules('g-recaptcha-response', 'recaptcha validation', 'callback_validate_captcha|required');
        $this->form_validation->set_message('validate_captcha', 'Please check the the captcha form.');

        if($this->form_validation->run() == FALSE)
        {
            $data = array(
            'widget' => $this->recaptcha->getWidget(),
            'script' => $this->recaptcha->getScriptTag(),
            );
            $data["main_content"] = 'login/login_view';
            $this->load->view('includes/template.php', $data);
        }
        else
        {   
            $email = $this->input->post('email');
            $password = $this->input->post('password');

            if(strlen($email) && strlen($password)) {

                $result = $this->Login_model->checkLogin($email, $password);

                if($result != false)
                {
                    $sess_array = array();
                    $info = explode('|', $result);

                    $sess_array = array(
                        'id' => $info[0],
                        'email' => $info[1]
                    );

                    if($this->input->post('remember'))
                        $this->session->sess_expiration = '10800';
                    else
                        $this->session->sess_expiration = '1800';

                    $this->session->set_userdata('logged_in', $sess_array);
                    $this->session->mark_as_temp(array(
                        'id' => 60,
                        'email' => 60,
                        'logged_in' => 60
                    ));


                    $this->Login_model->addIPLog($info[0], $this->input->ip_address());
                    $this->Login_model->updateLoginDate($info[0]);
                    

                    redirect(base_url());
                }
                else
                {
                    
                    $this->session->set_flashdata('error', 'Datele introduse sunt invalide.');
                    redirect(base_url("login"));
                }
            } else {
                $this->session->set_flashdata('error', 'Datele introduse sunt invalide.');
                redirect(base_url("login"));
            }
        }        
    }

}
?>