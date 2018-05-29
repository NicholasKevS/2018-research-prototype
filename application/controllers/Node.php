<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Node extends MY_Controller {

    public function index()
    {
        $data['title'] = "Nodes List";
        $data['view'] = "node";
        $this->load->view('master', $data);
    }

    public function detail()
    {
        $data['title'] = "Node Detail";
        $data['view'] = "node_detail";
        $this->load->view('master', $data);
    }
}