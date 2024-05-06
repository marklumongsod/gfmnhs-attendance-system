<?php include_once('layout/head.php');
// error_reporting(0);
?>

    <style type="text/css" media="print">

        /* @page {size:landscape}  */
        body {
            page-break-before: avoid;
            width: 100%;
            height: 100%;
            -webkit-transform: rotate(-90deg) scale(.68, .68);
            -moz-transform: rotate(-90deg) scale(.58, .58);
            zoom: 200%
        }
        #selectClassNo{
            width:10px;
        }

        #selectClassNo option{
            width:150px;
        }
    </style>

    <section class="content">
        <div class="container-fluid">

            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <div class="box-title">  <?php if (isset($_GET['r'])): ?>
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
                                        <button type="button" class="close" data-dismiss="alert"
                                                aria-label="Close"><span
                                                    aria-hidden="true">×</span></button>
                                        <strong>Successfully <?php echo $r; ?>!</strong>
                                    </div>
                                <?php endif; ?>
                            </div>


                            <h2>
                                REPORT (<?= $_GET['t']; ?>)
                            </h2>

                            <?php
                            if (isset($_GET['dtFrom'])) {
                                $where = '';
                                $dtFrom = $_GET['dtFrom'];
                                $dtTo = $_GET['dtTo'];
                                if ($_GET['t'] == 'Enrollment') {
                                    $where = " WHERE date_enrolled BETWEEN '$dtFrom' AND '$dtTo' AND train_sched_paid";
                                } elseif ($_GET['t'] == 'Payment') {
                                    $where = " AND payment_date BETWEEN '$dtFrom' AND '$dtTo' AND train_sched_paid";
                                } elseif ($_GET['t'] == 'Attendance') {
                                    $where=" AND attendance_date BETWEEN '$dtFrom' AND '$dtTo'";
                                } elseif ($_GET['t'] == 'Evaluation') {
                                    $where = " AND a.created_at BETWEEN '$dtFrom' AND '$dtTo'";
                                } elseif ($_GET['t'] == 'Assessment') {
                                    $where = " AND  attendance_date BETWEEN '$dtFrom' AND '$dtTo'";
                                } elseif ($_GET['t'] == 'Issued Certificate') {
                                    $where = " WHERE cert_date BETWEEN '$dtFrom' AND '$dtTo'";
                                } else {

                                }
                            }
                            ?>
                        </div>
                        <div class="body">
                            <div align="center">
                                <form action="" method="GET">
                                    <input type="hidden" name="t" value="<?= $_GET['t']; ?>">

                                    <?php if ($_GET['t'] == 'Attendance' || $_GET['t'] == 'Evaluation' || $_GET['t'] == 'Assessment') { ?>

                                        <select name="classNo" id="selectClassNo" class="form-control select" required>
                                            <option></option>
                                            <?php
                                            $res = my_query("SELECT * FROM tbl_schedules ");
                                            for ($x = 1; $r = $res->fetch(); $x++) { ?>
                                                <option value="<?= $r['classNo']; ?>"
                                                <?php if(isset($_GET['classNo'])) { if($r['classNo']==$_GET['classNo']){ echo 'selected'; } }?>
                                                ><?= $r['classNo'].' - '.$r['subject']; ?></option>
                                            <?php } ?>
                                        </select>


                                    <?php } ?>

                                    <input type="date" name="dtFrom" value="<?php if (isset($_GET['dtFrom'])) {
                                        echo $_GET['dtFrom'];
                                    } ?>" required>
                                    <input type="date" name="dtTo" value="<?php if (isset($_GET['dtTo'])) {
                                        echo $_GET['dtTo'];
                                    } ?>" required>

                                    <input type="submit" name="cat" value="Generate">
                                    <input type="submit" name="cat" onclick="printDiv('printableArea')" value="Print">
                                </form>

                            </div>

                            <div id="printableArea">
                                <div class="table-responsive">
                                    <?php if (isset($_GET['cat'])) { ?>
                                        Report Type : <?=$_GET['t'];?> <br/>
                                        Report Date : <?= format_date(isset($_GET['dtFrom']) ? $_GET['dtFrom'] : ''); ?>  - <?= format_date(isset($_GET['dtTo']) ? $_GET['dtTo'] : ''); ?>

                                        <table class="table table-bordered table-striped table-hover " style="font-size: small">

                                           <?php if ($_GET['t'] == 'Attendance' || $_GET['t'] == 'Evaluation' || $_GET['t'] == 'Assessment') { ?>

                                            <thead>
                                            <?php $classNo=$_GET['classNo'];
                                            $result = my_query("SELECT *, CONCAT(u.fname,' ',u.lname)instructor,CONCAT(course,'-',subject)scheduleInfo ,s.id as cid FROM tbl_schedules s 
INNER JOIN tbl_users u ON u.id=s.trainer_id WHERE classNo='$classNo' ");
                                            if ($row = $result->fetch()) {
                                                $id = $row['id']; ?>
                                                <tr>
                                                    <td>Class#: <?= $row['classNo']; ?></td>
                                                    <td colspan="2">Instructor: <?= $row['instructor']; ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Course/Room: <?= $row['course'].'('.$row['room'].')'; ?></td>
                                                    <td colspan="2">Subject: <?= $row['subject']; ?></td>
                                                </tr>
                                            <?php } ?>
                                            </thead>
                                           <?php } ?>

                                            <!--                                    js-basic-example dataTable-->
                                            <?php if ($_GET['t'] == 'Enrollment') { ?>
                                                <thead>
                                                <tr>
                                                    <th>SRN #</th>
                                                    <th>Trainee</th>
                                                    <th>Class #</th>
                                                    <th>Training #</th>
                                                    <th>Rank</th>
                                                    <th>Course</th>
                                                    <th>Subject</th>
                                                    <th>Instructor</th>
                                                    <th>Room</th>
                                                    <th>Date</th>
                                                    <th>Enrolled</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <!--                                                SELECT * FROM tbl_trainees t INNER JOIN tbl_training_info ti ON ti.trainee_id=t.id-->
                                                <?php $result = my_query("SELECT * ,CONCAT(fname,' ',lname)traineeName,CONCAT(classNo,'-',subject)scheduleInfo ,ts.id FROM tbl_schedules s 
 INNER JOIN tbl_trainee_schedules ts ON ts.schedule_id=s.id INNER JOIN tbl_trainees t ON t.id=ts.trainee_id  $where ORDER BY  ts.id DESC");
                                                for ($i = 1; $row = $result->fetch(); $i++) {
                                                    $id = $row['id']; ?>
                                                    <tr>
                                                        <!--                                                        <td>-->
                                                        <!--                                                            <img width="50" src="../images/trainee/-->
                                                        <? //= $row['pic']; ?><!--"/>-->
                                                        <!--                                                        </td>-->
                                                        <td><?= $row['traineeNo']; ?></td>
                                                        <td><?= $row['traineeName']; ?></td>
                                                        <td><?= $row['classNo']; ?></td>
                                                        <td><?= $row['trainingNo']; ?></td>
                                                        <td><?= $row['rank']; ?></td>
                                                        <td><?= $row['course']; ?></td>
                                                        <td><?= $row['subject']; ?></td>
                                                        <td>
                                                            <?= get_result('tbl_users', 'fname', ["id" => $row['trainer_id']]) . ' ' . get_result('tbl_users', 'lname', ["id" => $row['trainer_id']]); ?>
                                                        </td>
                                                        <td><?= $row['room']; ?></td>
                                                        <td><?= format_date($row['start']) . ' - ' . format_date($row['end']); ?></td>
                                                        <td><?= format_date($row['date_enrolled']); ?></td>
                                                    </tr>
                                                <?php } ?>
                                                </tbody>

                                            <?php } elseif ($_GET['t'] == 'Payment') { ?>
                                                <thead>
                                                <tr>
                                                    <th>Transaction ID</th>
                                                    <th>Registration #</th>
                                                    <th>Created At</th>
                                                    <th>Charge To</th>
                                                    <th>Company Name</th>
                                                    <th>SRN #</th>
                                                    <th>Trainee Name</th>
                                                    <th>Enrolled Subj.</th>
                                                    <th>Enrolled Date</th>

                                                    <th>Instructor</th>
                                                    <th>Room Code</th>
                                                    <th>Amount Paid</th>
                                                </tr>
                                                </thead>
                                                <tbody>

                                                <?php
                                                $result = my_query("SELECT *,date_enrolled,CONCAT(fname,' ',lname)traineeName,CONCAT(classNo,'-',subject)scheduleInfo ,ts.id,ts.created_at,p.payment FROM tbl_schedules s 
 INNER JOIN tbl_trainee_schedules ts ON ts.schedule_id=s.id INNER JOIN tbl_trainees t ON t.id=ts.trainee_id INNER JOIN tbl_payments p ON p.trainee_sched_id=ts.id WHERE  train_sched_paid > 0   $where ORDER BY ts.id DESC");

                                                for ($i = 1; $row = $result->fetch(); $i++) {
                                                    $id = $row['id'];
                                                    $instructor_id = $row['trainer_id']; ?>
                                                    <tr>
                                                        <td><?= $row['id']; ?></td>
                                                        <td><?= $row['trainingNo']; ?></td>
                                                        <td><?= format_date($row['payment_date']); ?></td>
                                                        <td><?php if ($row['train_sched_endorsed'] == '') {
                                                                echo 'Trainee';
                                                            } else {
                                                                echo 'Company';
                                                            }; ?></td>
                                                        <td><?= $row['train_sched_endorsed']; ?></td>

                                                        <td><?= $row['traineeNo']; ?></td>
                                                        <td><?= $row['traineeName']; ?></td>
                                                        <td><?= $row['scheduleInfo']; ?></td>
                                                        <td><?= format_date($row['date_enrolled']); ?></td>
                                                        <td>
                                                            <?php
                                                            echo get_result('tbl_users', 'fname', ["id" => $instructor_id]);
                                                            ?>

                                                        </td>
                                                        <td><?= $row['room']; ?></td>
                                                        <td><?= peso_format($row['payment']); ?></td>
                                                    </tr>
                                                <?php } ?>
                                                </tbody>
                                            <?php } elseif ($_GET['t'] == 'Attendance') { ?>




                                                <thead>
                                                <tr>
                                                    <th>Trainee</th>
                                                    <th>Date</th>
                                                    <th>Status</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <?php $result = my_query(" SELECT *,CONCAT(fname,' ',lname)trainee,a.id FROM tbl_attendances  a INNER JOIN tbl_trainees t ON t.id=a.trainee_id WHERE   schedule_id='$id' $where  ");
                                                for ($i = 1; $row = $result->fetch(); $i++) {
                                                    $id = $row['id']; ?>
                                                    <tr>

                                                        <td><?= $row['trainee']; ?></td>
                                                        <td><?= $row['attendance_date']; ?></td>
                                                        <td><?= attend_status($row['stat']); ?></td>
                                                    </tr>
                                                <?php } ?>
                                                </tbody>
                                            <?php } elseif ($_GET['t'] == 'Evaluation') { ?>
<?=$schedid=get_result('tbl_schedules','id',["classNo"=>$_GET['classNo']]); ?>


                                                <thead>
                                                <tr>
                                                    <th>SRN #</th>
                                                    <th>Name</th>

                                                    <?php $result = my_query(" SELECT * FROM tbl_settings_constants WHERE category='Evaluation'  GROUP BY sub_value  ");
                                                    for ($i = 1; $row = $result->fetch(); $i++) {
                                                        $sub_value = $row['sub_value'];
                                                        echo "<th>$sub_value(1-5)</th>";
                                                    } ?>
                                                    <th>Total Points</th>
                                                </tr>
                                                </thead>
                                                <tbody>

                                                <?php

                                                $result = my_query(" SELECT *,CONCAT(fname,' ',lname)trainee,a.id,sc.value FROM tbl_evaluations  a
  INNER JOIN tbl_trainees t ON t.id=a.trainee_id INNER JOIN tbl_settings_constants sc ON sc.id=a.question_id WHERE  schedule_id='$schedid' GROUP BY trainee_id,schedule_id  ");
                                                for ($i = 1; $row = $result->fetch(); $i++) {
                                                    $tt = 0;
                                                    $id = $row['id'];
                                                    $trainee_id = $row['trainee_id'];
                                                    ?>
                                                    <tr>
                                                        <td><?= ($row['traineeNo']); ?></td>
                                                        <td><?= ($row['trainee']); ?></td>


                                                        <?php
                                                        $tt=0;
                                                        $res = my_query("  SELECT * FROM tbl_settings_constants WHERE category='Evaluation'  GROUP BY sub_value  ");
                                                        for ($x = 1; $r = $res->fetch(); $x++) { echo $sub_value = $r['sub_value'];  ?>

                                                            <td>



                                                                <?php   $res1 = my_query(" SELECT SUM(score)score FROM tbl_evaluations  a
  INNER JOIN tbl_trainees t ON t.id=a.trainee_id INNER JOIN tbl_settings_constants sc ON sc.id=a.question_id WHERE trainee_id='$trainee_id' AND sub_value='$sub_value' GROUP BY  trainee_id,schedule_id,sub_value  ");
                                                                if ($r1 = $res1->fetch()) {   echo $tt+= $r1['score'];   } else { echo '0'; } ?>





                                                            </td>
                                                        <?php } ?>



                                                        <td><?=$tt;?></td>
                                                    </tr>
                                                <?php } ?>
                                                </tbody>


                                            <?php } elseif ($_GET['t'] == 'Assessment') { ?>

                                                <thead>
                                                <tr>
                                                    <th>SRN #</th>
                                                    <th>Trainee</th>
                                                    <th>Attendance</th>
                                                    <th>Evaluation</th>
                                                    <th>Charged To</th>
                                                    <th>Balance</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <?php

                                                $schedule_id=get_result('tbl_schedules','id',["classNo"=>$_GET['classNo']]);
                                                $result = my_query("SELECT *  FROM   tbl_trainee_schedules ts  
 INNER JOIN  tbl_trainees t  ON t.id=ts.trainee_id INNER JOIN  tbl_schedules s  ON s.id=ts.schedule_id WHERE schedule_id='$schedule_id' GROUP BY trainee_id   ORDER BY ts.id DESC");
                                                for ($i = 1; $row = $result->fetch(); $i++) {
                                                     $trainee_id= $row['trainee_id'] ?>
                                                    <tr>
                                                        <td><?= $row['traineeNo']; ?></td>
                                                        <td><?= $row['fname'] . ' ' . $row['lname']; ?></td>



                                                        <td>
                                                            <?php
                                                            $tt=0;
                                                            $res = my_query("  SELECT COUNT(*)c, count(case when  stat = '1'  then 1 else null end)   present ,count(case when  stat = '2'  then 1 else null end)   absent FROM tbl_attendances WHERE trainee_id='$trainee_id' AND schedule_id='$schedule_id'    GROUP BY schedule_id  ");
                                                            if($r = $res->fetch()) { echo  ($present= $r['c']/$r['present']) * 100   ; }  ?>
                                                        </td>


                                                        <td>
                                                            <?= $row['traineeNo']; ?>
                                                        </td>



                                                        <td><?= $row['train_sched_endorsed']; ?></td>
                                                        <td><?= $row['price'] - $row['train_sched_paid']; ?></td>
                                                    </tr>
                                                <?php } ?>
                                                </tbody>


                                            <?php } elseif ($_GET['t'] == 'Issued Certificate') { ?>
                                                <thead>
                                                <tr>
                                                    <th>Ctrl. #</th>
                                                    <th>SRN #</th>
                                                    <th>Trainee</th>
                                                    <th>Class #</th>
                                                    <th>Subject</th>
                                                    <th>Schedule</th>
                                                    <th>Date Issued</th>
                                                    <th>Date Released</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <?php $result = my_query("SELECT *,cert.created_at FROM tbl_certificates cert INNER JOIN tbl_trainee_schedules ts ON ts.id=cert.trainee_sched_id
 INNER JOIN  tbl_trainees t  ON t.id=ts.trainee_id INNER JOIN  tbl_schedules s  ON s.id=ts.schedule_id $where ORDER BY cert.id DESC");
                                                for ($i = 1; $row = $result->fetch(); $i++) {
                                                    $id = $row['id']; ?>
                                                    <tr>
                                                        <td><?= $row['crt_ctrl_no']; ?></td>
                                                        <td><?= $row['traineeNo']; ?></td>
                                                        <td><?= $row['fname'] . ' ' . $row['lname']; ?></td>

                                                        <td><?= $row['classNo'] ?></td>
                                                        <td><?= $row['subject']; ?></td>
                                                        <td><?= format_date($row['start']) . '-' . format_date($row['end']); ?></td>
                                                        <td><?= format_date($row['created_at']); ?></td>
                                                        <td><?= format_date($row['realeased_at']); ?></td>
                                                    </tr>
                                                <?php } ?>
                                                </tbody>

                                            <?php } ?>
                                        </table>
                                    <?php } ?>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>

    <style type="text/css" media="print">
        @page {
            size: landscape;
        }

        body {
            writing-mode: tb-rl;
        }
    </style>

    <script type="text/javascript">
        function printDiv(divName) {
            var printContents = document.getElementById(divName).innerHTML;
            var originalContents = document.body.innerHTML;
            document.body.innerHTML = printContents;
            window.print();

            document.body.innerHTML = originalContents;
        }
    </script>
<?php include_once('layout/footer.php'); ?>