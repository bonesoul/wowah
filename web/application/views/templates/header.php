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
    <link href="<?php echo site_url(); ?>assets/css/style.css" rel="stylesheet" type="text/css">
    <link href="<?php echo site_url(); ?>assets/css/font-awesome.css" rel="stylesheet" type="text/css">
    <link href="http://fonts.googleapis.com/css?family=Roboto:400,100,300,500,700,900" rel="stylesheet" type="text/css">
    <link href="<?php echo site_url(); ?>assets/css/custom.css" rel="stylesheet" type="text/css">

    <script src="<?php echo site_url(); ?>assets/js/jquery-2.2.0.min.js"></script>
    <script src="<?php echo site_url(); ?>assets/js/metisMenu.min.js"></script>
    <script src="<?php echo site_url(); ?>assets/js/custom.js"></script>
    <script src="<?php echo site_url(); ?>assets/js/bootstrap.min.js"></script>



</head>
<body>

<div id="wrapper">
    <nav class="top1 navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

            <a class="navbar-brand" href="#">WoWAh</a>
        </div>

        <ul class="nav navbar-nav navbar-right">
            <li class="dropdown">
                <a href="#" class="dropdown-togle" data-toggle="dropdown" aria-expanded="false">
                    <i class="fa fa-sign-in"></i>
                </a>
                <ul class="dropdown-menu">
                    <li class="dropdown-menu-header">
                        <strong>Login</strong>
                    </li>
                    <li class="dropdown-menu-footer text-center">
                        <a href="#">Login</a>
                    </li>
                </ul>
            </li>
        </ul>

        <form class="navbar-form navbar-right">
            <input type="text" class="form-control" value="Search..." onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Search...';}">
        </form>


        <div class="navbar-default sidebar" role="navigation">
            <div class="sidebar-nav navbar-collapse">

                <ul class="nav" id="side-menu">

                    <li>
                        <a href="#"><i class="fa fa-dashboard fa-fw nav_icon"></i>Front page</a>
                    </li>

                    <li>
                        <a href="#"><i class="fa fa-shield fa-fw nav_icon"></i>Items<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="#"><i class="fa fa-armor nav_icon"></i>Consumables<span class="fa arrow"></span></a>
                                <ul class="nav nav-third-level">
                                    <li id="not-implemented">
                                        <a href="#" id="not-implemented">Stuff</a>
                                    </li>
                                    <li>
                                        <a href="#" id="not-implemented">Stuff</a>
                                    </li>
                                    <li>
                                        <a href="#" id="not-implemented">Stuff</a>
                                    </li>
                                </ul>
                            </li>

                            <li>
                                <a href="#"><i class="fa fa-armor nav_icon"></i>Armor<span class="fa arrow"></span></a>
                                <ul class="nav nav-third-level">
                                    <li>
                                        <a href="#" id="not-implemented">Stuff</a>
                                    </li>
                                    <li>
                                        <a href="#" id="not-implemented">Stuff</a>
                                    </li>
                                    <li>
                                        <a href="#" id="not-implemented">Stuff</a>
                                    </li>
                                </ul>
                            </li>

                            <li>
                                <a href="#"><i class="fa fa-armor nav_icon"></i>Weapon<span class="fa arrow"></span></a>
                                <ul class="nav nav-third-level">
                                    <li>
                                        <a href="#" id="not-implemented">Stuff</a>
                                    </li>
                                    <li>
                                        <a href="#" id="not-implemented">Stuff</a>
                                    </li>
                                    <li>
                                        <a href="#" id="not-implemented">Stuff</a>
                                    </li>
                                </ul>
                            </li>



                        </ul>
                    </li>

                </ul>



            </div>
        </div>
    </nav>
    <div id="page-wrapper">
        <div class="row2">
            <div class="graphs">


                <div class="col_3">
                    <div class="col-md-2 widget widget1">
                        <div class="r3_counter_box">
                            <i class="pull-left fa fa-gavel icon-rounded"></i>
                            <div class="stats">
                                <h5>123456</h5>
                                <span>Auctions</span>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-2 widget widget1">
                        <div class="r3_counter_box">
                            <i class="pull-left fa fa-shield icon-rounded"></i>
                            <div class="stats">
                                <h5>12345</h5>
                                <span>Items</span>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-2 widget widget1">
                        <div class="r3_counter_box">
                            <i class="pull-left fa fa-question icon-rounded"></i>
                            <div class="stats">
                                <h5>1234</h5>
                                <span>Unknown items</span>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-2 widget widget1">
                        <div class="r3_counter_box">
                            <i class="pull-left fa fa-download icon-rounded"></i>
                            <div class="stats">
                                <h5>1234</h5>
                                <span>AH API Queries</span>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-2 widget widget1">
                        <div class="r3_counter_box">
                            <i class="pull-left fa fa-calendar icon-rounded"></i>
                            <div class="stats">
                                <h5>Today 13:37:00</h5>
                                <span>Last AH API Query</span>
                            </div>
                        </div>
                    </div>

                    <div class="clearfix"></div>
                    
                </div>
            </div>
        </div>
    </div>
</div>

</body>


</html>
