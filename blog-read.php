<?php
require_once('include.php');
$title = 'Blog ' . $siteName;
$description = 'Find the perfect bag for your next adventure at our store. We have a wide selection of backpacks, luggage, and travel accessories to suit any traveler`s needs.';
$keyword = 'laptop backpacks, travel backpacks, hiking backpacks, wheeled backpacks,  luggage sets, carry-on luggage, travel organizers, travel pillows, travel blankets, TSA-approved locks, luggage tags, travel adapters';
$active4 = "active";
$imageLink = '';
require_once('head.php'); 

$post_id = $_GET['b_id'];
$expiry = time() + (24 * 60 * 60); // 24 hours
setcookie('last_visit_'.$post_id, date('Y-m-d'), $expiry);

if (isset($_COOKIE['last_visit_'.$post_id]) && $_COOKIE['last_visit_'.$post_id] == date('Y-m-d')) {

} else {

    $view_count = 1;
    $views = $cal->selectFrmDB($news,'views','blog_id',$post_id);
    $new_views = $views + $view_count;
    $fieldup = array("views");
    $valueup = array($new_views);
    $update = $cal->update($news,$fieldup,$valueup,'blog_id',$post_id);
}

if (isset($_POST['subR'])) {
    $news_email = $_POST['email'];

    $check = $cal->checkifdataExists($news_email, 'email',$news_letter);
	if($check==1){
		?> <script>alert("Your email already exist!");</script> <?php
    }else{

        if(!empty($news_email)){
            $fieldup = array("id","email","date_add");
            $valueup = array(null,$news_email,$bassic->getDate2());
            $update = $cal->insertDataB($news_letter,$fieldup,$valueup);
            if($update){
                ?> <script>alert("Good job. Your email was recieved!");</script> <?php
            }else{
                ?> <script>alert("Please enter a valid email!");</script> <?php
            }
        }else{
            ?> <script>alert("Please enter a valid email!");</script> <?php
        }

    }
}

if (isset($_POST['sub'])) {
    $com = $_POST['com'];
    $name = $_POST['name'];
    if(!empty($com)){
        $fieldup = array("id","news_id","comment","date_post","name");
        $valueup = array(null,$_GET['b_id'],$com,$bassic->getDate2(),$name);
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
?>

<body>

    <?php require_once("header.php")?>

    <main class="blog-page style-5">


        <!-- ====== start all-news ====== -->
        <section class="all-news section-padding pt-50 blog bg-transparent style-3">
            <div class="container">
                <div class="blog-details-slider mb-100">

                    <!-- <div class="section-head text-center mb-60 style-5">
                        <h2 class="mb-20 color-000"> Crypto Trend 2023 </h2>
                        <small class="d-block date text">
                            <a href="#" class="text-uppercase border-end brd-gray pe-3 me-3 color-blue5 fw-bold"> news
                            </a>
                            <i class="bi bi-clock me-1"></i>
                            <span class="op-8">Posted on 15 Days ago</span>
                        </small>
                    </div> -->

                    <div class="content-card">
                        <div class="img">
                            <img src="photo/<?php echo @$cal->selectFrmDB($news,'post_image','blog_id',$_GET['b_id']);?>" alt="">
                        </div>
                        <div class="info">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="cont">
                                        <small class="date small mb-20"> <span
                                                class="text-uppercase border-end brd-gray pe-3 me-3"> News </span> <i
                                                class="far fa-clock me-1"></i> Posted on <?php echo @$cal->selectFrmDB($news,'date_post','blog_id',$_GET['b_id']);?> </small>
                                        <h2 class="title">
                                            <?php echo @$cal->selectFrmDB($news,'title','blog_id',$_GET['b_id']);?>
                                        </h2>
                                        <p class="fs-12px mt-10 text-light text-info">                               <?php echo @$bassic->reduceTextLength($cal->selectFrmDB($news,'news','blog_id',$_GET['b_id']),100);?>
                                        <p class="fs-12px mt-10 text-light text-info"> 
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row gx-4 gx-lg-5">
                    <div class="col-lg-8">
                        <div class="d-flex small align-items-center justify-content-between mb-70 fs-12px">
                            <div class="l_side d-flex align-items-center">
                                <a href="#" class="me-3 me-lg-5">
                                    <span
                                        class="icon-20 rounded-circle d-inline-flex justify-content-center align-items-center text-uppercase bg-main p-1 me-2 text-white">
                                        a
                                    </span>
                                    <span class="">
                                        By <?php echo @$cal->selectFrmDB($news,'admin_name','blog_id',$_GET['b_id']);?>
                                    </span>
                                </a>
                                <a href="#" class="me-3 me-lg-5">
                                    <i class="bi bi-chat-left-text me-1"></i>
                                    <span><?php print $sqli->countComments(@$cal->selectFrmDB($news,'blog_id','blog_id',$_GET['b_id']));?> Comments</span>
                                </a>
                                <a href="#">
                                    <i class="bi bi-eye me-1"></i>
                                    <span><?php echo @$cal->selectFrmDB($news,'views','blog_id',$_GET['b_id']);?> Views</span>
                                </a>
                            </div>
                            <div style="display: none;" class="r-side mt-1">
                                <a href="#">
                                    <i class="bi bi-info-circle me-1"></i>
                                    <span>Report</span>
                                </a>
                            </div>
                        </div>

                        <div class="blog-content-info">
                            <h4 class="fw-bold color-000 lh-4 mb-30"><?php echo @$cal->selectFrmDB($news,'title','blog_id',$_GET['b_id']);?></h4>
                            <div class="text mb-10 color-666">
                                <?php echo @$cal->selectFrmDB($news,'news','blog_id',$_GET['b_id']);?>
                            </div>
                            
                            <div class="blog-comments mt-70">

                                <div class="comments-content mt-70 pre-scrollable">
                                    <h3 class="color-000 mb-0">  Comments </h3>
                                    <div style="overflow: scroll; height: 300px; padding-right: 10px; padding-left: 10px;" class="comment-replay-cont border-bottom border-1 brd-gray pb-40 pt-40">

                                        <?php $sql = query_sql("SELECT * FROM $comments_tb WHERE `news_id`='".$_GET['b_id']."' ORDER BY id DESC  ");
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


                                <form method="post" enctype="multipart/form-data">
                                <h3 class="color-000 mb-40"> Leave A Comment </h3>
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

                    <div class="col-lg-4">
                        <div class="side-blog style-5 ps-lg-5 mt-5 mt-lg-0">
                            <form style="display: none;" action=""
                                class="search-form mb-50" method="post">
                                <h6 class="title mb-20 text-uppercase fw-normal">
                                    search
                                </h6>
                                <div class="form-group position-relative">
                                    <input type="text" class="form-control rounded-pill"
                                        placeholder="Type and hit enter">
                                    <button class="search-btn border-0 bg-transparent"> <i class="fas fa-search"></i>
                                    </button>
                                </div>
                            </form>

                            <div class="side-recent-post mb-50">
                                <h6 class="title mb-20 text-uppercase fw-normal">
                                    recent post
                                </h6>
                                
                                 <?php $sql = query_sql("SELECT * FROM $news ORDER BY id DESC LIMIT 10");
                    $i=1;
                    if(mysqli_num_rows($sql)>0){
                        while($row = mysqli_fetch_assoc($sql)){?>

                                <a href="blog-read?b_id=<?php print $row['blog_id'];?>" class="post-card pb-3 mb-3 border-bottom brd-gray">
                                    <div class="img me-3">
                                        <img src="photo/<?php print $row['post_image'];?>" alt="">
                                    </div>
                                    <div class="inf">
                                        <h6> <?php print $bassic->reduceLength($row['title'],30);?></h6>
                                        <p> <?php print $bassic->reduceLength($row['news'],50);?></p>
                                    </div>
                                </a>

                                <?php }}?>

                            </div>


                            <div class="side-newsletter mb-50">
                                <h6 class="title mb-10 text-uppercase fw-normal">
                                    newsletter
                                </h6>
                                <div class="text">
                                    Register now to get latest updates on promotions & coupons.
                                </div>
                                <form action=""
                                    class="form-subscribe" method="post" enctype="multipart/form-data">
                                    <div class="email-input d-flex align-items-center py-3 px-3 bg-white mt-3 radius-5">
                                        <span class="icon me-2 flex-shrink-0">
                                            <i class="far fa-envelope"></i>
                                        </span>
                                        <input type="email" name="email" placeholder="Email Address"
                                            class="border-0 bg-transparent fs-13px">
                                    </div>
                                    <button type="submit" name="subR"
                                        class="btn bg-blue5 sm-butn text-white hover-darkBlue w-100 mt-3 radius-5 py-3">
                                        <span>Subscribe</span>
                                    </button>
                                </form>
                            </div>

                            <div class="side-share mb-50">
                                <h6 class="title mb-20 text-uppercase fw-normal">
                                    social
                                </h6>

                                <a href="<?php print $siteTwitter;?>" class="social-icon">
                                    <i class="fab fa-twitter"></i>
                                </a>
                                <a href="<?php print $siteFacebook;?>" class="social-icon">
                                    <i class="fab fa-facebook-f"></i>
                                </a>
                                <a href="<?php print $siteInstagram;?>" class="social-icon">
                                    <i class="fab fa-instagram"></i>
                                </a>
                                <a href="<?php print $siteYoutube;?>" class="social-icon">
                                    <i class="fab fa-youtube"></i>
                                </a>
                                <a href="<?php print $siteLinkedin;?>" class="social-icon">
                                    <i class="fab fa-linkedin-in"></i>
                                </a>

                            </div>

                            <div class="side-insta mb-50">
                                <h6 class="title mb-20 text-uppercase fw-normal">
                                    our instagram
                                </h6>
                                <div class="d-flex justify-content-between flex-wrap">
                                    <a href="assets/img/blog/1.jpg" class="insta-img img-cover" data-fancybox="gallery">
                                        <img src="assets/img/blog/1.jpg" alt="">
                                        <i class="fab fa-instagram icon"></i>
                                    </a>
                                    <a href="assets/img/blog/10.png" class="insta-img img-cover"
                                        data-fancybox="gallery">
                                        <img src="assets/img/blog/10.png" alt="">
                                        <i class="fab fa-instagram icon"></i>
                                    </a>
                                    <a href="assets/img/blog/11.png" class="insta-img img-cover"
                                        data-fancybox="gallery">
                                        <img src="assets/img/blog/11.png" alt="">
                                        <i class="fab fa-instagram icon"></i>
                                    </a>
                                    <a href="assets/img/blog/12.png" class="insta-img img-cover"
                                        data-fancybox="gallery">
                                        <img src="assets/img/blog/12.png" alt="">
                                        <i class="fab fa-instagram icon"></i>
                                    </a>
                                    <a href="assets/img/blog/2.jpg" class="insta-img img-cover" data-fancybox="gallery">
                                        <img src="assets/img/blog/2.jpg" alt="">
                                        <i class="fab fa-instagram icon"></i>
                                    </a>
                                    <a href="assets/img/blog/3.jpg" class="insta-img img-cover" data-fancybox="gallery">
                                        <img src="assets/img/blog/3.jpg" alt="">
                                        <i class="fab fa-instagram icon"></i>
                                    </a>
                                </div>
                            </div>

                            <div class="side-tags">
                                <h6 class="title mb-20 text-uppercase fw-normal">
                                    popular tags
                                </h6>
                                <div class="content">
                                    <a href="#">WordPress</a>
                                    <a href="#">PHP</a>
                                    <a href="#">HTML/CSS</a>
                                    <a href="#">Figma</a>
                                    <a href="#">Technology</a>
                                    <a href="#">Marketing</a>
                                    <a href="#">Consultation</a>
                                    <a href="#">Seo</a>
                                    <a href="#">Envato</a>
                                    <a href="#">Psd</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- ====== end all-news ====== -->


        <!-- ====== start Popular Posts ====== -->
        <section class="popular-posts related Posts section-padding pb-100 bg-gray5">
            <div class="container">
                <h5 class="fw-bold text-uppercase mb-50">Related Posts</h5>
                <div class="related-postes-slider position-relative">
                    <div class="swiper-container">
                        <div class="swiper-wrapper">

            <?php $sql = query_sql("SELECT * FROM $news ORDER BY RAND()  LIMIT 50");
                    $i=1;
                    if(mysqli_num_rows($sql)>0){
                        while($row = mysqli_fetch_assoc($sql)){?>
                            <div class="swiper-slide">
                                <div class="card border-0 bg-transparent rounded-0 p-0  d-block">
                                    <a href="page-single-post-5.html" class="img radius-7 overflow-hidden img-cover">
                                        <img src="photo/<?php print $row['post_image'];?>" class="card-img-top" alt="...">
                                    </a>
                                    <div class="card-body px-0">
                                        <small class="d-block date mt-10 fs-10px fw-bold">
                                            <a href="blog-read?b_id=<?php print $row['blog_id'];?>"
                                                class="text-uppercase border-end brd-gray pe-3 me-3 color-blue5">News</a>
                                            <i class="bi bi-clock me-1"></i>
                                            <a href="blog-read?b_id=<?php print $row['blog_id'];?>" class="op-8"><?php print $row['date_post'];?></a>
                                        </small>
                                        <h5 class="fw-bold mt-10 title">
                                            <a href="blog-read?b_id=<?php print $row['blog_id'];?>"><?php print $row['title'];?></a>
                                        </h5>
                                        <p class="small mt-2 op-8"><?php print $bassic->reduceLength($row['news'],100);?>
                                        </p>
                                        <div class="d-flex small mt-20 align-items-center justify-content-between op-9">
                                            <div class="l_side d-flex align-items-center">
                                                <span
                                                    class="icon-20 rounded-circle d-inline-flex justify-content-center align-items-center text-uppercase bg-main p-1 me-2 text-white">
                                                    a
                                                </span>
                                                <a href="blog-read?b_id=<?php print $row['blog_id'];?>" class="mt-1">
                                                    By <?php print $row['admin_name'];?>
                                                </a>
                                            </div>
                                            <div class="r-side mt-1">
                                                <i class="bi bi-chat-left-text me-1"></i>
                                                <a href="blog-read?b_id=<?php print $row['blog_id'];?>"><?php print $sqli->countComments($row['blog_id']);?></a>
                                                <i class="bi bi-eye ms-4 me-1"></i>
                                                <a href="blog-read?b_id=<?php print $row['blog_id'];?>"><?php print number_format($row['views']);?></a>
                                            </div>
                                        </div>
                                    </div>
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
        <!-- ====== end Popular Posts ====== -->

    </main>
    <!--End-Contents-->

    <?php require_once('footer.php'); ?>