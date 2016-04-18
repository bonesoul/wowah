<?php
/**
 * Created by PhpStorm.
 * User: kask
 * Date: 18.4.2016
 * Time: 13.21
 */

// Generate random string for canvas id
// We can't have multiple canvases with same IDs since JS will search correct canvas based on ID
$rnd = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 10);

?>

<div class row>
    <div class="col-lg-12">
        <h3 class="title">
            <?php echo $title; ?>
        </h3>

        <canvas id="<?php echo $rnd; ?>" height="300" width="550">
            Your browser doesn't support canvas.
        </canvas>
    </div>
</div>

<script>

    // We need to change basic integer to WoW currency: coppers, silvers and golds
    Chart.numberWithCommas = function(x) {
        var final = "";
        var old = x.toString();

        for(i = 0; 0 < x.length; i++)
        {
            if(i == 0)
                final = "c";

            if(i == 2)
                final = "s " + final;

            if(i == 4)
                final = "g " + final;

            final = old.substr(old.length - 1) + final;
            old = old.substring(0, old.length - 1);
        }

        return final;
    };

    // Get the canvas context
    var ctx = document.getElementById("<?php echo $rnd; ?>").getContext("2d");

    // Get and construct chart data
    var data = {
        labels: <?php echo $labels; ?>,
        datasets: [
            {
                label: "<?php echo $title; ?>",
                fillColor: "rgba(220,220,220,0.2)",
                strokeColor: "rgba(220,220,220,1)",
                pointColor: "rgba(220,220,220,1)",
                pointStrokeColor: "#fff",
                pointHighlightFill: "#fff",
                pointHighlightStroke: "rgba(220,220,220,1)",
                highlightFill: "rgba(88,196,246,0.75)",
                highlightStroke: "rgba(88,196,246,1)",
                data: <?php echo $data; ?>,
                scaleLabel: "<%=Chart.numberWithCommas(value)%>"

            }
        ]
    };

    // Chart options
    var options = {
        responsive: true,
        showTooltips: false,
        animation: true,
        maintainAspectRatio: false,
        scaleLabel: "<%=Chart.numberWithCommas(value)%>"
    };

    // Render chart
    var myLineChart = new Chart(ctx).Line(data, options);

</script>