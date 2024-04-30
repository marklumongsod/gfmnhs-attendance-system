<?php include_once('layout/head.php'); ?>

<!-- Latest compiled and minified CSS -->


<?php $title = 'Student'; ?>
<section class="content">
    <div class="container-fluid">

        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <div class="box-studno"> <?php if (isset($_GET['r'])) : ?>
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
                        </div>

                        <a class="btn right btn-success  waves-effect waves-light yellow darken-4" data-toggle="modal" data-target="#add">
                            <i class="material-icons">add</i>ADD </a>
                        <h2>
                            STUDENTS <br />


                            Gr. Yr. <select name="gr_yr" onchange="if (this.value) window.location.href=this.value" required>
                                <option></option>
                                <?php $res = my_query("SELECT *,CONCAT( value)sec  FROM tbl_settings_constants WHERE category='Grade' ORDER BY id   ");
                                for ($i = 1; $r = $res->fetch(); $i++) {
                                    $id = $r['id'];  ?>
                                    <option <?= (isset($_GET['s']) ? ($_GET['s'] == $r['sec'] ? 'selected' : '') : '');  ?> value="students.php?s=<?= $r['sec']; ?>"><?= $r['sec']; ?></option>
                                <?php } ?>
                            </select>


                            Section :
                            <select name="section" onchange="if (this.value) window.location.href=this.value" required>
                                <option></option>
                                <?php
                                $sec = '';
                                if (isset($_GET['s'])) {
                                    $sec = $_GET['s'];

                                    $res = my_query("SELECT *,CONCAT( value)sec  FROM tbl_settings_constants WHERE category='Section' AND sub_value='$sec'  ");
                                    for ($i = 1; $r = $res->fetch(); $i++) {
                                        $id = $r['id'];  ?>
                                        <option <?= (isset($_GET['sec']) ? ($_GET['sec'] == $r['sec'] ? 'selected' : '') : '');  ?> value="students.php?s=<?= $_GET['s'] . '&sec=' . $r['sec']; ?>"><?= $r['sec']; ?></option>
                                <?php }
                                }

                                ?>
                            </select>

                        </h2>

                    </div>
                    <div class="body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                <thead>
                                    <tr>
                                        <th>Picture</th>
                                        <th>LRN</th>
                                        <th>Name</th>
                                        <th>Section</th>
                                        <th>Gr. Yr.</th>
                                        <th>Face Status</th>
                                        <th>Status </th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php
                                    $gr = '';
                                    $section = '';
                                    if (isset($_GET['s'])) {

                                        $gr = $_GET['s'];
                                        if (isset($_GET['sec'])) {
                                            echo   $section = $_GET['sec'];
                                            $section = " AND s.section='$section'";
                                        }

                                        if ($_SESSION['role'] == 'Teacher') {
                                            $result = my_query("SELECT *,CONCAT(lname,',',fname,' ',LEFT(mname,1),'.')fullname ,CONCAT(email,'</br>',contact,'</br>',address)profile   FROM    tbl_classstudent cc INNER JOIN tbl_students s ON s.id=cc.studId INNER JOIN tbl_class c ON cc.classId=c.id   WHERE facId='$user_id' AND gr_yr='$gr' $section  ");
                                        } else {
                                            $result = my_query("SELECT *,CONCAT(lname,',',fname,' ',LEFT(mname,1),'.')fullname ,CONCAT(email,'</br>',contact,'</br>',address)profile   FROM tbl_students s WHERE gr_yr='$gr' $section  ORDER BY id DESC");
                                        }
                                    } else {
                                        if ($_SESSION['role'] == 'Teacher') {
                                            $result = my_query("SELECT *,CONCAT(lname,',',fname,' ',LEFT(mname,1),'.')fullname ,CONCAT(email,'</br>',contact,'</br>',address)profile   FROM    tbl_classstudent cc INNER JOIN tbl_students u ON u.id=cc.studId INNER JOIN tbl_class c ON cc.classId=c.id   WHERE facId='$user_id'");
                                        } else {
                                            $result = my_query("SELECT *,CONCAT(lname,',',fname,' ',LEFT(mname,1),'.')fullname ,CONCAT(email,'</br>',contact,'</br>',address)profile   FROM tbl_students s  ORDER BY id DESC");
                                        }
                                    }


                                    for ($i = 1; $row = $result->fetch(); $i++) {
                                        $id = $row['id']; ?>
                                        <tr>
                                            <td><img width="50" src="../images/student/<?= $row['pic']; ?>" /></td>
                                            <td><?= $row['studNo']; ?></td>
                                            <td><?= $row['fullname']; ?></td>
                                            <td><?= $row['section']; ?></td>
                                            <td><?= $row['gr_yr']; ?></td>
                                            <td><?php
                                                if ($row['TrainedFaces'] > 0) {
                                                    if ($row['TrainedFaces'] <> '') {
                                                        echo 'Enrolled';
                                                    }
                                                } else {
                                                    echo '';
                                                }  ?></td>


                                            <td>
                                                <a href="models/do.php?do=status&id=<?= $row['id']; ?>&stat=<?= $row['status']; ?>"><?= $row['status']; ?></a>
                                            </td>
                                            <td>
                                                <a title="Edit" class="btn right btn-warning waves-effect waves-light yellow darken-4 col s12" data-toggle="modal" data-target="#edit<?= $id; ?>">
                                                    <i class="material-icons">mode_edit</i>
                                                </a>

                                                <a title="Delete" class="btn right btn-danger waves-effect waves-light yellow darken-4 col s12" data-toggle="modal" data-target="#delete<?= $id; ?>">
                                                    <i class="material-icons">delete_forever</i>
                                                </a>
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
                    <h4 class="modal-title" id="defaultModalLabel">Add <?= $title; ?>
                    </h4>
                </div>
                <div class="modal-body">


                    <div class="col-md-8">
                        <div class="form-group form-float">
                            <div class="form-line">
                                <input name="pic" type="file" accept="image/x-png,image/gif,image/jpeg" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group form-float">
                            <div class="form-line">
                                <input type="text" class="form-control" name="studNo" minlength="12" maxlength="12" title="LRN max number is 12 " oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" required>
                                <label class="form-label">LRN</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group form-float">
                            <div class="form-line">
                                <input name="lname" type="text" class="form-control" required>
                                <label class="form-label">Lastname</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group form-float">
                            <div class="form-line">
                                <input name="fname" type="text" class="form-control" required>
                                <label class="form-label">Firstname</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group form-float">
                            <div class="form-line">
                                <input name="mname" type="text" class="form-control" required>
                                <label class="form-label">Middlename</label>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group form-float">
                            <div class="form-line">
                                <input name="email" type="email" class="form-control" required>
                                <label class="form-label">Email</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group form-float">
                            <div class="form-line">
                                <input type="text" class="form-control" name="contact" minlength="11" maxlength="11" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" pattern="[0-9]+.{10,}" title="Must contain at least 11 digit" required>
                                <label class="form-label">Contact</label>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-8">
                        <div class="form-group form-float">
                            <div class="form-line">
                                <label class="form-label">Birthday</label>
                                <input name="bday" type="date" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group form-float">
                            <div class="form-line">
                                <input name="age" type="number" class="form-control" required>
                                <label class="form-label">Age</label>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-8">
                        <div class="form-group form-float">
                            <div class="form-line">
                                <input name="address" type="text" class="form-control" required>
                                <label class="form-label">Address</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group form-float">
                            <div class="form-line">
                                <select name="gender" class="form-control select" required>
                                    <option>Male</option>
                                    <option>Female</option>
                                </select>
                                <label class="form-label">Gender</label>
                            </div>
                        </div>
                    </div>



                    <div class="col-md-6">
                        <div class="form-group form-float">
                            <label class="form-label">Gr. Yr.</label>
                            <div class="form-line">

                                <select type="text" name="gr_yr" id="grade" class="form-control" required>
                                    <option></option>
                                    <?php $res = my_query("SELECT *,CONCAT( value)sec  FROM tbl_settings_constants WHERE category='Grade' ORDER BY id  ");
                                    for ($i = 1; $r = $res->fetch(); $i++) {   ?>
                                        <option value="<?= $r['sec']; ?>"><?= $r['sec']; ?></option>
                                    <?php } ?>
                                </select>


                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group form-float">
                            <label class="form-label">Section</label>
                            <div class="form-line">

                                <select type="text" id="section" name="section" class="form-control" required></select>
                                </select>
                            </div>
                        </div>
                    </div>




                </div>

                <div class="modal-footer">
                    <button type="submit" value="IU<?= $title; ?>" name="func_param" class="btn btn-primary waves-effect">
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
$result = my_query("SELECT *  FROM tbl_students");
for ($i = 1; $row = $result->fetch(); $i++) {
    $id = $row['id']; ?>
    <div class="modal fade" id="edit<?= $id; ?>" role="dialog">
        <div class="modal-dialog  modal-smd" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="defaultModalLabel">Edit <?= $title; ?></h4>
                </div>
                <form action="models/CRUDS.php" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="id" value="<?= $id; ?>">
                    <input type="hidden" name="status" value="<?= $row['status']; ?>">

                    <div class="modal-body">

                        <div class="col-md-8">
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <input name="pic" type="file" accept="image/x-png,image/gif,image/jpeg" class="form-control" accept="images*">
                                    <input name="pic1" type="hidden" value="<?= $row['pic']; ?>">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <input name="studNo" type="text" class="form-control" value="<?= $row['studNo']; ?>" minlength="12" maxlength="12" title="LRN max number is 12 " oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" required>
                                    <label class="form-label">LRN</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <input name="lname" type="text" class="form-control" value="<?= $row['lname']; ?>" required>
                                    <label class="form-label">Last Name</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <input name="fname" type="text" class="form-control" value="<?= $row['fname']; ?>" required>
                                    <label class="form-label">First Name</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <input name="mname" type="text" class="form-control" value="<?= $row['mname']; ?>" required>
                                    <label class="form-label">Middle Name</label>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <input name="email" type="email" class="form-control" value="<?= $row['email']; ?>" required>
                                    <label class="form-label">Email</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <input name="contact" type="text" class="form-control" value="<?= $row['contact']; ?>" placeholder="(ex. 09 502 *** ***)" minlength="11" maxlength="11" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" pattern="[0-9]+.{10,}" title="Must contain at least 11 digit" required>
                                    <label class="form-label">Contact</label>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-8">
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <label class="form-label">Birthday</label>
                                    <input name="bday" type="date" value="<?= $row['bday']; ?>" class="form-control" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <input name="age" type="number" value="<?= $row['age']; ?>" class="form-control" required>
                                    <label class="form-label">Age</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <input name="address" type="text" class="form-control" value="<?= $row['address']; ?>" required>
                                    <label class="form-label">Address</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <select name="gender" class="form-control select" required>
                                        <option><?= $row['gender']; ?></option>
                                        <option>Male</option>
                                        <option>Female</option>
                                    </select>
                                    <label class="form-label">Gender</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <input name="username" type="text" class="form-control" value="<?= $row['username']; ?>" required>
                                    <label class="form-label">Username</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <input name="password" type="text" class="form-control" value="<?= $row['password']; ?>" required>
                                    <label class="form-label">Password </label>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group form-float">
                                <label class="form-label">Gr. Yr.</label>
                                <div class="form-line">

                                    <select name="gr_yr" class="form-control" required>
                                        <option></option>
                                        <?php $res = my_query("SELECT *,CONCAT( value)sec  FROM tbl_settings_constants WHERE category='Grade'  ORDER BY id  ");
                                        for ($i = 1; $r = $res->fetch(); $i++) {   ?>
                                            <option <?= ($row['gr_yr'] == $r['sec'] ? 'selected' : '');  ?> value="<?= $r['sec']; ?>"><?= $r['sec']; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group form-float">
                                <label class="form-label">Section</label>
                                <div class="form-line">

                                    <select name="section" class="form-control" required>
                                        <option></option>
                                        <?php $res = my_query("SELECT *,CONCAT( value)sec  FROM tbl_settings_constants WHERE category='Section'  ");
                                        for ($i = 1; $r = $res->fetch(); $i++) {   ?>
                                            <option <?= ($row['section'] == $r['sec'] ? 'selected' : '');  ?> value="<?= $r['sec']; ?>"><?= $r['sec']; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                        </div>



                    </div>
                    <div class="modal-footer">
                        <button type="submit" value="IU<?= $title; ?>" name="func_param" class="btn btn-warning waves-effect">
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
                        <input value="<?= $id; ?>" name="id" type="hidden" class="form-control" required>
                        <div class="col-md-12" style="text-align: center;">
                            <h4>Are you sure you want to delete <br />
                                (<i>
                                    <b>
                                        <a data-dismiss="modal" class="call_info" data-id="
            asd" type="button" data-toggle="modal" data-target="#edit<?= $id; ?>" style="color: red" id="removeNo"> <?= $row['studNo'] . '-' . $row['fname']; ?>
                                        </a>
                                    </b>
                                </i> )
                                information? <br />There is NO undo! </h4>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" value="delete<?= $title; ?>" name="func_param" class="btn btn-danger waves-effect">
                            DELETE
                        </button>
                        <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">CLOSE</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php } ?>




</div>

<?php include_once('layout/footer1.php'); ?>