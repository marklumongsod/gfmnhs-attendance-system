<?php
require_once "../config.php";
?>

    <body>
    <!--onload="window.print();"-->
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <!------ Include the above in your HEAD tag ---------->

    <?php
    $type = $_GET['type'];

    $id = $_GET['trainSchedId'];
    ?>

    <div class="container">

        <?php if ($type == 'Admission') { ?>

            <div class="row">
                <div class="col-xs-12">
                    <?php
                    $sql = "SELECT *,CONCAT(t.fname,' ',t.lname)trainee ,CONCAT(u.fname,' ',u.lname)instructor,ts.slotNo FROM tbl_trainee_schedules ts INNER JOIN tbl_trainees t ON t.id=ts.trainee_id INNER JOIN tbl_schedules s ON ts.schedule_id=s.id INNER JOIN tbl_users u ON u.id=s.trainer_id WHERE ts.id='$id' ";
                    $result = my_query($sql);
                    for ($i = 1; $row = $result->fetch(); $i++) { ?>
                        <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                            <thead>
                            <tr align="content-center">
                                <th rowspan="4"><h3>TONSBERG INTERNATIONAL TRAINING CENTER, INC.</h3> <br/> ADMISSION
                                    SLIP
                                </th>
                                <th width="200px">Doc. Name</th>
                                <th>Form-TC/AS-03</th>
                            </tr>
                            <tr>
                                <th>Rev. No.</th>
                                <th>9</th>
                            </tr>
                            <tr>
                                <th>Effective Date</th>
                                <th>12-Apr-19</th>
                            </tr>
                            </thead>
                        </table>

                        <div class="row">
                            <div class="col-sm-6">

                                <div class="col-sm-3">
                                    <label class="form-label">COURSE</label>
                                </div>
                                <div class="col-sm-9">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" class="form-control" value="<?= $row['course']; ?>" readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <label class="form-label">NAME</label>
                                </div>
                                <div class="col-sm-9">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" class="form-control" value="<?= $row['trainee']; ?>" readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <label class="form-label">SRN NO.</label>
                                </div>
                                <div class="col-sm-9">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" class="form-control" value="<?= $row['traineeNo']; ?>" readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <label class="form-label">Training Start</label>
                                </div>
                                <div class="col-sm-9">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" class="form-control" value="<?= format_date($row['start']); ?>" readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <label class="form-label">Training End</label>
                                </div>
                                <div class="col-sm-9">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" class="form-control" value="<?= format_date($row['end']); ?>" readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <label class="form-label">ROOM NO.</label>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" class="form-control" value="<?= $row['room']; ?>" readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <label class="form-label">SLOT NO.</label>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" class="form-control" value="<?= $row['slotNo']; ?>" readonly>
                                        </div>
                                    </div>
                                </div>


                            </div>

                            <div class="col-sm-6">
                                <div class="col-sm-3">
                                    <label class="form-label">DATE ENROLLED</label>
                                </div>
                                <div class="col-sm-9">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" class="form-control" value="<?= format_date($row['date_enrolled']); ?>" readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <label class="form-label">REGISTRATION NO.</label>
                                </div>
                                <div class="col-sm-9">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" class="form-control" value="<?= $row['trainingNo']; ?>" readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <label class="form-label">CLASS NO</label>
                                </div>
                                <div class="col-sm-9">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" class="form-control" value="<?= $row['classNo']; ?>" readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <label class="form-label">INSTRUCTOR</label>
                                </div>
                                <div class="col-sm-9">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" class="form-control" value="<?= $row['instructor']; ?>" readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <label class="form-label">REMARKS</label>
                                </div>
                                <div class="col-sm-9">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" class="form-control" value="<?= $row['remarks']; ?>" readonly>
                                        </div>
                                    </div>
                                </div>


                            </div>

                        </div>

                    <?php } ?>

                </div>
            </div>

        <?php } elseif ($type == 'Certificate') { ?>
            CERTIFICATE
        <?php } ?>
    </div>


    </body>

    <style>
        #signaturename {
            text-align: left;
            font-weight: bold;
            font-size: 80%;
            align-content: center;
        }

        #signature {
            width: 50%;
            border-bottom: 1px solid black;
            height: 30px;
        }
    </style>

    <script language="javascript">
        window.onafterprint = function (e) {
            closePrintView();
        };

        function myFunction() {
            window.print();
        }

        //        function closePrintView() {
        //            window.location.href = 'pr.php';
        //        }


    </script>


<?php //echo '<script>self.location = "pr.php";</script>'; ?>