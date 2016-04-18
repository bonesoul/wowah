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
                <a class="navbar-brand" href="<?php echo site_url(); ?>">Ravencrest</a>
            </div>

            <div id="navbar" class="navbar-collapse collapse">
                <ul class="nav navbar-nav">
                    <li><a href="<?php echo site_url(); ?>">Front</a></li>

                    <li><a href="#">Placeholder</a></li>

                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Professions<span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li class="dropdown-header">Daily prices</li>
                            <li><a href="<?php echo site_url(); ?>pricedata/herbalism">Herbalism</a></li>
                            <li><a href="<?php echo site_url(); ?>pricedata/mining">Mining</a></li>
                            <li><a href="<?php echo site_url(); ?>pricedata/gems">Jewelcrafting</a></li>
                            <li><a href="<?php echo site_url(); ?>pricedata/glyphs">Inscription</a></li>

                        </ul>
                    </li>

                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Trade goods<span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li class="dropdown-header">Daily prices</li>
                            <li><a href="<?php echo site_url(); ?>pricedata/archaeologyfragments">Archaeology Fragments</a></li>
                            <li><a href="<?php echo site_url(); ?>pricedata/boeepics">BoE Epics</a></li>
                            <li><a href="<?php echo site_url(); ?>pricedata/boerares">BoE Rares</a></li>
                            <li><a href="<?php echo site_url(); ?>pricedata/consumablesenhancements">Consumables and Enhancements</a></li>
                            <li><a href="<?php echo site_url(); ?>pricedata/containers">Containers</a></li>
                            <li><a href="<?php echo site_url(); ?>pricedata/crafteditems">Crafted Items</a></li>
                            <li><a href="<?php echo site_url(); ?>pricedata/darkmooncards">Darkmoon Cards</a></li>
                            <li><a href="<?php echo site_url(); ?>pricedata/darkmoonquest">Darkmoon Faire Quest Items</a></li>
                            <li><a href="<?php echo site_url(); ?>pricedata/questitems">Quest Items</a></li>
                            <li><a href="<?php echo site_url(); ?>pricedata/miscarmortmogcloth">Misc, Armor & TMog: Cloth</a></li>
                            <li><a href="<?php echo site_url(); ?>pricedata/miscarmortmogjwlshirtsetc">Misc, Armor & TMog: Jewelry, Shirts, OH, etc</a></li>
                            <li><a href="<?php echo site_url(); ?>pricedata/miscarmortmogleather">Misc, Armor & TMog: Leather</a></li>
                            <li><a href="<?php echo site_url(); ?>pricedata/miscarmortmogmail">Misc, Armor & TMog: Mail</a></li>
                            <li><a href="<?php echo site_url(); ?>pricedata/miscarmortmogplate">Misc, Armor & TMog: Plate</a></li>
                            <li><a href="<?php echo site_url(); ?>pricedata/miscarmortmogshields">Misc, Armor & TMog: Shields</a></li>
                            <li><a href="<?php echo site_url(); ?>pricedata/miscarmortmogweapons">Misc, Armor & TMog: Weapons</a></li>
                            <li><a href="<?php echo site_url(); ?>pricedata/droppedmountspets">Mounts & Pets: Dropped</a></li>
                            <li><a href="<?php echo site_url(); ?>pricedata/craftedmountspets">Mounts & Pets: Crafted</a></li>
                            <li><a href="<?php echo site_url(); ?>pricedata/recipes">Recipes</a></li>
                            <li><a href="<?php echo site_url(); ?>pricedata/toys">Toys, Non-Crafted</a></li>
                            <li><a href="<?php echo site_url(); ?>pricedata/othertradegoods">Other Trade Goods</a></li>

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

