<div class="row">
    <div class="col-12">
        <h1>Solar Roof</h1>
    </div>
    <div class="col-12">
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link active" data-toggle="tab" href="#production">Production Chart</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#weather">Weather Forecast</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#details">Solar Roof Details</a>
            </li>
        </ul>
    </div>
</div>
<div class="tab-content" id="solarContent">
    <div class="tab-pane fade show active" id="production">
        <div class="row">
            <div class="col-12">
                <h2>Production</h2>
            </div>
            <div class="col-12 mb-3">
                From:
                <input type="text" name="from" id="date1">
                To:
                <input type="text" name="to" id="date2">
                <button type="submit" class="btn btn-primary">Go</button>
            </div>
        </div>
        <div class="card mb-3">
            <div class="card-header">
                <i class="fa fa-area-chart"></i> Production</div>
            <div class="card-body">
                <canvas id="productionChart" width="100%" height="30"></canvas>
            </div>
            <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
        </div>
    </div>
    <div class="tab-pane fade" id="weather">
        <div class="row">
            <div class="col-12">
                <h2>Weather forecast</h2>
            </div>
            <div class="col-3">
                today forecast detail<br>
                estimation
            </div>
            <div class="col-3">
                tomorrow forecast detail<br>
                estimation
            </div>
        </div>
    </div>
    <div class="tab-pane fade" id="details">
        <div class="row">
            <div class="col-12">
                <h2>Solar Roof Details</h2>
            </div>
            <div class="col-12 mb-3">
                Some details.
            </div>
        </div>
    </div>
</div>
<script>
    // -- Set new default font family and font color to mimic Bootstrap's default styling
    Chart.defaults.global.defaultFontFamily = '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
    Chart.defaults.global.defaultFontColor = '#292b2c';
    // -- Area Chart Example
    var ctx = document.getElementById("productionChart");
    var myLineChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: ["Mar 1", "Mar 2", "Mar 3", "Mar 4", "Mar 5", "Mar 6", "Mar 7", "Mar 8", "Mar 9", "Mar 10"],
            datasets: [{
                label: "Sessions",
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
                data: [10000, 30162, 26263, 18287, 28682, 33259, 25849 , 32651, 24159, 38451],
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
    $("#date1").datepicker();
    $("#date2").datepicker();
</script>
