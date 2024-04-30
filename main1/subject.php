  
<?php include_once ('layout/head.php');?>
<section class="content">
  <div class="container-fluid">

    <div class="row clearfix">
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
          <div class="header">
                    <a class="box-title">  <?php if(isset($_GET['r'])): ?>
              <?php
              $r = $_GET['r'];
              if($r=='added'){  $classs='success';   
              }else if($r=='updated'){  $classs='warning';   
              }else if($r=='deleted'){ $classs='danger';   
              }else{  $classs='hide';
              }
              ?> 
              <div class="alert alert-dismissible alert-<?php echo $classs?> <?php echo $classs; ?>">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                <strong>Successfully <?php echo $r; ?>!</strong>    
              </div>
            <?php endif; ?></a>  
           
            <a   class="btn right btn-success  waves-effect waves-light yellow darken-4" data-toggle="modal" data-target="#add">   <i class="material-icons">add</i>ADD </a>
            <h2>
              SUBJECT
            </h2>  

          </div> 
          <div class="body">
            <div class="table-responsive">
              <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
               <thead>
                <tr>  
                 <th>Subject</th>
                 <th>Description</th>
                 <th>Code</th> 
                 <th>Action</th> 
               </tr>
             </thead>
             <tfoot>
              <tr>  
               <th>Title</th>
               <th>Description</th>
            <th>Code</th> 
               <th>Action</th> 
             </tr>
           </tfoot>
           <tbody> 

             <?php  $result = my_query("SELECT *  FROM tbl_subject s  ORDER BY s.id DESC");   
             for($i=1; $row = $result->fetch(); $i++){ $id=$row['id']; ?> 
              <tr>  
                <td><?=$row['subject'];?></td>
                <td><?=$row['description'];?></td>
                <td><?=$row['code'];?></td> 
                <td> 
                  <a class="btn right btn-warning waves-effect waves-light yellow darken-4 col s12" data-toggle="modal" data-target="#edit<?=$id; ?>">
                    <i class="material-icons">mode_edit</i>Edit</a>

                    <a  class="btn right btn-danger waves-effect waves-light yellow darken-4 col s12" data-toggle="modal"  data-target="#delete<?=$id; ?>">
                      <i class="material-icons">delete_forever</i>Delete</a>

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

<?php include_once ('layout/footer.php');?>

<!--==================================== ADD,EDIT,DELETE Dialogs ====================================== --> 
<!-- Add -->

<div class="modal fade" id="add" tabindex="-1" role="dialog">
  <div class="modal-dialog  modal-smd" role="document">
    <div class="modal-content">

      <form action="models/CRUDS.php" method="POST" enctype="multipart/form-data">
        <div class="modal-header">
          <h4 class="modal-title" id="defaultModalLabel">Add Subject 
          </h4>
        
        </div>
        <div class="modal-body"> 
     
          <div class="col-md-12">            
            <div class="form-group form-float">
              <div class="form-line">
                <input name="subject" type="text" class="form-control" required>
                <label class="form-label">Subject</label>
              </div>
            </div>
          </div>
          <div class="col-md-12">            
            <div class="form-group form-float">
              <div class="form-line">
                <input name="description" type="text" class="form-control" >
                <label class="form-label">Description</label>
              </div>
            </div>
          </div> 
          <div class="col-md-12">            
            <div class="form-group form-float">
              <div class="form-line">
                <label class="form-label">Code</label>
                <input name="code" type="text" class="form-control" >
              </div>
            </div>
          </div> 
      
        </div>
        <div class="modal-footer">
          <button type="submit" value="IUSubject" name="func_param" class="btn btn-primary waves-effect">SAVE</button>
          <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">CLOSE</button>
        </div>
    </form>
      </div>
  </div>
</div>

<!-- Edit -->
<?php   
$result = my_query("SELECT *  FROM tbl_subject");
for($i=1; $row = $result->fetch(); $i++){ 
  $id = $row['id'];  ?> 
  <div class="modal fade" id="edit<?=$id; ?>" tabindex="-1" role="dialog">
    <div class="modal-dialog  modal-smd" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="defaultModalLabel">Edit Subject</h4>
        </div>
        <form action="models/CRUDS.php" method="POST" enctype="multipart/form-data">
          <input type="hidden" name="id" value="<?=$id; ?>">

          <div class="modal-body"> 
       
           <div class="col-md-12">            
            <div class="form-group form-float">
              <div class="form-line">          
                  <input name="subject" type="text" class="form-control"  value="<?=$row['subject'];?>" required>
                <label class="form-label">Subject</label>
              </div>
            </div>
          </div>
          <div class="col-md-12">            
            <div class="form-group form-float">
              <div class="form-line">
                <input name="description" type="text" class="form-control"  value="<?=$row['description'];?>"   >
                <label class="form-label">Description</label>
              </div>
            </div>
          </div> 
          <div class="col-md-12">            
            <div class="form-group form-float">
              <div class="form-line">
                <label class="form-label">Code</label>
                <input name="code" type="text" class="form-control"  value="<?=$row['code'];?>"   >
              </div>
            </div>
          </div> 
     
          
        </div>
        <div class="modal-footer">
          <button type="submit" value="IUSubject" name="func_param" class="btn btn-warning waves-effect">UPDATE</button>
          <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">CLOSE</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Delete -->
<div class="modal fade" id="delete<?=$id; ?>" tabindex="-1" role="dialog">
  <div class="modal-dialog  modal-smd" role="document">
    <div class="modal-content"> 
     <form action="models/CRUDS.php" method="POST">
      <div class="modal-body"> 
       <input value="<?=$row['id'];?>" name="id" type="hidden" class="form-control" required>
       <div class="col-md-12" style="text-align: center;">    
        <h4>Are you sure you want to
          delete  <br/> (<i><b>
            <a data-dismiss="modal" class="call_info" data-id="
            asd" type="button"  data-toggle="modal" data-target="#edit<?=$id; ?>" style="color: red" id="removeNo"> <?=$row['subject']; ?></a></b></i> ) information?  <br/>There is NO undo! </h4>
          </div>   
        </div>
        <div class="modal-footer">
          <button type="submit" value="deleteSubject" name="func_param" class="btn btn-danger waves-effect">DELETE</button>
          <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">CLOSE</button>
        </div>
      </form>
    </div>
  </div>
</div>
<?php } ?>

