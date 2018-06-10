<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Research extends MY_Controller {

    public function index()
    {
        if($this->input->post('date')) {
            $date = $this->input->post('date');
        } else {
            $date = '30 May 2018';
        }
        if($this->input->post('time1')) {
            $time1 = $this->input->post('time1');
        } else {
            $time1 = '00:00';
        }
        if($this->input->post('time2')) {
            $time2 = $this->input->post('time2');
        } else {
            $time2 = '23:00';
        }

        $data['date'] = $date;
        $data['time1'] = $time1;
        $data['time2'] = $time2;
        $data['capacity'] = $this->db->get('research')->row_array()['capacity'];

        $data['timeAxis'] = $this->processor->getTimeAxis($time1, $time2);
        $data['level'] = $this->getLevel($date, $time1, $time2);

        $data['title'] = "Research Page";
        $data['view'] = "research";
        $this->load->view('master', $data);
    }

    public function populate()
    {
        $this->db->empty_table('research');
        $full = $this->input->post('capacity');
        $empty = 0.000;
        $total = $full;
        for($i=0;$i<30;$i++) {
            $d = mktime(0, 0, 0, 5, 1+$i, 2018);
            $date = date('Y-m-d', $d);
            for($hour=0;$hour<24;$hour++) {
                if($i == 29 && $hour>15) continue;
                $act = $this->db->select('battery_acts.*')->from('battery_acts')
                    ->join('batteries', 'battery_acts.batteryid = batteries.id')
                    ->where('batteries.userid', $this->session->id)->where('battery_acts.date', $date)
                    ->where('battery_acts.time', $hour)->get()->row_array();

                if($act['status']==1) {
                    $total -= $act['amount'];
                    if($total < $empty) {
                        $total = $empty;
                    }
                } else {
                    $total += $act['amount'];
                    if($total > $full) {
                        $total = $full;
                    }
                }

                $total = round($total, 3);
                $this->db->insert('research', array('date'=>$date, 'time'=>$hour, 'amount'=>$total, 'capacity'=>$full));
            }
        }
        redirect('research/');
    }

    private function getLevel($date, $from, $to)
    {
        $level = array();
        $date = date("Y-m-d", strtotime($date));
        $from = (int)explode(":", $from)[0];
        $to = (int)explode(":", $to)[0];
        $capacity = $this->db->get('research')->row_array()['capacity'];
        for($i=$from;$i<=$to;$i++) {
            $amount = $this->db->select('amount')
                ->get_where('research', array('date'=>$date, 'time'=>$i))->row_array()['amount'];
            if($amount == null) {
                array_push($level, $amount);
            } else {
                $final = ($amount/$capacity) * 100;
                array_push($level, round($final, 3));
            }
        }
        return $level;
    }
}