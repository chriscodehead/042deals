<?php require_once('library.php'); ?>
<?php require_once('lib/basic-functions.php'); ?>
<?php require_once('emails_lib.php'); ?>
<?php
if(isset($_POST['emailfgt'])){
	$emailfgt = $_POST['emailfgt'];
	if(!empty($emailfgt)){
		$check = $cal->checkifdataExists($emailfgt, 'email',$user_tb);
		if($check==1){
		print $email_call->forgetpassword($emailfgt,$user_tb,'email');
		}else{
			print '!Oop email address dose not exist in the systems record!';
			}
	}else{print 'Enter a valid email!';}
}
if(isset($_POST['cotactmail'])){
	$name = $_POST['name'];
	$email = $_POST['cotactmail'];
	$subject = ucfirst(strtolower($name)).' contacted you!';
	$message = $_POST['message'];	
	if(!empty($_POST['cotactmail'])&&!empty($_POST['message'])){
		print $email_call->contactUsMail($name,$email,$subject,$message);
	}else{
		print  'Please fill all fields';
		}
}
?>