<?php $actova1=''; $actova2=''; $actova3=''; $actova4='active'; $actova5=''; $actova6=''; $actova7=''; $actova8=''; $actova9=''; $actova10='';?>
<?php require_once('../../con-cot/conn_sqli.php'); ?>
<?php require_once('../../lib/basic-functions.php'); ?>
<?php require_once('../../library.php'); ?>
<?php require_once('../../select-library.php'); ?>
<?php require_once('../../emails_lib.php'); ?>
<?php $bassic->checkLogedINAdmin('login');?>

<?php

if (isset($_GET['page'])) {
    $page = $_GET['page'];
} else {
    $page = 1;
}

$no_of_records_per_page = 100;
$offset = ($page-1) * $no_of_records_per_page;


$total_pages_sql = "SELECT COUNT(*) FROM $deposit_tb";
$result = query_sql($total_pages_sql);
$total_rows = mysqli_fetch_array($result)[0];
$total_pages = ceil($total_rows / $no_of_records_per_page);

//confirm-paid
if(isset($_GET['start'],$_GET['end'])&&!empty($_GET['start'])&&!empty($_GET['end'])){
   $_SESSION['start'] = $_GET['start'];
   $_SESSION['end'] = $_GET['end'];
  }else{
	 $_SESSION['start'] = 0;
   $_SESSION['end'] = 100; 
  }
   if(isset($_GET['confirm-paid'])&&!empty($_GET['confirm-paid'])){
	   $getid = $_GET['confirm-paid'];

	   $trn_id = $cal->selectFrmDB($withdraw_tb,'transaction_id','id',$getid);
	   $email_id = $cal->selectFrmDB($withdraw_tb,'email','id',$getid);
	   $name_id = $cal->selectFrmDB($user_tb,'first_name','email',$email_id);
	   $coin = $cal->selectFrmDB($withdraw_tb,'coin_type','id',$getid);
	   $plan = $cal->selectFrmDB($withdraw_tb,'plan_type','id',$getid);
	   $amount = $cal->selectFrmDB($withdraw_tb,'amount','id',$getid);
	   $wallet = $cal->selectFrmDB($user_tb,'wallet_address','email',$email_id);
	   
	   if(!empty($getid)){
			$fields = array('status');
			$values = array('paid');
			$msg = $cal->update($withdraw_tb,$fields,$values,'id',$getid);	
$email_call->payOutNotification($amount,$plan,$coin,$trn_id,$name_id,$email_id,$wallet);
			header("location:pay-bitcoin?done=".$msg);
	   }else{$msg = $bassic->errorMssg(4);}
	 } 
  ?>
         <?php //remove-paid
   if(isset($_GET['remove-paid'])&&!empty($_GET['remove-paid'])){
	   $getid = $_GET['remove-paid'];
	   $status = $cal->selectFrmDB($withdraw_tb,'status','id',$getid);
	   /*if($status=='processing'){
		   $msg = 'Only paid wallet can be remove!';
		   }else if($status=='paid') {*/
	   if(!empty($getid)){
			$fields = array('remove');
			$values = array('yes');
			$msg = $cal->update($withdraw_tb,$fields,$values,'id',$getid);	
			header("location:pay-bitcoin?done=".$msg);
	   }else{$msg = $bassic->errorMssg(4);}
		   //}
	 } 
  ?>
  <?php if(isset($_GET['done'])&&!empty($_GET['done'])){$msg = $_GET['done'];}?>
<!DOCTYPE html>
<html lang="en">
<?php
$title = 'PayOut Bitcoin |';
 require_once('head.php')?>
  <style>
.chat-launcher{position:fixed;bottom:20px;right:20px;width:70px;height:70px;z-index:12;background:#C5BC34;color:#fff;-webkit-border-radius:50%;-moz-border-radius:50%;-ms-border-radius:50%;border-radius:50%;cursor:pointer;box-shadow:0 0 6px rgba(0,0,0,0.16),0 6px 12px rgba(0,0,0,0.32);text-align: center;}

.chat-launcherB{position:fixed;bottom:20px;right:130px;width:80px;height:70px;z-index:12;background:#D39728;color:#fff;-webkit-border-radius:50%;-moz-border-radius:50%;-ms-border-radius:50%;border-radius:50%;cursor:pointer;box-shadow:0 0 6px rgba(0,0,0,0.16),0 6px 12px rgba(0,0,0,0.32);text-align: center;}
</style>
  <body>
  <!-- container section start -->
  <section id="container" class="" style="margin-bottom:100px;">
  <?php require_once('header.php')?>
<?php require_once('sidebar.php')?>
      <!--main content start-->
      <section id="main-content">
          <section class="wrapper">            
              <!--overview start-->
			  <div class="row">
				<div class="col-lg-12">
					<h3 class="page-header"><i class="fa fa-laptop"></i> PayOut</h3>
					<ol class="breadcrumb">
						<li><i class="fa fa-home"></i><a href="../host-admin/">Home</a></li>
						<li><i class="fa fa-laptop"></i> PayOut Bitcoin</li>	<li><a  data-toggle="modal" href="#AlldelPACKSTDATA333">
								<button title="" id="sub" class="chat-launcherB" type="submit" name="sub">Pay</button>
							 </a></li>						  	
					</ol>
				</div>
			</div>
            
             <?php if(!empty($msg)){?>
 <div class="row">
         <div id="go" class=" col-lg-12">
        <div id="go" class="alert alert-warning" style="text-align: center; color:#FFF;"><?php print @$msg;?> <i id="remove" class="fa fa-remove pull-right"></i></div>
        </div>
 </div>
<?php }?>
              
                 <div class="row">
                         <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" >    
              <?php $select->payOutBTC($offset, $no_of_records_per_page);?>
                   </div>
                      </div>
              <div class="col-lg-12">
                    	<ul style="float: right;" class="pagination">
							<li><a href="?page=1">First</a></li>
							<li class="<?php if($page <= 1){ echo 'disabled'; } ?>">
								<a href="<?php if($page <= 1){ echo '#'; } else { echo "?page=".($page - 1); } ?>">Prev</a>
							</li>
							<li class="<?php if($page >= $total_pages){ echo 'disabled'; } ?>">
								<a href="<?php if($page >= $total_pages){ echo '#'; } else { echo "?page=".($page + 1); } ?>">Next</a>
							</li>
							<li><a href="?page=<?php echo $total_pages; ?>">Last</a></li>
						</ul>
                    </div>     
                      </div><!--/.row-->

		</section>
   
      <!--main content end-->
  </section>
  <!-- container section start -->
</section>
 


    <!-- javascripts -->
  <?php require_once('jsfiles.php')?>
    <!-- charts scripts -->
  </body>
</html>

<script type="text/javascript">
	$(document).ready(function(e) {
        $('#depo').click(function (){
			if($('#plan').val()=="" || $('#amount').val()==""){
				sweetError('Please fill all fields!');
				}else{
						document.getElementById('sudep').click();
					}
			});
    });
	
	
	
$(document).ready(function(e) {
        $('#clik').css("cursor","pointer");
	    $('#topp').hide();
 });	

function refreshThisPage(){
	window.location.reload();
	}
	
$(document).ready(function(){ 
	$('input#parent').click(function(){
		if(this.checked){
			$('input#child').attr('Checked','Checked');
		}else{
			$('input#child').removeAttr('Checked');
		}	
	});
	
$('input#pwarent').toggle(
        function () { 
            $('input#child').attr('Checked','Checked'); 
        },
        function () { 
            $('input#child').removeAttr('Checked'); 
        }
    );
});
	
function markPaid(){
		var selected = new Array();
		$('input[name="movePP"]:checked').each(function() {
		selected.push(this.value);
		});
		if(selected!="" & selected!=0){
                $.ajax({
                    url: "jason-php-code-processor2.php", // link of your "whatever" php
                    type: "POST",
                    async: true,
                    cache: false,
                    data: {markPaid:selected}, // all data will be passed here
                    success: function(data){ 
                        sweetUnpre(data); // The data that is echoed from the ajax.php
						setTimeout(refreshThisPage,6000);
                    }
                });
				sweetUnpre("Processing...");
		}else{sweetUnpre('Oops!, select a wallet to pay!');}
		}
	</script>