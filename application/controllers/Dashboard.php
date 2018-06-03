<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends MY_Controller {

    public function index()
    {
        if($this->input->post('date')) {
            $date = $this->input->post('date');
        } else {
            $date = '14 May 2018';
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
            $this->session->set_flashdata('alert',"'To' time must be later than 'From' time");
            redirect('dashboard/');
        }

        $data['date'] = $date;
        $data['time1'] = $time1;
        $data['time2'] = $time2;

        $id = $this->session->id;
        $data['timeAxis'] = $this->processor->getTimeAxis($time1, $time2);
        $data['price'] = $this->processor->getPrice($id, $date, $time1, $time2);
        $data['usage'] = $this->processor->getHourlyUsage($id, $date, $time1, $time2);
        $data['production'] = $this->processor->getHourlyProduction($id, $date, $time1, $time2);

        $data['title'] = "Dashboard";
        $data['view'] = "dashboard";
        $this->load->view('master', $data);
    }
}