  
<?php include_once ('layout/head.php');?>
<section class="content">
  <div class="container-fluid">

    <div class="row clearfix">
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
          <div class="header">
            <h2>Class List</h2><br/>
         <!--       <div align="center">
    <form action="" method="GET">
      <input type="date" name="dtfrom"  value="<?php if(isset($_GET['dtfrom'])){echo$_GET['dtfrom'];  }?>">
      <input type="date" name="dtto"  value="<?php if(isset($_GET['dtto'])){echo$_GET['dtto'];  }?>">
      <input type="submit" name=""  />
    </form >  
  </div> -->

  <div class="table-responsive">
   <table class="table table-bordered table-striped  "> 
     <thead>
      <tr> 
        <th>Teacher</th>
       <th>Section</th>
       <th>Subject</th>  
       <th>Start</th> 
       <th>End</th> 
       <th>Action</th> 
     </tr>
   </thead>
   <tfoot>
    <tr> 
      <th>Teacher</th>
     <th>Section</th>
     <th>Subject</th>  
     <th>Start</th> 
     <th>End</th> 
     <th>Action</th> 
   </tr>
 </tfoot>
 <tbody>  
  <?php   $classyr=$_SESSION['classyr'] ;
  $result = my_query("SELECT *,CONCAT(fname,' ',lname)teacher,CONCAT(section,'-',subject,'(',start,'-',end,')')classInfo ,c.id id FROM tbl_class c INNER JOIN tbl_users u ON u.id=c.facId WHERE   classyr='$classyr' ORDER BY c.id DESC");   
  for($i=1; $row = $result->fetch(); $i++){ $id=$row['id']; ?> 
    <tr> 
      <td><?=$row['teacher'];?></td>
      <td><?=$row['section'];?></td>
      <td><?=$row['subject'];?></td> 
      <td><?=$row['start'];?></td> 
      <td><?=$row['end'];?></td>  
      <td><a href="models/do.php?do=setClass&classId=<?=$id; ?>&classInfo=<?=$row['classInfo']; ?>&start=<?=$row['start']; ?>" class="btn right btn-primary waves-effect waves-light yellow darken-4 col s12" >
        <i class="material-icons"></i>Select</a>
      </td>
    </tr>
  <?php } ?> 
</tbody>
</table>
</div>
<br/>  


<h2>
  Student (<?php if(isset($_SESSION['classInfo'])){ echo$_SESSION['classInfo']; }?>) 
</h2>  
<br/>

</div> 

</div>
</div>
</div>



</div>
</section>

  

<script type="text/javascript">
  $(document).ready(function() {
    $('#example').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    } );
} );

  
</script>
<?php include_once ('layout/footer.php');?>