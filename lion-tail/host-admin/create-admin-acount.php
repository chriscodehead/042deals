<?php $actova1=''; $actova2=''; $actova3='active'; $actova4=''; $actova5=''; $actova6=''; $actova7=''; $actova8=''; $actova9=''; $actova10='';?>
<?php require_once('../../con-cot/conn_sqli.php'); ?>
<?php require_once('../../lib/basic-functions.php'); ?>
<?php require_once('../../library.php'); ?>
<?php require_once('../../select-library.php'); ?>
<?php $bassic->checkLogedINAdmin('login');?>
<?php 
$msg='';$role='';
if(isset($_POST['sub'])){
	$name = $_POST['name'];
	$email = $_POST['email'];
	$password = $_POST['password'];
	$passwordh = $bassic->passwordHash($agorithm,$password);
	$role = $_POST['role'];
	if(!empty($name)&&!empty($email)&&!empty($password)&&!empty($role)){
		$emailcheck = $cal->checkifdataExists($email,'email',$admin_tb);
		if($emailcheck==0){
					$fields = array('id','email','password','name','blocked_account','role','day_reg');
					$values = array(null,$email,$passwordh,$name,'0',$role,$bassic->getDate());
					$in = $cal->insertData($admin_tb,$fields,$values);
					$msg = 'Admin account was created successfully!';
				}else if($emailcheck==1){
				$msg = 'Error! Email already exists.';
				}
		}else{
			$msg='Please fill all fields';
			}
	}?>
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
					<h3 class="page-header"><i class="fa fa-laptop"></i> Create New Admin</h3>
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
            	  <div class="col-lg-12  pad">
        	<label class="textcolor">Admin Name: *</label>
        	<input id="name"  value="<?php if(!empty($name)) print $name;?>" class=" form-control focus frml" required name="name" placeholder="Enter Admin Name" type="text">
        </div>
        	  <div class="col-lg-12  pad">
        	<label class="textcolor">Admin Email: *</label>
        	<input id="email"  value="<?php if(!empty($email)) print $email;?>" class=" form-control focus frml" required name="email" placeholder="Enter Admin Email" type="email">
        </div>
        	  <div class="col-lg-12  pad">
        	<label class="textcolor">Admin Password: *</label>
        	<input id="password"  value="<?php if(!empty($password)) print $password;?>" class=" form-control focus frml" required name="password" placeholder="Enter Admin Password" type="password">
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
        <input style="margin-top:20px;"  class="btn btn-primary signn pull-right" id="submer"  name="sub" type="submit" value="Create Account">
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
