<?php include_once('config.php'); ?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title> <?=$system_title;?></title>
    <!-- Favicon-->
    <link rel="icon" href="images/logo.png" type="image/x-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">

    <!-- Bootstrap Core Css -->
    <link href="plugins/bootstrap/css/bootstrap.css" rel="stylesheet">

    <!-- Waves Effect Css -->
    <link href="plugins/node-waves/waves.css" rel="stylesheet"/>

    <!-- Animation Css -->
    <link href="plugins/animate-css/animate.css" rel="stylesheet"/>

    <!-- Custom Css -->
    <link href="css/style.css" rel="stylesheet">
</head>
<style type="text/css">
    body {
        padding-top: 60px;
        padding-bottom: 40px;
        background-image: url('images/bg.png');
        background-attachment: fixed;
        background-size: 100% 100%;
        background-opacity: 0.2;
    }
</style>

<body class="login-page">
<div class="login-box">
    <div class="logo">
        <!--  <img src="images/logo.png" align="center" width=350px"> -->

    </div>
    <div class="card">
        <div class="body">

            <a class="box-title">  <?php if (isset($_GET['r'])): ?>
                    <?php
                    $r = $_GET['r'];
                    if ($r == 'added') {
                        $classs = 'success';
                        $r = "New password generated. Please open your email.";
                    } else if ($r == 'applied') {
                        $classs = 'success';
                        $r = "Successfully Applied. Please Check your email for confirmation";
                    } else if ($r == 'existed') {
                        $classs = 'success';
                        $r = "Email is existed. Try to use forgot password";
                    } else if ($r == 'updated') {
                        $classs = 'warning';
                    } else if ($r == 'deleted') {
                        $classs = 'danger';
                        $r = "Password not match.";
                    } else if ($r == 'invalid') {
                        $classs = 'danger';
                        $r = "Email is not exist.";
                    } else {
                        $classs = 'hide';
                    }
                    ?>
                    <div class="alert alert-dismissible alert-<?php echo $classs ?> <?php echo $classs; ?>">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">×</span></button>
                        <strong><?= $r; ?></strong>
                    </div>
                <?php endif; ?>
            </a>


            <form action="main/models/user.php" method="POST">
                <div class="msg">Forgot password</div>
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="material-icons">email</i>
                    </span>
                    <div class="form-line">
                        <input type="email" class="form-control" name="email" placeholder="Email Address" required="" aria-required="true">
                    </div>
                </div>

                <button class="btn btn-block btn-lg bg-orange waves-effect" type="submit" name="func_param" value="forgotPassword">
                    FORGOT PASSWORD
                </button>
             
                <div class="m-t-25 m-b--5 align-center">
                    <a href="index.php"><< Back</a>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Jquery Core Js -->
<script src="plugins/jquery/jquery.min.js"></script>

<!-- Bootstrap Core Js -->
<script src="plugins/bootstrap/js/bootstrap.js"></script>

<!-- Waves Effect Plugin Js -->
<script src="plugins/node-waves/waves.js"></script>

<!-- Validation Plugin Js -->
<script src="plugins/jquery-validation/jquery.validate.js"></script>

<!-- Custom Js -->
<script src="js/admin.js"></script>
<script src="js/pages/examples/sign-in.js"></script>
</body>

</html>