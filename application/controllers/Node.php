<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Node extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        $this->processor->checkLogin();
    }

    public function index()
    {
        $data['title'] = "Nodes List";
        $data['view'] = "node";
        $this->load->view('master', $data);
    }

    public function detail()
    {
        $data['title'] = "Detail";
        $data['view'] = "node_detail";
        $this->load->view('master', $data);
    }
}