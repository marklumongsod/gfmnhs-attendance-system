<?php include_once ('../config.php');?>

<!DOCTYPE html>
<html>

<body onload="window.print();">


<section class="content">
    <div class="container-fluid" id="printableArea" >

        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">

                        <div class="center">

                            <br/><br/>

                            <h2>
                                Assignment
                            </h2>

                        </div>


                    </div>
                    <style>
                        #customers {
                            font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
                            border-collapse: collapse;
                            width: 100%;
                        }

                        #customers td, #customers th {
                            border: 1px solid #ddd;
                            padding: 8px;
                        }

                        #customers tr:nth-child(even){background-color: #f2f2f2;}

                        #customers tr:hover {background-color: #ddd;}

                        #customers th {
                            padding-top: 12px;
                            padding-bottom: 12px;
                            text-align: left;
                            background-color: #4CAF50;
                            color: white;
                        }
                    </style>
                    <div class="body">
                        <div class="table-responsive" onload="printDiv('printableArea')"  >

                            <table   id="customers" class="table table-bordered table-striped table-hover   ">
                                <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>File Submitted By</th>
                                    <th>Score</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                // AND date_start<='$dt' AND date_end>='$dt'
                                if (isset($_GET['section'])){
                                    $sec=$_GET['section'];
                                    $uid=$_GET['id'];
                                    $res = my_query("SELECT *,CONCAT(fname,' ',lname)studInfo FROM tbl_student  WHERE  section='$sec'  ");

                                }else{
                                    $res = my_query("SELECT *,CONCAT(fname,' ',lname)studInfo FROM tbl_student  WHERE  section='$sec'");
                                }
                                for($i=1; $r = $res->fetch(); $i++){  $studId=$r['id']; ?>
                                    <tr>
                                        <td><?=$r['studInfo'];?></td>
                                        <?php   $result = my_query("SELECT *,fs.id as id,CONCAT(date_start,' | ',date_end)dt FROM tbl_upload u INNER JOIN tbl_file_submitted fs ON fs.uploadId=u.id  WHERE fs.studId='$studId'   AND type='Assignment'  GROUP BY u.id  ORDER BY u.id DESC");
                                        if($row = $result->fetch()){   ?>
                                            <td><?=$row['upload_name'];?></td>
                                            <td><?=$row['score'];?></td>
                                        <?php }else { ?>
                                            <td>No File Submitted</td>
                                            <td></td>
                                        <?php }?>


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

