<?php require_once('../library.php'); ?>
<?php require_once('../con-cot/conn_sqli.php'); ?>
<?php require_once('../lib/basic-functions.php'); ?>
<?php
$msg = '';
if(isset($_POST['sub'])){
	$password = mysqli_real_escape_string($connection,$_POST['password']);
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
  <title>Admin 	BTCWALLETFUNDS</title>

  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

  <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">

  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="plugins/iCheck/square/blue.css">

</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="../dead-code-office/host-admin/"><b>Admin </b>Log In: Step 1</a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Enter Your Access Code</p>
<h6 align="center"><span style="color:#FF0000; padding:10px;"><?php echo @$msg;?></span></h6>
    <form action="" enctype="multipart/form-data" method="post">
      <div class="form-group has-feedback">
        <input type="password" name="password" class="form-control" placeholder="Password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
      
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" name="sub" id="suber" class="btn btn-primary btn-block btn-flat">Sign In</button>
          <!--<span  id="sub" class="btn btn-primary btn-block btn-flat">Sign In</span>-->
        </div>
        <!-- /.col -->
      </div>
    </form>


    <!-- /.social-auth-links -->

 <!--   <a href="#">I forgot my password</a><br>
    <a href="../register" class="text-center">Register a new membership</a>-->

  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<!-- jQuery 2.2.3 -->
<script src="plugins/jQuery/jquery-2.2.3.min.js"></script>

<script src="bootstrap/js/bootstrap.min.js"></script>
<!-- iCheck -->
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
