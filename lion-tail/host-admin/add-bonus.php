<?php $actova1=''; $actova2=''; $actova3=''; $actova4=''; $actova5=''; $actova6=''; $actova7=''; $actova8=''; $actova9='active'; $actova10='';?>
<?php require_once('../../con-cot/conn_sqli.php'); ?>
<?php require_once('../../lib/basic-functions.php'); ?>
<?php require_once('../../library.php'); ?>
<?php require_once('../../select-library.php'); ?>
<?php require_once('../../emails_lib.php'); 
require('../../dashboard/try/coinpayments.inc.php');
if(isset($_GET['id'])&&!empty($_GET['id'])){
	$user_id = $_GET['id'];
}else{
	header("location:all-users");
}
?>
<?php $bassic->checkLogedINAdmin('login');?>

<?php 
if(isset($_POST['post'])){
$bonus = mysqli_real_escape_string($link,$_POST['bonus']);
	if(!empty($bonus)){
	$amount = $bonus;
	$tID = $bassic->randGenerator().$cal->getLastID($deposit_tb);
	$coin = 'BTC';
	$plan = 'BONUS';
	$intrest_growth = 0;
	$deposit_status = 'confirmed';
	$category = $coin.'-BONUS';
	$description = $coin.'-BONUS';
	$place_order = 'no';
	$received_status = 'no';
	$payout_consent = 'no';
	$day_counter = 0;
	$total_not_paid = 0;
	$total_paid = 0;
	$btc_address = 'Bonus';
	$ethereum_address = 'Bonus';
	$plan_type = $plan;
	$coin_type = $coin;
	$coin_value = '';
	$expire_time = '';
	$status_url = '';
	$package = 'BONUS';
	$invest_week_day = date('D');
	$transaction_hash = 'none';
	$perfectmoney = 'Bonus';
     
	$fields = array('id','transaction_id','email','amount','intrest_growth','deposit_status','deposit_category','description','place_order','received_status','payout_consent','day_counter','date_created','total_not_paid','total_paid','btc_address','ethereum_address','plan_type','coin_type','coin_value','expire_time','packagetype','status_url','invest_week_day','transaction_hash','perfectmoney');
		
	$values = array(null,$tID,$user_id,$amount,$intrest_growth,$deposit_status,$category,$description,$place_order,$received_status,$payout_consent,$day_counter,$bassic->getDate(),$total_not_paid,$total_paid,$btc_address,$ethereum_address,$plan_type,$coin_type,$coin_value,$expire_time,$package,$status_url,$invest_week_day,$transaction_hash,$perfectmoney);
		
	$pasER = $cal->depositBTC($deposit_tb,$fields,$values);	
	if($pasER){
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
$title = 'Add Bonus';
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
					<h3 class="page-header"><i class="fa fa-laptop"></i> Add Bonus</h3>
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
<?php }?>
        
         <div class="row">
         <div class="col-lg-2"></div>
          	<div class="col-lg-8 col-md-12 col-sm-12 col-xs-12" >
<form action="" method="post" enctype="multipart/form-data">  
<table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
		<tbody>
		<tr>
				<td>
				
			<div class="form-group">
				<label>Add Bonus To <?php print @$cal->selectFrmDB($user_tb,'first_name','email',$user_id);?></label><br />
			  <hr color="red">
				  <div class="col-lg-6">
					 Available Bonus($): <input type="number" value="<?php //print @$cal->selectFrmDB($user_tb,'bonus','email',$user_id);?>" class="form-control" id="bonus" name="bonus" placeholder="0.00">
				  </div>
			  </div>
				</td>

			</tr>

			<tr>
				<td align="right">
				<input class="btn btn-primary" type="submit" name="post" value="Update Bonus" /></td>
			</tr>
		</tbody>
</table></form>
             
                
                    <!-- .row -->
                <div class="row">
                    <div class="col-md-12 col-lg-12 col-sm-12">
                        <div class="panel">
                            <div class="panel-heading">Recent Transactions</div>
                            <div class="table-responsive">
                                <table class="table table-hover manage-u-table">
                                    <thead>
                                        <tr>
                                            <th style="width: 70px;" class="text-center">#</th>
                                            <th>Transaction ID</th>
											<th data-priority="1">Date</th>
											<th data-priority="3">Status</th>
											<th data-priority="1"> Amount</th>
											<th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                  <?php $sql = query_sql("SELECT * FROM $deposit_tb WHERE `email` = '".$user_id."' and `coin_type`='BONUS'  ORDER BY id DESC");
										$i=1;
						if(mysqli_num_rows($sql)>0){
							while($row = mysqli_fetch_assoc($sql)){
												?>
									<tr>
									    <th class="text-center"><?php print $i;?></th>
										<th><i class="fa fa-dot-circle-o complete"></i> <?php print $row['transaction_id'];?></th>
										<td><?php print $row['date_created'];?></td>
										<td>
										<?php if($row['deposit_status']=='confirmed'){?>
										<span class="label label-success">
										<?php }else{?>
										<span class="label label-primary">
										<?php }?>
										<?php print $row['deposit_status'];?></span></td>
										<td><i class="fa fa-plus complete normal"></i>
                                                    
<?php if($row['coin_type']=='perfectmoney' || $row['coin_type']=='ETH'){ print '$'.$row['amount']; }else{ print $row['amount'];}?> 
                                 
                                  
										<?php print $row['coin_type'];?> </td>
										<td ><a  href="<?php print $row['status_url']; ?>"><span class="label label-primary">Check Status</span></a></td>
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
