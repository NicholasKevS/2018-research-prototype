<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends MY_Controller {

    public function index()
    {
        if($this->input->post('locationid')) {
            $locationid = $this->input->post('locationid');
        } else {
            $locationid = 1;
        }
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

        $data['suburb'] = $this->users->getSuburbs();
        $data['locationid'] = $locationid;
        $data['date'] = $date;
        $data['time1'] = $time1;
        $data['time2'] = $time2;

        $data['dateAxis'] = $this->processor->getDateAxis($date);
        $data['timeAxis'] = $this->processor->getTimeAxis($time1, $time2);
        $data['usage'] = $this->processor->getAvgHourlyUsage($locationid, $date, $time1, $time2);
        $data['production'] = $this->processor->getAvgHourlyProduction($locationid, $date, $time1, $time2);;
        $data['sum'] = $this->processor->getAvgBatterySum($locationid, $date);

        $data['title'] = "Admin Page";
        $data['view'] = "admin";
        $this->load->view('master', $data);
    }
}