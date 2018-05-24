<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

    public function index()
    {
        if($this->session->userdata('isLogin')) {
            redirect('dashboard/');
        } else {
            $this->load->view('login');
        }
    }

    public function register()
    {
        $this->load->view('register');
    }
    public function forgot()
    {
        $this->load->view('forgot_password');
    }

    public function check()
    {
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('alert',validation_errors());
            redirect();
        } else {
            $user = $this->input->post('username');
            $pass = $this->input->post('password');
            $result = $this->users->login($user, $pass);

            if(!empty($result)) {
                if($result['type'] == 1) {
                    $admin = TRUE;
                } else {
                    $admin = FALSE;
                }
                $this->session->set_userdata(array('id'=>$result['id'], 'fullname'=>$result['fullname'], 'isAdmin'=>$admin, 'isLogin'=>'yes'));
                redirect('welcome/');
            } else {
                $this->session->set_flashdata('alert','<p>Username or password is wrong.</p>');
                redirect();
            }
        }
    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect();
    }
}