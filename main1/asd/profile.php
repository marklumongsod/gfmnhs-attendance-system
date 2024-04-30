<?php include_once('layout/head.php'); ?>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <section class="content">
        <div class="container-fluid">
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

                    <div class="body">
                        <div class="card">
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
                                        <button type="button" class="close" data-dismiss="alert"
                                                aria-label="Close"><span
                                                    aria-hidden="true">×</span></button>
                                        <strong>Successfully <?php echo $r; ?>!</strong>
                                    </div>
                                <?php endif; ?></div>

                            <div class="header">
                                <h2>
                                    PROFILE (<?php
                                    echo db_get_result($tbl, 'regNo', ["id" => $_GET['id']]); ?>)
                                    <small>View <?= $mainUser; ?> Information</small>
                                </h2>
                            </div>

                            <div class="body">

                                <?php
                                $id = $_GET['id'];
                                $result = my_query("SELECT *  FROM $tbl WHERE id='$id'  ");
                                if ($row = $result->fetch()) {
                                $status = $row['status']; ?>

                                <!-- Nav tabs -->
                                <ul class="nav nav-tabs" role="tablist">
                                    <li role="presentation" class="active">
                                        <a href="#profile" data-toggle="tab">
                                            <i class="material-icons">face</i> PROFILE
                                        </a>
                                    </li>
                                    <!--                                    --><?php //if ($status == 'Approved') { ?>
                                    <li role="presentation">
                                        <a href="#training" data-toggle="tab">
                                            <i class="material-icons">history</i> training
                                        </a>
                                    </li>

                                </ul>

                                <!-- Tab panes -->
                                <div class="tab-content">

                                    <div role="tabpanel" class="tab-pane fade in active" id="profile">
                                        <form action="models/CRUDS.php" method="POST">
                                            <div class="row">
                                                <input value="<?= $row['id']; ?>" name="id" type="hidden">
                                                <div class="col-md-4">
                                                    <div class="form-group form-float">
                                                        <div class="form-line">
                                                            <input name="<?= $mainUserNo; ?>" type="text" value="<?= $row[$mainUserNo]; ?>" minlength="10" class="form-control"
                                                                   required>
                                                            <label class="form-label">SRN #</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group form-float">
                                                        <div class="form-line">
                                                            <input name="fname" type="text" value="<?= $row['fname']; ?>" class="form-control"
                                                                   required>
                                                            <label class="form-label">Firstname</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group form-float">
                                                        <div class="form-line">
                                                            <input name="lname" type="text" value="<?= $row['lname']; ?>" class="form-control"
                                                                   required>
                                                            <label class="form-label">Lastname</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group form-float">
                                                        <div class="form-line">
                                                            <label class="form-label">Middlename</label>
                                                            <input name="mname" type="text" value="<?= $row['mname']; ?>" class="form-control"
                                                                   required>
                                                        </div>
                                                    </div>
                                                </div>


                                                <div class="col-md-4">
                                                    <div class="form-group form-float">
                                                        <div class="form-line">
                                                            <label class="form-label">Email</label>
                                                            <input name="email" type="email" value="<?= $row['email']; ?>" class="form-control"
                                                                   required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group form-float">
                                                        <div class="form-line">
                                                            <label class="form-label">Contact</label>
                                                            <input name="contact" type="text" value="<?= $row['contact']; ?>"
                                                                   class="form-control" required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group form-float">
                                                        <div class="form-line">
                                                            <select name="gender" class="form-control select" required>
                                                                <option></option>
                                                                <option <?php if ($row['gender'] == 'Female') {
                                                                    echo 'selected';
                                                                } ?>>Female
                                                                </option>
                                                                <option <?php if ($row['gender'] == 'Male') {
                                                                    echo 'selected';
                                                                } ?>>Male
                                                                </option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group form-float">
                                                        <div class="form-line">
                                                            <label class="form-label">Address</label>
                                                            <input name="address" type="text" value="<?= $row['address']; ?>"
                                                                   class="form-control" required>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-3">
                                                    <div class="form-group form-float">
                                                        <div class="form-line">
                                                            <label class="form-label">Birth Date</label>
                                                            <input name="bday" type="date"  id="bday" onchange="getAge()"   max="<?= $dateNow; ?>" value="<?= $row['bday']; ?>" class="form-control" required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-1">
                                                    <div class="form-group form-float">
                                                        <div class="form-line">
                                                            <label class="form-label">Age</label>
                                                            <input name="age" type="number" id="age" value="<?= $row['age']; ?>"
                                                                   class="form-control" required readonly>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                            <button type="submit" value="update<?= $mainUser; ?>Profile" name="func_param" class="btn btn-warning waves-effect">
                                                UPDATE
                                            </button>
                                        </form>
                                        <?php } ?>

                                    </div>

                                    <div role="tabpanel" class="tab-pane fade" id="training">
                                        asdsa
                                    </div>


                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>


<?php include_once('layout/footer.php'); ?>