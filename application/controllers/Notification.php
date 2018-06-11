<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Notification extends MY_Controller {

    public function index()
    {
        $data['notifications'] = $this->processor->getNotifications($this->session->id);
        $data['title'] = "Notification";
        $data['view'] = "notification";
        $this->load->view('master', $data);
    }

    public function read()
    {
        $this->processor->readNotifications($this->session->id);
    }

    public function unread()
    {
        $this->processor->unreadNotifications($this->session->id);
        $this->session->set_flashdata('success',"All notification are unread");
        redirect('notification/');
    }
}