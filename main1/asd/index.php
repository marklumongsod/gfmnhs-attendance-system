
<?php include_once ('layout/head.php');?>

<section class="content">
  <div class="container-fluid">

    <?php   $result = $db->prepare("SELECT 
 (SELECT COUNT(*) FROM tbl_student) AS ttStud,  
 (SELECT COUNT(*) FROM tbl_subject ) AS ttSubj  ,
 (SELECT COUNT(*) FROM tbl_users WHERE role='Teacher') AS ttTeacher  ,
 (SELECT COUNT(*) FROM tbl_attendance ) AS ttAttendance");
$result->execute();
if($row = $result->fetch()){ ?>
   <!-- Widgets -->

            <div class="row clearfix">
                <a href="users.php?role=Teacher">

                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-pink hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">playlist_add_check</i>
                        </div>
                        <div class="content">
                            <div class="text"> TEACHER</div>
                            <div class="number count-to" data-from="0" data-to="125" data-speed="15" data-fresh-interval="20"><?=$row['ttTeacher'];?></div>
                        </div>
                    </div>
                </div>
            </a>
                <a href="attendance.php">
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-cyan hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">assignment_ind</i>
                        </div>
                        <div class="content">
                            <div class="text">ATTENDANCE</div>
                            <div class="number count-to" data-from="0" data-to="257" data-speed="1000" data-fresh-interval="20"><?=$row['ttAttendance'];?></div>
                        </div>
                    </div>
                </div>
            </a>
            <a href="subject.php">
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-light-green hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">forum</i>
                        </div>
                        <div class="content">
                            <div class="text">SUBJECT</div>
                            <div class="number count-to" data-from="0" data-to="243" data-speed="1000" data-fresh-interval="20"><?=$row['ttSubj'];?></div>
                        </div>
                    </div>
                </div>
            </a>
            <a href="student.php">
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-orange hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">person_add</i>
                        </div>
                        <div class="content">
                            <div class="text">STUDENT</div>
                            <div class="number count-to" data-from="0" data-to="1225" data-speed="1000" data-fresh-interval="20"><?=$row['ttStud'];?></div>
                        </div>
                    </div>
                </div>
            </div>
        </a>
            <!-- #END# Widgets -->
<?php } ?>

    </div>
  </section>

  <?php include_once ('layout/footer.php');?>

