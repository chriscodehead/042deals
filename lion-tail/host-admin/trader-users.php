<?php $actova1=''; $actova2=''; $actova3=''; $actova4=''; $actova5=''; $actova6=''; $actova7=''; $actova8=''; $actova9=''; $actova10=''; $actova11='active';?>
<?php require_once('../../con-cot/conn_sqli.php'); ?>
<?php require_once('../../lib/basic-functions.php'); ?>
<?php require_once('../../library.php'); ?>
<?php require_once('../../select-library.php'); ?>
<?php $bassic->checkLogedINAdmin('login');?>
  <?php 
if(isset($_GET['block'])&&!empty($_GET['block'])){
		$value = array("1");
		$field = array("blocked_account");
		$blockuser = $cal->update($user_tb,$field,$value,'id',$_GET['block']);
		if(!empty($blockuser)){$msg = $blockuser;}
		header("location:all-users");
}
?>

<?php 
if(isset($_GET['unblock'])&&!empty($_GET['unblock'])){
		$value = array("0");
		$field = array("blocked_account");
		$blockuser = $cal->update($user_tb,$field,$value,'id',$_GET['unblock']);
		if(!empty($blockuser)){$msg = $blockuser;}
		header("location:all-users");
}
?>
<!DOCTYPE html>
<html lang="en">
<?php
$title = 'Users | The Best Bitcoin Mining Company';
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
					<h3 class="page-header"><i class="fa fa-laptop"></i> Traders</h3>
					<ol class="breadcrumb">
						<li><i class="fa fa-home"></i><a href="../../man-run-coko/host-admin/">Home</a></li>
						<li><i class="fa fa-laptop"></i> Traders Account</li>						  	
					</ol>
				</div>
			</div>


<div class="row" style="margin-bottom:20px;">
<?php @$select->getALLemails();?>
<br />

</div>


               <div class="row" style="margin-bottom:20px;">
            <script type="text/javascript" src="../../js/jquery-2.1.1.min.js"></script> 
            <form action="" method="post" enctype="multipart/form-data">
            <div class="col-lg-12" style="margin-bottom:10px;"><input class="form-control" id="search" type="text" placeholder="Search Participant by Name, Email, Phone Number, wallet address"></div>
            <div class="col-lg-12" ><div id="searchresults" ></div></div>
             <script type="text/javascript" src="../../js/search.js"></script>
            </form></div>
            
         <div class="row">
          	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" >
					<?php $select->SelectAlltrader();?>     
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
