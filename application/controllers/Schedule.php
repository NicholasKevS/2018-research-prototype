<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Schedule extends MY_Controller {

    public function index()
    {
        $data['schedules'] = $this->processor->getAllSchedules($this->session->id);

        $data['title'] = "Node Schedules List";
        $data['view'] = "schedule";
        $this->load->view('master', $data);
    }

    public function detail($nodeid)
    {
        $data['schedules'] = $this->processor->getSchedules($nodeid);
        $data['node'] = $this->processor->getNode($nodeid);

        $data['title'] = "Node Schedule Detail";
        $data['view'] = "schedule_detail";
        $this->load->view('master', $data);
    }

    public function create($nodeid)
    {
        $data['nodeid'] = $nodeid;

        $data['title'] = "Create Schedule";
        $data['view'] = "schedule_create";
        $this->load->view('master', $data);
    }

    public function saveCreate()
    {
        $this->form_validation->set_rules('start', 'Start', 'required');
        $this->form_validation->set_rules('end', 'End', 'required');

        if($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('alert',validation_errors());
            $this->session->set_flashdata('status',$this->input->post('status'));
            $this->session->set_flashdata('start',$this->input->post('start'));
            $this->session->set_flashdata('end',$this->input->post('end'));

            redirect('schedule/create/'.$this->input->post('nodeid'));
        } else {
            $data = array(
                'id'=>$this->input->post('id'),
                'nodeid'=>$this->input->post('nodeid'),
                'status'=>$this->input->post('status'),
                'start'=>(int)explode(":", $this->input->post('start'))[0],
                'end'=>(int)explode(":", $this->input->post('end'))[0]
            );
            $this->processor->saveSchedule($data);
            $this->session->set_flashdata('success', "Schedule saved");
        }

        redirect('schedule/detail/'.$this->input->post('nodeid'));
    }

    public function edit($id)
    {
        $data['schedule'] = $this->processor->getSchedule($id);
        $data['nodeName'] = $this->processor->getNode($data['schedule']['nodeid'])['name'];

        $data['title'] = "Edit Schedule";
        $data['view'] = "schedule_edit";
        $this->load->view('master', $data);
    }

    public function saveEdit()
    {
        $data = array(
            'id'=>$this->input->post('id'),
            'nodeid'=>$this->input->post('nodeid'),
            'status'=>$this->input->post('status'),
            'start'=>(int)explode(":", $this->input->post('start'))[0],
            'end'=>(int)explode(":", $this->input->post('end'))[0]
        );
        $this->processor->saveSchedule($data);
        $this->session->set_flashdata('success', "Schedule saved");

        redirect('schedule/edit/'.$this->input->post('id'));
    }

    public function delete($nodeid, $id)
    {
        $this->processor->delSchedule($id);
        $this->session->set_flashdata('success', "Schedule deleted");

        redirect('schedule/detail/'.$nodeid);
    }
}