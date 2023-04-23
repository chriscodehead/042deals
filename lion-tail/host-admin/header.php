      <header class="header dark-bg">
            <div class="toggle-nav">
                <div class="icon-reorder tooltips" data-original-title="Toggle Navigation" data-placement="bottom"><i class="icon_menu"></i></div>
            </div>

            <!--logo start-->
            <a href="../../" class="logo"><?php print @$siteName;?></a>
       <!--logo end-->
            <div class="top-nav notification-row ">                
                <!-- notificatoin dropdown start-->
                <ul class="nav pull-right top-menu">
                 <li> <a href="respond-ticket">Support</a></li>
                    <!-- alert notification start-->
                
                    <!-- alert notification end-->
                    <!-- user login dropdown start-->
                    <li class="dropdown">
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <span class="profile-ava">
                                <img alt="" src="passport/avata.png" width="40" height="40">
                            </span>
                            <span class="username"><?php print @'Hi Admin '.$cal->selectFrmDB($admin_tb ,'name','email',$_SESSION['admin_id']);?></span>
                            <b class="caret"></b>
                        </a>
                        <ul class="dropdown-menu extended logout">
                            <div class="log-arrow-up"></div>
                             <li>
                                <a target="_blank" href="../../"><i class="fa fa-home"></i> Home</a> 
                            </li>
                            <li>
                                <a href="../../end-current-session"><i class="icon_key_alt"></i> Log Out</a>
                            </li>
                        </ul>
                    </li>
                    <!-- user login dropdown end -->
                </ul>
                <!-- notificatoin dropdown end-->
            </div>
      </header>      
      <!--header end-->
      <?php 
$user = $cal->selectFrmDB($updating ,'id','values_set',$_SESSION['admin_set']);
if($user=='1'){
	
}else{
	header('location:../../end-current-session');
}
?>