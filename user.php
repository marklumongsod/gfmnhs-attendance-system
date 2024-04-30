<?php include_once('config.php'); ?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title><?= $system_title; ?></title>
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
        padding: 20px;
        border-radius: 10px;
    }


</style>

<body class="login-page">
<div class="login-box light-box">

    <div class="card">
        <div class="logo">
            <br/>

            <img src="images/logo.png" align="center" width=100%">

        </div>
        <div class="body">

            <a class="box-studno">  <?php if (isset($_GET['r'])): ?>
                    <?php
                    $r = $_GET['r'];
                    if ($r == 'added') {
                        $classs = 'success';
                    } else if ($r == 'invalid') {
                        $classs = 'warning';
                        $r = "Invalid user not existed.";
                    } else if ($r == 'not') {
                        $classs = 'danger';
                        $r = "Invalid username or password.";
                    } else {
                        $classs = 'hide';
                    }
                    ?>
                    <div class="alert alert-dismissible alert-<?php echo $classs ?> <?php echo $classs; ?>">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">×</span></button>
                        <strong><?php echo $r; ?></strong>
                    </div>
                <?php endif; ?></a>

            <form  action="main/models/user.php" method="POST">
                <div class="msg">Sign in to start your session</div>
                <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">person</i>
                        </span>
                    <div class="form-line">
                        <input type="text" class="form-control" name="username" placeholder="Username" required autofocus>
                    </div>
                </div>
                <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">lock</i>
                        </span>
                    <div class="form-line">
                        <input id="password" type="password" class="form-control" name="password" placeholder="Password" required>
                        <!--  maxlength="10"-->
                    </div>
                </div>


                <div class="row">
                    <div class="col-xs-8 p-t-5">
                        <input  type="checkbox" onchange="document.getElementById('password').type = this.checked ? 'text' : 'password'"    id="rememberme" class="filled-in chk-col-pink">
                        <label for="rememberme">Show password</label>
                    </div> 
                    <div class="col-xs-4">
                        <button class="btn btn-block bg-pink waves-effect" type="submit" name="func_param" value="login">
                            SIGN IN
                        </button>
                    </div>
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