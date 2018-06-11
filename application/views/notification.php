<div class="row mb-3">
    <div class="col-12 mb-3">
        <h1>Notification</h1>
    </div>
</div>
<div class="row">
    <div class="col-12 mb-3">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                <tr>
                    <th>Title</th>
                    <th>Message</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                <?php
                foreach($notifications as $notif) {
                    echo "<tr><td>{$notif['title']}</td>";
                    echo "<td>{$notif['message']}</td>";
                    echo "<td><a href='{$notif['url']}/' class='btn btn-secondary'>Go</a></td></tr>";
                }
                ?>
                </tbody>
            </table>
        </div>
    </div>
</div>