<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        $this->processor->checkLogin();
    }

    public function index()
    {
        $data['title'] = "Welcome";
        $data['view'] = "welcome";
        $this->load->view('master', $data);
    }
}