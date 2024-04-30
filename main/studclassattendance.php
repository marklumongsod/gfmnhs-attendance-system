<?php include_once('layout/head.php'); ?>

<?php
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



?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Attendance List</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }

        th,
        td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        .header {
            background-color: #f1f1f1;
            padding: 10px;
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
                                    <a onclick="printDiv('printableArea')" class="btn right btn-warning  waves-effect waves-light yellow darken-4">
                                        <i class="material-icons">add</i>PRINT </a>

                                <?php } else { ?>


                                    <a onclick="printDiv('printableArea')" class="btn right btn-warning  waves-effect waves-light yellow darken-4">
                                        <i class="material-icons">print</i>PRINT </a>
                                <?php } ?>


                                <form action="" method="GET">
                                    <input type="date" value="<?= (isset($_GET['dt']) ? $_GET['dt'] : '');  ?>" name="dt" required>
                                    <button type="submit" name="s">Search</button>
                                </form>
                            </div>
                            <div id="printableArea" class="body">

                                <!-- <h2>
                                STUDENT SCHEDULE <?= (isset($_GET['dt']) ? '- ' . format_date($_GET['dt']) : '');  ?> <br /> (<?= $_SESSION['classInfo']; ?>)
                            </h2> -->



                                <?php $classId = $_SESSION['classId'];

                                $xdate =   $_SESSION['dt'];
                                if (isset($_GET['dt'])) {
                                    $date = $_GET['dt'];
                                    $dt = " AND xdate='$date'";
                                } else {
                                    $dt = "";
                                }
                                $result = my_query("SELECT *,
                                                CONCAT(stud.fname,' ',stud.lname) AS student,
                                                in_out.id AS id,
                                                in_out.status 
                                                FROM tbl_inout AS in_out    
                                                INNER JOIN tbl_students AS stud ON stud.id = in_out.stud_id  
                                                INNER JOIN tbl_class AS class ON class.id = in_out.classId
                                                INNER JOIN tbl_users AS user ON user.id = class.facId
                                                WHERE in_out.classId='$classId' $dt
                                                ORDER BY in_out.id DESC");

                                $data = $result->fetch(); ?>

                                Subject: <?php if (isset($data['subject']) && !empty($data['subject'])) : ?><p><?= $data['subject']; ?></p><?php endif; ?></th> 
                                Year/Section: <?php if (isset($data['grade']) && !empty($data['grade']) && isset($data['section']) && !empty($data['section'])) : ?><p><?= $data['grade']; ?> - <?= $data['section']; ?></p><?php endif; ?>
                                Teacher: <?php if (isset($data['fname']) && !empty($data['fname']) && isset($data['lname']) && !empty($data['lname'])) : ?><p><?= $data['fname']; ?> <?= $data['lname']; ?></p><?php endif; ?>
                              
                                <div class="table-responsive">
                                <table class="table-bordered table-striped table-hover">
   
                                        <?php for ($i = 1; $row = $result->fetch(); $i++) {
                                        $id = $row['id'];
                                        $stud_id = $row['stud_id']; ?>
                                            <thead>
                                                <tr class="header">
                                                    <th>#</th>
                                                    <th>NAME</th>
                                                    <th>LRN</th>
                                                    <th>TIME</th>
                                                    <th>STATUS</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td><?= $id ?></td>
                                                    <td><?= $row['student']; ?></td>
                                                    <td><?= $row['studNo']; ?></td>
                                                    <td><?= format_time($row['xtime']); ?></td>
                                                    <td class="on-time"><?= $row['status']; ?></td>
                                                    <!-- <td><?= format_date($row['xdate']); ?></td>
                                                <td><?= format_time($row['xtime']); ?></td> -->

                                                </tr>
                                            <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </section>

</body>

</html>

<?php include_once('layout/footer.php'); ?>