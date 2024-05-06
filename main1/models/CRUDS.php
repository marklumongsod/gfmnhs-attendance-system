<?php
require_once "../../config.php";
$function = $_POST['func_param'];

switch ($function) {


    //Attendances
    case "addAttendance" :

        $updated_at=NULL;
        if (isset($_POST['id'])) {
            $updated_at= $_POST['updated_at'];
        }

        $data = array("stud_id" => $_POST['student_id'], "xdate" => $_POST['xdate'],"xtime" => $_POST['xtime'],"status" => $_POST['status'] );
 
            $query = db_insert('tbl_inout', $data);
            
            
            $query = db_update('tbl_students', ['logStatus'=>$_POST['status']], ['id'=>$_POST['student_id']]);
            echo "<script type='text/javascript'>window.location.href='../inout.php?r=added';</script>";
       
        break;

    case "deleteAttendance" :
        $id = $_POST['id'];
        $where = array('id' => $id);
        $query = db_delete('tbl_attendances', $where);
        echo "<script type='text/javascript'>window.location.href='../attendances.php?r=deleted';</script>";
        break;



    //Attendances
    case "IUAttendance" :

        $updated_at=NULL;
        if (isset($_POST['id'])) {
            $updated_at= $_POST['updated_at'];
        }

        $data = array("student_id" => $_POST['student_id'], "time_in" => $_POST['time_in'],"time_out" => $_POST['time_out'],"updated_at" => $updated_at );

        if (isset($_POST['id'])) {  //Update
            $id = $_POST['id'];
            $where = array('id' => $id);
            $query = db_update('tbl_attendances', $data, $where);
            echo "<script type='text/javascript'>window.location.href='../attendances.php?r=updated';</script>";
        } else {
            $query = db_insert('tbl_attendances', $data);
            echo "<script type='text/javascript'>window.location.href='../attendances.php?r=added';</script>";
        }
        break;

    case "deleteAttendance" :
        $id = $_POST['id'];
        $where = array('id' => $id);
        $query = db_delete('tbl_attendances', $where);
        echo "<script type='text/javascript'>window.location.href='../attendances.php?r=deleted';</script>";
        break;




//Class
    case "IUClass" :
        $facId = $_POST['facId'];
        $subject = $_POST['subject'];
        $section = $_POST['section'];
        // $start = $_POST['start'];
        // $end = $_POST['end'];
        $data = array("facId" => $facId, "section" => $section,"subject" => $subject, "classyr" => $_SESSION['classyr']);

        if (isset($_POST['id'])) {  //Update
            $id = $_POST['id'];
            $where = array('id' => $id);
            $query = db_update('tbl_class', $data, $where);
            echo "<script type='text/javascript'>window.location.href='../class.php?r=updated';</script>";
        } else {


            if (isExists('tbl_class', $where = array("section" => $_POST['section'], "facId" => $facId)) == 1) {

                $message = "Class existed.";
                echo "<script type='text/javascript'>alert('$message');history.go(-1);</script>";
            } else {
                $query = db_insert('tbl_class', $data);
                echo "<script type='text/javascript'>window.location.href='../class.php?r=added';</script>";

            }
        }
        break;

    case 'addStudClass':
        $classId = $_POST['classId'];
        $studId = $_POST['studId'];
        $section = $_POST['section'];
        $data = array("classId" => $classId, "studId" => $studId);
        $query = db_insert('tbl_classstudent', $data);
        $query = db_update('tbl_students', $data = array("section" => $section), $where = array("id" => $studId));
        $message = "Successfully added.";
        echo "<script type='text/javascript'>alert('$message');history.go(-1);</script>";
        break;

    case 'deleteStudClass':
        $id = $_POST['id'];
        $where = array('id' => $id);
        $query = db_delete('tbl_classstudent', $where);
        $message = "Successfully deleted.";
        echo "<script type='text/javascript'>alert('$message');history.go(-1);</script>";
        //echo "<script type='text/javascript'>window.location.href='../studclass.php?r=deleted';</script>";
        break;


    case 'deleteClass':
        $id = $_POST['id'];
        $where = array('id' => $id);
        $query = db_delete('tbl_class', $where);
        echo "<script type='text/javascript'>window.location.href='../class.php?r=deleted';</script>";
        break;

    //EndClass

//User
    case "IUUser" :
        if (isset($_POST['id'])) {
            $temp = $_FILES["pic"]["tmp_name"];
            $pic = $_FILES["pic"]["name"];
            move_uploaded_file($temp, "../../images/user/" . $pic);
        } else {
            $pic = 'default.png';
        }

        $role = $_POST['role'];
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $username = $_POST['username'];
        $password = (isset($_POST['password']) ? $_POST['password'] : $defaultPassword);
        $data = array("fname" => $fname, "lname" => $lname, "role" => $role, "username" => $username, "password" => $password, "pic" => $pic);

        if (isset($_POST['id'])) {  //Update
            $id = $_POST['id'];
            $where = array('id' => $id);
            $query = db_update('tbl_users', $data, $where);
            echo "<script type='text/javascript'>window.location.href='../users.php?r=updated';</script>";
        } else {
            $query = db_insert('tbl_users', $data);
            echo "<script type='text/javascript'>window.location.href='../users.php?r=added';</script>";
        }
        break;

    case 'deleteUser':
        $id = $_POST['id'];
        $where = array('id' => $id);
        $data = array('status' => 'Deleted');
        $query = db_update('tbl_users', $data, $where);
        echo "<script type='text/javascript'>window.location.href='../users.php?r=deleted';</script>";
        break;


    //Student
    case "IUStudent" :

        if ($_FILES["pic"]["name"] == "") {
            if (isset($_POST['id'])) {
                $pic = $_POST['pic1'];
            } else {
                $pic = 'default.png';
            }
        } else {
            $temp = $_FILES["pic"]["tmp_name"];
            $pic = $_FILES["pic"]["name"];
            move_uploaded_file($temp, "../../images/student/" . $pic);
        }


        $studNo = $_POST['studNo'];
        $mname = $_POST['mname'];
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $email = $_POST['email'];
        $contact = $_POST['contact'];
        $address = $_POST['address'];
        $gender = $_POST['gender'];

        if (isset($_POST['id'])) {
            $username = $_POST['username'];
            $password = $_POST['password'];
            $status = $_POST['status'];
        } else {
            $username = $_POST['email'];
            $password = $defaultPassword;
            $status = 'Active';
        }

        $data = array("gender" => $gender, "studNo" => $studNo, "mname" => $mname, "fname" => $fname, "lname" => $lname,  "status" => $status,
            "username" => $username, "password" => $password, "pic" => $pic, "email" => $email, "contact" => $contact, "address" => $address);

        if (isset($_POST['id'])) {  //Update
            $id = $_POST['id'];
            $where = array('id' => $id);
            $query = db_update('tbl_students', $data, $where);
             echo "<script type='text/javascript'>window.location.href='../students.php?r=updated';</script>";
        } else {
            $query = db_insert('tbl_students', $data);
         echo "<script type='text/javascript'>window.location.href='../students.php?r=added';</script>";
        }
        break;

    case 'deleteStudent':
        $id = $_POST['id'];
        $where = array('id' => $id);
        $query = db_delete('tbl_students', $where);
        echo "<script type='text/javascript'>window.location.href='../students.php?r=deleted';</script>";
        break;



    case "update" . $mainUser . "Profile" :

        $regNo = $_POST['regNo'];
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $mname = $_POST['mname'];
        $email = $_POST['email'];
        $contact = $_POST['contact'];
        $address = $_POST['address'];
        $gender = $_POST['gender'];
        $age = $_POST['age'];
        $bday = $_POST['bday'];

        //  `xagree`, `username`, `password`, `pic`, `status`,

        $data = array("regNo" => $regNo, "fname" => $fname, "lname" => $lname, "mname" => $mname,
            "email" => $email, "contact" => $contact, "address" => $address, "gender" => $gender, "age" => $age, "bday" => $bday);
        $id = $_POST['id'];
        $query = db_update($tbl, $data, ['id' => $id]);
        echo "<script type='text/javascript'>window.location.href='../profile.php?r=updated&id=$id';</script>";
        break;

    //Announcement
    case 'IUAnnouncement':
        $added_by = $_SESSION['user_id'];
        $temp = $_FILES["pic"]["tmp_name"];
        $pic = $_FILES["pic"]["name"];
        move_uploaded_file($temp, "../../images/ann/" . $pic);

        $title = $_POST['title'];
        $description = $_POST['description'];
        $xdt = $_POST['xdt'];
        $xtime = $_POST['xtime'];

        if ($pic == "") {
            $pic = $_POST['pic1'];
        }

        $data = array("added_by" => $added_by, "pic" => $pic, "title" => $title, "description" => $description, "xdt" => $xdt, "xtime" => $xtime);

        if (isset($_POST['id'])) {  //Update
            $where = array('id' => $_POST['id']);
            $query = db_update('tbl_announcements', $data, $where);
            echo "<script type='text/javascript'>window.location.href='../announcements.php?r=updated';</script>";
        } else {
            $query = db_insert('tbl_announcements', $data);
            echo "<script type='text/javascript'>window.location.href='../announcements.php?r=added';</script>";
        }
        break;

    case 'deleteAnnouncement':
        $id = $_POST['id'];
        $where = array('id' => $id);
        $query = db_delete('tbl_announcements', $where);

        $message = "Information successfully deleted.";
        echo "<script type='text/javascript'>window.location.href='../announcements.php?r=deleted';</script>";
        break;

    //Constant
    case "IUConstant" :
        $category = $_POST['category'];
        $value = $_POST['value'];
        $sub_value = $_POST['sub_value'];
        $data = array("category" => $category, "value" => $value
        , "sub_value" => $sub_value);

        if (isset($_POST['id'])) {  //Update
            $id = $_POST['id'];
            $where = array('id' => $id);
            $query = db_update('tbl_settings_constants', $data, $where);
            echo "<script type='text/javascript'>window.location.href='../constants.php?r=updated';</script>";
        } else {
            $query = db_insert('tbl_settings_constants', $data);
            echo "<script type='text/javascript'>window.location.href='../constants.php?r=added';</script>";
        }
        break;

    case "deleteConstant" :
        $id = $_POST['id'];
        $where = array('id' => $id);
        $query = db_delete('tbl_settings_constants', $where);
        echo "<script type='text/javascript'>window.location.href='../constants.php?r=deleted';</script>";
        break;


} ?>