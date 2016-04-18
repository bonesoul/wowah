<?php
/**
 * Created by PhpStorm.
 * User: kask
 * Date: 18.4.2016
 * Time: 13.28
 */

class Pricedata extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->model('chartdata');
        $this->load->model('items');
    }

    public function index()
    {
        echo 'Hep';
    }

    public function herbalism()
    {
        // Set all WoD flower IDs to an array
        $flowers = array(
            '109129', // Talador Orchid
            '109128', // Nagrand Arrowbloom
            '109127', // Starflower
            '109126', // Gorgrond Flytrap
            '109125', // Fireweed
            '109124'  // Frostweed
        );

        $this->load->view('templates/header');
        $this->getItems($flowers);
        $this->load->view('templates/footer');

    }

    private function getItems($itemIds)
    {
        $currentTime = date("Y-m-d H:i:s", time());

        foreach($itemIds as $itemId)
        {
            $values = $this->chartdata->getDailyAvarage($currentTime, $itemId);

            $data = array(
                'title' => "Lowest daily price of " . $this->items->getItemName($itemId)[0]->name,
                'labels' => json_encode($values['labels']),
                'data' => json_encode($values['values'])
            );

            $this->load->view('charts/line', $data);
        }
    }
}