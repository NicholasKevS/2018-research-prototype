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
        if($this->input->post('report1')) {
            $report1 = $this->input->post('report1');
        } else {
            $report1 = '30 May 2018';
        }
        if($this->input->post('report2')) {
            $report2 = $this->input->post('report2');
        } else {
            $report2 = '30 May 2018';
        }

        $data['date'] = $date;
        $data['time1'] = $time1;
        $data['time2'] = $time2;
        $data['report1'] = $report1;
        $data['report2'] = $report2;

        $id = $this->session->id;
        $locationid = $this->processor->getProfile($id)['locationid'];
        $data['weather']['today'] = $this->processor->getWeather($id, $date);
        $data['weather']['tomorrow'] = $this->processor->getWeather($id, '31 May 2018');
        $data['provider'] = $this->processor->getProvider($id);
        $data['timeAxis'] = $this->processor->getTimeAxis($time1, $time2);
        $data['price'] = $this->processor->getPriceArray($id, $date, $time1, $time2);
        $data['usage'] = $this->processor->getHourlyUsage($id, $date, $time1, $time2);
        $data['production'] = $this->processor->getHourlyProduction($id, $date, $time1, $time2);
        $data['usageForecastTomorrow'] = $this->processor->getUsageForecastTomorrow($id);
        $data['productionForecastTomorrow'] = $this->processor->getProductionForecastTomorrow($id);
        $data['usageAvg'] = $this->processor->getAvgHourlyUsage($locationid, $date, $time1, $time2);
        $data['productionAvg'] = $this->processor->getAvgHourlyProduction($locationid, $date, $time1, $time2);

        if($date == '30 May 2018') {
            $data['usageForecastToday'] = $this->processor->getUsageForecastToday($id);
            $data['productionForecastToday'] = $this->processor->getProductionForecastToday($id);
        } else {
            $data['usageForecastToday'] = array();
            $data['productionForecastToday'] = array();
        }

        $data['title'] = "Dashboard";
        $data['view'] = "dashboard";
        $this->load->view('master', $data);
    }

    public function report()
    {
        $from = $this->input->post("report1");
        $to = $this->input->post("report2");
        $id = $this->session->id;

        if($from == $to) {
            $data['date'] = $from;
        } else {
            $data['date'] = "$from to $to";
        }

        $data['price'] = $this->processor->getProvider($id);
        $data['reports'] = $this->processor->getReport($id, $from, $to);

        $this->load->view('report', $data);
    }
}