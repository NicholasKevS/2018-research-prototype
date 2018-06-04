<div class="row">
    <div class="col-12">
        <h1><?php echo $node['name']; ?> - Schedule</h1>
    </div>
</div>
<div class="row">
    <div class="col-12 mb-3">
        <?php
        if($this->session->flashdata('success')) {
            echo "<div class='alert alert-success'>{$this->session->flashdata('success')}</div>";
        }
        ?>
        <div class="float-md-right mb-3">
            <a href="schedule/create/<?php echo $node['id']; ?>/" class="btn btn-primary">Add New Schedule</a>
        </div>
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                <tr>
                    <th>Status</th>
                    <th>From</th>
                    <th>To</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <?php
                foreach($schedules as $sch) {
                    echo "<tr><td>{$sch['status']}</td>";
                    echo "<td>{$sch['start']}</td>";
                    echo "<td>{$sch['end']}</td>";
                    echo "<td><a href='schedule/edit/{$sch['id']}/' class='btn btn-secondary' role='button'>Edit</a>
                            <a href='schedule/delete/{$node['id']}/{$sch['id']}/' class='btn btn-danger' role='button'>Delete</a></td></tr>";
                }
                ?>
                </tbody>
            </table>
        </div>
    </div>
</div>