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
    background-opacity:0.2;
}
</style> 

<body class="login-page" >
    <div class="login-box">
        <div class="logo" >
         <!--  <img src="images/logo.png" align="center" width=350px"> -->
          
            </div>
            <div class="card">
                <div class="body">

                  <a class="box-title">  <?php if(isset($_GET['r'])): ?>
                  <?php
                  $r = $_GET['r'];
                  if($r=='added'){  $classs='success';    $r="Successfull added.";
              }else if($r=='updated'){  $classs='warning';   
          }else if($r=='deleted'){ $classs='danger';    $r="Password not match.";
      }else if($r=='invalid'){ $classs='danger';    $r="Student Number or Email is already used.";
  }else{  $classs='hide';
}
?> 
<div class="alert alert-dismissible alert-<?php echo $classs?> <?php echo $classs; ?>">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
  <strong><?=$r; ?></strong>    
</div>
<?php endif; ?></a>  


<form   action="model/logs.php" method="POST">
    <div class="msg">Register a new membership</div>
 <div class="input-group">
        <span class="input-group-addon">
            <i class="material-icons">person</i>
        </span>
        <div class="form-line">
            <input type="number" class="form-control" name="studNo" placeholder="Student Number" required="" autofocus="" aria-required="true">
        </div>
    </div>
    <div class="input-group">
        <span class="input-group-addon">
            <i class="material-icons">person</i>
        </span>
        <div class="form-line">
            <input type="text" class="form-control" name="fname" placeholder="First Name" required="" autofocus="" aria-required="true">
        </div>
    </div>
    <div class="input-group">
        <span class="input-group-addon">
            <i class="material-icons">person</i>
        </span>
        <div class="form-line">
            <input type="text" class="form-control" name="lname" placeholder="Last  Name" required="" autofocus="" aria-required="true">
        </div>
    </div>
  <div class="input-group">
        <span class="input-group-addon">
            <i class="material-icons">person</i>
        </span>
        <div class="form-line">
            <input type="text" class="form-control" name="mname" placeholder="Middle Name" required="" autofocus="" aria-required="true">
        </div>
    </div>

   

    <div class="input-group">
        <span class="input-group-addon">
            <i class="material-icons">person</i>
        </span>
        <div class="form-line">
           <select name="section"  class="form-control" required>
               <option></option>
             <?php  $res = my_query("SELECT *,CONCAT( value)sec  FROM tbl_settings_constants WHERE category='Section'  ");
             for($i=1; $r = $res->fetch(); $i++){ $id=$r['id'];  ?>
                <option value="<?=$r['sec'];?>"><?=$r['sec'];?></option>
        <?php } ?>
    </select>

</div>
</div> 

<div class="input-group">
    <span class="input-group-addon">
        <i class="material-icons">email</i>
    </span>
    <div class="form-line">
        <input type="email" class="form-control" name="email" placeholder="Email Address" required="" aria-required="true">
    </div>
</div>
<div class="input-group">
    <span class="input-group-addon">
        <i class="material-icons">lock</i>
    </span>
    <div class="form-line">
        <input type="text" class="form-control" name="username"  placeholder="Username" required="" aria-required="true">
    </div>
</div>
<div class="input-group">
    <span class="input-group-addon">
        <i class="material-icons">lock</i>
    </span>
    <div class="form-line">
        <input type="password" class="form-control" name="password" minlength="6" placeholder="Password" required="" aria-required="true">
    </div>
</div>
<div class="input-group">
    <span class="input-group-addon">
        <i class="material-icons">lock</i>
    </span>
    <div class="form-line">
        <input type="password" class="form-control" name="confirm" minlength="6" placeholder="Confirm Password" required="" aria-required="true">
    </div>
</div>
                <!--     <div class="form-group">
                        <input type="checkbox" name="terms" id="terms" class="filled-in chk-col-pink">
                        <label for="terms">I read and agree to the <a href="javascript:void(0);">terms of usage</a>.</label>
                    </div> -->

                    <button class="btn btn-block btn-lg bg-pink waves-effect" type="submit" name="func_param" value="studentSignup">SIGN UP</button> 
                    <div class="m-t-25 m-b--5 align-center">
                        <a href="student.php"><< Back</a>
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