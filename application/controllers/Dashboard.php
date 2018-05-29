<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends MY_Controller {

    public function index()
    {
        if($this->input->post('date')) {
            $date = $this->input->post('date');
        } else {
            $date = '2018-05-14';
        }
        if($this->input->post('time1')) {
            $time1 = $this->input->post('time1');
        } else {
            $time1 = '00:00';
        }
        if($this->input->post('time2')) {
            $time2 = $this->input->post('time2');
        } else {
            $time2 = '23:00';
        }

        if($time1 >= $time2) {
            $this->session->set_flashdata('alert',"'To' time must be bigger than 'From'");
            redirect('dashboard/');
        }

        $data['date'] = $date;
        $data['time1'] = $time1;
        $data['time2'] = $time2;
        $data['timeAxis'] = $this->processor->getTimeAxis($time1, $time2);
        $data['price'] = $this->processor->getPrice($this->session->id);
        $data['usage'] = $this->processor->getHourlyUsage($date, $time1, $time2);
        $data['production'] = $this->processor->getHourlyProduction($date, $time1, $time2);
        $data['title'] = "Dashboard";
        $data['view'] = "dashboard";
        $this->load->view('master', $data);
    }
}