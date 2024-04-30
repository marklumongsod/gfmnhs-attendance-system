<?php include_once('layout/head.php'); ?>
<?php $title = 'Login'; ?>
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
 
                         
                            <h2>
                                <?=strtoupper('Login  ');?>
                            </h2>

                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                    <thead>
                                    <tr>
                                        <th>Student Name</th>
                                        <th>Date</th>
                                        <th>  Time</th>
                                        <th>Status</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php $result = my_query("SELECT i.id,CONCAT(fname, ' ' ,lname)fullname,xdate,xtime  ,i.status  FROM tbl_inout i INNER JOIN tbl_students r ON r.id=i.stud_id  WHERE stud_id='$user_id'  ORDER BY id DESC ");
                                    for ($i = 1; $row = $result->fetch(); $i++) {
                                        $id = $row['id']; ?>
                                        <tr>
                                            <td><?= $row['fullname']; ?></td>
                                            <td><?= $row['xdate']; ?></td>
                                            <td><?= $row['xtime']; ?></td>
                                            <td><?= $row['status']; ?></td>
                                       
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
 
 
 

<?php include_once('layout/footer.php'); ?>