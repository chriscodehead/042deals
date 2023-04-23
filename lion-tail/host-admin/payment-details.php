<?php $actova1=''; $actova2=''; $actova3=''; $actova4=''; $actova5=''; $actova6=''; $actova7=''; $actova8=''; $actova6w=''; $actova10=''; $actova44aw='active';?>
<?php require_once('../../con-cot/conn_sqli.php'); ?>
<?php require_once('../../lib/basic-functions.php'); ?>
<?php require_once('../../library.php'); ?>
<?php require_once('../../select-library.php'); ?>
<?php require_once('../../emails_lib.php'); ?>
<?php require_once('../../lib/sqli-functions.php'); ?>
<?php $bassic->checkLogedINAdmin('login');?>
  <?php 
$msg='';

  if(isset($_POST['walletset'])){
      $walt = $_POST['walt'];
      $btc = $_POST['btc'];
      $usdt = $_POST['usdt'];
      $bnb = $_POST['bnb'];
      $usdt_network = $_POST['usdt_network'];
      if(!empty($walt)){
          $feilds = array('eth','btc','usdt','bnb','usdt_network');
          $value = array($walt,$btc,$usdt,$bnb,$usdt_network);
          $msg = $cal->update($payment_details, $feilds, $value, 'id', 1);
      }else{
          $msg = "Field is empty!";
      }
  }
?>
<!DOCTYPE html>
<html lang="en">
<?php
$title = 'Products | ';
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
					<h3 class="page-header"><i class="fa fa-laptop"></i> Payment</h3>
					<ol class="breadcrumb">
						<li><i class="fa fa-home"></i><a href="../host-admin/">Home</a></li>
						<li><i class="fa fa-laptop"></i> Add Payment Details</li>
					</ol>
				</div>
			</div>

 <?php if(!empty($msg)){?>
 <div class="row">
         <div id="go" class=" col-lg-12">
        <div id="go" class="alert alert-warning" style="text-align: center; color:#FFF;"><?php print @$msg;?> <i id="remove" class="fa fa-remove pull-right"></i></div>
        </div>
 </div>
<?php }else{?>
 <div class="row">
         <div id="go" class=" col-lg-12">
        <div id="go" class="alert alert-warning" style="text-align: center; color:#000;">Add Manual Payment Details <i id="remove" class="fa fa-remove pull-right"></i></div>
        </div>
 </div>
    <?php }?>        
         <div class="row">
         
          	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" >
					 <form action="" method="post" enctype="multipart/form-data">  
                          <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <tbody>
                                     <tr>
                                        	<td>Add ETH Wallet</td>
                                            <td><input name="walt" value="<?php print $sqli->getPaymentDetails('eth');?>"
                                                       type="text"
                                                       class="form-control"
                                                       placeholder="address"
                                                />
                                            </td>
                                            <td></td>
                                        </tr>
                                     <tr>
                                         <td>Add BTC Wallet</td>
                                         <td><input name="btc" value="<?php print $sqli->getPaymentDetails('btc');?>"
                                                    type="text"
                                                    class="form-control"
                                                    placeholder="address"
                                             />
                                         </td>
                                         <td></td>
                                     </tr>
                                     <tr>
                                         <td>Add USDT Wallet</td>
                                         <td><input name="usdt" value="<?php print $sqli->getPaymentDetails('usdt');?>"
                                                    type="text"
                                                    class="form-control"
                                                    placeholder="address"
                                             />
                                         </td>
                                         <td>(Network) <input name="usdt_network" value="<?php print $sqli->getPaymentDetails('usdt_network');?>"
                                                    type="text"
                                                    class="form-control"
                                                    placeholder="Network"
                                             />
                                         </td>
                                     </tr>
                                    <tr>
                                        <td>Add BNB Wallet</td>
                                        <td><input name="bnb" value="<?php print $sqli->getPaymentDetails('bnb');?>"
                                                   type="text"
                                                   class="form-control"
                                                   placeholder="address"
                                            />
                                        </td>
                                        <td></td>
                                    </tr>

                                    <tr>
                                        <td></td>
                                        <td><input class="btn btn-primary" type="submit" name="walletset" value="Update" /></td>
                                        <td></td>
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
