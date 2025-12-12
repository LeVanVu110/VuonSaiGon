<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh mục Sản Phẩm - Vườn Sài Gòn</title>


    <style>
    
    </style>
</head>
<?php 
// ----------------------------------------------------------------------------------
// PHẦN LOGIC CHÍNH: Lấy dữ liệu từ Class Product
// ----------------------------------------------------------------------------------

// 1. Khởi tạo đối tượng Product
$productModel = new Product(); 

// 2. Lấy TẤT CẢ sản phẩm từ DB bằng hàm getAllProduct()
$allProducts = $productModel->Receivealllandproducts(); 

// 3. Gọi hàm tiện ích qua tên class để chia sản phẩm thành các slide (6 sản phẩm/slide)
$productSlides = Product::chunkReceivealllandproductsForCarousel($allProducts, 5);

// ----------------------------------------------------------------------------------
?>
<body>

    <div class="container my-5">
        <div class="row">

            <div class="col-lg-3 sidebar-area">

                <div class="sidebar-full-height">

                    <div class="sidebar-header">ĐẤT VÀ GIÁ THỂ</div>

                    <div class="sidebar-menu-static">
                        <ul class="sidebar-menu">
                            <li><a href="#">Đất sạch trồng cây</a></li>
                            <li><a href="#">Giá thể trồng cây </a></li>
                            
                        </ul>
                    </div>

                    <a href="#" class="sidebar-view-all">
                        Xem tất cả &raquo; </a>

                </div>
            </div>

            <div class="col-lg-9">
                <div class="row g-2">
                    <?php
                
                foreach ($allProducts as $p): ?>

                    <div class="col-6 col-md-4 col-lg-custom-5">
                        <div class="product-box">
                            <a href="#" class="product-img-wrapper">
                                <img src="<?= $p['image_url'] ?>" class="product-img" alt="<?= $p['name'] ?>">
                            </a>
                            <div class="product-info">
                                <div class="product-name"><?= $p['description'] ?></div>
                                <div class="product-price"><?= $p['price'] ?></div>
                            </div>
                            <a href="#" class="btn-add-cart">Thêm vào giỏ</a>
                        </div>
                    </div>

                    <?php endforeach; ?>

                </div>
            </div>
        </div>
    </div>

</body>

</html>