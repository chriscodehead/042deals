<?php $actova1=''; $actova2=''; $actova3=''; $actova4=''; $actova5=''; $actova6='active'; $actova7=''; $actova8=''; $actova9=''; $actova10='';?>
<?php require_once('../../con-cot/conn_sqli.php'); ?>
<?php require_once('../../lib/basic-functions.php'); ?>
<?php require_once('../../library.php'); ?>
<?php require_once('../../select-library.php'); ?>
<?php $bassic->checkLogedINAdmin('login');?>
<!DOCTYPE html>
<html lang="en">
<?php
$title = 'Deposit History |';
 require_once('head.php')?>
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
					<h3 class="page-header"><i class="fa fa-laptop"></i> Deposit</h3>
					<ol class="breadcrumb">
						<li><i class="fa fa-home"></i><a href="../host-admin/">Home</a></li>
						<li><i class="fa fa-laptop"></i> Deposit History</li>						  	
					</ol>
				</div>
			</div>

              
         <div class="row">
          	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" >
					<?php $select->DepositHistory();?>     
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
	</script>