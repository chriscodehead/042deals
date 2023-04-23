<?php require_once('../../con-cot/conn_sqli.php'); ?>
<?php
	 $search = mysqli_real_escape_string($link,trim($_POST['searchterm']));
	 if(!empty($search)){
$search_result = mysqli_query($link,"SELECT * FROM `user_tb` WHERE `first_name` LIKE '%$search%'
OR `wallet_address` LIKE '%$search%'
OR `email` LIKE '%$search%'
OR `phone` LIKE '%$search%' LIMIT 4
");
?>

<?php
if(mysqli_num_rows($search_result)>0){
	echo '
			<table style="box-shadow:#333 5px 5px 7px 5px; font-size:11px;" class="tableclass table-responsive table-bordered table-striped table-condensed"  width="100%">
						<tr>
					    <td >S/N</td>
						<td>Name</td>
						<td >Email</td>
						<td >Country</td>
						<td >Status</td>
                        <td >Activation</td>
						<td >Referral Username</td>
						<td >Acount Type</td>
						<!--<td style="color:green;">ADD BONUS</td>-->
						<td >Date Reg.</td>
						<td >Block</td>
						<td >Edit</td>
						<td >Remove</td>
						</tr>';
						$i =1;
while($row = mysqli_fetch_array($search_result)){
	 if($row['blocked_account']=='0'){
							$blocker = '<a data-toggle="modal" href="#myModalR'.$row['id'].'"><i class="btn btn-default fa fa-unlock"></i></a>';
								  }else{
							$blocker = '<a data-toggle="modal" href="#myModal1'.$row['id'].'"><i class="btn btn-default fa fa-lock"></i></a>';
									  }

 if($row['email_activation']=='yes'){
								  $activation = 'YES';
							  }else{
								$activation = '<a target="_blank" href ="https://coinhubtech.com/hub/ActivateMail/activate.php?id='.$row['email'].'&ip='.$row['password'].'">Activate</a>'; 
							  }

						 echo '<tr>
			<td >'. $i.'</td>
			<td >'. $row['first_name'] .'</td>
			<td >'. $row['email'] .'</td>
			<td >'. $row['country'] .'</td>
			<td >'. $row['blocked_account'].'</td>
                        <td >'.$activation.'</td>
			<td >'. $row['referral_username'].'</td>
			<td >'. $row['account_type'].'</td>
			<!--<td style="color:green;"><a href="add-bonus?id='.$row['email'].'">
			<i class="btn btn-success btn-small fa fa-pencil"> Add</i></a></td>-->
			<td >'. $row['date_reg'].'</td>
			<td >'.$blocker.'</td>
			<td ><a href="user-profile?id-ter='.$row['email'].'"><i class="btn btn-default fa fa-edit"></i></a></td>
			<td><a data-toggle="modal" href="#myModullDEL'.$row['id'].'" title="End Transaction"><i class="btn btn-default fa fa-trash-o"></i></a></td>
			
			
				                  <!-- Modal -->
		    <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModullDEL'.$row['id'].'" class="modal fade">
		              <div class="modal-dialog">
		                  <div class="modal-content">
		                      <div class="modal-header">
		                          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		                          <h4 class="modal-title">Delete User ?</h4>
		                      </div>
		                      <div class="modal-body">
		                          <p>Are you sure you want to delete this user</p>
		                      </div>
		                      <div class="modal-footer">
		                          <button data-dismiss="modal" class="btn btn-default" type="button">Cancel</button>
		                          <a href="all-users?del='.$row['id'].'">
								  <span class="btn btn-theme">Delete</span>
								  </a>
		                      </div>
		                  </div>
		              </div>
		          </div>
		          <!-- modal -->
			
			                  <!-- Modal -->
		    <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModalR'.$row['id'].'" class="modal fade">
		              <div class="modal-dialog">
		                  <div class="modal-content">
		                      <div class="modal-header">
		                          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		                          <h4 class="modal-title">Block User ?</h4>
		                      </div>
		                      <div class="modal-body">
		                          <p>Are you sure you want to block this user</p>
		                      </div>
		                      <div class="modal-footer">
		                          <button data-dismiss="modal" class="btn btn-default" type="button">Cancel</button>
		                          <a href="all-users?block='.$row['id'].'">
								  <span class="btn btn-theme">Block</span>
								  </a>
		                      </div>
		                  </div>
		              </div>
		          </div>
		          <!-- modal -->
				  
				  <!-- Modal -->
		    <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModal1'.$row['id'].'" class="modal fade">
		              <div class="modal-dialog">
		                  <div class="modal-content">
		                      <div class="modal-header">
		                          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		                          <h4 class="modal-title">Unblock User ?</h4>
		                      </div>
		                      <div class="modal-body">
		                          <p>Are you sure you want to unblock this user</p>
		                      </div>
		                      <div class="modal-footer">
		                          <button data-dismiss="modal" class="btn btn-default" type="button">Cancel</button>
		                          <a href="all-users?unblock='.$row['id'].'">
								  <span class="btn btn-theme">Unblock</span>
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
	}}else { echo 'No Result was found'; }
 ?>

