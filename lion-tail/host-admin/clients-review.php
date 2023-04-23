<?php $actova1=''; $actova2=''; $actova3=''; $actova4=''; $actova5=''; $actova6=''; $actova7=''; $actova8=''; $actova9=''; $actova10=''; $actova44w='active';?>
<?php require_once('../../con-cot/conn_sqli.php'); ?>
<?php require_once('../../lib/basic-functions.php'); ?>
<?php require_once('../../library.php'); ?>
<?php require_once('../../select-library.php'); ?>
<?php require_once('../../emails_lib.php');
?>
<?php $bassic->checkLogedINAdmin('login');?>
 <?php
$msg='';$coin='';
?>

<?php 
if(isset($_POST['post'])){
	$reviewMsg = mysqli_real_escape_string($link,$_POST['reviewMsg']);
	$name = mysqli_real_escape_string($link,$_POST['name']);
	$adminEmail = $siteEmail; 
	$status = 1;
	if(!empty($reviewMsg)&&!empty($name)){
     if(query_sql("INSERT INTO $review VALUES(null,'".$adminEmail."','".$reviewMsg."','".$status."','".$bassic->getDate()."','".$name."')")){
		 $msg = 'Insert successfully!';
	 }else{
		 $msg = 'Action Failed!';
	 }
			}else{$msg = 'Please fill all fields';}
}

if(isset($_GET['id'])&&!empty($_GET['id'])){
	   $getid = $_GET['id'];
	   $getst = $_GET['st'];
	   if($getst==1){
		   $sats = 0;
	   }else{
		   $sats = 1;
	   }
	   if(!empty($getid)){
			$fields = array('status');
			$values = array($sats);
			$msg = $cal->update($review,$fields,$values,'id',$getid);	
			header("location:clients-review?done=".$msg);
	   }
	 }
?>
<?php 
if(isset($_GET['iddel'])&&!empty($_GET['iddel'])){
		 if(query_sql("DELETE FROM $review WHERE `id`='".$_GET['iddel']."' LIMIT 1")){
			 $msg = 'Delete process was successful!';
			 header("location:clients-review?done=".$msg);
		 }else{
			 $msg = 'Info Faild to delete!';
			 header("location:clients-review?done=".$msg);
		 }
}
?>
<?php if(isset($_GET['done'])&&!empty($_GET['done'])){$msg = $_GET['done'];}?>
<!DOCTYPE html>
<html lang="en">
<?php
$title = 'Clients Review';
 require_once('head.php')?>
  <body>
  <!-- container section start -->
  <section id="container" class="" style="margin-bottom:100px;">
  <?php require_once('header.php')?>
<?php require_once('sidebar.php')?>
      <!--main content start-->
      <section id="main-content">
          <section class="wrapper">            
              <!--overview start-->
			  <div class="row">
				<div class="col-lg-12">
					<h3 class="page-header"><i class="fa fa-laptop"></i> Clients Review</h3>
					<ol class="breadcrumb">
						<li><i class="fa fa-home"></i><a href="../host-admin/">Home</a></li></li>						  	
					</ol>
				</div>
			</div>

 <?php if(!empty($msg)){?>
 <div class="row">
         <div id="go" class=" col-lg-12">
        <div id="go" class="alert alert-success" style="text-align: center; color:#333;"><?php print @$msg;?> <i id="remove" class="fa fa-remove pull-right"></i></div>
        </div>
 </div>
<?php }else{?>
 <div class="row">
         <div id="go" class=" col-lg-12">
        <div id="go" class="alert alert-warning" style="text-align: center; color:#000;">NOTE: You can also add review from here. Thanks <i id="remove" class="fa fa-remove pull-right"></i></div>
        </div>
 </div>
    <?php }?>        
         <div class="row">
    
          	<div class="col-lg-4 col-md-12 col-sm-12 col-xs-12" >
					 <form action="" method="post" enctype="multipart/form-data">  
                          <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <tbody>
                                    <tr>
                                    	<td><h3>Upload Reviews</h3></td>
                                    </tr>
                                    <tr>
                                            <td>
                                            <label>Enter Name:</label>
                                            <input class="form-control" type="text" value="" name="name" >
                                            </td>
                                        </tr>
                                         <tr>
                                            <td>
                                            <label>Review:</label>
                                            <textarea class="form-control" id="reviewMsg" name="reviewMsg"></textarea>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td align="right"><input class="btn btn-primary" type="submit" name="post" value="Post" /></td>
                                        </tr>
                                    </tbody>
                            </table></form>   
              </div>
    
                    <div class="col-md-12 col-lg-8 col-sm-12">
                        <div class="panel">
                            <div class="panel-heading">Recent Manipulation</div>
                            <div class="table-responsive">
                                <table class="table table-hover manage-u-table">
                                    <thead>
                                        <tr>
                                            <th style="width: 70px;" class="text-center">#</th>
                                            <th>Name</th>
											<th>Email</th>
											<th>Message</th>
											<th> Date</th>
											<th> Remove</th>
											<th> Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                  <?php $sql = query_sql("SELECT * FROM $review ORDER BY id DESC");
										$i=1;
						if(mysqli_num_rows($sql)>0){
							while($row = mysqli_fetch_assoc($sql)){
								if($row['status']=='0'){
									$Reviewstatus = '<a title="Approve" href="clients-review?st='.$row['status'].'&id='.$row['id'].'"><i class="btn btn-danger fa fa-lock"></i></a>';
								}else{
									$Reviewstatus = '<a title="Disapprove" href="clients-review?st='.$row['status'].'&id='.$row['id'].'"><i class="btn btn-success fa fa-unlock"></i></a>';
								}
												?>
									<tr>
									    <th class="text-center"><?php print $i;?></th>
										<th><i class="fa fa-dot-circle-o complete"></i> <?php print $row['name'];?></th>
										<td><?php print $row['email'];?></td>
										<td><?php print $row['message'];?></td>
										<td><?php print $row['date_added'];?></td>
										<td><a data-toggle="modal" href="#myModalWWW<?php print $row['id'];?>"><i class="btn btn-danger fa fa-trash-o"></i></a></td>
										<td><?php print $Reviewstatus;?></td>
                                   
                                   <!-- Modal -->
		    <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModalWWW<?php print $row['id'];?>" class="modal fade">
		              <div class="modal-dialog">
		                  <div class="modal-content">
		                      <div class="modal-header">
		                          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		                          <h4 class="modal-title">Delete Review ?</h4>
		                      </div>
		                      <div class="modal-body">
		                          <p>Are you sure you want to delete this item</p>
		                      </div>
		                      <div class="modal-footer">
		                          <button data-dismiss="modal" class="btn btn-default" type="button">Cancel</button>
		                          <a href="clients-review?iddel=<?php print $row['id'];?>">
								  <span class="btn btn-danger">Delete</span>
								  </a>
		                      </div>
		                  </div>
		              </div>
		          </div>
		          <!-- modal -->
                                    </tr>
                          <?php $i++; }}else{?><tr><td colspan="5">
                                          <h3>No data found!</h3>
										 </td></tr>
                                           <?php }?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.row -->
               
                

			
		</section>
   
      <!--main content end-->
  </section>
  <!-- container section start -->
</section>
 
  	

    <!-- javascripts -->
  <?php require_once('jsfiles.php')?>
    <!-- charts scripts -->
  </body>
</html>
