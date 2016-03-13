<?php
/**
 * Created by PhpStorm.
 * User: kask
 * Date: 23.2.2016
 * Time: 1.17
 */

// Get all necessary information needed. If they are not set, give value of zero/unknown
if(!isset($auctionCount))
    $auctionCount = 0;

if(!isset($itemCount))
    $itemCount = 0;

if(!isset($unknownCount))
    $unknownCount = 0;

if(!isset($queryCount))
    $queryCount = 0;

if(!isset($lastQuery))
    $lastQuery = 'Unknown';
else
    $lastQuery = gmdate('d.m.y H:i:s T', $lastQuery);

?>
<!-- frontpage.php filu alkaa tästä -->
<div class="row2">
    <div class="graphs">


        <div class="col_3">
            <div class="col-md-2 widget widget1">
                <div class="r3_counter_box">
                    <i class="pull-left fa fa-gavel icon-rounded"></i>
                    <div class="stats">
                        <h5><?php echo $auctionCount; ?></h5>
                        <span>Auctions</span>
                    </div>
                </div>
            </div>

            <div class="col-md-2 widget widget1">
                <div class="r3_counter_box">
                    <i class="pull-left fa fa-shield icon-rounded"></i>
                    <div class="stats">
                        <h5><?php echo $itemCount; ?></h5>
                        <span>Items</span>
                    </div>
                </div>
            </div>

            <div class="col-md-2 widget widget1">
                <div class="r3_counter_box">
                    <i class="pull-left fa fa-question icon-rounded"></i>
                    <div class="stats">
                        <h5><?php echo $unknownCount; ?></h5>
                        <span>Unknown items</span>
                    </div>
                </div>
            </div>

            <div class="col-md-2 widget widget1">
                <div class="r3_counter_box">
                    <i class="pull-left fa fa-download icon-rounded"></i>
                    <div class="stats">
                        <h5><?php echo $queryCount; ?></h5>
                        <span>AH API Queries</span>
                    </div>
                </div>
            </div>

            <div class="col-md-3 widget widget1">
                <div class="r3_counter_box">
                    <i class="pull-left fa fa-calendar icon-rounded"></i>
                    <div class="stats">
                        <h5><?php echo $lastQuery; ?></h5>
                        <span>Last AH API Query</span>
                    </div>
                </div>
            </div>

            <div class="clearfix"></div>

        </div>
    </div>
</div>
<!-- frontpage.php filu loppuu tähän -->
