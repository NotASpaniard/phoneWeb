<?php

include_once("db.php");
if (isset($_GET['cat_id'])) {
    $cat_id = $_GET['cat_id'];

    // Lấy thông tin danh mục
    $queryCate = mysqli_query($conn, "SELECT * FROM category WHERE cat_id = $cat_id");
    $resultCate = mysqli_fetch_assoc($queryCate);

    // Lấy danh sách sản phẩm trang
    $limit = 9; // Số bản ghi trên 1 trang
    $sqlTotalRecords = "SELECT count(prd_id) AS total FROM products WHERE cat_id = $cat_id";
    $queryTotalRecords = mysqli_query($conn, $sqlTotalRecords);
    $result = mysqli_fetch_assoc($queryTotalRecords);
    $total_records = $result['total']; // Tổng số bản ghi
    $total_page = ceil($total_records / $limit); // Tổng số bản ghi

    if (isset($_GET['current_page'])) {
        $current_page = $_GET['current_page']; // Lấy trang trên đường dẫn
    } else {
        $current_page = 1; // Trường hợp không có thông tin trang trên đường dẫn thì mặc định sẽ là trang 1
    }
    // Trường hợp bấm nút "Trở về trang trước" ở trang 1
    if ($current_page < 1) {
        $current_page = 1;
    }
    // Trường hợp bấm nút "Trang sau" ở trang cuối
    if ($current_page > $total_page) {
        $current_page = $total_page;
    }

    // Tìm chỉ số $start
    $start = ($current_page - 1) * $limit;

    $sqlAllProducts = "SELECT * FROM products AS P
                        INNER JOIN category AS C
                        ON P.cat_id = C.cat_id
                        WHERE C.cat_id = $cat_id
                        ORDER BY prd_id";
    $queryAllProducts = mysqli_query($conn, $sqlAllProducts);
} else {
    header("Location: index.php");
}

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <title>Category</title>
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/home.css">
    <link rel="stylesheet" href="css/category.css">
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

                    <h1><a class="navbar-brand" href="index.php"><span  style="color: red">Parrot </span>Store</a></h1>
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
                            include_once("common/menu.php");
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
                      <img src="images/New Images/1d28a1126973499.6138818676947.png">
                    </div>
                    <div class="carousel-item">
                      <img src="images/New Images/images.jpg">
                    </div>
                     <div class="carousel-item">
                      <img src="images/New Images/interactive-graphic-design-service-500x500.webp">
                    </div>
                     <div class="carousel-item">
                      <img src="images/New Images/redb.jpg">
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
                    <div class="products">
                        <h3>Products</h3>
                        <div class="product-list row">

                            <?php
                        if (mysqli_num_rows($queryAllProducts)) {
                            while ($product = mysqli_fetch_assoc($queryAllProducts)) {

                        ?>

                            <div class="col-lg-4 col-md-6 col-sm-12 mx-product">
                                <div class="product-item card text-center">
                                    <a href="product-detail.php?prd_id=<?php echo $product['prd_id'] ?>"><img src="images/New Product Images/<?php echo $product['prd_image']; ?>"></a>
                                    <h4><a href="#"><?php echo $product['prd_name']; ?></a></h4>
                                    <p>Price: <span><?php echo $product['prd_price']; ?></span></p>
                                </div>
                            </div>

                            <?php
                            }
                        }
                            ?>

                        </div>
                    </div>
                    <!--	End List Product	-->

                    <div id="pagination">
                    <ul class="pagination">
                                <li class="page-item"><a class="page-link" href="#">&laquo;</a></li>

                                <?php
                                    if($current_page > 1 && $total_page > 1){
                                        $prev = $current_page;
                                        echo '<li class="page_item active"> <a class="page-link" href="category-product.php?cat_id='.$cat_id.'current_page="'.$prev.'> &laquo;</a> </li>';
                                    }
                                ?>
                                <?php
                                    for($i = 1; $i < $total_page; $i ++){
                                        if($i == $current_page){
                                            echo '<li class="page_item active"> <a class="page-link disable">'.$i.'  </a> </li>';
                                        }else{
                                            echo '<li class="page_item active"> <a class="page-link" href="category-product.php?cat_id='.$cat_id.'current_page=>'.$i.'"  </a> </li>';
                                        }
                                    }
                                ?>
                                <?php
                                    if($current_page < $total_page && $total_page > 1){
                                        $next = $current_page +1;
                                        echo '<li class="page_item active"> <a class="page-link" href="category-product.php?cat_id='.$cat_id.'current_page="'.$next.'> &raquo;</a> </li>';
                                    }
                                ?>

                            </ul>
                    </div>

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

    <!-- <div id="footer-top">
        <div class="container">
            <div class="row">
                <div id="logo-2" class="col-lg-3 col-md-6 col-sm-12">
                    <h2><a href="#"><img src="images/logo-webleaners-png.png"></a></h2>
                    <p>
                        <strong>Web Learners Academy</strong> Chúng tôi đào tạo chuyên sâu trong 2 lĩnh vực là Lập trình
                        Website & Mobile nhằm cung cấp cho thị trường CNTT Việt Nam những lập trình viên thực sự chất
                        lượng, có khả năng làm việc độc lập, cũng như Team Work ở mọi môi trường đòi hỏi sự chuyên
                        nghiệp cao.
                    </p>
                </div>
                <div id="address" class="col-lg-3 col-md-6 col-sm-12">
                    <h3>Địa chỉ</h3>
                    <p>Hưng Thịnh - Yên Sở Hoàng Mai - Hà Nội</p>
                    <p>Hưng Thịnh - Yên Sở Hoàng Mai - Hà Nội</p>
                </div>
                <div id="service" class="col-lg-3 col-md-6 col-sm-12">
                    <h3>Dịch vụ</h3>
                    <p>Bảo hành rơi vỡ, ngấm nước Care Diamond</p>
                    <p>Bảo hành Care X60 rơi vỡ ngấm nước vẫn Đổi mới</p>
                </div>
                <div id="hotline" class="col-lg-3 col-md-6 col-sm-12">
                    <h3>Hotline</h3>
                    <p>Phone Sale: (+84) 0395954444</p>
                    <p>Email: huynguyenhuynv@gmail.com</p>
                </div>
            </div>
        </div>
    </div> -->

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