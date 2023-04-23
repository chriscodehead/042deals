<?php
require_once('../library.php');
require_once('../lib/basic-functions.php');
require_once('../emails_lib.php');

$bassic->checkLogedINSendOut('../dashboard/');
$msg='';$msg2='';
if(isset($_GET['inc'])&&!empty($_GET['inc'])){$msg2=$_GET['inc'].'';}
if(isset($_POST['sub'])){
    $emaillog = strtolower(mysqli_real_escape_string($link, $_POST['email']));
    $passlog = mysqli_real_escape_string($link, $_POST['pass']);
    $passlogh = $bassic->passwordHash($agorithm, $passlog);

    if(!empty($emaillog)&&!empty($passlog)){

        if($cal->checkifdataExists($emaillog, 'email',$user_tb)==1){
            $email_status = @$cal->selectFrmDB($user_tb,'email_activation','email',mysqli_real_escape_string($link,$emaillog));
            $hashed_pot = @$cal->selectFrmDB($user_tb,'hashed_pot','email',mysqli_real_escape_string($link,$emaillog));
            $user_code = @$cal->selectFrmDB($user_tb,'user_code','email',mysqli_real_escape_string($link,$emaillog));

            $msg = $cal->login($emaillog,$passlogh,'../dashboard/','email','password',$user_tb);
        }else{
            $msg ='Invalid Email/Password Conbinations!';
        }
    }else{
        $msg =  "Please fill all necessary fields!";
    }
}

if(isset($_POST['sendmailac'])){
    $_SESSION['error2'] ='';
    $emailfgt = $_POST['emailac'];
    if(!empty($emailfgt)){
        if(!empty($cal->checkifdataExists($emailfgt,'email',$user_tb,'Exist'))){
            $passwordh = $cal->selectFrmDB($user_tb,'password','email',$emailfgt);
            $cet = $email_call->ActivateMail($emailfgt,$passwordh);
            if(!empty($cet)){
                $msg = $cet;
            }
        }else{
            $msg  = 'Email not found in database. Ensure you typed it correctly!';
        }
    }
}
?>
<?php
$title = 'Login';
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
                    <h3 style="text-align: left; padding-top: 30px;">Sign Into Your Account</h3>
                    <?php if(!empty($msg) || !empty($msg2)){?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <?php if(!empty($msg)){ print @$msg.'<br />';};?><?php print @$msg2;?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    <?php }?>
                    <form enctype="multipart/form-data" method="POST" id="commonForm">
                        <div class="form-group position-relative clearfix">
                            <input name="email" id="email" type="email" class="form-control" placeholder="Email Address" aria-label="Email Address">
                            <div class="login-popover login-popover-abs" data-bs-toggle="popover" data-bs-trigger="hover" title="Clarification" data-bs-content="Ensure you are using the right email?">
                                <i class="fa fa-info-circle"></i>
                            </div>
                        </div>
                        <div class="form-group clearfix position-relative password-wrapper">
                            <input name="pass" id="pass" type="password" class="form-control" autocomplete="off" placeholder="Password" aria-label="Password">
                            <i class="fa fa-eye password-indicator"></i>
                        </div>
                        <div class="checkbox form-group clearfix">
                            <div class="form-check float-start">
                                <input class="form-check-input" type="checkbox" id="rememberme">
                                <label class="form-check-label" for="rememberme">
                                    Remember me
                                </label>
                            </div>
                            <a href="forgot-password" class="link-light float-end forgot-password">Forgot your password?</a>
                        </div>
                        <div class="form-group clearfix mb-0">
                            <button id="sub" name="sub" type="submit" class="btn btn-primary btn-lg btn-theme">Login</button>
                        </div>
                        <div class="extra-login clearfix">
                            <span>Or Create Account</span>
                        </div>
                    </form>
                    <div class="clearfix"></div>
                    <p>Don't have an account? <a href="register" class="thembo"> Register here</a> | <a href="../">Home</a></p>
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

<!-- Modal -->
<div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModalAC" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="" enctype="multipart/form-data" method="post">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Resend Email For Account Activation?</h4>
                </div>
                <div class="modal-body">
                    <p>Enter your email address below to receive email activation link.<br />(Check your email for email activation link.)</p>
                    <input type="text" value="<?php if(!empty($email)) print $email;?>" name="emailac" placeholder="Email" autocomplete="off" class="form-control placeholder-no-fix">

                </div>
                <div class="modal-footer">
                    <button data-dismiss="modal" class="btn btn-default" type="button">Cancel</button>
                    <button name="sendmailac" class="btn btn-theme" type="submit">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- modal -->

<?php require_once('footer.php');?>
<script>
    function postStuff(){
        var hr = new XMLHttpRequest();
        var email = document.getElementById('mail').value;
        var pass = document.getElementById('pass').value;

        if(email=="" || pass==""){
            sweetUnpre("Invalid Email/Password Conbination!");
        }else{
            var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
            if( !emailReg.test(email) ) {
                sweetUnpre('Please use a valid email address!');
            }else{
                $('#sub').click();
            }
        }
    }

    $(document).ready(function() {
        $('#remove').css("cursor","pointer");
        $('#sup').css("cursor","pointer");
        $('#poster').css("cursor","pointer");
        $('#remove').click(function(){
            $('#go').hide('slow');
        });
    });
</script>