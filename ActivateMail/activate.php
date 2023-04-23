<?php require_once('../lib/basic-functions.php'); ?>
<?php require_once('../library.php'); ?>
<?php require_once('../emails_lib.php'); ?>
<?php
$msg2 ='';$msg3 ='';
$_SESSION['sa'] ='';
$_SESSION['ss'] ='';
if(isset($_POST['sub'])){
	$passwordh = $bassic->passwordHash("haval160,4",$_POST['password']);
	if(!empty($cal->ActivateMail($_POST['email'],$passwordh))){
		$_SESSION['ss'] = $cal->ActivateMail($_POST['email'],$passwordh);
		$_SESSION['sa'] = '';
		header("location:activate.php");
		}
	}
if(isset($_GET['id'])&&isset($_GET['ip'])){
	$_SESSION['ss'] = '';
	$getid = $_GET['id'];
	$getip = $_GET['ip'];
	if(!empty($getid)&&!empty($getip)){
				 $checkemail = $cal->checkifdataExists($getid, 'email', $user_tb);
				 $checkpassword = $cal->checkifdataExists($getip, 'password', $user_tb);
				 if($checkemail==1 && $checkpassword==1){
					$set = 'yes';
		   		  $fieldup = array("email_activation");
				  $valueup = array($set);
				  $update = $cal->update($user_tb,$fieldup,$valueup,'email',$getid);
				  	  if(!empty($update)){
							 $_SESSION['sa'] = 'Email was successfully activated. <a href="../accounts/login"> Log In</a> and start enjoying our numerous services.';
				 }else{
					 $_SESSION['sa'] = 'Unexpected error. Email not activated. please contact our customer care to rectify the issue<br />
					 Resend Mail
											 <form action="" method="post" enctype="multipart/form-data">
											<input name="email" placeholder="Login email" type="text">
											<input name="password" placeholder="Login Password" type="text">
											<input name="sub" type="submit">
											</form>
										 ';
					 }
				 }else{
					 $_SESSION['sa'] = 'Email/password specified on this link dose not exist in our database!<br />
					  Resend Mail
											 <form action="" method="post" enctype="multipart/form-data">
											<input name="email" placeholder="Login email" type="text">
											<input name="password" placeholder="Login Password" type="text">
											<input name="sub" type="submit">
											</form>
					 ';
					 }
		}else{
			$_SESSION['sa'] = 'Unexpected error. Email not activated. please contact our customer care to rectify the issue<br />
			 Resend Mail
											 <form action="" method="post" enctype="multipart/form-data">
											<input name="email" placeholder="Login email" type="text">
											<input name="password" placeholder="Login Password" type="text">
											<input name="sub" type="submit">
											</form>
			';
			}
	}else{
		$_SESSION['sa'] = 'Unexpected error. Please ensure you are coming from the right path!<br />
		 Resend Mail
											 <form action="" method="post" enctype="multipart/form-data">
											<input name="email" placeholder="Login email" type="text">
											<input name="password" placeholder="Login Password" type="text">
											<input name="sub" type="submit">
											</form>
		';
		}
 ?>

<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<title>Activate</title>
</head>

<body>
<h2 style="margin:40px; background-color:#8B6364; padding:40px; box-shadow:0px 0px 1px 1px #666666;" align="center">
<?php echo $_SESSION['sa']; echo $_SESSION['ss'];?></h2>
</body>
</html>