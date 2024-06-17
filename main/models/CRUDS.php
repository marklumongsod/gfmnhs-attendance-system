<?php
require_once "../../config.php";
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;
// Include PHPMailer autoload file
$autoload_path = __DIR__ . '/../../vendor/autoload.php';
$exception_path = __DIR__ . '/../../vendor/phpmailer/phpmailer/src/Exception.php';
$phpmailer_path = __DIR__ . '/../../vendor/phpmailer/phpmailer/src/PHPMailer.php';
$smtp_path = __DIR__ . '/../../vendor/phpmailer/phpmailer/src/SMTP.php';

// Require the files using the constructed paths
require $autoload_path;
require $exception_path;
require $phpmailer_path;
require $smtp_path;




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
        $grade = $_POST['gr_yr'];
        $start = $_POST['start'];
        $end = $_POST['end'];
        $data = array("facId" => $facId, "grade"=>$grade,"subject" => $subject,"section" => $section,"start" => $start,"end" => $end, "classyr" => $_SESSION['classyr']);

        if (isset($_POST['id'])) {  //Update
            $id = $_POST['id'];
            $where = array('id' => $id);
            $query = db_update('tbl_class', $data, $where);
            $message= "Successfully Updated.";
          //  echo "<script type='text/javascript'>window.location.href='../class.php?r=updated';</script>";
            echo "<script type='text/javascript'>alert('$message');history.go(-1);</script>";  
        } else {


            if (isExists('tbl_class', $where = array("section" => $_POST['section'], "facId" => $facId)) == 1) {

                $message = "Class existed.";
                echo "<script type='text/javascript'>alert('$message');history.go(-1);</script>";
            } else {
                $query = db_insert('tbl_class', $data);
               // exit();
               $message= "Successfully Added.";
        echo "<script type='text/javascript'>alert('$message');history.go(-1);</script>";  
              //  echo "<script type='text/javascript'>window.location.href='../class.php?r=added';</script>";

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
        
        // Check if the mandatory fields section and gr_yr are present and not empty
        if ($_POST['section'] == "Select Section" || empty($_POST['gr_yr'])) {
            echo "<script>alert('Please provide both section and grade/year.'); window.location.href='../students.php';</script>";
            break; // Stop further execution if these fields are missing
        }

        $section = $_POST['section'];
        $gr_yr = $_POST['gr_yr'];

        // Handle the file upload and student image logic
        if ($_FILES["pic"]["name"] == "") {
            if (isset($_POST['id'])) {
                $pic = $_POST['pic1'];
            } else {
                $pic = 'default.png';
            }
        } else {
            $temp = $_FILES["pic"]["tmp_name"];
            $pic = $_FILES["pic"]["name"];
            
            // Validate the image type
            $valid_image_types = ['image/jpeg', 'image/png', 'image/gif'];
            $imageInfo = getimagesize($temp);
            
            if ($imageInfo && in_array($imageInfo['mime'], $valid_image_types)) {
                // It's a valid image, proceed with moving the file
                move_uploaded_file($temp, "../../images/student/" . $pic);
            } else {
                // Not a valid image
                echo "<script>alert('Invalid image file. Please upload JPEG, PNG, or GIF files only. Image set to default'); document.location.href = '/gfmnhs/main/students.php'; </script>";
                $pic = isset($_POST['pic1']) ? $_POST['pic1'] : 'default.png';
            }
        }

        // Collect other student details
        $studNo = $_POST['studNo'];
        $mname = $_POST['mname'];
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $email = $_POST['email'];
        $contact = $_POST['contact'];
        $address = $_POST['address'];
        $gender = $_POST['gender'];
        //parent data
        $plname = $_POST['plname'];
        $pfname = $_POST['pfname'];
        $pemail = $_POST['pemail'];

        // Credentials handling based on the presence of an id
        if (isset($_POST['id'])) {
            $username = $_POST['username'];
            $password = $_POST['password'];
            $status = $_POST['status'];
        } else {
            $username = $_POST['email']; // Assuming email as the username for new entries
            $password = $defaultPassword; // Assuming a default password is defined somewhere
            $pemail = $_POST['pemail'];
            $ppassowrd = $defaultPassword;
            $status = 'Active';
        }

        $bday = $_POST['bday'];
        $bdayDateTime = new DateTime($bday);
        $currentDateTime = new DateTime();
        $age = $currentDateTime->diff($bdayDateTime)->y;
        $data = array(
            "gender" => $gender, "studNo" => $studNo, "mname" => $mname, "fname" => $fname, 
            "lname" => $lname,  "status" => $status, "username" => $username, 
            "password" => $password, "pic" => $pic, "email" => $email, "contact" => $contact, 
            "address" => $address, "gr_yr" => $gr_yr, "section" => $section, "bday"=>$_POST['bday'], "age" => $age, "parent_email" => $pemail
        );

        $parent_data = array(
            "lname" => $plname, "fname" => $pfname, "password" => $ppassowrd, "role" => 'Parent', "username" => $pemail
        );
        
         // Function to send email notification
         function sendEmailNotification($parentEmail, $password) {
            global $parent_data;

            $mail = new PHPMailer(true);
            
            try {
                // Server settings
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = true;
                $mail->Username = 'orthomagic9@gmail.com';
                $mail->Password = 'rqlgfgtdubbkwrkb';
                $mail->SMTPSecure = 'tls';
                $mail->Port = 587;
                
                // Recipients
                $mail->setFrom('governor.ferer.memorial@gmail.com', 'GFM_NHS Admin');
                $mail->addAddress($parentEmail); // Parent's email

                // Content
                $mail->isHTML(true); 
                $mail->Subject = 'Your Account at Governor Ferrer Memorial National High School Has Been Created';
                $mail->Body = <<<EOT
                    <!DOCTYPE html>
                    <html lang="en">
                    <head>
                        <meta charset="UTF-8">
                        <meta name="viewport" content="width=device-width, initial-scale=1.0">
                        <title>Welcome to Governor Ferrer Memorial National High School</title>
                        <style>
                            body {
                                font-family: Arial, sans-serif;
                                line-height: 1.6;
                            }
                            .container {
                                max-width: 600px;
                                margin: 0 auto;
                                padding: 20px;
                                background-color: #f9f9f9;
                                border: 1px solid #ddd;
                                border-radius: 5px;
                            }
                            .header {
                                background-color: #007bff;
                                color: #fff;
                                padding: 10px;
                                text-align: center;
                                border-top-left-radius: 5px;
                                border-top-right-radius: 5px;
                            }
                            .content {
                                padding: 20px;
                            }
                            .footer {
                                margin-top: 20px;
                                text-align: center;
                                font-size: 0.8em;
                                color: #666;
                            }
                        </style>
                    </head>
                    <body>
                        <div class="container">
                            <div class="header">
                                <h2>Welcome to Governor Ferrer Memorial National High School</h2>
                            </div>
                            <div class="content">
                                <p>Dear Parent,</p>
                                <p>Congratulations! Your account at Governor Ferrer Memorial National High School has been successfully created. This account allows you to monitor the attendance and subjects of your child.</p>
                                <p><strong>Account Details:</strong></p>
                                <ul>
                                    <li><strong>Username:</strong> {$parent_data['username']}</li>
                                    <li><strong>Password:</strong> {$password}</li>
                                </ul>
                                <p>You can log in using the credentials above to view your child's attendance records, subjects, and other relevant information regarding their education at our school.</p>
                                <p>If you have any questions or encounter any issues, please don't hesitate to contact us.</p>
                                <p>Regards,<br>Admin<br>Governor Ferrer Memorial National High School</p>
                            </div>
                            <div class="footer">
                                <p>This is an automated message. Please do not reply.</p>
                            </div>
                        </div>
                    </body>
                    </html>
                EOT;

                $mail->send();
                echo 'Email message has been sent.';
            } catch (Exception $e) {
                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }
        }



        // Check if parent email already exists in tbl_users
        $check_query = "SELECT id FROM tbl_users WHERE username = '{$parent_data['username']}'";
        $check_result = $db->query($check_query);

        if ($check_result && $check_result->rowCount() > 0) {
            // Parent data already exists, handle accordingly (update or redirect)
            $parent_row = $check_result->fetch(PDO::FETCH_ASSOC);
            $parent_id = $parent_row['id'];

            // Update or insert student data based on the presence of an id
            if (isset($_POST['id'])) {
                $id = $_POST['id'];
                $where = array('id' => $id);
                $query = db_update('tbl_students', $data, $where); // Update student data

                if ($query) {
                    echo "<script type='text/javascript'>window.location.href='../students.php?r=updated';</script>";
                } else {
                    echo "<script>alert('Failed to update student record.'); window.location.href='../students.php';</script>";
                }
            } else {
                // Insert new student data since id is not set
                $query = db_insert('tbl_students', $data); 

                if ($query) {
                    echo "<script type='text/javascript'>window.location.href='../students.php?r=added';</script>";
                } else {
                    echo "<script>alert('Failed to insert student record.'); window.location.href='../students.php';</script>";
                }
            }
        } else {
            // Parent data does not exist, insert new parent and optionally student data
            $query_parent = db_insert('tbl_users', $parent_data); // Insert parent data

            if ($query_parent) {
                // Send email notification to the parent
                sendEmailNotification($parent_data['username'], $parent_data['password']);
                
                // After inserting parent data, optionally insert student data if id is set (indicating an update operation)
                if (isset($_POST['id'])) {
                    $id = $_POST['id'];
                    $where = array('id' => $id);
                    $query = db_update('tbl_students', $data, $where); // Update student data

                    if ($query) {
                        echo "<script type='text/javascript'>window.location.href='../students.php?r=updated';</script>";
                    } else {
                        echo "<script>alert('Failed to update student record.'); window.location.href='../students.php';</script>";
                    }
                } else {
                    // Insert new student data since id is not set
                    $query = db_insert('tbl_students', $data); 

                    if ($query) {
                        echo "<script type='text/javascript'>window.location.href='../students.php?r=added';</script>";
                    } else {
                        echo "<script>alert('Failed to insert student record.'); window.location.href='../students.php';</script>";
                    }
                }
            } else {
                echo "<script>alert('Failed to insert parent record.'); window.location.href='../students.php';</script>";
            }
        }

       
        break;

    case 'deleteStudent':
        $id = $_POST['id'];
        $where = array('id' => $id);
        $query = db_delete('tbl_students', $where);
        echo "<script type='text/javascript'>window.location.href='../students.php?r=deleted';</script>";
        break;

    // case 'deleteStudent':
    //     $id = $_POST['id'];
    
    //     $student_email_query = my_query("SELECT parent_email FROM tbl_students WHERE id = '$id'");
    //     $student_email_row = $student_email_query->fetch(PDO::FETCH_ASSOC);
    //     $parent_email = $student_email_row['parent_email'];
    
    //     $where_parent = array('username' => $parent_email, 'role' => 'Parent');
    //     $query_parent_delete = db_delete('tbl_users', $where_parent);
    
    //     $where_student = array('id' => $id);
    //     $query_student_delete = db_delete('tbl_students', $where_student);
    
    //     echo "<script type='text/javascript'>window.location.href='../students.php?r=deleted';</script>";
    //     break;

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
        $adviser = $_POST['adviser'];
        $data = array("category" => $category, "value" => $value
        , "sub_value" => $sub_value , "adviser" => $adviser);

        if (isset($_POST['id'])) {  //Update
            $id = $_POST['id'];
            $where = array('id' => $id);
            $query = db_update('tbl_settings_constants', $data, $where);
            if($category=='Section'){
                
                echo "<script type='text/javascript'>window.location.href='../section.php?r=added';</script>";
                }else{
                    echo "<script type='text/javascript'>window.location.href='../constants.php?r=updated';</script>";
                }
        } else {
            $query = db_insert('tbl_settings_constants', $data);
            if($category=='Section'){
            
            echo "<script type='text/javascript'>window.location.href='../section.php?r=added';</script>";
            }else{
                echo "<script type='text/javascript'>window.location.href='../constants.php?r=added';</script>";
            }
        }
        break;

    case "deleteConstant" :
        $id = $_POST['id'];
        $where = array('id' => $id);
        $query = db_delete('tbl_settings_constants', $where);
        echo "<script type='text/javascript'>window.location.href='../constants.php?r=deleted';</script>";
        break;


} ?>