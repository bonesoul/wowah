<?php
/**
 * Created by PhpStorm.
 * User: kask
 * Date: 18.4.2016
 * Time: 13.05
 */

class Pulls extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getPullCount()
    {
        // Load correct database module
        $ahDataDb = $this->load->database('ah_data', TRUE);

        // Construct db query
        $ahDataDb->like('id');
        $ahDataDb->from('pulls');

        // Return count of results
        return $ahDataDb->count_all_results();
    }

    // Get latest unix time (highest integer)
    public function getLatestUnixTime()
    {
        // Load correct database module
        $ahDataDb = $this->load->database('ah_data', TRUE);

        $ahDataDb->select_max('unixtime');

        return $ahDataDb->get('pulls');
    }
}