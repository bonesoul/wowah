<?php
/**
 * Created by PhpStorm.
 * User: kask
 * Date: 18.4.2016
 * Time: 13.31
 */

class Chartdata extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getDailyAvarage($date, $itemId)
    {
        // Construct dates to correct format
        $startDate = strtotime($date);
        $date = date('Y-m-d', $startDate);

        // Create empty arrays so we can push to them
        $labels = array();
        $values = array();

        // Loop for each hour
        for($i = 0; $i < 24; $i++)
        {
            $timestamp = "$date $i:00:00";

            array_push($labels, $i);
            array_push($values, ($this->getHourLowest($timestamp, $itemId) == null) ? 0 : $this->getHourLowest($timestamp, $itemId));
        }

        // Return data in correct format
        return array(
            'labels' => $labels,
            'values' => $values
        );
    }

    public function getHourLowest($startDate, $itemId)
    {
        $ahData = $this->load->database('ah_data', TRUE);

        $startDate = strtotime($startDate);
        $date = date('Y-m-d', $startDate);
        $hour = date('H', $startDate);

        $startDate = strtotime("$date $hour:00:00");
        $endDate = strtotime('1 hour', $startDate);
        $startDate = date("Y-m-d H:i:s", $startDate);
        $endDate = date("Y-m-d H:i:s", $endDate);

        $ahData->select('*');
        $ahData->from('auctions');
        $ahData->where('itemId', $itemId);
        $ahData->where('time >=', $startDate);
        $ahData->where('time <=', $endDate);

        $q = $ahData->get();

        $count = 0;
        $total = 0;
        $lowest = 99999999999;

        foreach($q->result() as $row)
        {
            if($row->buyout == '0')
                continue;

            if(intval($row->buyout) / intval($row->quantity) < $lowest)
                $lowest = intval($row->buyout) / intval($row->quantity);

        }


        return ($lowest == 99999999999) ? 0 : $lowest;
    }
}