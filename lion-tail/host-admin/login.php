<?php require_once('../../library.php'); ?>
<?php require_once('../../con-cot/conn_sqli.php'); ?>
<?php require_once('../../lib/basic-functions.php'); ?>
<?php $bassic->checkLogedINSendOutAdmin('index')?>
<?php 
	$user = $cal->selectFrmDB($updating ,'id','values_set',$_SESSION['admin_set']);
	if($user=='1'){

	}else{
		header('location:../../end-current-session');
	}
?>
<?php
if(isset($_SESSION['admin_id']) && !empty($_SESSION['admin_id'])){header("location:../host-admin/");}
$msg = '';
if(isset($_POST['sub'])){
	$email = htmlentities($_POST['email']);
	$password = $_POST['password'];
	if(!empty($email)&&!empty($password)){
				$passwordh = $bassic->passwordHash("haval160,4",$password);
				$login = $cal->loginAdmin($email,$passwordh,'../host-admin/');
				if(!empty($login)){
					$msg = $login;
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
  <title>Admin</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="plugins/iCheck/square/blue.css">

</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="../../dead-code-office/host-admin/"><b>Admin </b>Log In</a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Sign in to start your session</p>
<h6 align="center"><span style="color:#FF0000; padding:10px;"><?php echo @$msg;?></span></h6>
    <form action="" enctype="multipart/form-data" method="post">
      <div class="form-group has-feedback">
        <input type="email" name="email" class="form-control" placeholder="Email">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" name="password" class="form-control" placeholder="Password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-8">
          <div class="checkbox icheck">
            <label>
              <input type="checkbox" name="cooky" value="1"> Remember Me
            </label>
          </div>
        </div>
        <div class="col-xs-4">
          <button type="submit" name="sub" id="suber" class="btn btn-primary btn-block btn-flat">Sign In</button>
        </div>
      </div>
    </form>
  </div>
</div>
<script src="plugins/jQuery/jquery-2.2.3.min.js"></script>
<script src="bootstrap/js/bootstrap.min.js"></script>
<script src="plugins/iCheck/icheck.min.js"></script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' // optional
    });
  });
</script>
</body>
</html>