<footer class="style-4 mt-0 pt-100">
        <div class="container">
            <div class="section-head text-center style-4">
                <h2 class="mb-10"> Connect with us <span> </span> </h2>
                <p>Discover your new favorite stores, easy and trusted vendor. Chat with our representative.</p>
                <div class="d-flex align-items-center justify-content-center mt-50">
                    <a href="<?php print $siteWhatsApp;?>" class="btn rounded-pill bg-blue4 fw-bold text-white me-4" target="_blank">
                        <small> <i class="fab fa-whatsapp me-2 pe-2 border-end"></i> Chat On WhatsApp </small>
                    </a>
                    <a href="<?php print $siteTelegram;?>" class="btn rounded-pill hover-blue4 fw-bold border-blue4" target="_blank">
                        <small> <i class="fab fa-telegram me-2 pe-2 border-end"></i> Join Telegram </small>
                    </a>
                </div>
            </div>
            <div class="foot mt-80">
                <div class="row align-items-center">
                    <div class="col-lg-2">
                        <div class="logo">
                            <img src="img/logo.png" alt="">
                        </div>
                    </div>
                    <div class="col-lg-8">
                        <ul class="links">
                            <li>
                                <a href="./" class="active">Home</a>
                            </li>
                            <li>
                                <a href="about">About</a>
                            </li>
                            <li>
                                <a href="blog">Blog</a>
                            </li>
                            <!-- <li>
                                <a href="disclaimer">Disclaimer</a>
                            </li> -->
                            <li>
                                <a href="contact">Contact</a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-lg-2">
                        <div class="dropdown">
                            <button class="icon-25 dropdown-toggle p-0 border-0 bg-transparent rounded-circle img-cover" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                <img src="assets/img/lang.png" alt="" class="me-2">
                                <small>English</small>
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                <li><a class="dropdown-item" href="#">English</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="copywrite text-center">
                <small class="small">
                    © <?php print $siteYear;?> Copyrights by <a href="./" class="fw-bold text-decoration-underline"><?php print $siteName;?>.</a> All Rights Reserved.  <a href="https://centadesk.com" class="fw-bold text-decoration-underline">Powered by Centadesk Global Services</a>
                </small>
            </div>
        </div>
    </footer>
 
    <a href="#" class="to_top bg-gray rounded-circle icon-40 d-inline-flex align-items-center justify-content-center">
        <i class="bi bi-chevron-up fs-6 text-dark"></i>
    </a>

    <script src="assets/js/lib/jquery-3.0.0.min.js"></script>
    <script src="assets/js/lib/jquery-migrate-3.0.0.min.js"></script>
    <script src="assets/js/lib/bootstrap.bundle.min.js"></script>
    <script src="assets/js/lib/jquery-ui.min.js"></script>
    <script src="assets/js/lib/slider-mob-touch.js"></script>
    <script src="assets/js/lib/wow.min.js"></script>
    <script src="assets/js/lib/jquery.fancybox.js"></script>
    <script src="assets/js/lib/lity.js"></script>
    <script src="assets/js/lib/swiper.min.js"></script>
    <script src="assets/js/lib/jquery.waypoints.min.js"></script>
    <script src="assets/js/lib/jquery.counterup.js"></script>
    <script src="assets/js/lib/pace.js"></script>
    <script src="assets/js/lib/scrollIt.min.js"></script>
    <script src="assets/js/main.js"></script>

    <script>
    var url = 'https://wati-integration-service.clare.ai/ShopifyWidget/shopifyWidget.js?1816';
    var s = document.createElement('script');
    s.type = 'text/javascript';
    s.async = true;
    s.src = url;
    var options = {
  "enabled":true,
  "chatButtonSetting":{
      "backgroundColor":"#4dc247",
      "ctaText":"",
      "borderRadius":"25",
      "marginLeft":"0",
      "marginBottom":"50",
      "marginRight":"50",
      "position":"right"
  },
  "brandSetting":{
      "brandName":"042 Gadget’s Store",
      "brandSubTitle":"Typically replies within a day",
      "brandImg":"img/logo-main-white.png",
      "welcomeText":"Hi there!\nHow can I help you?",
      "messageText":"Hello, I have a question about {{page_link}}",
      "backgroundColor":"#0a5f54",
      "ctaText":"Start Chat",
      "borderRadius":"25",
      "autoShow":false,
      "phoneNumber":"2348035249716"
  }
};
    s.onload = function() {
        CreateWhatsappChatWidget(options);
    };
    var x = document.getElementsByTagName('script')[0];
    x.parentNode.insertBefore(s, x);
</script>

</body>
</html>