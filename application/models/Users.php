<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Model {

    public function login($user, $pass)
    {
        return $this->db->get_where('users', array('username'=>$user,'password'=>$pass))->row_array();
    }

    public function getAll($id)
    {
        return $this->db->get_where('users', array('id'=>$id))->row_array();
    }
}