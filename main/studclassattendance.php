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

$classId = $_SESSION['classId'];
$xdate = $_SESSION['dt'];
$dt = "";
if (isset($_GET['dt'])) {
    $date = $_GET['dt'];
    $dt = " AND xdate='$date'";
}
$id = 1;
$result = my_query("SELECT *,
                                                CONCAT(stud.fname, ' ', stud.lname) AS student,
                                                in_out.id AS id,
                                                in_out.status, in_out.xtime, stud.studNo
                                                FROM tbl_inout AS in_out    
                                                INNER JOIN tbl_students AS stud ON stud.id = in_out.stud_id  
                                                INNER JOIN tbl_class AS class ON class.id = in_out.classId
                                                INNER JOIN tbl_users AS user ON user.id = class.facId
                                                INNER JOIN tbl_settings_constants AS settings ON settings.value = class.section AND settings.sub_value = class.grade
                                                WHERE in_out.classId='$classId' $dt  GROUP BY stud_id,classId,xdate
                                                ORDER BY in_out.id DESC");

$_SESSION['print_data'] = array(); 

while ($row = $result->fetch()) {
    $_SESSION['print_data'][] = $row;
}


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

            <div>
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
                                    <a href="printview.php" class="btn right btn-warning  waves-effect waves-light yellow darken-4">
                                        <i class="material-icons">add</i>PRINT </a>

                                <?php } else { ?>


                                    <a href="printview.php" class="btn right btn-warning  waves-effect waves-light yellow darken-4">
                                        <i class="material-icons">print</i>PRINT VIEW </a>
                                <?php } ?>

                                <!-- <a href="printview.php" class="btn btn-primary">Go to Print View</a> -->
                                <form action="" method="GET">
                                    <input type="date" value="<?= (isset($_GET['dt']) ? $_GET['dt'] : '');  ?>" name="dt" required>
                                    <button type="submit" name="s">Search</button>
                                </form>
                            </div>
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


                                <?php
                                $classId = $_SESSION['classId'];
                                $xdate = $_SESSION['dt'];
                                $dt = "";
                                if (isset($_GET['dt'])) {
                                    $date = $_GET['dt'];
                                    $dt = " AND xdate='$date'";
                                }
                                $id = 1;
                                $result = my_query("SELECT *,
                                                                                CONCAT(stud.fname, ' ', stud.lname) AS student,
                                                                                in_out.id AS id,
                                                                                in_out.status, in_out.xtime, stud.studNo
                                                                                FROM tbl_inout AS in_out    
                                                                                INNER JOIN tbl_students AS stud ON stud.id = in_out.stud_id  
                                                                                INNER JOIN tbl_class AS class ON class.id = in_out.classId
                                                                                INNER JOIN tbl_users AS user ON user.id = class.facId
                                                                                INNER JOIN tbl_settings_constants AS settings ON settings.value = class.section AND settings.sub_value = class.grade
                                                                                WHERE in_out.classId='$classId' $dt
                                                                                GROUP BY stud_id,classId,xdate ORDER BY in_out.id DESC");
                                $data = $result->fetch();



                                if ($data) {
                                    echo "<p><strong>Subject:</strong> " . htmlspecialchars($data['subject']) . "</p>";
                                    echo "<p><strong>Year/Section:</strong> " . htmlspecialchars($data['grade']) . " - " . htmlspecialchars($data['section']) . "</p>";
                                    echo "<p><strong>Teacher:</strong> " . htmlspecialchars($data['fname']) . " " . htmlspecialchars($data['lname']) . "</p>";
                                }
                                ?>
                                <table>
                                    <tr class="header-row">
                                        <th>#</th>
                                        <th>NAME</th>
                                        <th>LRN</th>
                                        <th>TIME</th>
                                        <th>STATUS</th>
                                    </tr>
                                    <?php
                                    $result->execute();

                                    if ($result->rowCount() > 0) {
                                        while ($row = $result->fetch()) {
                                            echo "<tr>";
                                            echo "<td>" . htmlspecialchars($id++) . "</td>";
                                            echo "<td>" . htmlspecialchars($row['student']) . "</td>";
                                            echo "<td>" . htmlspecialchars($row['studNo']) . "</td>";
                                            echo "<td>" . htmlspecialchars(format_time($row['xtime'])) . "</td>";
                                            echo "<td class='" . (($row['status'] === 'On Time') ? 'on-time' : '') . "'>" . htmlspecialchars($row['status']) . "</td>";
                                            echo "</tr>";
                                        }
                                    } else {
                                        echo "<tr><td colspan='5'>No data available</td></tr>";
                                    }
                                    ?>
                                </table><br>

                                <?php
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
                            <!-- <a href="printview.php" class="btn btn-primary">Go to Print View</a> -->
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </section>

</body>

</html>

<?php include_once('layout/footer.php'); ?>