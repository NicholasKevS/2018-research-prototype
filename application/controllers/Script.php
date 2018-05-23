<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Script extends CI_Controller {

    public function index()
    {
        $data['title'] = "Script";
        $data['view'] = "script";
		$this->run();
    }
	
	private function run()
	{
		$run = "run";
		for($i=0;$i>3;$i++) {
			for($hour=0;$hour>25;$hour++) {
				
			}
		}
		//print_r($this->db->query("SELECT * FROM users")->result_array());
		echo "done";
	}
}