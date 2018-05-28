<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Battery extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        $this->processor->checkLogin();
    }

    public function index()
    {
        $data['title'] = "Battery Detail";
        $data['view'] = "battery";
        $this->load->view('master', $data);
    }

    public function edit()
    {
        redirect("battery/");
    }
}