 
<?php include_once ('layout/head.php');
error_reporting(0);

?> 

<section class="content">
  <div class="container-fluid" id="printableArea" >

    <div class="row clearfix">
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
          <div class="header">
            <a onclick="printDiv('printableArea')"   class="btn right btn-warning  waves-effect waves-light yellow darken-4"  >   <i class="material-icons">add</i>PRINT </a>
            
            <div class="center">
              <select class="form-control" onchange="if (this.value) window.location.href=this.value" value="Customer">
                <?php  if (isset($_GET['section'])){ $cat=$_GET['section']; ?>
                <option value="assignment.php?id=<?=$_GET['id'];?>&section"><?=$cat;?></option>
              <?php }else{ ?> 
                <option  >-= Select Section =-</option>

              <?php } ?>
              <?php  $res = my_query("SELECT *  FROM tbl_class  ");   
              for($i=1; $r = $res->fetch(); $i++){ $id=$r['id'];  ?>
                <option value="assignment.php?id=<?=$_GET['id'];?>&section=<?=$r['section'];?>"><?=$r['section'];?></option> 
            <?php } ?>
          </select>
          <br/><br/>

          <h2>
           Assignment Checking
         </h2>  

       </div>


     </div> 
     <div class="body">
      <div class="table-responsive">



        <table class="table table-bordered table-striped table-hover js-basic-example dataTable"> 
          <thead>
            <tr>
             <th>File Submitted By</th>
             <th>Name</th>
             <th>Description</th> 
             <th>Submission</th>
             <th>Status</th> 
             <th>Score</th>
             <th>Action</th> 
           </tr>
         </thead>
         <tfoot>
          <tr>
           <th>File Submitted By</th>
           <th>Name</th>
           <th>Description</th>
           <th>Submission</th>
           <th>Status</th> 
           <th>Score</th>
           <th>Action</th>   
         </tr>
       </tfoot>
       <tbody> 
        <?php 
// AND date_start<='$dt' AND date_end>='$dt' 
        if (isset($_GET['section'])){
          $sec=$_GET['section'];
          $uid=$_GET['id'];
          $res = my_query("SELECT *,CONCAT(fname,' ',lname)studInfo FROM tbl_student  WHERE  section='$sec'  ");

        }else{ 
          $res = my_query("SELECT *,CONCAT(fname,' ',lname)studInfo FROM tbl_student  WHERE  section='$sec'"); 
        } 
        for($i=1; $r = $res->fetch(); $i++){  $studId=$r['id']; ?> 
          <tr>
            <td><?=$r['studInfo'];?></td>    
            <?php   $result = my_query("SELECT *,fs.id as id,CONCAT(date_start,' | ',date_end)dt FROM tbl_upload u INNER JOIN tbl_file_submitted fs ON fs.uploadId=u.id  WHERE fs.studId='$studId'   AND type='Assignment'  GROUP BY u.id  ORDER BY u.id DESC");
            if($row = $result->fetch()){   ?>   
              <td><?=$row['upload_name'];?></td>
              <td><?=$row['description'];?></td>  
              <td><?=$row['dt'];?></td>  
              <td> 
                <a href="models/do.php?do=stat&id=<?=$row['id'];?>&stat=<?=$row['stat'];?>"><?=$row['stat'];?></a></td>  

                <td>             
                  <form action="models/CRUDS.php" method="POST">
                    <input type="hidden" name="fileSubmitId" value="<?=$row['id'];?>">
                    <input type="number" name="score" value="<?=$row['score'];?>">
                    <button type="submit" value="addScore" name="func_param">Update</button>  
                  </form></td>
                  <td>
                    <a class="btn right btn-primary waves-effect waves-light yellow darken-4 col s12" href="../files/AL/answer/<?=$row['uploaded_file'];?>"  >
                      <i class="material-icons">file_download</i>Download</a> 
                    </td>

                  <?php }else { ?>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>No File Submitted</td>
                    <td></td>
                  <?php }?>


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


