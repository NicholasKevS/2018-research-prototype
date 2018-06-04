<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Node extends MY_Controller {

    public function index()
    {
        $data['nodes'] = $this->processor->getNodes($this->session->id);

        $data['title'] = "Nodes List";
        $data['view'] = "node";
        $this->load->view('master', $data);
    }

    public function save()
    {
        $status = $this->input->post('status');

        if($this->processor->saveNodes($this->session->id, $status)) {
            $this->session->set_flashdata('success',"Save success");
        } else {
            $this->session->set_flashdata('alert',"Saving failed");
        }

        redirect('node/');
    }

    public function create()
    {
        $data['title'] = "Create Node";
        $data['view'] = "node_create";
        $this->load->view('master', $data);
    }

    public function saveCreate()
    {
        $this->form_validation->set_rules('name', 'Node Name', 'required');
        $this->form_validation->set_rules('code', 'Id Number', 'required');

        if($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('alert',validation_errors());
            $this->session->set_flashdata('name',$this->input->post('name'));
            $this->session->set_flashdata('code',$this->input->post('code'));
            redirect('node/create/');
        } else {
            $data = array(
                'id'=>$this->input->post('id'),
                'userid'=>$this->session->id,
                'name'=>$this->input->post('name'),
                'code'=>$this->input->post('code'),
                'status'=>$this->input->post('status'));

            $this->processor->saveNode($data);
            $this->session->set_flashdata('success', "Node created");
        }

        redirect('node/');
    }

    public function detail($id)
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

        $data['date'] = $date;
        $data['time1'] = $time1;
        $data['time2'] = $time2;

        $data['timeAxis'] = $this->processor->getTimeAxis($time1, $time2);
        $data['usage'] = $this->processor->getNodeUsage($id, $date, $time1, $time2);
        $data['total'] = $this->processor->getHourlyUsage($this->session->id, $date, $time1, $time2);
        $data['node'] = $this->processor->getNode($id);
        if($data['node']['status'] == 1) {
            $data['checked'] = " Checked";
        } else {
            $data['checked'] = "";
        }

        $data['title'] = "Node Detail";
        $data['view'] = "node_detail";
        $this->load->view('master', $data);
    }

    public function saveDetail()
    {
        $this->form_validation->set_rules('name', 'Node Name', 'required');
        $this->form_validation->set_rules('code', 'Id Number', 'required');

        if($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('alert',validation_errors());
        } else {
            $status = ($this->input->post('status')?1:0);
            $data = array(
                'id'=>$this->input->post('id'),
                'userid'=>$this->session->id,
                'name'=>$this->input->post('name'),
                'code'=>$this->input->post('code'),
                'status'=>$status);

            $this->processor->saveNode($data);
            $this->session->set_flashdata('success', "Node details saved");
        }

        redirect('node/detail/'.$this->input->post('id'));
    }

    public function delete($id)
    {
        $this->processor->delNode($id);
        $this->session->set_flashdata('success', "Node deleted");

        redirect('node/');
    }
}