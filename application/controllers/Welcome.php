<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends MY_Controller {

    public function index()
    {
        $data['title'] = "Welcome Page";
        $data['view'] = "welcome";
        $this->load->view('master', $data);
    }
}