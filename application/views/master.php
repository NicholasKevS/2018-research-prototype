<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
    <base href="<?php echo base_url(); ?>" />
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="author" content="UTS Research 2018 Autumn">
    <meta name="description" content="Research Prototype">
    <title>PowerGrid - <?php echo $title; ?></title>

    <!-- Bootstrap core CSS-->
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom fonts for this template-->
    <link href="assets/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <!-- Page level plugin CSS-->
    <link href="assets/vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">
    <!-- Custom styles for this template-->
    <link href="assets/css/sb-admin.css" rel="stylesheet">
    <link href="assets/css/jquery-ui.min.css" rel="stylesheet">
    <link href="assets/css/jquery.timepicker.min.css" rel="stylesheet">
    <link href="assets/css/toggle-switch.min.css" rel="stylesheet">

    <!-- Bootstrap core JavaScript-->
    <script src="assets/vendor/jquery/jquery.min.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Core plugin JavaScript-->
    <script src="assets/vendor/jquery-easing/jquery.easing.min.js"></script>
    <!-- Page level plugin JavaScript-->
    <script src="assets/vendor/chart.js/Chart.min.js"></script>
    <script src="assets/vendor/datatables/jquery.dataTables.js"></script>
    <script src="assets/vendor/datatables/dataTables.bootstrap4.js"></script>
    <!-- Custom scripts for all pages-->
    <script src="assets/js/jquery-ui.min.js"></script>
    <script src="assets/js/jquery.timepicker.min.js"></script>
    <script src="assets/js/powergrid.chart.min.js"></script>
</head>

<body class="fixed-nav sticky-footer bg-dark" id="page-top">
<!-- Navigation-->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
    <a class="navbar-brand" href="">PowerGrid</a>
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav navbar-sidenav" id="navbarAccordion">
            <li class="nav-item">
                <a class="nav-link" href="dashboard/">
                    <i class="fa fa-fw fa-dashboard"></i>
                    <span class="nav-link-text">Dashboard</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="node/">
                    <i class="fa fa-fw fa-lightbulb-o"></i>
                    <span class="nav-link-text">Nodes</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="schedule/">
                    <i class="fa fa-fw fa-clock-o"></i>
                    <span class="nav-link-text">Nodes Schedule</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="vehicle/">
                    <i class="fa fa-fw fa-car"></i>
                    <span class="nav-link-text">Electric Vehicle</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="battery/">
                    <i class="fa fa-fw fa-battery-three-quarters"></i>
                    <span class="nav-link-text">Battery</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="solar/">
                    <i class="fa fa-fw fa-bolt"></i>
                    <span class="nav-link-text">Solar Roof</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="notification/">
                    <i class="fa fa-fw fa-bell"></i>
                    <span class="nav-link-text">Notification</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="help/">
                    <i class="fa fa-fw fa-question-circle-o"></i>
                    <span class="nav-link-text">Help</span>
                </a>
            </li>
            <?php if($this->session->isAdmin == true) {
                echo "<li class='nav-item'>
                <a class='nav-link' href='admin/'>
                    <i class='fa fa-fw fa-wrench'></i>
                    <span class='nav-link-text'>Admin Page</span>
                </a>
            </li>";
                echo "<li class='nav-item'>
                <a class='nav-link' href='research/'>
                    <i class='fa fa-fw fa-flask'></i>
                    <span class='nav-link-text'>Research Page</span>
                </a>
            </li>";
            }
            ?>
        </ul>
        <ul class="navbar-nav sidenav-toggler">
            <li class="nav-item">
                <a class="nav-link text-center" id="sidenavToggler">
                    <i class="fa fa-fw fa-angle-left"></i>
                </a>
            </li>
        </ul>
        <ul class="navbar-nav ml-auto">
            <li class="nav-item dropdown">
                <?php echo $this->processor->makeMasterNotifications($this->session->id); ?>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="profile/">
                    <i class="fa fa-fw fa-user"></i>Hello user, <?php echo $this->session->fullname; ?>!</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="modal" data-target="#logoutModal">
                    <i class="fa fa-fw fa-sign-out"></i>Logout</a>
            </li>
        </ul>
    </div>
</nav>
<div class="content-wrapper">
    <div class="container-fluid">
        <?php $this->load->view($view) ?>
    </div>
    <!-- /.container-fluid-->
    <!-- /.content-wrapper-->
    <footer class="sticky-footer">
        <div class="container">
            <div class="text-center">
                <small>Copyright © UTS Research 2018</small>
            </div>
        </div>
    </footer>
    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fa fa-angle-up"></i>
    </a>
    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="logoutModalLabel">Ready to Logout?</h5>
                    <button class="close" type="button" data-dismiss="modal">
                        <span>×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="login/logout/">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Custom scripts for all pages-->
    <script src="assets/js/sb-admin.min.js"></script>
    <script src="assets/js/powergrid.min.js"></script>
</body>
</html>