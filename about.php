<?php
require_once('include.php');
$title = 'About ' . $siteName;
$description = 'Shop for the best tech gadgets and travel gear at our online store. We carry a variety of electronics, including laptops, smartphones, cameras, and more.';
$keyword = 'tech gadgets, gaming laptops, business laptops, 2-in-1 laptops, ultrabooks, gaming smartphones, camera phones, smartwatches, fitness trackers, wireless earbuds, noise-cancelling headphones, power banks, laptop sleeves';
$active2 = "active";
$imageLink = 'img/logo-main.png';
require_once('head.php'); ?>

<body>

    <?php require_once("header.php")?>

    <section class="inner-header style-5" style="background-image: url(img/pexels-karol-d-325153.jpg);">
        <div class="container">
            <div class="content">
                <div class="links">
                    <a class="text-white" href="./"> Home </a>
                    <a class="text-white" href="#"> About Us </a>
                </div>
                <h2 class="text-white"> About </h2>
                <img src="assets/img/header/head7_rock.png" alt="" class="side-img slide_up_down">
            </div>
        </div>
    </section>
    
    <main class="about-page style-2">

        <!-- ====== start careers-features ====== -->
        <section class="about style-2 section-padding">
            <div class="container">
                <div class="row align-items-center">

                    <div style="margin-bottom: 30px;" class="col-lg-6">
                        <div class="info px-lg-5">
                            <div class="section-head style-5 mb-40">
                                <h3 class="mb-20"> <span style="font-size: 50px;"><?php print $siteName;?></span> <span> for your Laptop's, Travelling Bag's and Phones </span> </h3>
                            </div>
                            <ul class="nav nav-pills" id="pills-tab" role="tablist">
                                
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="abt2-tab" data-bs-toggle="pill" data-bs-target="#abt2"
                                        type="button" role="tab" aria-controls="pills-profile" aria-selected="false">
                                        Our vision
                                    </button>
                                </li>
                                
                            </ul>
                            <div class="tab-content" id="pills-tabContent">

                                <div class="tab-pane fade show active" id="abt2" role="tabpanel">
                                    <p class="text"> At our company, our vision is to become the go-to destination for all things tech and travel. We aim to provide our customers with a one-stop-shop for the latest and greatest gadgets, phones, laptops, and travel bags, all while offering an exceptional shopping experience.
                                    </p><p class="text">
                                    Ultimately, our vision is to be the go-to destination for tech and travel enthusiasts around the world, offering a seamless shopping experience and unparalleled selection of products. We are committed to achieving this vision through hard work, dedication, and a relentless focus on our customers. </p>
                                    <div class="d-flex align-items-center mt-40">
                                        <div class="btns">
                                            <a href="contact"
                                                class="btn rounded-pill blue5-3Dbutn hover-blue2 sm-butn fw-bold">
                                                <span> Join Us </span>
                                            </a>
                                        </div>
                                        <div class="inf ms-3">
                                            <p class="color-999"> Support Email </p>
                                            <a href="mailto:<?php print $siteEmail;?>" class="fw-bold color-000"><?php print $siteEmail; ?> </a>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="img img-cover">
                            <img src="img/codeheadafrica-student-with-smartphone.jpg" alt="">
                        </div>
                    </div>

                    <div class="container">
                        <div class="row">
                            <div style="margin-top: 50px;" class="col-lg-12 info px-lg-5">
                            <h3 class="mb-20"> <span style="font-size: 50px;">About us</span> </h3>
                                <p class="text text-justify">Welcome to <?php print $siteName;?>, where we provide the latest and greatest gadgets, phones, laptops, and travelling bags to our customers. Whether you are a tech-savvy individual, a frequent traveler, or just looking for high-quality products to make your life easier, we have something for everyone.
                                </p>
                                <p class="text text-justify">
                                Our gadget section includes the latest smartphones, tablets, smartwatches, and other tech accessories. We carry a variety of brands, including Apple, Samsung, Google, and more. Our team of experts carefully selects each product to ensure that they meet our high standards for quality and performance.
                                </p><p class="text text-justify">
                                For those in need of a new laptop, we offer a wide selection of models from some of the top brands in the industry, including HP, Dell, Lenovo, and more. Whether you need a laptop for work, school, or personal use, we have options that will suit your needs.
                                </p><p class="text text-justify">
                                If you are a frequent traveler, then you know the importance of having a durable and reliable travel bag. That's why we offer a wide range of high-quality travel bags, backpacks, and suitcases to help you stay organized and comfortable on your journeys. We carry top brands such as Samsonite, Tumi, and American Tourister.
                                </p><p class="text text-justify">
                                At <?php print $siteName;?>, we are dedicated to providing our customers with the best possible shopping experience. That's why we offer fast and reliable shipping, easy returns and exchanges, and excellent customer service. We also regularly update our inventory to ensure that we are always offering the latest and greatest products.
                                </p><p class="text text-justify">
                                Thank you for visiting <?php print $siteName;?>, and we look forward to helping you find the perfect gadget, phone, laptop, or travel bag to suit your needs.</p>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </section>
      
    </main>

    <?php require_once('footer.php'); ?>