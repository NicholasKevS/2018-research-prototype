<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Script extends CI_Controller {

    public function index()
    {
        $data['title'] = "Script";
        $data['view'] = "script";
		$this->populate_usage();
    }

	private function populate_usage()
	{
		$run = "run";

		for($i=0;$i<3;$i++) {
		    $date = "date";
		    echo "ADD TO DATE<br>";
			for($hour=0;$hour<25;$hour++) {
                echo "ADD USAGE<br>";
			}
		}
		//print_r($this->db->query("SELECT * FROM users")->result_array());
		echo "DONE";
	}
}