<?php
include_once('db.php');
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>Home</title>
<link rel="stylesheet" href="css/bootstrap.css">
<link rel="stylesheet" href="css/home.css">
<script src="js/jquery-3.3.1.js"></script>
<script src="js/bootstrap.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" />
</head>
<body>

<!--	Header	-->
<div id="header">
	<div class="container">
    	<div class="row">
            	<h1><a class="navbar-brand" href="index.php"><span  style="color: red">Parrot </span>Store</a></h1>
            <div id="search" class="col-lg-6 col-md-6 col-sm-12">
                <form class="form-inline">
                    <input class="form-control mt-3" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-danger mt-3" type="submit">Search</button>
                </form>
            </div>
            <div id="cart" class="col-lg-3 col-md-3 col-sm-12">
            	<a class="mt-4 mr-2" href="#">Cart
                    <i class="fa-solid fa-cart-shopping cart-icon">
                    <span class="mt-3">1</span></i>
                </a>
            </div>
        </div>
    </div>
    <!-- Toggler/collapsibe Button -->
    <button class="navbar-toggler navbar-light" type="button" data-toggle="collapse" data-target="#menu">
    	<span class="navbar-toggler-icon"></span>
    </button>
</div>
<!--	End Header	-->

<!--	Body	-->
<div id="body">
	<div class="container">
    	<div class="row">
        	<div class="col-lg-12 col-md-12 col-sm-12">
            	<!-- Menu selection -->
                <?php
                    include_once("common/menu.php");
                ?>
            </div>
        </div>
        <div class="row">
        	<div id="main" class="col-lg-8 col-md-12 col-sm-12">
            	<!--	Slider	-->
                <div id="slide" class="carousel slide" data-ride="carousel">

                  <!-- Indicators -->
                  <ul class="carousel-indicators">
                    <li data-target="#slide" data-slide-to="0" class="active"></li>
                    <li data-target="#slide" data-slide-to="1"></li>
                    <li data-target="#slide" data-slide-to="2"></li>
                    <li data-target="#slide" data-slide-to="3"></li>
                    <li data-target="#slide" data-slide-to="4"></li>
                    <li data-target="#slide" data-slide-to="5"></li>
                  </ul>
                
                  <!-- The slideshow -->
                  <div class="carousel-inner">
                    <div class="carousel-item active">
                      <img src="images/slide/slide-1.png">
                    </div>
                    <div class="carousel-item">
                      <img src="images/slide/slide-2.png">
                    </div>
                     <div class="carousel-item">
                      <img src="images/slide/slide-3.png">
                    </div>
                     <div class="carousel-item">
                      <img src="images/slide/slide-4.png">
                    </div>
                     <div class="carousel-item">
                      <img src="images/slide/slide-5.png">
                    </div>
					<div class="carousel-item">
                      <img src="images/slide/slide-6.png">
                    </div>
                  </div>
                
                  <!-- Left and right controls -->
                  <a class="carousel-control-prev" href="#slide" data-slide="prev">
                    <span class="carousel-control-prev-icon"></span>
                  </a>
                  <a class="carousel-control-next" href="#slide" data-slide="next">
                    <span class="carousel-control-next-icon"></span>
                  </a>
                
                </div>
                <!--	End Slider	-->
                
                <!--	Feature Product	-->

                <?php
                    $sqlFeaturedProduct = "SELECT * FROM products WHERE prd_featured = 1 ORDER BY prd_id DESC LIMIT 6 ";
                    $queryFeaturedProduct = mysqli_query($conn, $sqlFeaturedProduct);
                ?>

                <div class="products">
                    <h3>Featured</h3>
                    <div class="product-list row">
                    <?php
                        if(mysqli_num_rows($queryFeaturedProduct)){
                            while($prdFeatured = mysqli_fetch_assoc($queryFeaturedProduct)){
                                
                    ?>
                        <div class="col-lg-4 col-md-6 col-sm-12 mx-product">
                            <div class="product-item card text-center">
                                <a href="product-detail.php?prd_id=<?php echo $prdFeatured['prd_id']; ?>">
                                    <img src="images/New Product Images/<?php echo $prdFeatured['prd_image']; ?>">
                                </a>
                                <h4><a href="product-detail.php?prd_id=<?php echo $prdFeatured['prd_id']; ?>"><?php echo $prdFeatured['prd_name']; ?></a></h4>
                                <p>Price: <span><?php echo number_format($prdFeatured['prd_price'])?></span></p>
                            </div>
                        </div>
                        <?php
                                }
                            }
                        ?>
                    </div>
                </div>
                <!--	End Feature Product	-->
                
                <!--	Latest Product	-->

                <?php
                    $sqlNewProduct = "SELECT * FROM products WHERE prd_new = 1 ORDER BY prd_id DESC LIMIT 6 ";
                    $queryNewProduct = mysqli_query($conn, $sqlNewProduct);
                ?>

                <div class="products">
                    <h3>Brand New</h3>
                    <div class="product-list row">
                        <?php
                            if(mysqli_num_rows($queryNewProduct)){
                                while($prdNew = mysqli_fetch_assoc($queryNewProduct)){
                                
                        ?>
                        <div class="col-lg-4 col-md-6 col-sm-12 mx-product">
                            <div class="product-item card text-center">
                                <a href="product-detail.php"><img src="images/New Product Images/<?php echo $prdNew['prd_image']; ?>"></a>
                                <h4><a href="product-detail.php"><img src="images/New Product Images/<?php echo $prdNew['prd_name']; ?>"></a></h4>
                                <p>Price: <span><?php echo number_format($prdNew['prd_price'],0,'.',',') ?></span></p>
                            </div>
                        </div>
                        <?php
                                }
                            }
                        ?>
                    </div>
                </div>
                <!--	End Latest Product	-->

                
            </div>
            
            <div id="sidebar" class="col-lg-4 col-md-12 col-sm-12">
            	<div id="banner">
                	<div class="banner-item">
                    	<a href="#"><img class="img-fluid" src="images/New Images/1d28a1126973499.6138818676947.png"></a>
                    </div>
                    <div class="banner-item">
                    	<a href="#"><img class="img-fluid" src="images/New Images/interactive-graphic-design-service-500x500.webp"></a>
                    </div>
                    <div class="banner-item">
                    	<a href="#"><img class="img-fluid" src="images/New Images/redb.jpg"></a>
                    </div>
                    <div class="banner-item">
                    	<a href="#"><img class="img-fluid" src="images/New Images/images.jpg"></a>
                    </div>
                    <div class="banner-item">
                    	<a href="#"><img class="img-fluid" src="images/banner/banner-5.png"></a>
                    </div>
                    <div class="banner-item">
                    	<a href="#"><img class="img-fluid" src="images/banner/banner-6.png"></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--	End Body	-->


<!--	Footer	-->
<div id="footer-bottom">
	<div class="container text-center">
    	<div class="row">
        	<div class="col-lg-12 col-md-12 col-sm-12">
            	<p>
                    2024 © <a href="https:https://www.facebook.com/DPawsParrot/">Parrot</a>. All rights reserved. Developed by <a href="admin/admin.php">Pham Anh Dung</a>.
                </p>
            </div>
        </div>
    </div>
</div>
<!--	End Footer	-->
</body>
</html>
