<?php $actova1=''; $actova2=''; $actova3=''; $actova4=''; $actova5=''; $actova6=''; $actova7=''; $actova8='active'; $actova9=''; $actova10='';?>
<?php require_once('../../con-cot/conn_sqli.php'); ?>
<?php require_once('../../lib/basic-functions.php'); ?>
<?php require_once('../../library.php'); ?>
<?php require_once('../../select-library.php'); ?>
<?php $bassic->checkLogedINAdmin('login');?>
<?php
$msg='';

if(isset($_POST['creatticket'])){
			 $pic_name  = $_FILES['pic']['name'];
			 $pic_tmp = $_FILES['pic']['tmp_name'];
			 $pic_size = $_FILES['pic']['size'];
			$msgs = $_POST['msg'];
			$title = $_POST['title'];
			//if(empty($location)){$location=$l_ocation;}
			if(!empty($msgs )&&!empty($title)){
						$gen_Num =  $bassic->randGenerator();
						$extension_Name = $bassic->extentionName($pic_name);
						$new_name = $gen_Num.$extension_Name; 
						$ticketID = 'TIC'.$gen_Num;
						
						$path = '../../dashboard/ticketfile/'.$new_name;
						$picvalidation = $bassic->picVlidator($pic_name,$pic_size);
						if($pic_name==''){
							$new_name = 'none';
							}
						//if(empty($picvalidation)){
						
										  $fieldup = array("id","ticket_id","ticket_title","reporter_message","reporter_email","report_time","replier"," 	replier_message","replier_name","replied_time","category","closer");
										  $valueup = array(null,$ticketID,$title,$msgs,$_SESSION['user_id'],$d_ate,'none','none','none','none','main','open');
										  $update = $cal->insertDataB($tickect_tb,$fieldup,$valueup);
											if(!empty($update)){
												if($pic_name==''){$bassic->uploadImage($pic_tmp,$path);}
												$msg = $update;
												header("location:respond-ticket?ticket=".$ticketID.'&id='.$cal->getLastID($tickect_tb));
											  }else{/*do nothing*/}
					  // }else{$msg = $picvalidation;}
			}else{$msg = 'Please fill all fields';}
}



if(isset($_POST['post'])){
	$msgs = $_POST['msgp'];
	if(!empty($msgs)){
			//insert
$fieldup = array("id","ticket_id","ticket_title","reporter_message","reporter_email","report_time","replier","replier_message","replier_name","replied_time","category","closer");
$valueup = array(null,$_GET['ticket'],$cal->selectFrmDB($tickect_tb,'ticket_title','id',$_GET['id']),'none','none','none','support',$msgs,$cal->selectFrmDB($admin_tb,'name','email',$_SESSION['admin_id']),$bassic->getDate2(),'sub','open');
								$update = $cal->insertDataB($tickect_tb,$fieldup,$valueup);
											if(!empty($update)){
												$msg = $update;
												header("location:respond-ticket?ticket=".$_GET['ticket'].'&id='.$_GET['id']);
											  }else{/*do nothing*/}
		}else{$msg = 'Please fill all fields';}
}

if(isset($_POST['close'])&&!empty($_GET['ticket'])){
	$value = array("close");
	$field = array("closer");
	$update = $cal->update($tickect_tb,$field,$value,'id',$_GET['id']);
	$msg = $update;
}
?>

<!DOCTYPE html>
<html lang="en">
<?php
$title = 'Support Ticket |';
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
					<h3 class="page-header"><i class="fa fa-laptop"></i> Support</h3>
					<ol class="breadcrumb">
						<li><i class="fa fa-home"></i><a href="../host-admin/">Home</a></li>
						<li><i class="fa fa-laptop"></i> Respond Support Ticket</li>				
					</ol>
				</div>
			</div>
            
               <div class="row">
                <div class="col-lg-12">
                   
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            
               <div class="row">
             <h6 align="center"> <?php if(!empty($msg)){echo $msg;}?></span></h6>
               
            </div>      <!-- /.row -->
            
             <div class="row">
            <?php if(isset($_GET['ticket'])&&!empty($_GET['ticket'])){}else{?>
               <!--     <div class="col-lg-12">
<h4>Create Ticket</h4>
				
                          <form action="" method="post" enctype="multipart/form-data">  
                          <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <tbody>
                                    <tr>
                                            <td colspan="2" width="100%">
                                           <input name="title" type="text" class="form-control" placeholder="Title" id="title" value=""> </td>
                                   </tr>
                                        <tr>
                                            <td colspan="2" width="100%">
                                            <textarea placeholder="Message" class="form-control" value="" name="msg" ></textarea>
                                            </td>
                                   </tr>
                                   <tr>
                                        <td width="90%"> <input style="float:left;"  name="pic" type="file" id="" /></td>
                                        <td><input style="float:left;" class="btn btn-primary" type="submit" name="creatticket" value="Create" /></td>
                                        </tr>
                                    </tbody>
                            </table></form>
             </div>--><?php }?>
            </div>
                <!-- /.row -->
                
                  <div class="row">
         <div class="col-lg-8">
<?php if(isset($_GET['ticket'])&&!empty($_GET['ticket'])){?>
          <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                 	<thead>
                    	<tr>
                        	<th style="background-color:#333; color:#FFF;">
                            <?php echo 'Ticket ID: '.$cal->selectFrmDB($tickect_tb,'ticket_id','id',$_GET['id']).'<br />';?>
							<?php echo 'Title: '.$cal->selectFrmDB($tickect_tb,'ticket_title','id',$_GET['id']);?></th>
                        </tr>
                        </thead>
                        </table>
<?php $select->ticketMsg2($_GET['ticket']);?>
<?php $closer = $cal->selectFrmDB2($tickect_tb,'closer','ticket_id',$_GET['ticket'],'category','main');
if($closer=='close'){ ?>
You closed this ticket.
<?php }else{?>
<form action="" method="post" enctype="multipart/form-data"> 
<textarea placeholder="Message" style="margin-top:10px;" class="form-control" value="" name="msgp" ></textarea>
 <input style="float:right; margin-top:3px;" class="btn btn-primary" type="submit"  name="post" value="Post" />
 </form>
 <form action="" method="post" enctype="multipart/form-data">
 <input class="btn btn-default" style=" margin-top:3px;" name="close" type="submit" value="Close Ticket">
 </form>
 <?php }?>
 <?php }?>
         </div>
                <!-- /.col-lg-8 -->
                
               <div class="col-lg-4" style="overflow:hidden;">
                 <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                 	<thead>
                    	<tr>
                        	<th style="background-color:#333; color:#FFF;">All Tickets</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php $select->ticketTitle2();?>
                    </tbody>
                 </table>
                  </div>
                    <!-- /.panel .chat-panel -->
                          
                </div>
                <!-- /.col-lg-4 -->
                </div>
            <!-- /.row -->
              
         <div class="row">
          	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" >
                 <div class="col-lg-6">
                 </div>
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