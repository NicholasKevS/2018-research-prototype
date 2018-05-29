<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Battery extends MY_Controller {

    public function index()
    {
        $data['title'] = "Battery";
        $data['view'] = "battery";
        $this->load->view('master', $data);
    }

    public function edit()
    {
        redirect("battery/");
    }
}