<?php
require_once "../../config.php";


if ($_GET['do'] == 'stat') {
    if (isset($_GET['tbl'])) {
        $tbl = $_GET['tbl'];
        $id = $_GET['id'];
        $newStat = ($_GET['stat'] == 'Inactive' ? 'Active' : 'Inactive');

        $q = my_query("UPDATE $tbl set stat='$newStat'  WHERE id='$id'");
        $message = "$newStat successfully";
        echo "<script type='text/javascript'>alert('$message');history.go(-1);</script>";
    }
}

if ($_GET['do'] == 'status') {
    $id = $_GET['id'];
    $stat = $_GET['stat'];
    if ($stat == 'Active') {
        $stat = 'Inactive';
    } else {
        $stat = 'Active';
    }
    $q = my_query("UPDATE $tbl set status='$stat'  WHERE id='$id'");

    $index = strtolower($mainUser) . 's';
    echo "<script type='text/javascript'>window.location.href='../$index.php?r=updated';</script>";
}


if ($_GET['do'] == 'smsSend') {
    $id = $_GET['id'];
    $data = array("stat" => '0');
    $where = array('id' => $id);
    $query = db_update('tbl_sms', $data, $where);
    $message = "SMS successfully sent.";
    echo "<script type='text/javascript'>window.location.href='../sms.php?r=added&msg=$message';</script>";

}


?>

