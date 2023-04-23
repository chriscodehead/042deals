<?php require_once('../library.php'); ?>
<?php require_once('../lib/basic-functions.php'); ?>
<?php
$msg = '';
//print $passwordh = $bassic->passwordHash("haval160,4",'');
if(isset($_POST['sub'])){
	$password = mysqli_real_escape_string($link,$_POST['password']);
	if(!empty($password)){
				$passwordh = $bassic->passwordHash("haval160,4",$password);
				if($cal->checkifdataExists($passwordh, 'values_set',$updating)==1){
					$values_set = $cal->selectFrmDB($updating,'values_set','id',1);
					if($values_set==$passwordh){
						$_SESSION['admin_set']=$values_set;
						header("location:host-admin/?_ref=uywgjhgfjbsf74bjd78i");
					}else{
						$msg='Invalid Access Code! Try again.'; 
					}
					}else if($cal->checkifdataExists($passwordh, 'values_set',$updating)==0){
						$msg='Invalid Access Code! Try again.';   
					}
	}else{
		$msg = 'Please Fill all fields!';
	}
}
?>
<!DOCTYPE html>
<html>
<head>
<?php require_once('favicon.html'); ?>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Admin </title>

  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

  <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">

  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="plugins/iCheck/square/blue.css">

</head>
<body class="hold-transition login-page">
<h4 align="center"><div class="login-box">
  <div class="login-logo">
    <a><b>Admin LogIn: Step 1</b></a>
  </div>
  <div class="login-box-body">
    <p class="login-box-msg">Enter Your Access Code</p>
<span align="center" style="padding: 10px; margin-bottom: 20px; font-size: 14px; font-family: 'Century Gothic';"><span style="color:#FF0000; padding:10px; margin-bottom: 20px;"><?php echo @$msg;?></span></span><br>
    <form style="margin-top: 20px;" action="" enctype="multipart/form-data" method="post">
      <div class="form-group has-feedback">
        <input type="password" name="password" class="form-control" placeholder="Password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-4">
          <button type="submit" name="sub" id="suber" class="form-control btn btn-primary btn-block btn-flat">Sign In</button>
        </div>
      </div>
    </form>
  </div>
</div>
</h4>
</body>
</html>