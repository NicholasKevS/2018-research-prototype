<div class="row mb-3">
    <div class="col-12">
        <h1>Admin</h1>
    </div>
    <form action="admin/" method="post">
        <div class="col-12 mb-3">
            Date:
            <input type="text" name="date" id="date" onkeydown="return false" value="<?php echo $date; ?>">
            Suburb:
            <select id="locationid" name="locationid">
                <?php
                foreach($suburb as $val) {
                    echo "<option value='{$val['id']}'".($val['id']==$locationid?" selected":"").">{$val['name']}</option>";
                }
                ?>
            </select>
        </div>
        <div class="col-12 mb-3">
            From:
            <input type="text" name="time1" id="time1" onkeydown="return false" value="<?php echo $time1; ?>">
            To:
            <input type="text" name="time2" id="time2" onkeydown="return false" value="<?php echo $time2; ?>">
            <button type="submit" class="btn btn-primary">Go</button>
        </div>
    </form>
    <div class="col-12">
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link active" data-toggle="tab" href="#usageproduction">Usage & Production Chart</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#buydischarge">Buy & Discharge Chart</a>
            </li>
        </ul>
    </div>
</div>
<div class="tab-content" id="adminContent">
    <div class="tab-pane fade show active" id="usageproduction">
        <div class="row">
            <div class="col-12">
                <h2>Average Usage & Production Chart</h2>
            </div>
        </div>
        <div class="card mb-3">
            <div class="card-header">
                <i class="fa fa-area-chart"></i> Usage & Production</div>
            <div class="card-body">
                <canvas id="usageproductionChart" width="100%" height="30"></canvas>
            </div>
        </div>
    </div>
    <div class="tab-pane fade" id="buydischarge">
        <div class="row">
            <div class="col-12">
                <h2>Average Buy & Discharge Chart</h2>
            </div>
        </div>
        <div class="card mb-3">
            <div class="card-header">
                <i class="fa fa-area-chart"></i> Buy & Discharge</div>
            <div class="card-body">
                <canvas id="buydischargeChart" width="100%" height="30"></canvas>
            </div>
        </div>
    </div>
</div>
<script>
    // chart variable
    var timeAxis = <?php echo json_encode($timeAxis); ?>;
    var dateAxis = <?php echo json_encode($dateAxis); ?>;
    var usage = <?php echo json_encode($usage); ?>;
    var production = <?php echo json_encode($production); ?>;
    var sum = <?php echo json_encode($sum); ?>;

    // -- Area Chart Example
    var ctx = document.getElementById("usageproductionChart");
    var myLineChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: timeAxis,
            datasets: [{
                label: "Usage",
                yAxisID:"left",
                lineTension: 0.3,
                borderColor: "rgba(198,0,29,1)",
                pointRadius: 5,
                pointBackgroundColor: "rgba(198,0,29,1)",
                pointBorderColor: "rgba(255,255,255,0.8)",
                pointHoverRadius: 5,
                pointHitRadius: 20,
                pointBorderWidth: 2,
                data: usage
            },{
                label: "Production",
                yAxisID:"left",
                lineTension: 0.3,
                borderColor: "rgba(2,117,216,1)",
                pointRadius: 5,
                pointBackgroundColor: "rgba(2,117,216,1)",
                pointBorderColor: "rgba(255,255,255,0.8)",
                pointHoverRadius: 5,
                pointHitRadius: 20,
                pointBorderWidth: 2,
                data: production
            }],
        },
        options: {
            scales: {
                xAxes: [{
                    scaleLabel: {
                        display: true,
                        labelString: "Date"
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
                        min: -1,
                        max: 4,
                        maxTicksLimit: 6
                    },
                    scaleLabel: {
                        display: true,
                        labelString: "Kilowatt hour"
                    },
                    gridLines: {
                        color: "rgba(0, 0, 0, .125)",
                    }
                }],
            },
            legend: {
                display: true
            }
        }
    });

    var ctx = document.getElementById("buydischargeChart");
    var myLineChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: dateAxis,
            datasets: [{
                label: "Buy/Discharge",
                yAxisID:"left",
                lineTension: 0.3,
                borderColor: "rgba(2,117,216,1)",
                pointRadius: 5,
                pointBackgroundColor: "rgba(2,117,216,1)",
                pointBorderColor: "rgba(255,255,255,0.8)",
                pointHoverRadius: 5,
                pointHitRadius: 20,
                pointBorderWidth: 2,
                data: sum
            }],
        },
        options: {
            scales: {
                xAxes: [{
                    scaleLabel: {
                        display: true,
                        labelString: "Date"
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
                        min: -2,
                        max: 6,
                        maxTicksLimit: 6
                    },
                    scaleLabel: {
                        display: true,
                        labelString: "Buy / Discharge (kW)"
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
