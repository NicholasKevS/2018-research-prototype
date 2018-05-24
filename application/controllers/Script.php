<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Script extends CI_Controller {

    public function index()
    {
        echo "No script to run.";
		//$this->populate_usage();
        //$this->populate_production();
        //$this->populate_battery_act();
        //$this->populate_battery_sum();
    }

	private function populate_usage()
	{
		for($i=0;$i<3;$i++) {
		    $d = mktime(0, 0, 0, 5, 14+$i, 2018);
		    $date = date('Y-m-d', $d);
		    echo "ADD TO USAGE DATE $date<br>";
			for($hour=0;$hour<24;$hour++) {
                echo "ADD USAGE TIME $hour<br>";
                $this->db->insert('node_usages', array('nodeid'=>1, 'date'=>$date, 'time'=>$hour, 'amount'=>0.25));
                $this->db->insert('node_usages', array('nodeid'=>2, 'date'=>$date, 'time'=>$hour, 'amount'=>0.15));
                $this->db->insert('node_usages', array('nodeid'=>3, 'date'=>$date, 'time'=>$hour, 'amount'=>0.014));
                $this->db->insert('node_usages', array('nodeid'=>4, 'date'=>$date, 'time'=>$hour, 'amount'=>0.034));
                $this->db->insert('node_usages', array('nodeid'=>5, 'date'=>$date, 'time'=>$hour, 'amount'=>0.243));
                $this->db->insert('node_usages', array('nodeid'=>6, 'date'=>$date, 'time'=>$hour, 'amount'=>0.14));
			}
		}
		echo "DONE";
	}

	private function populate_production()
    {
        $base = 2.208;
        for($i=0;$i<3;$i++) {
            $d = mktime(0, 0, 0, 5, 14+$i, 2018);
            $date = date('Y-m-d', $d);
            echo "ADD TO PRODUCTION DATE $date<br>";
            for($hour=7;$hour<18;$hour++) {
                echo "ADD PRODUCTION TIME $hour<br>";

                if(rand(1,100) <= 50) {
                    $final = $base - ($base*rand(1,40)/100);
                } else {
                    $final = $base;
                }
                $this->db->insert('solar_productions', array('solarid'=>1, 'date'=>$date, 'time'=>$hour, 'amount'=>$final));
            }
        }
        echo "DONE";
    }

    private function populate_battery_act()
    {
        for($i=0;$i<3;$i++) {
            $d = mktime(0, 0, 0, 5, 14+$i, 2018);
            $date = date('Y-m-d', $d);
            echo "ADD TO BATTERY ACT DATE $date<br>";
            for($hour=0;$hour<24;$hour++) {
                echo "ADD BATTERY ACT TIME $hour<br>";
                $production = $this->db->select('amount')->get_where('solar_productions', array('date'=>$date, 'time'=>$hour))->row_array()['amount'];
                $usage = $this->db->select_sum('amount')->get_where('node_usages', array('date'=>$date, 'time'=>$hour))->row_array()['amount'];
                $production = number_format($production,3);
                $usage = number_format($usage,3);
                $total = $production - $usage;

                if($total < 0) {
                    $status = 1;
                    $final = $total * -1.000;
                } else {
                    $status = 2;
                    $final = $total;
                }
                $this->db->insert('battery_acts', array('batteryid'=>1, 'date'=>$date, 'time'=>$hour, 'status'=>$status, 'amount'=>$final));
            }
        }
        echo "DONE";
    }

    private function populate_battery_sum()
    {
        for($i=0;$i<3;$i++) {
            $d = mktime(0, 0, 0, 5, 14+$i, 2018);
            $date = date('Y-m-d', $d);
            echo "ADD TO BATTERY SUM DATE $date<br>";
            $production = $this->db->select_sum('amount')->get_where('battery_acts', array('date'=>$date, 'status'=>2))->row_array()['amount'];
            $usage = $this->db->select_sum('amount')->get_where('battery_acts', array('date'=>$date, 'status'=>1))->row_array()['amount'];
            $production = number_format($production,3);
            $usage = number_format($usage,3);
            $total = $production - $usage;

            if($total < 0) {
                $status = 1;
                $final = $total * -1.000;
            } else {
                $status = 2;
                $final = $total;
            }
            $this->db->insert('battery_sums', array('batteryid'=>1, 'date'=>$date, 'status'=>$status, 'amount'=>$final));
        }
        echo "DONE";
    }
}