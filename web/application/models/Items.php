<?php
/**
 * Created by PhpStorm.
 * User: kask
 * Date: 18.4.2016
 * Time: 13.07
 */

class Items extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getItemCount()
    {
        // Load correct database module
        $ahDataDb = $this->load->database('ah_data', TRUE);

        // Construct db query
        $ahDataDb->like('itemId');
        $ahDataDb->from('items');

        // Return count of results
        return $ahDataDb->count_all_results();
    }
}