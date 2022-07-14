<?php 

if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Logout extends CI_Controller {
 
     public function __construct()
     {
         parent::__construct();
     }

     public function index()
     {
        $this->load->helper(array('form'));
        $this->load->view('login/logout_view');
     }
 
}
