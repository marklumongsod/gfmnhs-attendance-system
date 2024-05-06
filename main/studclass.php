<?php include_once('layout/head.php'); ?>
<section class="content">
    <div class="container-fluid">

    <?php
    if(isset($_POST['teachername'])){
        $_SESSION['teachername'] =$_POST['teachername']; 
        echo "<script type='text/javascript'> history.go(-1);</script>";
    } 

    ?>

        <div id="printableArea1">
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <a class="box-title">  <?php if (isset($_GET['r'])): ?>
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
                                            <span aria-hidden="true">×</span></button>
                                        <strong>Successfully <?php echo $r; ?>!</strong>
                                    </div>
                                <?php endif; ?></a>


                            <?php if ($_SESSION['role'] == 'Teacher') { ?>
                                <a onclick="printDiv('printableArea')" class="btn right btn-warning  waves-effect waves-light yellow darken-4">
                                    <i class="material-icons">print</i>PRINT </a>

                            <?php } else { ?>
                                <a class="btn right btn-success  waves-effect waves-light yellow darken-4" data-toggle="modal" data-target="#add">
                                    <i class="material-icons">add</i>ADD </a>
                            <?php } ?>


                            <h2>
                                MASTERLIST 
                                
                                <?php 
                                $grade=$_GET['grade'];
                                $section=$_GET['section'];
                                   $result = my_query("SELECT *  FROM tbl_students WHERE gr_yr='$grade' AND section='$section'  ");
                                    for ($i = 1; $row = $result->fetch(); $i++) {
                                        
                                         $studId =$row['id'];
                                         $classId =$_GET['classId'];
                                        db_insert('tbl_classstudent',['classId'=>$classId,'studId'=>$studId]);
                                    }
                                    
                                    ?>

<?php  $classId = $_SESSION['classId'];
                                     $result = my_query("SELECT *,CONCAT(fname, ' ', lname)name FROM tbl_class c  INNER JOIN tbl_users u ON u.id=c.facId WHERE  c.id='$classId'");
                                       if( $row = $result->fetch()) {
                                        $teacher=$row['name'];
                                        $sub=$row['subject'];
                                        $gs=$row['grade']. ' - '.$row['section'];
                                        }
                                         ?>
                                 
                            </h2>

                        </div> 
                        <br/>
                        <div id="printableArea" class="body">
                                <img src="../images/headprint.png" width="100%" > 

                            <div class=""> 
                                <br/>
                                Teacher : <?= $teacher;?>  <br/>
                                    Subject : <?= $sub;?>  <br/> 
                                    Gr & Section : <?=$gs;?> 
                                    <br/>
                            <h4> MALE</h4> 
                                    <table class="  table-bordered table-striped table-hover    ">
                                    <thead>
                                    <tr>
                                        <th  width="500px">Student</th>
                                        <th  width="500px">LRN</th> 
                                        <?php if ($_SESSION['role'] == 'Admin') { ?>
                                            <th>Action</th>
                                        <?php } ?>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    <?php 
                                     $sec = $_GET['section'];
                                     $gryr = $_GET['grade'];
                                    $classId = $_GET['classId'];
                                    $result = my_query("SELECT *,CONCAT(lname,', ',fname)student ,cc.id id 
                                    FROM tbl_classstudent cc INNER JOIN tbl_students u ON u.id=cc.studId INNER JOIN
                                     tbl_class c ON cc.classId=c.id WHERE classId='$classId' AND gender='Male' ORDER BY u.lname ASC");
                                    for ($i = 1; $row = $result->fetch(); $i++) {
                                        $id = $row['id']; ?>
                                        <tr>
                                            <td  ><?= $row['student']; ?></td>
                                            <td  ><?= $row['studNo']; ?></td> 

                                            <?php if ($_SESSION['role'] == 'Admin') { ?>

                                                <td>

                                                    <a class="btn right btn-danger waves-effect waves-light yellow darken-4 col s12" data-toggle="modal" data-target="#delete<?= $id; ?>">
                                                        <i class="material-icons">delete_forever</i>Delete</a>

                                                </td>
                                            <?php } ?>


                                        </tr>
                                    <?php } ?>
                                    </tbody>
                                </table>

                                <br/>
                               <h4> FEMALE</h4>

                                <table class="  table-bordered table-striped table-hover    ">
                                    <thead>
                                    <tr>
                                        <th  width="500px">Student</th>
                                        <th  width="500px">LRN</th> 
                                        <?php if ($_SESSION['role'] == 'Admin') { ?>
                                            <th>Action</th>
                                        <?php } ?>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    <?php 
                                     $sec = $_GET['section'];
                                     $gryr = $_GET['grade'];
                                    $classId = $_GET['classId'];
                                    $result = my_query("SELECT *,CONCAT(lname,', ',fname)student ,cc.id id 
                                    FROM tbl_classstudent cc INNER JOIN tbl_students u ON u.id=cc.studId INNER JOIN
                                     tbl_class c ON cc.classId=c.id WHERE classId='$classId' AND gender='Female' ORDER BY u.lname ASC");
                                    for ($i = 1; $row = $result->fetch(); $i++) {
                                        $id = $row['id']; ?>
                                        <tr>
                                            <td  ><?= $row['student']; ?></td>
                                            <td  ><?= $row['studNo']; ?></td> 

                                            <?php if ($_SESSION['role'] == 'Admin') { ?>

                                                <td>

                                                    <a class="btn right btn-danger waves-effect waves-light yellow darken-4 col s12" data-toggle="modal" data-target="#delete<?= $id; ?>">
                                                        <i class="material-icons">delete_forever</i>Delete</a>

                                                </td>
                                            <?php } ?>


                                        </tr>
                                    <?php } ?>
                                    </tbody>
                                </table>


                                <br/><br/><br/>
                                    <!-- <?=addSpace(3);?>    __<u><?=$teacher;?></u>___ <br/> --> 
                                    <form action="" method="POST" >
                                 <input type='text' name="teachername" value="<?=(isset($_SESSION['teachername']) ? $_SESSION['teachername']  : '');  ?> " width="450px" >    <br/> 
                                 
                                 <?=addSpace(12);?> ADVISER
                                        </form>

                            </div>
                        </div>
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
                    <h4 class="modal-title" id="defaultModalLabel">Add Student
                    </h4>

                </div>
                <div class="modal-body">

                    <input type="hidden" name="classId" value="<?= $_GET['classId']; ?>">
                    <input type="hidden" name="section" value="<?= $sec=$_GET['section']; ?>">
                    <div class="col-md-12">
                        <div class="form-group form-float">
                            <div class="form-line">
                           <select name="studId" class="form-control select" required>
                                    <option></option>
                                    <?php $classId = $_GET['classId'];
                                    $res = my_query("SELECT CONCAT(fname,' ',lname)student,tbl_students.id as sid FROM tbl_students
                                     WHERE    section='$sec' AND gr_yr='$gryr' AND  id NOT IN(SELECT studId FROM tbl_classstudent WHERE classId='$classId' )");
                                    for ($i = 1; $r = $res->fetch(); $i++) {
                                        $id = $r['sid']; ?>
                                        <option value="<?= $id; ?>"><?= $r['student']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="submit" value="addStudClass" name="func_param" class="btn btn-primary waves-effect">
                        SAVE
                    </button>
                    <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">CLOSE</button>
                </div>
            </form>
        </div>
    </div>
</div>


<?php
$result = my_query("SELECT *,CONCAT(fname,' ',lname)student ,cc.id id FROM tbl_classstudent cc INNER JOIN tbl_students u ON u.id=cc.studId INNER JOIN tbl_class c ON cc.classId=c.id ORDER BY cc.id DESC ");
for ($i = 1; $row = $result->fetch(); $i++) {
    $id = $row['id']; ?>
    <!-- Delete -->
    <div class="modal fade" id="delete<?= $id; ?>" tabindex="-1" role="dialog">
        <div class="modal-dialog  modal-smd" role="document">
            <div class="modal-content">
                <form action="models/CRUDS.php" method="POST">
                    <div class="modal-body">
                        <input value="<?= $row['id']; ?>" name="id" type="hidden" class="form-control" required>
                        <div class="col-md-12" style="text-align: center;">
                            <h4>Are you sure you want to
                                delete <br/> (<i><b>
                                        <a data-dismiss="modal" class="call_info" data-id="
            asd" type="button" data-toggle="modal" data-target="#edit<?= $id; ?>" style="color: red" id="removeNo"> <?= $row['student'] . '-' . $row['section'] . '/' . $row['subject']; ?></a></b></i>
                                ) information? <br/>There is NO undo! </h4>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" value="deleteStudClass" name="func_param" class="btn btn-danger waves-effect">
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