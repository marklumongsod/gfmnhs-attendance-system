<?php
include_once('layout/head.php');
session_start();

if (isset($_GET['classInfo'])) {
    $_SESSION['classInfo'] = $_GET['classInfo'];
}

if (isset($_GET['classId'])) {
    $_SESSION['classId'] = $_GET['classId'];
}

if (isset($_GET['dt'])) {
    $_SESSION['dt'] = $_GET['dt'];
} else {
    $_SESSION['dt'] = $dateNow;
}

$grade = isset($_GET['grade']) ? $_GET['grade'] : '';
$section = isset($_GET['section']) ? $_GET['section'] : '';
$classId = isset($_GET['classId']) ? $_GET['classId'] : '';

$result_students = my_query("SELECT * FROM tbl_students WHERE gr_yr='$grade' AND section='$section'");
while ($row = $result_students->fetch()) {
    $studId = $row['id'];
    db_insert('tbl_classstudent', ['classId' => $classId, 'studId' => $studId]);
}

$result_teacher = my_query("SELECT *, CONCAT(fname, ' ', lname) AS name FROM tbl_class c INNER JOIN tbl_users u ON u.id=c.facId WHERE c.id='$classId'");
if ($row = $result_teacher->fetch()) {
    $teacher = $row['name'];
    $sub = $row['subject'];
    $gs = $row['grade'] . ' - ' . $row['section'];
}

$result_male = my_query("SELECT *, CONCAT(lname, ', ', fname) AS studentM, cc.id AS id 
                    FROM tbl_classstudent cc 
                    INNER JOIN tbl_students u ON u.id=cc.studId 
                    INNER JOIN tbl_class c ON cc.classId=c.id 
                    WHERE classId='$classId' AND gender='Male' 
                    ORDER BY u.lname ASC");

$result_female = my_query("SELECT *, CONCAT(lname, ', ', fname) AS studentF, cc.id AS id 
                    FROM tbl_classstudent cc 
                    INNER JOIN tbl_students u ON u.id=cc.studId 
                    INNER JOIN tbl_class c ON cc.classId=c.id 
                    WHERE classId='$classId' AND gender='Female' 
                    ORDER BY u.lname ASC");

$_SESSION['print_data'] = array();

while ($row = $result_male->fetch()) {
    $_SESSION['print_data'][] = $row;
}

while ($row = $result_female->fetch()) {
    $_SESSION['print_data'][] = $row;
}

$_SESSION['print_data']['teacher'] = $teacher;
$_SESSION['print_data']['subject'] = $sub;
$_SESSION['print_data']['grade_section'] = $gs;
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Attendance List</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 800px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f4f4f4;
        }

        .hide-on-screen {
            display: none;
        }

        .header-row {
            background-color: #e9e9e9;
            font-weight: bold;
        }

        .on-time {
            color: green;
        }

        .absent {
            color: red;
        }

        .late {
            color: orange;
        }

        .logo-and-text-container {
            display: flex;
            align-items: center;
        }

        .text-content {
            margin: 0 auto;
            text-align: center;
        }

        .logo {
            margin: 0 20px;
        }

        .logo img {
            max-width: 100px;
            height: auto;
        }

        .btn {
            padding: 10px 20px;
            background-color: #007bff;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-size: 16px;
            display: inline-block;
            transition: background-color 0.3s;
        }

        .btn:hover {
            background-color: #0056b3;
        }

        @media print {
            body {
                margin: 0;
                padding: 0;
                font-family: Arial, sans-serif;
            }

            .container {
                padding: 0;
                margin: 0;
            }

            .hide-on-screen {
                display: flex;
                justify-content: center;
            }

            .header,
            .footer {
                display: none;
            }

            th,
            td {
                border: 1px solid #ddd !important;
                padding: 8px !important;
                text-align: left !important;
            }

            th {
                background-color: #f4f4f4 !important;
            }

            .alert {
                display: none;
            }

            .btn {
                display: none;
            }

            .logo-and-text-container {
                justify-content: center;
            }

            .logo {
                margin: 0;
            }

            .text-content {
                text-align: center;
            }

            .hide-footer {
                display: none;
            }

            .head-content {
                display: none;
            }

            .hide-on-print {
                display: none;
            }

            .header-row th,
            .header-row td {
                font-size: 14px;
            }

            .sidebar,
            .user-info,
            .menu {
                display: none;
            }
        }
    </style>
</head>

<body>

    <section class="content">
        <div class="container-fluid">

            <?php
            if (isset($_POST['teachername'])) {
                $_SESSION['teachername'] = $_POST['teachername'];
                echo "<script type='text/javascript'> history.go(-1);</script>";
            }

            ?>

            <div id="printableArea1">
                <div class="row clearfix">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="card">
                            <div class="header">
                                <a class="box-title"> <?php if (isset($_GET['r'])) : ?>
                                        <?php
                                                            $r = $_GET['r'];
                                                            if ($r == 'added') {
                                                                $classs = 'success';
                                                            } else if ($r == 'updated') {
                                                                $classs = 'warning';
                                                            } else if ($r == 'deleted') {
                                                                $classs = 'danger';
                                                            } else {
                                                                $classs = 'hide';
                                                            }
                                        ?>
                                        <div class="alert alert-dismissible alert-<?php echo $classs ?> <?php echo $classs; ?>">
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">×</span></button>
                                            <strong>Successfully <?php echo $r; ?>!</strong>
                                        </div>
                                    <?php endif; ?>
                                </a>


                                <?php if ($_SESSION['role'] == 'Teacher') { ?>
                                    <a href="printview-masterlist.php" class="btn right btn-warning  waves-effect waves-light yellow darken-4">
                                        <i class="material-icons">add</i>PRINT </a>

                                <?php } else { ?>


                                    <a href="printview-masterlist.php" class="btn right btn-warning  waves-effect waves-light yellow darken-4">
                                        <i class="material-icons">print</i>PRINT VIEW </a>
                                <?php } ?>


                                <h2>
                                    MASTERLIST

                                    <?php
                                    $grade = $_GET['grade'];
                                    $section = $_GET['section'];
                                    $id = 1;
                                    $result = my_query("SELECT *  FROM tbl_students WHERE gr_yr='$grade' AND section='$section'  ");
                                    for ($i = 1; $row = $result->fetch(); $i++) {

                                        $studId = $row['id'];
                                        $classId = $_GET['classId'];
                                        db_insert('tbl_classstudent', ['classId' => $classId, 'studId' => $studId]);
                                    }

                                    ?>

                                    <?php $classId = $_SESSION['classId'];
                                    $result = my_query("SELECT *,CONCAT(fname, ' ', lname)name FROM tbl_class c  INNER JOIN tbl_users u ON u.id=c.facId WHERE  c.id='$classId'");
                                    if ($row = $result->fetch()) {
                                        $teacher = $row['name'];
                                        $sub = $row['subject'];
                                        $gs = $row['grade'] . ' - ' . $row['section'];
                                    }
                                    ?>

                                </h2>

                            </div>
                            <br />
                            <div id="printableArea" class="body">
                                <div class="hide-on-screen">
                                    <div class="centered-content">
                                        <div class="logo-and-text-container">
                                            <div class="logo">
                                                <img src="../images/image1.png" alt="Logo">
                                            </div>
                                            <div class="text-content">
                                                <div>
                                                    <h4>Republic of the Philippines</h4>
                                                    <h3>Department of Education</h3>
                                                    <h4>Region IV-A CALABARZON</h4>
                                                    <div><b>DIVISION OF GENERAL TRIAS</b></div>
                                                    <b>GOVERNOR FERRER MEMORIAL NATIONAL HIGH SCHOOL BICLATAN ANNEX</b>
                                                    <b>Brgy. Biclatan, General Trias City, Cavite</b>
                                                </div>
                                            </div>
                                            <div class="logo">
                                                <img src="../images/image2.png" alt="Logo" width="600">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="">
                                    <br />
                                    Teacher : <?= $teacher; ?> <br />
                                    Subject : <?= $sub; ?> <br />
                                    Gr & Section : <?= $gs; ?>
                                    <br />
                                    <h4> MALE</h4>
                                    <table class="table-bordered table-striped table-hover">
                                        <thead>
                                            <tr>
                                                <th width="30px">#</th>
                                                <th width="500px">Student</th>
                                                <th width="500px">LRN</th>
                                                <?php if ($_SESSION['role'] == 'Admin') { ?>
                                                    <th>Action</th>
                                                <?php } ?>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $sec = $_GET['section'];
                                            $gryr = $_GET['grade'];
                                            $classId = $_GET['classId'];
                                            $ids = 1;
                                            $result = my_query("SELECT *, CONCAT(lname,', ',fname) AS student, cc.id AS id 
                            FROM tbl_classstudent cc 
                            INNER JOIN tbl_students u ON u.id=cc.studId 
                            INNER JOIN tbl_class c ON cc.classId=c.id 
                            WHERE classId='$classId' AND gender='Male' 
                            ORDER BY u.lname ASC");


                                            if ($result && $result->rowCount() > 0) {

                                                while ($row = $result->fetch()) {
                                                    $id = $row['id'];
                                            ?>
                                                    <tr>
                                                        <td><?= ($ids++); ?></td>
                                                        <td><?= $row['student']; ?></td>
                                                        <td><?= $row['studNo']; ?></td>

                                                        <?php if ($_SESSION['role'] == 'Admin') { ?>
                                                            <td>
                                                                <a class="btn right btn-danger waves-effect waves-light yellow darken-4 col s12" data-toggle="modal" data-target="#delete<?= $id; ?>">
                                                                    <i class="material-icons">delete_forever</i>Delete
                                                                </a>
                                                            </td>
                                                        <?php } ?>
                                                    </tr>
                                            <?php
                                                }
                                            } else {
                                                echo '<tr><td colspan="6">No data available</td></tr>';
                                            }
                                            ?>
                                        </tbody>
                                    </table>


                                    <br />
                                    <h4> FEMALE</h4>

                                    <table class="table-bordered table-striped table-hover">
                                        <thead>
                                            <tr>
                                                <th width="30px">#</th>
                                                <th width="500px">Student</th>
                                                <th width="500px">LRN</th>
                                                <?php if ($_SESSION['role'] == 'Admin') { ?>
                                                    <th>Action</th>
                                                <?php } ?>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $sec = $_GET['section'];
                                            $gryr = $_GET['grade'];
                                            $classId = $_GET['classId'];
                                            $ids = 1;
                                            $result = my_query("SELECT *,CONCAT(lname,', ',fname)student ,cc.id id 
                            FROM tbl_classstudent cc 
                            INNER JOIN tbl_students u ON u.id=cc.studId 
                            INNER JOIN tbl_class c ON cc.classId=c.id 
                            WHERE classId='$classId' AND gender='Female' 
                            ORDER BY u.lname ASC");

                                            if ($result && $result->rowCount() > 0) {
                                                while ($row = $result->fetch()) {
                                                    $id = $row['id'];
                                            ?>
                                                    <tr>
                                                        <td><?= $ids++; ?></td>
                                                        <td><?= $row['student']; ?></td>
                                                        <td><?= $row['studNo']; ?></td>
                                                        <?php if ($_SESSION['role'] == 'Admin') { ?>
                                                            <td>
                                                                <a class="btn right btn-danger waves-effect waves-light yellow darken-4 col s12" data-toggle="modal" data-target="#delete<?= $id; ?>">
                                                                    <i class="material-icons">delete_forever</i>Delete
                                                                </a>
                                                            </td>
                                                        <?php } ?>
                                                    </tr>
                                            <?php
                                                }
                                            } else {
                                                echo "<tr><td colspan='4'>No data available</td></tr>";
                                            }
                                            ?>
                                        </tbody>
                                    </table>



                                    <br /><br /><br />

                                    <?php
                                    $classId = $_SESSION['classId'];
                                    $xdate = $_SESSION['dt'];
                                    $dt = "";
                                    if (isset($_GET['dt'])) {
                                        $date = $_GET['dt'];
                                        $dt = " AND xdate='$date'";
                                    }
                                    $id = 1;
                                    $result = my_query("SELECT * 
                                    FROM tbl_settings_constants AS settings
                                    JOIN tbl_class AS class ON settings.sub_value = class.grade AND settings.value = class.section
                                    WHERE class.id = $classId");

                                    $data = $result->fetch();

                                    if (isset($data['adviser']) && !empty($data['adviser'])) {
                                        echo "<div style='margin-top: 20px;'>";
                                        // echo "<hr style='border: none; border-top: 1px solid #000; margin-bottom: 30px;'>";
                                        echo "<div style='text-align: right; font-weight: bold; padding-right: 50px'>" . htmlspecialchars($data['adviser']) . "</div>";
                                        echo "<div style='text-align: right;'>__________________________</div>";
                                        echo "<div style='text-align: right; font-weight: bold; padding-right: 60px;'>Adviser</div>";
                                        echo "</div>";
                                    }
                                    ?>
                                    <!-- <?= addSpace(3); ?>    __<u><?= $teacher; ?></u>___ <br/> -->
                                    <!-- <form action="" method="POST">
                                        <input type='text' name="teachername" value="<?= (isset($_SESSION['teachername']) ? $_SESSION['teachername']  : '');  ?> " width="450px"> <br />

                                        <?= addSpace(12); ?> ADVISER
                                    </form> -->

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </section>


    <!--==================================== ADD,EDIT,DELETE Dialogs ====================================== -->
    <!-- Add -->

    <div class="modal fade" id="add" tabindex="-1" role="dialog">
        <div class="modal-dialog  modal-smd" role="document">
            <div class="modal-content">

                <form action="models/CRUDS.php" method="POST" enctype="multipart/form-data">
                    <div class="modal-header">
                        <h4 class="modal-title" id="defaultModalLabel">Add Student
                        </h4>

                    </div>
                    <div class="modal-body">

                        <input type="hidden" name="classId" value="<?= $_GET['classId']; ?>">
                        <input type="hidden" name="section" value="<?= $sec = $_GET['section']; ?>">
                        <div class="col-md-12">
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <select name="studId" class="form-control select" required>
                                        <option></option>
                                        <?php $classId = $_GET['classId'];
                                        $res = my_query("SELECT CONCAT(fname,' ',lname)student,tbl_students.id as sid FROM tbl_students
                                     WHERE    section='$sec' AND gr_yr='$gryr' AND  id NOT IN(SELECT studId FROM tbl_classstudent WHERE classId='$classId' )");
                                        for ($i = 1; $r = $res->fetch(); $i++) {
                                            $id = $r['sid']; ?>
                                            <option value="<?= $id; ?>"><?= $r['student']; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="submit" value="addStudClass" name="func_param" class="btn btn-primary waves-effect">
                            SAVE
                        </button>
                        <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">CLOSE</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <?php
    $result = my_query("SELECT *,CONCAT(fname,' ',lname)student ,cc.id id FROM tbl_classstudent cc INNER JOIN tbl_students u ON u.id=cc.studId INNER JOIN tbl_class c ON cc.classId=c.id ORDER BY cc.id DESC ");
    for ($i = 1; $row = $result->fetch(); $i++) {
        $id = $row['id']; ?>
        <!-- Delete -->
        <div class="modal fade" id="delete<?= $id; ?>" tabindex="-1" role="dialog">
            <div class="modal-dialog  modal-smd" role="document">
                <div class="modal-content">
                    <form action="models/CRUDS.php" method="POST">
                        <div class="modal-body">
                            <input value="<?= $row['id']; ?>" name="id" type="hidden" class="form-control" required>
                            <div class="col-md-12" style="text-align: center;">
                                <h4>Are you sure you want to
                                    delete <br /> (<i><b>
                                            <a data-dismiss="modal" class="call_info" data-id="
            asd" type="button" data-toggle="modal" data-target="#edit<?= $id; ?>" style="color: red" id="removeNo"> <?= $row['student'] . '-' . $row['section'] . '/' . $row['subject']; ?></a></b></i>
                                    ) information? <br />There is NO undo! </h4>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" value="deleteStudClass" name="func_param" class="btn btn-danger waves-effect">
                                DELETE
                            </button>
                            <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">CLOSE</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    <?php } ?>



    <?php include_once('layout/footer.php'); ?>