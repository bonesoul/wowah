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
    }
}