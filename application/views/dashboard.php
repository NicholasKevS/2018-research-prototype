<div class="row">
    <div class="col-12">
        <h1>Dashboard</h1>
    </div>
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
        </ul>
    </div>
</div>
<div class="tab-content" id="dashboardContent">
    <div class="tab-pane fade show active" id="usageproduction">
        <div class="row">
            <div class="col-12">
                <h2>Usage & Production Chart</h2>
            </div>
            <div class="col-12 mb-3">
                From:
                <input type="text" name="from" id="date1">
                To:
                <input type="text" name="to" id="date2">
            </div>
            <div class="col-12 mb-3">
                From:
                <input type="text" name="from" id="time1">
                To:
                <input type="text" name="to" id="time2">
                <button type="submit" class="btn btn-primary">Go</button>
            </div>
        </div>
        <div class="card mb-3">
            <div class="card-header">
                <i class="fa fa-area-chart"></i> Usage & Production</div>
            <div class="card-body">
                <canvas id="usageproductionChart" width="100%" height="30"></canvas>
            </div>
            <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
        </div>
    </div>
    <div class="tab-pane fade" id="prediction">
        <div class="row">
            <div class="col-12">
                <h2>Production / Usage Today Estimation</h2>
            </div>
            <div class="col-3">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>Production</th>
                        <th>Usage</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>40 kw</td>
                        <td>10 kw</td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <div class="col-12">
                <p>Based on estimation, you can discharge 30 kw</p>
                <p>Based on estimation, your bill this month will be $200</p>
            </div>
        </div>
    </div>
    <div class="tab-pane fade" id="price">
        <div class="row">
            <div class="col-12">
                <h2>Current Electricity Rate</h2>
            </div>
            <div class="col-4">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>Peak</th>
                        <th>Shoulder</th>
                        <th>Off Peak</th>
                        <th>Unit</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>53.01</td>
                        <td>23.79</td>
                        <td>14.42</td>
                        <td>cents per kWh</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<script>
    // -- Set new default font family and font color to mimic Bootstrap's default styling
    Chart.defaults.global.defaultFontFamily = '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
    Chart.defaults.global.defaultFontColor = '#292b2c';
    // -- Area Chart Example
    var ctx = document.getElementById("usageproductionChart");
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
    $("#time1").timepicker({
        timeFormat: 'HH:mm',
        interval: 60,
        minTime: '0',
        maxTime: '23',
        startTime: '0',
        dynamic: false,
        scrollbar: true
    });
    $("#time2").timepicker({
        timeFormat: 'HH:mm',
        interval: 60,
        minTime: '0',
        maxTime: '23',
        startTime: '0',
        dynamic: false,
        scrollbar: true
    });
</script>
