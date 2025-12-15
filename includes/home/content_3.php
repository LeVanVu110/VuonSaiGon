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

</style>
</head>
<?php 
// ----------------------------------------------------------------------------------
// PHẦN LOGIC CHÍNH: Lấy dữ liệu từ Class Product
// ----------------------------------------------------------------------------------

// 1. Khởi tạo đối tượng Product và Categories (Giả sử Categories model tồn tại)
$productModel = new Product(); 
$categoriesModel = new Categories();

// --- LOGIC: LẤY SẢN PHẨM VÀ DANH MỤC CON CỦA "ĐẤT VÀ GIÁ THỂ" ---

$targetCategoryName = 'Phân bón';
$productsFromCategory = [];
$categoryToFilter = null; 
$directChildren = []; // Khối mới

// 1.1. Lấy thông tin danh mục CHA
// *LƯU Ý: Yêu cầu phương thức get_category_by_name() đã được thêm vào Class Categories*
// 2. Lấy thông tin danh mục CHA
$categoryToFilter = $categoriesModel->get_category_by_name($targetCategoryName); 

if ($categoryToFilter) {
    $categoryId = (int)$categoryToFilter['id'];

    $directChildren = $categoriesModel->get_direct_children($categoryId);

    $categoryIdsToFilter = $categoriesModel->get_child_ids($categoryId);
    
    if (!in_array($categoryId, $categoryIdsToFilter)) {
        $categoryIdsToFilter[] = $categoryId;
    }
    
    // Gán kết quả trực tiếp vào $allProducts
    $allProducts = $productModel->get_products_by_category_ids($categoryIdsToFilter); 
} else {
    // Đảm bảo $allProducts là mảng rỗng nếu không tìm thấy danh mục cha
    $allProducts = [];
}
// ----------------------------------------------------------------------------------
?>
<body>

    <div class="container my-5">
        <div class="row">

            <div class="col-lg-3 sidebar-area">

                <div class="sidebar-full-height">

                    <div class="sidebar-header"><?= htmlspecialchars($targetCategoryName) ?></div>

                   <div class="sidebar-menu-static">
                        <ul class="sidebar-menu">
                            <?php 
                            // 1. Hiển thị link "Tất cả" của danh mục cha
                            if ($categoryToFilter) {
                                $parentSlug = htmlspecialchars($categoryToFilter['slug']);
                                // Giả định product.php là trang xử lý lọc
                                $parentLink = 'product.php?category_slug=' . $parentSlug; 
                                echo '<li><a href="' . $parentLink . '">Tất cả ' . htmlspecialchars($categoryToFilter['name']) . '</a></li>';
                            }
                            
                            // 2. HIỂN THỊ DANH MỤC CON TRỰC TIẾP
                            // $directChildren đã được lấy qua get_direct_children($categoryId)
                            if (!empty($directChildren)) {
                                foreach ($directChildren as $childCat) {
                                    $childSlug = htmlspecialchars($childCat['slug'] ?? '');
                                    $childLink = 'product.php?category_slug=' . $childSlug;
                                    echo '<li><a href="' . $childLink . '">' . htmlspecialchars($childCat['name']) . '</a></li>';
                                }
                            } else {
                                // Fallback nếu chưa có danh mục con
                                echo '<li><a href="#">Đất sạch trồng cây</a></li>';
                                echo '<li><a href="#">Giá thể trồng cây </a></li>';
                            }
                            ?>
                        </ul>
                    </div>
                    
                    <?php if ($categoryToFilter): ?>
                        <a href="<?= $parentLink ?>" class="sidebar-view-all">
                            Xem tất cả &raquo; </a>
                    <?php endif; ?>

                </div>
            </div>

            

            <div class="col-lg-9">
                <div class="row g-3"> <?php
                    if (!empty($allProducts)):
                        foreach ($allProducts as $p): 
                            
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

    // ========================================================
    // HÀM CẬP NHẬT BADGE GIỎ HÀNG (Total Unique Products)
    // ========================================================
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