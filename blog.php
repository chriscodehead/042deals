<?php
require_once('include.php');
$title = 'Blog ' . $siteName;
$description = 'Stay connected on the go with our selection of smartphones and accessories. We offer the latest models from top brands, as well as a range of charging and protection options.';
$keyword = 'gadgets, laptops, smartphones, tablets, accessories, electronics, technology, bags, backpacks, luggage, travel gear, suitcases, carry-ons, duffel, bags, rolling bags, travel accessories, portable chargers, earbuds, headphones, cameras';
$active4 = "active";
$imageLink = 'img/logo-main.png';
require_once('head.php');

if (isset($_POST['sub'])) {
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

if (isset($_GET['page'])) {
    $page = $_GET['page'];
} else {
    $page = 1;
}

$no_of_records_per_page = 20;
$offset = ($page-1) * $no_of_records_per_page;


$total_pages_sql = "SELECT COUNT(*) FROM $news";
$result = query_sql($total_pages_sql);
$total_rows = mysqli_fetch_array($result)[0];
$total_pages = ceil($total_rows / $no_of_records_per_page);
?>

<body>
    <?php require_once("header.php")?>

    <main class="blog-page style-5">

        <section class="blog-slider pt-50 pb-50 style-1">
            <div class="container">

                <div class="blog-details-slider">
                    <div class="swiper-container">
                        <div class="swiper-wrapper">

                        <?php $sql = query_sql("SELECT * FROM $news ORDER BY id DESC LIMIT 3");
                                        $i=1;
                                    if(mysqli_num_rows($sql)>0){
                                      while($row = mysqli_fetch_assoc($sql)){?>

                            <div class="swiper-slide">
                                <div class="content-card">
                                    <div class="img overlay">
                                        <img src="photo/<?php print $row['post_image'];?>" alt="">
                                    </div>
                                    <div class="info">
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="cont">
                                                    <small class="date small mb-20"> <a href="blog-read?b_id=<?php print $row['blog_id'];?>"
                                                            class="text-uppercase border-end brd-gray pe-3 me-3"> News
                                                        </a> <i class="far fa-clock me-1"></i> Posted on <a href="blog-read?b_id=<?php print $row['blog_id'];?>"><?php print $row['date_post'];?></a> </small>
                                                    <h2 class="title">
                                                        <a href="blog-read?b_id=<?php print $row['blog_id'];?>"><?php print $row['title'];?></a>
                                                    </h2>
                                                    <p class="fs-13px mt-10 text-light text-info">
                                                    <?php print $bassic->reduceLength($row['news'],100);?></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <?php }}?>


                        </div>
                    </div>

                    <!-- ====== pagination ====== -->
                    <div class="swiper-pagination"></div>
                    <!-- ====== arrows ====== -->
                    <div class="swiper-button-next"></div>
                    <div class="swiper-button-prev"></div>
                </div>
            </div>
        </section>
        <!-- ====== end blog-slider ====== -->


        <!-- ====== start Popular Posts ====== -->
        <section class="popular-posts pt-50 pb-100 border-bottom brd-gray">
            <div class="container">
                <h5 class="post-sc-title text-center text-uppercase mb-70">Popular Posts</h5>
                <div class="row gx-5">
                
                <?php $sql = query_sql("SELECT * FROM $news ORDER BY RAND()  LIMIT 3");
                    $i=1;
                    if(mysqli_num_rows($sql)>0){
                        while($row = mysqli_fetch_assoc($sql)){?>

                    <div class="col-lg-4 border-end brd-gray">
                        <div class="card border-0 bg-transparent rounded-0 mb-30 mb-lg-0 d-block">
                            <div class="img radius-7 overflow-hidden img-cover">
                                <img src="photo/<?php print $row['post_image'];?>" class="card-img-top" alt="...">
                            </div>
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
                                <p class="small mt-2 op-8 fs-10px"><?php print $bassic->reduceLength($row['news'],100);?>
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
        </section>
        <!-- ====== end Popular Posts ====== -->


        <!-- ====== start all-news ====== -->
        <section class="all-news section-padding blog bg-transparent style-3">
            <div class="container">
                <div class="row gx-4 gx-lg-5">
                    <div class="col-lg-8">

                    <?php $sql = query_sql("SELECT * FROM $news ORDER BY id DESC LIMIT $offset, $no_of_records_per_page");
                                        $i=1;
                                    if(mysqli_num_rows($sql)>0){
                                      while($row = mysqli_fetch_assoc($sql)){?>
                        <div class="card border-0 bg-transparent rounded-0 border-bottom brd-gray pb-30 mb-30">
                            <div class="row">
                                <div class="col-lg-5">
                                    <div class="img img-cover">
                                        <img src="photo/<?php print $row['post_image'];?>" class="radius-7" alt="...">
                                    </div>
                                </div>
                                <div class="col-lg-7">
                                    <div class="card-body p-0">
                                        <small class="d-block date text">
                                            <a href="blog-read?b_id=<?php print $row['blog_id'];?>"
                                                class="text-uppercase border-end brd-gray pe-3 me-3 color-blue5 fw-bold">
                                                news </a>
                                            <i class="bi bi-clock me-1"></i>
                                            <a href="blog-read?b_id=<?php print $row['blog_id'];?>" class="op-8"><?php print $row['date_post'];?></a>
                                        </small>
                                        <a href="blog-read?b_id=<?php print $row['blog_id'];?>" class="card-title mb-10"><?php print $row['title'];?></a>
                                        
                                        <p class="fs-13px color-666"><?php print $bassic->reduceLength($row['news'],100);?></p>
                                        <div
                                            class="auther-comments d-flex small align-items-center justify-content-between op-9">
                                            <div class="l_side d-flex align-items-center">
                                                <span
                                                    class="icon-10 rounded-circle d-inline-flex justify-content-center align-items-center text-uppercase bg-blue5 p-2 me-2 text-white">
                                                    a
                                                </span>
                                                <a href="blog-read?b_id=<?php print $row['blog_id'];?>">
                                                    <small class="text-muted">By</small> <?php print $row['admin_name'];?>
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
                        </div>

                        <?php }}?>

                        

                        <div class="pagination style-5 color-5 justify-content-center mt-60">

                            <a class="<?php if($page <= 1){ echo 'disabled'; } ?>" href="<?php if($page <= 1){ echo '#'; } else { echo "?page=".($page - 1); } ?>">
                                <span class="text"><i class="fas fa-chevron-left"></i> Prev</span>
                            </a>
                            <a href="?page=1" class="active">
                                <span>1</span>
                            </a>
                            <a href="#">
                                <span>...</span>
                            </a>
                            <a href="?page=<?php echo $total_pages; ?>">
                                <span>Last</span>
                            </a>
                            <a class="<?php if($page >= $total_pages){ echo 'disabled'; } ?>" href="<?php if($page >= $total_pages){ echo '#'; } else { echo "?page=".($page + 1); } ?>">
                                <span class="text">next <i class="fas fa-chevron-right"></i> </span>
                            </a>

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

                            <div style="display: none;" class="side-categories mb-50">
                                <h6 class="title mb-20 text-uppercase fw-normal">
                                    categories
                                </h6>

                                <a href="#" class="cat-item">
                                    <span> all </span>
                                    <span> 265 </span>
                                </a>
                                
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
                                    <button type="submit" name="sub"
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

    </main>

    <?php require_once('footer.php'); ?>