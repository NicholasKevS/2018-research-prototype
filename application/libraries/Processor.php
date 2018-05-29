<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Processor {

    protected $CI;

    public function __construct()
    {
        $this->CI =& get_instance();
    }

    public function checkLogin()
    {
        if(!$this->CI->session->userdata('isLogin')) {
            redirect('');
        }
    }

    public function getTimeAxis($from, $to) {
        $time = array();
        $from = (int)explode(":", $from)[0];
        $to = (int)explode(":", $to)[0];
        for($i=$from;$i<=$to;$i++) {
            if($i<10) {
                $temp = "0$i:00";
            } else {
                $temp = "$i:00";
            }
            array_push($time, $temp);
        }
        return $time;
    }

    public function getHourlyUsage($date, $from, $to)
    {
        $total = array();
        $from = (int)explode(":", $from)[0];
        $to = (int)explode(":", $to)[0];
        for($i=$from;$i<=$to;$i++) {
            $usage = $this->CI->datas->getUsageTotalByHour($date, $i);
            array_push($total, number_format($usage,3));
        }
        return $total;
    }

    public function getHourlyProduction($date, $from, $to)
    {
        $total = array();
        $from = (int)explode(":", $from)[0];
        $to = (int)explode(":", $to)[0];
        for($i=$from;$i<=$to;$i++) {
            $production = $this->CI->datas->getProductionTotalByHour($date, $i);
            array_push($total, number_format($production,3));
        }
        return $total;
    }

    public function getPrice($id)
    {
        return $this->CI->datas->getPrice($id);
    }
}