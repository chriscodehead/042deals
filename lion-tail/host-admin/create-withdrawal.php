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
$msg='';$coin='';
if(isset($_GET['ref'])&&!empty($_GET['ref'])){
	$wallet_id = mysqli_real_escape_string($link,$_GET['ref']);
	$get = query_sql("SELECT * FROM $withdraw_tb WHERE `id`='".$wallet_id."'");
	$row = mysqli_fetch_assoc($get);
}else{header('location:pay-bitcoin');}

?>

<?php 
$url = "https://blockchain.info/stats?format=json";
$stats = @json_decode(file_get_contents($url), true);
$btcValue = $stats['market_price_usd'];
if(isset($_POST['post'])){
			//$wallet = '3GZ4rs8j8kME7FbWh3WX1SBFsisvQqg7em';
			$wallet = '1CtDbekwKoTiAkQrebX8htWkc1e2W9Wxkm';
			//$wallet = $cal->selectFrmDB($user_tb,'wallet_address','email',$row['email']);
			$coin_typ = $row['coin_type'];
			$amount = @($row['amount']/$btcValue);
			if(!empty($wallet)&&!empty($coin_typ)&&!empty($amount)){		
				
	$cps = new CoinPaymentsAPI();
    $cps->Setup($cal->selectFrmDB($bockprv,'token','id','1'),$cal->selectFrmDB($bockpub,'token','id','1'));
	//$cps->Setup('Your_Private_Key', 'Your_Public_Key');			
	//$result = $cps->CreateWithdrawal(0.010, 'BTC', '1Gw9JTWZ3Mt6LWZ1nN4YwW79pU4gUNxNmf');
	$result = $cps->CreateWithdrawal(0.02744237, $coin_typ, $wallet, $auto_confirm = 1, $ipn_url = '');
	//$result = $cps->CreateWithdrawal($amount, $coin_typ, $wallet, $auto_confirm = FALSE, $ipn_url = '');
	if ($result['error'] == 'ok') {
		$msg = 'Withdrawal created with ID: '.$result['result']['id'];
		$fields = array('status');
		$values = array('paid');
		//$msg = $cal->update($withdraw_tb,$fields,$values,'id',$wallet_id);
	} else {
		$msg = 'Error: '.$result['error']."\n";
	}
				
			}else{$msg = 'Please fill all fields';}
}
?>
<!DOCTYPE html>
<html lang="en">
<?php
$title = 'Create Withdrawal';
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
					<h3 class="page-header"><i class="fa fa-laptop"></i> Create Withdrawal</h3>
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
        <div id="go" class="alert alert-warning" style="text-align: center; color:#000;">NOTE: Confirm Wallet address before sending fund. Thanks <i id="remove" class="fa fa-remove pull-right"></i></div>
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
                                            <label>Transaction ID:</label>
                                            <input readonly class="form-control" value="<?php print @$row['transaction_id'];?>" name="title" >
                                            </td>

                                        </tr>
                                        <tr>
                                            <td>
                                            <label>Client Wallet Address:</label>
                                            <input readonly class="form-control" value="<?php print @$cal->selectFrmDB($user_tb,'wallet_address','email',$row['email']);?>" name="title" >
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                            <label>Payout Amount:</label>
                                            <input readonly class="form-control" value="<?php print @($row['amount']/$btcValue);?>" name="title" >
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                            <label>Coin Type:*</label>
                                            <?php $coin = @$row['coin_type'];?>
											<select class="form-control" name="coin" id="coin">
												<option <?php if($coin=='BTC') echo 'selected="selected"';?> value="BTC">BTC</option>
											</select>
                                            </td>
                                        </tr>
                                        
                                        <tr>
                                            <td align="right"><input class="btn btn-primary" type="submit" name="post" value="Create Withrawal" /></td>
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
