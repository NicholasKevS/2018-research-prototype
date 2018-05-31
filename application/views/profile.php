<div class="row">
    <div class="col-12">
        <h1>Profile Details</h1>
        <?php
        if($this->session->flashdata('success')) {
            echo "<div class='alert alert-success'>{$this->session->flashdata('success')}</div>";
        }
        if($this->session->flashdata('alert')) {
            echo "<div class='alert alert-danger'>{$this->session->flashdata('alert')}</div>";
        }
        ?>
    </div>
</div>
<div class="col-4">
    <form action="profile/save/" method="post">
        <div class="form-group">
            <label for="username">Username</label>
            <input type="text" class="form-control" id="username" name="username" value="<?php echo $profile['username']; ?>">
        </div>
        <div class="form-group">
            <label for="email">Email address</label>
            <input type="email" class="form-control" id="email" name="email" value="<?php echo $profile['email']; ?>">
        </div>
        <div class="form-group">
            <label for="fullname">Full Name</label>
            <input type="text" class="form-control" id="fullname" name="fullname" value="<?php echo $profile['fullname']; ?>">
        </div>
        <div class="form-group">
            <label for="locationid">Suburb</label>
            <select class="form-control" id="locationid" name="locationid">
                <?php
                foreach($suburb as $val) {
                    echo "<option value='{$val['id']}'".($val['id']==$profile['locationid']?" selected":"").">{$val['name']}</option>";
                }
                ?>
            </select>
        </div>
        <div class="form-group">
            <label for="providerid">Electricity Provider</label>
            <select class="form-control" id="providerid" name="providerid">
                <?php
                    foreach($provider as $val) {
                        echo "<option value='{$val['id']}'".($val['id']==$profile['providerid']?" selected":"").">{$val['name']}</option>";
                    }
                ?>
            </select>
        </div>
        <div class="form-group">
            <label for="providercode">Electricity Provider Customer ID</label>
            <input type="text" class="form-control" id="providercode" name="providercode" value="<?php echo $profile['providercode']; ?>">
        </div>
        <button type="submit" class="btn btn-primary">Save</button>
    </form>
</div>