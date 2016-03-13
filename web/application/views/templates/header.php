<?php
/**
 * Created by PhpStorm.
 * User: kask
 * Date: 22.2.2016
 * Time: 18.04
 */

?>
<!DOCTYPE HTML>
<html>
<head>
    <title>Ravencrest Auction House Data</title>

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="content-type" content="text/html"; charset="utf-8">
    <meta name="keywords" content="ravencrest, auction house, ah, wow, world of warcraft, data, big data">

    <script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>

    <link href="<?php echo site_url(); ?>assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="<?php echo site_url(); ?>assets/css/font-awesome.css" rel="stylesheet" type="text/css">
    <link href="<?php echo site_url(); ?>assets/css/wowah.css" rel="stylesheet" type="text/css">


    <script type="text/javascript" src="<?php echo site_url(); ?>assets/js/jquery-2.2.0.min.js"></script>
    <script type="text/javascript" src="<?php echo site_url(); ?>assets/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="<?php echo site_url(); ?>assets/js/Chart.js"></script>
    <script type="text/javascript" src="//wow.zamimg.com/widgets/power.js"></script>
    <script>
        var wowhead_tooltips = {
            "colorlinks": true,
            "iconizelinks": true,
            "renamelinks": true
        }
    </script>



</head>
<body>

<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">WowAh</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav navbar-right">
                <li><a href="<?php echo site_url(); ?>">Front page</a></li>
                <li><a href="#">asdasd</a></li>
                <li><a href="#">Profile</a></li>
                <li><a href="#">Help</a></li>
            </ul>
            <form class="navbar-form navbar-right">
                <input type="text" class="form-control" placeholder="Search...">
            </form>
        </div>
    </div>
</nav>

<div class="container-fluid">
    <div class="row">
        <div class="col-sm-3 col-md-2 sidebar">
            <ul class="nav nav-sidebar">
                <li class="panel-heading">Garrison gather</li>
                <li><a href="<?php echo site_url(); ?>pricedata/herbalism">Herbalism</a></li>
                <li><a href="<?php echo site_url(); ?>pricedata/mining">Mining</a></li>
            </ul>
            <ul class="nav nav-sidebar">
                <li><a href="">Nav item</a></li>
                <li><a href="">Nav item again</a></li>
                <li><a href="">One more nav</a></li>
                <li><a href="">Another nav item</a></li>
                <li><a href="">More navigation</a></li>
            </ul>
            <ul class="nav nav-sidebar">
                <li><a href="">Nav item again</a></li>
                <li><a href="">One more nav</a></li>
                <li><a href="">Another nav item</a></li>
            </ul>
        </div>
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">

