<?php require_once('../../con-cot/conn_sqli.php'); ?>
<?php require_once('../../lib/basic-functions.php'); ?>
<?php require_once('../../library.php'); ?>
<?php require_once('../../select-library.php'); ?>
<?php require_once('../../emails_lib.php'); ?>
<?php

if(isset($_POST["xpDELSELSTD"])){
$msg='';
	$obj = $_POST["xpDELSELSTD"];
	$data = $obj;
			for($i=0;$i<count($data);$i++)
			 {
				  if($data[$i]!="")
				  {
					  
	$mai_id = $cal->selectFrmDB($deposit_tb,'transaction_id','id',$data[$i]);
	$ref_id = $cal->selectFrmDB($referral_tb,'id','transaction_id',$mai_id);
					if(mysqli_query($link,"UPDATE $deposit_tb SET `deposit_status`='confirmed' WHERE `id`='".$data[$i]."'")){
					mysqli_query($link,"UPDATE $referral_tb SET `status`='confirmed' WHERE `id`='".$ref_id."'");
						$msg = "Update was successful!";
					}else{}
				  }else{$msg2 = 'Some data failed!';}
				
			 }
				if(!empty($msg)){print "Update was successful!"; }
				 if(!empty($msg2)){print "Update failed!";}
}


if(isset($_POST["markPaid"])){
$msg='';
	$obj = $_POST["markPaid"];
	$data = $obj;
			for($i=0;$i<count($data);$i++)
			 {
				  if($data[$i]!="")
				  {
					  
	   $getid = $data[$i];
	   $trn_id = $cal->selectFrmDB($withdraw_tb,'transaction_id','id',$getid);
	   $email_id = $cal->selectFrmDB($withdraw_tb,'email','id',$getid);
	   $name_id = $cal->selectFrmDB($user_tb,'first_name','email',$email_id);
	   $coin = $cal->selectFrmDB($withdraw_tb,'coin_type','id',$getid);
	   $plan = $cal->selectFrmDB($withdraw_tb,'plan_type','id',$getid);
	   $amount = $cal->selectFrmDB($withdraw_tb,'amount','id',$getid);
	   $wallet = $cal->selectFrmDB($user_tb,'wallet_address','email',$email_id);
			if(!empty($getid)){
			$fields = array('status');
			$values = array('paid');
			$msg = $cal->update($withdraw_tb,$fields,$values,'id',$getid);	
$email_call->payOutNotification($amount,$plan,$coin,$trn_id,$name_id,$email_id,$wallet);
	
	   }else{$msg = $bassic->errorMssg(4);}  
					
				  }else{$msg2 = 'Some data failed!';}
				
			 }
				if(!empty($msg)){print "Update was successful!"; }
				 if(!empty($msg2)){print "Update failed!";}
}






?>