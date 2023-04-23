<?php require_once('../lib/basic-functions.php'); ?>
<?php require_once('../library.php'); ?>
<?php 
$msg = '';
if(isset($_GET['id'])){$get_email = $_GET['id'];}else{header("location:../accounts/login");
													 }
if(isset($_GET['ip'])){$get_password = $_GET['ip'];}else{header("location:../accounts/login");
														}
if(isset($_GET['it'])){$get_code = $_GET['it'];}else{header("location:../accounts/login");
													}
if(isset($_POST['sub'])){
	$password = $_POST['password'];
	$cpassword = $_POST['cpassword'];
	if(!empty($password)&&!empty($cpassword)){
		$passmatch =  $bassic->isMatched($password,$cpassword);
		$passwordlenght = $bassic->passwordlenght($password);
		if(empty($passwordlenght)){
			if($passmatch==1){
				$newpassword = $bassic->passwordHash('haval160,4',$password);
					$msg = $cal->resetpassword($get_email,$get_code,$newpassword,$user_tb,'email','password','forget_password_code',$password);
				}else if($passmatch==0){
					$msg = 'Password dose not match';
					}
		}else{
			$msg = $passwordlenght;
			}
	}else{
				$msg = 'Fill all fields correctly!';
		}
}
 ?>
<html lang="en">
<head>
 <link rel="icon" href="../img/eventicon.ico" type="image/x-icon" />
<link rel="shortcut icon" href="../img/eventicon.ico" type="image/x-icon" />
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="">
<meta name="author" content="Dashboard">
<meta name="keyword" content="Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">
<title>RECOVER PASSWORD</title>
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/style.css" rel="stylesheet">
</head>

  <body>

	<h6 align="center">  <div id="login-page">
	  	<div class="container">
	  	<div class="col-lg-3"></div>
        <div class="col-lg-6">
		      <form enctype="multipart/form-data" method="post" class="form-login" action="">
		        <h2 align="center" class="form-login-heading">Password Recovery</h2>
                <div style="width:100%; float:left; padding-bottom:5px; padding-top:5px; text-align:center; color:#F00; font-size:14px;">
                        <?php if(!empty($msg)){echo $msg;}?>
                </div>
		        <div class="login-wrap">
                <input type="email" name="email" readonly  class="form-control" value="<?php if(!empty($get_email)){echo $get_email;}?>" placeholder="Admin Email" autofocus>
		            <br>
		            <input type="password" name="password" autocomplete="off"  class="form-control" placeholder="New Password" autofocus><br />
		            <br>
		            <input type="password" name="cpassword" autocomplete="off" class="form-control" placeholder="Confirm Password"><br />
		            <label class="checkbox">
		                <span class="pull-right">
		                    <a data-toggle="modal" href="../accounts/login"> Log In</a>
		                </span>
		            </label><br />
		            <button name="sub" class="btn btn-theme btn-primary btn-block" type="submit"><i class="fa fa-lock"></i> Reset Password</button>
		            <hr>
		            <div class="login-social-link centered">
                             <a href="../">Home</a>
		            </div>
				</div>   
		      </form>	  	
	  	</div>
	  	</div>
	  </div></h6>
    <script src="../js/jquery.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script>
        $.backstretch("img/login-bg.jpg", {speed: 500});
    </script>
</body>
</html>