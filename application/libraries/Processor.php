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

    public function saveProfile($id, $data)
    {
        return $this->CI->users->saveProfile($id, $data);
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

    public function getHourlyUsage($userid, $date, $from, $to)
    {
        $total = array();
        $from = (int)explode(":", $from)[0];
        $to = (int)explode(":", $to)[0];
        for($i=$from;$i<=$to;$i++) {
            $usage = $this->CI->datas->getUsageTotalByHour($userid, $date, $i);
            array_push($total, number_format($usage, 3));
        }
        return $total;
    }

    public function getHourlyProduction($userid, $date, $from, $to)
    {
        $total = array();
        $from = (int)explode(":", $from)[0];
        $to = (int)explode(":", $to)[0];
        for($i=$from;$i<=$to;$i++) {
            $production = $this->CI->datas->getProductionTotalByHour($userid, $date, $i);
            array_push($total, number_format($production, 3));
        }
        return $total;
    }

    public function getPrice($id, $date, $from, $to)
    {
        $final = array();
        $date = date('N', strtotime($date));
        $from = (int)explode(":", $from)[0];
        $to = (int)explode(":", $to)[0];
        $price = $this->CI->datas->getPrice($id);

        if($date < 6) {
            for($i=$from;$i<=$to;$i++) {
                if(($i>=0 && $i<=6) || ($i>=22 && $i<=23)) {
                    array_push($final, $price['offpeak']);
                } elseif(($i>=7 && $i<=13) || ($i>=20 && $i<=21)) {
                    array_push($final, $price['shoulder']);
                } elseif($i>=14 && $i<=19) {
                    array_push($final, $price['peak']);
                }
            }
        } else {
            for($i=$from;$i<=$to;$i++) {
                if(($i>=0 && $i<=6) || ($i>=22 && $i<=23)) {
                    array_push($final, $price['offpeak']);
                } elseif($i>=7 && $i<=21) {
                    array_push($final, $price['shoulder']);
                }
            }
        }

        return $final;
    }
}