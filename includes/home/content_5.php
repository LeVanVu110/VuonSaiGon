<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh mục Sản Phẩm - Vườn Sài Gòn</title>

    <style>
    /* --- PRODUCT CARD STYLES (Mặc định Grid) --- */
    .product-box {
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
        text-align: center;
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
        width: 90%;
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

    /* Sidebar styles (Desktop/Tablet) */
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
    .sidebar-menu li a { 
        display: block; 
        padding: 8px 10px; 
        color: #333; 
        text-decoration: none; 
        border-bottom: 1px dotted #eee;
        transition: background-color 0.2s;
    }
    .sidebar-menu li a:hover {
        background-color: #f7f7f7;
        color: #166534;
    }
    .sidebar-menu li:last-child a {
        border-bottom: none;
    }
    .sidebar-view-all { 
        display: block; 
        padding: 10px; 
        text-align: center; 
        color: #166534; 
        border-top: 1px solid #eee; 
        text-decoration: none; 
        font-weight: bold;
    }

    /* Custom grid cho cột 9 (hiển thị 4 sản phẩm) */
    .col-lg-custom-5 {
        flex: 0 0 33.333333%;
        max-width: 33.333333%;
    }
    @media (min-width: 1200px) {
        .col-lg-custom-5 {
            flex: 0 0 25%;
            max-width: 25%;
        }
    }

    /* Style riêng cho Tiêu đề và Nút Xem tất cả (Desktop) */
    .category-header-row {
        padding: 0 10px;
    }
    
    .category-header-row h2 {
        font-size: 1.6rem; /* Kích thước desktop */
    }
    
    .btn-view-all {
        font-size: 0.9rem;
    }


    /* ==========================================================
       RESPONSIVE MOBILE (Màn hình nhỏ, max-width: 768px)
       ========================================================== */
    @media (max-width: 768px) {
        .container {
            padding: 0 5px; /* Giảm padding container */
        }
        
        .col-lg-3 {
            display: none; /* 1. Ẩn Sidebar */
        }
        
        /* Đảm bảo khu vực sản phẩm chiếm toàn bộ chiều rộng */
        .col-lg-9 {
            width: 100%;
            flex: 0 0 100%;
            max-width: 100%;
            padding: 0; /* Xóa padding Bootstrap mặc định */
        }
        
        /* 2. CHUYỂN SANG LƯỚI 2 CỘT */
        .row > .col-6, .row > .col-md-4, .row > .col-lg-custom-5 {
            flex: 0 0 50%;
            max-width: 50%;
            padding-left: 5px; /* Giảm khoảng cách giữa các cột */
            padding-right: 5px;
        }

        /* CARD SẢN PHẨM */
        .product-box {
            padding-bottom: 5px;
            margin-bottom: 10px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
            padding-top: 5px;
        }
        
        /* KHUNG ẢNH */
        .product-img-wrapper {
             padding: 3px; 
             border: 1px solid #166534; 
        }

        /* Tên sản phẩm */
        .product-info {
             padding: 8px 5px; 
        }
        .product-name {
            font-size: 0.8rem; 
            height: 32px; 
            margin-bottom: 3px;
        }

        /* Giá sản phẩm */
        .product-price {
            font-size: 0.9rem;
            margin-bottom: 5px;
        }
        .price-old {
            font-size: 0.7rem;
        }

        /* Nút Mua hàng */
        .btn-add-cart {
            width: 100%; 
            font-size: 0.75rem; 
            padding: 5px 0;
            margin: 0 auto 5px auto;
        }

        /* Tiêu đề và nút "Xem tất cả" trên Mobile */
        .category-header-row {
            margin-bottom: 15px !important;
            padding: 0 5px; 
        }
        
        .category-header-row h2 {
            font-size: 1.2rem !important; 
            line-height: 1.4;
        }
        
        .btn-view-all {
            font-size: 0.8rem; 
        }
    }

</style>
</head>
<?php 
// ----------------------------------------------------------------------------------
// PHẦN LOGIC CHÍNH: Lấy dữ liệu từ Class Product
// ----------------------------------------------------------------------------------

// 1. Khởi tạo đối tượng Product và Categories (Giả sử Categories model tồn tại)
$productModel = new Product(); 
$categoriesModel = new Categories();

// --- LOGIC: LẤY SẢN PHẨM VÀ DANH MỤC CON CỦA "DỤNG CỤ LÀM VƯỜN" ---

// ĐÃ SỬA LỖI TÊN DANH MỤC
$targetCategoryName = 'DỤNG CỤ LÀM VƯỜN';
$categoryToFilter = null; 
$directChildren = [];
$allProducts = []; 
$parentLink = '#'; // Khởi tạo biến $parentLink

// 1.1. Lấy thông tin danh mục CHA
$categoryToFilter = $categoriesModel->get_category_by_name($targetCategoryName); 

if ($categoryToFilter) {
    $categoryId = (int)$categoryToFilter['id'];

    // Định nghĩa parentLink cho nút "Xem tất cả"
    $parentSlug = htmlspecialchars($categoryToFilter['slug']);
    $parentLink = 'product.php?category_slug=' . $parentSlug; 

    // 2. Lấy danh mục con trực tiếp (cho Sidebar)
    $directChildren = $categoriesModel->get_direct_children($categoryId);

    // 3. Lấy TẤT CẢ ID con (cho truy vấn sản phẩm)
    $categoryIdsToFilter = $categoriesModel->get_child_ids($categoryId);
    
    // Đảm bảo ID cha cũng được bao gồm
    if (!in_array($categoryId, $categoryIdsToFilter)) {
        $categoryIdsToFilter[] = $categoryId;
    }
    
    // 4. Lấy danh sách sản phẩm (ĐÃ SỬA LỖI GÁN BIẾN)
    $allProducts = $productModel->get_products_by_category_ids($categoryIdsToFilter); 
} 
// ----------------------------------------------------------------------------------
?>
<body>

    <div class="container my-5">
        <div class="row">

            <div class="col-lg-3 sidebar-area d-none d-lg-block">

                <div class="sidebar-full-height">

                    <div class="sidebar-header"><?= htmlspecialchars($targetCategoryName) ?></div>

                   <div class="sidebar-menu-static">
                        <ul class="sidebar-menu">
                            <?php 
                            // 1. Hiển thị link "Tất cả" của danh mục cha
                            if ($categoryToFilter) {
                                echo '<li><a href="' . $parentLink . '">Tất cả ' . htmlspecialchars($categoryToFilter['name']) . '</a></li>';
                            }
                            
                            // 2. HIỂN THỊ DANH MỤC CON TRỰC TIẾP
                            if (!empty($directChildren)) {
                                foreach ($directChildren as $childCat) {
                                    $childSlug = htmlspecialchars($childCat['slug'] ?? '');
                                    $childLink = 'product.php?category_slug=' . $childSlug;
                                    echo '<li><a href="' . $childLink . '">' . htmlspecialchars($childCat['name']) . '</a></li>';
                                }
                            } else {
                                // Fallback nếu không có dữ liệu
                                echo '<li><a href="#">Đất sạch trồng cây</a></li>';
                                echo '<li><a href="#">Giá thể trồng cây </a></li>';
                            }
                            ?>
                        </ul>
                    </div>
                    
                    <?php if ($categoryToFilter): ?>
                        <a href="<?= $parentLink ?>" class="sidebar-view-all d-none d-lg-block">
                            Xem tất cả &raquo; </a>
                    <?php endif; ?>

                </div>
            </div>

            <div class="col-lg-9 col-12">
                
                <div class="category-header-row d-flex align-items-center mb-4" style="
    justify-content: space-between;
">
                    <h2 class="mb-0 text-success fw-bold me-2">
                        <?= htmlspecialchars($targetCategoryName) ?>
                    </h2>
                    
                    <?php if ($categoryToFilter): ?>
                        <a href="<?= $parentLink ?>" class="btn-view-all text-decoration-none fw-bold text-success text-nowrap d-lg-none">
                            Xem tất cả &raquo;
                        </a>
                    <?php endif; ?>

                </div>
                
                <div class="row g-3"> <?php
                    if (!empty($allProducts)):
                        foreach ($allProducts as $p): 
                            
                            // Định nghĩa các biến sản phẩm
                            $productUrl = 'detailproduct.php?id=' . htmlspecialchars($p['id']);
                            $finalPrice = ($p['discount_price'] !== null && $p['discount_price'] < $p['price']) ? $p['discount_price'] : $p['price'];
                            $showSaleBadge = ($p['is_sale'] == 1 && $p['discount_price'] !== null && $p['price'] > $p['discount_price']);
                            
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
                        <div class="col-12"><p class="alert alert-info">Không có sản phẩm nào để hiển thị trong danh mục <?= htmlspecialchars($targetCategoryName) ?>.</p></div>
                    <?php endif; ?>

                </div>
            </div>
        </div>
    </div>

</body>
<script>
    // ========================================================
    // HÀM TIỆN ÍCH (Format Currency)
    // ========================================================
    function formatCurrency(price) {
        price = isNaN(price) ? 0 : price;
        return new Intl.NumberFormat('vi-VN', {
            style: 'currency',
            currency: 'VND'
        }).format(price);
    }

    function updateCartCountBadge() {
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
        
        updateCartCountBadge(); 
    }

    document.addEventListener('DOMContentLoaded', function() {
        updateCartCountBadge(); 

        const addToCartButtons = document.querySelectorAll('.js-add-to-cart');

        addToCartButtons.forEach(button => {
            button.addEventListener('click', function(event) {
                event.preventDefault();

                processAddToCart(event.currentTarget, 1);
                
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