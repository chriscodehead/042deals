<?php
require_once('include.php');
$title = 'Contact Us ' . $siteName;
$description = 'Upgrade your work from home setup with our selection of laptops and accessories. We have models to fit every budget and use case, from basic browsing to high-powered gaming.';
$keyword = 'gadgets, laptops, smartphones, tablets, accessories, electronics, technology, bags, backpacks, luggage, travel gear, suitcases, carry-ons, duffel, bags, rolling bags, travel accessories, portable chargers, earbuds, headphones, cameras';
$active5 = "active";
$imageLink = 'img/logo-main.png';
require_once('head.php'); ?>

<body>

   <?php require_once("header.php")?>

    <section class="inner-header style-5" style="background-image: url(img/gadgets-phone-travelling-bags-enugu-nigeria.jpeg);">
        <div class="container">
            <div class="content">
                <div class="links">
                    <a class="text-white" href="./"> Home </a>
                    <a class="text-white" href="#"> Contact Us </a>
                </div>
                <h2 class="text-white"> Contact Us </h2>
                <img src="assets/img/header/head7_rock.png" alt="" class="side-img slide_up_down">
            </div>
        </div>
    </section>
   
    <main class="contact-page style-5">

        <section class="community section-padding style-5">
            <div class="container">

                <div class="content rounded-pill">
                    <div class="commun-card">
                        <div class="icon icon-45">
                            <img src="assets/img/icons/mail3d.png" alt="">
                        </div>
                        <div class="inf">
                            <h5><?php print $siteEmail;?> </h5>
                        </div>
                    </div>
                    <div class="commun-card">
                        <div class="icon icon-45">
                            <img src="assets/img/icons/map3d.png" alt="">
                        </div>
                        <div class="inf">
                            <h5><?php print $siteAddress;?></h5>
                        </div>
                    </div>
                    <div class="commun-card">
                        <div class="icon icon-45">
                            <img src="assets/img/icons/msg3d.png" alt="">
                        </div>
                        <div class="inf">
                            <h5><?php print $sitePhone;?></h5>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="contact section-padding pt-0 style-6">
            <div class="container">
                <div class="content">
                    <div class="row justify-content-center">
                        <div class="col-lg-8">
                            <!-- <form style="display: none;" action="https://smartinnovates.com/items/iteck/html/contact.php" class="form"
                                method="post">
                                <p class="text-center text-danger fs-12px mb-30">The field is required mark as *</p>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group mb-20">
                                            <input type="text" name="name" class="form-control" placeholder="Name">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group mb-20">
                                            <input type="text" name="email" class="form-control"
                                                placeholder="Email Address *">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group mb-20">
                                            <input type="text" name="phone" class="form-control"
                                                placeholder="Phone Number (option)">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group mb-20">
                                            <input type="text" name="website" class="form-control"
                                                placeholder="Your Website (option)">
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group mb-20">
                                            <select name="option" class="form-select">
                                                <option value="how can we help" selected>How can we help you?</option>
                                                <option value="option 1">option 1</option>
                                                <option value="option 2">option 2</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <textarea rows="10" class="form-control"
                                                placeholder="How can we help you?"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 text-center">
                                        <div class="form-check d-inline-flex mt-30 mb-30">
                                            <input class="form-check-input me-2 mt-0" type="checkbox" value=""
                                                id="flexCheckDefault">
                                            <label class="form-check-label small" for="flexCheckDefault">
                                                By submitting, i’m agreed to the <a href="#"
                                                    class="text-decoration-underline">Terms & Conditons</a>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 text-center">
                                        <input type="submit" value="Send Your Request"
                                            class="btn rounded-pill bg-blue4 fw-bold text-white text-light fs-12px">
                                    </div>
                                </div>
                            </form> -->
                            <div class="col-lg-12 text-center">
                                        <a href="<?php print $siteWhatsApp;?>"><input type="submit" value="Send Your Request"
                                            class="btn rounded-pill bg-blue4 fw-bold text-white text-light fs-12px"></a>

                                            <a href="<?php print $siteTelegram;?>"><input type="submit" value="Join our Telegram Group"
                                            class="btn rounded-pill bg-blue4 fw-bold text-white text-light fs-12px"></a>
                                    </div>
                        </div>
                    </div>
                    <img src="assets/img/icons/contact_a.png" alt="" class="contact_a">
                    <img src="assets/img/icons/contact_message.png" alt="" class="contact_message">
                </div>
            </div>
        </section>
     
    </main>

    <?php require_once('footer.php'); ?>