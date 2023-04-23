<?php $actova1=''; $actova2=''; $actova3=''; $actova4=''; $actova5=''; $actova6=''; $actova7=''; $actova8=''; $actova6w='active'; $actova10='';?>
<?php require_once('../../con-cot/conn_sqli.php'); ?>
<?php require_once('../../lib/basic-functions.php'); ?>
<?php require_once('../../library.php'); ?>
<?php require_once('../../select-library.php'); ?>
<?php require_once('../../emails_lib.php'); ?>
<?php $bassic->checkLogedINAdmin('login');?>
<?php 
$msg='';

if(isset($_POST['post'])){

    $title = $_POST['title'];
    $product_brand = $_POST['product_brand'];
    $product_category = $_POST['product_category'];
    $price = $_POST['price'];
    $oldprice = $_POST['oldprice'];

    $pic_name  = $_FILES['file']['name'];
    $pic_tmp = $_FILES['file']['tmp_name'];
    $pic_size = $_FILES['file']['size'];

    $pic_name1  = $_FILES['file1']['name'];
    $pic_tmp1 = $_FILES['file1']['tmp_name'];
    $pic_size1 = $_FILES['file1']['size'];

    $pic_name2  = $_FILES['file2']['name'];
    $pic_tmp2 = $_FILES['file2']['tmp_name'];
    $pic_size2 = $_FILES['file2']['size'];

    $pic_name3  = $_FILES['file3']['name'];
    $pic_tmp3 = $_FILES['file3']['tmp_name'];
    $pic_size3 = $_FILES['file3']['size'];

    $pic_name4  = $_FILES['file4']['name'];
    $pic_tmp4 = $_FILES['file4']['tmp_name'];
    $pic_size4 = $_FILES['file4']['size'];

    $pic_name5  = $_FILES['file5']['name'];
    $pic_tmp5 = $_FILES['file5']['tmp_name'];
    $pic_size5 = $_FILES['file5']['size'];

    $pic_name6  = $_FILES['file6']['name'];
    $pic_tmp6 = $_FILES['file6']['tmp_name'];
    $pic_size6 = $_FILES['file6']['size'];

    $description = $_POST['description'];
    $phone = $_POST['phone'];
    $video = $_POST['video'];
    $admin_name = $_POST['admin_name'];
    $product_currency = $_POST['product_currency'];
    $url_info = str_replace(' ', '-', $title);
    $theurl = preg_replace('/[^A-Za-z0-9\-]/', '', $url_info);
    $tid = $theurl.$bassic->randGenerator();

    if(!empty($pic_name)&&!empty($price)&&!empty($title)&&!empty($description)){

        $gen_Num = $bassic->randGenerator();
        $extension_Name = $bassic->extentionName($pic_name);
        $new_name = $gen_Num.uniqid().$extension_Name;
        $path = '../../productimage/'.$new_name;
        $picvalidation = $bassic->picVlidator($pic_name,$pic_size);

        $gen_Num1 = $bassic->randGenerator();
        $extension_Name1 = $bassic->extentionName($pic_name1);
        $new_name1 = $gen_Num.uniqid().$extension_Name1;
        $path1 = '../../productimage/'.$new_name1;
        $picvalidation1 = $bassic->picVlidator($pic_name1,$pic_size1);
        if(empty($pic_name1)){$new_name1='';}

        $gen_Num2 = $bassic->randGenerator();
        $extension_Name2 = $bassic->extentionName($pic_name2);
        $new_name2 = $gen_Num.uniqid().$extension_Name2;
        $path2 = '../../productimage/'.$new_name2;
        $picvalidation2 = $bassic->picVlidator($pic_name2,$pic_size2);
        if(empty($pic_name2)){$new_name2='';}

        $gen_Num3 = $bassic->randGenerator();
        $extension_Name3 = $bassic->extentionName($pic_name3);
        $new_name3 = $gen_Num.uniqid().$extension_Name3;
        $path3 = '../../productimage/'.$new_name3;
        $picvalidation3 = $bassic->picVlidator($pic_name3,$pic_size3);
        if(empty($pic_name3)){$new_name3='';}

        $gen_Num4 = $bassic->randGenerator();
        $extension_Name4 = $bassic->extentionName($pic_name4);
        $new_name4 = $gen_Num.uniqid().$extension_Name4;
        $path4 = '../../productimage/'.$new_name4;
        $picvalidation4 = $bassic->picVlidator($pic_name4,$pic_size4);
        if(empty($pic_name4)){$new_name4='';}

        $gen_Num5 = $bassic->randGenerator();
        $extension_Name5 = $bassic->extentionName($pic_name5);
        $new_name5 = $gen_Num.uniqid().$extension_Name5;
        $path5 = '../../productimage/'.$new_name5;
        $picvalidation5 = $bassic->picVlidator($pic_name5,$pic_size5);
        if(empty($pic_name5)){$new_name5='';}

        $gen_Num6 = $bassic->randGenerator();
        $extension_Name6 = $bassic->extentionName($pic_name6);
        $new_name6 = $gen_Num.uniqid().$extension_Name6;
        $path6 = '../../productimage/'.$new_name6;
        $picvalidation6 = $bassic->picVlidator($pic_name6,$pic_size6);
        if(empty($pic_name6)){$new_name6='';}

    if(empty($picvalidation)) {
        $upl = $bassic->uploadImage($pic_tmp,$path);
        $upl2 = $bassic->uploadImage($pic_tmp1,$path1);
        $upl3 = $bassic->uploadImage($pic_tmp2,$path2);
        $upl4 = $bassic->uploadImage($pic_tmp3,$path3);
        $upl5 = $bassic->uploadImage($pic_tmp4,$path4);
        $upl6 = $bassic->uploadImage($pic_tmp5,$path5);
        $upl7 = $bassic->uploadImage($pic_tmp6,$path6);

        if(empty($upl)) {
            $fieldup = array("id", "trn_id", "title", "product_brand", "product_category", "price", "oldprice", "image", "image2", "image3", "image4", "image5", "image6", "image7", "description", "admin_name", "whatsapp_number", "product_video", "product_currency", "date_post");
            $valueup = array(null, $tid, $title, $product_brand, $product_category, $price, $oldprice, $new_name, $new_name1, $new_name2, $new_name3, $new_name4, $new_name5, $new_name6, $description, $admin_name, $phone, $video, $product_currency, $bassic->getDate2());
            $update = $cal->insertDataB($product, $fieldup, $valueup);
            if (!empty($update)) {
                if ($update == 'Registration was successful. Proceed to login!') {
                    $msg = 'Product upload was successfully!';
                } else {
                    $msg = $update;
                }
            } else {$msg = 'An error occured!';}
        }else{$msg =  $upl;}
    }else{$msg =  $picvalidation;}
    }else{$msg = 'Please fill all fields';}
}
?>
<!DOCTYPE html>
<html lang="en">
<?php
$title = 'Products | ';
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
					<h3 class="page-header"><i class="fa fa-laptop"></i> Products</h3>
					<ol class="breadcrumb">
						<li><i class="fa fa-home"></i><a href="../host-admin/">Home</a></li>
						<li><i class="fa fa-laptop"></i> Add Products</li>
                        <li><i class="fa fa-laptop"></i><a href="all-products"> View Products</a></li>
					</ol>
				</div>
			</div>

 <?php if(!empty($msg)){?>
 <div class="row">
         <div id="go" class=" col-lg-12">
        <div id="go" class="alert alert-warning" style="text-align: center; color:#FFF;"><?php print @$msg;?> <i id="remove" class="fa fa-remove pull-right"></i></div>
        </div>
 </div>
<?php }else{?>
 <div class="row">
         <div id="go" class=" col-lg-12">
        <div id="go" class="alert alert-warning" style="text-align: center; color:#000;">Add Products <i id="remove" class="fa fa-remove pull-right"></i></div>
        </div>
 </div>
    <?php }?>        
         <div class="row">
         
          	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" >
					 <form action="" method="post" enctype="multipart/form-data">  
                          <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <tbody>
                                     <tr>
                                        	<td>Product Title</td>
                                            <td><input type="text" class="form-control" value="" name="title" >
                                            </td>
                                    </tr>
                                    <tr>
                                        	<td>Brand Name (eg: HP, Dell)</td>
                                            <td><input type="text" class="form-control" value="" name="product_brand" >
                                            </td>
                                    </tr>
                                    <tr>
                                        <td> Course Category</td>
                                        <td> <select class="form-control" name="product_category">
                                          <option value="">Select Category</option>
                                  <?php $sql = query_sql("SELECT * FROM $cat_tb ORDER BY id DESC");
                                        $i=1;
                                    if(mysqli_num_rows($sql)>0){
                                      while($row = mysqli_fetch_assoc($sql)){?>

                                          <option value="<?php print $row['p_id'];?>"><?php print $row['title'];?></option>

                                          <?php }}?>

                                              </select>
                                              <a href="create-category">Create New Category</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Product Currency</td>
                                        <td> 
                                            <select class="form-control" name="product_currency">
                                                <option value="">Select Currency</option>
                                                <option value="NGN">NGN</option>
                                                <option value="USD">USD</option>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                         <td>Product Price($/NGN)</td>
                                         <td><input type="number" class="form-control" value="" name="price" >
                                         </td>
                                     </tr>
                                     <tr>
                                         <td>Product Price($/NGN)</td>
                                         <td><input type="number" class="form-control" value="" name="oldprice" >
                                         </td>
                                     </tr>
                                     <tr>
                                         <td>Product Image(800 X 800)</td>
                                         <td><input type="file" class="form-control" value="" name="file" >
                                         </td>
                                     </tr>
                                     <tr>
                                         <td>Product Image(800 X 800)</td>
                                         <td><input type="file" class="form-control" value="" name="file1" >
                                         </td>
                                     </tr>
                                     <tr>
                                         <td>Product Image(800 X 800)</td>
                                         <td><input type="file" class="form-control" value="" name="file2" >
                                         </td>
                                     </tr>
                                     <tr>
                                         <td>Product Image(800 X 800)</td>
                                         <td><input type="file" class="form-control" value="" name="file3" >
                                         </td>
                                     </tr>
                                     <tr>
                                         <td>Product Image(800 X 800)</td>
                                         <td><input type="file" class="form-control" value="" name="file4" >
                                         </td>
                                     </tr>
                                     <tr>
                                         <td>Product Image(800 X 800)</td>
                                         <td><input type="file" class="form-control" value="" name="file5" >
                                         </td>
                                     </tr>
                                     <tr>
                                         <td>Product Image(800 X 800)</td>
                                         <td><input type="file" class="form-control" value="" name="file6" >
                                         </td>
                                     </tr>
                                    <tr>
                                        <td>Product Description</td>
                                        <td>
                                        
                                        <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
                                        
                                        <script>tinymce.init({selector:'textarea'});</script>

                                        <textarea class="form-control" value="" name="description" ></textarea>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td> Contact WhatsApp Number (eg: 2348035249716)</td>
                                        <td> <input  name="phone" type="text" class="form-control" placeholder="2348035249716" id="" /></td>
                                    </tr>
                                    <tr>
                                        <td>Product Video (Youtube Link: <br>https://www.youtube.com/watch?v=xxxxxxxx)</td>
                                        <td> <input  name="video" type="text" class="form-control" id="" /></td>
                                    </tr>
                                    <tr>
                                        <td> Admin Name</td>
                                        <td> <input  name="admin_name" type="text" class="form-control" id="" /></td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td><input class="btn btn-primary" type="submit" name="post" value="Post" /></td>
                                    </tr>
                                </tbody>
                        </table></form>   
              </div>
         </div><!--/.row-->
            
		</section>
   
      <!--main content end-->
  </section>
  <!-- container section start -->
</section>
 
  <?php require_once('jsfiles.php')?>
  </body>
</html>
