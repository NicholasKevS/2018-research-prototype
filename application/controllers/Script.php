<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Script extends CI_Controller {

    public function index()
    {
		//$this->populate_usage();
        //$this->populate_production();
        echo "No script run.";
    }

	private function populate_usage()
	{
		for($i=0;$i<3;$i++) {
		    $d = mktime(0, 0, 0, 5, 14+$i, 2018);
		    $date = date('Y-m-d', $d);
		    echo "ADD TO DATE $date<br>";
			for($hour=0;$hour<24;$hour++) {
                echo "ADD USAGE TIME $hour<br>";
                $this->db->insert('node_usages', array('nodeid'=>'1', 'date'=>$date, 'time'=>$hour, 'amount'=>0.25));
                $this->db->insert('node_usages', array('nodeid'=>'2', 'date'=>$date, 'time'=>$hour, 'amount'=>0.15));
                $this->db->insert('node_usages', array('nodeid'=>'3', 'date'=>$date, 'time'=>$hour, 'amount'=>0.014));
                $this->db->insert('node_usages', array('nodeid'=>'4', 'date'=>$date, 'time'=>$hour, 'amount'=>0.034));
                $this->db->insert('node_usages', array('nodeid'=>'5', 'date'=>$date, 'time'=>$hour, 'amount'=>0.243));
                $this->db->insert('node_usages', array('nodeid'=>'6', 'date'=>$date, 'time'=>$hour, 'amount'=>0.14));
			}
		}
		//print_r($this->db->query("SELECT * FROM users")->result_array());
		echo "DONE";
	}

	private function populate_production()
    {
        $base = 2.208;
        for($i=0;$i<3;$i++) {
            $d = mktime(0, 0, 0, 5, 14+$i, 2018);
            $date = date('Y-m-d', $d);
            echo "ADD TO DATE $date<br>";
            for($hour=0;$hour<24;$hour++) {
                echo "ADD PRODUCTION TIME $hour<br>";

                if(rand(1,100) <= 50) {
                    $final = $base - ($base*rand(1,40)/100);
                } else {
                    $final = $base;
                }
                $this->db->insert('solar_productions', array('solarid'=>'1', 'date'=>$date, 'time'=>$hour, 'amount'=>$final));
            }
        }
        echo "DONE";
    }
}