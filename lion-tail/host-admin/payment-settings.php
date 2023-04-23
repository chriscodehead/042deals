<?php $actova1=''; $actova2=''; $actova3=''; $actova4=''; $actova5=''; $actova6=''; $actova7=''; $actova8=''; $actova9='active'; $actova10='';?>
<?php require_once('../../con-cot/conn_sqli.php'); ?>
<?php require_once('../../lib/basic-functions.php'); ?>
<?php require_once('../../library.php'); ?>
<?php require_once('../../select-library.php'); ?>
<?php require_once('../../emails_lib.php'); 
require('../../dashboard/try/coinpayments.inc.php');
?>
<?php $bassic->checkLogedINAdmin('login');?>

<?php 
if(isset($_POST['post'])){
$setting = mysqli_real_escape_string($link,$_POST['set']);
	if(!empty($setting)){
     if(query_sql("UPDATE $pay_set SET `status`='".$setting."' WHERE `id`=1")){
		 $msg = 'Update was successful!';
	 }else{
		 $msg = 'Update Failed!';
	 }
			}else{$msg = 'Please fill all fields';}
}
?>
<!DOCTYPE html>
<html lang="en">
<?php
$title = 'Payment Setting';
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
					<h3 class="page-header"><i class="fa fa-laptop"></i> Payment Settings</h3>
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
        <div id="go" class="alert alert-warning" style="text-align: center; color:#000;">Set Up Payment Settings (Yes => Authomatic Payout, No => Manual Payout) <i id="remove" class="fa fa-remove pull-right"></i></div>
        </div>
 </div>
    <?php }?>        
         <div class="row">
         <div class="col-lg-2"></div>
          	<div class="col-lg-8 col-md-12 col-sm-12 col-xs-12" >
<form action="" method="post" enctype="multipart/form-data">  
<table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
		<tbody>
		<tr>
				<td>
				<label>Payment Setting:</label>
				
		 <select class="form-control" name="set" id="set">
              <option selected="selected" value="">Do You Want Authomatic Payout</option>
              <?php $set = $cal->selectFrmDB($pay_set,'status','id',1);?>
              <option <?php if($set=='Yes') echo 'selected="selected"';?> value="Yes">Yes</option>
              <option <?php if($set=='No') echo 'selected="selected"';?> value="No">No</option>
            </select>
				</td>

			</tr>

			<tr>
				<td align="right"><input class="btn btn-primary" type="submit" name="post" value="Set Payout Method" /></td>
			</tr>
		</tbody>
</table></form>   
              </div>
         </div><!--/.row-->
               
                

			
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
