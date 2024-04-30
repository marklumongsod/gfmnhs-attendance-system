<?php include_once ('config.php');?>
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
    <link href="plugins/node-waves/waves.css" rel="stylesheet" />

    <!-- Animation Css -->
    <link href="plugins/animate-css/animate.css" rel="stylesheet" />

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
        background-opacity:1;
    }
</style>

<body class="login-page" >
<div class="login-box">
    <div class="logo" > 
        <b><a style="color: #143EA0;"> Attendance Monitoring System</a></b>
        <img src="images/logo.png" align="center" width="350px">
    </div>
    <div class="card">
        <div class="body">
            <a class="box-studno">  <?php if(isset($_GET['r'])): ?>
                    <?php
                    $r = $_GET['r'];
                    if($r=='added'){  $classs='success';
                    }else if($r=='invalid'){  $classs='warning';   $r="Invalid user not existed.";
                    }else if($r=='inactive'){ $classs='danger';     $r="Student is inactive.";
                    }else if($r=='not'){ $classs='danger';     $r="Invalid Student LRN or password.";
                    }else{  $classs='hide';
                    }
                    ?>
                    <div class="alert alert-dismissible alert-<?php echo $classs?> <?php echo $classs; ?>">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                        <strong><?php echo $r; ?></strong>
                    </div>
                <?php endif; ?></a>



            <form id="sign_in" action="model/logs.php" method="POST">
                <div class="msg">Sign in to start your session</div>
                <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">person</i>
                        </span>
                    <div class="form-line">
                        <input type="text" class="form-control" name="studNo" placeholder="Student LRN" minlength="12" maxlength="12"  title="LRN max number is 12 " oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');"  required autofocus>
                    </div>
                </div>
                <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">lock</i>
                        </span>
                    <div class="form-line">
                        <input type="password" class="form-control" name="password" placeholder="Password"  required>
                    </div>
                </div>


                <div class="row">
                    <div class="col-xs-8 p-t-5">
                        <!--  <input type="checkbox" name="rememberme" id="rememberme" class="filled-in chk-col-pink">
                           <label for="rememberme">Remember Me</label> -->
                    </div>
                    <div class="col-xs-4">
                        <button class="btn btn-block bg-pink waves-effect"  type="submit" name="func_param" value="studentLogin"  >SIGN IN</button>
                    </div>

                </div>
                <!-- <div class="row m-t-15 m-b--20">
                    <div class="col-xs-6">
                        <a href="sign-up.php">Register </a>
                    </div>-->
                    <!--   <div class="col-xs-6 align-right">
                          <a href="forgot-password.html">Forgot Password?</a>
                      </div> -->
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