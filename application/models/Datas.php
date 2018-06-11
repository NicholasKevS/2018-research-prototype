<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Datas extends CI_Model {

    public function getUsage($id, $date, $hour)
    {
        return $this->db->select('amount')
            ->get_where('node_usages', array('nodeid'=>$id, 'date'=>$date, 'time'=>$hour))
            ->row_array()['amount'];
    }

    public function getUsageTotalByDate($userid, $date)
    {
        return $this->db->select_sum('amount')->from('node_usages')
        ->join('nodes', 'node_usages.nodeid = nodes.id')->join('users', 'nodes.userid = users.id')
        ->where('users.id', $userid)->where('date', $date)
        ->get()->row_array()['amount'];
    }

    public function getUsageAvgByDate($userid, $date)
    {
        return $this->db->select_avg('amount')->from('node_usages')
            ->join('nodes', 'node_usages.nodeid = nodes.id')->join('users', 'nodes.userid = users.id')
            ->where('users.id', $userid)->where('date', $date)
            ->get()->row_array()['amount'];
    }

    public function getUsageTotalByHour($userid, $date, $hour)
    {
        return $this->db->select_sum('amount')->from('node_usages')
            ->join('nodes', 'node_usages.nodeid = nodes.id')->join('users', 'nodes.userid = users.id')
            ->where('users.id', $userid)->where('date', $date)->where('time', $hour)
            ->get()->row_array()['amount'];
    }

    public function getUsageForecastToday($userid)
    {
        return $this->db->select('amount')->from('forecast_today')
            ->where('userid', $userid)->where('status', 1)->get()->result_array();
    }

    public function getUsageForecastTomorrow($userid)
    {
        return $this->db->select('amount')->from('forecast_tomorrow')
            ->where('userid', $userid)->where('status', 1)->get()->result_array();
    }

    public function getUsageAvgByHour($location, $date, $hour)
    {
        return $this->db->select('sum(amount)/count(distinct users.id) as avg')->from('node_usages')
            ->join('nodes', 'node_usages.nodeid = nodes.id')->join('users', 'nodes.userid = users.id')
            ->where('users.locationid', $location)->where('date', $date)->where('time', $hour)
            ->get()->row_array()['avg'];
    }

    public function getProduction($userid, $date, $hour)
    {
        return $this->db->from('solar_productions')
            ->join('solars', 'solar_productions.solarid = solars.id')->join('users', 'solars.userid = users.id')
            ->where('users.id', $userid)->where('date', $date)->where('time', $hour)
            ->get()->row_array();
    }

    public function getProductionTotalByDate($userid, $date)
    {
        return $this->db->select_sum('amount')->from('solar_productions')
            ->join('solars', 'solar_productions.solarid = solars.id')->join('users', 'solars.userid = users.id')
            ->where('users.id', $userid)->where('date', $date)
            ->get()->row_array()['amount'];
    }

    public function getProductionAvgByDate($userid, $date)
    {
        return $this->db->select_avg('amount')->from('solar_productions')
            ->join('solars', 'solar_productions.solarid = solars.id')->join('users', 'solars.userid = users.id')
            ->where('users.id', $userid)->where('date', $date)
            ->get()->row_array()['amount'];
    }

    public function getProductionTotalByHour($userid, $date, $hour)
    {
        return $this->db->select('amount')->from('solar_productions')
            ->join('solars', 'solar_productions.solarid = solars.id')->join('users', 'solars.userid = users.id')
            ->where('users.id', $userid)->where('date', $date)->where('time', $hour)
            ->get()->row_array()['amount'];
    }

    public function getProductionForecastToday($userid)
    {
        return $this->db->select('amount')->from('forecast_today')
            ->where('userid', $userid)->where('status', 2)->get()->result_array();
    }

    public function getProductionForecastTomorrow($userid)
    {
        return $this->db->select('amount')->from('forecast_tomorrow')
            ->where('userid', $userid)->where('status', 2)->get()->result_array();
    }

    public function getProductionAvgByHour($location, $date, $hour)
    {
        return $this->db->select_avg('amount')->from('solar_productions')
            ->join('solars', 'solar_productions.solarid = solars.id')->join('users', 'solars.userid = users.id')
            ->where('users.locationid', $location)->where('date', $date)->where('time', $hour)
            ->get()->row_array()['amount'];
    }

    public function getBatteryActByHour($userid, $date, $hour)
    {
        return $this->db->from('battery_acts')
            ->join('batteries', 'battery_acts.batteryid = batteries.id')->join('users', 'batteries.userid = users.id')
            ->where('users.id', $userid)->where('date', $date)->where('time', $hour)
            ->get()->row_array();
    }

    public function getBatterySum($userid, $date)
    {
        return $this->db->from('battery_sums')
            ->join('batteries', 'battery_sums.batteryid = batteries.id')
            ->join('users', 'batteries.userid = users.id')
            ->where('users.id', $userid)->where('date', $date)
            ->get()->row_array();
    }

    public function getAvgBatterySum($location, $date)
    {
        return $this->db->select_avg('status')->select_avg('amount')->from('battery_sums')
            ->join('batteries', 'battery_sums.batteryid = batteries.id')
            ->join('users', 'batteries.userid = users.id')
            ->where('users.locationid', $location)->where('date', $date)
            ->get()->row_array();
    }

    public function getVehicleBatByHour($userid, $date, $hour)
    {
        return $this->db->select('amount')->from('vehicle_bats')
            ->join('vehicles', 'vehicle_bats.vehicleid = vehicles.id')->join('users', 'vehicles.userid = users.id')
            ->where('users.id', $userid)->where('date', $date)->where('time', $hour)
            ->get()->row_array()['amount'];
    }

    public function getNode($id)
    {
        return $this->db->get_where('nodes', array('id'=>$id))->row_array();
    }

    public function getNodes($userid)
    {
        return $this->db->get_where('nodes', array('userid'=>$userid))->result_array();
    }

    public function insertNode($node)
    {
        return $this->db->insert('nodes', $node);
    }

    public function updateNode($node)
    {
        return $this->db->where('id', $node['id'])->update('nodes', $node);
    }

    public function updateNodes($nodes)
    {
        return $this->db->update_batch('nodes', $nodes, 'id');
    }

    public function deleteNode($id)
    {
        return $this->db->delete('nodes', array('id'=>$id));
    }

    public function getSchedule($id)
    {
        return $this->db->get_where('node_schedules', array('id'=>$id))->row_array();
    }

    public function getSchedules($nodeid)
    {
        return $this->db->get_where('node_schedules', array('nodeid'=>$nodeid))->result_array();
    }

    public function getScheduleNodes($userid)
    {
        return $this->db->distinct()->select('node_schedules.nodeid, nodes.*')->from('node_schedules')
            ->join('nodes', 'node_schedules.nodeid = nodes.id')->join('users', 'nodes.userid = users.id')
            ->where('users.id', $userid)->get()->result_array();
    }

    public function getOffSchedule($nodeid)
    {
        return $this->db->distinct()->get_where('node_schedules', array('nodeid'=>$nodeid, 'status'=>0))->row_array();
    }

    public function getOnSchedule($nodeid)
    {
        return $this->db->distinct()->get_where('node_schedules', array('nodeid'=>$nodeid, 'status'=>1))->row_array();
    }

    public function insertSchedule($schedule)
    {
        return $this->db->insert('node_schedules', $schedule);
    }

    public function updateSchedule($schedule)
    {
        return $this->db->where('id', $schedule['id'])->update('node_schedules', $schedule);
    }

    public function deleteSchedule($id)
    {
        return $this->db->delete('node_schedules', array('id'=>$id));
    }

    public function deleteSchedules($nodeid)
    {
        return $this->db->delete('node_schedules', array('nodeid'=>$nodeid));
    }

    public function getVehicle($userid)
    {
        return $this->db->get_where('vehicles', array('userid'=>$userid))->row_array();
    }

    public function updateVehicle($vehicle)
    {
        return $this->db->where('id', $vehicle['id'])->update('vehicles', $vehicle);
    }

    public function getBattery($userid)
    {
        return $this->db->get_where('batteries', array('userid'=>$userid))->row_array();
    }

    public function updateBattery($battery)
    {
        return $this->db->where('id', $battery['id'])->update('batteries', $battery);
    }

    public function getSolar($userid)
    {
        return $this->db->get_where('solars', array('userid'=>$userid))->row_array();
    }

    public function updateSolar($solar)
    {
        return $this->db->where('id', $solar['id'])->update('solars', $solar);
    }

    public function getLocation($userid)
    {
        return $this->db->select('locations.*')->from('locations')->join('users', 'locations.id = users.locationid')
            ->where('users.id', $userid)->get()->row_array();
    }

    public function getWeather($userid, $date)
    {
        return $this->db->select('location_weathers.*')->from('location_weathers')
            ->join('locations', 'location_weathers.locationid = locations.id')
            ->join('users', 'locations.id = users.locationid')
            ->where('users.id', $userid)->where('location_weathers.date', $date)->get()->row_array()['weather'];
    }

    public function getProvider($userid)
    {
        return $this->db->select('providers.*')->from('providers')->join('users', 'providers.id = users.providerid')
            ->where('users.id', $userid)->get()->row_array();
    }

    public function getNotifications($userid)
    {
        return $this->db->order_by('id', 'DESC')->get_where('notifications', array('userid'=>$userid))->result_array();
    }

    public function getPageNotifications($userid)
    {
        return $this->db->order_by('id', 'DESC')->get_where('notifications', array('userid'=>$userid), 3)->result_array();
    }

    public function makeNotification($notification)
    {
        return $this->db->insert('notifications', $notification);
    }

    public function readNotifications($userid)
    {
        return $this->db->where('userid', $userid)->update('notifications', array('unread'=>0));
    }

    public function unreadNotifications($userid)
    {
        return $this->db->where('userid', $userid)->update('notifications', array('unread'=>1));
    }
}