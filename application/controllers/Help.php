<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Help extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        $this->processor->checkLogin();
    }

    public function index()
    {
        $data['title'] = "Help";
        $data['view'] = "help";
        $this->load->view('master', $data);
    }
}