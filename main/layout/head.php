<?php include_once('../config.php'); ?>
<?php if (!isset($_SESSION['user_id'])) {
    $message = "Please login first.";
    echo "<script type='text/javascript'>window.location.href='../index.php';</script>";
    exit;
} ?>

<!DOCTYPE html>
<html>
<head>

    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title> <?= $system_title; ?></title>

    <!-- Favicon-->
    <link rel="icon" href="../images/logo.png" type="image/x-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">

    <!-- Bootstrap Core Css -->
    <link href="../plugins/bootstrap/css/bootstrap.css" rel="stylesheet">

    <!-- Waves Effect Css -->
    <link href="../plugins/node-waves/waves.css" rel="stylesheet"/>

    <!-- Animation Css -->
    <link href="../plugins/animate-css/animate.css" rel="stylesheet"/>

    <!-- Colorpicker Css -->
    <link href="../plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.css" rel="stylesheet"/>

    <!-- Dropzone Css -->
    <link href="../plugins/dropzone/dropzone.css" rel="stylesheet">

    <!-- Multi Select Css -->
    <link href="../plugins/multi-select/css/multi-select.css" rel="stylesheet">

    <!-- Bootstrap Spinner Css -->
    <link href="../plugins/jquery-spinner/css/bootstrap-spinner.css" rel="stylesheet">

    <!-- Bootstrap Tagsinput Css -->
    <link href="../plugins/bootstrap-tagsinput/bootstrap-tagsinput.css" rel="stylesheet">

    <!-- Bootstrap Select Css -->
    <link href="../plugins/bootstrap-select/css/bootstrap-select.css" rel="stylesheet"/>

    <!-- noUISlider Css -->
    <link href="../plugins/nouislider/nouislider.min.css" rel="stylesheet"/>

    <!-- Light Gallery Plugin Css -->
    <link href="../plugins/light-gallery/css/lightgallery.css" rel="stylesheet">

    <!-- Custom Css -->
    <link href="../css/style.css" rel="stylesheet">

    <!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->
    <link href="../css/themes/all-themes.css" rel="stylesheet"/>

    <!-- Bootstrap Select Css -->
    <link href="../plugins/bootstrap-select/css/bootstrap-select.css" rel="stylesheet"/>

    <!-- JQuery DataTable Css -->
    <link href="../plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css" rel="stylesheet">

    <!-- datatables -->
    <link rel="stylesheet" type="text/css" href="../plugins/datatables/css/jquery.dataTables.min.css">

    <!-- Sweet Alert Css -->
    <link href="../plugins/sweetalert/sweetalert.css" rel="stylesheet"/>

    <!-- toastr -->
    <link rel="stylesheet" type="text/css" href="../plugins/toastr/css/toastr.css">

    <!-- select2 -->
    <link rel="stylesheet" type="text/css" href="../plugins/select/dist/css/select2.min.css">

    <!-- amcharts -->
    <link rel="stylesheet" href="../plugins/amcharts/css/export.css" media="all" class="hide-on-print"/>
    <link rel="stylesheet" type="text/css" href="../plugins/fullcalendar/fullcalendar.min.css" class="hide-on-print"/>
    <link rel="stylesheet" type="text/css" href="../plugins/datetimepicker/datetimepicker.css" class="hide-on-print"/>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>


</head>

<body class="theme-blue">


<!-- Top Bar -->
<?php include_once('layout/topBar.php'); ?>
<!-- #Top Bar -->

<?php include_once('layout/sidebar.php'); ?>

