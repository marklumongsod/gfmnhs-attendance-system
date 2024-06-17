<?php
session_start();

include_once('../config.php');

if (!isset($_SESSION['user_id'])) {
    $message = "Please login first.";
    echo "<script type='text/javascript'>window.location.href='../index.php';</script>";
    exit;
}

if (isset($_SESSION['print_data'])) {
    $print_data = $_SESSION['print_data'];
} else {
    $print_data = [];
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
            <?php
            if (!empty($print_data)) {
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
                $data = $result->fetch();

                if ($data) {
                    echo "<p><strong>Subject:</strong> " . htmlspecialchars($data['subject']) . "</p>";
                    echo "<p><strong>Year/Section:</strong> " . htmlspecialchars($data['grade']) . " - " . htmlspecialchars($data['section']) . "</p>";
                    echo "<p><strong>Teacher:</strong> " . htmlspecialchars($data['fname']) . " " . htmlspecialchars($data['lname']);
                    $formattedDate = date("F j, Y", strtotime($data['xdate']));
                    echo "<span style='float: right;'><strong>Date:</strong> " . htmlspecialchars($formattedDate) . "</span></p>";
                }
            } else {
                echo "";
            }
            ?>

            <?php
            if (!empty($print_data)) {
                echo "<table>";
                echo "<tr class='header-row'>";
                echo "<th>#</th>";
                echo "<th>NAME</th>";
                echo "<th>LRN</th>";
                echo "<th>TIME</th>";
                echo "<th>STATUS</th>";
                echo "</tr>";
                $id = 1;
                foreach ($print_data as $row) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($id++) . "</td>";
                    echo "<td>" . htmlspecialchars($row['student']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['studNo']) . "</td>";
                    echo "<td>" . htmlspecialchars(format_time($row['xtime'])) . "</td>";
                    echo "<td class='" . (($row['status'] === 'On Time') ? 'on-time' : '') . "'>" . htmlspecialchars($row['status']) . "</td>";
                    echo "</tr>";
                }

                echo "</table><br>";

                if (isset($data['adviser']) && !empty($data['adviser'])) {
                    echo "<div style='margin-top: 20px;'>";
                    // echo "<hr style='border: none; border-top: 1px solid #000; margin-bottom: 30px;'>";
                    echo "<div style='text-align: right; font-weight: bold; padding-right: 70px'>" . htmlspecialchars($data['adviser']) . "</div>";
                    echo "<div style='text-align: right;'>__________________________</div>";
                    echo "<div style='text-align: right; font-weight: bold; padding-right: 80px;'>Adviser</div>";
                    echo "</div>";
                }
            } else {
                echo "<p>No attendance data found.</p>";
            }
            ?>

            <button onclick="window.print();" class="btn btn-primary">PRINT</button>
        </div>
    </section>
</body>

</html>