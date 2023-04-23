  <?php $actova1=''; $actova2='active'; $actova3=''; $actova4=''; $actova5=''; $actova6=''; $actova7=''; $actova8=''; $actova9=''; $actova10='';?>
<?php require_once('../../con-cot/conn_sqli.php'); ?>
<?php require_once('../../lib/basic-functions.php'); ?>
<?php require_once('../../library.php'); ?>
<?php require_once('../../select-library.php'); ?>
<?php $bassic->checkLogedINAdmin('login');?>
 <?php if(isset($_GET['id'])&&!empty($_GET['id'])){
	$getid = mysqli_real_escape_string($link,$_GET['id']);
}else{
	header("location:wallet");
}?>

      <?php //confirm-terminate
   if(isset($_POST['sub'])){
	   	$amount = mysqli_real_escape_string($link,$_POST['amount']);
	    $intrest_growth = mysqli_real_escape_string($link,$_POST['intrest_growth']);
	    $deposit_status = mysqli_real_escape_string($link,$_POST['deposit_status']);
	    $day_counter = mysqli_real_escape_string($link,$_POST['day_counter']);
	    $total_paid = mysqli_real_escape_string($link,$_POST['total_paid']);
	    $btc_address = mysqli_real_escape_string($link,$_POST['btc_address']);
	    $ethereum_address = mysqli_real_escape_string($link,$_POST['ethereum_address']);
	    $plan_type = mysqli_real_escape_string($link,$_POST['plan_type']);
	    $coin_type = mysqli_real_escape_string($link,$_POST['coin_type']);
	    
	   if(!empty($getid)){
			$fields = array('amount','intrest_growth','deposit_status','day_counter','total_paid','btc_address','ethereum_address','plan_type','coin_type');
			$values = array($amount,$intrest_growth,$deposit_status,$day_counter,$total_paid,$btc_address,$ethereum_address,$plan_type,$coin_type);
			$msg = $cal->update($deposit_tb,$fields,$values,'id',$getid);	
			header("location:edit-wallet?id=".$getid."&done=".$msg);
	   }
	 } 
  ?>

  <?php if(isset($_GET['done'])&&!empty($_GET['done'])){$msg = $_GET['done'];}?>
<!DOCTYPE html>
<html lang="en">
<?php
$title = 'Wallet | Edit';
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
					<h3 class="page-header"><i class="fa fa-laptop"></i> Wallet Edit</h3>
					<ol class="breadcrumb">
						<li><i class="fa fa-home"></i><a href="../host-admin/">Home</a></li>
						<li><i class="fa fa-laptop"></i> Users Wallet Edit</li>						  	
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
            <input name="amount" class="form-control" value="<?php print $cal->selectFrmDB($deposit_tb,'amount','id',$getid);?>"  type="text" placeholder="Amount">
            
            <label>Intrest Growth</label>
            <input name="intrest_growth" class="form-control" value="<?php print $cal->selectFrmDB($deposit_tb,'intrest_growth','id',$getid);?>"  type="text" placeholder="Interest growth">
            
            <label>Deposit Status</label>
            <input name="deposit_status" class="form-control" value="<?php print $cal->selectFrmDB($deposit_tb,'deposit_status','id',$getid);?>"  type="text" placeholder="Deposit status">eg(pending,confirmed,done)<br />
            
            <label>Week Counter</label>
            <input name="day_counter" class="form-control" value="<?php print $cal->selectFrmDB($deposit_tb,'day_counter','id',$getid);?>"  type="text" placeholder="Week counter">
            
             <label>Total Amount Paid</label>
            <input name="total_paid" class="form-control" value="<?php print $cal->selectFrmDB($deposit_tb,'total_paid','id',$getid);?>"  type="text" placeholder="Total paid">
            
				</div>
            <div class="col-lg-6" style="margin-bottom:10px;">
            <label>BTC Address (BTC Address  were user will deposit to)</label>
            <input name="btc_address" class="form-control" value="<?php print $cal->selectFrmDB($deposit_tb,'btc_address','id',$getid);?>"  type="text" placeholder="BTC Address">
            
            <label>Ethereum Address (ETH Address  were user will deposit to)</label>
            <input name="ethereum_address" class="form-control" value="<?php print $cal->selectFrmDB($deposit_tb,'ethereum_address','id',$getid);?>"  type="text" placeholder="Ethereum Address">
            
            <label>Plan Type</label>
            <input name="plan_type" class="form-control" value="<?php print $cal->selectFrmDB($deposit_tb,'plan_type','id',$getid);?>"  type="text" placeholder="Plan Type">eg(starter,silver,gold,premium)<br />
            
            <label>Coin Type</label>
            <input name="coin_type" class="form-control" value="<?php print $cal->selectFrmDB($deposit_tb,'coin_type','id',$getid);?>"  type="text" placeholder="Coin Type">eg(BTC,ETH)<br />
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