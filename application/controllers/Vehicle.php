<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Vehicle extends MY_Controller {

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
        $data['battery'] = $this->processor->getHourlyVehicleBat($id, $date, $time1, $time2);
        $data['vehicle'] = $this->processor->getVehicle($id);

        $data['title'] = "Electric Vehicle";
        $data['view'] = "vehicle";
        $this->load->view('master', $data);
    }

    public function save()
    {
        $this->form_validation->set_rules('name', 'Vehicle Name', 'required');
        $this->form_validation->set_rules('code', 'Id Number', 'required');
        $this->form_validation->set_rules('capacity', 'Battery Capacity', 'required');

        if($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('alert',validation_errors());
        } else {
            $data = array(
                'id'=>$this->input->post('id'),
                'userid'=>$this->session->id,
                'name'=>$this->input->post('name'),
                'code'=>$this->input->post('code'),
                'capacity'=>$this->input->post('capacity'));

            $this->processor->saveVehicle($data);

            $this->session->set_flashdata('success', "Vehicle details saved");
        }

        redirect('vehicle/');
    }
}