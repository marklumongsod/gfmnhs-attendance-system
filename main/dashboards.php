<?php include_once('layout/head.php'); ?>


<section class="content">
    <div class="container-fluid">

<?php if($user_role=='Admin'){ ?>

    <?php $result = $db->prepare("SELECT 
 (SELECT COUNT(*) FROM tbl_students) AS ttStud,  
 (SELECT COUNT(*) FROM tbl_students ) AS ttact  ,
 (SELECT COUNT(*) FROM tbl_users WHERE role='Teacher') AS ttTeacher  ,
 (SELECT COUNT(*) FROM tbl_class ) AS ttSection");
            $result->execute();
            if ($row = $result->fetch()) { ?>
                <!-- Widgets -->

                <div class="row clearfix">
                    <a href="users.php?role=Teacher"> 

                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <div style="background-color:#143EA0" class="info-box  hover-expand-effect">
                                <div class="icon">
                                    <i class="material-icons">playlist_add_check</i>
                                </div>
                                <div class="content">
                                    <div class="text" style="color:white"> TEACHERS</div>
                                    <div  style="color:white" class="number count-to" data-from="0" data-to="125" data-speed="15" data-fresh-interval="20"><?= $row['ttTeacher']; ?></div>
                                </div>
                            </div>
                        </div>
                    </a>
                    <a href="section.php">
                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <div style="background-color:#0179AC"  class="info-box  hover-expand-effect">
                                <div class="icon">
                                    <i class="material-icons">assignment_ind</i>
                                </div>
                                <div class="content">
                                    <div  style="color:white" class="text">SECTIONS</div>
                                    <div  style="color:white" class="number count-to" data-from="0" data-to="257" data-speed="1000" data-fresh-interval="20"><?= $row['ttSection']; ?></div>
                                </div>
                            </div>
                        </div>
                    </a>
                    <!--        <a href="subject.php">
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-light-green hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">forum</i>
                        </div>
                        <div class="content">
                            <div class="text">ACTIVITY</div>
                            <div class="number count-to" data-from="0" data-to="243" data-speed="1000" data-fresh-interval="20"><?= $row['ttact']; ?></div>
                        </div>
                    </div>
                </div>
            </a> -->
                    <a href="students.php">
                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <div  style="background-color:#3EA9D7" class="info-box   hover-expand-effect">
                                <div class="icon">
                                    <i class="material-icons">person_add</i>
                                </div>
                                <div class="content">
                                    <div  style="color:white" class="text">STUDENTS</div>
                                    <div  style="color:white" class="number count-to" data-from="0" data-to="1225" data-speed="1000" data-fresh-interval="20"><?= $row['ttStud']; ?></div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <!-- #END# Widgets -->
            <?php } ?>


<?php }else { ?>

    <?php $result = $db->prepare("SELECT 
 (SELECT COUNT(*) FROM tbl_class c INNER JOIN tbl_users u ON u.id=c.facId 
                                    WHERE   facId='$user_id'  ) AS ttStud,  
 (SELECT COUNT(*) FROM tbl_students ) AS ttact  ,
 (SELECT COUNT(*) FROM tbl_users WHERE role='Teacher') AS ttTeacher  ,
 (SELECT COUNT(*) FROM tbl_class WHERE facId='$user_id' ) AS ttSection");
            $result->execute();
            if ($row = $result->fetch()) { ?>
                <!-- Widgets -->

                <div class="row clearfix">
                  
                    <a href="section.php">
                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <div style="background-color:#0179AC"  class="info-box  hover-expand-effect">
                                <div class="icon">
                                    <i class="material-icons">assignment_ind</i>
                                </div>
                                <div class="content">
                                    <div  style="color:white" class="text">SECTIONS</div>
                                    <div  style="color:white" class="number count-to" data-from="0" data-to="257" data-speed="1000" data-fresh-interval="20"><?= $row['ttSection']; ?></div>
                                </div>
                            </div>
                        </div>
                    </a>
                 
                    <a href="students.php">
                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <div  style="background-color:#3EA9D7" class="info-box   hover-expand-effect">
                                <div class="icon">
                                    <i class="material-icons">person_add</i>
                                </div>
                                <div class="content">
                                    <div  style="color:white" class="text">STUDENTS</div>
                                    <div  style="color:white" class="number count-to" data-from="0" data-to="1225" data-speed="1000" data-fresh-interval="20"><?= $row['ttStud']; ?></div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <!-- #END# Widgets -->
            <?php } ?>

<?php }?>
    
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card" align="center">

                    <div class="body">

                        <img src="../images/bgDash.png" width="100%">

                     <h3>  WELCOME TO <?=$system_title;?></h3>
                           <h4>Details.</h4>
                    </div>
                </div>
            </div>




    </div>
</section>

<?php include_once('layout/footer.php'); ?>

