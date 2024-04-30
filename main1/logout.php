<?php
require_once "../config.php";

ualt("Logout");

error_reporting(E_ALL ^ E_NOTICE);
error_reporting(E_ALL ^ E_DEPRECATED);

if ($user_role==$mainUser) {
    if (session_destroy()) {
        echo "<script type='text/javascript'>window.location.href='../login.php?r=logout';</script>";
    }
} else {
    if (session_destroy()) {
        echo "<script type='text/javascript'>window.location.href='../user.php?r=logout';</script>";
    }
}


?>