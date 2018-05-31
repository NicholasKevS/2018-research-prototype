<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends MY_Controller {

    public function index()
    {
        $data['profile'] = $this->users->getUser($this->session->id);
        $data['suburb'] = $this->users->getSuburbs();
        $data['provider'] = $this->users->getProviders();
        $data['title'] = "Profile";
        $data['view'] = "profile";
        $this->load->view('master', $data);
    }

    public function save()
    {
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required');
        $this->form_validation->set_rules('fullname', 'Full Name', 'required');
        $this->form_validation->set_rules('providercode', 'Electricity Provider Customer ID', 'required');

        if($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('alert',validation_errors());
        } else {
            $data = array(
                'username'=>$this->input->post('username'),
                'email'=>$this->input->post('email'),
                'fullname'=>$this->input->post('fullname'),
                'locationid'=>$this->input->post('locationid'),
                'providerid'=>$this->input->post('providerid'),
                'providercode'=>$this->input->post('providercode'));

            $this->processor->saveProfile($this->session->id, $data);

            $this->session->set_flashdata('success',"Profile saved");
        }

        redirect('profile/');
    }
}