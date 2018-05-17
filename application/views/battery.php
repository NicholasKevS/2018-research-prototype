<div class="row">
    <div class="col-12">
        <h1>Buy / Discharge List</h1>
    </div>
    <div class="col-12 mb-3">
        From:
        <input type="text" name="from" id="date1">
        To:
        <input type="text" name="to" id="date2">
        <button type="submit" class="btn btn-primary">Go</button>
    </div>
</div>
<div class="card mb-3">
    <div class="card-header">
        <i class="fa fa-table"></i> Buy / Discharge List Example</div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                <tr>
                    <th>Date</th>
                    <th>Amount (+/-)</th>
                </tr>
                </thead>
                <tfoot>
                <tr>
                    <th>Date</th>
                    <th>Amount (+/-)</th>
                </tr>
                </tfoot>
                <tbody>
                <tr>
                    <td>12/04/18</td>
                    <td>+50 kw</td>
                </tr>
                <tr>
                    <td>14/04/18</td>
                    <td>-55 kw</td>
                </tr>
                <tr>
                    <td>16/04/18</td>
                    <td>+30 kw</td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
</div>
<div class="row">
    <div class="col-12">
        <h1>Discharge Rule</h1>
    </div>
    <div class="col-12 mb-3">
        Automatic discharge when you have more than:
        <form method="post" action="battery/edit/">
            <input type="text" name="rule" id="rule"> kw
            <button type="submit" class="btn btn-primary">Change</button>
        </form>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <h1>Battery Details</h1>
    </div>
    <div class="col-12 mb-3">
        Some details.
    </div>
</div>
<script>
    $("#date1").datepicker();
    $("#date2").datepicker();
</script>