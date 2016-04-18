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

    // Returns item name based on its ID
    public function getItemName($itemId)
    {
        // Load correct database module
        $ahDataDb = $this->load->database('ah_data', TRUE);

        // Construct db query
        $ahDataDb->select('name');
        $ahDataDb->from('items');
        $ahDataDb->where('itemId', $itemId);

        // Return item name
        $q = $ahDataDb->get();
        return $q->result();
    }
}