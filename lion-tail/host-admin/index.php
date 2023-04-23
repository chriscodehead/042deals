<?php require_once('../../library.php'); ?>
<?php require_once('../../con-cot/conn_sqli.php'); ?>
<?php require_once('../../lib/sqli-functions2.php'); ?>
<?php require_once('../../lib/basic-functions.php'); ?>
 <?php $bassic->checkLogedINAdmin('login');?>
<!DOCTYPE html>
<html lang="en">
<?php
$title = 'Dashboard';
 require_once('head.php')?>
  <body>
  <!-- container section start -->
  <section id="container" class="" style="margin-bottom:100px;">
 
  <?php require_once('header.php')?>
  <?php $actova1='active'; $actova2=''; $actova3=''; $actova4=''; $actova5=''; $actova6=''; $actova7=''; $actova8=''; $actova9=''; $actova10='';?>
<?php require_once('sidebar.php')?>
      
      <!--main content start-->
      <section id="main-content">
          <section class="wrapper">            
              <!--overview start-->
			  <div class="row">
				<div class="col-lg-12">
					<h3 class="page-header"><i class="fa fa-laptop"></i> Dashboard</h3>
					<ol class="breadcrumb">
						<li><i class="fa fa-home"></i><a href="../host-admin/">Home</a></li>
						<li><i class="fa fa-laptop"></i>Dashboard</li>						  	
					</ol>
				</div>
			</div>
              
            <div class="row">
            <a href="all-users">
				<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
					<div class="info-box blue-bg">
						<i class="fa fa-picture-o"></i>
						<div class="count" style="font-size:22px;"><?php print $sqli->countmembers();?></div>
						<div class="title">Members</div>						
					</div> <!--/.info-box-->		
				</div><!--/.col-->
				</a>
           <a href="wallet?start=0&end=100">
				<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12"  >
					<div class="info-box brown-bg" style="background-color:#00CC00;">
						<i class="fa fa-shopping-cart"></i>
						<div class="count" style="font-size:22px;"><?php print $sqli->countDeposit();?></div>
						<div class="title">Deposits</div>						
					</div><!--/.info-box-->			
				</div><!--/.col-->	
                </a>

				
             <a href="deposit-history">
				<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
					<div class="info-box dark-bg">
						<i class="fa fa-bitbucket"></i>
						<div class="count" style="font-size:22px;"><?php print '$'.$sqli->countAllWallet();?></div>
						<div class="title">All Deposit </div>						
					</div><!--/.info-box-->			
				</div><!--/.col-->
                </a>
                
                
                <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
					<div class="info-box red-bg">
						<i class="fa fa-thumbs-o-up"></i>
						<div class="count" style="font-size:22px;"><?php print '$'.$sqli->countActiveWallet();?></div>
						<div class="title">Confirmed Deposit </div>						
					</div><!--/.info-box-->			
				</div><!--/.col-->

				
              <a href="pay-bitcoin?start=0&end=100">
				<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
					<div class="info-box dark-bg">
						<i class="fa fa-pause"></i>
						<div class="count" style="font-size:22px;"><?php print $sqli->countWithdra();?></div>
						<div class="title">CashOut Request</div>						
					</div><!--/.info-box-->			
				</div><!--/.col-->
                </a>
                
                <a href="pay-bitcoin?start=0&end=100">
                <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
					<div class="info-box red-bg">
						<i class="fa fa-bitcoin"></i>
						<div class="count" style="font-size:22px;"><?php print '$'.$sqli->countCashOutpaid();?></div>
						<div class="title">Paid Request</div>						
					</div><!--/.info-box-->			
				</div><!--/.col-->
                </a>
                
                <a href="pay-bitcoin?start=0&end=100">
                	<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
					<div class="info-box blue-bg">
						<i class="fa fa-bitcoin"></i>
						<div class="count" style="font-size:22px;"><?php print '$'.$sqli->countCashOutWallet();?></div>
						<div class="title">Total Request</div>						
					</div><!--/.info-box-->			
				</div><!--/.col-->
                </a>
                
                <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
					<div class="info-box brown-bg" style="background-color:#00CC00;">
						<i class="fa fa-bitcoin"></i>
						<div class="count" style="font-size:22px;"><?php print '$'.$sqli->countAllInterest();?></div>
						<div class="title">All Interest</div>						
					</div><!--/.info-box-->			
				</div><!--/.col-->
                
                <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
					<div class="info-box yellow-bg" style="background-color:#00CC00;">
						<i class="fa fa-bitcoin"></i>
						<div class="count" style="font-size:22px;"><?php print '$'.$sqli->countConfirmedInterest();?></div>
						<div class="title">Confirmed Interest</div>						
					</div><!--/.info-box-->			
				</div><!--/.col-->
                
                
                <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
					<div class="info-box blue-bg">
						<i class="fa fa-bitcoin"></i>
						<div class="count" style="font-size:22px;"><?php print '$'.$sqli->countInterestPlsDeposit();?></div>
						<div class="title">All Interest Plus Deposit</div>						
					</div><!--/.info-box-->			
				</div><!--/.col-->
                
                <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
					<div class="info-box dark-bg">
						<i class="fa fa-bitcoin"></i>
						<div class="count" style="font-size:22px;"><?php print '$'.$sqli->countConfimInterestPlsDeposit();?></div>
						<div class="title">Confirmed Interest Plus Deposit</div>						
					</div><!--/.info-box-->			
				</div><!--/.col-->
                
                
                <a href="respond-ticket">
                <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
					<div class="info-box purple-bg">
						<i class="fa fa-ticket"></i>
						<div class="count" style="font-size:22px;"><?php print $sqli->countTicket();?></div>
						<div class="title">Support Ticket</div>						
					</div><!--/.info-box-->			
				</div><!--/.col-->
                </a>

                    			
				</div><!--/.col-->	
				</div><!--/.row-->
               
                      
      
                </div><!--/.row-->
         
<div class="row">
     <div class="col-lg-6"><div class="btcwdgt-news" bw-cur="usd"></div></div>
      <div class="col-lg-6"><div class="btcwdgt-chart" bw-theme="light"></div></div>
               </div> <!--/.row-->
			
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
