<?php

$servername='localhost';
$username='root';
$password='';
$dbname = "webfaceattendancedb";
$conn=mysqli_connect($servername,$username,$password,$dbname);
if(!$conn){
    die('Could not Connect MySql Server:' .mysql_error());
}


$grade = isset($_POST['grade']) ? $_POST['grade'] : 0; 
$command = isset($_POST['get']) ? $_POST['get'] : "";

switch ($command) {
 
    case "getsection":
        $result1 = "<option>Select Section</option>";
        $statement = "SELECT *,CONCAT( value)name  FROM tbl_settings_constants WHERE category='Section' AND sub_value  ='$grade'";
        $dt = mysqli_query($conn, $statement);

        while ($result = mysqli_fetch_array($dt)) {
            $result1 .= "<option value=" . $result['name'] . ">" . $result['name'] . "</option>";
        }
        echo $result1;
        break;
 
}

exit();
?>