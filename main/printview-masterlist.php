<?php
session_start();
include_once('../config.php');

if (!isset($_SESSION['user_id'])) {
    $message = "Please login first.";
    echo "<script type='text/javascript'>window.location.href='../index.php';</script>";
    exit;
}

$print_data = isset($_SESSION['print_data']) ? $_SESSION['print_data'] : [];

$grade = isset($_GET['grade']) ? $_GET['grade'] : '';
$section = isset($_GET['section']) ? $_GET['section'] : '';
$classId = isset($_GET['classId']) ? $_GET['classId'] : '';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Attendance List</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #fff;
            color: #333;
        }

        .container {
            max-width: 800px;
            margin: auto;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
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

        .header-row {
            background-color: #e9e9e9;
            font-weight: bold;
        }

        .logo-and-text-container {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        .text-content {
            text-align: center;
            flex-grow: 1;
        }

        p {
            margin-top: 0;
            padding-top: 0;
        }

        .logo img {
            height: 80px;
        }

        .btn {
            padding: 10px 20px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
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
                max-width: 800px;
                margin: auto;
                padding: 20px;
                box-shadow: 0 0 0px rgba(0, 0, 0, 0);
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
        <div class="container">
            <div class="logo-and-text-container">
                <div class="logo">
                    <img src="../images/image1.png" alt="Logo">
                </div>
                <div class="text-content">
                    <b>Republic of the Philippines</b><br>
                    <b>Department of Education</b><br>
                    <b>Region IV-A CALABARZON</b><br>
                    <b>DIVISION OF GENERAL TRIAS</b><br>
                    <b>GOVERNOR FERRER MEMORIAL NATIONAL <br> HIGH SCHOOL BICLATAN ANNEX</b><br>
                    <p>Brgy. Biclatan, General Trias City, Cavite</p>
                </div>
                <div class="logo">
                    <img src="../images/image2.png" alt="Logo">
                </div>
            </div>
            <h2 style="text-align: center;">
                MASTERLIST
            </h2>

            <div class="">
                <br />
                <?php if (isset($print_data['teacher'])) : ?>
                    Teacher: <?= $print_data['teacher']; ?> <br />
                <?php endif; ?>
                <?php if (isset($print_data['subject'])) : ?>
                    Subject: <?= $print_data['subject']; ?> <br />
                <?php endif; ?>
                <?php if (isset($print_data['grade_section'])) : ?>
                    Gr & Section: <?= $print_data['grade_section']; ?>
                <?php endif; ?>
                <br />
                <h4> MALE</h4>
                <table class="table-bordered table-striped table-hover">
                    <?php
                    $id = 1;
                    $classId = $_SESSION['classId'];
                    $result_male = my_query("SELECT *, CONCAT(lname,', ',fname) AS student, cc.id AS id 
                            FROM tbl_classstudent cc 
                            INNER JOIN tbl_students u ON u.id=cc.studId 
                            INNER JOIN tbl_class c ON cc.classId=c.id 
                            WHERE classId='$classId' AND gender='Male' 
                            ORDER BY u.lname ASC");

                    if ($result_male) {
                        if ($result_male->rowCount() > 0) {
                    ?>
                            <thead>
                                <tr>
                                    <th width="30px">#</th>
                                    <th width="500px">Student</th>
                                    <th width="500px">LRN</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while ($row = $result_male->fetch()) : ?>
                                    <tr>
                                        <td><?= htmlspecialchars($id++); ?></td>
                                        <td><?= htmlspecialchars($row['student']); ?></td>
                                        <td><?= htmlspecialchars($row['studNo']); ?></td>
                                    </tr>
                                <?php endwhile; ?>
                            </tbody>
                    <?php
                        } else {
                            echo "<thead><tr><th width='500px'>Student</th><th width='500px'>LRN</th></tr></thead>";
                            echo "<tbody><tr><td colspan='2'>No data available</td></tr></tbody>";
                        }
                    } else {
                        echo "<thead><tr><th width='500px'>Student</th><th width='500px'>LRN</th></tr></thead>";
                        echo "<tbody><tr><td colspan='2'>No data available</td></tr></tbody>";
                    }
                    ?>
                </table>



                <br />
                <h4> FEMALE</h4>

                <table class="table-bordered table-striped table-hover">
                    <?php
                    $classId = $_SESSION['classId'];
                    if (!empty($print_data)) {
                        $result_female = my_query("SELECT *, CONCAT(lname, ', ', fname) AS studentF, cc.id AS id 
                    FROM tbl_classstudent cc 
                    INNER JOIN tbl_students u ON u.id=cc.studId 
                    INNER JOIN tbl_class c ON cc.classId=c.id 
                    WHERE classId='$classId' AND gender='Female' 
                    ORDER BY u.lname ASC");

                        if ($result_female) {
                            if ($result_female->rowCount() > 0) {
                    ?>
                                <thead>
                                    <tr>
                                        <th width="30px">#</th>
                                        <th width="500px">Student</th>
                                        <th width="500px">LRN</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $id = 1;
                                    while ($row = $result_female->fetch()) : ?>
                                        <tr>
                                            <td><?= htmlspecialchars($id++); ?></td>
                                            <td><?= htmlspecialchars($row['studentF']); ?></td>
                                            <td><?= htmlspecialchars($row['studNo']); ?></td>
                                        </tr>
                                    <?php endwhile; ?>
                                </tbody>
                    <?php
                            } else {
                                echo "<thead><tr><th width='500px'>Student</th><th width='500px'>LRN</th></tr></thead>";
                                echo "<tbody><tr><td colspan='2'>No data available</td></tr></tbody>";
                            }
                        } else {
                            echo "<thead><tr><th width='500px'>Student</th><th width='500px'>LRN</th></tr></thead>";
                            echo "<tbody><tr><td colspan='2'>No data available</td></tr></tbody>";
                        }
                    }
                    ?>
                </table>



                <br>
                <br>
                <br>
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

            </div>

            <button onclick="window.print();" class="btn btn-primary">PRINT</button>
        </div>
    </section>
</body>

</html>