<div class="row mb-3">
    <div class="col-12 mb-3">
        <h1>Node List</h1>
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
            <a href="node/create/" class="btn btn-primary">Add New Node</a>
        </div>
        <form action="node/save/" method="post">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Id Number</th>
                    <th>Status</th>
                    <th>Toggle</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                <?php
                foreach($nodes as $node) {
                    if($node['status']) {
                        $status = "Running";
                        $checked = " Checked";
                    } else {
                        $status = "Off";
                        $checked = "";
                    }
                    echo "<tr><td>{$node['name']}</td>";
                    echo "<td>{$node['code']}</td>";
                    echo "<td>$status</td>";
                    echo "<td><label class='switch'>
                            <input type='checkbox' name='status[]' value='{$node['id']}'$checked><span class='slider round'></span>
                            </label></td>";
                    echo "<td><a href='node/detail/{$node['id']}/' class='btn btn-secondary'>Details</a>
                            <a href='schedule/detail/{$node['id']}/' class='btn btn-secondary'>Schedules</a>
                            <a href='node/delete/{$node['id']}/' class='btn btn-danger' role='button'>Delete</a></td></tr>";
                }
                ?>
                </tbody>
            </table>
        </div>
        <div class="float-md-right">
            <button type="submit" class="btn btn-primary">Save</button>
        </div>
        </form>
    </div>
</div>