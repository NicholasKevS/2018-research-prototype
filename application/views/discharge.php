<div class="row">
    <div class="col-12">
        <h1>Discharge List</h1>
    </div>
    <div class="col-12 mb-3">
        From:
        <input type="text" name="from" id="date1">
        To:
        <input type="text" name="to" id="date2">
    </div>
</div>
<div class="card mb-3">
    <div class="card-header">
        <i class="fa fa-table"></i> Discharge List Example</div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                <tr>
                    <th>Location</th>
                    <th>Date/Time</th>
                    <th>Amount</th>
                </tr>
                </thead>
                <tfoot>
                <tr>
                    <th>Location</th>
                    <th>Date/Time</th>
                    <th>Amount</th>
                </tr>
                </tfoot>
                <tbody>
                <tr>
                    <td>UTS Carpark Building 11</td>
                    <td>12/04/18 5pm</td>
                    <td>50 kw</td>
                </tr>
                <tr>
                    <td>UTS Carpark Building 11</td>
                    <td>14/04/18 5pm</td>
                    <td>55 kw</td>
                </tr>
                <tr>
                    <td>UTS Carpark Building 11</td>
                    <td>16/04/18 5pm</td>
                    <td>30 kw</td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
</div>
<script>
    $("#date1").datepicker();
    $("#date2").datepicker();
</script>