<div class="row">
    <div class="col-12">
        <h1>Edit <?php echo $nodeName; ?> Schedule</h1>
    </div>
</div>
<div class="row">
    <div class="col-12 mb-3">
        <?php
        if($this->session->flashdata('success')) {
            echo "<div class='alert alert-success'>{$this->session->flashdata('success')}</div>";
        }
        ?>
        <div class="col-3">
            <form action="schedule/saveEdit/" method="post">
                <input type="hidden" id="id" name="id" value="<?php echo $schedule['id']; ?>">
                <input type="hidden" id="nodeid" name="nodeid" value="<?php echo $schedule['nodeid']; ?>">
                <div class="form-group">
                    <label for="status">Status</label>
                    <select class="form-control" id="status" name="status">
                        <option value="1"<?php echo $schedule['status']==1?" selected":""; ?>>On</option>
                        <option value="0"<?php echo $schedule['status']==0?" selected":""; ?>>Off</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="start">Start</label>
                    <input type="text" name="start" id="start" onkeydown="return false" value="<?php echo $schedule['start']; ?>">
                </div>
                <div class="form-group">
                    <label for="end">End</label>
                    <input type="text" name="end" id="end" onkeydown="return false" value="<?php echo $schedule['end']; ?>">
                </div>
                <button type="submit" class="btn btn-primary">Save</button>
            </form>
        </div>
    </div>
</div>
<script>
    $("#start").timepicker({
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

            $("#end").timepicker('option', 'minTime', minTime);

            if($("#end").val() < newTime) {
                $("#end").val(newTime);
            }
        }
    });

    $("#end").timepicker({
        timeFormat: 'HH:mm',
        interval: 60,
        minTime: (new Date(0,0,0,parseInt(<?php echo "'{$schedule['start']}'"; ?>)).getHours()+1).toString(),
        maxTime: '23',
        dynamic: false,
        scrollbar: true
    });
</script>