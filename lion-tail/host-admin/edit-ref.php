  <?php $actova1=''; $actova2='active'; $actova3=''; $actova4=''; $actova5=''; $actova6=''; $actova7=''; $actova8=''; $actova9=''; $actova10='';?>
<?php require_once('../../con-cot/conn_sqli.php'); ?>
<?php require_once('../../lib/basic-functions.php'); ?>
<?php require_once('../../library.php'); ?>
<?php require_once('../../select-library.php'); ?>
<?php $bassic->checkLogedINAdmin('login');?>
 <?php if(isset($_GET['id'])&&!empty($_GET['id'])){
	$getid = mysqli_real_escape_string($link,$_GET['id']);
}else{
	header("location:edit-ref.php");
}?>

      <?php //confirm-terminate
   if(isset($_POST['sub'])){
	   	$amount = mysqli_real_escape_string($link,$_POST['amount']);
	    $balance = mysqli_real_escape_string($link,$_POST['balance']);
	    $status = mysqli_real_escape_string($link,$_POST['status']);
	    $referral_email = mysqli_real_escape_string($link,$_POST['referral_email']);
	    $referred_email = mysqli_real_escape_string($link,$_POST['referred_email']);
	    $plan_type = mysqli_real_escape_string($link,$_POST['plan_type']);
	    $coin_type = mysqli_real_escape_string($link,$_POST['coin_type']);
	    
	   if(!empty($getid)){
			$fields = array('amount','balance','status','referral_email','referred_email','plan_type','coin_type');
			$values = array($amount,$balance,$status,$referral_email,$referred_email,$plan_type,$coin_type);
			$msg = $cal->update($referral_tb,$fields,$values,'id',$getid);	
			header("location:edit-ref.php?id=".$getid."&done=".$msg);
	   }
	 } 
  ?>
  

  <?php if(isset($_GET['done'])&&!empty($_GET['done'])){$msg = $_GET['done'];}?>
<!DOCTYPE html>
<html lang="en">
<?php
$title = 'Referal | Edit';
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
					<h3 class="page-header"><i class="fa fa-laptop"></i> Referal Edit</h3>
					<ol class="breadcrumb">
						<li><i class="fa fa-home"></i><a href="../host-admin/">Home</a></li>
						<li><i class="fa fa-laptop"></i> Users Referal Edit</li>						  	
					</ol>
				</div>
			</div>
            
<?php if(!empty($msg)){?>
 <div class="row">
         <div id="go" class=" col-lg-12">
        <div id="go" class="alert alert-warning" style="text-align: center; color:#333;"><?php print @$msg;?> <i id="remove" class="fa fa-remove pull-right"></i></div>
        </div>
 </div>
<?php }?>

           <div class="container">
             <div class="row" style="margin-bottom:20px;">
            
            <form action="" method="post" enctype="multipart/form-data">
            <div class="col-lg-6" style="margin-bottom:10px;">
            <label>Amount</label>
            <input name="amount" class="form-control" value="<?php print $cal->selectFrmDB($referral_tb,'amount','id',$getid);?>"  type="text" placeholder="Amount">
            
            <label>Balance</label>
            <input name="balance" class="form-control" value="<?php print $cal->selectFrmDB($referral_tb,'balance','id',$getid);?>"  type="text" placeholder="Balance">
            
            <label>Deposit Status</label>
            <input name="status" class="form-control" value="<?php print $cal->selectFrmDB($referral_tb,'status','id',$getid);?>"  type="text" placeholder="Status">eg(pending,confirmed)<br />
            
            <label>Referral Email</label>
            <input name="referral_email" class="form-control" value="<?php print $cal->selectFrmDB($referral_tb,'referral_email','id',$getid);?>"  type="text" placeholder="">
            
             <label>Refered Email</label>
            <input name="referred_email" class="form-control" value="<?php print $cal->selectFrmDB($referral_tb,'referred_email','id',$getid);?>"  type="text" placeholder="Total paid">
            
				</div>
            <div class="col-lg-6" style="margin-bottom:10px;">
            
            <label>Plan Type</label>
            <input name="plan_type" class="form-control" value="<?php print $cal->selectFrmDB($referral_tb,'plan_type','id',$getid);?>"  type="text" placeholder="Plan Type">eg(starter,silver,gold,premium)<br />
            
            <label>Coin Type</label>
            <input name="coin_type" class="form-control" value="<?php print $cal->selectFrmDB($referral_tb,'coin_type','id',$getid);?>"  type="text" placeholder="Coin Type">eg(BTC,ETH)<br />
            <br />
            <button class="btn btn-primary" name="sub"> Update <i class="fa fa-send"></i></button>
            
            </div>
            </form></div>
             </div>
               
                

			
		</section>
   
      <!--main content end-->
  </section>
  <!-- container section start -->
</section>
 
  		<h4 align="center">&copy;</h4>

    <!-- javascripts -->
  <?php require_once('jsfiles.php')?>
    <!-- charts scripts -->
  </body>
</html>

<script type="text/javascript">
	$(document).ready(function(e) {
        $('#depo').click(function (){
			if($('#plan').val()=="" || $('#amount').val()==""){
				sweetError('Please fill all fields!');
				}else{
						document.getElementById('sudep').click();
					}
			});
    });
	</script>