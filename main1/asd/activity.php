  
<?php include_once ('layout/head.php');?>
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
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
              <a   class="btn right btn-primary  waves-effect waves-light yellow darken-4" data-toggle="modal" data-target="#addCategory">   <i class="material-icons">add</i>Category</a>
            <h2>
              ACTIVITY
            </h2>  

          </div> 
          <div class="body">
            <div class="table-responsive">
              <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
               <thead>
                <tr>  
                 <th>Category</th>
                 <th>Description</th>
                 <th>Date Start</th> 
                 <th>Date End</th> 
                 <th>Action</th> 
               </tr>
             </thead>
             <tfoot>
              <tr>  
                <th>Category</th>
                 <th>Description</th>
                 <th>Date Start</th> 
                 <th>Date End</th> 
                 <th>Action</th> 
             </tr>
           </tfoot>
           <tbody> 

             <?php  $result = my_query("SELECT *  FROM tbl_activity s  ORDER BY s.id DESC");   
             for($i=1; $row = $result->fetch(); $i++){ $id=$row['id']; ?> 
              <tr>  
                <td><?=$row['category'];?></td>
                <td><?=$row['description'];?></td>
                <td><?=$row['date_start'];?></td> 
                <td><?=$row['date_end'];?></td> 
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


<!--==================================== ADD,EDIT,DELETE Dialogs ====================================== --> 
<!-- Add -->

<div class="modal fade" id="add" tabindex="-1" role="dialog">
  <div class="modal-dialog  modal-smd" role="document">
    <div class="modal-content">

      <form action="models/CRUDS.php" method="POST" enctype="multipart/form-data">
        <div class="modal-header">
          <h4 class="modal-title" id="defaultModalLabel">Add Activity 
          </h4>
        
        </div>
        <div class="modal-body"> 
     
          <div class="col-md-12">            
            <div class="form-group form-float">
              <div class="form-line">
                  <select  name="category" class="form-control" id="category" required >
                      <?php
$result = my_query("SELECT *  FROM tbl_category");
for($i=1; $row = $result->fetch(); $i++){ ?>
                      <option><?=$row['category'];?></option>
                      <?php }?>
                  </select>
                <label class="form-label">Category</label>
              </div>
            </div>
          </div>
   

  <div class="col-md-12">            
      <div class="form-group form-float">
        <div class="form-line">
          <input name="description" type="text" class="form-control"   required>
          <label class="form-label">Description</label>
        </div>
      </div>
    </div>

<?php 
for ($i=0; $i <10 ; $i++) {  ?>
  <div class="col-md-9">            
      <div class="form-group form-float">
        <div class="form-line">
          <input name="file[<?=$i;?>]" type="file" class="form-control" accept=""     > 
        </div>
      </div>
    </div>
      <div class="col-md-3">            
      <div class="form-group form-float">
        <div class="form-line">
          <select name="answer[<?=$i;?>]" type="file" class="form-control" accept=""    required>
            <option>Do's</option>
            <option>Don'ts</option>
          </select>
          <label class="form-label">Answer</label>
        </div>
      </div>
    </div>
  <?php } ?>

    <div class="col-md-12">            
      <div class="form-group form-float">
        <div class="form-line">
          <input name="date_start" type="datetime-local" class="form-control"   required>
          <label class="form-label">Date Start</label>
        </div>
      </div>
    </div>


    <div class="col-md-12">            
      <div class="form-group form-float">
        <div class="form-line">
          <input name="date_end" type="datetime-local" class="form-control"    required>
          <label class="form-label">Date End</label>
        </div>
      </div>
    </div>
   
      
        </div>
        <div class="modal-footer">
          <button type="submit" value="IUActivity" name="func_param" class="btn btn-primary waves-effect">SAVE</button>
          <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">CLOSE</button>
        </div>
    </form>
      </div>
  </div>
</div>

<!-- Edit -->
<?php   
$result = my_query("SELECT *  FROM tbl_activity");
for($i=1; $row = $result->fetch(); $i++){ 
  $id = $row['id'];  ?> 
  <div class="modal fade" id="edit<?=$id; ?>" tabindex="-1" role="dialog">
    <div class="modal-dialog  modal-smd" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="defaultModalLabel">Edit Activity</h4>
        </div>
        <form action="models/CRUDS.php" method="POST" enctype="multipart/form-data">
          <input type="hidden" name="id" value="<?=$id; ?>"> 
          <div class="modal-body"> 
          
          <?php   
$res = my_query("SELECT *  FROM tbl_activity_items WHERE activityId='$id'");
for($i=1; $r = $res->fetch(); $i++){  ?>
<img  src="../files/Activity/<?=$r['gif'];?>"  width="15%">
 <?php } ?>
 <br/><br/><br/>
          <div class="col-md-12">
            <div class="form-group form-float">
              <div class="form-line">
                  <select  name="category" class="form-control" required >
                      <option><?=$row['category'];?></option>
                      <?php
                      $res = my_query("SELECT *  FROM tbl_category");
                      for($i=1; $r = $res->fetch(); $i++){ ?>
                          <option><?=$r['category'];?></option>
                      <?php }?>
                  </select>
                <label class="form-label">Category</label>
              </div>
            </div>
          </div>


  <div class="col-md-12">            
      <div class="form-group form-float">
        <div class="form-line">
          <input name="description" type="text" class="form-control"   value="<?=$row['description'];?>"  required>
          <label class="form-label">Description</label>
        </div>
      </div>
    </div>
 

<?php 
for ($i=0; $i <10 ; $i++) {   ?>
  <div class="col-md-9">            
      <div class="form-group form-float">
        <div class="form-line">
          <input name="file[<?=$i;?>]" type="file" class="form-control" accept=""    required>
          <label class="form-label">Upload</label>
        </div>
      </div>
    </div>
     <div class="col-md-3">            
      <div class="form-group form-float">
        <div class="form-line">
          <select name="answer[<?=$i;?>]" type="file" class="form-control" accept=""    required>
            <option>Do's</option>
            <option>Don'ts</option>
          </select>
          <label class="form-label">Answer</label>
        </div>
      </div>
    </div>
  <?php } ?>


    <div class="col-md-12">            
      <div class="form-group form-float">
        <div class="form-line">
          <input name="date_start" type="datetime-local" class="form-control"   value="<?=$row['date_start'];?>"  required>
          <label class="form-label">Date Start</label>
        </div>
      </div>
    </div>


    <div class="col-md-12">            
      <div class="form-group form-float">
        <div class="form-line">
          <input name="date_end" type="datetime-local" class="form-control"    value="<?=$row['date_end'];?>"  required>
          <label class="form-label">Date End</label>
        </div>
      </div>
    </div>
   
          
        </div>
        <div class="modal-footer">
          <button type="submit" value="IUActivity" name="func_param" class="btn btn-warning waves-effect">UPDATE</button>
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
            asd" type="button"  data-toggle="modal" data-target="#edit<?=$id; ?>" style="color: red" id="removeNo"> <?=$row['category']; ?></a></b></i> ) information?  <br/>There is NO undo! </h4>
          </div>   
        </div>
        <div class="modal-footer">
          <button type="submit" value="deleteActivity" name="func_param" class="btn btn-danger waves-effect">DELETE</button>
          <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">CLOSE</button>
        </div>
      </form>
    </div>
  </div>
</div>
<?php } ?>

<?php
$result = my_query("SELECT *  FROM tbl_category");
for($i=1; $row = $result->fetch(); $i++){
    $id = $row['id'];  ?>
    <!-- Delete -->
<div class="modal fade" id="deleteCategory<?=$id; ?>" tabindex="-1" role="dialog">
    <div class="modal-dialog  modal-smd" role="document">
        <div class="modal-content">
            <form action="models/CRUDS.php" method="POST">
                <div class="modal-body">
                    <input value="<?=$row['id'];?>" name="id" type="hidden" class="form-control" required>
                    <div class="col-md-12" style="text-align: center;">
                        <h4>Are you sure you want to
                            delete  <br/> (<i><b>
                                    <a data-dismiss="modal" class="call_info" data-id="
            asd" type="button"  data-toggle="modal" data-target="#edit<?=$id; ?>" style="color: red" id="removeNo"> <?=$row['category']; ?></a></b></i> ) information?  <br/>There is NO undo! </h4>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" value="deleteCategory" name="func_param" class="btn btn-danger waves-effect">DELETE</button>
                    <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">CLOSE</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php } ?>


    <div class="modal fade" id="addCategory" tabindex="-1" role="dialog">
        <div class="modal-dialog  modal-smd" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="defaultModalLabel">Add Category
                    </h4>
                </div>
                <form action="models/CRUDS.php" method="POST">
                    <div class="modal-body">
                         <div class="col-md-12" style="text-align: center;">

                            <div class="col-md-12">
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input name="category" type="text" class="form-control"    required>
                                        <label class="form-label">Category</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <table class="table table-bordered table-striped table-hover">
                                    <thead>
                                    <tr>
                                        <th>Category</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tfoot>
                                    <tr>
                                        <th>Category</th>
                                        <th>Action</th>
                                    </tr>
                                    </tfoot>
                                    <tbody>

                                    <?php  $result = my_query("SELECT *  FROM tbl_category s  ORDER BY s.id DESC");
                                    for($i=1; $row = $result->fetch(); $i++){ $id=$row['id']; ?>
                                        <tr>
                                            <td><?=$row['category'];?></td>
                                            <td>

                                                <a  class="btn right btn-danger waves-effect waves-light yellow darken-4 col s12" data-toggle="modal"  data-dismiss="modal" data-target="#deleteCategory<?=$id; ?>">
                                                    <i class="material-icons">delete_forever</i>Delete</a>

                                            </td>
                                        </tr>
                                    <?php } ?>
                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" value="IUCategory" name="func_param" class="btn btn-primary waves-effect">SAVE</button>
                        <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">CLOSE</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <script>
    $('#category').select2({
        width:"100%",
        placeholder: "Select",
        maximumSelectionSize: 1
    });


</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
<?php include_once ('layout/footer.php');?>