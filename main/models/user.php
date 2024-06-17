<?php
require_once "../../config.php";
echo $function = $_POST['func_param'];

switch ($function) {

    case 'regSignup':
        $cusNo = $_POST['cusNo'];

        if ($_POST['password'] <> $_POST['confirm']) {
            echo "<script type='text/javascript'>window.location.href='../../sign-up.php?r=deleted';</script>";
        } else {
            $result = $db->prepare("SELECT *,CONCAT(fname,' ',lname)fullname FROM tbl_customers  WHERE  regNo='$regNo' ");
            $result->execute();
            if ($row = $result->fetch()) {
                echo "<script type='text/javascript'>window.location.href='../../sign-up.php?r=invalid';</script>";
                exit();
            } else {
                $data = array("cusNo" => $_POST['cusNo'], "password" => $defaultPassword, "lname" => $_POST['lname'], "fname" => $_POST['fname'],
                    "mname" => $_POST['mname'], "username" => $_POST['email'], "email" => $_POST['email'], "address" => $_POST['address'], "contact" => $_POST['contact']);
                $query = db_insert('tbl_customers', $data);
                echo "<script type='text/javascript'>window.location.href='../../sign-up.php?r=added';</script>";
            }
        }
        break;

//GOOD


    case "signup" :
        $no = $_POST[$mainUserNo];
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $mname = $_POST['mname'];
        $username = $_POST['email'];
        $password = substr(md5(mt_rand()), 0, 7);
        $email = $_POST['email'];
        $contact = $_POST['contact'];
        $address = $_POST['address'];
        $gender = $_POST['gender'];
        $age = $_POST['age'];
        $bday = $_POST['bday'];

        $temp = $_FILES["pic"]["tmp_name"];
        $pic = $_FILES["pic"]["name"];
        move_uploaded_file($temp, "../../images/$mainUser/" . $pic);
        if ($pic == "") {
            $pic = $_POST['pic1'];
        }
        $subject = "FROM : $system_title New Account Created";
        $emailCode = substr(md5(mt_rand()), 0, 32);

        $txt = "Your username is : $email.\nYour password is : $password.\n
	Please click this link to activate your account:
	http://docreq.siteph.tech/confirmation.php?email=$email&hash=$emailCode";

        $to = $email;
        $from = $server_email;
        $headers = "From:" . $from;
      mail($to, $subject, $txt, $headers);

        $data = array("$mainUserNo" => $no, "fname" => $fname, "email" => $email, "contact" => $contact,
            "lname" => $lname, "mname" => $mname, "username" => $username, "password" => $password ,
            "address" => $address, "gender" => $gender, "status" => 'Inactive',  "emailCode" => $emailCode,"pic" => $pic, "age" => $age, "bday" => $bday, "created_at" => $dateTimeNow );
        $query = db_insert($tbl, $data);
        $message = "Information successfully save.";
        echo "<script type='text/javascript'>alert('$message');history.go(-1);</script>";
        break;

    case 'updateProfile':
        $lname = $_POST['lname'];
        $fname = $_POST['fname'];
        $role = $_POST['role'];

        $temp = $_FILES["pic"]["tmp_name"];
        $pic = $_FILES["pic"]["name"];
        move_uploaded_file($temp, "../../images/" . $role . '/' . $pic);
        if ($pic == "") {
            $pic = $_POST['pic1'];
            $_SESSION['pic'];
        }

        $_SESSION['pic'] =  $pic;

        $id = $_SESSION['user_id'];
        $where = array('id' => $id);
        $data = array('pic' => $pic, 'fname' => $fname, 'lname' => $lname);

        if ($user_role == $mainUser) {
            $query = db_update($tbl, $data, $where);
        } else {
            $query = db_update('tbl_users', $data, $where);
        }


        $_SESSION['name'] = $fname . ' ' . $lname;
        $message = "Profile successfully updated.";
        echo "<script type='text/javascript'>alert('$message');history.go(-1);</script>";
        break;

    case 'changePassword':
        $existpassword =$_SESSION['password'];
        $oldpassword = $_POST['oldpassword'];
        $newpassword = $_POST['newpassword'];
        $retypepassword = $_POST['retypepassword'];
        if ($existpassword <> $oldpassword) {
            $message = "Password not matched.";
            echo "<script type='text/javascript'>alert('$message');history.go(-1);</script>";
            exit();
        }

        if ($newpassword <> $retypepassword) {
            $message = "Retype password not matched.";
            echo "<script type='text/javascript'>alert('$message');history.go(-1);</script>";
            exit();
        }

        $data = array("password" => $newpassword);
        $where = array('id' => $_SESSION['user_id']);

        if ($user_role == $mainUser) {
            $query = db_update($tbl, $data, $where);
        } else {
            $query = db_update('tbl_users', $data, $where);
        }

        $_SESSION['password'] = $newpassword;
        $message = "Password successfully updated.";
        echo "<script type='text/javascript'>alert('$message');history.go(-1);</script>";
        break;

    case "login":
        $username = $_POST['username'];
        $password = ($_POST['password']);

        if(!isset($_POST['isCheck'])){ //If Not
            $tbl='tbl_users';
            $index='user';
        }else{
            $index='student';
        }

        $result = my_query("SELECT *,CONCAT(fname,' ',lname)fullname FROM $tbl  WHERE  username='$username'");
        if ($row = $result->fetch()) {
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['username'] = $row['username'];
            $_SESSION['password'] = $row['password'];

            $fullname = $row['fullname'];
            $_SESSION['name'] =$fullname;

            if(isset($_POST['isCheck'])) {
                $role = $mainUser;
                $_SESSION['section'] = $row['section'];
            }else{
                $role = $row['role'];
            }
            $_SESSION['role'] = $role;
            $_SESSION['pic'] = $row['pic'];

            if ($row['password'] == $password) {
               $dt= format_datetime(date('Y-m-d h:i:sa'));
                $message = "Date / Time : $dt \\n Successfully login as $role. \\n Welcome $fullname.";
                ualt("Login");

                if ($_SESSION['role'] == $user) {
                    header('Location: ' . '../profile.php');
                    exit();
                } elseif ($_SESSION['role'] == 'Parent') {
                    header('Location: ' . '../my-attendances.php'); // Redirect to my-attendances.php for Parents
                    exit();
                } else {
                    header('Location: ' . '../dashboards.php');
                    exit();
                }

            } else {
                echo "<script type='text/javascript'>window.location.href='../../$index.php?r=not';</script>";
                exit();
            }
        } else {
            $message = "Invalid user not existed.";
            echo "<script type='text/javascript'>window.location.href='../../$index.php?r=invalid';</script>";
        }

        break;

    case "forgotPassword":
        $email = $_POST['email'];
        $result = my_query("SELECT * FROM $tbl  WHERE email='$email'");
        if ($row = $result->fetch()) {

            $subject = "FROM :  $system_title New Account Created";
            $password = $row['password'];
            $txt = "Your username is : $email.\nYour new password is : $password.";

            $to = $email;
            $from = $server_email;
            $headers = "From:" . $from;
            mail($to, $subject, $txt, $headers);
            echo "<script type='text/javascript'>window.location.href='../../forgot-password.php?r=added';</script>";
        } else {
            echo "<script type='text/javascript'>window.location.href='../../forgot-password.php?r=invalid';</script>";
        }
        break;

}


?>


