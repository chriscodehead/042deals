<?php
require_once('include.php');
$title = $siteName.' | Enugu Online Store for Laptops, Phones, Travelling Bags';
$description = 'Discover the best in tech and travel at our online store. We offer a wide range of products, including smartphones, tablets, backpacks, luggage, and more. Shop now to find the perfect gear for your next adventure.';
$keyword = 'gadgets, laptops, smartphones, tablets, accessories, electronics, technology, bags, backpacks, luggage, travel gear, suitcases, carry-ons, duffel, bags, rolling bags, travel accessories, portable chargers, earbuds, headphones, cameras';
$active3 = "active";
$imageLink = 'img/logo-main.png';
require_once('head.php'); 
if(isset($_GET['prd'])&&!empty($_GET['prd'])){$p_cat = $_GET['prd'];}else{header('location:./');}

if (isset($_GET['page'])) {
    $page = $_GET['page'];
} else {
    $page = 1;
}

$no_of_records_per_page = 100;
$offset = ($page-1) * $no_of_records_per_page;


$total_pages_sql = "SELECT COUNT(*) FROM $product";
$result = query_sql($total_pages_sql);
$total_rows = mysqli_fetch_array($result)[0];
$total_pages = ceil($total_rows / $no_of_records_per_page);
?>

<body>
    
    <?php require_once("header.php")?>
    
    <!--Contents-->
    <main class="shop-page style-5 style-grad">
        <!-- ====== start shop page ====== -->
        <section class="shop section-padding pt-50">
            <div class="container">

                <div class="section-head text-center style-4">
                    <h2 class="mb-20"><?php print $siteName;?>  <span> Store </span> </h2>
                    <div class="page-links color-999">
                        <a href="./" class="me-2">
                            Home
                        </a>
                        <span class="me-2">/</span>
                        <a href="./" class="color-000">
                            <?php print $siteName;?> Store
                        </a>
                    </div>
                </div>

                <div class="row gx-4">

                    

                    <div class="col-lg-9 pb-15">
                        <div class="products-content">
                            <div class="top-filter mb-10">
                                <div class="row align-items-center">
                                    <div class="col-lg-6">
                                        <p class="color-999 fs-12px mb-3 mb-lg-0"> <span class="color-000">Page: <?php print @$page;?> - <?php print @$total_pages;?></span> of <?php print $total_rows;?> results</p>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="r-side">
                                            <div class="row align-items-center">
                                                <div class="col-8">
                                                    <form action="" class="form" method="post">
                                                        <div style="display: none;" class="form-group">
                                                            <label >Sort by</label>
                                                            <select class="form-select">
                                                                <option value="" selected >Default</option>
                                                                <option value="">best seller</option>
                                                                <option value="">new products</option>
                                                                <option value="">Default</option>
                                                            </select>
                                                        </div>
                                                    </form>
                                                </div>
                                                <div class="col-4">
                                                    <div class="grid-list-btns">
                                                        <span class="grid-btn bttn active">
                                                            <i class="bi bi-grid-3x3"></i>
                                                        </span>
                                                        <span class="list-btn bttn">
                                                            <i class="bi bi-list-task"></i>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="products">
                                <div class="row gx-2 gx-lg-4">

                                <?php $sql = query_sql("SELECT * FROM $product WHERE `product_category`='".$p_cat."' ORDER BY id DESC LIMIT $offset, $no_of_records_per_page");
                                        $i=1;
                                    if(mysqli_num_rows($sql)>0){
                                      while($row = mysqli_fetch_assoc($sql)){?>

                                    <div title="<?php print $row['title'];?>" class="col-6 col-lg-3 card-width">
                                     
                                        <div class="product-card">
                                            <div class="img">
                                                <img src="productimage/<?php print $row['image'];?>" alt="">
                                                <span class="label new">new</span>
                                                <span class="fav-btn active"> <i class="fas fa-heart"></i> </span>
                                            </div>
                                            <div class="info">
                                                <h6 class="category"><?php print $row['product_brand'];?></h6>
                                                <a href="product-details?p_id=<?php print $row['trn_id'];?>">
                                                <h5 title="<?php print $row['title'];?>" class="title"><?php print $bassic->reduceTextLength($row['title'],40);?></h5></a>
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

                                            <a href="product-details?p_id=<?php print $row['trn_id'];?>" class="btn rounded-pill mt-20">
                                                <span>Add To Cart</span>
                                            </a>
                                        </div>
                                        
                                    </div>

                                     <?php }}?>

                                    

                                </div>
                                <div class="pagination style-5 color-4 justify-content-center mt-50">
                                    
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
                        </div>
                    </div>

                    <div class="col-lg-3">
                        <div class="filter">
                            <div class="filter-card mb-30">
                                <div class="card-title">
                                    <span>Categories</span>
                                </div>
                                <div class="form-check category-checkRadio">
                                    <input class="form-check-input" type="radio" name="category" id="category1">
                                    <label class="form-check-label cat-link" for="category1">
                                        All Categories
                                    </label>
                                </div>

                                <?php $sql = query_sql("SELECT * FROM $cat_tb ORDER BY id DESC");
                                        $i=1;
                                    if(mysqli_num_rows($sql)>0){
                                      while($row = mysqli_fetch_assoc($sql)){?>

                                    <a href="product-category?prd=<?php print $row['p_id'];?>">
                                        <div style="width: 200px" class="form-check category-checkRadio">
                                            <label class="form-check-label cat-link" for="category2">
                                                <?php print $row['title'];?>
                                            </label>
                                        </div>
                                    </a>

                                <?php }}?>
                                
                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </section>
        <!-- ====== end shop page ====== -->
    </main>
    <!--End-Contents-->

    <!-- ====== start footer ====== -->
    <?php require_once("footer.php");?>