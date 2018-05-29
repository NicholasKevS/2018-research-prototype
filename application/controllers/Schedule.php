<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Schedule extends MY_Controller {

    public function index()
    {
        $data['title'] = "Node Schedules List";
        $data['view'] = "schedule";
        $this->load->view('master', $data);
    }

    public function detail()
    {
        $data['title'] = "Node Schedule Detail";
        $data['view'] = "schedule_detail";
        $this->load->view('master', $data);
    }
}