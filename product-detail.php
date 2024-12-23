<?php
    include_once ("db.php");
    if(isset($_GET['prd_id'])){
        $prd_id = $_GET['prd_id'];
        $sqlProductDetail = "SELECT * FROM products WHERE prd_id = $prd_id";
        $queryProductDetail = mysqli_query($conn, $sqlProductDetail);
        if(mysqli_num_rows($queryProductDetail) > 0){
            $productDetail = mysqli_fetch_assoc($queryProductDetail);
        }else{
            header("Location: index.php");
        }
    }else{
        header("Location: index.php");
    }
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <title>Product</title>
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/home.css">
    <link rel="stylesheet" href="css/product.css">
    <script src="js/jquery-3.3.1.js"></script>
    <script src="js/bootstrap.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" />
</head>

<body>

    <!--	Header	-->
    <div id="header">
        <div class="container">
            <div class="row">
                <div id="logo" class="col-lg-3 col-md-3 col-sm-12">
                    <h1><a href="index.php"><img class="img-fluid" src="">Parrot Store</a></h1>
                </div>
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
                    <nav>
                        <div id="menu" class="collapse navbar-collapse">
                            <?php
                            include_once("common/menu.php")
                            ?>
                        </div>
                    </nav>
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
                                <img src="images/slide/slide-1.png" alt="Parrot Store">
                            </div>
                            <div class="carousel-item">
                                <img src="images/slide/slide-2.png" alt="Parrot Store">
                            </div>
                            <div class="carousel-item">
                                <img src="images/slide/slide-3.png" alt="Parrot Store">
                            </div>
                            <div class="carousel-item">
                                <img src="images/slide/slide-4.png" alt="Parrot Store">
                            </div>
                            <div class="carousel-item">
                                <img src="images/slide/slide-5.png" alt="Parrot Store">
                            </div>
                            <div class="carousel-item">
                                <img src="images/slide/slide-6.png" alt="Parrot Store">
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

                    <!--	List Product	-->
                    <div id="product">
                        <div id="product-head" class="row">
                            <div id="product-img" class="col-lg-6 col-md-6 col-sm-12">
                                <img src="images/New Product Images/<?php echo $productDetail['prd_image']; ?>">
                            </div>
                            <div id="product-details" class="col-lg-6 col-md-6 col-sm-12">
                                <h1><?php echo $productDetail['prd_name']; ?></h1>
                                <ul>
                                    <li><span>Warranty:</span><?php echo $productDetail['prd_warranty']; ?></li>
                                    <li><span>Accessories:</span><?php echo $productDetail['prd_accessories'] ?></li>
                                    <li><span>Status:</span><?php echo $productDetail['prd_new'] ?></li>
                                    <li><span>Promotion:</span><?php echo $productDetail['prd_promotion'] ?></li>
                                    <li id="price">Price (VAT not included):</li>
                                    <li id="price-number"><?php echo number_format($productDetail['prd_price'],0,'.',',') ?> VND</li>
                                    <li id="status">
                                        <?php
                                            if($productDetail['prd_status'] == 1){
                                                echo "Stocking";
                                            }else{
                                                echo "Out of Stock";
                                            }
                                        ?>
                                    </li>
                                </ul>
                                <div id="add-cart"><a href="cart.php">Buy Now</a></div>
                            </div>
                        </div>
                        <div id="product-body" class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <h3>Review about <?php echo $productDetail['prd_name']; ?></h3>
                                <?php echo $productDetail['prd_details'] ?>
                            </div>
                        </div>

                        <!--	Comment	-->
                        <div id="comment" class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <h3>Comment</h3>
                                <form method="post">
                                    <div class="form-group">
                                        <label>Name:</label>
                                        <input name="comm_name" required type="text" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label>Email:</label>
                                        <input name="comm_mail" required type="email" class="form-control" id="pwd">
                                    </div>
                                    <div class="form-group">
                                        <label>Content:</label>
                                        <textarea name="comm_details" required rows="8" class="form-control"></textarea>
                                    </div>
                                    <button type="submit" name="sbm" class="btn btn-primary">Send</button>
                                </form>
                            </div>
                        </div>
                        <!--	End Comment	-->

                        <!--	Comments List	-->
                        <div id="comments-list" class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <div class="comment-item">
                                </div>
                            </div>
                        </div>
                        <!--	End Comments List	-->
                    </div>
                    <!--	End Product	-->
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