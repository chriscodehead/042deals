<?php require_once('../library.php');
require_once('../lib/basic-functions.php');
require_once('../emails_lib.php');
require_once('../country.php');
$plan='';$msg = ''; $trader='';
if(isset($_GET['ref'])&&!empty($_GET['ref'])){$referral_username=$_GET['ref'];}
if(isset($_POST['sub'])){
    $username = mysqli_real_escape_string($link,$_POST['username']);
    $sex = 'none';
    $fname = ucfirst(mysqli_real_escape_string($link, strtolower($_POST['fname'])));
    $lname = ucfirst(strtolower(mysqli_real_escape_string($link, $_POST['lname'])));
    $email = strtolower(mysqli_real_escape_string($link, $_POST['email']));
    $phone  = '';//mysqli_real_escape_string($link, $_POST['phone']);
    $address = 'none';
    $walletaddress = '';//mysqli_real_escape_string($link, $_POST['bitcoin']);
    $ethereumaddress = '';//mysqli_real_escape_string($link, $_POST['ethereum']);
    $affiliateusername = mysqli_real_escape_string($link, $_POST['referral']);
    $country = '';//mysqli_real_escape_string($link, $_POST['country']);
    $pass = mysqli_real_escape_string($link, $_POST['pass']);
    $pass2 = mysqli_real_escape_string($link, $_POST['cpass']);
    $rawpass = $pass;
    $account_type = 'user';
    $email_activation='yes';
    $blocked_account='0';
    $passport='avatar.png';
    $two_factor = 'No';
    $two_factor_code = $bassic->picker();
    $fgt_password_code = uniqid();
    $passh = $bassic->passwordHash($agorithm, $pass);
    $hashed_pot = $bassic->passwordHash($agorithm, $email);
    $payment_activation_status = 'no';
    $main_account_balance = 0;


    if(!empty($email)&&!empty($fname)&&!empty($lname)&&!empty($pass)){
        if($pass==$pass2) {
            if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                if ($cal->checkifdataExists($email, 'email', $user_tb) == 1) {
                    $msg = "Error! Email address used, already exist";
                } else if ($cal->checkifdataExists($email, 'email', $user_tb) == 0) {
                    if ($cal->checkifdataExists($username, 'client_username', $user_tb) == 1) {
                        $msg = "Error! Username used, already exist";
                    } else if ($cal->checkifdataExists($username, 'client_username', $user_tb) == 0) {
                        if (!empty($affiliateusername)) {
                            if ($cal->checkifdataExists($affiliateusername, 'client_username', $user_tb) == 1) {
                                $feilds = array('id', 'user_code', 'first_name', 'last_name', 'sex', 'country', 'email', 'phone', 'preferred_trader', 'wallet_address', 'password', 'date_reg', 'last_activity', 'email_activation', 'blocked_account', 'forget_password_code', 'passport', 'referral_username', 'client_username', 'address', 'ethereum_wallet_address', 'account_type', 'hashed_pot', 'two_factor', 'two_factor_code', 'rawpass', 'payment_activation_status', 'main_account_balance');
                                $value = array(null, $bassic->randGenerator(), $fname, $lname, $sex, $country, $email, $phone, $trader, $walletaddress, $passh, $bassic->getDate(), $bassic->getUrl(), $email_activation, $blocked_account, $fgt_password_code, $passport, $affiliateusername, $username, $address, $ethereumaddress, $account_type, $hashed_pot, $two_factor, $two_factor_code, $rawpass, $payment_activation_status, $main_account_balance);
                                $result = $cal->insertDataB($user_tb, $feilds, $value);
                                $msg = $result;
                                if ($result == 'Registration was successful. Proceed to login!') {
                                    $email_call->ActivateMail($email, $passh);
                                    $email_call->referalNew($nameM, $emailM, $nameR, $emailR, $usernameM, $usernameR);
                                    header("location:login?inc=" . $msg);
                                }
                            } else if ($cal->checkifdataExists($affiliateusername, 'client_username', $user_tb) == 0) {
                                $msg = 'Invalid referral record!';
                            }///referral
                        } else {
                            $msg = 'Enter referral details to continue!';
                            ///referral email empty
                            /*$feilds = array('id','user_code','first_name','last_name','sex','country','email','phone','preferred_trader','wallet_address','password','date_reg','last_activity','email_activation','blocked_account','forget_password_code','passport','referral_username','client_username','address','ethereum_wallet_address','account_type','hashed_pot','two_factor','two_factor_code');
                            $value = array(null,$bassic->randGenerator(),$fname,$lname,$sex,$country,$email,$phone,$trader,$walletaddress,$passh,$bassic->getDate(),$bassic->getUrl(),$email_activation,$blocked_account,$fgt_password_code,$passport,$affiliateusername,$username,$address,$ethereumaddress,$account_type,$hashed_pot,$two_factor,$two_factor_code);
                            $result = $cal->insertDataB($user_tb, $feilds, $value);
                            $msg =  $result;
                            if($result == 'Registration was successful. Proceed to login!'){
                                $email_call->ActivateMail($email, $passh);
                                header("location:login?inc=".$msg);
                            }*/
                        }
                    }////Username exist
                }////email exist
            } else {
                $msg = 'Please use a valid email address!'; //email ends here
            }
        }else{
            $msg =  "Password does not match!";
        }
    }else{
        $msg =  "Please fill all necessary fields!";
    }
}
?>
<?php
$title = 'Register';
require_once('head.php');?>
<body id="top">
<div class="page_loader"></div>

<div class="login-16">
    <div class="container">
        <div class="row login-box">
            <div class="col-lg-6 form-section">
                <div class="form-inner">
                    <a href="../" class="">
                        <img src="../img/logo.png" alt="logo">
                    </a>
                    <h3 style="text-align: left; padding-top: 30px;">Create an account</h3>
                    <?php if(!empty($msg)){?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <?php print @$msg;?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    <?php }?>
                    <form method="POST" enctype="multipart/form-data" id="commonForm">
                        <div class="form-group position-relative clearfix">
                            <input value="<?php if(!empty($referral_username)) print $referral_username;?>" name="referral" id="referral" type="text" class="form-control" placeholder="Referral Code" aria-label="Referral Code">
                            <small class="pull-right"><a onclick="adddefault();" href="javascript:();">Don't have a sponsor</a></small>
                            <div class="login-popover login-popover-abs" data-bs-toggle="popover" data-bs-trigger="hover" title="Clarification" data-bs-content="Enter your referral's code?">
                                <i class="fa fa-info-circle"></i>
                            </div>
                        </div>
                        <div class="form-group position-relative clearfix">
                            <input value="<?php if(!empty($username)) print $username;?>" name="username" id="username" type="text" class="form-control" placeholder="Username" aria-label="Username">
                        </div>
                        <div class="form-group position-relative clearfix">
                            <div class="row">
                                <div style="width: 50%;" class="col-lg-6"><input value="<?php if(!empty($fname)) print $fname;?>" name="fname" id="fname" type="text" class="form-control" placeholder="First Name" aria-label="First Name"></div>

                                <div style="width: 50%;" class="col-lg-6"><input value="<?php if(!empty($lname)) print $lname;?>" name="lname" id="lname" type="text" class="form-control" placeholder="Last Name" aria-label="Last Name"></div>
                            </div>
                        </div>
                        <div class="form-group position-relative clearfix">
                            <input value="<?php if(!empty($email)) print $email;?>" name="email" id="email" type="email" class="form-control" placeholder="Email Address" aria-label="Email Address">
                            <div class="login-popover login-popover-abs" data-bs-toggle="popover" data-bs-trigger="hover" title="Clarification" data-bs-content="Ensure you are using an active email?">
                                <i class="fa fa-info-circle"></i>
                            </div>
                        </div>
                        <div class="form-group clearfix position-relative password-wrapper">
                            <div class="row">
                                <div style="width: 50%;" class="col-lg-6"><input name="pass" id="pass" type="password" class="form-control" autocomplete="off" placeholder="Password" aria-label="Password"></div>

                                <div style="width: 50%;" class="col-lg-6"><input name="cpass" id="cpass" type="password" class="form-control" autocomplete="off" placeholder="Confirm Password" aria-label="Confirm Password"></div>
                            </div>

                            <i class="fa fa-eye password-indicator"></i>
                        </div>
                        <div class="form-group checkbox clearfix">
                            <div class="clearfix float-start">
                                <div class="form-check">
                                    <input required class="form-check-input" type="checkbox" id="rememberme">
                                    <label class="form-check-label" for="rememberme">
                                        I agree to the terms of service
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group clearfix mb-0">
                            <button name="sub" id="suba" type="submit" class="btn btn-primary btn-lg btn-theme">Register</button>
                        </div>
                        <div class="extra-login clearfix">
                            <span>Or Login With</span>
                        </div>
                    </form>
                    <div class="clearfix"></div>
                    <p>Already a member? <a href="login">Login here</a> | <a href="../">Home</a></p>
                </div>
            </div>
            <div class="col-lg-6 bg-img">
                <div class="photo">
                    <img src="assets/img/img-16.png" alt="logo" class="w-100 img-fluid">
                </div>
            </div>
        </div>
    </div>
    <div class="ocean">
        <div class="wave"></div>
        <div class="wave"></div>
    </div>
</div>
<?php require_once('footer.php');?>
<script>
    function adddefault(){
        $('#referral').val('signalearners');
    }
</script>
