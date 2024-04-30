 
<?php include_once ('layout/head.php');?> 

<section class="content">
  <div class="container-fluid">

    <div class="row clearfix">
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
          <div class="header">

            <h2>
             <?= $cat=$_GET['upload'];?> 
           </h2>  
         </div> 
         <div class="body">
          <div class="table-responsive">



            <table class="table table-bordered table-striped table-hover js-basic-example dataTable"> 
              <thead>
                <tr>
                 <th>Name</th>
                 <th>Description</th>
                 <th>File</th>
                 <th>Uploaded</th>
                    <th>Date/Time</th>
                 <th>Action</th> 
               </tr>
             </thead>
             <tfoot>
              <tr>
                <th>Name</th>
                <th>Description</th>
                <th>File</th>
                <th>Uploaded</th>
                  <th>Date/Time</th>
                <th>Action</th>   
              </tr>
            </tfoot>
            <tbody> 
              <?php 
              $upload=$_GET['upload']; 
              $section=$_SESSION['section'];   $dt;
              $result = my_query("SELECT *,u.id as id FROM tbl_upload u INNER JOIN tbl_class c ON c.facId=u.facId LEFT JOIN tbl_file_submitted fs ON fs.uploadId=u.id WHERE  section='$section' AND type='$upload' AND date_start<='$dt' AND date_end>='$dt' GROUP BY u.id  ORDER BY u.id DESC");

              for($i=1; $row = $result->fetch(); $i++){   ?> 
                <tr>
                  <td><?=$row['upload_name'];?></td>
                  <td><?=$row['description'];?></td>  
                  <td><?=$row['file'];?></td>
                    <td><?=$row['date_start'].'-'.$row['date_end'];?></td>
                  <td><a href="../files/AL/answer/<?=$row['uploaded_file'];?>"><?=$row['uploaded_file'];?></a></td>
                  <td>
                      <?php if($upload=='Assignment'){ ?>
                     <a class="btn right btn-warning waves-effect waves-light yellow darken-4 col s12"  data-toggle="modal" data-target="#upload<?=$row['id']; ?>">
                      <i class="material-icons">file_upload</i>Upload</a>
                   

                    <a class="btn right btn-primary waves-effect waves-light yellow darken-4 col s12" href="../files/AL/<?=$row['file'];?>">
                      <i class="material-icons">file_download</i>Download</a>


                    <?php }else{?>
                     <a class="btn right btn-primary waves-effect waves-light yellow darken-4 col s12" href="../files/AL/<?=$row['file'];?>">
                      <i class="material-icons">file_download</i>Download</a>
                    <?php } ?>

                  </td>
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



<!-- Edit -->
<?php   
$result = my_query("SELECT *,u.id as id FROM tbl_upload u INNER JOIN tbl_class c ON c.facId=u.facId LEFT JOIN tbl_file_submitted fs ON fs.uploadId=u.id WHERE  section='$section' AND type='$upload' AND date_start<='$dt' AND date_end>='$dt' GROUP BY u.id  ORDER BY u.id DESC");
for($i=1; $row = $result->fetch(); $i++){ 
  $id = $row['id'];  ?> 
  <div class="modal fade" id="upload<?=$id; ?>" tabindex="-1" role="dialog">
    <div class="modal-dialog  modal-smd" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="defaultModalLabel">Upload Answer</h4>
        </div>
        <form action="models/CRUDS.php" method="POST" enctype="multipart/form-data">
          <input type="hidden" name="uploadId" value="<?=$id; ?>">

          <div class="modal-body"> 

           <div class="col-md-12">            
            <div class="form-group form-float">
              <div class="form-line">          
                <input name="uploaded_file" type="file" class="form-control" accept="application/pdf"   required>
                <label class="form-label">Upload</label>
              </div>
            </div>
          </div>
          
          
        </div>
        <div class="modal-footer">
          <button type="submit" value="fileSubmit" name="func_param" class="btn btn-warning waves-effect">SUBMIT</button>
          <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">CLOSE</button>
        </div>
      </form>
    </div>
  </div>
</div>

<?php } ?>




<?php include_once ('layout/footer.php');?>


