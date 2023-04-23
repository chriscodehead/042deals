<?php
require_once('../library.php');
require_once('../lib/basic-functions.php');
require_once('../emails_lib.php');
$bassic->checkLogedINSendOut('../dashboard/');
$msg='';
?>
<?php
$title = 'Forgot Password';
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
                    <h3 style="text-align: left; padding-top: 30px;">Recover Your Password</h3>
                    <?php if(!empty($msg)){?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <?php print @$msg;?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    <?php }?>
                    <form action="#" method="POST" id="commonForm">
                        <div class="form-group position-relative clearfix">
                            <input name="emailfgt" id="emailfgt" type="email" class="form-control" placeholder="Email Address" aria-label="Email Address">
                            <div class="login-popover login-popover-abs" data-bs-toggle="popover" data-bs-trigger="hover" title="Clarification" data-bs-content="Ensure you are using the right email?">
                                <i class="fa fa-info-circle"></i>
                            </div>
                        </div>
                        <div class="form-group clearfix mb-0">
                            <button id="sup" onClick="passFoget();" type="button" class="btn btn-primary btn-lg btn-theme">Send Me Email</button>
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
    function passFoget(){
        var hr = new XMLHttpRequest();
        var url = "reg_process.php";
        var  email = document.getElementById('emailfgt').value;
        var vars = "emailfgt="+email;
        if(email==""){
            sweetUnpre("Please enter an email address!");
        }else{
            var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
            if( !emailReg.test(email) ) {
                sweetUnpre('Please use a valid email address!');
            }else{
                $('i#sp5').attr("class","fa fa-spinner fa-spin");
                hr.open("POST", url, true);
                hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                // Access the onreadystatechange event for the XMLHttpRequest object
                hr.onreadystatechange = function() {
                    //  console.log(hr);
                    if(hr.readyState == 4 && hr.status == 200) {
                        var return_data = hr.responseText;
                        sweetUnpre(return_data);
                        //if(return_data=='Mail sent successfully. Check your Mail for Activation Link'){
                        $('i#sp5').attr("class","fa fa-send-o");

                        //setTimeout(refreshPage,2000);
                    }
                }
                hr.send(vars); // Actually execute the request

            }//email
        }//else empty
//sweetUnpre('processing...');
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