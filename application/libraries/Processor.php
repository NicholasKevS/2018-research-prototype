<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Processor {

    protected $CI;

    public function __construct()
    {
        $this->CI =& get_instance();
    }

    public function getHourlyUsage($date)
    {
        $total = array();
        for($i=0;$i<24;$i++) {
            $usage = $this->CI->datas->getUsageTotalByHour($date, $i);
            array_push($total, number_format($usage,3));
        }
        return $total;
    }

    public function getHourlyProduction($date)
    {
        $total = array();
        for($i=0;$i<24;$i++) {
            $production = $this->CI->datas->getProductionTotalByHour($date, $i);
            array_push($total, number_format($production,3));
        }
        return $total;
    }
}