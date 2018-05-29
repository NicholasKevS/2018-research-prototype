<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends MY_Controller {

    public function index()
    {
        $data['title'] = "Admin Page";
        $data['view'] = "admin";
        $this->load->view('master', $data);
    }
}