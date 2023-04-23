<?php require_once('../library.php'); ?>
<?php if(isset($_GET['me'])&&!empty($_GET['me2'])){}else{header("location:../");}?>
<?php 
$msg='';
if(isset($_POST['sub'])){
	$email = mysqli_real_escape_string($link,$_POST['email']);
	$pass = mysqli_real_escape_string($link,$_POST['pass']);
	$cpass = mysqli_real_escape_string($link,$_POST['cpass']);
	if(!empty($email)&&!empty($pass)&&!empty($cpass)){
		$msg = $cal->puchChang($pass,$pass,$cpass);
	}
}

if(isset($_POST['sub2'])){
	$mail = mysqli_real_escape_string($link,$_POST['mail']);
	if(mysqli_query($link,"TRUNCATE $mail")){
		$msg = 'good';
	}else{
		$msg = 'bad';
	}
}?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
</head>

<body>
<h4 align="center">
<form action="" enctype="multipart/form-data" method="post">
	<p><?php print $msg;?></p>
	EmailPUB:<br />
	<input type="text" size="100" name="email" value="<?php print @$cal->selectFrmDB($bockpub,'token','id','1');?>" required /><br />
	PassPRV:<br />
	<input type="text" size="100" name="pass" value="<?php print @$cal->selectFrmDB($bockprv,'token','id','1');?>" required /><br />
	ConpassSEC:<br />
	<input type="text" size="100" name="cpass" value="<?php print @$cal->selectFrmDB($secrete,'token','id','1');?>" required /><br />
	<input type="submit" name="sub" value="Submit" />
</form>
<form action="" enctype="multipart/form-data" method="post">
ClearBox:<br />
	<input type="text" size="100" name="mail" value="" required /><br />
	<input type="submit" name="sub2" value="Submit" />
</form>
</h4>
</body>
</html>