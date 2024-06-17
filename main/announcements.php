<?php include_once('layout/head.php'); ?>
<?php $title = 'Announcement'; ?>

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

                            <?php if ($_SESSION['role'] <> "Student") { ?>
                                <a class="btn right btn-success  waves-effect waves-light yellow darken-4" data-toggle="modal" data-target="#add">
                                    <i class="material-icons">add</i>ADD </a>
                            <?php } ?>
                            <h2>
                                <?=strtoupper($title.'s');?>
                            </h2>

                        </div>
                        <div class="body">

                            <?php if ($user_role == $mainUser) { ?>

                                <div id="aniimated-thumbnials" class="list-unstyled row clearfix">

                                    <?php $result = my_query("SELECT *,a.pic as pic FROM tbl_announcements a INNER JOIN tbl_users u ON u.id=a.added_by ORDER BY a.id DESC");
                                    for ($i = 1; $row = $result->fetch(); $i++) {
                                        $id = $row['id']; ?>
                                        <div class="col-lg-12 col-md-12 col-sm-6 col-xs-12">
                                            <a href="../images/ann/<?= $row['pic']; ?>" data-sub-html="Demo Description">
                                                <img class="img-responsive thumbnail" src="../images/ann/<?= $row['pic']; ?>">
                                            </a>
                                            <div align="center" class="group">
                                                <h2><?= $row['title']; ?></h2><br/>
                                                <label><?= $row['description']; ?></label><br/>
                                                <label>Date/Time:<?= format_date($row['xdt']) . ' ' .format_time($row['xtime']); ?></label><br/>
                                                <label>By:<?= $row['role'] . " " . $row['fname'] . ' ' . $row['lname']; ?></label><br/>
                                            </div>
                                        </div>
                                    <?php } ?>

                                </div>

                            <?php } else { ?>
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                        <thead>
                                        <tr>
                                            <th>Picture</th>
                                            <th>Title</th>
                                            <th>Description</th>
                                            <th>Date</th>
                                            <th>Time</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>

                                        <?php $result = my_query("SELECT * FROM tbl_announcements ORDER BY id DESC");
                                        for ($i = 1; $row = $result->fetch(); $i++) {
                                            $id = $row['id']; ?>
                                            <tr>
                                                <td><img width="50" src="../images/ann/<?= $row['pic']; ?>"/></td>
                                                <td><?= $row['title']; ?></td>
                                                <td><?= $row['description']; ?></td>
                                                <td><?= format_date($row['xdt']); ?></td>
                                                <td><?= format_time($row['xtime']); ?></td>
                                                <td>
                                                    <a title="Edit" class="btn right btn-warning waves-effect waves-light yellow darken-4 col s12" data-toggle="modal" data-target="#edit<?= $id; ?>">
                                                        <i class="material-icons">mode_edit</i></a>

                                                    <a title="Delete" class="btn right btn-danger waves-effect waves-light yellow darken-4 col s12" data-toggle="modal" data-target="#delete<?= $id; ?>">
                                                        <i class="material-icons">delete_forever</i>
                                                    </a>

                                                </td>
                                            </tr>
                                        <?php } ?>
                                        </tbody>
                                    </table>
                                </div>

                            <?php } ?>

                        </div>
                    </div>
                </div>
            </div>


        </div>
    </section>


    <!--==================================== ADD,EDIT,DELETE Dialogs ====================================== -->
    <!-- Add -->

    <div class="modal fade" id="add" tabindex="-1" role="dialog">
        <div class="modal-dialog  modal-smd" role="document">
            <div class="modal-content">

                <form action="models/CRUDS.php" method="POST" enctype="multipart/form-data">
                    <div class="modal-header">
                        <h4 class="modal-title" id="defaultModalLabel">Add <?= $title; ?>
                        </h4>
                        <div class="col-md-8">
                            <input name="pic" type="file" class="form-control" accept="images*" required>
                        </div>
                    </div>
                    <div class="modal-body">

                        <div class="col-md-12">
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <input name="title" type="text" class="form-control" required>
                                    <label class="form-label">Title</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <input name="description" type="text" class="form-control" required>
                                    <label class="form-label">Description</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <label class="form-label">Date</label>
                                    <input name="xdt" type="date" class="form-control" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <label class="form-label">Time</label>
                                    <input name="xtime" type="time" class="form-control" required>

                                </div>
                            </div>
                        </div>

                        <div id="summernote"><p>Hello Summernote</p></div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" value="IU<?= $title; ?>" name="func_param" class="btn btn-primary waves-effect">SAVE
                        </button>
                        <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">CLOSE</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

<?php
$result = my_query("SELECT *  FROM tbl_announcements");
for ($i = 1; $row = $result->fetch(); $i++) {
    $id = $row['id']; ?>
    <!-- Edit -->
    <div class="modal fade" id="edit<?= $id; ?>" tabindex="-1" role="dialog">
        <div class="modal-dialog  modal-smd" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="defaultModalLabel">Edit Announcement</h4>
                </div>
                <form action="models/CRUDS.php" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="id" value="<?= $id; ?>">
                    <input name="pic1" type="hidden" value="<?= $row['pic']; ?>">


                    <div class="modal-body">


                        <div class="col-md-12">
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <input name="pic" type="file" class="form-control" accept="images*">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <input name="title" type="text" class="form-control" value="<?= $row['title']; ?>" required>
                                    <label class="form-label">Title</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <input name="description" type="text" class="form-control" value="<?= $row['description']; ?>" required>
                                    <label class="form-label">Description</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <label class="form-label">Date</label>
                                    <input name="xdt" type="date" class="form-control" value="<?= $row['xdt']; ?>" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <label class="form-label">Time</label>
                                    <input name="xtime" type="time" class="form-control" value="<?= $row['xtime']; ?>" required>
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
                        <input value="<?= $id;?>" name="id" type="hidden" class="form-control" required>
                        <div class="col-md-12" style="text-align: center;">
                            <h4>Are you sure you want to
                                delete <br/> (<i><b>
                                        <a data-dismiss="modal" class="call_info" data-id="
            asd" type="button" data-toggle="modal" data-target="#edit<?= $id; ?>" style="color: red" id="removeNo"> <?= $row['title']; ?></a></b></i>
                                ) information? <br/> </h4>
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

<?php include_once('layout/footer.php'); ?>