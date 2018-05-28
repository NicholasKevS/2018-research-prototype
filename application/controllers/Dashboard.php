<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        $this->processor->checkLogin();
    }

    public function index()
    {
        if($this->input->post('date')) {
            $date = $this->input->post('date');
        } else {
            $date = '2018-05-14';
        }
        $data['date'] = $date;
        $data['price'] = $this->processor->getPrice($this->session->id);
        $data['usage'] = $this->processor->getHourlyUsage($date);
        $data['production'] = $this->processor->getHourlyProduction($date);
        $data['title'] = "Dashboard";
        $data['view'] = "dashboard";
        $this->load->view('master', $data);
    }
}