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
                        <?php if ($_SESSION['role'] == 'Admin') { ?>
                            <a class="btn right btn-success  waves-effect waves-light yellow darken-4"
                               data-toggle="modal" data-target="#add"> <i class="material-icons">add</i>ADD </a>
                        <?php } ?>
                        <h2>
                            CLASS
                        </h2>

                    </div>
                    <div class="body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                <thead>
                                <tr>
                                    <th>Teacher</th>
                                    <th>Grade-Section</th>
                                    <th>Subject</th>
                                    <th width="10%">Action</th>
                                </tr>
                                </thead>
                                <tfoot>
                                <tr>
                                    <th>Teacher</th>
                                    <th>Grade-Section</th>
                                    <th>Subject</th>
                                    <th>Action</th>
                                </tr>
                                </tfoot>
                                <tbody>

                                <?php
                                $classyr = $_SESSION['classyr'];
                                if ($_SESSION['role'] == 'Teacher') {
                                    $facId = $_SESSION['user_id'];
                                    $result = my_query("SELECT *,CONCAT(fname,' ',lname)teacher,CONCAT(section,'-',subject)classInfo ,c.id as cid FROM tbl_class c INNER JOIN tbl_users u ON u.id=c.facId WHERE classyr='$classyr' AND facId='$facId' ORDER BY c.id DESC");
                                } else {
                                    $result = my_query("SELECT *,CONCAT(fname,' ',lname)teacher,CONCAT(section,'-',subject)classInfo ,c.id as cid FROM tbl_class c INNER JOIN tbl_users u ON u.id=c.facId WHERE classyr='$classyr' ORDER BY c.id DESC");
                                }


                                for ($i = 1; $row = $result->fetch(); $i++) {
                                    $id = $row['cid']; ?>
                                    <tr>
                                        <td><?= $row['teacher']; ?></td>
                                        <td><?= $row['section']; ?></td>
                                        <td><?= $row['subject']; ?></td>
                                        <td>

                                            <?php if ($_SESSION['role'] == 'Admin') { ?>
                                                <a type="submit" title="Edit"
                                                   class="btn right btn-warning waves-effect waves-light yellow darken-4 col s12"
                                                   data-toggle="modal" data-target="#edit<?= $id; ?>">
                                                    <i class="material-icons">mode_edit</i></a>
                                                <a type="submit" title="Delete"
                                                   class="btn right btn-danger waves-effect waves-light yellow darken-4 col s12"
                                                   data-toggle="modal" data-target="#delete<?= $id; ?>">
                                                    <i class="material-icons">delete_forever</i></a>


                                            <?php } ?>
                                            <a title="View Student" href="studclass.php?classId=<?= $id; ?>&section=<?= $row['section']; ?>&classInfo=<?= $row['teacher'] . '/' . $row['classInfo']; ?>"
                                               class="btn right btn-primary waves-effect waves-light yellow darken-4 col s12">
                                                <i class="material-icons">search</i> </a>

                                            <a title="View Attendance" href="studclassattendance.php?classId=<?= $id; ?>&section=<?= $row['section']; ?>&classInfo=<?= $row['teacher'] . '/' . $row['classInfo']; ?>"
                                               class="btn right btn-warning waves-effect waves-light yellow darken-4 col s12">
                                                <i class="material-icons">search</i> </a>

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


<div class="modal fade" id="add"  role="dialog">
    <div class="modal-dialog  modal-smd" role="document">
        <div class="modal-content">

            <form action="models/CRUDS.php" method="POST" enctype="multipart/form-data">
                <div class="modal-header">
                    <h4 class="modal-title" id="defaultModalLabel">Add Class
                    </h4>

                </div>
                <div class="modal-body">

                    <div class="col-md-12">
                        <div class="form-group form-float">
                            <label class="form-label">Teacher</label>
                            <div class="form-line">
                                <select name="facId" class="form-control select" required>
                                    <option> </option>
                                    <?php $res = my_query("SELECT *,CONCAT(fname,' ',lname)teacher  FROM tbl_users u WHERE role='Teacher' ");
                                    for ($i = 1; $r = $res->fetch(); $i++) {
                                        $id = $r['id']; ?>
                                        <option value="<?= $r['id']; ?>"><?= $r['teacher']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                    </div>


                    <div class="col-md-12">
                        <div class="form-group form-float">
                            <label class="form-label">Section</label>
                            <div class="form-line">
                                <select name="section" class="form-control select" required>
                                    <option> </option>
                                    <?php $res = my_query("SELECT *  FROM tbl_settings_constants WHERE category='Section'  ");
                                    for ($i = 1; $r = $res->fetch(); $i++) {
                                        $id = $r['id']; ?>
                                        <option value="<?= $r['value']; ?>"><?= $r['value']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group form-float">
                            <label class="form-label">Subject</label>
                            <div class="form-line">
                                <select name="subject" class="form-control select" required>
                                    <option> </option>
                                    <?php $res = my_query("SELECT *  FROM tbl_settings_constants WHERE category='Subject'  ");
                                    for ($i = 1; $r = $res->fetch(); $i++) {
                                        $id = $r['id']; ?>
                                        <option value="<?= $r['value']; ?>"><?= $r['value']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                    </div>


                </div>
                <div class="modal-footer">
                    <button type="submit" value="IUClass" name="func_param" class="btn btn-primary waves-effect">SAVE
                    </button>
                    <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">CLOSE</button>
                </div>
            </form>
        </div>
    </div>
</div>


<?php
$result = my_query("SELECT *  FROM tbl_class");
for ($i = 1; $row = $result->fetch(); $i++) {
$id = $row['id']; ?>


<!-- Delete -->
<div class="modal fade" id="delete<?= $id; ?>"   role="dialog">
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
                                       id="removeNo"> <?= $row['section']; ?> <?= date("h:i A", strtotime($row['start'])); ?>
                                        - <?= date("h:i A", strtotime($row['end'])); ?></a></b></i> ) information?
                            <br/>There is NO undo! </h4>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" value="deleteClass" name="func_param" class="btn btn-danger waves-effect">
                        DELETE
                    </button>
                    <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">CLOSE</button>
                </div>
            </form>
        </div>
    </div>
</div>


    <div class="modal fade" id="edit<?= $id; ?>" tabindex="-1" role="dialog">
        <div class="modal-dialog  modal-smd" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="defaultModalLabel">Edit Class</h4>
                </div>
                <form action="models/CRUDS.php" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="id" value="<?= $id; ?>">

                    <div class="modal-body">

                        <div class="col-md-12">
                            <div class="form-group form-float">
                                <label class="form-label">Teacher</label>
                                <div class="form-line">
                                    <select name="facId" class="form-control select" required>
                                        <option> </option>
                                        <?php $res = my_query("SELECT *,CONCAT(fname,' ',lname)teacher  FROM tbl_users u WHERE role='Teacher' ");
                                        for ($i = 1; $r = $res->fetch(); $i++) {
                                            $id = $r['id']; ?>
                                            <option <?=($row['facId']==$r['id'] ? 'selected' : '');  ?> value="<?= $r['id']; ?>"><?= $r['teacher']; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                        </div>


                        <div class="col-md-12">
                            <div class="form-group form-float">
                                <label class="form-label">Section</label>
                                <div class="form-line">
                                    <select name="section" class="form-control select" required>
                                        <option> </option>
                                        <?php $res = my_query("SELECT *  FROM tbl_settings_constants WHERE category='Section'  ");
                                        for ($i = 1; $r = $res->fetch(); $i++) {
                                            $id = $r['id']; ?>
                                            <option <?=($row['section']==$r['value'] ? 'selected' : '');  ?> value="<?= $r['value']; ?>"><?= $r['value']; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group form-float">
                                <label class="form-label">Subject</label>
                                <div class="form-line">
                                    <select name="subject" class="form-control select" required>
                                        <option> </option>
                                        <?php $res = my_query("SELECT *  FROM tbl_settings_constants WHERE category='Subject'  ");
                                        for ($i = 1; $r = $res->fetch(); $i++) {
                                            $id = $r['id']; ?>
                                            <option <?=($row['subject']==$r['value'] ? 'selected' : '');  ?> value="<?= $r['value']; ?>"><?= $r['value']; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                        </div>


                    </div>
                    <div class="modal-footer">
                        <button type="submit" value="IUClass" name="func_param" class="btn btn-warning waves-effect">
                            UPDATE
                        </button>
                        <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">CLOSE</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php }?>

<?php include_once('layout/footer.php'); ?>

