<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Vehicle extends MY_Controller {

    public function index()
    {
        $data['title'] = "Electric Vehicle";
        $data['view'] = "vehicle";
        $this->load->view('master', $data);
    }
}