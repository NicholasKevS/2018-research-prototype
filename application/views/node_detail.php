<div class="row mb-3">
    <div class="col-12">
        <h1><?php echo $node['name']; ?> - Node</h1>
        <?php
        if($this->session->flashdata('success')) {
            echo "<div class='alert alert-success'>{$this->session->flashdata('success')}</div>";
        }
        if($this->session->flashdata('alert')) {
            echo "<div class='alert alert-danger'>{$this->session->flashdata('alert')}</div>";
        }
        ?>
    </div>
    <form action="node/detail/<?php echo $node['id']; ?>" method="post">
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
                <a class="nav-link active" data-toggle="tab" href="#usage">Usage Chart</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#details">Node Details</a>
            </li>
        </ul>
    </div>
</div>
<div class="tab-content" id="nodeContent">
    <div class="tab-pane fade show active" id="usage">
        <div class="row">
            <div class="col-12">
                <h2>Usage Chart</h2>
            </div>
        </div>
        <div class="card mb-3">
            <div class="card-header">
                <i class="fa fa-area-chart"></i> Usage</div>
            <div class="card-body">
                <canvas id="usageChart" width="100%" height="30"></canvas>
            </div>
        </div>
    </div>
    <div class="tab-pane fade" id="details">
        <div class="row">
            <div class="col-4 mb-3">
                <h2>Node Details</h2>
                <form action="node/saveDetail/" method="post">
                    <input type="hidden" id="id" name="id" value="<?php echo $node['id']; ?>">
                    <div class="form-group">
                        <label for="name">Node Name</label>
                        <input type="text" class="form-control" id="name" name="name" value="<?php echo $node['name']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="code">Id Number</label>
                        <input type="text" class="form-control" id="code" name="code" value="<?php echo $node['code']; ?>">
                    </div>
                    <div class="form-group">
                        <label class="switch">
                            <input type="checkbox" name="status" id="status" value="on"<?php echo $checked; ?>>
                            <span class="slider round"></span>
                        </label>
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
    var usage = <?php echo json_encode($usage); ?>;
    var total = <?php echo json_encode($total); ?>;

    // usage chart
    var ctx = document.getElementById("usageChart");
    var myLineChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: timeAxis,
            datasets: [{
                label: "Node Usage",
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
                label: "Total Usage",
                yAxisID:"left",
                lineTension: 0.3,
                borderColor: "rgba(2,117,216,1)",
                pointRadius: 5,
                pointBackgroundColor: "rgba(2,117,216,1)",
                pointBorderColor: "rgba(255,255,255,0.8)",
                pointHoverRadius: 5,
                pointHitRadius: 20,
                pointBorderWidth: 2,
                data: total
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
                        min: <?php echo $usageChart['min']; ?>,
                        max: <?php echo $usageChart['max']; ?>,
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