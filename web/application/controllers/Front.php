<?php
/**
 * Created by PhpStorm.
 * User: kask
 * Date: 22.2.2016
 * Time: 18.01
 */

class Front extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->load->view('templates/header');
        $this->load->view('db_stats', $this->getDbStats());
        $this->load->view('templates/footer');
    }

    private function getDbStats()
    {
        $this->load->model('auctions');
        $this->load->model('items');
        $this->load->model('pulls');
        $this->load->model('unknown');

        $data = array(
            'auctionCount' => $this->auctions->getAuctionCount(),
            'itemCount' => $this->items->getItemCount(),
            'queryCount' => $this->pulls->getPullCount(),
            'lastQuery' => $this->pulls->getLatestUnixTime()->result()[0]->unixtime,
            'unknownCount' => $this->unknown->getUnknownCount()
        );

        return $data;
    }
}