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
                                <?php if($user_role=='Admin'){   ?> 
  <a class="btn right btn-success  waves-effect waves-light yellow darken-4" data-toggle="modal" data-target="#add">
                                <i class="material-icons">add</i>ADD
                            </a>
                            <?php }?>
                         
                            <h2>
                                <?=strtoupper('Attendance List');?>
                            </h2>
                            Grade Level & Section :
                            <select class=" "  onchange="if (this.value) window.location.href=this.value"   required> >
                                   <option></option>
                                        <?php   
                                        if($user_role=='Admin'){
                                                $res = my_query("SELECT *  FROM tbl_class GROUP BY section ");  
                                        }else{
                                                $res = my_query("SELECT *  FROM tbl_class WHERE facId='$user_id' GROUP BY section");  
                                        }
                                    
                                        for($ix=1; $r = $res->fetch(); $ix++){  ?>
                                            <option <?=(isset($_GET['sec']) ? ($_GET['sec']==$r['section'] ? 'selected' : '') : '');  ?>    value="inout.php?sec=<?=$r['section'];?>" ><?=$r['section'];?></option>
                                        <?php } ?>
                            </select>

                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                    <thead>
                                    <tr>
                                        <th>Student Name</th>
                                        <th>LRN</th>
                                        <th>Section</th>
                                        <th>  Time</th>
                                        <th>Status</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    if(isset($_GET['sec'])){
                                        $section=$_GET['sec'];
$wh= " WHERE section='$section'";
                                    }else{
                                        $wh="";
                                    }
                                    $result = my_query("SELECT i.id,CONCAT(fname, ' ' ,lname)fullname,studNo,section,xdate,xtime 
                                     ,i.status  FROM tbl_inout i INNER JOIN tbl_students r ON r.id=i.stud_id  $wh   ORDER BY id DESC ");
                                    for ($i = 1; $row = $result->fetch(); $i++) {
                                        $id = $row['id']; ?>
                                        <tr>
                                            <td><?= $row['fullname']; ?></td>
                                            <td><?= $row['studNo']; ?></td>
                                            <td><?= $row['section']; ?></td>
                                            <td><?= format_time($row['xtime']); ?></td>
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
 
 
   <div class="modal fade" id="add" role="dialog">
        <div class="modal-dialog  modal-smd" role="document">
            <div class="modal-content">

                <form action="models/CRUDS.php" method="POST" enctype="multipart/form-data">
                    <div class="modal-header">
                        <h4 class="modal-title" id="defaultModalLabel">Add Attendance
                        </h4>

                    </div>
                    <div class="modal-body">


                        <div class="col-md-12">
                            <div class="form-group form-float">
                                <label class="form-label">Student</label>
                                <div class="form-line">
                                    <select name="student_id" class="form-control select" required>
                                        <option></option>
                                        <?php
                                        $res = my_query("SELECT * FROM tbl_students WHERE status='Active'");
                                        for ($x = 1; $r = $res->fetch(); $x++) { ?>
                                            <option value="<?= $r['id']; ?>"><?= $r['studNo'] . ' -  ' .   $r['lname'] . ', ' . $r['fname']; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <label class="form-label">Date</label>
                                    <input name="xdate" type="date" class="form-control" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <label class="form-label">Time  </label>
                                    <input name="xtime" type="time" class="form-control" required>
                                </div>
                            </div>
                        </div>
                      
                        <div class="col-md-12">
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <label class="form-label">  Status</label>
                                    <select  name="status" type="time" class="form-control" required>
                                        <option></option>
                                        <option>PRESENT</option>
                                        <option>LATE</option>
                                        <option>ABSENT</option>
                                        </select>
                                </div>
                            </div>
                        </div>


                    </div>
                    <div class="modal-footer">
                        <button type="submit" value="addAttendance" name="func_param" class="btn btn-primary waves-effect">
                            SAVE
                        </button>
                        <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">CLOSE</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
     

<?php include_once('layout/footer.php'); ?>