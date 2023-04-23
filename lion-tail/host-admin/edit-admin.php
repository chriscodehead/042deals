<?php $actova1=''; $actova2=''; $actova3='active'; $actova4=''; $actova5=''; $actova6=''; $actova7=''; $actova8=''; $actova9=''; $actova10='';?>
<?php require_once('../../con-cot/conn_sqli.php'); ?>
<?php require_once('../../lib/basic-functions.php'); ?>
<?php require_once('../../library.php'); ?>
<?php require_once('../../select-library.php'); ?>
<?php $bassic->checkLogedINAdmin('login');?>
<?php if(isset($_GET['id'])){$get_id = $_GET['id'];}else{header("location:admin-acount");}?>
<?php 
$msg='';$block='';
if(isset($_POST['sub'])){
	$name = mysqli_real_escape_string($link,$_POST['name']);
	$block = mysqli_real_escape_string($link,$_POST['block']);
	$password = mysqli_real_escape_string($link,$_POST['password']);
	$role = mysqli_real_escape_string($link,$_POST['role']);
	if(!empty($name)&&!empty($role)){
		if(!empty($password)){
		           $passh = $bassic->passwordHash($agorithm,$password);
					$fields = array('password','name','blocked_account','role');
					$values = array($passh,$name,$block,$role);
					$msg = $cal->update($admin_tb,$fields,$values,'id',$get_id);
		}else{
			
					$fields = array('name','blocked_account','role');
					$values = array($name,$block,$role);
					$msg = $cal->update($admin_tb,$fields,$values,'id',$get_id);
			}
		}else{
			$msg='Please fill all fields';
			}
	}
	$name = $cal->selectFrmDB($admin_tb,'name','id',$get_id);
	$role = $cal->selectFrmDB($admin_tb,'role','id',$get_id);
	$password = $cal->selectFrmDB($admin_tb,'password','id',$get_id);
	$block = $cal->selectFrmDB($admin_tb,'blocked_account','id',$get_id);
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
              <div class="container">
             <form action="" method="post" enctype="multipart/form-data">
            <div class="row">
            <div class="col-lg-12 fram">
            	  <div class="col-lg-12  pad">
        	<label class="textcolor">Admin Name: *</label>
        	<input id="name"  value="<?php if(!empty($name)) print $name;?>" class=" form-control focus frml" required name="name" placeholder="Enter Admin Name" type="text">
        </div>
             <div class="col-lg-12  pad">
        	<label class="textcolor">Block Admin: *</label>
        	  <select class=" form-control focus frml"  name="block" id="block">
                       <option selected="selected" value="">Select Admin Role</option>
                      <option  <?php if($block=='1') echo 'selected="selected"';?> value="1">Yes</option>
                      <option  <?php if($block=='0') echo 'selected="selected"';?> value="0">No</option>
                </select>
        </div>
        	  <div class="col-lg-12  pad">
        	<label class="textcolor">Admin Password: *</label>
        	<input id="password"  value="" class=" form-control focus frml"  name="password" placeholder="Enter Admin Password" type="text">
        </div>
         <div class="col-lg-12  pad">
        	<label class="textcolor">Admin Role: *</label>
        	  <select class=" form-control focus frml"  name="role" id="role">
                       <option selected="selected" value="">Select Admin Role</option>
                      <option  <?php if($role=='admin1') echo 'selected="selected"';?> value="admin1">Admin1</option>
                      <option  <?php if($role=='admin2') echo 'selected="selected"';?> value="admin2">Admin2</option>
                      <option  <?php if($role=='admin3') echo 'selected="selected"';?> value="admin3">Admin3</option>
                </select>
        </div>
       <div class="col-lg-12  pad">
        <input  class="btn btn-primary signn" style="margin-top:20px;" id="submer"  name="sub" type="submit" value="Update Account">
        </div>
        </div>
				</div><!--/.row-->
</form>
</div>
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
