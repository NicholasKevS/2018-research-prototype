<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends MY_Controller {

    public function index()
    {
        if($this->input->post('date')) {
            $date = $this->input->post('date');
        } else {
            $date = '30 May 2018';
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
        if($this->input->post('datereport')) {
            $datereport = $this->input->post('datereport');
        } else {
            $datereport = '30 May 2018';
        }

        $data['date'] = $date;
        $data['time1'] = $time1;
        $data['time2'] = $time2;
        $data['datereport'] = $datereport;

        $id = $this->session->id;
        $data['weather'] = $this->processor->getLocation($id);
        $data['timeAxis'] = $this->processor->getTimeAxis($time1, $time2);
        $data['price'] = $this->processor->getPrice($id, $date, $time1, $time2);
        $data['usage'] = $this->processor->getHourlyUsage($id, $date, $time1, $time2);
        $data['production'] = $this->processor->getHourlyProduction($id, $date, $time1, $time2);
        $data['usageForecastToday'] = $this->processor->getUsageForecastToday($id);
        $data['productionForecastToday'] = $this->processor->getProductionForecastToday($id);
        $data['usageForecastTomorrow'] = $this->processor->getUsageForecastTomorrow($id);
        $data['productionForecastTomorrow'] = $this->processor->getProductionForecastTomorrow($id);

        $data['title'] = "Dashboard";
        $data['view'] = "dashboard";
        $this->load->view('master', $data);
    }

    public function report()
    {
        $date = $this->input->post("datereport");
        $id = $this->session->id;

        $data['date'] = $date;

        $data['usage'] = $this->processor->getDailyUsage($id, $date);
        $data['production'] = $this->processor->getDailyProduction($id, $date);

        $this->load->view('report', $data);
    }
}