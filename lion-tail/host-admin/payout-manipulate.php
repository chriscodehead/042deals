<?php $actova1=''; $actova2=''; $actova3=''; $actova4=''; $actova5=''; $actova6=''; $actova7=''; $actova8=''; $actova9=''; $actova10=''; $actova44='active';?>
<?php require_once('../../con-cot/conn_sqli.php'); ?>
<?php require_once('../../lib/basic-functions.php'); ?>
<?php require_once('../../library.php'); ?>
<?php require_once('../../select-library.php'); ?>
<?php require_once('../../emails_lib.php'); ?>
<?php $bassic->checkLogedINAdmin('login');?>
 <?php
$msg='';$coin='';
?>

<?php 
if(isset($_POST['post'])){
	$usernamet = mysqli_real_escape_string($link,$_POST['user']);
	$amountt = mysqli_real_escape_string($link,$_POST['amount']);
	$coint = mysqli_real_escape_string($link,$_POST['coin']);
	$type = mysqli_real_escape_string($link,$_POST['type']);
	if(!empty($usernamet)&&!empty($amountt)&&!empty($coint)&&!empty($type)){
     if(query_sql("INSERT INTO $payout_manipulate VALUES(null,'".$usernamet."','".$coint."','".$amountt."','".$bassic->getDate()."','".$type."')")){
		 $msg = 'Insert successfully!';
	 }else{
		 $msg = 'Action Failed!';
	 }
			}else{$msg = 'Please fill all fields';}
}
?>
<?php 
if(isset($_GET['id'])&&!empty($_GET['id'])){
		 if(query_sql("DELETE FROM $payout_manipulate WHERE `id`='".$_GET['id']."' LIMIT 1")){
			 $msg = 'Delete process was successful!';
			 header("location:payout-manipulate?done=".$msg);
		 }else{
			 $msg = 'Info Faild to delete!';
			 header("location:payout-manipulate?done=".$msg);
		 }
}
?>
<?php if(isset($_GET['done'])&&!empty($_GET['done'])){$msg = $_GET['done'];}?>
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
                                            <label>Enter Name:</label>
                                            <input class="form-control" type="text" value="" name="user" >
                                            </td>
                                        </tr>
                                         <tr>
                                            <td>
                                            <label>Type:</label>
                                            <select class="form-control" name="type"> 
                                            	<option value="Deposit">Deposit</option>
                                            	<option value="Withdrawal">Withdrawal</option>
                                            	<option value="Top Investor">Top Investors</option>
                                            </select>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                            <label>Payout Amount:</label>
                                            <input class="form-control" value="" type="number" name="amount" >
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                            <label>Coin Type:*</label>
											<select class="form-control" name="coin" id="coin">
												<option value="BTC">BTC</option>
												<option value="ETH">ETH</option>
												<option value="PM">PM</option>
											</select>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td align="right"><input class="btn btn-primary" type="submit" name="post" value="Post" /></td>
                                        </tr>
                                    </tbody>
                            </table></form>   
              </div>
         </div><!--/.row-->
              
                <!-- .row -->
                <div class="row">
                    <div class="col-md-12 col-lg-12 col-sm-12">
                        <div class="panel">
                            <div class="panel-heading">Recent Manipulation</div>
                            <div class="table-responsive">
                                <table class="table table-hover manage-u-table">
                                    <thead>
                                        <tr>
                                            <th style="width: 70px;" class="text-center">#</th>
                                            <th>Username</th>
											<th>Coin</th>
											<th>Type</th>
											<th> Amount</th>
											<th> Date</th>
											<th> Remove</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                  <?php $sql = query_sql("SELECT * FROM $payout_manipulate ORDER BY id DESC");
										$i=1;
						if(mysqli_num_rows($sql)>0){
							while($row = mysqli_fetch_assoc($sql)){
												?>
									<tr>
									    <th class="text-center"><?php print $i;?></th>
										<th><i class="fa fa-dot-circle-o complete"></i> <?php print $row['username'];?></th>
										<td><?php print $row['coin_type'];?></td>
										<td><?php print $row['type'];?></td>
										<td><?php print $row['amount'];?></td>
										<td><?php print $row['date_reg'];?></td>
										<td><a href="payout-manipulate?id=<?php print $row['id'];?>"><i class="btn btn-danger fa fa-trash-o"></i></a></td>
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
