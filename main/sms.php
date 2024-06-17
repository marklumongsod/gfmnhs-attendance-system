<?php include_once('layout/head.php'); ?>

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

                        <a class="btn right btn-success  waves-effect waves-light yellow darken-4"
                           data-toggle="modal" data-target="#add">
                            <i class="material-icons">add</i>ADD
                        </a>
                        <h2>
                            SMS
                        </h2>

                    </div>
                    <div class="body">


                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Number</th>
                                    <th>Msg</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $result = my_query("SELECT * FROM tbl_sms app $strW ORDER BY id DESC");
                                for ($i = 1; $row = $result->fetch(); $i++) {
                                    $id = $row['id']; ?>
                                    <tr>
                                        <td> <?= $i; ?></td>
                                        <td> <?= $row['contact']; ?></td>
                                        <td> <?= $row['message']; ?></td>
                                        <td> <?= $row['stat']; ?></td>
                                        <td>
                                            <a title="Delete" class="btn right btn-danger waves-effect waves-light yellow darken-4 col s12"
                                               data-toggle="modal" data-target="#delete<?= $id; ?>">
                                                <i class="material-icons">delete_forever</i>
                                            </a>
                                            <a title="Send" href="<?php echo "models/do.php?do=smsSend&id=" . $id; ?>" class="btn right btn-primary waves-effect waves-light yellow darken-4 col s12">
                                                <i class="material-icons">send</i>
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


<div class="modal fade" id="add" tabindex="-1" role="dialog">
    <div class="modal-dialog  modal-smd" role="document">
        <div class="modal-content">

            <form action="models/CRUDS.php" method="POST" enctype="multipart/form-data">
                <div class="modal-header">
                    <h4 class="modal-title" id="defaultModalLabel">Add SMS
                    </h4>
                </div>
                <div class="modal-body">

                    <div class="col-md-12">
                        <div class="form-group form-float">
                            <div class="form-line">
                                <label class="form-label">Contact</label>
                                <input name="contact" type="text" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group form-float">
                            <div class="form-line">
                                <input name="message" type="text" class="form-control" required>
                                <label class="form-label">Message</label>
                            </div>
                        </div>
                    </div>


                </div>
                <div class="modal-footer">
                    <button type="submit" value="IUSMS" name="func_param" class="btn btn-primary waves-effect">
                        SEND
                    </button>
                    <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">CLOSE</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit -->
<?php
$result = my_query("SELECT *  FROM tbl_sms");
for ($i = 1; $row = $result->fetch(); $i++) {
    $id = $row['id']; ?>

    <!-- Delete -->
    <div class="modal fade" id="delete<?= $id; ?>" tabindex="-1" role="dialog">
        <div class="modal-dialog  modal-smd" role="document">
            <div class="modal-content">
                <form action="models/CRUDS.php" method="POST">
                    <div class="modal-body">
                        <input value="<?= $id; ?>" name="id" type="hidden" class="form-control" required>
                        <div class="col-md-12" style="text-align: center;">
                            <h4>Are you sure you want to delete <br/>
                                (<i>
                                    <b>
                                        <a data-dismiss="modal" class="call_info" data-id="
            asd" type="button" data-toggle="modal" data-target="#edit<?= $id; ?>" style="color: red"
                                           id="removeNo"> <?= $row['contact'] . ':' . $row['message']; ?>
                                        </a>
                                    </b>
                                </i> )
                                information? <br/></h4>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" value="deleteSMS" name="func_param" class="btn btn-danger waves-effect">
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
