<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends MY_Controller {

    public function index()
    {
        $final = $this->processor->getReport($this->session->id, '30 May 2018', '30 May 2018')[0]['final'];
        number_format($final/100, 2);
        if($final >= 0) {
            $data['summary'] = 'You earn $'.$final.' today so far!';
        } else {
            $data['summary'] = 'You used $'.abs($final).' today so far';
        }

        $data['title'] = "Welcome Page";
        $data['view'] = "welcome";
        $this->load->view('master', $data);
    }
}