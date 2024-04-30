<?php include_once('layout/head.php'); ?>


<section class="content">
    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">

                    <div class="body">
                        <div id="aniimated-thumbnials" class="list-unstyled row clearfix">
                            <?php if (isset($_GET['cat'])) { ?>
                                <form action="models/CRUDS.php" method="POST">

                                    <?php $id = $_GET['id'];
                                    $result = my_query(" SELECT  a.id,answer,testType,question,answer,choice1,choice2,choice3  FROM tbl_activity_teacher ate INNER JOIN tbl_activity_teacher_items a ON a.activity_teacher_id=ate.id WHERE  a.activity_teacher_id='$id' ORDER BY RAND()");
                                    for ($i = 0; $row = $result->fetch(); $i++) {
                                        $id = $row['id']; ?>


                                        <input type="hidden" name="correctAns[<?= $i; ?>]" value="<?= $row['answer']; ?>">
                                        <input type="hidden" name="activityItemId[<?= $i; ?>]" value="<?= $row['id']; ?>">
                                        <input type="hidden" name="activityId" value="<?= $_GET['id']; ?>">


                                        <div class="col-lg-12 col-md-4 col-sm-6 col-xs-12">
                                            <div align="center" class="group">
                                                <?php if ($row['testType'] == 'Multiple') { ?>

                                                    <div class="col-md-12">
                                                        <div class="form-group form-float">
                                                            <div class="form-line">
                                                                <label>Question <?= $i + 1; ?>
                                                                    : <?= $row['question']; ?> </label>
                                                                <input type="text" class="form-control" placeholder="choice 1" value="<?= $row['choice1']; ?>" required>
                                                                <input type="text" class="form-control" placeholder="choice 2" value="<?= $row['choice2']; ?>"/>
                                                                <input type="text" class="form-control" placeholder="choice 2" value="<?= $row['choice3']; ?>" required>
                                                                <select name="answer[<?= $i; ?>]" class="form-control select" required="">
                                                                    <option></option>
                                                                    <option>Choice 1</option>
                                                                    <option>Choice 2</option>
                                                                    <option>Choice 3</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php } else { ?>

                                                    <div class="col-md-12">
                                                        <div class="form-group form-float">
                                                            <div class="form-line">
                                                                <label>Question <?= $i + 1; ?>
                                                                    : <?= $row['question']; ?> </label>
                                                                <select name="answer[<?= $i; ?>]" class="form-control select" required="">
                                                                    <option> - Select - </option>
                                                                    <option>True</option>
                                                                    <option>False</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>


                                                <?php } ?>

                                                <!--

								<input type="hidden" name="correctAns[<?= $i; ?>]" value="<?= $row['answer']; ?>">
								<input type="hidden" name="activityItemId[<?= $i; ?>]" value="<?= $row['id']; ?>">
								<input type="hidden" name="activityId" value="<?= $_GET['id']; ?>"> -->


                                            </div>
                                        </div>
                                    <?php } ?>

                                    <div class="col-lg-12">
                                        <button type="submit" value="insertAcTeAns" name="func_param" class="form-control btn btn-info waves-effect">
                                            SUBMIT ANSWER
                                        </button>
                                    </div>
                                </form>
                            <?php } else { ?>


                                <?php
                                $studId = $_SESSION['user_id'];
                                $section = $_SESSION['section'];
                                $res = my_query("SELECT *  FROM tbl_activity_teacher at WHERE section='$section'  ");
                                for ($i = 1; $r = $res->fetch(); $i++) {
                                    $id = $r['id']; ?>
                                    <?php
                                    $result = my_query("SELECT *  FROM tbl_act_teacher_answer at WHERE activityId='$id' AND studId='$studId'  ");
                                    if ($row = $result->fetch()) { ?>

                                    <?php } else { ?>

                                        <a href="activity-teacher.php?id=<?= $r['id']; ?>&cat=<?= $r['id']; ?>">
                                            <button type="button" class="btn btn-block btn-lg btn-default waves-effect">
                                                Activity <?= $r['actNo']; ?></button>
                                        </a>

                                    <?php } ?>
                                    <div class="col-lg-12 col-md-4 col-sm-6 col-xs-12">
                                        <!--    <a href="../images/ann/<?= $row['pic']; ?>" data-sub-html="Demo Description">
                                        <img class="img-responsive thumbnail"  src="../images/ann/<?= $row['pic']; ?>">
                                    </a>
                                    <div align="center" class="group">
                                      <h2><?= $row['title']; ?></h2><br/>
                                      <label><?= $row['description']; ?></label><br/>
                                      <label>Date/Time:<?= $row['xdt'] . ' ' . $row['xtime']; ?></label><br/>
                                      <label>By:<?= $row['role'] . " " . $row['fname'] . ' ' . $row['lname']; ?></label><br/>
                                    </div>-->
                                    </div>
                                <?php } ?>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include_once('layout/footer.php'); ?>

