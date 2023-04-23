<?php require_once('../../con-cot/conn_sqli.php'); ?>
<?php
	// $search = mysqli_real_escape_string($link,trim($_POST['searchterm']));
	 if(isset($_GET['peter'])){
$search_result = mysqli_query($link,"SELECT * FROM `deposit_tb`  ");
?>

<?php

	echo '
			<table class="tableclass table-responsive table-bordered table-striped table-condensed" style="font-size:11px; color:#06C;"  width="100%">
						<tr style="color:#000;">
						<td >S/N</td>
						<td >Transaction ID</td>
						<td >Email</td>
						<td >Deposit Amount($)</td>
						<td >Expected Interest($)</td>
						<td >Daily Interest($)</td>
						<td >Expected Wallet($)</td>
						<td >Description</td>
						<td >Status</td>
						<td >Third party Status</td>
						<td >Category</td>
						<td >Day On</td>
						<td >Date Reg.</td>
						<td >Confirm/Unconfirm</td>
						<td >End/Open</td>
						</tr>';
						$i =1;
while($row = mysqli_fetch_array($search_result)){
$sm = $row['pacentage_growth']+$row['amount'];
				   if($row['deposit_status']=='confirmed'){
					   $state = '<a data-toggle="modal" href="#myModuUN'.$row['id'].'" title="Unconfirm Wallet"><i class="btn btn-default fa fa-unlock"></i></a>';
					   $ends = '<a data-toggle="modal" href="#myModull'.$row['id'].'" title="End Transaction"><i class="btn btn-default fa fa-trash-o"></i></a>';
					   }else if($row['deposit_status']=='pending'){
						   $state = '<a data-toggle="modal" href="#myModu'.$row['id'].'" title="Confirm Wallet"><i class="btn btn-default fa fa-lock"></i></a>';
						   $ends = '<a data-toggle="modal" href="#myModull'.$row['id'].'" title="End Transaction"><i class="btn btn-default fa fa-trash-o"></i></a>';
						   }else if($row['deposit_status']=='done'){
						 $state = '<a data-toggle="modal" href="#myModuUN'.$row['id'].'" title="Unconfirm Wallet"><i class="btn btn-default fa fa-unlock"></i></a>';
						  $ends = '<a data-toggle="modal" href="#myModullOP'.$row['id'].'" title="Open Transaction"><i class="btn btn-default fa fa-chain"></i></a>';
						   }else{
						$state = '<a data-toggle="modal" href="#myModu'.$row['id'].'" title="Confirm Wallet"><i class="btn btn-default fa fa-unlock"></i></a>';
						 $ends = '<a data-toggle="modal" href="#myModull'.$row['id'].'" title="End Transaction"><i class="btn btn-default fa fa-trash-o"></i></a>';
							   }
							  if($row['deposit_status']=='confirmed'){
								  $color = '#006600';
								  }else{ $color = '';}
								  if($row['deposit_category']=='master'){
									  $pact = '1%Daily';
									  }else if($row['deposit_category']=='pro'){
										  $pact = '3%Daily';
										  }else if($row['deposit_category']=='starter'){
										  $pact = '7%Daily';
										  }else{$pact='';}
										  if($row['received_status']=='Payment Confirmed'){
											  $colsa = '#00CC00';
											  }else{$colsa = '';}
						 echo '<tr style="color:'.$color.'">
			<td >'. $i.'</td>
			<td >'. $row['wallet_id'] .'</td>
			<td >'. $row['email'] .'</td>
			<td >'. $row['amount'].'</td>
			<td >'. $row['pacentage_growth'].'</td>
			<td style="color:#06C;">'. floor($row['daily_growth']).'</td>
			<td style="color: #00CC00;">'.$sm.'</td>
			<td >'. $row['description'].'</td>
			<td >'. $row['deposit_status'].'</td>
			<td style="color:'.$colsa.'" >'.$row['received_status'].'</td>
			<td >'. $row['deposit_category'].' '.$pact.'</td>
			<td style="color:#06C;">'. $row['day_counter'].'</td>
			<td >'. $row['date_created'].'</td>
			<td align="center">'.$state.'</td>
			<td>'.$ends.'</td>
			
			<!-- Modal -->
		    <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModu'.$row['id'].'" class="modal fade">
		              <div class="modal-dialog">
		                  <div class="modal-content">
		                      <div class="modal-header">
		                          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		                          <h4 class="modal-title">Confirm Users Deposit ?</h4>
		                      </div>
		                      <div class="modal-body">
		                          <p>Are you sure you want to confirm this user? (This mean you have check your bitcoin wallet and confirmed that the deposit the user claim to have made is true.)</p>
		                      </div>
		                      <div class="modal-footer">
		                          <button data-dismiss="modal" class="btn btn-default" type="button">Cancel</button>
		                          <a href="wallet?confirm-deposit='.$row['id'].'">
								  <span class="btn btn-theme">Confirm</span>
								  </a>
		                      </div>
		                  </div>
		              </div>
		          </div>
		          <!-- modal -->
				  
				  		<!-- Modal -->
		    <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModuUN'.$row['id'].'" class="modal fade">
		              <div class="modal-dialog">
		                  <div class="modal-content">
		                      <div class="modal-header">
		                          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		                          <h4 class="modal-title">Unconfirm Users Deposit ?</h4>
		                      </div>
		                      <div class="modal-body">
		                          <p>Are you sure you want to Unconfirm this user? (This mean you have mistakely confirmed this user in the past and found that you have not received the payment he claims to have made.)</p>
		                      </div>
		                      <div class="modal-footer">
		                          <button data-dismiss="modal" class="btn btn-default" type="button">Cancel</button>
		                          <a href="wallet?unconfirm-deposit='.$row['id'].'">
								  <span class="btn btn-theme">Unconfirm</span>
								  </a>
		                      </div>
		                  </div>
		              </div>
		          </div>
		          <!-- modal -->
				  
				  <!-- Modal -->
		    <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModull'.$row['id'].'" class="modal fade">
		              <div class="modal-dialog">
		                  <div class="modal-content">
		                      <div class="modal-header">
		                          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		                          <h4 class="modal-title">Terminate Transaction ?</h4>
		                      </div>
		                      <div class="modal-body">
		                          <p>Are you sure you want to end this transaction?  (This mean you have completely paid this user all interest due and wish to end the transaction for this deposit. By so doing the user will not see this wallet from their end.)</p>
		                      </div>
		                      <div class="modal-footer">
		                          <button data-dismiss="modal" class="btn btn-default" type="button">Cancel</button>
		                          <a href="wallet?confirm-terminate='.$row['id'].'">
								  <span class="btn btn-theme">End</span>
								  </a>
		                      </div>
		                  </div>
		              </div>
		          </div>
		          <!-- modal -->
				  
				   <!-- Modal fa-chain-->
		    <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModullOP'.$row['id'].'" class="modal fade">
		              <div class="modal-dialog">
		                  <div class="modal-content">
		                      <div class="modal-header">
		                          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		                          <h4 class="modal-title">Open Transaction ?</h4>
		                      </div>
		                      <div class="modal-body">
		                          <p>Are you sure you want to open this transaction?  (This mean you have mistakely end the transaction with out if fully maturing.)</p>
		                      </div>
		                      <div class="modal-footer">
		                          <button data-dismiss="modal" class="btn btn-default" type="button">Cancel</button>
		                          <a href="wallet?open-terminate='.$row['id'].'">
								  <span class="btn btn-theme">Open</span>
								  </a>
		                      </div>
		                  </div>
		              </div>
		          </div>
		          <!-- modal -->
			</tr>';
					 $i++;
						  }
						  echo '</table>';
	}
 ?>

