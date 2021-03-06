<div class="row mb-3">
    <div class="col-12">
        <h1>Research Page</h1>
    </div>
    <form action="research/" method="post">
        <div class="col-12 mb-3">
            Date:
            <input type="text" name="date" id="date" onkeydown="return false" value="<?php echo $date; ?>">
        </div>
        <div class="col-12 mb-3">
            From:
            <input type="text" name="time1" id="time1" onkeydown="return false" value="<?php echo $time1; ?>">
            To:
            <input type="text" name="time2" id="time2" onkeydown="return false" value="<?php echo $time2; ?>">
            <button type="submit" class="btn btn-primary">Go</button>
        </div>
    </form>
    <form action="research/populate/" method="post">
        <div class="col-12 mb-3">
            Capacity:
            <input type="number" name="capacity" id="capacity" min="0" value="<?php echo $capacity; ?>"> kW
            <button type="submit" class="btn btn-primary">Repopulate data</button>
        </div>
    </form>
</div>
<div class="col-12">
    <div class="card mb-3">
        <div class="card-header">
            <i class="fa fa-area-chart"></i> Battery Level</div>
        <div class="card-body">
            <canvas id="levelChart" width="100%" height="30"></canvas>
        </div>
    </div>
</div>
<script>
    // chart variable
    var timeAxis = <?php echo json_encode($timeAxis); ?>;
    var level = <?php echo json_encode($level); ?>;

    // battery level chart
    var ctx = document.getElementById("levelChart");
    var myLineChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: timeAxis,
            datasets: [{
                label: "Battery Level",
                yAxisID:"left",
                lineTension: 0.3,
                borderColor: "rgba(198,0,29,1)",
                pointRadius: 5,
                pointBackgroundColor: "rgba(198,0,29,1)",
                pointBorderColor: "rgba(255,255,255,0.8)",
                pointHoverRadius: 5,
                pointHitRadius: 20,
                pointBorderWidth: 2,
                data: level
            }],
        },
        options: {
            scales: {
                xAxes: [{
                    scaleLabel: {
                        display: true,
                        labelString: "Time"
                    },
                    gridLines: {
                        display: false
                    },
                    ticks: {
                        maxTicksLimit: 7
                    }
                }],
                yAxes: [{
                    id: "left",
                    ticks: {
                        min: 0,
                        max: 100,
                        maxTicksLimit: 6
                    },
                    scaleLabel: {
                        display: true,
                        labelString: "%"
                    },
                    gridLines: {
                        color: "rgba(0, 0, 0, .125)",
                    }
                }],
            },
            legend: {
                display: false
            }
        }
    });

    $("#date").datepicker({
        dateFormat: 'd M yy',
        firstDay: 1
    });

    $("#time1").timepicker({
        timeFormat: 'HH:mm',
        interval: 60,
        minTime: '0',
        maxTime: '22',
        dynamic: false,
        scrollbar: true,
        change: function(time) {
            var timepicker = $(this).timepicker();
            var minTime = (new Date(time).getHours()+1).toString();
            var newTime = timepicker.format(new Date(0,0,0,minTime));

            $("#time2").timepicker('option', 'minTime', minTime);

            if($("#time2").val() < newTime) {
                $("#time2").val(newTime);
            }
        }
    });

    $("#time2").timepicker({
        timeFormat: 'HH:mm',
        interval: 60,
        minTime: (new Date(0,0,0,parseInt(<?php echo "'$time1'"; ?>)).getHours()+1).toString(),
        maxTime: '23',
        dynamic: false,
        scrollbar: true
    });
</script>