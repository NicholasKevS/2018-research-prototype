<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Notification extends MY_Controller {

    public function index()
    {
        //$this->read();
        $data['notifications'] = $this->processor->getNotifications($this->session->id);
        $data['title'] = "Notification";
        $data['view'] = "notification";
        $this->load->view('master', $data);
    }

    public function read()
    {
        $this->processor->readNotifications($this->session->id);
    }
}