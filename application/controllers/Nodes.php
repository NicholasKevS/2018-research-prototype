<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Nodes extends CI_Controller {

    public function index()
    {
        $data['title'] = "Nodes";
        $data['view'] = "nodes";
        $this->load->view('master', $data);
    }
}