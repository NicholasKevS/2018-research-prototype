<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends MY_Controller {

    public function index()
    {
        $data['title'] = "Welcome";
        $data['view'] = "welcome";
        $this->load->view('master', $data);
    }
}