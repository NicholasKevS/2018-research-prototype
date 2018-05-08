<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    public function index()
    {
        $data['title'] = "Dashboard";
        $data['view'] = "blank";
        $this->load->view('master', $data);
    }
}