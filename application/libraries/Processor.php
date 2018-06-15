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
        if(!$this->CI->session->isLogin) {
            redirect('');
        }
    }

    public function checkAdmin()
    {
        if(!$this->CI->session->isAdmin) {
            redirect('dashboard/');
        }
    }

    public function getProfile($id)
    {
        return $this->CI->users->getUser($id);
    }

    public function saveProfile($id, $data)
    {
        return $this->CI->users->saveProfile($id, $data);
    }

    public function getSuburbs()
    {
        return $this->CI->users->getSuburbs();
    }

    public function getLocation($userid)
    {
        return $this->CI->datas->getLocation($userid);
    }

    public function getWeather($userid, $date)
    {
        $date = date("Y-m-d", strtotime($date));
        return $this->CI->datas->getWeather($userid, $date);
    }

    public function getProviders()
    {
        return $this->CI->users->getProviders();
    }

    public function getProvider($userid)
    {
        return $this->CI->datas->getProvider($userid);
    }

    public function getDateAxis($to)
    {
        $date = array();
        $default = date("j M Y", strtotime("1 May 2018"));
        $from = date("j M Y", strtotime("-6 day", strtotime($to)));
        if(strtotime($from) < strtotime($default)) {
            $from = $default;
        }

        while(strtotime($from) <= strtotime($to)) {
            array_push($date, date("j M", strtotime($from)));
            $from = date("j M Y", strtotime("+1 day", strtotime($from)));
        }
        return $date;
    }

    public function getTimeAxis($from, $to)
    {
        $time = array();
        $from = (int)explode(":", $from)[0];
        $to = (int)explode(":", $to)[0];
        for($i=$from;$i<=$to;$i++) {
            $temp = date('H:00', mktime($i));
            array_push($time, $temp);
        }
        return $time;
    }

    public function getNodeUsage($id, $date, $from, $to)
    {
        $usage = array();
        $date = date("Y-m-d", strtotime($date));
        $from = (int)explode(":", $from)[0];
        $to = (int)explode(":", $to)[0];
        for($i=$from;$i<=$to;$i++) {
            $node = $this->CI->datas->getUsage($id, $date, $i);
            if($node == null) {
                array_push($usage, $node);
            } else {
                array_push($usage, round($node, 3));
            }
        }
        return $usage;
    }

    public function getDailyUsage($userid, $date)
    {
        $date = date("Y-m-d", strtotime($date));
        $usage = $this->CI->datas->getUsageTotalByDate($userid, $date);
        return round($usage, 3);
    }

    public function getHourlyUsage($userid, $date, $from, $to)
    {
        $total = array();
        $date = date("Y-m-d", strtotime($date));
        $from = (int)explode(":", $from)[0];
        $to = (int)explode(":", $to)[0];
        for($i=$from;$i<=$to;$i++) {
            $usage = $this->CI->datas->getUsageTotalByHour($userid, $date, $i);
            if($usage == null) {
                array_push($total, $usage);
            } else {
                array_push($total, round($usage, 3));
            }
        }
        return $total;
    }

    public function getUsageForecastToday($userid)
    {
        $forecast = array();
        $usage = $this->CI->datas->getUsageForecastToday($userid);
        for($i=0;$i<15;$i++) {
            array_push($forecast, null);
        }
        array_push($forecast, $this->CI->datas->getUsageTotalByHour($userid, "2018-05-30", 15));
        foreach($usage as $use) {
            array_push($forecast, round($use['amount'], 3));
        }
        return $forecast;
    }

    public function getUsageForecastTomorrow($userid)
    {
        $forecast = array();
        $usage = $this->CI->datas->getUsageForecastTomorrow($userid);
        foreach($usage as $use) {
            array_push($forecast, round($use['amount'], 3));
        }
        return $forecast;
    }

    public function getAvgHourlyUsage($location, $date, $from, $to)
    {
        $avg = array();
        $date = date("Y-m-d", strtotime($date));
        $from = (int)explode(":", $from)[0];
        $to = (int)explode(":", $to)[0];
        for($i=$from;$i<=$to;$i++) {
            $usage = $this->CI->datas->getUsageAvgByHour($location, $date, $i);
            if($usage == null) {
                array_push($avg, $usage);
            } else {
                array_push($avg, round($usage, 3));
            }
        }
        return $avg;
    }

    public function getDailyProduction($userid, $date)
    {
        $date = date("Y-m-d", strtotime($date));
        $production = $this->CI->datas->getProductionTotalByDate($userid, $date);
        return round($production, 3);
    }

    public function getHourlyProduction($userid, $date, $from, $to)
    {
        $total = array();
        $date = date("Y-m-d", strtotime($date));
        $from = (int)explode(":", $from)[0];
        $to = (int)explode(":", $to)[0];
        for($i=$from;$i<=$to;$i++) {
            $production = $this->CI->datas->getProductionTotalByHour($userid, $date, $i);
            if($production == null) {
                array_push($total, $production);
            } else {
                array_push($total, round($production, 3));
            }
        }
        return $total;
    }

    public function getProductionForecastToday($userid)
    {
        $forecast = array();
        $production = $this->CI->datas->getProductionForecastToday($userid);
        for($i=0;$i<15;$i++) {
            array_push($forecast, null);
        }
        array_push($forecast, $this->CI->datas->getProductionTotalByHour($userid, "2018-05-30", 15));
        foreach($production as $prod) {
            array_push($forecast, round($prod['amount'], 3));
        }
        return $forecast;
    }

    public function getProductionForecastTomorrow($userid)
    {
        $forecast = array();
        $production = $this->CI->datas->getProductionForecastTomorrow($userid);
        foreach($production as $prod) {
            array_push($forecast, round($prod['amount'], 3));
        }
        return $forecast;
    }

    public function getAvgHourlyProduction($location, $date, $from, $to)
    {
        $avg = array();
        $date = date("Y-m-d", strtotime($date));
        $from = (int)explode(":", $from)[0];
        $to = (int)explode(":", $to)[0];
        for($i=$from;$i<=$to;$i++) {
            $production = $this->CI->datas->getProductionAvgByHour($location, $date, $i);
            if($production == null) {
                array_push($avg, $production);
            } else {
                array_push($avg, round($production, 3));
            }
        }
        return $avg;
    }

    public function getMaxMin($datas)
    {
        $max = 0;
        $min = 999;
        foreach($datas as $data) {
            if($data != null) {
                $tempmax = max(array_map('doubleval', $data));
                $tempmin = min(array_map('doubleval', $data));
                if($max < $tempmax) {
                    $max = $tempmax;
                }
                if($min > $tempmin) {
                    $min = $tempmin;
                }
            }
        }
        $max = round($max) + 1;
        $min = round($min) - 1;
        return array('max'=>$max, 'min'=>$min);
    }

    public function getPriceArray($userid, $date, $from, $to)
    {
        $final = array();
        $date = date('N', strtotime($date));
        $from = (int)explode(":", $from)[0];
        $to = (int)explode(":", $to)[0];
        $price = $this->CI->datas->getProvider($userid);

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

    public function getPriceFinal($userid, $date)
    {
        $price = $this->getPriceArray($userid, $date, 0, 23);
        $act = $this->getHourlyBatteryAct($userid, $date, 0, 23);
        $final = 0;

        for($i=0;$i<24;$i++) {
            $sum = $act[$i] * $price[$i];
            $final += $sum;
        }
        return round($final, 2);
    }

    public function getReport($userid, $from, $to)
    {
        $reports = array();
        $from = date("Y-m-d", strtotime($from));
        $to = date("Y-m-d", strtotime($to));
        while(strtotime($from) <= strtotime($to)) {
            $usage = $this->getDailyUsage($userid, $from);
            $production = $this->getDailyProduction($userid, $from);
            $sum = array_sum($this->getHourlyBatteryAct($userid, $from, 0, 23));
            $final = $this->getPriceFinal($userid, $from);
            $data = array(
                'date' => date("j M Y", strtotime($from)),
                'usage' => $usage,
                'production' => $production,
                'sum' => $sum,
                'final' => round($final/100, 2),
            );
            array_push($reports, $data);
            $from = date("j M Y", strtotime("+1 day", strtotime($from)));
        }
        return $reports;
    }

    public function getHourlyBatteryAct($userid, $date, $from, $to)
    {
        $total = array();
        $date = date("Y-m-d", strtotime($date));
        $from = (int)explode(":", $from)[0];
        $to = (int)explode(":", $to)[0];
        for($i=$from;$i<=$to;$i++) {
            $act = $this->CI->datas->getBatteryActByHour($userid, $date, $i);
            if($act == null) {
                array_push($total, $act);
            } else {
                if($act['status'] == 1) {
                    $act['amount']*= -1;
                }
                array_push($total, round($act['amount'], 3));
            }
        }
        return $total;
    }

    public function getBatterySum($userid, $to)
    {
        $total = array();
        $default = date("j M Y", strtotime("1 May 2018"));
        $from = date("j M Y", strtotime("-6 day", strtotime($to)));
        if(strtotime($from) < strtotime($default)) {
            $from = $default;
        }

        while(strtotime($from) <= strtotime($to)) {
            $sum = $this->CI->datas->getBatterySum($userid, date("Y-m-d", strtotime($from)));
            if($sum == null) {
                array_push($total, $sum);
            } else {
                if($sum['status'] == 1) {
                    $sum['amount']*= -1;
                }
                array_push($total, round($sum['amount'], 3));
            }
            $from = date("j M Y", strtotime("+1 day", strtotime($from)));
        }
        return $total;
    }

    public function getAvgBatterySum($location, $to)
    {
        $avg = array();
        $default = date("j M Y", strtotime("1 May 2018"));
        $from = date("j M Y", strtotime("-6 day", strtotime($to)));
        if(strtotime($from) < strtotime($default)) {
            $from = $default;
        }

        while(strtotime($from) <= strtotime($to)) {
            $sum = $this->CI->datas->getAvgBatterySum($location, date("Y-m-d", strtotime($from)));
            if($sum['amount'] == null) {
                array_push($avg, $sum['amount']);
            } else {
                if ($sum['status'] == 1) {
                    $sum['amount'] *= -1;
                }
                array_push($avg, round($sum['amount'], 3));
            }
            $from = date("j M Y", strtotime("+1 day", strtotime($from)));
        }
        return $avg;
    }

    public function getHourlyVehicleBat($userid, $date, $from, $to)
    {
        $total = array();
        $date = date("Y-m-d", strtotime($date));
        $from = (int)explode(":", $from)[0];
        $to = (int)explode(":", $to)[0];
        $capacity = $this->getVehicle($userid)['capacity'];
        for($i=$from;$i<=$to;$i++) {
            $amount = $this->CI->datas->getVehicleBatByHour($userid, $date, $i);
            if($amount == null) {
                array_push($total, $amount);
            } else {
                $final = ($amount/$capacity) * 100;
                array_push($total, round($final, 2));
            }
        }
        return $total;
    }

    public function getNode($id)
    {
        return $this->CI->datas->getNode($id);
    }

    public function getNodes($userid)
    {
        return $this->CI->datas->getNodes($userid);
    }

    public function saveNode($data)
    {
        if($data['id'] == "new") {
            unset($data['id']);
            return $this->CI->datas->insertNode($data);
        } else {
            $this->checkNode($data);
            return $this->CI->datas->updateNode($data);
        }
    }

    public function saveNodes($userid, $status)
    {
        $nodes = $this->CI->datas->getNodes($userid);
        foreach($nodes as &$node) {
            if($status == null) {
                $node['status'] = 0;
            } else {
                if(in_array($node['id'], $status)) {
                    $node['status'] = 1;
                } else {
                    $node['status'] = 0;
                }
            }
            $this->checkNode($node);
        }
        return $this->CI->datas->updateNodes($nodes);
    }

    public function delNode($id)
    {
        $this->CI->datas->deleteSchedules($id);
        $this->CI->datas->deleteNode($id);
        return true;
    }

    public function checkNode($node)
    {
        $time = 16;
        if($node['status'] == 0) {
            $on = $this->CI->datas->getOnSchedule($node['id']);
            if($on != null && $on['start']<=$time && $time<=$on['end']) {
                $notification = array(
                    'userid'=>$node['userid'],
                    'type'=>1,
                    'title'=>'Turned off node',
                    'message'=>"Someone turn off {$node['name']} node that should be on in schedule.",
                    'url'=>'node');
                $this->pushNotification($notification);
            }
        } else {
            $off = $this->CI->datas->getOffSchedule($node['id']);
            if($off != null) {
                if($off != null && $off['start']<=$time && $time<=$off['end']) {
                    $notification = array(
                        'userid'=>$node['userid'],
                        'type'=>1,
                        'title'=>'Turned on node',
                        'message'=>"Someone turn on {$node['name']} node that should be on in schedule.",
                        'url'=>'node');
                    $this->pushNotification($notification);
                }
            }
        }
        return true;
    }

    public function getSchedule($id)
    {
        $schedule = $this->CI->datas->getSchedule($id);
        $schedule['start'] =  date('H:00', mktime($schedule['start']));
        $schedule['end'] =  date('H:00', mktime($schedule['end']));
        return $schedule;
    }

    public function getSchedules($nodeid)
    {
        $schedule = $this->CI->datas->getSchedules($nodeid);
        for($i=0;$i<count($schedule);$i++) {
            if($schedule[$i]['status'] == 1) {
                $schedule[$i]['status'] = "On";
            } else {
                $schedule[$i]['status'] = "Off";
            }
            $schedule[$i]['start'] = date('H:00', mktime($schedule[$i]['start']));
            $schedule[$i]['end'] = date('H:00', mktime($schedule[$i]['end']));
        }
        return $schedule;
    }

    public function getAllSchedules($userid)
    {
        $schedule = $this->CI->datas->getScheduleNodes($userid);
        for($i=0;$i<count($schedule);$i++) {
            $schedule[$i]['schedule'] = $this->getSchedules($schedule[$i]['nodeid']);
        }
        return $schedule;
    }

    public function saveSchedule($data)
    {
        if($data['id'] == "new") {
            unset($data['id']);
            return $this->CI->datas->insertSchedule($data);
        } else {
            return $this->CI->datas->updateSchedule($data);
        }
    }

    public function delSchedule($id)
    {
        return $this->CI->datas->deleteSchedule($id);
    }

    public function getVehicle($userid)
    {
        return $this->CI->datas->getVehicle($userid);
    }

    public function saveVehicle($data)
    {
        return $this->CI->datas->updateVehicle($data);
    }

    public function getBattery($userid)
    {
        return $this->CI->datas->getBattery($userid);
    }

    public function saveBattery($data)
    {
        return $this->CI->datas->updateBattery($data);
    }

    public function getSolar($userid)
    {
        return $this->CI->datas->getSolar($userid);
    }

    public function saveSolar($data)
    {
        return $this->CI->datas->updateSolar($data);
    }

    public function getNotifications($userid)
    {
        return $this->CI->datas->getNotifications($userid);
    }

    public function makeMasterNotifications($userid)
    {
        $notifications = $this->CI->datas->getPageNotifications($userid);
        $unread = false;

        foreach($notifications as $notif) {
            if($notif['unread'] == 1) {
                $unread = true;
            }
        }

        $final = "<a class='nav-link dropdown-toggle mr-lg-2' id='masterNotif' href='#' onclick='removeBadge(); return false;' data-toggle='dropdown'>";
        $final .= "<i class='fa fa-fw fa-bell'></i>";
        $final .= "<span class='d-lg-none'>Notification";
        if($unread) {
            $final .= "<span id='notifBadge1' class='badge badge-pill badge-warning'>!</span>";
        }
        $final .= "</span>";
        if($unread) {
            $final .= "<span id='notifBadge2' class='indicator text-warning d-none d-lg-block'>";
            $final .= "<i class='fa fa-fw fa-circle'></i>";
            $final .= "</span>";
        }
        $final .= "</a>";
        $final .= "<div class='dropdown-menu'>";
        $final .= "<h6 class='dropdown-header'>Notifications:</h6>";
        $final .= "<div class='dropdown-divider'></div>";
        foreach($notifications as $notif) {
            $final .= "<a class='dropdown-item' href='{$notif['url']}'>";
            if($notif['type'] == 1) {
                $final .= "<span class='text-danger'>";
            } else {
                $final .= "<span class='text-success'>";
            }
            $final .= "<strong>{$notif['title']}</strong></span>";
            $final .= "<div class='dropdown-message small'>{$notif['message']}</div>";
            $final .= "</a>";
            $final .= "<div class='dropdown-divider'></div>";
        }
        $final .= "<a class='dropdown-item small' href='notification/'>View all notification</a></div>";
        return $final;
    }

    public function pushNotification($notification)
    {
        return $this->CI->datas->makeNotification($notification);
    }

    public function readNotifications($userid)
    {
        return $this->CI->datas->readNotifications($userid);
    }

    public function unreadNotifications($userid)
    {
        return $this->CI->datas->unreadNotifications($userid);
    }
}