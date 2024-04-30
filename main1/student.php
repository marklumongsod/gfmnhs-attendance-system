  
<?php include_once ('layout/head.php');?>
<section class="content">
  <div class="container-fluid">

    <div class="row clearfix">
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
          <div class="header">
            <a class="box-studno">  <?php if(isset($_GET['r'])): ?>
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

  <!--   <a   class="btn right btn-success  waves-effect waves-light yellow darken-4" data-toggle="modal" data-target="#add">   <i class="material-icons">add</i>ADD </a> -->
    <h2>
      STUDENT
    </h2>  
 
  </div> 
  <div class="body">
    <div class="table-responsive">
      <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
       <thead>
        <tr>
         <th>Picture</th> 
         <th>Student#</th>
         <th>Name</th> 
         <th>Grade</th>  
         <th>Status</th>
         <th>Action</th> 
       </tr>
     </thead>
     <tfoot>
      <tr>
       <th>Picture</th> 
       <th>Student#</th>
       <th>Name</th> 
       <th>Grade</th>  
       <th>Status</th>
       <th>Action</th> 
     </tr>
   </tfoot>
   <tbody> 
    
    <?php 
 
     $result = my_query("SELECT *,CONCAT(lname,',',fname,' ',LEFT(mname,1),'.')fullname ,CONCAT(sy)details ,CONCAT(email,'</br>',contact,'</br>',address)profile   FROM tbl_student   ORDER BY id DESC");   

    for($i=1; $row = $result->fetch(); $i++){ $id=$row['id']; ?> 
      <tr>
        <td ><img width="50" src="../images/student/<?=$row['pic'];?>" /></td>
        <td><?=$row['studNo'];?></td>
        <td><?=$row['fullname'];?></td> 
        <td><?=$row['grade'];?></td>  
        <td><a href="models/do.php?do=status&id=<?=$row['id'];?>&stat=<?=$row['status'];?>"><?=$row['status'];?></a></td>  
        <td> 
          <a type="submit"  class="btn right btn-warning waves-effect waves-light yellow darken-4 col s12" data-toggle="modal" data-target="#edit<?=$id; ?>">
            <i class="material-icons">mode_edit</i>Edit</a>

            <a type="submit" class="btn right btn-danger waves-effect waves-light yellow darken-4 col s12" data-toggle="modal"  data-target="#delete<?=$id; ?>">
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
          <h4 class="modal-title" id="defaultModalLabel">Add Student 
          </h4>
          <div class="col-md-8">  
            <input name="pic" type="file" class="form-control" accept="images*" >
          </div>
        </div>
        <div class="modal-body"> 

          <div class="col-md-4">            
            <div class="form-group form-float">
              <div class="form-line">
                <input name="studNo" maxlength="12"  type="number" class="form-control" required>
                <label class="form-label">Student #</label>
              </div>
            </div>
          </div>
          <div class="col-md-4">            
            <div class="form-group form-float">
              <div class="form-line">
                <input name="lname" type="text" class="form-control" required>
                <label class="form-label">Lastname</label>
              </div>
            </div>
          </div> 
          <div class="col-md-4">            
            <div class="form-group form-float">
              <div class="form-line">
                <input name="fname" type="text" class="form-control" required>
                <label class="form-label">Firstname</label>
              </div>
            </div>
          </div> 
          <div class="col-md-4">            
            <div class="form-group form-float">
              <div class="form-line">
                <input name="mname" type="text" class="form-control" required>
                <label class="form-label">Middlename</label>
              </div>
            </div>
          </div> 

          <div class="col-md-4">            
            <div class="form-group form-float">
              <div class="form-line">
                <input name="email" type="email" class="form-control" required>
                <label class="form-label">Email</label>
              </div>
            </div>
          </div> 
          <div class="col-md-4">            
            <div class="form-group form-float">
              <div class="form-line">
                <input name="contact" type="number" class="form-control" required>
                <label class="form-label">Contact</label>
              </div>
            </div>
          </div> 
             <div class="col-md-4">            
            <div class="form-group form-float">
              <div class="form-line">
                <input name="contact1" type="number" class="form-control" required>
                <label class="form-label">Parent Contact </label>
              </div>
            </div>
          </div> 
          <div class="col-md-4">            
            <div class="form-group form-float">
              <div class="form-line">
                <input name="address" type="text" class="form-control" required>
                <label class="form-label">Address</label>
              </div>
            </div>
          </div>  
             <div class="col-md-4">            
            <div class="form-group form-float">
              <div class="form-line"> 
                <select name="gender"   class="form-control" required>
                  <option>Male</option><option>Female</option>
                </select>
                <label class="form-label">Gender</label>
              </div>
            </div>
          </div>  
 

        </div>
        <div class="modal-footer">
          <button type="submit" value="IUStudent" name="func_param" class="btn btn-primary waves-effect">SAVE</button>
          <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">CLOSE</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Edit -->
<?php   
$result = my_query("SELECT *  FROM tbl_student");
for($i=1; $row = $result->fetch(); $i++){ 
  $id = $row['id'];  ?> 
  <div class="modal fade" id="edit<?=$id; ?>" tabindex="-1" role="dialog">
    <div class="modal-dialog  modal-smd" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="defaultModalLabel">Edit Student</h4>
        </div>
        <form action="models/CRUDS.php" method="POST" enctype="multipart/form-data">
          <input type="hidden" name="id" value="<?=$id; ?>">
      
          <div class="modal-body"> 
    <div class="col-md-12">  
            <input name="pic" type="file" class="form-control" accept="images*" >
            <input name="pic1" type="hidden"   value="<?=$row['pic'];?>" >
          </div>
          <br/><br/><br/>
           <div class="col-md-4">            
            <div class="form-group form-float">
              <div class="form-line">           
               <input name="studNo" type="number" maxlength="12"  class="form-control"  value="<?=$row['studNo'];?>" required>
                <label class="form-label">Student #</label>
             </div>
           </div>
         </div>
          <div class="col-md-4">            
            <div class="form-group form-float">
              <div class="form-line">
                <input name="lname" type="text" class="form-control"  value="<?=$row['lname'];?>"  required>
                <label class="form-label">Last Name</label>
              </div>
            </div>
          </div> 
          <div class="col-md-4">            
            <div class="form-group form-float">
              <div class="form-line">
                <input name="fname" type="text" class="form-control"  value="<?=$row['fname'];?>"  required>
                <label class="form-label">First Name</label>
              </div>
            </div>
          </div> 
          <div class="col-md-4">            
            <div class="form-group form-float">
              <div class="form-line">
                <input name="mname" type="text" class="form-control"  value="<?=$row['mname'];?>" required>
                <label class="form-label">Middle Name</label>
              </div>
            </div>
          </div> 

          <div class="col-md-4">            
            <div class="form-group form-float">
              <div class="form-line">
                <input name="email" type="email" class="form-control"  value="<?=$row['email'];?>" required>
                <label class="form-label">Email</label>
              </div>
            </div>
          </div> 
          <div class="col-md-4">            
            <div class="form-group form-float">
              <div class="form-line">
                <input name="contact" type="number" class="form-control"  value="<?=$row['contact'];?>"  required>
                <label class="form-label">Contact</label>
              </div>
            </div>
          </div> 
     
          <div class="col-md-8">            
            <div class="form-group form-float">
              <div class="form-line">
                <input name="address" type="text" class="form-control"  value="<?=$row['address'];?>"  required>
                <label class="form-label">Address</label>
              </div>
            </div>
          </div> 
           <div class="col-md-4">            
            <div class="form-group form-float">
              <div class="form-line"> 
                <select name="gender"   class="form-control" required>
                    <option><?=$row['gender'];?></option>
                  <option>Male</option><option>Female</option>
                </select>
                <label class="form-label">Gender</label>
              </div>
            </div>
          </div>  
                    <div class="col-md-6">            
            <div class="form-group form-float">
              <div class="form-line">
                <input name="username" type="text" class="form-control"  value="<?=$row['username'];?>"  required>
                <label class="form-label">Username</label>
              </div>
            </div>
          </div> 
                    <div class="col-md-6">            
            <div class="form-group form-float">
              <div class="form-line">
                <input name="password" type="text" class="form-control"  value="<?=$row['password'];?>"  required>
                <label class="form-label">Password </label>
              </div>
            </div>
          </div> 
    
      </div>
      <div class="modal-footer">
        <button type="submit" value="IUStudent" name="func_param" class="btn btn-warning waves-effect">UPDATE</button>
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
            asd" type="button"  data-toggle="modal" data-target="#edit<?=$id; ?>" style="color: red" id="removeNo"> <?=$row['studNo']; ?></a></b></i> ) information?  <br/>There is NO undo! </h4>
          </div>   
        </div>
        <div class="modal-footer">
          <button type="submit" value="deleteStudent" name="func_param" class="btn btn-danger waves-effect">DELETE</button>
          <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">CLOSE</button>
        </div>
      </form>
    </div>
  </div>
</div>
<?php } ?>

