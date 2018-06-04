<div class="row mb-3">
    <div class="col-12">
        <h1>Node Schedule List</h1>
    </div>
</div>
<div class="row">
    <div class="col-12 mb-3">
        <?php
        if($this->session->flashdata('success')) {
            echo "<div class='alert alert-success'>{$this->session->flashdata('success')}</div>";
        }
        ?>
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Id Number</th>
                    <th>Schedule</th>
                    <th>Details</th>
                </tr>
                </thead>
                <tbody>
                <?php
                foreach($schedules as $sch) {
                    echo "<tr><td>{$sch['name']}</td>";
                    echo "<td>{$sch['code']}</td>";
                    echo "<td>";
                    foreach($sch['schedule'] as $s) {
                        echo "{$s['status']}: {$s['start']} to {$s['end']}<br>";
                    }
                    echo "</td>";
                    echo "<td><a href='schedule/detail/{$sch['nodeid']}/' class='btn btn-secondary' role='button'>Details</a></td></tr>";
                }
                ?>
                </tbody>
            </table>
        </div>
    </div>
</div>