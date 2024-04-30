<?php include_once('layout/head.php'); ?>

    <section class="content">
        <div class="container-fluid">

            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                <?= strtoupper($_GET['cat'].'s');
                                $title=$_GET['cat'];
                                echo ' - ';
                                if (isset($_GET['id'])) {
                                    echo $function = 'Edit';
                                    $tbl = 'tbl_' . $_GET['cat'].'s';
                                } else {
                                    echo $function = 'Add';
                                    $tbl = 'tbl_' . $_GET['cat'].'s';
                                }

                                ?>
                            </h2>
                        </div>
                        <div class="body">
                            <div class="hidden">
                                <textarea hidden id="ckeditor" style="display:none;">    </textarea>
                            </div>
                            <form action="models/CRUDS.php" method="POST" enctype="multipart/form-data">
                                <input name="stat" type="hidden" value="Inactive">
<?php  if (isset($_GET['id'])) {
   $quarter = db_get_result($tbl,'quarter',["id"=>$_GET['id']]); ?>
    <input name="id" type="hidden" value="<?=$_GET['id'];?>">

<?php }?>
                                <label class="form-label">Quarter</label>
                                <div class="form-line">
                                    <select name="quarter" class="form-control select">
                                        <?php $res = my_query("SELECT * FROM tbl_settings_constants  WHERE category='Quarter'");
                                        for ($x = 1; $r = $res->fetch(); $x++) { ?>
                                            <option value="<?= $r['value']; ?>"
                                            <?php  if (isset($_GET['id'])) {
                                                if (strpos($r['value'], $quarter) !== false  ) { echo 'selected'; }
                                            } ?>
                                            ><?= $r['value'] . ' - ' . $r['sub_value']; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>

                                <label class="form-label">Title</label>
                                <div class="form-line">
                                    <input name="title" type="text" class="form-control" value="<?php  if (isset($_GET['id'])) { echo db_get_result($tbl,'title',["id"=>$_GET['id']]); }?>" required>
                                </div>


                                <label class="form-label">Description</label>
                                <textarea id="tinymce" name="description"><?php  if (isset($_GET['id'])) { echo db_get_result($tbl,'description',["id"=>$_GET['id']]); }?>  </textarea>
                                <div class="modal-footer">
                                    <button type="submit" value="IU<?= $title; ?>" name="func_param" class="btn btn-primary waves-effect">
                                        SAVE
                                    </button>

                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# TinyMCE -->
        </div>
    </section>

<?php include_once('layout/footer.php'); ?>