<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Solar extends MY_Controller {

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

        $data['date'] = $date;
        $data['time1'] = $time1;
        $data['time2'] = $time2;

        $id = $this->session->id;
        $data['timeAxis'] = $this->processor->getTimeAxis($time1, $time2);
        $data['production'] = $this->processor->getHourlyProduction($id, $date, $time1, $time2);
        $data['solar'] = $this->processor->getSolar($id);
        $data['location'] = $this->processor->getLocation($id);

        $data['title'] = "Solar Roof";
        $data['view'] = "solar";
        $this->load->view('master', $data);
    }

    public function save()
    {
        $this->form_validation->set_rules('name', 'Solar Roof Name', 'required');
        $this->form_validation->set_rules('code', 'Id Number', 'required');
        $this->form_validation->set_rules('area', 'Area', 'required');
        $this->form_validation->set_rules('quantity', 'Total Panel', 'required');
        $this->form_validation->set_rules('size', 'System Size', 'required');

        if($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('alert',validation_errors());
        } else {
            $data = array(
                'id'=>$this->input->post('id'),
                'userid'=>$this->session->id,
                'name'=>$this->input->post('name'),
                'code'=>$this->input->post('code'),
                'area'=>$this->input->post('area'),
                'quantity'=>$this->input->post('quantity'),
                'size'=>$this->input->post('size'));

            $this->processor->saveSolar($data);

            $this->session->set_flashdata('success', "Solar details saved");
        }

        redirect("solar/");
    }
}