<!-- <div id="preloader"></div> -->
    <div class="top-navbar style-4">
        <div class="container">
            <div class="content text-white">
                <span class="btn sm-butn bg-white py-0 px-2 me-2 fs-10px">
                    <small class="fs-10px">Special</small>
                </span>
                <img src="assets/img/icons/nav_icon/imoj_heart.png" alt="" class="icon-15">
                <span class="fs-10px op-6">Get </span>
                <small class="op-10 fs-10px">20% Discount</small>
                <span class="fs-10px op-6">Place your orders now</span>
                <a href="<?php print $siteWhatsApp;?>" class="fs-10px text-decoration-underline ms-2">Get offer</a> <i class="fab fa-whatsapp"></i>
            </div>
        </div>
    </div>
    <!-- ====== end top navbar ====== -->

    <!-- ====== start navbar ====== -->
    <nav class="navbar navbar-expand-lg navbar-light style-4">
        <div class="container">
            <a class="navbar-brand" href="./">
                <img src="img/logo.png" alt="">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav m-auto mb-2 mb-lg-0 text-uppercase">
                    <li class="nav-item">
                        <a class="nav-link <?php print @$active1;?>" href="./" role="button" aria-expanded="false">
                            Home
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php print @$active2;?>" href="about">
                            About
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle <?php print @$active3;?>" href="#" id="navbarDropdown2" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            Categories
                            <small class="hot alert-danger text-danger">hot</small>
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown1">
                            <?php $sql = query_sql("SELECT * FROM $cat_tb ORDER BY id DESC");
                                        $i=1;
                                    if(mysqli_num_rows($sql)>0){
                                      while($row = mysqli_fetch_assoc($sql)){?>

                                          <li><a class="dropdown-item" href="product-category?prd=<?php print $row['p_id'];?>"><?php print $row['title'];?></a></li>

                                          <?php }}?>
                            
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php print @$active4;?>" href="blog">
                            blog
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php print @$active5;?>" href="contact">
                            <img src="assets/img/icons/nav_icon/price.png" alt="" class="icon-15 me-1">
                            contact
                        </a>
                    </li>
                </ul>
                <div class="nav-side">
                    <div class="d-flex align-items-center">
                        <a href="<?php print $siteWhatsApp;?>" class="search-icon me-4">
                            <i class="bi bi-whatsapp"></i>
                        </a>
                        <a href="<?php print $siteTelegram;?>" class="btn rounded-pill brd-gray hover-blue4 sm-butn fw-bold">
                            <span>Join Telegram <i class="bi bi-arrow-right ms-1"></i> </span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </nav>
    <!-- ====== end navbar ====== -->