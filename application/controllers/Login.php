<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

    public function index()
    {
        $this->load->view('login');
    }

    public function register()
    {
        $this->load->view('register');
    }
    public function forgot()
    {
        $this->load->view('forgot_password');
    }
}