
<?php 

 header("Location: inout.php");
die();

?>

<?php include_once('layout/head.php'); ?>
    <section class="content">
        <div class="container-fluid">

            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <a class="box-title">  <?php if (isset($_GET['r'])): ?>
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
                                <?php endif; ?></a>

                            <a class="btn right btn-success  waves-effect waves-light yellow darken-4" data-toggle="modal"
                               data-target="#add"> <i class="material-icons">add</i>ADD </a>
                            <h2>
                                ATTENDANCES
                            </h2>

                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Student</th>
                                        <th>Date</th>
                                        <th>TIME IN</th>
                                        <th>TIME OUT</th>
                                        <th width="20px">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    <?php

                                    $result = my_query("SELECT *,a.id, CONCAT(s.fname,' ',s.lname)student  FROM tbl_attendances a INNER JOIN tbl_students s ON s.id=a.student_id ORDER BY a.id DESC ");
                                    for ($i = 1; $row = $result->fetch(); $i++) {
                                        $id = $row['id']; ?>
                                        <tr>

                                            <td><?= $i; ?></td>
                                            <td><?= $row['student']; ?></td>
                                            <td><?= format_date($row['created_at']); ?></td>
                                            <td><?= format_time($row['time_in']); ?></td>
                                            <td><?= format_time($row['time_out']); ?></td>
<!--                                            <td>--><?//= $row['stat']; ?><!--</td>-->
                                            <td>
                                                <a  title="Edit" class="btn right btn-warning waves-effect waves-light yellow darken-4 col s12"
                                                   data-toggle="modal" data-target="#edit<?= $id; ?>">
                                                    <i class="material-icons">mode_edit</i> </a>

                                                <a  title="Delete" class="btn right btn-danger waves-effect waves-light yellow darken-4 col s12"
                                                   data-toggle="modal" data-target="#delete<?= $id; ?>">
                                                    <i class="material-icons">delete_forever</i> </a>

                                            </td>
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
    </section>

    <!--==================================== ADD,EDIT,DELETE Dialogs ====================================== -->
    <!-- Add -->

    <div class="modal fade" id="add" role="dialog">
        <div class="modal-dialog  modal-smd" role="document">
            <div class="modal-content">

                <form action="models/CRUDS.php" method="POST" enctype="multipart/form-data">
                    <div class="modal-header">
                        <h4 class="modal-title" id="defaultModalLabel">Add Attendance
                        </h4>

                    </div>
                    <div class="modal-body">


                        <div class="col-md-12">
                            <div class="form-group form-float">
                                <label class="form-label">Student</label>
                                <div class="form-line">
                                    <select name="student_id" class="form-control select" required>
                                        <option></option>
                                        <?php
                                        $res = my_query("SELECT * FROM tbl_students WHERE status='Active'");
                                        for ($x = 1; $r = $res->fetch(); $x++) { ?>
                                            <option value="<?= $r['id']; ?>"><?= $r['lname'] . ', ' . $r['fname']; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <label class="form-label">Date</label>
                                    <input name="attendance_date" type="datetime-local" class="form-control" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <label class="form-label">Time In</label>
                                    <input name="time_in" type="time" class="form-control" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <input name="time_out" type="time" class="form-control" required>
                                    <label class="form-label">Time Out</label>
                                </div>
                            </div>
                        </div>


                    </div>
                    <div class="modal-footer">
                        <button type="submit" value="IUAttendance" name="func_param" class="btn btn-primary waves-effect">
                            SAVE
                        </button>
                        <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">CLOSE</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Edit -->
<?php
$result = my_query("SELECT *  FROM tbl_attendances   ");
for ($i = 1; $row = $result->fetch(); $i++) {
    $id = $row['id']; ?>
    <div class="modal fade" id="edit<?= $id; ?>"  role="dialog">
        <div class="modal-dialog  modal-smd" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="defaultModalLabel">Edit Attendance</h4>
                </div>
                <form action="models/CRUDS.php" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="id" value="<?= $id; ?>">

                    <div class="modal-body">

                        <div class="col-md-12">
                            <div class="form-group form-float">
                                <label class="form-label">Student</label>
                                <div class="form-line">
                                    <select name="student_id" class="form-control select" required>
                                        <option></option>
                                        <?php
                                        $res = my_query("SELECT * FROM tbl_students WHERE status='Active'");
                                        for ($x = 1; $r = $res->fetch(); $x++) { ?>
                                            <option value="<?= $r['id']; ?>" <?php if ($row['student_id'] == $r['id']) {
                                                echo "selected";
                                            } ?>><?= $r['lname'] . ', ' . $r['fname']; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <label class="form-label">Date</label>
                                    <input name="created_at" type="datetime-local"  value="<?= $row['created_at']; ?>" class="form-control" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <label class="form-label">Time In</label>
                                    <input name="time_in" type="time" class="form-control"  value="<?= $row['time_in']; ?>" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <label class="form-label">Time Out</label>
                                    <input name="time_out" type="time" class="form-control"   value="<?= $row['time_out']; ?>" required>
                                </div>
                            </div>
                        </div>

                        <input name="stat" type="hidden"   class="form-control"   value="<?= $row['stat']; ?>" required>


                    </div>
                    <div class="modal-footer">
                        <button type="submit" value="IUAttendance" name="func_param" class="btn btn-warning waves-effect">
                            UPDATE
                        </button>
                        <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">CLOSE</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Delete -->
    <div class="modal fade" id="delete<?= $id; ?>" tabindex="-1" role="dialog">
        <div class="modal-dialog  modal-smd" role="document">
            <div class="modal-content">
                <form action="models/CRUDS.php" method="POST">
                    <div class="modal-body">
                        <input value="<?= $row['id']; ?>" name="id" type="hidden" class="form-control" required>
                        <div class="col-md-12" style="text-align: center;">
                            <h4>Are you sure you want to
                                delete <br/> (<i><b>
                                        <a data-dismiss="modal" class="call_info" data-id="
            asd" type="button" data-toggle="modal" data-target="#edit<?= $id; ?>" style="color: red"
                                           id="removeNo"> <?=db_get_result('tbl_students',"CONCAT(fname, ' ' ,lname)",['id'=>$row['student_id']]). ' '. $row['time_in'] . ' - ' . $row['time_out']; ?></a></b></i>
                                ) information? <br/>There
                                is NO undo! </h4>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" value="deleteAttendance" name="func_param"
                                class="btn btn-danger waves-effect">DELETE
                        </button>
                        <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">CLOSE</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php } ?>


<?php include_once('layout/footer.php'); ?>