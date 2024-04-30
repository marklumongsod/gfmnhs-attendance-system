<?php include_once('layout/head.php'); ?>

<?php
if(isset($_GET['classInfo'])){
    $_SESSION['classInfo'] = $_GET['classInfo'];
}

if(isset($_GET['classId'])){
    $_SESSION['classId'] = $_GET['classId'];
}


if(isset($_GET['dt'])){
    $_SESSION['dt'] = $_GET['dt'];
}else{
     $_SESSION['dt'] = $dateNow;
}



?>

    <section class="content">
        <div class="container-fluid">


            <div >
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
                                        <i class="material-icons">add</i>PRINT </a>

                                <?php } else { ?>
                                 
                                        
                                          <a onclick="printDiv('printableArea')" class="btn right btn-warning  waves-effect waves-light yellow darken-4">
                                        <i class="material-icons">print</i>PRINT </a>
                                <?php } ?>
                       

<form action="" method="GET"> 
<input type="date"  value="<?=(isset($_GET['dt']) ? $_GET['dt'] : '');  ?>"   name="dt" required>
<button type="submit" name="s" >Search</button>
</form>
                            </div>
                            <div id="printableArea" class="body">
                                
                                         <h2>
                                    STUDENT SCHEDULE (<?= $_SESSION['classInfo']; ?>)  <?=(isset($_GET['dt']) ? '- '.format_date($_GET['dt']) : '');  ?>
                                </h2>
                                
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped table-hover js-basic-example  ">
                                    
                                        <thead>
                                        <tr>
                                            <th>Student</th>
                                            <th>Time In</th>
                                            <th>Time Out</th>

                                        </tr>
                                        </thead>
                                        <tbody>

                                        <?php $classId = $_SESSION['classId'];
                                        
                                        $xdate=   $_SESSION['dt'];
                                        $result = my_query("SELECT *,CONCAT(fname,' ',lname)student ,cc.id id,u.id studId FROM tbl_classstudent cc INNER JOIN tbl_students u ON u.id=cc.studId INNER JOIN tbl_class c ON cc.classId=c.id WHERE classId='$classId' ORDER BY cc.id DESC");
                                        for ($i = 1; $row = $result->fetch(); $i++) {
                                            $id = $row['id'];$stud_id = $row['studId']; ?>
                                            <tr>
                                                <td><?= $row['student']; ?></td>

                                                <?php
                                                $res = my_query("SELECT *  FROM tbl_inout WHERE xdate='$xdate'  AND status='IN' ");
                                              if($r = $res->fetch() ) { ?> 
                                                  <td><?= format_time($r['xtime']); ?></td>
                                            <?php    } ?>
                                            
                                                  <?php
                                                $res = my_query("SELECT *  FROM tbl_inout WHERE xdate='$xdate' AND status='OUT'  ");
                                              if($r = $res->fetch() ) { ?> 
                                                  <td><?= format_time($r['xtime']); ?></td>
                                            <?php    } ?>
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

        </div>
    </section>



<?php include_once('layout/footer.php'); ?>