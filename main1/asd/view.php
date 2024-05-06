<?php include_once('layout/head.php'); ?>
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
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                                    aria-hidden="true">×</span></button>
                                        <strong>Successfully <?php echo $r; ?>!</strong>
                                    </div>
                                <?php endif; ?>
                            </div>


                            <?php $type = $_GET['type'];
                            $id = $_GET['id'];
                            $schedid = $_GET['schedid']; ?>

                            <h2>
                                <?= $type; ?>
                            </h2>

                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover js-basic-example dataTable">

                                    <?php if ($type == 'Attendance' || $type == 'Evaluation') { ?>
                                        <thead>
                                        <?php
                                        $result = my_query("SELECT *, CONCAT(u.fname,' ',u.lname)instructor,CONCAT(course,'-',subject)scheduleInfo ,s.id as cid FROM tbl_schedules s 
INNER JOIN tbl_users u ON u.id=s.trainer_id  WHERE s.id='$id' ");
                                        if ($row = $result->fetch()) {
                                            $id = $row['id']; ?>
                                            <tr>
                                                <td>Class#: <?= $row['classNo']; ?></td>
                                                <td colspan="2">Instructor: <?= $row['instructor']; ?></td>
                                            </tr>
                                            <tr>
                                                <td>Course/Room: <?= $row['course'] . '(' . $row['room'] . ')'; ?></td>
                                                <td colspan="2">Subject: <?= $row['subject']; ?></td>
                                            </tr>
                                        <?php } ?>
                                        </thead>
                                    <?php } ?>




                                    <?php if ($type == 'Attendance') { ?>
                                        <thead>
                                        <tr>
                                            <th>Trainee</th>
                                            <th>Date</th>
                                            <th>Status</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        $result = my_query(" SELECT *,CONCAT(fname,' ',lname)trainee,a.id FROM tbl_attendances  a INNER JOIN tbl_trainees t ON t.id=a.trainee_id WHERE   schedule_id='$id' ");
                                        for ($i = 1; $row = $result->fetch(); $i++) {
                                            $id = $row['id']; ?>
                                            <tr>
                                                <td> <?= $row['trainee']; ?></td>
                                                <td><?= format_date($row['attendance_date']); ?></td>
                                                <td><?= attend_status($row['stat']); ?></td>
                                            </tr>
                                        <?php } ?>
                                        </tbody>

                                    <?php } elseif ($type == 'Evaluation') { ?>
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

                                    <?php } ?>

                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </section>


<?php include_once('layout/footer.php'); ?>