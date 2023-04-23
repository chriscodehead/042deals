<?php $actova1=''; $actova2=''; $actova3=''; $actova4=''; $actova5=''; $actova6=''; $actova7=''; $actova8=''; $actova9=''; $actova10='active';?>
<?php require_once('../../con-cot/conn_sqli.php'); ?>
<?php require_once('../../lib/basic-functions.php'); ?>
<?php require_once('../../library.php'); ?>
<?php require_once('../../select-library.php'); ?>
<?php $bassic->checkLogedINAdmin('login');?>
  <?php 
$msg='';
ini_set('post_max_size', '64M');
ini_set('upload_max_filesize', '64M');
if(isset($_POST['post'])){
			$msg = $_POST['msg'];
			$name = $_POST['name'];
			$title = $_POST['title'];
			if(!empty($msg )&&!empty($name)&&!empty($title)){
										  $fieldup = array("id","title","news","admin_name","date_post","top_massage");
										  $valueup = array(null,$title,$msg,$name,$bassic->getDate2(),'0');
										  $update = $cal->insertDataB($news,$fieldup,$valueup);
											if(!empty($update)){
												$msg = $update;
											  }else{/*do nothing*/}
			}else{$msg = 'Please fill all fields';}
}
?>
<?php 
if(isset($_GET['top'])&&!empty($_GET['top'])){
		$value = array("1");
		$field = array("top_massage");
		$newa = $cal->update($news,$field,$value,'id',$_GET['top']);
		if(!empty($newa)){$msg = $newa;}
		header("location:new-view");
}
?>
<?php 
if(isset($_GET['less'])&&!empty($_GET['less'])){
		$value = array("0");
		$field = array("top_massage");
		$newa = $cal->update($news,$field,$value,'id',$_GET['less']);
		if(!empty($newa)){$msg = $newa;}
		header("location:new-view");
}

if(isset($_GET['delete'])&&!empty($_GET['delete'])){
		$passportIn = $cal->selectFrmDB($news,'post_image','id',$_GET['delete']);
		 if(query_sql("DELETE FROM $news WHERE `id`='".$_GET['delete']."' LIMIT 1")){
			$bassic->unlinkFile($passportIn,'../../photo/');
			 $msg = 'Delete process was successful!';
			 header("location:new-view?done=".$msg);
		 }else{
			 $msg = 'Info Faild to delete!';
			 header("location:new-view?done=".$msg);
		 }
}
?>
<?php if(isset($_GET['done'])&&!empty($_GET['done'])){$msg = $_GET['done'];}?>
<!DOCTYPE html>
<html lang="en">
<?php
$title = 'News View |';
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
					<h3 class="page-header"><i class="fa fa-laptop"></i> News</h3>
					<ol class="breadcrumb">
						<li><i class="fa fa-home"></i><a href="../host-admin/">Home</a></li>
						<li><i class="fa fa-laptop"></i> News View</li>
                        <li><i class="fa fa-laptop"></i><a href="post-news"> Post News</a></li>								  	
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
					  <?php $select->allNews();?>
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
