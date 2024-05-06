<?php include_once('layout/head.php'); ?>


<section class="content">
    <div class="container-fluid">

        <?php
        $result = my_query("SELECT *,id,COUNT(*)c FROM tbl_inout GROUP BY `classId`,`stud_id`,`xdate`,status;");
        for ($i = 1; $row = $result->fetch(); $i++) {
            if($row['c']>1){
                $id=$row['id'];
                $classId=$row['classId'];
                $stud_id=$row['stud_id'];
                $xdate=$row['xdate'];
                $status=$row['status'];
                my_query("DELETE  FROM tbl_inout WHERE id<>'$id' AND `classId`='$classId' AND `stud_id`='$stud_id' AND `xdate`='$xdate' AND status='$status'   ");
            }
        } ?>

        <?php if($user_role=='Admin'){

            $result = $db->prepare("SELECT 
 (SELECT COUNT(*) FROM tbl_students) AS ttStud,  
 (SELECT COUNT(*) FROM tbl_students ) AS ttact  ,
 (SELECT COUNT(*) FROM tbl_users WHERE role='Teacher') AS ttTeacher,  

 (SELECT COUNT(*) FROM tbl_inout WHERE status='PRESENT') AS ttPresent,
 (SELECT COUNT(*) FROM tbl_inout WHERE status='LATE') AS ttLate,
 (SELECT COUNT(*) FROM tbl_inout WHERE status='ABSENT') AS ttAbsent,
 (SELECT COUNT(*) FROM tbl_inout WHERE status='') AS ttPercentage,


 (SELECT COUNT(*) FROM tbl_class ) AS ttSection");
            $result->execute();
            if ($row = $result->fetch()) {
                $row['ttPercentage'] =  number_format($row['ttPresent'] / ($row['ttLate']+ $row['ttAbsent']),2);

                ?>
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


                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                        <div class="info-box bg-light-green hover-expand-effect">
                            <div class="icon">
                                <i class="material-icons">timeline</i>
                            </div>
                            <div class="content">
                                <div class="text">PERCENT</div>
                                <div class="number count-to" data-from="0" data-to="243" data-speed="1000" data-fresh-interval="20"><?= $row['ttPercentage']; ?></div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                        <div class="info-box bg-light-green hover-expand-effect">
                            <div class="icon">
                                <i class="material-icons">alarm_on</i>
                            </div>
                            <div class="content">
                                <div class="text">PRESENT</div>
                                <div class="number count-to" data-from="0" data-to="243" data-speed="1000" data-fresh-interval="20"><?= $row['ttPresent']; ?></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                        <div class="info-box bg-light-green hover-expand-effect">
                            <div class="icon">
                                <i class="material-icons">alarm</i>
                            </div>
                            <div class="content">
                                <div class="text">LATE</div>
                                <div class="number count-to" data-from="0" data-to="243" data-speed="1000" data-fresh-interval="20"><?= $row['ttLate']; ?></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                        <div class="info-box bg-light-green hover-expand-effect">
                            <div class="icon">
                                <i class="material-icons">alarm_off</i>
                            </div>
                            <div class="content">
                                <div class="text">ABSENT</div>
                                <div class="number count-to" data-from="0" data-to="243" data-speed="1000" data-fresh-interval="20"><?= $row['ttAbsent']; ?></div>
                            </div>
                        </div>
                    </div>




                </div>
                <!-- #END# Widgets -->
            <?php } ?>



        <?php }else { ?>

            <?php $result = $db->prepare("SELECT 
 (SELECT COUNT(*)   FROM    tbl_classstudent cc INNER JOIN tbl_students u ON u.id=cc.studId INNER JOIN tbl_class c ON cc.classId=c.id   WHERE facId='$user_id'  ) AS ttStud,  
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

        <div class="row">




            <script type="text/javascript" src="http://static.fusioncharts.com/code/latest/fusioncharts.js"></script>
            <?php include_once('fusioncharts.php'); ?>

            <?php

             $thisMonth=date("Y-m");
             $lastMonth=date("Y-m", strtotime("-1 months"));
            $strQuery = "SELECT  cc.status lbl,COUNT(*)c FROM tbl_inout     cc INNER JOIN tbl_students u ON u.id=cc.stud_id   WHERE xdate LIKE '%$thisMonth%' GROUP BY cc.status ";
            $result = $db->query($strQuery) or exit("Error code ({$db->errno}): {$db->error}");
            if ($result) {
                $arrData = array(
                    "chart" => array(
                        "caption" => "THIS MONTH SUMMARY",
                        "showValues" => "1",
                        "theme" => "zune"
                    )
                );

                $arrData["data"] = array();

                for ($i = 1; $row = $result->fetch(); $i++) {


                    array_push($arrData["data"], array(
                            "label" => $row["lbl"],
                            "value" => $row["c"]
                        )
                    );
                }
                $jsonEncodedData = json_encode($arrData);
                $columnChart = new FusionCharts("pie2d", "myFirstChart", '100%', 400, "chart-1", "json", $jsonEncodedData);

                // Render the chart
                $columnChart->render();

            } ?>

            <?php
            $strQuery = "SELECT  cc.status lbl,COUNT(*)c FROM tbl_inout     cc INNER JOIN tbl_students u ON u.id=cc.stud_id   WHERE xdate LIKE '%$lastMonth%'   GROUP BY cc.status ";
            $result = $db->query($strQuery) or exit("Error code ({$db->errno}): {$db->error}");
            if ($result) {
                $arrData = array(
                    "chart" => array(
                        "caption" => "LAST MONTH SUMMARY",
                        "showValues" => "1",
                        "theme" => "zune"
                    )
                );

                $arrData["data"] = array();

                for ($i = 1; $row = $result->fetch(); $i++) {


                    array_push($arrData["data"], array(
                            "label" => $row["lbl"],
                            "value" => $row["c"]
                        )
                    );
                }
                $jsonEncodedData = json_encode($arrData);
                $columnChart = new FusionCharts("pie2d", "myFirstChart1", '100%', 400, "chart-2", "json", $jsonEncodedData);

                // Render the chart
                $columnChart->render();

            } ?>

            <div class="card" align="center">
            <div class="col-md-6 col-xl-6">

                <div id="chart-1"></div>
            </div>
            <div class="col-md-6 col-xl-6">

                <div id="chart-2"></div>
            </div>


<!--                    <img src="../images/bgDash.png" width="100%">-->


                <br/>
                    <h3 style="color:white">  WELCOME TO <?=$system_title;?></h3>
                    <h4 style="color:white">Details.</h4>

            </div>
            <!--Grid column-->
        </div>






    </div>
</section>

<?php include_once('layout/footer.php'); ?>

