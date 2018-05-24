<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    public function index()
    {
        $date = '2018-05-14';
        $data['date'] = $date;
        $data['price'] = $this->datas->getPrice($this->session->id);
        $data['usage'] = $this->processor->getHourlyUsage($date);
        $data['production'] = $this->processor->getHourlyProduction($date);
        $data['title'] = "Dashboard";
        $data['view'] = "dashboard";
        $this->load->view('master', $data);
    }

    public function date()
    {
        $date = $this->input->post('date');
        $data['date'] = $date;
        $data['price'] = $this->datas->getPrice($this->session->id);
        $data['usage'] = $this->processor->getHourlyUsage($date);
        $data['production'] = $this->processor->getHourlyProduction($date);
        $data['title'] = "Dashboard";
        $data['view'] = "dashboard";
        $this->load->view('master', $data);
    }
}