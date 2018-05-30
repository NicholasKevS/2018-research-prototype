<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Script extends CI_Controller {

    public function index()
    {
        echo "No script to run.";
        //$this->populate_usage();
		//$this->populate_production();
		//$this->populate_battery_act();
		//$this->populate_vehicle_act();
    }

	private function populate_usage()
	{
	    $fridge = 0.25;
	    $computer = 0.15;
	    $lamp = 0.014;
        $blanket = 0.034;
        $tv = 0.243;
        $ps = 0.14;
		for($i=0;$i<3;$i++) {
		    $d = mktime(0, 0, 0, 5, 14+$i, 2018);
		    $date = date('Y-m-d', $d);
		    echo "ADD TO USAGE DATE $date<br>";
			for($hour=0;$hour<24;$hour++) {
                echo "ADD USAGE TIME $hour<br>";

                if(rand(1,100) <= 50) {
                    $fridge = $fridge - ($fridge*rand(1,20)/100);
                } else {
                    $fridge = $fridge + ($fridge*rand(1,20)/100);
                }
                if(rand(1,100) <= 50) {
                    $computer = $computer - ($computer*rand(1,20)/100);
                } else {
                    $computer = $computer + ($computer*rand(1,20)/100);
                }
                if(rand(1,100) <= 50) {
                    $lamp = $lamp - ($lamp*rand(1,20)/100);
                } else {
                    $lamp = $lamp + ($lamp*rand(1,20)/100);
                }
                if(rand(1,100) <= 50) {
                    $blanket = $blanket - ($blanket*rand(1,20)/100);
                } else {
                    $blanket = $blanket + ($blanket*rand(1,20)/100);
                }
                if(rand(1,100) <= 50) {
                    $tv = $tv - ($tv*rand(1,20)/100);
                } else {
                    $tv = $tv + ($tv*rand(1,20)/100);
                }
                if(rand(1,100) <= 50) {
                    $ps = $ps - ($ps*rand(1,20)/100);
                } else {
                    $ps = $ps + ($ps*rand(1,20)/100);
                }
                $this->db->insert('node_usages', array('nodeid'=>1, 'date'=>$date, 'time'=>$hour, 'amount'=>$fridge));
                $this->db->insert('node_usages', array('nodeid'=>2, 'date'=>$date, 'time'=>$hour, 'amount'=>$computer));
                $this->db->insert('node_usages', array('nodeid'=>3, 'date'=>$date, 'time'=>$hour, 'amount'=>$lamp));
                $this->db->insert('node_usages', array('nodeid'=>4, 'date'=>$date, 'time'=>$hour, 'amount'=>$blanket));
                $this->db->insert('node_usages', array('nodeid'=>5, 'date'=>$date, 'time'=>$hour, 'amount'=>$tv));
                $this->db->insert('node_usages', array('nodeid'=>6, 'date'=>$date, 'time'=>$hour, 'amount'=>$ps));
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
                    $final = $base + ($base*rand(1,15)/100);
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
                $total = $production - $usage;

                if($total < 0) {
                    $status = 1;
                    $final = $total * -1;
                } else {
                    $status = 2;
                    $final = $total;
                }
                $final = number_format($final,3);
                $this->db->insert('battery_acts', array('batteryid'=>1, 'date'=>$date, 'time'=>$hour, 'status'=>$status, 'amount'=>$final));
            }
        }
        echo "DONE";
    }

    private function populate_vehicle_act()
    {
        for($i=0;$i<3;$i++) {
            $d = mktime(0, 0, 0, 5, 14+$i, 2018);
            $date = date('Y-m-d', $d);
            echo "ADD TO VEHICLE ACT DATE $date<br>";
            for($hour=0;$hour<24;$hour++) {
                echo "ADD VEHICLE ACT TIME $hour<br>";
                $production = $this->db->select('amount')->get_where('solar_productions', array('date'=>$date, 'time'=>$hour))->row_array()['amount'];
                $usage = $this->db->select_sum('amount')->get_where('node_usages', array('date'=>$date, 'time'=>$hour))->row_array()['amount'];
                $total = ($production - $usage)/2;

                if($total < 0) {
                    $status = 1;
                    $final = $total * -1.000;
                } else {
                    $status = 2;
                    $final = $total;
                }

                if(rand(1,100) <= 50) {
                    $final = $final - ($final*rand(1,40)/100);
                } else {
                    $final = $final + ($final*rand(1,15)/100);
                }
                $final = number_format($final,3);
                $this->db->insert('vehicle_acts', array('vehicleid'=>1, 'date'=>$date, 'time'=>$hour, 'status'=>$status, 'amount'=>$final));
            }
        }
        echo "DONE";
    }

//    private function populate_battery_sum()
//    {
//        for($i=0;$i<3;$i++) {
//            $d = mktime(0, 0, 0, 5, 14+$i, 2018);
//            $date = date('Y-m-d', $d);
//            echo "ADD TO BATTERY SUM DATE $date<br>";
//            $production = $this->db->select_sum('amount')->get_where('battery_acts', array('date'=>$date, 'status'=>2))->row_array()['amount'];
//            $usage = $this->db->select_sum('amount')->get_where('battery_acts', array('date'=>$date, 'status'=>1))->row_array()['amount'];
//            $production = number_format($production,3);
//            $usage = number_format($usage,3);
//            $total = $production - $usage;
//
//            if($total < 0) {
//                $status = 1;
//                $final = $total * -1.000;
//            } else {
//                $status = 2;
//                $final = $total;
//            }
//            $this->db->insert('battery_sums', array('batteryid'=>1, 'date'=>$date, 'status'=>$status, 'amount'=>$final));
//        }
//        echo "DONE";
//    }
}