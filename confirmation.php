<?php
include_once('config.php');


//Verify Email
if (isset($_GET['hash'])) {
    $hash = $_GET['hash'];
    $email = $_GET['email'];


    $result = $db->prepare("SELECT * FROM tbl_trainees WHERE email='$email' AND emailCode='$hash'");
    $result->execute();
    if ($row = $result->fetch()) {
        $id = $row['id'];
        $q = $db->prepare("UPDATE tbl_trainees SET status='Active' WHERE id='$id'");
        $q->execute(array());

        $message = 'Your account has been activated, you can now login';
        echo "<script type='text/javascript'>alert('$message');window.location.href='index.php&msg=$message';</script>";
        exit();

    } else {
        $message = 'Invalid activation.';
        echo "<script type='text/javascript'>alert('$message');window.location.href='index.php&msg=$message';</script>";
        exit();
    }
}

  