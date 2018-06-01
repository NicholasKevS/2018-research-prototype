<div class="row">
    <div class="col-12">
        <h1>Battery</h1>
        <?php
        if($this->session->flashdata('success')) {
            echo "<div class='alert alert-success'>{$this->session->flashdata('success')}</div>";
        }
        if($this->session->flashdata('alert')) {
            echo "<div class='alert alert-danger'>{$this->session->flashdata('alert')}</div>";
        }
        ?>
    </div>
    <div class="col-12">
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link active" data-toggle="tab" href="#buycharge">Use & Charge Chart</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#details">Battery Details</a>
            </li>
        </ul>
    </div>
</div>
<div class="tab-content" id="batteryContent">
    <div class="tab-pane fade show active" id="buycharge">
        <div class="row">
            <div class="col-12">
                <h2>Use & Charge Chart</h2>
            </div>
            <form action="battery/" method="post">
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
        </div>
        <div class="card mb-3">
            <div class="card-header">
                <i class="fa fa-area-chart"></i> Use & Charge</div>
            <div class="card-body">
                <canvas id="usechargeChart" width="100%" height="30"></canvas>
            </div>
        </div>
    </div>
    <div class="tab-pane fade" id="details">
        <div class="row">
            <div class="col-4 mb-3">
                <h2>Battery Details</h2>
                <form action="battery/save/" method="post">
                    <input type="hidden" id="id" name="id" value="<?php echo $battery['id']; ?>">
                    <div class="form-group">
                        <label for="name">Battery Name</label>
                        <input type="text" class="form-control" id="name" name="name" value="<?php echo $battery['name']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="code">Id Number</label>
                        <input type="text" class="form-control" id="code" name="code" value="<?php echo $battery['code']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="capacity">Battery Capacity</label>
                        <input type="text" class="form-control" id="capacity" name="capacity" value="<?php echo $battery['capacity']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="topthreshold">Top Threshold</label>
                        <input type="text" class="form-control" id="topthreshold" name="topthreshold" value="<?php echo $battery['topthreshold']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="bottomthreshold">Bottom Threshold</label>
                        <input type="text" class="form-control" id="bottomthreshold" name="bottomthreshold" value="<?php echo $battery['bottomthreshold']; ?>">
                    </div>
                    <button type="submit" class="btn btn-primary">Save</button>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    // chart variable
    var timeAxis = <?php echo json_encode($timeAxis); ?>;
    var activity = <?php echo json_encode($activity); ?>;

    // use & charge chart
    var ctx = document.getElementById("usechargeChart");
    var myLineChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: timeAxis,
            datasets: [{
                label: "Activity",
                yAxisID:"left",
                lineTension: 0.3,
                borderColor: "rgba(2,117,216,1)",
                pointRadius: 5,
                pointBackgroundColor: "rgba(2,117,216,1)",
                pointBorderColor: "rgba(255,255,255,0.8)",
                pointHoverRadius: 5,
                pointHitRadius: 20,
                pointBorderWidth: 2,
                data: activity
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
                        min: -2,
                        max: 3,
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
                display: false
            }
        }
    });

    $("#date").datepicker({
        dateFormat: 'yy-mm-dd',
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