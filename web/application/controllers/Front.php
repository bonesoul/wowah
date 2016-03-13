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

        $this->load->view('templates/header');
        $this->load->view('front', $data);
        $this->load->view('templates/footer');
    }

    public function test()
    {

        $this->load->model('items');

        $itemId = '109118';

        $this->load->model('chartdata');
        $this->load->model('items');


        $currentTime = date("Y-m-d H:i:s", time());
        $yesterday = strtotime('-1 days', time());
        $yesterday = date("Y-m-d H:i:s", $yesterday);




        $values = $this->chartdata->getDailyAvarage($currentTime, $itemId);
        $values2 = $this->chartdata->getDailyAvarage($yesterday, $itemId);

        $data = array(
            'title' => "Lowest daily price of " . $this->items->getItemName($itemId)[0]->name,
            'labels' => json_encode($values['labels']),
            'data' => json_encode($values['values'])
        );

        $data2 = array(
            'title' => "Lowest yesterdays price of " . $this->items->getItemName($itemId)[0]->name,
            'labels' => json_encode($values2['labels']),
            'data' => json_encode($values2['values'])
        );

        $this->load->view('templates/header');
        $this->load->view('charts/line', $data);
        $this->load->view('charts/line', $data2);
        $this->load->view('templates/footer');

    }

}