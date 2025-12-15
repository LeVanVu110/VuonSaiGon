<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh mục Sản Phẩm - Vườn Sài Gòn</title>


    <style>
    /* --- PRODUCT CARD STYLES (Mặc định Grid) --- */
    .product-box {
        /* Đổi tên class product-box thành product-card */
        border: 1px solid transparent;
        transition: all 0.3s;
        margin-bottom: 20px;
        background: #fff;
        position: relative;
        padding-bottom: 10px;
        height: 100%;
        display: flex;
        flex-direction: column;
    }

    .product-box:hover {
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        border-color: #eee;
    }

    /* KHUNG ẢNH */
    .product-img-wrapper {
        border: 2px solid #166534;
        padding: 5px;
        background: #fff;
        position: relative;
        aspect-ratio: 1 / 1;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto;
        width: 100%;
    }

    .product-img-wrapper img {
        max-width: 100%;
        max-height: 100%;
        object-fit: contain;
    }

    .product-info {
        padding: 15px 10px;
        flex-grow: 1;
        text-align: center; /* Thêm căn giữa cho tên và giá */
    }

    .product-name {
        font-size: 0.95rem;
        color: #166534;
        font-weight: 700;
        margin-bottom: 8px;
        line-height: 1.4;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
        height: 42px;
    }

    .product-price {
        color: #d70018;
        font-weight: 700;
        font-size: 1.1rem;
        margin-bottom: 10px;
    }
    
    .price-old {
        color: #6c757d;
        font-size: 0.85rem;
        text-decoration: line-through;
        margin-left: 5px;
    }

    /* NÚT BẤM */
    .btn-add-cart {
        background-color: #195f2e;
        color: #fff;
        border-radius: 4px;
        font-weight: 700;
        font-size: 0.9rem;
        width: 90%; /* Dùng 90% cho card (tùy chỉnh) */
        border: none;
        padding: 8px 15px;
        transition: background 0.3s;
        display: block;
        margin: 0 auto 10px auto;
        text-align: center;
        text-decoration: none;
        cursor: pointer;
    }

    .btn-add-cart:hover {
        background-color: #144a24;
        color: #fff;
    }

    /* Sidebar styles */
    .sidebar-area { padding-right: 0; }
    .sidebar-full-height { border: 1px solid #eee; }
    .sidebar-header {
        background: #166534;
        color: white;
        padding: 10px;
        font-weight: bold;
        text-align: center;
    }
    .sidebar-menu { list-style: none; padding: 10px; margin: 0; }
    .sidebar-menu li a { display: block; padding: 5px 0; color: #333; text-decoration: none; }
    .sidebar-view-all { display: block; padding: 10px; text-align: center; color: #166534; border-top: 1px solid #eee; text-decoration: none; }

    /* Custom grid cho cột 9 (hiển thị 4 sản phẩm) */
    .col-lg-custom-5 {
        flex: 0 0 33.333333%; /* 3 cột trên Desktop 9 cột => 3 * 3 = 9*/
        max-width: 33.333333%;
    }
    @media (min-width: 1200px) {
        .col-lg-custom-5 {
            flex: 0 0 25%; /* 4 cột trên Desktop lớn 9 cột => 4 * 25% = 100% của cột 9 */
            max-width: 25%;
        }
    }

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
                <div class="row g-3"> <?php
                    if (!empty($allProducts)):
                        foreach ($allProducts as $p): 
                            
                            $productUrl = 'detailproduct.php?id=' . htmlspecialchars($p['id']);
                            $finalPrice = ($p['discount_price'] !== null && $p['discount_price'] < $p['price']) ? $p['discount_price'] : $p['price'];
                            $showSaleBadge = ($p['is_sale'] == 1 && $p['discount_price'] !== null && $p['price'] > $p['discount_price']);
                            
                            // Tên cột description trong file bạn gửi có vẻ chứa văn bản mô tả, 
                            // thay vì name. Ta sẽ dùng 'name' nếu có, hoặc 'description'
                            $displayName = htmlspecialchars($p['name'] ?? $p['description']);
                        ?>

                        <div class="col-6 col-md-4 col-lg-custom-5">
                            <div class="product-box h-100 position-relative">
                                
                                <a href="<?php echo $productUrl; ?>" class="text-decoration-none text-dark d-block">
                                    <div class="product-img-wrapper position-relative">
                                        <?php 
                                        if ($showSaleBadge): 
                                            $discount_amount = $p['price'] - $p['discount_price'];
                                            $discount_percent = round(($discount_amount / $p['price']) * 100);
                                        ?>
                                        <span
                                            class="badge bg-danger position-absolute top-0 end-0 m-1">-<?= $discount_percent ?>%</span>
                                        <?php endif; ?>

                                        <img src="<?= htmlspecialchars($p['image_url']) ?>"
                                            class="product-img" alt="<?= $displayName ?>">
                                    </div>

                                    <div class="product-info">
                                        <div class="product-name"><?= $displayName ?></div>

                                        <div class="product-price">
                                            <?php if ($showSaleBadge): ?>
                                            <span class="text-danger fw-bold me-1">
                                                <?php echo Product::formatCurrency($p['discount_price']) ?>
                                            </span>
                                            <del class="price-old">
                                                <?php echo Product::formatCurrency($p['price']) ?>
                                            </del>
                                            <?php else: ?>
                                            <span class="text-danger fw-bold">
                                                <?php echo Product::formatCurrency($p['price']) ?>
                                            </span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </a> <div class="product-footer">
                                    <?php if ($p['state'] == 'còn hàng'): ?>
                                    <button class="btn-add-cart js-add-to-cart"
                                        data-product-id="<?= htmlspecialchars($p['id']) ?>"
                                        data-name="<?= $displayName ?>"
                                        data-price="<?= htmlspecialchars($finalPrice) ?>"
                                        data-image-url="<?= htmlspecialchars($p['image_url']) ?>">
                                        Thêm vào giỏ
                                    </button>
                                    <?php else: ?>
                                    <a href="<?php echo $productUrl; ?>" class="btn-add-cart" style="background-color: #6c757d;">Đọc tiếp</a>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>

                    <?php endforeach; 
                    else: ?>
                        <div class="col-12"><p class="alert alert-info">Không có sản phẩm nào để hiển thị.</p></div>
                    <?php endif; ?>

                </div>
            </div>
        </div>
    </div>
        </div>
    </div>

</body>
<script>
    // ========================================================
    // HÀM CẬP NHẬT BADGE GIỎ HÀNG (Total Unique Products)
    // Cần phải có element <span id="cart-count-badge"> trong header của bạn
    // ========================================================
    function updateCartCountBadge() {
        // Giả sử có element này trong header
        const cartCountBadge = document.getElementById('cart-count-badge');
        if (!cartCountBadge) return; 

        const cart = JSON.parse(localStorage.getItem('cart')) || [];
        let totalUniqueProducts = cart.length; 

        cartCountBadge.textContent = totalUniqueProducts > 99 ? '99+' : totalUniqueProducts.toString();
        
        if (totalUniqueProducts === 0) {
            cartCountBadge.style.display = 'none';
        } else {
            cartCountBadge.style.display = 'block';
        }
    }

    // ========================================================
    // HÀM XỬ LÝ CHUNG LƯU GIỎ HÀNG VÀ CẬP NHẬT BADGE
    // ========================================================
    function processAddToCart(button, quantityToUse) {
        const productData = {
            id: button.dataset.productId,
            name: button.dataset.name,
            price: parseFloat(button.dataset.price),
            imageUrl: button.dataset.imageUrl,
            quantity: quantityToUse
        };

        let cart = JSON.parse(localStorage.getItem('cart')) || [];
        const existingItem = cart.find(item => item.id === productData.id);

        if (existingItem) {
            existingItem.quantity += productData.quantity; 
        } else {
            cart.push(productData);
        }

        localStorage.setItem('cart', JSON.stringify(cart));
        
        // CẬP NHẬT BADGE NGAY LẬP TỨC
        updateCartCountBadge(); 
    }

    // ========================================================
    // GẮN SỰ KIỆN KHI DOM TẢI XONG
    // ========================================================
    document.addEventListener('DOMContentLoaded', function() {
        // 1. CHẠY KHI TẢI TRANG LẦN ĐẦU
        updateCartCountBadge(); 

        // 2. GẮN SỰ KIỆN CHO NÚT ADD TO CART (.js-add-to-cart)
        const addToCartButtons = document.querySelectorAll('.js-add-to-cart');

        addToCartButtons.forEach(button => {
            button.addEventListener('click', function(event) {
                event.preventDefault();

                // Số lượng mặc định là 1 cho nút trên list
                processAddToCart(event.currentTarget, 1);
                
                // Phản hồi người dùng
                this.textContent = 'ĐÃ THÊM';
                this.disabled = true;
                setTimeout(() => {
                    this.textContent = 'Thêm vào giỏ';
                    this.disabled = false;
                }, 1500);
            });
        });
    });
</script>
</html>