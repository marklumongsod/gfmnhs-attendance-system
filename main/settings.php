<?php include_once ('layout/head.php');?>


<section class="content">
    <div class="container-fluid">

        <?php $result = $db->prepare("SELECT  * FROM tbl_companyinfo WHERE id='1'");
        $result->execute();
        if($row = $result->fetch()) {  ?>

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
                        <h2>
                            Content Management System
                        </h2>
                    </div>
                    <div class="body">
                        <form action="models/CRUDS.php" method="POST">


                            <div class="col-md-12">
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input name="mission" type="text" class="form-control" value="<?=$row['mission'];?>" required>
                                        <label class="form-label">Mission</label>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input name="vision" type="text" class="form-control" value="<?=$row['vision'];?>" required>
                                        <label class="form-label">Vision</label>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input name="termsCondition" type="text" class="form-control" value="<?=$row['termsCondition'];?>" required>
                                        <label class="form-label">Terms And Condition</label>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input name="aboutIntro" type="text" class="form-control" value="<?=$row['aboutIntro'];?>" required>
                                        <label class="form-label">About Intro</label>
                                    </div>
                                </div>
                            </div>
                            <!-- `profile`, ``, `quotation`, `name`, ``, `bannerImg`, `mapFrame` FROM `tbl_companyinfo` WHERE 1 -->

                            <div class="col-md-12">
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input name="contact" type="text" class="form-control" value="<?=$row['contact'];?>" required>
                                        <label class="form-label">Contact</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input name="address" type="text" class="form-control" value="<?=$row['address'];?>" required>
                                        <label class="form-label">Address</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input name="aboutUs" type="text" class="form-control" value="<?=$row['aboutUs'];?>" required>
                                        <label class="form-label">About Us</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input name="email" type="email" class="form-control" value="<?=$row['email'];?>" required>
                                        <label class="form-label">Email</label>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-xs-8 p-t-5">
                                </div>
                                <div class="col-xs-4">
                                    <button class="btn btn-block bg-orange waves-effect"  type="submit" name="func_param" value="updateCMS"  >Update</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        <?php } ?>

    </div>
</section>

<?php include_once ('layout/footer.php');?>

