<!--sidebar start-->
      <aside class="">
          <div id="sidebar"  class="nav-collapse " style="background-color:#00CC00;">
              <!-- sidebar menu start-->
              <ul class="sidebar-menu">         
                  <li class="<?php echo $actova1;?>">
                      <a class="" href="../host-admin/">
                          <i class="icon_house_alt"></i>
                          <span style="color:#FFF;">Dashboard</span>
                      </a>
                  </li>
                <!-- <li class="sub-menu <?php print $actova2;?>">
                      <a href="wallet" class="">
                          <i class="fa fa-bank"></i>
                          <span style="color:#FFF;">Transactions</span>
                      </a>
                </li> -->

                 <!-- <li class="<?php print @$actova4;?>">
                      <a class="" href="pay-bitcoin">
                          <i class="fa fa-bitcoin"></i>
                          <span style="color:#FFF; font-size:15px;">Withdrawals</span>
                      </a>
                  </li> -->
                  <!-- <li class="<?php print @$actova44aw;?>">
                      <a class="" href="payment-details">
                          <i class="fa fa-bitcoin"></i>
                          <span style="color:#FFF; font-size:15px;">Add Payment Details</span>
                      </a>
                  </li> -->
                  <li class="<?php print @$actova44aD;?>">
                      <a class="" href="settings">
                          <i class="fa fa-bitcoin"></i>
                          <span style="color:#FFF; font-size:15px;">Settings</span>
                      </a>
                  </li>
                  <!--<li class="<?php print @$actova44;?>">
                      <a class="" href="payout-manipulate">
                          <i class="fa fa-bitcoin"></i>
                          <span style="color:#FFF; font-size:15px;">PayOut Manipulate</span>
                      </a>
                  </li>-->
                  <li class="<?php print @$actova6w;?>">
                      <a class="" href="addproduct">
                          <i class="fa  fa-money"></i>
                          <span style="color:#FFF; font-size:15px;">Add Product</span>
                      </a>
                  </li>
                   
                  <!--<li class="<?php print @$actova7;?>">
                      <a class="" href="cashout-history">
                          <i class="fa  fa-money"></i>
                          <span style="color:#FFF; font-size:15px;">Payment History</span>
                      </a>
                  </li>-->    
                 <!-- <li class="<?php print @$actova5;?>">
                      <a class="" href="all-users">
                          <i class="icon_profile"></i>
                          <span style="color:#FFF; font-size:15px;">User Account</span>
                      </a>
                  </li> -->
                   <!-- <li class="<?php print @$actova11;?>">
                      <a class="" href="payment-settings">
                          <i class="icon_profile"></i>
                          <span style="color:#FFF; font-size:15px;">Payment Settings</span>
                      </a>
                  </li> -->
                  <!--<li class="<?php print @$actova8;?>">
                      <a class="" href="respond-ticket">
                          <i class="fa fa-ticket"></i>
                          <span style="color:#FFF; font-size:15px;">Reply TIckets</span>
                      </a>
                  </li>-->
                  <li class="<?php print @$actova9;?>">
                      <a class="" href="post-news">
                          <i class="fa fa-ticket"></i>
                          <span style="color:#FFF; font-size:15px;">Post News</span>
                      </a>
                  </li>
                  <!-- <li class="<?php print @$actova91;?>">
                      <a class="" href="upload-course">
                          <i class="fa fa-ticket"></i>
                          <span style="color:#FFF; font-size:15px;">Upload Courses</span>
                      </a>
                  </li> -->
                  <!-- <li class="<?php print @$actova44w;?>">
                      <a class="" href="clients-review">
                          <i class="fa fa-bitcoin"></i>
                          <span style="color:#FFF; font-size:15px;">Testimonials/Reviews</span>
                      </a>
                  </li> -->
                  <!-- <li class="<?php print @$actova6;?>">
                      <a class="" href="deposit-history">
                          <i class="fa  fa-money"></i>
                          <span style="color:#FFF; font-size:15px;">Deposit History</span>
                      </a>
                  </li>  -->
                  
                <?php if($cal->selectFrmDB($admin_tb,'role','email',$_SESSION['admin_id'])=='admin1'){?>
				  <li class="sub-menu <?php print @$actova3;?>">
                      <a href="admin-acount" class="">
                          <i class="fa fa-bank"></i>
                          <span style="color:#FFF;">Admin Account</span>
                      </a>
                </li>
                <?php }?>
                    <?php //if($cal->selectFrmDB($admin_tb,'role','email',$_SESSION['admin_id'])=='admin1'){?>
	<!--			  <li class="sub-menu <?php //print @$actova3;?>">
                      <a href="create-admin-acount" class="">
                          <i class="fa fa-bank"></i>
                          <span style="color:#FFF; font-size:13px;">Create Admin Account</span>
                      </a>
                </li>-->
                <?php //}?>
                             
            <!--   <li class="<?php //print @$actova10;?>">                     
                      <a class="" href="my-referrals">
                          <i class="icon_piechart"></i>
                          <span style="color:#FFF;">My Referrals</span>
                      </a>                
                  </li>-->

                  <!-- <li class="<?php print @$actova10;?>">
                      <a class="" href="referral-history">
                          <i class="fa fa-ticket"></i>
                          <span style="color:#FFF; font-size:15px;">Referral History</span>
                      </a>
                  </li> -->

                  <li class="<?php print @$actova101;?>">
                      <a class="" href="maintenance-settings">
                          <i class="fa fa-ticket"></i>
                          <span style="color:#FFF; font-size:15px;">Maintenance Settings</span>
                      </a>
                  </li>
                  
                  <li class="sub-menu">
                      <a href="../../end-current-session" class="">
                          <i class="fa fa-sign-out"></i>
                          <span style="color:#FFF;">Sign Out</span>
                      </a>
                  </li>
                  
              </ul>
              <!-- sidebar menu end-->
          </div>
      </aside>
      <!--sidebar end-->