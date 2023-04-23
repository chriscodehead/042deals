<?php $actova1=''; $actova2=''; $actova3='active'; $actova4=''; $actova5=''; $actova6=''; $actova7=''; $actova8=''; $actova9=''; $actova10='';?>
<?php require_once('../../con-cot/conn_sqli.php'); ?>
<?php require_once('../../lib/basic-functions.php'); ?>
<?php require_once('../../library.php'); ?>
<?php require_once('../../select-library.php'); ?>
<?php $bassic->checkLogedINAdmin('login');?>
<?php if(isset($_GET['msg'])&&!empty($_GET['msg'])){$msg = $_GET['msg'];}?>
<?php 
//delete user
if(isset($_GET['delete'])&&!empty($_GET['delete'])){
	$id = $_GET['delete'];
	 if(mysqli_query($link,"delete from admin_tb where id='".$id."'")){
		 header("location:admin-acount?msg=Admin was successfully deleted form database");
		 }else{
			 header("location:admin-acount?msg=Error! Admin data failed to be deleted");
			 }
	}
	
if(isset($_GET['block'])&&!empty($_GET['block'])){
	$idb = $_GET['block'];
	$val = array('1');
	$fld = array('blocked_account');
	$msg = $cal->update($admin_tb,$fld,$val,'id',$idb);
	 header("location:admin-acount?msg=Admin was successfully blocked!");
}
?>
<!DOCTYPE html>
<html lang="en">
<?php
$title = 'Admin';
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
					<h3 class="page-header"><i class="fa fa-laptop"></i> All Admin</h3>
					<ol class="breadcrumb">
						<li><i class="fa fa-home"></i><a href="../host-admin/">Home</a></li>
						<li><i class="fa fa-laptop"></i><a href="admin-acount">Admin Account</a></li>	
                        <li><i class="fa fa-laptop"></i><a href="create-admin-acount">Create Admin Account</a></li>							  	
					</ol>
				</div>
			</div>
              
  <?php if(!empty($msg)){?>
 <div class="row">
         <div id="go" class=" col-lg-12">
        <div id="go" class="alert alert-warning" style="text-align: center;"><?php print @$msg;?> <i id="remove" class="fa fa-remove pull-right"></i></div>
        </div>
 </div>
<?php }?>     
            <div class="row">
            	<div class="col-lg-12">
					<?php $select->SelectAlladmin();?>
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