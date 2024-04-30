<?php require '../../config.php'; ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <title></title>
</head>
<body>
<form class="" action="" method="post" enctype="multipart/form-data">
    <input type="file" name="excel" required value="">
    <button type="submit" name="import">Import</button>
</form>
<hr>
<table border=1>
    <tr>
        <td>#</td>
        <th>Picture</th>
        <th>Name</th>
        <th>Email/Username</th>
        <th>Contact</th>
        <th>Status</th>
    </tr>
    <?php
    $i = 1;
    $rows = my_query("SELECT *,CONCAT(fname,' ',lname)name  FROM tbl_students ORDER BY id DESC");
    foreach ($rows as $row) :
        ?>
        <tr>
            <td> <?= $i; ?></td>
            <td><img src="../../images/student/<?= $row['pic']; ?>" width="80px"></td>

            <td> <?= $row['name']; ?></td>
            <td> <?= $row['email']; ?></td>
            <td> <?= $row['contact']; ?></td>
            <!--<td> <?= $row['username']; ?></td>-->
            <td> <?= $row['status']; ?></td>
        </tr>
    <?php endforeach; ?>
</table>
<?php
function endecrypt($string, $action = 'e')
{
    // you may change these values to your own
    $_SESSION['key'] = 'imBlessed@o1';
    $secret_key = $_SESSION['key'];
    $secret_iv = $_SESSION['key'];

    $output = false;
    $encrypt_method = "AES-256-CBC";
    $key = hash('sha256', $secret_key);
    $iv = substr(hash('sha256', $secret_iv), 0, 16);

    if ($action == 'e') {
        $output = base64_encode(openssl_encrypt($string, $encrypt_method, $key, 0, $iv));
    } else if ($action == 'd') {
        $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
    }

    return $output;
}


if (isset($_POST["import"])) {
    $fileName = $_FILES["excel"]["name"];
    $fileExtension = explode('.', $fileName);
    $fileExtension = strtolower(end($fileExtension));
    $newFileName = date("Y.m.d") . " - " . date("h.i.sa") . "." . $fileExtension;

    $targetDirectory = "uploads/" . $newFileName;
    move_uploaded_file($_FILES['excel']['tmp_name'], $targetDirectory);

   // error_reporting(0);
  //  ini_set('display_errors', 0);

    require 'excelReader/excel_reader2.php';
    require 'excelReader/SpreadsheetReader.php';

    $reader = new SpreadsheetReader($targetDirectory);
    foreach ($reader as $key => $row) {
        $role = 'Professor'; //$_GET['role'];
        $studNo = $row[0];
        $fname = $row[1];
        $lname = $row[2];
        $mname = $row[3];
        $bday = $row[4];
        $age = $row[5];
        $gender = $row[6];
        $address = $row[7];
        $email = $row[8];
        $contact = $row[9];
        $username = $row[10];
        $section = $row[11];
        $gr_yr = $row[12];
        $status='Active';
        $password = 'd3f@auLt2023'; // endecrypt('def@ult2024' . $lname, 'e');

        my_query("INSERT INTO tbl_students
( `studNo`,  `fname`, `lname`, `mname`,  `bday`, `age`, `gender`, `address`, `email`, `contact`,  `username`, `section`,  `gr_yr`, `password`,status ) 
VALUES( '$studNo', '$fname', '$lname', '$mname', '$bday', '$age', '$gender', '$address', '$email', '$contact', '$username', '$section', '$gr_yr', '$password','Active' )");
    }

    my_query("DELETE FROM `tbl_students` WHERE  studNo='studNo' ");
    echo " <script> alert('Succesfully Imported'); document.location.href = ''; </script> ";
}
?>
</body>
</html>
