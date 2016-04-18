<?php
/**
 * Created by PhpStorm.
 * User: kask
 * Date: 18.4.2016
 * Time: 12.51
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

<div class="col-sm-2">
    <div class="panel panel-default">
        <div class="panel-heading">
            Auctions
        </div>
        <div class="panel-body">
            <?php echo $auctionCount; ?> auctions
        </div>
    </div>
</div>

<div class="col-sm-2">
    <div class="panel panel-default">
        <div class="panel-heading">
            Different items
        </div>
        <div class="panel-body">
            <?php echo $itemCount; ?> items
        </div>
    </div>
</div>

<div class="col-sm-3">
    <div class="panel panel-default">
        <div class="panel-heading">
            Unknown items
        </div>
        <div class="panel-body">
            <?php echo $unknownCount; ?> unknown items
        </div>
    </div>
</div>

<div class="col-sm-2">
    <div class="panel panel-default">
        <div class="panel-heading">
            Queries
        </div>
        <div class="panel-body">
            <?php echo $queryCount; ?> queries
        </div>
    </div>
</div>

<div class="col-sm-3">
    <div class="panel panel-default">
        <div class="panel-heading">
            Last query
        </div>
        <div class="panel-body">
            Last query: <?php echo $lastQuery; ?>
        </div>
    </div>
</div>
