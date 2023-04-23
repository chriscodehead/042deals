<?php
require_once('include.php');
$title = @$cal->selectFrmDB($product,'product_brand','trn_id',$_GET['p_id']).' | '.$cal->selectFrmDB($product,'title','trn_id',$_GET['p_id']).' - '.str_replace('-', ' ', $cal->selectFrmDB($product,'product_category','trn_id',$_GET['p_id']));
$description = 'Stay ahead of the curve with our selection of cutting-edge gadgets and accessories. We offer the latest smartphones, laptops, headphones, and more from top brands like Apple, Samsung, and Dell.';
$keyword = 'gadgets, laptops, smartphones, tablets, accessories, electronics, technology, bags, backpacks, luggage, travel gear, suitcases, carry-ons, duffel, bags, rolling bags, travel accessories, portable chargers, earbuds, headphones, cameras';
$imageLink = 'productimage/'.@$cal->selectFrmDB($product,'image','trn_id',$_GET['p_id']);
$active3 = "active";
require_once('head.php'); 

// Get the ID of the post being viewed (replace 'post_id' with your actual ID variable)
$post_id = $_GET['p_id'];

// Set a cookie to store the date of the last visit for this post
$expiry = time() + (24 * 60 * 60); // 24 hours
setcookie('last_visit_'.$post_id, date('Y-m-d'), $expiry);

// Check if the user has viewed this post today
if (isset($_COOKIE['last_visit_'.$post_id]) && $_COOKIE['last_visit_'.$post_id] == date('Y-m-d')) {
    // User has already viewed this post today, do not count this view
    //echo 'Welcome back! Your views for this post have not been incremented.';
} else {
    // User has not viewed this post today, increment view count and set cookie
    $view_count = 1;
    //if (isset($_COOKIE['view_count_'.$post_id])) {$view_count = $_COOKIE['view_count_'.$post_id] + 1;}
    //setcookie('view_count_'.$post_id, $view_count, $expiry);
    //echo 'Welcome! Your views for this post have been incremented to ' . $view_count . '.';
    $views = $cal->selectFrmDB($product,'views','trn_id',$post_id);
    $new_views = $views + $view_count;
    $fieldup = array("views");
    $valueup = array($new_views);
    $update = $cal->update($product,$fieldup,$valueup,'trn_id',$post_id);
}


if (isset($_POST['sub'])) {
    $com = $_POST['com'];
    $name = $_POST['name'];
    if(!empty($com)){
        $fieldup = array("id","news_id","comment","date_post","name");
        $valueup = array(null,$_GET['p_id'],$com,$bassic->getDate2(),$name);
        $update = $cal->insertDataB($comments_tb,$fieldup,$valueup);
        if($update){
            ?> <script>alert("Thanks for your comment!");</script> <?php
        }else{
            ?> <script>alert("Please enter a comment!");</script> <?php
        }
    }else{
        ?> <script>alert("Please enter a comment!");</script> <?php
    }
}

if (isset($_POST['order'])) {
    $post_id = $_GET['p_id'];
    $email = $_POST['email'];
    $name = $_POST['name_o'];
    $qty = $_POST['qty'];
    $order_des = $_POST['order_des'];
    $country = $_POST['country'];
    $state = $_POST['state'];
    $city = $_POST['city'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];

    if(!empty($phone)&&!empty($email)&&!empty($address)&&!empty($order_des)&&!empty($state)&&!empty($city)&&!empty($name)&&!empty($country)&&!empty($qty)){
        $fieldup = array("id","product_id","name","email","phone","qty","address","city","state","country","order_description","date_ordered");
        $valueup = array(null,$_GET['p_id'],$name,$email,$phone,$qty,$address,$city,$state,$country,$order_des,$bassic->getDate2());
        $update = $cal->insertDataB($orders_tb,$fieldup,$valueup);
        if($update){
            $subjt = 'New order from '.$name;
            $p_name = @$cal->selectFrmDB($product,'title','trn_id',$_GET['p_id']);
            $info = '<p>Product Name: '.$p_name.' <br>
                        Product ID: '.$post_id.' <br>
                        Product Quantity: '.$qty.' <br>
                        Customer Name: '.$name.' <br>
                        Customer Email: '.$email.' <br>
                        Customer Phone: '.$phone.' <br>
                        Customer Country: '.$country.' <br>
                        Customer State: '.$state.' <br>
                        Customer City: '.$city.' <br>
                        Customer Address: '.$address.' <br>
                     </p>';
            $message = $order_des.' '.$info;
            $admin_email = $dummyEmail;
            $siteName = $siteName;
            $siteDomain = $siteDomain;

            $email_call->generalMessage($subjt,$message,$admin_email,$siteName,$siteDomain);

            $subj = 'Auto Responder';
            $email_call->autoReplyMail($name,$email,$subj);
            ?> <script>alert("Thanks for your order!");</script> <?php
        }else{
            ?> <script>alert("Please fill out the others form!");</script> <?php
        }
    }else{
        ?> <script>alert("Please fill out the others form!");</script> <?php
    }
}
?>

<body>

    <?php require_once("header.php")?>

    <main class="product-page style-5">
        <!-- ====== start product ====== -->
        <section class="product pt-50">
            <div class="container">
                <div class="section-head text-center mb-80 style-5">
                    <div class="page-links color-999">
                        <a href="./" class="me-2">
                            Home
                        </a>
                        <span class="me-2">/</span>
                        <a href="./" class="me-2">
                            <?php print $siteName;?> Store
                        </a>
                        <span class="me-2">/</span>
                        <a href="#" class="color-000">
                            <?php echo @$cal->selectFrmDB($product,'title','trn_id',$_GET['p_id']);?>
                        </a>
                    </div>
                </div>

                <div class="content">
                    <div class="row gx-5">
                        <div class="col-lg-6">
                            <div class="product-slider">
                                <div class="swiper-container gallery-thumbs">
                                    <div class="swiper-wrapper" style="overflow: scroll;">

                                        <?php  if(!empty($cal->selectFrmDB($product,'image','trn_id',$_GET['p_id']))){?>
                                        <div class="swiper-slide">
                                            <div class="img">
                                                <img src="productimage/<?php echo @$cal->selectFrmDB($product,'image','trn_id',$_GET['p_id']);?>" alt="">
                                            </div>
                                        </div>
                                        <?php }?>
                                        
                                        <?php  if(!empty($cal->selectFrmDB($product,'image2','trn_id',$_GET['p_id']))){?>
                                        <div class="swiper-slide">
                                            <div class="img">
                                                <img src="productimage/<?php echo @$cal->selectFrmDB($product,'image2','trn_id',$_GET['p_id'])?>" alt="">
                                            </div>
                                        </div>
                                        <?php }?>

                                        <?php  if(!empty($cal->selectFrmDB($product,'image3','trn_id',$_GET['p_id']))){?>
                                        <div class="swiper-slide">
                                            <div class="img">
                                                <img src="productimage/<?php echo @$cal->selectFrmDB($product,'image3','trn_id',$_GET['p_id'])?>" alt="">
                                            </div>
                                        </div>
                                        <?php }?>

                                        <?php  if(!empty($cal->selectFrmDB($product,'image4','trn_id',$_GET['p_id']))){?>
                                        <div class="swiper-slide">
                                            <div class="img">
                                                <img src="productimage/<?php echo @$cal->selectFrmDB($product,'image4','trn_id',$_GET['p_id'])?>" alt="">
                                            </div>
                                        </div>
                                        <?php }?>

                                        <?php  if(!empty($cal->selectFrmDB($product,'image5','trn_id',$_GET['p_id']))){?>
                                        <div class="swiper-slide">
                                            <div class="img">
                                                <img src="productimage/<?php echo @$cal->selectFrmDB($product,'image5','trn_id',$_GET['p_id'])?>" alt="">
                                            </div>
                                        </div>
                                        <?php }?>

                                        <?php  if(!empty($cal->selectFrmDB($product,'image6','trn_id',$_GET['p_id']))){?>
                                        <div class="swiper-slide">
                                            <div class="img">
                                                <img src="productimage/<?php echo @$cal->selectFrmDB($product,'image6','trn_id',$_GET['p_id'])?>" alt="">
                                            </div>
                                        </div>
                                        <?php }?>

                                        <?php  if(!empty($cal->selectFrmDB($product,'image7','trn_id',$_GET['p_id']))){?>
                                        <div class="swiper-slide">
                                            <div class="img">
                                                <img src="productimage/<?php echo @$cal->selectFrmDB($product,'image7','trn_id',$_GET['p_id'])?>" alt="">
                                            </div>
                                        </div>
                                        <?php }?>

                                    </div>
                                </div>

                                <div class="swiper-container gallery-top">
                                    <div class="swiper-wrapper">

                                        <?php  if(!empty($cal->selectFrmDB($product,'image','trn_id',$_GET['p_id']))){?>
                                        <div class="swiper-slide">
                                            <div class="img">
                                                <img src="productimage/<?php echo @$cal->selectFrmDB($product,'image','trn_id',$_GET['p_id'])?>" alt="">
                                            </div>
                                        </div>
                                        <?php }?>

                                        <?php  if(!empty($cal->selectFrmDB($product,'image2','trn_id',$_GET['p_id']))){?>
                                        <div class="swiper-slide">
                                            <div class="img">
                                                <img src="productimage/<?php echo @$cal->selectFrmDB($product,'image2','trn_id',$_GET['p_id'])?>" alt="">
                                            </div>
                                        </div>
                                        <?php }?>

                                        <?php  if(!empty($cal->selectFrmDB($product,'image3','trn_id',$_GET['p_id']))){?>
                                        <div class="swiper-slide">
                                            <div class="img">
                                                <img src="productimage/<?php echo @$cal->selectFrmDB($product,'image3','trn_id',$_GET['p_id'])?>" alt="">
                                            </div>
                                        </div>
                                        <?php }?>

                                        <?php  if(!empty($cal->selectFrmDB($product,'image4','trn_id',$_GET['p_id']))){?>
                                        <div class="swiper-slide">
                                            <div class="img">
                                                <img src="productimage/<?php echo @$cal->selectFrmDB($product,'image4','trn_id',$_GET['p_id'])?>" alt="">
                                            </div>
                                        </div>
                                        <?php }?>

                                        <?php  if(!empty($cal->selectFrmDB($product,'image5','trn_id',$_GET['p_id']))){?>
                                        <div class="swiper-slide">
                                            <div class="img">
                                                <img src="productimage/<?php echo @$cal->selectFrmDB($product,'image5','trn_id',$_GET['p_id'])?>" alt="">
                                            </div>
                                        </div>
                                        <?php }?>

                                        <?php  if(!empty($cal->selectFrmDB($product,'image6','trn_id',$_GET['p_id']))){?>
                                        <div class="swiper-slide">
                                            <div class="img">
                                                <img src="productimage/<?php echo @$cal->selectFrmDB($product,'image6','trn_id',$_GET['p_id'])?>" alt="">
                                            </div>
                                        </div>
                                        <?php }?>

                                        <?php  if(!empty($cal->selectFrmDB($product,'image7','trn_id',$_GET['p_id']))){?>
                                        <div class="swiper-slide">
                                            <div class="img">
                                                <img src="productimage/<?php echo @$cal->selectFrmDB($product,'image7','trn_id',$_GET['p_id'])?>" alt="">
                                            </div>
                                        </div>
                                        <?php }?>

                                    </div>
                                </div>
                            </div>

                            
                            
                        </div>

                        <div class="col-lg-6">
                            <div class="product-info">
                                <h6 class="category"><?php echo @$cal->selectFrmDB($product,'product_brand','trn_id',$_GET['p_id'])?></h6>
                                <h5 class="title"><?php echo @$cal->selectFrmDB($product,'title','trn_id',$_GET['p_id'])?></h5>
                                <div class="rate">
                                    <div class="stars">
                                        <i class="fas fa-star active"></i>
                                        <i class="fas fa-star active"></i>
                                        <i class="fas fa-star active"></i>
                                        <i class="fas fa-star active"></i>
                                        <i class="fas fa-star"></i>
                                    </div>
                                    <span class="rev">3 Reviews</span>
                                </div>
                                <div class="price">
                                    <?php if($cal->selectFrmDB($product,'product_currency','trn_id',$_GET['p_id'])=="USD"){ print '$';}else{print '₦';};?><?php echo @number_format($cal->selectFrmDB($product,'price','trn_id',$_GET['p_id']));?>
                                </div>
                                <div class="old-price">
                                   <strike> <?php if($cal->selectFrmDB($product,'product_currency','trn_id',$_GET['p_id'])=="USD"){ print '$';}else{print '₦';};?><?php echo @number_format($cal->selectFrmDB($product,'oldprice','trn_id',$_GET['p_id']));?></strike>
                                </div>
                                <div class="info-text">
                                    <span>
                                        <?php echo @$bassic->reduceTextLength($cal->selectFrmDB($product,'description','trn_id',$_GET['p_id']),700)?>
                                    </span>
                                </div>

                                <div class="r-side mt-1">
                                    <i class="bi bi-chat-left-text me-1"></i>
                                    <a href=""><?php print $sqli->countCommentsPrd(@$cal->selectFrmDB($product,'trn_id','trn_id',$_GET['p_id']));?></a>

                                    <i class="bi bi-eye ms-4 me-1"></i>
                                    <a href=""><?php print number_format(@$cal->selectFrmDB($product,'views','trn_id',$_GET['p_id']));?></a>
                                </div>
                                
                                

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- ====== end product ====== -->


        <!-- ====== start product details ====== -->
        <section class="product-details">

          <div class="container">    
          <div class="row">
            <div class="col-lg-12">
            
            <div class="product-info">
                 
                <div class="color-quantity">

                    <div style="display: none;" class="select-color">
                        <span class="me-4 mb-1 color-000 fw-bold fs-14px">Select Color</span>
                        <div class="colors-content">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="colorSelect"
                                    id="colorSelect1" checked>
                                <label class="form-check-label" for="colorSelect1">
                                    <span class="color-circle gray"></span>
                                </label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="colorSelect"
                                    id="colorSelect2">
                                <label class="form-check-label" for="colorSelect2">
                                    <span class="color-circle black"></span>
                                </label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="colorSelect"
                                    id="colorSelect3">
                                <label class="form-check-label" for="colorSelect3">
                                    <span class="color-circle blue"></span>
                                </label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="colorSelect"
                                    id="colorSelect4">
                                <label class="form-check-label" for="colorSelect4">
                                    <span class="color-circle green"></span>
                                </label>
                            </div>
                        </div>
                    </div>

                
                    <form method="post" enctype="multipart/form-data">
                        <div class="row">
                        <center>
                        <div class="col-lg-12">
                            <img src="img/order-now-042gadgets.gif" />
                            <img src="img/order_now1-1.gif" />
                            <!-- <img src="img/order-now-042gadgets.gif" /> -->
                        </div>
                        </center>

                            <div class="col-lg-6 mb-2">
                                <div class="form-group mb-4 mb-lg-0">
                                    <input name="name_o" type="text" class="form-control fs-12px radius-4 p-3" placeholder="Your Name *">
                                </div>
                            </div>

                            <div class="col-lg-6 mb-2">
                                <div class="form-group mb-4 mb-lg-0">
                                    <input name="phone" type="text" class="form-control fs-12px radius-4 p-3" placeholder="Your Phone *">
                                </div>
                            </div>

                            <div class="col-lg-6 mb-2">
                                <div class="form-group mb-4 mb-lg-0">
                                    <input name="email" type="text" class="form-control fs-12px radius-4 p-3" placeholder="Your Email *">
                                </div>
                            </div>

                            <div class="col-lg-6 mb-2">
                                <div class="form-group mb-4 mb-lg-0">
                                    <input name="address" type="text" class="form-control fs-12px radius-4 p-3" placeholder="Your Address *">
                                </div>
                            </div>

                            <div class="col-lg-4 mb-2">
                                <div class="form-group mb-4 mb-lg-0">
                                    <input name="city" type="text" class="form-control fs-12px radius-4 p-3" placeholder="Your City *">
                                </div>
                            </div> 

                            <div class="col-lg-4 mb-2">
                                <div class="form-group mb-4 mb-lg-0">
                                    <input name="state" type="text" class="form-control fs-12px radius-4 p-3" placeholder="Your State / Province / Region *">
                                </div>
                            </div>

                            <div class="col-lg-4 mb-2">
                                <div class="form-group mb-4 mb-lg-0">
                                    <input name="country" type="text" class="form-control fs-12px radius-4 p-3" placeholder="Your Country *">
                                </div>
                            </div>

                            <div class="col-lg-12 mb-2">
                            <textarea name="order_des" class="form-control radius-4 fs-12px p-3" rows="1" placeholder="Write your comment here"></textarea>
                            </div>
                        
                            <div class="col-lg-6 mb-2">
                                <span class="me-4 mb-1 color-000 fw-bold fs-14px">QTY</span>
                                <div class="add-more">
                                    <!-- <span class="qt-minus"><i class="fas fa-minus"></i></span>
                                    <span class="qt">1</span>
                                    <span class="qt-plus"><i class="fas fa-plus"></i></span> -->
                                    <input name="qty" type="number" class="form-control fs-12px radius-4 p-3" placeholder="Your Country *" value="1">
                                </div>
                            </div>

                            <div class="col-lg-6 mb-2">
                            <div class="qyt-addCart">
                            <a style="display: none;" href="https://api.whatsapp.com/send?phone=<?php echo @$cal->selectFrmDB($product,'whatsapp_number','trn_id',$_GET['p_id'])?>&text=I want to make enquires about this product | <?php echo @$cal->selectFrmDB($product,'title','trn_id',$_GET['p_id']);?>" class="btn rounded-pill bg-blue4 fw-bold text-white" target="_blank">
                                <small> Submit To Order </small>
                            </a>
                        
                            <button  type="submit" name="order" class="btn  bg-blue4 fw-bold text-white">Submit To Order</button>
                        
                            <a href="https://api.whatsapp.com/send?phone=<?php echo @$cal->selectFrmDB($product,'whatsapp_number','trn_id',$_GET['p_id'])?>&text=I want to make enquires about this product | <?php echo @$cal->selectFrmDB($product,'title','trn_id',$_GET['p_id']);?>" target="_blank"><div class="fav-btn">
                                <i class="fab fa-whatsapp"></i>
                            </div>
                            </a>

                            </div>
                        </div>
                        </div>
                    </form>
                </div>

                <div class="more-info pt-20 mt-1 border-1 border-top brd-gray">

                    <p class="text-uppercase fs-14px color-666 mb-1"> <strong
                            class="color-000">TID:</strong> <?php echo @$cal->selectFrmDB($product,'trn_id','trn_id',$_GET['p_id'])?></p>

                    <p class="fs-14px color-666 mb-1"> <strong class="color-000">Category:</strong>
                        <?php $cat = @$cal->selectFrmDB($product,'product_category','trn_id',$_GET['p_id'])?>
                        <?php echo @$cal->selectFrmDB($cat_tb,'title','p_id',$cat);?>
                        </p>

                    <p class="fs-14px color-666 mb-1"> <strong class="color-000">Tags:</strong> <a
                            href="#"><?php echo @str_replace('-', ' ', $cal->selectFrmDB($product,'product_category','trn_id',$_GET['p_id']));?></a>  </p>

                </div>

                <div  class="socail-icons">
                    <a href="<?php print $siteWhatsAppLink;?>I want to make enquires about this product | <?php echo @$cal->selectFrmDB($product,'title','trn_id',$_GET['p_id']);?>"
                        class="icon-35 rounded-circle bg-gray overflow-hidden d-inline-flex align-items-center justify-content-center text-gray me-2">
                        <i class="fab fa-whatsapp"></i>
                    </a>
                    <a href="<?php print $siteTwitter;?>"
                        class="icon-35 rounded-circle bg-gray overflow-hidden d-inline-flex align-items-center justify-content-center text-gray me-2">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a href="<?php print $siteFacebook;?>"
                        class="icon-35 rounded-circle bg-gray overflow-hidden d-inline-flex align-items-center justify-content-center text-gray me-2">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="<?php print $siteInstagram;?>"
                        class="icon-35 rounded-circle bg-gray overflow-hidden d-inline-flex align-items-center justify-content-center text-gray me-2">
                        <i class="fab fa-instagram"></i>
                    </a>
                    <a href="<?php print $siteYoutube;?>"
                        class="icon-35 rounded-circle bg-gray overflow-hidden d-inline-flex align-items-center justify-content-center text-gray me-2">
                        <i class="fab fa-youtube"></i>
                    </a>
                    <a href="<?php print $siteLinkedin;?>"
                        class="icon-35 rounded-circle bg-gray overflow-hidden d-inline-flex align-items-center justify-content-center text-gray">
                        <i class="fab fa-linkedin-in"></i>
                    </a>
                </div>

            </div> 
            </div> 
          </div> 
          </div>
        </section>

        <section class="product-details pt-100">
            <div class="container">
                <ul class="nav nav-pills" id="pills-tab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="pills-description-tab" data-bs-toggle="pill"
                            data-bs-target="#pills-description" type="button" role="tab" aria-controls="pills-description"
                            aria-selected="true">Description</button>
                    </li>
                    
                </ul>
                <div class="tab-content" id="pills-tabContent">
                    <div class="tab-pane fade show active" id="pills-description" role="tabpanel" aria-labelledby="pills-description-tab">
                        <div class=""><!-- content-info pb-0 -->
                            <div class="text mb-30">
                                <?php echo @$cal->selectFrmDB($product,'description','trn_id',$_GET['p_id']);?>
                            </div>

                            <div class="col-lg-12">
                                <div class="comments-content pre-scrollable">
                                        <h3 class="color-000 mb-0">  Comments </h3>
                                        <div style="overflow: scroll; height: 300px; padding-right: 10px; padding-left: 10px;" class="comment-replay-cont border-bottom border-1 brd-gray pb-40 pt-40 ">

                                        <?php $sql = query_sql("SELECT * FROM $comments_tb WHERE `news_id`='".$_GET['p_id']."' ORDER BY id DESC  ");
                                            $i=1;
                                        if(mysqli_num_rows($sql)>0){
                                        while($row = mysqli_fetch_assoc($sql)){?>

                                            <div class="d-flex comment-cont mb-3">
                                                <div
                                                    class="icon-20 rounded-circle img-cover overflow-hidden me-3 flex-shrink-0">
                                                    <img src="img/pngtree-vector-avatar-icon-png-image_313572.jpg" alt="">
                                                </div>
                                                <div class="inf">
                                                    <div class="title d-flex justify-content-between">
                                                        <h6 class="fw-bold fs-14px"><?php print $row['name'];?></h6>
                                                        <span class="time fs-12px text-uppercase text-primary">
                                                            <?php print $row['date_post'];?>
                                                        </span>
                                                    </div>
                                                    <div class="text color-000 fs-12px mt-10">
                                                        <?php print $row['comment'];?>
                                                    </div>
                                                </div>
                                            </div>

                                            <?php }}?>

                                            
                                        </div>

                                    
                                </div>

                            <h4 class="pt-3 color-000 mb-10">Leave a comment</h4>
                            <form method="post" enctype="multipart/form-data">
                                <div class="col-lg-12 mb-2">
                                    <div class="form-group mb-4 mb-lg-0">
                                        <input name="name" type="text" class="form-control fs-12px radius-4 p-3"
                                            placeholder="Your Name *">
                                    </div>
                                </div>
                                <textarea name="com" class="form-control radius-4 fs-12px p-3" rows="1"
                                                    placeholder="Write your comment here"></textarea>
                                <p>
                                <button style="float: right;" type="submit" name="sub" class="btn rounded-pill blue5-3Dbutn hover-blue5 sm-butn fw-bold mt-40">Submit</button>
                                </p>
                            </form>
                            </div>
                        </div>



                    </div> 
                </div>
            </div>
        </section>
        <!-- ====== end product details ====== -->


        <!-- ====== start Related products ====== -->
        <section class="related-products section-padding">
            <div class="container">
                <div class="text-center title">
                    <h3>Related Products</h3>
                </div>
                <div class="related-products-slider position-relative">
                    <div class="swiper-container">
                        <div class="swiper-wrapper">

                        <?php $sql = query_sql("SELECT * FROM $product ORDER BY id DESC LIMIT 50 ");
                                        $i=1;
                                    if(mysqli_num_rows($sql)>0){
                                      while($row = mysqli_fetch_assoc($sql)){?>
                            <div class="swiper-slide">
                                <div class="product-card">
                                    <div class="img">
                                        <img src="productimage/<?php print $row['image'];?>" alt="">
                                        <span class="label new">new</span>
                                        <span class="fav-btn active"> <i class="fas fa-heart"></i> </span>
                                    </div>
                                    <div class="info">
                                        <h6 class="category"><?php print $row['product_brand'];?></h6>
                                        <h5 title="<?php print $row['title'];?>" class="title"><?php print $bassic->reduceTextLength($row['title'],40);?></h5>
                                        <div class="rate">
                                            <div class="stars">
                                                <i class="fas fa-star active"></i>
                                                <i class="fas fa-star active"></i>
                                                <i class="fas fa-star active"></i>
                                                <i class="fas fa-star active"></i>
                                                <i class="fas fa-star"></i>
                                            </div>
                                            <span class="rev">3 Reviews</span>
                                        </div>
                                    </div>

                                    <div class="r-side mt-1">
                                        <i class="bi bi-chat-left-text me-1"></i>
                                        <a href=""><?php print $sqli->countCommentsPrd($row['trn_id']);?></a>
                                        <i class="bi bi-eye ms-4 me-1"></i>
                                        <a href=""><?php print number_format($row['views']);?></a>
                                    </div>

                                    <div class="price">
                                        <span class="price-sale"><?php if($row['product_currency']=="USD"){ print '$';}else{print '₦';};?><?php print number_format($row['price']);?></span> 
                                        
                                        <span class="old-price"><?php if($row['product_currency']=="USD"){ print '$';}else{print '₦';};?><?php print number_format($row['oldprice']);?> </span>
                                    </div>
        
                                    <a href="product-details?p_id=<?php print $row['trn_id'];?>" class="btn rounded-pill bg-blue4 fw-bold text-white mt-20" target="_blank">
                                        <span> Add To Cart </span>
                                    </a>
                                </div>
                            </div>
                            <?php }}?>
                           

                            
                        </div>
                    </div>
                    <div class="swiper-button-next"></div>
                    <div class="swiper-button-prev"></div>
                </div>
            </div>
        </section>
        <!-- ====== end Related products ====== -->

    </main>
    <!--End-Contents-->

    <?php require_once('footer.php'); ?>