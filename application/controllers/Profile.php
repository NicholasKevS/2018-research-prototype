<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends CI_Controller {

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
        $this->session->set_flashdata('success','<p>Profile saved.</p>');
        redirect('profile/');
    }
}