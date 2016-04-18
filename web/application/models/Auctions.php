<?php
/**
 * Created by PhpStorm.
 * User: kask
 * Date: 18.4.2016
 * Time: 13.02
 */

class Auctions extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getAuctionCount()
    {
        // Load correct database module
        $ahDataDb = $this->load->database('ah_data', TRUE);

        // Construct db query
        $ahDataDb->like('auctionId');
        $ahDataDb->from('auctions');

        // Return count of results
        return $ahDataDb->count_all_results();
    }
}