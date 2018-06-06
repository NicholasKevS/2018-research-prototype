<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">

<head>
    <base href="<?php echo base_url(); ?>" />
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Power Grid - Login</title>
    <!-- Bootstrap core CSS-->
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom fonts for this template-->
    <link href="assets/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <!-- Custom styles for this template-->
    <link href="assets/css/sb-admin.css" rel="stylesheet">
</head>

<body class="bg-dark">
<div class="container">
    <div class="card card-login mx-auto mt-5">
        <div class="card-header">Login</div>
        <div class="card-body">
            <form action="login/check/" method="post">
                <?php
                if($this->session->flashdata('alert')) {
                    echo "<div class='alert alert-danger'>{$this->session->flashdata('alert')}</div>";
                }
                ?>
                <div class="form-group">
                    <label for="username">Username</label>
                    <input class="form-control" id="username" name="username" type="text" placeholder="Enter username" autofocus>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input class="form-control" id="password" name="password" type="password" placeholder="Password">
                </div>
<!--                <div class="form-group">-->
<!--                    <div class="form-check">-->
<!--                        <label class="form-check-label">-->
<!--                            <input class="form-check-input" type="checkbox"> Remember Password</label>-->
<!--                    </div>-->
<!--                </div>-->
                <button type="submit" class="btn btn-primary btn-block">Login</button>
            </form>
            <div class="text-center">
                <a class="d-block small mt-3" href="login/register/">Register an Account</a>
                <a class="d-block small" href="login/forgot/">Forgot Password?</a>
            </div>
        </div>
    </div>
</div>
<!-- Bootstrap core JavaScript-->
<script src="assets/vendor/jquery/jquery.min.js"></script>
<script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- Core plugin JavaScript-->
<script src="assets/vendor/jquery-easing/jquery.easing.min.js"></script>
</body>

</html>