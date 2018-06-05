<div class="row mb-3">
    <div class="col-12">
        <h1>Dashboard</h1>
    </div>
    <form action="dashboard/" method="post">
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
    <div class="col-12">
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link active" data-toggle="tab" href="#usageproduction">Usage & Production Chart</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#prediction">Prediction Chart</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#price">Price Rates</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#report">See Report</a>
            </li>
        </ul>
    </div>
</div>
<div class="tab-content" id="dashboardContent">
    <div class="tab-pane fade show active" id="usageproduction">
        <div class="row">
            <div class="col-12">
                <h2>Usage & Production Chart</h2>
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
    <div class="tab-pane fade" id="prediction">
        <div class="row">
            <div class="col-12">
                <h2>Production & Usage Today Estimate</h2>
            </div>
        </div>
        <div class="card mb-3">
            <div class="card-header">
                <i class="fa fa-area-chart"></i> Production & Usage Today Estimate</div>
            <div class="card-body">
                <canvas id="estimationChart" width="100%" height="30"></canvas>
            </div>
        </div>
    </div>
    <div class="tab-pane fade" id="price">
        <div class="row">
            <div class="col-12">
                <h2>Current Electricity Rate</h2>
            </div>
        </div>
        <div class="card mb-3">
            <div class="card-header">
                <i class="fa fa-area-chart"></i> Current Electricity Price</div>
            <div class="card-body">
                <canvas id="priceChart" width="100%" height="30"></canvas>
            </div>
        </div>
    </div>
    <div class="tab-pane fade" id="report">
        <div class="row">
            <div class="col-12">
                <h2>Get Report</h2>
                <form action="" method="post">
                    <div class="col-12 mb-3">
                        Date:
                        <input type="text" name="datereport" id="datereport" value="">
                        <button type="submit" class="btn btn-primary">Go</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    // chart variable
    var timeAxis = <?php echo json_encode($timeAxis); ?>;
    var usage = <?php echo json_encode($usage); ?>;
    var production = <?php echo json_encode($production); ?>;
    var price = <?php echo json_encode($price); ?>;

    // usage & production chart
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
            },{
                label: "Price",
                yAxisID:"right",
                lineTension: 0.3,
                borderColor: "rgba(67,182,47,1)",
                pointRadius: 5,
                pointBackgroundColor: "rgba(67,182,47,1)",
                pointBorderColor: "rgba(255,255,255,0.8)",
                pointHoverRadius: 5,
                pointHitRadius: 20,
                pointBorderWidth: 2,
                data: price
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
                },{
                    id: "right",
                    position: 'right',
                    ticks: {
                        min: 10,
                        max: 60,
                        maxTicksLimit: 6
                    },
                    scaleLabel: {
                        display: true,
                        labelString: "Cents per kWh"
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

    // estimation chart
    var ctx = document.getElementById("estimationChart");
    var myLineChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: ["00:00", "01:00", "02:00", "03:00", "04:00", "05:00", "06:00", "07:00", "08:00", "09:00", "10:00", "11:00", "12:00", "13:00", "14:00", "15:00", "16:00", "17:00", "18:00", "19:00", "20:00", "21:00", "22:00", "23:00"],
            datasets: [{
                label: "Usage",
                lineTension: 0.3,
                backgroundColor: "rgba(2,117,216,0.2)",
                borderColor: "rgba(2,117,216,1)",
                pointRadius: 5,
                pointBackgroundColor: "rgba(2,117,216,1)",
                pointBorderColor: "rgba(255,255,255,0.8)",
                pointHoverRadius: 5,
                pointHoverBackgroundColor: "rgba(2,117,216,1)",
                pointHitRadius: 20,
                pointBorderWidth: 2,
                data: [10000, 30162, 26263, 18287, 28682, 33259, 25849 , 32651, 24159, 38451,
                    10000, 30162, 26263, 18287, 28682, 33259, 25849 , 32651, 24159, 38451,
                    10000, 30162, 26263, 18287]
            },{
                label: "Production",
                lineTension: 0.3,
                backgroundColor: "rgba(2,117,216,0.2)",
                borderColor: "rgba(2,117,216,1)",
                pointRadius: 5,
                pointBackgroundColor: "rgba(2,117,216,1)",
                pointBorderColor: "rgba(255,255,255,0.8)",
                pointHoverRadius: 5,
                pointHoverBackgroundColor: "rgba(2,117,216,1)",
                pointHitRadius: 20,
                pointBorderWidth: 2,
                data: [1000, 3012, 2623, 1827, 2682, 3329, 2549 , 3651, 2459, 3851,
                    1000, 3012, 2623, 1827, 2682, 3329, 2549 , 3651, 2459, 3851,
                    1000, 3012, 2623, 1827]
            }],
        },
        options: {
            scales: {
                xAxes: [{
                    time: {
                        unit: 'date'
                    },
                    gridLines: {
                        display: false
                    },
                    ticks: {
                        maxTicksLimit: 7
                    }
                }],
                yAxes: [{
                    ticks: {
                        min: 0,
                        max: 40000,
                        maxTicksLimit: 5
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

    // price chart
    var ctx = document.getElementById("priceChart");
    var myLineChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: timeAxis,
            datasets: [{
                label: "Price",
                lineTension: 0.3,
                borderColor: "rgba(67,182,47,1)",
                pointRadius: 5,
                pointBackgroundColor: "rgba(67,182,47,1)",
                pointBorderColor: "rgba(255,255,255,0.8)",
                pointHoverRadius: 5,
                pointHitRadius: 20,
                pointBorderWidth: 2,
                data: price
            }],
        },
        options: {
            scales: {
                xAxes: [{
                    time: {
                        unit: 'time'
                    },
                    gridLines: {
                        display: false
                    },
                    ticks: {
                        maxTicksLimit: 7
                    }
                }],
                yAxes: [{
                    ticks: {
                        min: 10,
                        max: 60,
                        maxTicksLimit: 5
                    },
                    scaleLabel: {
                        display: true,
                        labelString: "Cents per kWh"
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

    $("#datereport").datepicker({
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
