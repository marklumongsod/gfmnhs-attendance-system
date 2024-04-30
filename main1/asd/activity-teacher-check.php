 
<?php include_once ('layout/head.php');
error_reporting(0);

?> 

<section class="content">
  <div class="container-fluid" id="printableArea">

    <div class="row clearfix">
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
          <div class="header">
      <a onclick="printDiv('printableArea')"   class="btn right btn-warning  waves-effect waves-light yellow darken-4"  >   <i class="material-icons">add</i>PRINT </a>

           <div class="center">
            <select class="form-control" onchange="if (this.value) window.location.href=this.value" value="Customer">
              <?php  if (isset($_GET['section'])){ $cat=$_GET['section']; ?>
              <option value="activity-teacher-check.php?id=<?=$_GET['id'];?>&section"><?=$cat;?></option>
            <?php }else{ ?> 
              <option  >-= Select Section =-</option>

            <?php } ?>
            <?php  $res = my_query("SELECT *  FROM tbl_class  ");   
            for($i=1; $r = $res->fetch(); $i++){ $id=$r['id'];  ?>
              <option value="activity-teacher-check.php?id=<?=$_GET['id'];?>&section=<?=$r['section'];?>&actNo=<?=$_GET['actNo'];?>"><?=$r['section'];?></option> 
          <?php } ?>
        </select>

<br/><br/>
            <h2>
             Activity Checking <?=$_GET['actNo'];?>
           </h2>  
      </div>


    </div> 
    <div class="body">
      <div class="table-responsive">



        <table class="table table-bordered table-striped table-hover js-basic-example dataTable"> 
          <thead>
            <tr>
             <th>Activity Number</th>
           <th>Name</th> 
           <th>Score</th> 
           </tr>
         </thead>
         <tfoot>
          <tr> 
            <th>Activity Number</th>
           <th>Name</th> 
           <th>Score</th> 
         </tr>
       </tfoot>
       <tbody> 
        <?php 
 
          $sec=$_GET['section'];
          $uid=$_GET['id'];
          $res = my_query("SELECT COUNT(*)score,CONCAT(fname,' ',lname)studInfo FROM tbl_student s INNER JOIN tbl_act_teacher_answer ata ON ata.studId=s.id WHERE is_correct='1'  AND  section='$sec'  AND activityId='$uid'  GROUP BY activityId,studId   ");

     
        for($i=1; $r = $res->fetch(); $i++){  $studId=$r['id']; ?> 
          <tr>
              <td><?=$_GET['actNo'];?></td>   
            <td><?=$r['studInfo'];?></td>   
              <td><?=$r['score'];?></td> 
              <td> </td>
              
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


<script type="text/javascript">
function printDiv(divName) {
 var printContents = document.getElementById(divName).innerHTML;
 var originalContents = document.body.innerHTML;
 document.body.innerHTML = printContents;
 window.print();

 document.body.innerHTML = originalContents;
}
</script>

<?php include_once ('layout/footer.php');?>


