
<?php include_once ('layout/head.php');?>


<section class="content">
	<div class="container-fluid">

		
		<div id="aniimated-thumbnials" class="list-unstyled row clearfix">
			<?php if (isset($_GET['cat'])){ ?>
				<form action="models/CRUDS.php" method="POST">
					<?php $category=$_GET['cat'];$id=$_GET['id'];
					$result = my_query("SELECT  ai.id,gif,answer  FROM tbl_activity_items ai INNER JOIN tbl_activity a ON ai.activityId=a.id WHERE  ai.activityId='$id' ORDER BY RAND()");   
					for($i=0; $row = $result->fetch(); $i++){ $id=$row['id']; ?> 


						<div class="col-lg-12 col-md-4 col-sm-6 col-xs-12">
							<a href="../images/ann/<?=$row['pic'];?>" data-sub-html="Demo Description">
								<img class="img-responsive thumbnail"  src="../files/Activity/<?=$row['gif'];?>"  width="100%">
							</a>
							<div align="center" class="group">
								<input type="hidden" name="correctAns[<?=$i;?>]" value="<?=$row['answer'];?>">
								<input type="hidden" name="activityItemId[<?=$i;?>]" value="<?=$row['id'];?>">
								<input type="hidden" name="activityId" value="<?=$_GET['id'];?>">
								<select class="form-control"  name="answer[<?=$i;?>]" required>
								 <option>Select Answer</option>
								 <option>Do's</option>
            <option>Don'ts</option>
								</select>
							</div> 
						</div> 
					<?php } ?> 
					
					<div class="col-lg-12">
						<button type="submit" value="insertAcAns" name="func_param"  class="form-control btn btn-info waves-effect">SUBMIT ANSWER</button>
					</div>
				</form>
			<?php }else{ ?>   


				<?php  $res = my_query("SELECT *  FROM tbl_activity  ");   
				for($i=1; $r = $res->fetch(); $i++){ $id=$r['id']; ?> 

					<a href="activity-answer.php?id=<?=$r['id'];?>&cat=<?=$r['category'];?>"><button type="button" class="btn btn-block btn-lg btn-default waves-effect"><?=$r['category'];?></button></a>
				<div class="col-lg-12 col-md-4 col-sm-6 col-xs-12">
                                    <!--    <a href="../images/ann/<?=$row['pic'];?>" data-sub-html="Demo Description">
                                        <img class="img-responsive thumbnail"  src="../images/ann/<?=$row['pic'];?>">
                                    </a>
                                    <div align="center" class="group">
                                      <h2><?=$row['title'];?></h2><br/>
                                      <label><?=$row['description'];?></label><br/>
                                      <label>Date/Time:<?=$row['xdt'].' '.$row['xtime'];?></label><br/> 
                                      <label>By:<?=$row['role']." ".$row['fname'].' '.$row['lname'];?></label><br/>
                                  </div>-->
                              </div> 
                          <?php } ?>
                      <?php } ?>
                  </div>
              </div>
          </section>

          <?php include_once ('layout/footer.php');?>

