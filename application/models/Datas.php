<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Datas extends CI_Model {

    public function getUsage($id, $date, $hour)
    {
        return $this->db->get_where('node_usages', array('nodeid'=>$id, 'date'=>$date, 'time'=>$hour))->row_array();
    }

    public function getUsageTotalByDate($date)
    {
        return $this->db->select_sum('amount')->get_where('node_usages', array('date'=>$date))->row_array()['amount'];
    }

    public function getUsageTotalByHour($date, $hour)
    {
        return $this->db->select_sum('amount')->get_where('node_usages', array('date'=>$date, 'time'=>$hour))->row_array()['amount'];
    }

    public function getProduction($id, $date, $hour)
    {
        return $this->db->get_where('solar_productions', array('solarid'=>$id, 'date'=>$date, 'time'=>$hour))->row_array();
    }

    public function getProductionTotalByDate($date)
    {
        return $this->db->select_sum('amount')->get_where('solar_productions', array('date'=>$date))->row_array()['amount'];
    }

    public function getProductionTotalByHour($date, $hour)
    {
        return $this->db->select('amount')->get_where('solar_productions', array('date'=>$date, 'time'=>$hour))->row_array()['amount'];
    }

    public function getPrice($id)
    {
        return $this->db->from('provider_price')->join('users', 'provider_price.providerid = users.providerid')->where('users.id', $id)
            ->get()->row_array();
    }
}