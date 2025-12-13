<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách sản phẩm - Vườn Sài Gòn</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f9f9f9;
    }

    /* --- BREADCRUMB --- */
    .breadcrumb-bg {
        background-color: #f0f2f5;
    }

    .breadcrumb a {
        color: #0d6efd;
    }

    /* --- SIDEBAR & CATEGORY --- */
    .sidebar-title {
        color: #4a8a2a;
        font-weight: bold;
        text-transform: uppercase;
        margin-bottom: 20px;
        font-size: 1.1rem;
        border-bottom: 1px solid #ddd;
        padding-bottom: 10px;
    }

    .category-list {
        list-style: none;
        padding-left: 0;
    }

    .category-list li {
        margin-bottom: 12px;
    }

    .category-list a {
        text-decoration: none;
        color: #333;
        font-size: 0.95rem;
        font-weight: 500;
        display: flex;
        justify-content: space-between;
        align-items: center;
        transition: color 0.2s;
    }

    .category-list a:hover {
        color: #2e7d32;
    }

    /* --- TOOLBAR --- */
    .product-toolbar {
        background: #fff;
        padding: 10px 15px;
        border: 1px solid #eee;
        margin-bottom: 20px;
    }

    /* --- PRODUCT CARD STYLES (Mặc định Grid) --- */
    .product-card {
        border: 1px solid transparent;
        transition: all 0.3s;
        margin-bottom: 20px;
        background: #fff;
        position: relative;
        padding-bottom: 10px;
        height: 100%;
        /* Giữ chiều cao đều nhau trong Grid */
        display: flex;
        flex-direction: column;
    }

    .product-card:hover {
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

    .card-body {
        padding: 15px 10px;
        flex-grow: 1;
        /* Để đẩy footer xuống đáy nếu cần */
    }

    .product-title {
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

    /* NÚT BẤM (Mặc định cho Grid & Mobile Grid) */
    .btn-add-cart {
        background-color: #195f2e;
        color: #fff;
        border-radius: 4px;
        font-weight: 700;
        font-size: 0.9rem;
        width: 100%;
        /* QUAN TRỌNG: Mặc định là 100% chiều rộng */
        border: none;
        padding: 8px 15px;
        transition: background 0.3s;
        display: block;
        /* Đảm bảo nút là khối */
    }

    .btn-add-cart:hover {
        background-color: #144a24;
        color: #fff;
    }

    /* Nút gọi nổi */
    .floating-phone {
        position: fixed;
        bottom: 20px;
        right: 20px;
        background: #28a745;
        color: white;
        width: 50px;
        height: 50px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 24px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
        z-index: 1000;
    }

    /* ==========================================================
           LOGIC CHUYỂN ĐỔI GRID/LIST
           ========================================================== */

    #view-grid:checked~.main-content .view-btn-grid {
        color: #166534;
    }

    #view-grid:checked~.main-content .view-btn-list {
        color: #6c757d;
    }

    #view-list:checked~.main-content .view-btn-list {
        color: #166534;
    }

    #view-list:checked~.main-content .view-btn-grid {
        color: #6c757d;
    }

    /* --- DESKTOP LIST VIEW STYLES (Màn hình lớn) --- */
    @media (min-width: 769px) {

        /* Bung cột ra 100% */
        #view-list:checked~.main-content #product-container .col {
            width: 100% !important;
            flex: 0 0 100% !important;
            max-width: 100% !important;
        }

        /* Thẻ Card nằm ngang */
        #view-list:checked~.main-content #product-container .product-card {
            display: flex;
            flex-direction: row;
            align-items: flex-start;
            border: 1px solid #eee;
            padding: 15px;
            min-height: 200px;
        }

        /* Ảnh cố định size */
        #view-list:checked~.main-content #product-container .product-img-wrapper {
            width: 180px !important;
            height: 180px !important;
            flex-shrink: 0;
            margin-right: 25px;
            margin-left: 0;
            aspect-ratio: auto;
        }

        /* Body */
        #view-list:checked~.main-content #product-container .card-body {
            flex-grow: 1;
            padding: 0;
            padding-right: 200px;
        }

        #view-list:checked~.main-content #product-container .product-title {
            font-size: 1.1rem;
            text-align: left;
            margin-top: 10px;
            max-width: 100%;
            height: auto;
            -webkit-line-clamp: unset;
        }

        /* Giá tiền: Bay lên góc phải */
        #view-list:checked~.main-content #product-container .product-price {
            position: absolute;
            top: 15px;
            right: 20px;
            font-size: 1.4rem;
            text-align: right;
            width: 160px;
        }

        /* Footer chứa nút */
        #view-list:checked~.main-content #product-container .card-footer {
            position: absolute;
            top: 55px;
            right: 20px;
            padding: 0;
            background: transparent;
            border: none;
            width: auto;
        }

        /* NÚT BẤM DESKTOP LIST VIEW: Cố định 160px để đều nhau */
        #view-list:checked~.main-content #product-container .btn-add-cart {
            width: 160px !important;
        }
    }

    /* ==========================================================
           RESPONSIVE MOBILE (Màn hình nhỏ < 769px)
           ========================================================== */
    @media (max-width: 768px) {
        .product-toolbar {
            font-size: 0.9rem;
        }

        /* Dù chọn List hay Grid, trên mobile đều hiển thị dạng dọc (Grid nhỏ) */
        #view-list:checked~.main-content #product-container .product-card {
            flex-direction: row;
            flex-wrap: wrap;
            /* Bỏ dòng này nếu bạn muốn mọi thứ nằm trên 1 hàng duy nhất */
            padding: 10px;
        }

        /* ... */
        #view-list:checked~.main-content #product-container .product-img-wrapper {
            width: 100px !important;
            height: 100px !important;
            margin-right: 15px;
        }

        #view-list:checked~.main-content #product-container .card-body {
            width: calc(100% - 115px);
            padding-right: 0;
            /* THÊM: Sử dụng flex để quản lý Tên, Giá và Nút */
            display: flex;
            flex-direction: column;
            /* Xếp Tên, Giá, Nút theo cột */
            justify-content: space-between;
            /* Đẩy Nút xuống đáy nếu có đủ chỗ */
        }

        #view-list:checked~.main-content #product-container .product-title {
            font-size: 0.95rem;
        }

        /* Giá & Nút về vị trí tự nhiên */
        #view-list:checked~.main-content #product-container .product-price {
            position: static;
            font-size: 1rem;
            margin-top: 5px;
            text-align: left;
            width: auto;
        }

        #view-list:checked~.main-content #product-container .card-footer {
            /* Đã bị đẩy xuống cuối cột body do flex-direction: column */
            position: static;
            width: 100%;
            margin-top: 5px;
            /* Thay đổi quan trọng: Để nút nằm ngang với ảnh, footer phải được bao trong card-body */
        }

        /* --- SỬA LỖI NÚT BẤM MOBILE --- */
        /* Ép nút luôn rộng 100% trên mobile để bằng nhau tăm tắp */
        #view-list:checked~.main-content #product-container .btn-add-cart,
        .btn-add-cart {
            width: 100% !important;
            display: block;
            font-size: 0.85rem;
            padding: 6px 0;
        }
    }

    /* Thêm vào thẻ <style> */
    .category-list .collapse-icon {
        transition: transform 0.3s ease;
    }

    .category-list a[aria-expanded="true"] .collapse-icon {
        transform: rotate(90deg);
        /* Xoay mũi tên khi menu mở */
    }

    /* Đảm bảo mũi tên nằm ở bên phải cùng (như trong ảnh bạn gửi) */
    .category-list a {
        justify-content: space-between;
    }

    /* Quan trọng: Sửa lỗi hiển thị mũi tên cho menu cha không đóng được */
    /* Mặc định mũi tên nằm bên phải */
    .category-list a .bi-chevron-down,
    .category-list a .bi-chevron-right {
        flex-shrink: 0;
        margin-left: 10px;
    }

    /* Trong style.css (hoặc thẻ <style> trong listproduct.php) */

    /* Mặc định mũi tên nằm bên phải (bi-chevron-right) */
    .category-list a .collapse-icon {
        transition: transform 0.3s ease;
        transform: rotate(0deg);
        /* Bắt đầu ở bên phải */
    }

    /* Khi mở (aria-expanded="true"), xoay icon 90 độ xuống */
    .category-list a[aria-expanded="true"] .collapse-icon {
        transform: rotate(90deg);
    }

    .category-list a .collapse-toggle {
        flex-shrink: 0;
        margin-left: 10px;
    }
    </style>
</head>
<?php

// 1. Khởi tạo Models (Giả sử Product và Categories đã được định nghĩa và có sẵn)
$productModels = new Product();
$categories = new Categories();

// ===========================================
// 2. Xử lý Lọc Danh mục, Tìm kiếm và Thiết lập Bộ lọc
// ===========================================

// Lấy tham số tìm kiếm
$keyword = isset($_GET['q']) ? trim($_GET['q']) : null;
$searchType = isset($_GET['search_type']) ? $_GET['search_type'] : 'product';

// Biến trạng thái
$categorySlug = isset($_GET['category_slug']) ? $_GET['category_slug'] : null;
$currentCategory = null;
$parentCategory = null;
$categoryIdsToFilter = [];
$isParentCategory = false; 

// --- Xử lý Lọc Danh mục HOẶC Tìm kiếm ---
if (!empty($keyword) && $searchType === 'product') {
    // Nếu có tìm kiếm sản phẩm, BỎ QUA lọc danh mục
    $categorySlug = null;
    $currentCategory = null;
    $parentCategory = null;
    $categoryIdsToFilter = []; // Tìm kiếm trên tất cả sản phẩm
} else {
    // Xử lý Lọc Danh mục
    if ($categorySlug) {
        $currentCategory = $categories->get_category_by_slug($categorySlug);

        if ($currentCategory) {
            $categoryId = (int)$currentCategory['id'];
            if ($currentCategory['parent_id'] === NULL) {
                // Đây là danh mục CHA: Lấy ID của nó và tất cả con cháu
                $isParentCategory = true;
                $categoryIdsToFilter = $categories->get_child_ids($categoryId);
                $parentCategory = $currentCategory; 
            } else {
                // Đây là danh mục CON: Chỉ lấy ID của chính nó
                $isParentCategory = false;
                $categoryIdsToFilter = [$categoryId];
                $parentCategory = $categories->get_category_by_id((int)$currentCategory['parent_id']);
            }
        }
    }
}


// 3. Lấy tùy chọn sắp xếp và chế độ xem
$sortOption = isset($_GET['sort']) ? $_GET['sort'] : 'default'; 
$viewOption = isset($_GET['view']) ? $_GET['view'] : 'grid';

// 4. Cấu hình phân trang
$productsPerPage = 12; 

// 5. Lấy TỔNG SỐ sản phẩm (theo categoryIdsToFilter và keyword)
$totalProducts = $productModels->get_total_products($categoryIdsToFilter, $keyword); 
$totalPages = $totalProducts > 0 ? ceil($totalProducts / $productsPerPage) : 1; 

// 6. Xác định Trang Hiện Tại
$currentPage = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;
$currentPage = max(1, min($currentPage, $totalPages));

// 7. Lấy DANH SÁCH sản phẩm cho trang hiện tại
$productsOnPage = $productModels->get_products(
    $categorySlug, 
    $categoryIdsToFilter, 
    $currentPage, 
    $productsPerPage, 
    $sortOption,
    $keyword
);

// 8. Lấy Dữ liệu Danh mục (Dùng cho sidebar)
$allcategories = $categories->get_categories_hierarchical();

$directChildren = [];
if ($categorySlug && $currentCategory && $isParentCategory) {
    // Nếu đang xem Danh mục CHA, lấy danh mục con trực tiếp (cho sidebar)
    $directChildren = $categories->get_direct_children((int)$currentCategory['id']);
}

// 9. Chuẩn bị tham số URL (Đảm bảo giữ lại tất cả params)
$currentQuery = $_GET; 
unset($currentQuery['sort']);     
unset($currentQuery['page']);     
unset($currentQuery['view']);     

$hiddenInputs = '';
foreach ($currentQuery as $key => $value) {
    if (is_scalar($value)) {
        $hiddenInputs .= '<input type="hidden" name="' . htmlspecialchars($key) . '" value="' . htmlspecialchars($value) . '">';
    }
}

// Tạo chuỗi tham số cho Phân trang
$currentUrlParams = '';
if (!empty($categorySlug)) {
    $currentUrlParams .= '&category_slug=' . htmlspecialchars($categorySlug);
}
if (!empty($sortOption) && $sortOption !== 'default') {
    $currentUrlParams .= '&sort=' . htmlspecialchars($sortOption);
}
if (!empty($viewOption) && $viewOption !== 'grid') { 
    $currentUrlParams .= '&view=' . htmlspecialchars($viewOption);
}
if (!empty($keyword)) {
    $currentUrlParams .= '&q=' . urlencode($keyword);
    // Luôn giữ lại search_type nếu có q
    $currentUrlParams .= '&search_type=' . urlencode($searchType);
}

?>


<body>

    <input type="radio" name="view-switch" id="view-grid"
        <?php echo ($viewOption === 'grid' || $viewOption === '') ? 'checked' : ''; ?> hidden>
    <input type="radio" name="view-switch" id="view-list" <?php echo ($viewOption === 'list') ? 'checked' : ''; ?>
        hidden>

    <div class="main-content">

        <div class="container-fluid breadcrumb-bg py-4 mb-4">
            <div class="container">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="/" class="text-decoration-none text-success">Trang chủ</a>
                        </li>

                        <?php if (!empty($keyword) && $searchType === 'product'): ?>
                        <li class="breadcrumb-item active" aria-current="page">Kết quả tìm kiếm cho:
                            "<?= htmlspecialchars($keyword) ?>"</li>

                        <?php elseif ($categorySlug && $parentCategory): ?>
                        <li class="breadcrumb-item"><a
                                href="?category_slug=<?= htmlspecialchars($parentCategory['slug']) ?>"
                                class="text-decoration-none text-success"><?= htmlspecialchars($parentCategory['name']) ?></a>
                        </li>

                        <?php if ($currentCategory && $currentCategory['parent_id'] !== NULL): // Đây là danh mục con ?>
                        <li class="breadcrumb-item active" aria-current="page">
                            <?= htmlspecialchars($currentCategory['name']) ?></li>
                        <?php endif; ?>

                        <?php else: ?>
                        <li class="breadcrumb-item active" aria-current="page">Sản phẩm</li>
                        <?php endif; ?>

                    </ol>
                </nav>
            </div>
        </div>
        <div class="container">
            <div class="row">

                <div class="col-lg-3 d-none d-lg-block">
                    <div class="sidebar-title">DANH MỤC SẢN PHẨM</div>
                    <ul class="category-list">
                        <?php 
                        // 1. Nếu đang ở Danh mục CHA (Hiển thị các con trực tiếp)
                        if ($categorySlug && $currentCategory && $isParentCategory): ?>

                            <?php 
                            // Link quay lại: Quay về trang sản phẩm chung
                            $backLink = '?'; 
                            ?>

                            <li><a href="<?= $backLink ?>">< QUAY LẠI</a></li>

                            <?php if (!empty($directChildren)): ?>
                                <?php foreach ($directChildren as $child): 
                                    $childLink = "?category_slug=" . htmlspecialchars($child['slug']);
                                ?>
                                    <li><a href="<?= $childLink ?>"><?= htmlspecialchars($child['name']) ?></a></li>
                                <?php endforeach; ?>
                            <?php endif; ?>

                        <?php 
                        // 2. Nếu đang ở Danh mục CON (Hiển thị 2 nút QUAY LẠI)
                        elseif ($categorySlug && $currentCategory && $parentCategory && !$isParentCategory): 
                            
                            // Link quay lại cấp cha (DANH MỤC CHA)
                            $backToParentLink = '?category_slug=' . htmlspecialchars($parentCategory['slug']);
                            
                            // Link quay lại cấp tổng quát (DANH MỤC SẢN PHẨM)
                            $backToGeneralLink = '?'; 
                        ?>
                            <li><a href="<?= $backToParentLink ?>">< QUAY LẠI</a></li>
                            <li><a href="<?= $backToGeneralLink ?>">< QUAY LẠI</a></li>

                        <?php 
                        // 3. Nếu không có lọc hoặc đang tìm kiếm (Hiển thị cây danh mục)
                        else: ?>
                            <?php Categories::display_categories_html($allcategories); ?>

                        <?php endif; ?>
                    </ul>
                </div>
                <div class="col-lg-9 col-12">

                    <?php if ($currentCategory && !$isParentCategory): ?>
                    <div class="category-banner">
                        <?php if (!empty($currentCategory['image_url'])): ?>
                        <img src="<?= htmlspecialchars($currentCategory['image_url']) ?>"
                            alt="<?= htmlspecialchars($currentCategory['name']) ?>">
                        <?php endif; ?>
                        <h3><?= htmlspecialchars($currentCategory['name']) ?></h3>
                        <?php if (!empty($currentCategory['description'])): ?>
                        <p><?= $currentCategory['description'] ?></p>
                        <?php endif; ?>
                    </div>
                    <?php endif; ?>
                    <div class="product-toolbar d-flex flex-wrap justify-content-between align-items-center gap-2">

                        <div class="fw-bold text-secondary d-none d-md-block"><?= number_format($totalProducts) ?> sản
                            phẩm</div>
                        
                        <button class="btn btn-sm btn-outline-success d-md-none" type="button"
                            data-bs-toggle="offcanvas" data-bs-target="#mobileFilterOffcanvas">
                            <i class="bi bi-funnel"></i> Lọc
                        </button>

                        <div class="d-flex align-items-center gap-2 ms-auto">
                            <form method="GET" action="" id="sort-form">
                                <?php echo $hiddenInputs; ?>
                                <input type="hidden" name="view" id="current-view-mode"
                                    value="<?php echo htmlspecialchars($viewOption); ?>">

                                <select name="sort" class="form-select form-select-sm" style="width: auto;"
                                    onchange="document.getElementById('sort-form').submit()">

                                    <option value="default"
                                        <?php echo ($sortOption === 'default') ? 'selected' : ''; ?>>
                                        Thứ Tự Mặc định
                                    </option>
                                    <option value="popularity"
                                        <?php echo ($sortOption === 'popularity') ? 'selected' : ''; ?>>
                                        Thứ Tự Theo Mức Độ Phổ Biến
                                    </option>

                                    <option value="price_asc"
                                        <?php echo ($sortOption === 'price_asc') ? 'selected' : ''; ?>>
                                        Giá thấp đến cao
                                    </option>

                                    <option value="price_desc"
                                        <?php echo ($sortOption === 'price_desc') ? 'selected' : ''; ?>>
                                        Giá cao đến thấp
                                    </option>
                                </select>
                            </form>
                            <div class="user-select-none d-flex align-items-center">
                                <span class="me-1 d-none d-md-inline small text-muted">Xem</span>
                                <label for="view-grid" class="view-btn-grid cursor-pointer p-1"
                                    style="cursor: pointer;">
                                    <i class="bi bi-grid-3x3-gap-fill fs-5"></i>
                                </label>
                                <label for="view-list" class="view-btn-list cursor-pointer p-1 ms-1"
                                    style="cursor: pointer;">
                                    <i class="bi bi-list-ul fs-5"></i>
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="row row-cols-1 row-cols-md-3 row-cols-lg-4 g-3" id="product-container">
                        <?php if (empty($productsOnPage)): ?>
                        <div class="col-12">
                            <p class="alert alert-warning">
                                <?php if (!empty($keyword)): ?>
                                    Không tìm thấy sản phẩm nào khớp với từ khóa "<?= htmlspecialchars($keyword) ?>".
                                <?php else: ?>
                                    Không tìm thấy sản phẩm nào trong danh mục này.
                                <?php endif; ?>
                            </p>
                        </div>
                        <?php else: ?>
                        <?php foreach($productsOnPage as $value): ?>
                        <div class="col">
                            <div class="product-card">
                                <div class="product-img-wrapper">
                                    <?php 
                                    $finalPrice = ($value['discount_price'] !== null && $value['discount_price'] < $value['price']) ? $value['discount_price'] : $value['price'];
                                    $showSaleBadge = ($value['is_sale'] == 1 && $value['discount_price'] !== null && $value['price'] > $value['discount_price']);
                                    
                                    if ($showSaleBadge): 
                                        $discount_amount = $value['price'] - $value['discount_price'];
                                        $discount_percent = round(($discount_amount / $value['price']) * 100);
                                    ?>
                                        <span class="badge bg-danger position-absolute top-0 end-0 m-1">-<?= $discount_percent ?>%</span>
                                    <?php endif; ?>

                                    <img src="<?php echo htmlspecialchars($value['image_url']) ?>"
                                        alt="<?php echo htmlspecialchars($value['name']) ?>">
                                </div>
                                <div class="card-body">
                                    <h6 class="product-title"><?php echo htmlspecialchars($value['name']) ?></h6>
                                    
                                    <div class="product-price">
                                        <?php if ($showSaleBadge): ?>
                                            <span class="text-danger fw-bold me-2"><?php echo Product::formatCurrency($value['discount_price']) ?></span>
                                            <del class="text-muted small"><?php echo Product::formatCurrency($value['price']) ?></del>
                                        <?php else: ?>
                                            <span class="text-danger fw-bold"><?php echo Product::formatCurrency($value['price']) ?></span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                
                                <div class="card-footer">
                                    <?php 
                                    $showAddToCart = ($value['is_sale'] == 1 || ($value['discount_price'] !== null && $value['discount_price'] < $value['price']));
                                    ?>

                                    <?php if ($showAddToCart): ?>
                                    <button class="btn btn-add-cart js-add-to-cart"
                                        data-product-id="<?= htmlspecialchars($value['id']) ?>"
                                        data-name="<?= htmlspecialchars($value['name']) ?>"
                                        data-price="<?= htmlspecialchars($finalPrice) ?>"
                                        data-image-url="<?= htmlspecialchars($value['image_url']) ?>">
                                        Thêm vào giỏ hàng
                                    </button>
                                    <?php else: ?>
                                    <button class="btn btn-add-cart">Đọc tiếp</button>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                        <?php endif; ?>


                    </div>

                    <?php if ($totalPages > 1): ?>
                    <nav class="mt-4">
                        <ul class="pagination justify-content-center">

                            <?php $prevPage = $currentPage - 1; ?>
                            <li class="page-item <?= ($currentPage <= 1) ? 'disabled' : '' ?>">
                                <a class="page-link text-success" href="?page=<?= $prevPage ?><?= $currentUrlParams ?>"
                                    tabindex="-1">Trước</a>
                            </li>

                            <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                            <li class="page-item <?= ($i == $currentPage) ? 'active' : '' ?>">
                                <?php $linkClass = ($i == $currentPage) ? 'bg-success border-success' : 'text-success'; ?>
                                <a class="page-link <?= $linkClass ?>"
                                    href="?page=<?= $i ?><?= $currentUrlParams ?>"><?= $i ?></a>
                            </li>
                            <?php endfor; ?>

                            <?php $nextPage = $currentPage + 1; ?>
                            <li class="page-item <?= ($currentPage >= $totalPages) ? 'disabled' : '' ?>">
                                <a class="page-link text-success"
                                    href="?page=<?= $nextPage ?><?= $currentUrlParams ?>">Sau</a>
                            </li>
                        </ul>
                    </nav>
                    <?php endif; ?>

                </div>
            </div>
        </div>
    </div>

    <div class="offcanvas offcanvas-start" tabindex="-1" id="mobileFilterOffcanvas" aria-labelledby="mobileFilterLabel">
        <div class="offcanvas-header bg-success text-white">
            <h5 class="offcanvas-title" id="mobileFilterLabel">DANH MỤC SẢN PHẨM</h5>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas"
                aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <ul class="category-list">
                <?php 
                // 1. Nếu đang ở Danh mục CHA (Hiển thị các con trực tiếp)
                if ($categorySlug && $currentCategory && $isParentCategory): ?>

                    <?php 
                    $backLink = '?'; 
                    ?>
                    <li><a href="<?= $backLink ?>">< QUAY LẠI</a></li>

                    <?php if (!empty($directChildren)): ?>
                        <?php foreach ($directChildren as $child): 
                            $childLink = "?category_slug=" . htmlspecialchars($child['slug']);
                        ?>
                            <li><a href="<?= $childLink ?>"><?= htmlspecialchars($child['name']) ?></a></li>
                        <?php endforeach; ?>
                    <?php endif; ?>

                <?php 
                // 2. Nếu đang ở Danh mục CON (Hiển thị 2 nút QUAY LẠI)
                elseif ($categorySlug && $currentCategory && $parentCategory && !$isParentCategory): 
                    
                    $backToParentLink = '?category_slug=' . htmlspecialchars($parentCategory['slug']);
                    $backToGeneralLink = '?'; 
                ?>
                    <li><a href="<?= $backToParentLink ?>">< QUAY LẠI</a></li>
                    <li><a href="<?= $backToGeneralLink ?>">< QUAY LẠI</a></li>

                <?php 
                // 3. Nếu không có lọc hoặc đang tìm kiếm (Hiển thị cây danh mục)
                else: ?>
                    <?php Categories::display_categories_html($allcategories); ?>

                <?php endif; ?>
            </ul>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
<script>
// Logic để thay đổi chế độ xem và reload trang để áp dụng
function updateViewModeAndReload(mode) {
    let currentUrl = new URL(window.location.href);
    currentUrl.searchParams.set('view', mode);
    window.location.href = currentUrl.toString();
}

const viewGridRadio = document.getElementById('view-grid');
const viewListRadio = document.getElementById('view-list');

if (viewGridRadio) {
    viewGridRadio.addEventListener('change', () => {
        if (viewGridRadio.checked) {
            updateViewModeAndReload('grid');
        }
    });
}

if (viewListRadio) {
    viewListRadio.addEventListener('change', () => {
        if (viewListRadio.checked) {
            updateViewModeAndReload('list');
        }
    });
}

// ========================================================
// LOGIC SỬA LỖI: Ngăn click icon kích hoạt link, và dùng Bootstrap API để đảm bảo mở/đóng
// ========================================================
document.addEventListener('DOMContentLoaded', function() {
    // Logic Collapse/Expand Sidebar
    const collapseToggles = document.querySelectorAll('.collapse-toggle');

    collapseToggles.forEach(toggle => {
        toggle.addEventListener('click', function(event) {
            event.preventDefault();
            event.stopPropagation();

            const targetId = this.getAttribute('data-bs-target');
            const collapseElement = document.querySelector(targetId);

            if (collapseElement) {
                const collapseInstance = new bootstrap.Collapse(collapseElement, {
                    toggle: true
                });

                const isExpanded = collapseElement.classList.contains('show');
                this.setAttribute('aria-expanded', !isExpanded);
            }
        });
    });
    
    // ========================================================
    // LOGIC THÊM VÀO GIỎ HÀNG (SỬ DỤNG data-* attributes)
    // ========================================================
    function handleAddToCart(event) {
        event.preventDefault();
        const button = event.currentTarget;
        
        // 1. Lấy dữ liệu sản phẩm từ data attributes
        const productData = {
            id: button.dataset.productId,
            name: button.dataset.name,
            price: parseFloat(button.dataset.price),
            imageUrl: button.dataset.imageUrl,
            quantity: 1
        };

        // 2. Lưu trữ Giỏ hàng (Sử dụng LocalStorage)
        let cart = JSON.parse(localStorage.getItem('cart')) || [];
        const existingItem = cart.find(item => item.id === productData.id);

        if (existingItem) {
            existingItem.quantity += 1;
        } else {
            cart.push(productData);
        }

        localStorage.setItem('cart', JSON.stringify(cart));
        
        // 3. (Tùy chọn) Highlight nút để người dùng thấy có phản hồi
        button.textContent = 'ĐÃ THÊM';
        button.disabled = true;
        setTimeout(() => {
            button.textContent = 'Thêm vào giỏ hàng';
            button.disabled = false;
        }, 1500); 

        // KHÔNG CÓ alert() hay confirm()
    }

    // Gắn sự kiện cho các nút "Thêm vào giỏ hàng"
    const addToCartButtons = document.querySelectorAll('.js-add-to-cart');
    addToCartButtons.forEach(button => {
        button.addEventListener('click', handleAddToCart);
    });
});
</script>

</html>