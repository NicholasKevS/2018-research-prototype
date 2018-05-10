<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Discharge extends CI_Controller {

    public function index()
    {
        $data['title'] = "Discharge List";
        $data['view'] = "discharge";
        $this->load->view('master', $data);
    }
}