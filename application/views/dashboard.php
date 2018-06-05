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
                <a class="nav-link" data-toggle="tab" href="#forecast">Tomorrow Forecast Chart</a>
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
                <p>Today weather forecast: <?php echo $weather['today']; ?></p>
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
    <div class="tab-pane fade" id="forecast">
        <div class="row">
            <div class="col-12">
                <h2>Production & Usage Forecast for Tomorrow (31 May 2018)</h2>
                <p>Tomorrow weather forecast: <?php echo $weather['tomorrow']; ?></p>
            </div>
        </div>
        <div class="card mb-3">
            <div class="card-header">
                <i class="fa fa-area-chart"></i> Production & Usage Tomorrow Forecast</div>
            <div class="card-body">
                <canvas id="forecastChart" width="100%" height="30"></canvas>
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
                <form action="dashboard/report/" method="post">
                    <div class="col-12 mb-3">
                        Date:
                        <input type="text" name="datereport" id="datereport" onkeydown="return false" value="<?php echo $datereport; ?>">
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
    var usageForecastToday = <?php echo json_encode($usageForecastToday); ?>;
    var productionForecastToday = <?php echo json_encode($productionForecastToday); ?>;
    var usageForecastTomorrow = <?php echo json_encode($usageForecastTomorrow); ?>;
    var productionForecastTomorrow = <?php echo json_encode($productionForecastTomorrow); ?>;
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
                label: "Usage Forecast",
                yAxisID:"left",
                lineTension: 0.3,
                borderColor: "rgba(198,0,29,1)",
                borderDash: [5, 5],
                pointRadius: 5,
                pointBackgroundColor: "rgba(198,0,29,1)",
                pointBorderColor: "rgba(255,255,255,0.8)",
                pointHoverRadius: 5,
                pointHitRadius: 20,
                pointBorderWidth: 2,
                data: usageForecastToday
            },{
                label: "Production Forecast",
                yAxisID:"left",
                lineTension: 0.3,
                borderColor: "rgba(2,117,216,1)",
                borderDash: [5, 5],
                pointRadius: 5,
                pointBackgroundColor: "rgba(2,117,216,1)",
                pointBorderColor: "rgba(255,255,255,0.8)",
                pointHoverRadius: 5,
                pointHitRadius: 20,
                pointBorderWidth: 2,
                data: productionForecastToday
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
    var ctx = document.getElementById("forecastChart");
    var myLineChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: ["00:00", "01:00", "02:00", "03:00", "04:00", "05:00", "06:00", "07:00", "08:00", "09:00", "10:00", "11:00", "12:00", "13:00", "14:00", "15:00", "16:00", "17:00", "18:00", "19:00", "20:00", "21:00", "22:00", "23:00"],
            datasets: [{
                label: "Usage Forecast",
                yAxisID:"left",
                lineTension: 0.3,
                borderColor: "rgba(198,0,29,1)",
                borderDash: [5, 5],
                pointRadius: 5,
                pointBackgroundColor: "rgba(198,0,29,1)",
                pointBorderColor: "rgba(255,255,255,0.8)",
                pointHoverRadius: 5,
                pointHitRadius: 20,
                pointBorderWidth: 2,
                data: usageForecastTomorrow
            },{
                label: "Production Forecast",
                yAxisID:"left",
                lineTension: 0.3,
                borderColor: "rgba(2,117,216,1)",
                borderDash: [5, 5],
                pointRadius: 5,
                pointBackgroundColor: "rgba(2,117,216,1)",
                pointBorderColor: "rgba(255,255,255,0.8)",
                pointHoverRadius: 5,
                pointHitRadius: 20,
                pointBorderWidth: 2,
                data: productionForecastTomorrow
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
