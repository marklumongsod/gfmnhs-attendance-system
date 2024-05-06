<?php include_once('layout/head.php'); ?>

    <section class="content">
        <div class="container-fluid">

            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                <?= strtoupper($_GET['cat'] . 's');
                                $title = $_GET['cat'];
                                if (isset($_GET['id'])) {
                                    $function = 'Edit';
                                    $tbl = strtolower('tbl_' . $_GET['cat'] . 's');
                                } else {
                                    $function = 'Add';
                                    $tbl = strtolower('tbl_' . $_GET['cat'] . 's');
                                } 
                                ?>

                            </h2>
                        </div>
                        <div class="body">

                            <?php if ($_GET['cat'] == 'Lesson') { ?>
                                <div class="hidden">
                                    <textarea hidden id="ckeditor" style="display:none;">    </textarea>
                                </div>
                                <form action="models/CRUDS.php" method="POST" enctype="multipart/form-data">
                                    <input name="stat" type="hidden" value="Inactive">
                                    <?php if (isset($_GET['id'])) {
                                        $quarter = db_get_result($tbl, 'quarter', ["id" => $_GET['id']]); ?>
                                        <input name="id" type="hidden" value="<?= $_GET['id']; ?>">

                                    <?php } ?>
                                  

    <h3><label class="form-label" style="color:red">Quarter</label></h2> 
                                    <div class="form-line">
                                    <?php if (isset($_GET['id'])) {
                                            echo db_get_result($tbl, 'quarter', ["id" => $_GET['id']]);
                                        } ?> 
                                    </div>
                                    
                                    <br/>
                                      <h3><label class="form-label" style="color:red">Title</label></h2>  
                                    <div class="form-line">
                                    <?php if (isset($_GET['id'])) {
                                            echo db_get_result($tbl, 'title', ["id" => $_GET['id']]);
                                        } ?> 
                                    </div>

<br/>
  <h3><label class="form-label" style="color:red">Description</label></h2>  
                                 <!-- <textarea id="tinymce" name="description">  -->
<?php if (isset($_GET['id'])) {
                                            echo db_get_result($tbl, 'description', ["id" => $_GET['id']]);
                                       } ?>
                                </form>


                            <?php } elseif ($_GET['cat'] == 'Record') { ?>
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Exercise</th>
                                            <th>Description</th>
                                            <th>Mark</th>
                                            <th>Score</th>
                                            <th>Created At</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        $result = my_query("SELECT * FROM tbl_exercises_score app $strW ORDER BY id DESC");
                                        for ($i = 1; $row = $result->fetch(); $i++) {
                                            $id = $row['id']; ?>
                                            <tr>
                                                <td> <?= $i; ?></td>
                                                <td> <?= db_get_result('tbl_exercises','exerNo',["id"=>$row['exercise_id']]); ?></td>
                                                <td> <?= $row['description']; ?></td>
                                                <td> <?= $row['mark']; ?></td>
                                                <td> <?= $row['score']; ?></td>
                                                <td> <?= format_datetime($row['created_at']); ?></td>

                                            </tr>
                                        <?php } ?>
                                        </tbody>
                                    </table>
                                </div>

                            <?php } elseif ($_GET['cat'] == 'Quiz') { ?>

                            <?php } ?>


                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# TinyMCE -->
        </div>
    </section>

<?php include_once('layout/footer.php'); ?>