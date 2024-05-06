  
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
           
           <div class="row">
           <form action="models/CRUDS.php" method="POST">
            <input type="text" placeholder="Activity Number"  name="actNo" required="">
           <select  name="section">  
            <?php $user_id=$_SESSION['user_id'];
             $res = my_query("SELECT *  FROM tbl_class WHERE facId='$user_id'  ");   
            for($i=1; $r = $res->fetch(); $i++){ $id=$r['id'];  ?>
              <option ><?=$r['section'];?></option> 
          <?php } ?>
        </select>
    <select name="itemNo">
              <option>10</option>
              <option>15</option>
              <option>20</option>
            </select>
            <select name="testType">
              <option> Multiple</option>
              <option> True or False</option>
            </select>  
               <button type="submit" name="func_param" value="addteacherAct"  class="btn right btn-info  waves-effect waves-light yellow darken-4"  >   <i class="material-icons">add</i>SAVE </button>
           </form>
          </div>
              
            <h2>
              ACTIVITY
            </h2>  

          </div> 
          <div class="body">
            <div class="table-responsive">
              <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
               <thead>
                <tr>  
                 <th>Activity Number</th>
                 <th>Section</th>
                 <th>Item No</th> 
                 <th>Type</th> 
                 <th>Action</th> 
               </tr>
             </thead>
             <tfoot>
              <tr>  
                  <th>Activity Number</th>
                 <th>Section</th>
                 <th>Item No</th> 
                 <th>Type</th> 
                 <th>Action</th> 
             </tr>
           </tfoot>
           <tbody> 

             <?php  
              $result = my_query("SELECT *,at.id as id  FROM tbl_activity_teacher at INNER JOIN tbl_users u ON u.id=at.facId  ORDER BY at.id DESC");   
             for($i=1; $row = $result->fetch(); $i++){ $id=$row['id']; ?> 
              <tr>  
                <td><?=$row['actNo'];?></td>
                <td><?=$row['section'];?></td>
                <td><?=$row['itemNo'];?></td> 
                <td><?=$row['testType'];?></td> 
                <td> 
                  
                    <a  class="btn right btn-danger waves-effect waves-light yellow darken-4 col s12" data-toggle="modal"  data-target="#delete<?=$id; ?>">
                      <i class="material-icons">delete_forever</i>Delete</a>
     <a  class="btn right btn-warning waves-effect waves-light yellow darken-4 col s12" data-toggle="modal"  data-target="#addq<?=$id; ?>">
                      <i class="material-icons">add</i>Question</a>

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

<?php $res = my_query("SELECT *  FROM tbl_activity_teacher");
for($i=1; $r = $res->fetch(); $i++){ $id=$r['id'] ;?>
<!-- Add Question -->
<div class="modal fade" id="addq<?=$id; ?>" tabindex="-1" role="dialog">
  <div class="modal-dialog  modal-smd" role="document">
    <div class="modal-content"> 
     <form action="models/CRUDS.php" method="POST">
      <div class="modal-body"> 
       <input value="<?=$r['id'];?>" name="id" type="hidden" class="form-control" required>
       <input value="<?=$r['itemNo'];?>" name="itemNo" type="hidden" class="form-control" required>
       <input value="<?=$r['testType'];?>" name="testType" type="hidden" class="form-control" required>
       <div class="col-md-12" style="text-align: center;">    
        
<?php if($r['testType']=='Multiple'){ for ($i=0; $i <$r['itemNo'] ; $i++) {  ?>
  <div class="col-md-12">
                                <div class="form-group form-float">
                                    <div class="form-line">
                                      <label>Question <?=$i+1;?></label>
                                        <input name="question[]" type="text" class="form-control" placeholder="Question"   required> 
                                        <input name="choice1[]" type="text" class="form-control" placeholder="choice 1"   required> 
                                        <input name="choice2[]" type="text" class="form-control" placeholder="choice 2"    required> 
                                        <input name="choice3[]" type="text" class="form-control"  placeholder="choice 3"   required> 
                                        <select name="answer[]" class="form-control" required="" >
                                          <option>Choice 1</option>
                                          <option>Choice 2</option>
                                          <option>Choice 3</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
<?php }   }else{  for ($i=0; $i <$r['itemNo'] ; $i++) { ?>
  <div class="col-md-12">
                                <div class="form-group form-float">
                                    <div class="form-line">
                                      <label>Question <?=$i+1;?></label>
                                        <input name="question[]" type="text" class="form-control" placeholder="Question"   required>  
                                        <select name="answer[]" class="form-control" required="" >
                                          <option>True</option>
                                          <option>False</option> 
                                        </select>
                                    </div>
                                </div>
                            </div>

<?php }  } ?>
 <div class="col-md-6">
                                <div class="form-group form-float">
                                    <div class="form-line">
                                      <label>Date Start</label>
                                        <input name="date_start" type="datetime-local" class="form-control" placeholder="Date Start"   required>  
                                         
                                    </div>
                                </div>
                            </div>
 <div class="col-md-6">
                                <div class="form-group form-float">
                                    <div class="form-line">
                                      <label>Date End</label>
                                        <input name="date_end" type="datetime-local" class="form-control" placeholder="Date End"   required>  
                                         
                                    </div>
                                </div>
                            </div>

          </div>   
        </div>
        <div class="modal-footer">
          <button type="submit" value="addteacherActItem" name="func_param" class="btn btn-info waves-effect">Save</button>
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
       <input value="<?=$id; ?>" name="id" type="hidden" class="form-control" required>
       <div class="col-md-12" style="text-align: center;">    
        <h4>Are you sure you want to
          delete  <br/> (<i><b>
            <a data-dismiss="modal" class="call_info" data-id="
            asd" type="button"  data-toggle="modal" data-target="#edit<?=$id; ?>" style="color: red" id="removeNo"> <?=$r['section']; ?></a></b></i> ) information?  <br/>There is NO undo! </h4>
          </div>   
        </div>
        <div class="modal-footer">
          <button type="submit" value="deleteteacherAct" name="func_param" class="btn btn-danger waves-effect">DELETE</button>
          <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">CLOSE</button>
        </div>
      </form>
    </div>
  </div>
</div>
<?php } ?>
 
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>


    <script>
    $('#category').select2({
        width:"100%",
        placeholder: "Select",
        maximumSelectionSize: 1
    });


</script>
<?php include_once ('layout/footer.php');?>