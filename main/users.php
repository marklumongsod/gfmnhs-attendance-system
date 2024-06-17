<?php include_once('layout/head.php');
$title = 'User'
?>

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
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                        <strong> <?= (isset($_GET['msg']) ? $_GET['msg'] : 'Successfully ' . $r); ?>
                                            !</strong>
                                    </div>
                                <?php endif; ?>
                            </div>

                            <a class="btn right btn-success waves-effect waves-light yellow darken-4 col s12" data-toggle="modal" data-target="#add">
                                <i class="material-icons">add</i>ADD
                            </a>
                            <h2>
                                <?= strtoupper($title . 's'); ?>
                            </h2>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                    <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Username</th>
                                        <th>Role</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    if (isset($_GET['role'])) {
                                        $rol = $_GET['role'];
                                        $sql = "SELECT *,CONCAT(lname,', ',fname)fullname FROM tbl_users WHERE status='Active' AND role='$rol' ORDER BY id DESC";
                                    } else {
                                        $sql = "SELECT *,CONCAT(lname,', ',fname)fullname FROM tbl_users WHERE status='Active'  ORDER BY id DESC";
                                    }

                                    $result = my_query($sql);
                                    for ($i = 1; $row = $result->fetch(); $i++) { ?>
                                        <tr>
                                            <td><?= $row['fullname']; ?></td>
                                            <td><?= $row['username']; ?></td>
                                            <td><?= $row['role']; ?></td>
                                            <td>
                                                <?php if ($row['role'] <> "Admin") { ?>
                                                    <a title="Delete" class="btn right btn-danger waves-effect waves-light yellow darken-4 col s12" data-toggle="modal" data-target="#delete<?= $row['id']; ?>">
                                                        <i class="material-icons">delete_forever</i>
                                                    </a>
                                                <?php } ?>
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


    <div class="modal fade" id="add" role="dialog">
        <div class="modal-dialog  modal-sm" role="document">
            <div class="modal-content">

                <form action="models/CRUDS.php" method="POST" enctype="multipart/form-data">
                    <div class="modal-header">
                        <h4 class="modal-title" id="defaultModalLabel">Add <?= $title; ?>
                        </h4>
                    </div>
                    <div class="modal-body">

                        <div class="col-md-12">
                            <div class="form-group form-float">
                                <label class="form-label">Role</label>
                                <div class="form-line">
                                    <select name="role" class="form-control select" required>
                                        <?php
                                        $result = db_select_where('tbl_settings_constants', ["category" => 'User Type']);
                                        for ($i = 1; $row = $result->fetch(); $i++) { ?>
                                            <option><?=$row['value'];?></option>
                                        <?php } ?>
                                    </select>

                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <input name="fname" type="text" class="form-control" required>
                                    <label class="form-label">Firstame</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <input name="lname" type="text" class="form-control" required>
                                    <label class="form-label">Lastname</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <input name="username" type="text" class="form-control" required>
                                    <label class="form-label">Username</label>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="submit" name="func_param" value="IUUser" class="btn  btn-info waves-effect">SAVE
                        </button>
                        <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">CLOSE</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

<?php
$res = my_query("SELECT *,CONCAT(fname,' ',lname)fullname  FROM tbl_users");
for ($i = 1; $row = $res->fetch(); $i++) {
    $id = $row['id']; ?>
    <!-- Delete -->
    <div class="modal fade" id="delete<?= $row['id']; ?>" tabindex="-1" role="dialog">
        <div class="modal-dialog  modal-smd" role="document">
            <div class="modal-content">
                <form action="models/CRUDS.php" method="POST">
                    <div class="modal-body">
                        <input value="<?= $row['id']; ?>" name="id" type="hidden" class="form-control" required>
                        <div class="col-md-12" style="text-align: center;">
                            <h4>Are you sure you want to delete <br/>
                                (<i>
                                    <b>
                                        <a data-dismiss="modal" class="call_info" data-id="
            asd" type="button" data-toggle="modal" data-target="#edit<?= $id; ?>" style="color: red"
                                           id="removeNo"> <?= $row['role'] . '-' . $row['fname']; ?>
                                        </a>
                                    </b>
                                </i> )
                                information? <br/> </h4>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" value="deleteUser" name="func_param" class="btn btn-danger waves-effect">
                            DELETE
                        </button>
                        <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">CLOSE</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php } ?>


<?php include_once('layout/footer.php'); ?>