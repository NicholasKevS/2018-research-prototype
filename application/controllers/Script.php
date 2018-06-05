<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Script extends CI_Controller {

    public function index()
    {
        $run = FALSE;

        if($run) {
            $userid = 1;
            echo "User Id: $userid <br>";
            $this->populate_usage($userid);
            $this->populate_production($userid);
            $this->populate_battery_act($userid);
            $this->populate_battery_sum($userid);
            $this->populate_vehicle_bat($userid);
        } else {
            echo "No script to run.";
        }
    }

    private function purge_data()
    {
        $this->db->empty_table('node_usages');
        $this->db->empty_table('solar_productions');
        $this->db->empty_table('forecast_today');
        $this->db->empty_table('forecast_tomorrow');
        $this->db->empty_table('battery_acts');
        $this->db->empty_table('battery_sums');
        $this->db->empty_table('vehicle_bats');
    }

	private function populate_usage($userid)
	{
	    $fridge = 0.25;
        $comp = 0.15;
	    $lamp = 0.014;
        $blanket = 0.034;
        $tv = 0.243;
        $ps = 0.14;
		for($i=0;$i<30;$i++) {
		    $d = mktime(0, 0, 0, 5, 1+$i, 2018);
		    $date = date('Y-m-d', $d);
		    echo "ADD TO USAGE DATE $date<br>";
			for($hour=0;$hour<24;$hour++) {
			    if($i == 29 && $hour>15) continue;
                echo "ADD USAGE TIME $hour<br>";

                $fridgeid = 1+(6*($userid-1));
                $compid = 2+(6*($userid-1));
                $lampid = 3+(6*($userid-1));
                $blanketid = 4+(6*($userid-1));
                $tvid = 5+(6*($userid-1));
                $psid = 6+(6*($userid-1));

                $fridgesch = $this->db->get_where('node_schedules', array('nodeid'=>$fridgeid, 'status'=>0))->row_array();
                $compsch = $this->db->get_where('node_schedules', array('nodeid'=>$compid, 'status'=>0))->row_array();
                $lampsch = $this->db->get_where('node_schedules', array('nodeid'=>$lampid, 'status'=>0))->row_array();
                $blanketsch = $this->db->get_where('node_schedules', array('nodeid'=>$blanketid, 'status'=>0))->row_array();
                $tvsch = $this->db->get_where('node_schedules', array('nodeid'=>$tvid, 'status'=>0))->row_array();
                $pssch = $this->db->get_where('node_schedules', array('nodeid'=>$psid, 'status'=>0))->row_array();

                if($fridgesch['start']<=$hour && $hour<=$fridgesch['end']) {
                    $fridgefin = 0;
                } else {
                    if(rand(1,100) <= 50) {
                        $fridgefin = $fridge - ($fridge*rand(1,20)/100);
                    } else {
                        $fridgefin = $fridge + ($fridge*rand(1,20)/100);
                    }
                }
                if($compsch['start']<=$hour && $hour<=$compsch['end']) {
                    $compfin = 0;
                } else {
                    if(rand(1,100) <= 50) {
                        $compfin = $comp - ($comp*rand(1,20)/100);
                    } else {
                        $compfin = $comp + ($comp*rand(1,20)/100);
                    }
                }
                if($lampsch['start']<=$hour && $hour<=$lampsch['end']) {
                    $lampfin = 0;
                } else {
                    if (rand(1, 100) <= 50) {
                        $lampfin = $lamp - ($lamp * rand(1, 20) / 100);
                    } else {
                        $lampfin = $lamp + ($lamp * rand(1, 20) / 100);
                    }
                }
                if($blanketsch['start']<=$hour && $hour<=$blanketsch['end']) {
                    $blanketfin = 0;
                } else {
                    if (rand(1, 100) <= 50) {
                        $blanketfin = $blanket - ($blanket * rand(1, 20) / 100);
                    } else {
                        $blanketfin = $blanket + ($blanket * rand(1, 20) / 100);
                    }
                }
                if($tvsch['start']<=$hour && $hour<=$tvsch['end']) {
                    $tvfin = 0;
                } else {
                    if (rand(1, 100) <= 50) {
                        $tvfin = $tv - ($tv * rand(1, 20) / 100);
                    } else {
                        $tvfin = $tv + ($tv * rand(1, 20) / 100);
                    }
                }
                if($pssch['start']<=$hour && $hour<=$pssch['end']) {
                    $psfin = 0;
                } else {
                    if (rand(1, 100) <= 50) {
                        $psfin = $ps - ($ps * rand(1, 20) / 100);
                    } else {
                        $psfin = $ps + ($ps * rand(1, 20) / 100);
                    }
                }

                $this->db->insert('node_usages', array('nodeid'=>$fridgeid, 'date'=>$date, 'time'=>$hour, 'amount'=>$fridgefin));
                $this->db->insert('node_usages', array('nodeid'=>$compid, 'date'=>$date, 'time'=>$hour, 'amount'=>$compfin));
                $this->db->insert('node_usages', array('nodeid'=>$lampid, 'date'=>$date, 'time'=>$hour, 'amount'=>$lampfin));
                $this->db->insert('node_usages', array('nodeid'=>$blanketid, 'date'=>$date, 'time'=>$hour, 'amount'=>$blanketfin));
                $this->db->insert('node_usages', array('nodeid'=>$tvid, 'date'=>$date, 'time'=>$hour, 'amount'=>$tvfin));
                $this->db->insert('node_usages', array('nodeid'=>$psid, 'date'=>$date, 'time'=>$hour, 'amount'=>$psfin));
			}
		}
		echo "DONE";
	}

	private function populate_production($userid)
    {
        $base = 2.208;
        for($i=0;$i<30;$i++) {
            $d = mktime(0, 0, 0, 5, 1+$i, 2018);
            $date = date('Y-m-d', $d);
            echo "ADD TO PRODUCTION DATE $date<br>";
            for($hour=0;$hour<24;$hour++) {
                if($i == 29 && $hour>15) continue;
                echo "ADD PRODUCTION TIME $hour<br>";

                if($hour<=7 || $hour>=18) {
                    $final = 0;
                } else {
                    if(rand(1,100) <= 50) {
                        $final = $base - ($base*rand(1,40)/100);
                    } else {
                        $final = $base + ($base*rand(1,15)/100);
                    }
                }
                $this->db->insert('solar_productions', array('solarid'=>$userid, 'date'=>$date, 'time'=>$hour, 'amount'=>$final));
            }
        }
        echo "DONE";
    }

    private function populate_battery_act($userid)
    {
        for($i=0;$i<30;$i++) {
            $d = mktime(0, 0, 0, 5, 1+$i, 2018);
            $date = date('Y-m-d', $d);
            echo "ADD TO BATTERY ACT DATE $date<br>";
            for($hour=0;$hour<24;$hour++) {
                if($i == 29 && $hour>15) continue;
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
                $this->db->insert('battery_acts', array('batteryid'=>$userid, 'date'=>$date, 'time'=>$hour, 'status'=>$status, 'amount'=>$final));
            }
        }
        echo "DONE";
    }

    private function populate_battery_sum($userid)
    {
        for($i=0;$i<29;$i++) {
            $d = mktime(0, 0, 0, 5, 1+$i, 2018);
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
            $this->db->insert('battery_sums', array('batteryid'=>$userid, 'date'=>$date, 'status'=>$status, 'amount'=>$final));
        }
        echo "DONE";
    }

    private function populate_vehicle_bat($userid)
    {
        $full = 30.000;
        $empty = 0.000;
        $use = 3.000;
        $charge = 0.500;
        $total = $full/2;
        for($i=0;$i<30;$i++) {
            $d = mktime(0, 0, 0, 5, 1+$i, 2018);
            $date = date('Y-m-d', $d);
            echo "ADD TO VEHICLE ACT DATE $date<br>";
            for($hour=0;$hour<24;$hour++) {
                if($i == 29 && $hour>15) continue;
                echo "ADD VEHICLE ACT TIME $hour<br>";

                if($hour>=6 && $hour<=18) {
                    if(rand(1,100) <= 10) {
                        if(rand(1,100) <= 50) {
                            $total = $total - ($use - ($use*rand(1,20)/100));
                        } else {
                            $total = $total - ($use + ($use*rand(1,20)/100));
                        }
                    } else {
                        if(rand(1,100) <= 50) {
                            $total = $total + ($charge - ($charge*rand(1,20)/100));
                        } else {
                            $total = $total + ($charge + ($charge*rand(1,20)/100));
                        }
                    }
                } elseif($hour>=18 && $hour<=23) {
                    if(rand(1,100) <= 30) {
                        if(rand(1,100) <= 50) {
                            $total = $total - ($use - ($use*rand(1,20)/100));
                        } else {
                            $total = $total - ($use + ($use*rand(1,20)/100));
                        }
                    }
                }

                if($total > $full) {
                    $total = $full;
                } elseif($total < $empty) {
                    $total = $empty;
                }

                $total = number_format($total,3);
                $this->db->insert('vehicle_bats', array('vehicleid'=>$userid, 'date'=>$date, 'time'=>$hour, 'amount'=>$total));
            }
        }
        echo "DONE";
    }
}