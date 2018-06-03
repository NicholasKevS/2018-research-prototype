<div class="row mb-3">
    <div class="col-12">
        <h1>New Node</h1>
        <?php
        if($this->session->flashdata('alert')) {
            echo "<div class='alert alert-danger'>{$this->session->flashdata('alert')}</div>";
        }
        ?>
    </div>
    <div class="col-12">
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link active" data-toggle="tab" href="#details">Node Details</a>
            </li>
        </ul>
    </div>
</div>
<div class="tab-content" id="nodeContent">
    <div class="tab-pane fade show active" id="details">
        <div class="row">
            <div class="col-4 mb-3">
                <h2>Node Details</h2>
                <form action="node/saveCreate/" method="post">
                    <input type="hidden" id="id" name="id" value="new">
                    <input type="hidden" id="status" name="status" value="1">
                    <div class="form-group">
                        <label for="name">Node Name</label>
                        <input type="text" class="form-control" id="name" name="name" value="<?php echo $this->session->flashdata('name'); ?>">
                    </div>
                    <div class="form-group">
                        <label for="code">Id Number</label>
                        <input type="text" class="form-control" id="code" name="code" value="<?php echo $this->session->flashdata('code'); ?>">
                    </div>
                    <button type="submit" class="btn btn-primary">Save</button>
                </form>
            </div>
        </div>
    </div>
</div>