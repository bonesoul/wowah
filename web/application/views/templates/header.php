<?php
/**
 * Created by PhpStorm.
 * User: kask
 * Date: 18.4.2016
 * Time: 12.36
 */
?>
<!DOCTYPE HTML>
<html>
<head>
    <title>Ravencrest Auction House Data</title>

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="content-type" content="text/html"; charset="utf-8">
    <meta name="keywords" content="ravencrest, auction house, ah, wow, world of warcraft">

    <script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>

    <link href="<?php echo site_url(); ?>assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="<?php echo site_url(); ?>assets/css/font-awesome.css" rel="stylesheet" type="text/css">
    <link href="<?php echo site_url(); ?>assets/css/wowah.css" rel="stylesheet" type="text/css">


    <script type="text/javascript" src="<?php echo site_url(); ?>assets/js/jquery-2.2.0.min.js"></script>
    <script type="text/javascript" src="<?php echo site_url(); ?>assets/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="<?php echo site_url(); ?>assets/js/chart.js"></script>
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

<div class="container">


    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">Ravencrest</a>
            </div>
            <div id="navbar" class="navbar-collapse collapse">
                <ul class="nav navbar-nav">
                    <li><a href="#">Front</a></li>
                    <li><a href="#">Placeholder</a></li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Herbalism <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="#">Daily price</a></li>
                        </ul>
                    </li>
                </ul>
                <form class="nav navbar-nav navbar-right navbar-form" action="<?php echo site_url(); ?>search" method="post">
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Search..">
                    </div>
                </form>
            </div>
        </div>
    </nav>

