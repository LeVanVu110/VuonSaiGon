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
            align-items: stretch;
            border: 1px solid #eee;
            padding: 20px;
            position: relative;
            /* Quan trọng để căn con theo absolute */
            min-height: 200px;
        }

        /* Ảnh sản phẩm */
        #view-list:checked~.main-content #product-container .product-img-wrapper {
            width: 180px !important;
            height: 180px !important;
            flex-shrink: 0;
            margin-right: 25px;
            margin-left: 0;
        }

        /* Khối nội dung */
        #view-list:checked~.main-content #product-container .card-body {
            flex-grow: 1;
            padding: 0;
            display: flex;
            flex-direction: column;
            justify-content: flex-start;
        }

        /* Tiêu đề: Giới hạn chiều rộng để không đè lên giá */
        #view-list:checked~.main-content #product-container .product-title {
            font-size: 1.1rem;
            text-align: left;
            max-width: 70%;
            height: auto;
            margin-top: 5px;
        }

        /* Giá tiền: Nằm ở góc TRÊN bên phải */
        #view-list:checked~.main-content #product-container .product-price {
            position: absolute;
            top: 20px;
            right: 20px;
            font-size: 1.4rem;
            text-align: right;
            margin: 0;
        }

        /* NÚT BẤM: Nằm ở góc DƯỚI bên phải */
        #view-list:checked~.main-content #product-container .card-footer-mobile {
            position: absolute;
            bottom: 20px;
            right: 20px;
            width: auto;
        }

        #view-list:checked~.main-content #product-container .btn-add-cart {
            width: 180px !important;
            padding: 10px 15px;
            white-space: nowrap;
        }
    }

    /* ==========================================================
           RESPONSIVE MOBILE (Màn hình nhỏ < 769px)
           ========================================================== */
    @media (max-width: 768px) {
        #product-container {
            display: flex;
            flex-wrap: wrap;
            margin-right: -5px;
            margin-left: -5px;
        }

        #product-container .col {
            width: 50% !important;
            /* Hiển thị 2 sản phẩm 1 hàng */
            flex: 0 0 50% !important;
            max-width: 50% !important;
            padding: 5px;
        }

        /* --- KHI CHỌN CHẾ ĐỘ LIST TRÊN MOBILE --- */
        #view-list:checked~.main-content #product-container .col {
            width: 100% !important;
            flex: 0 0 100% !important;
            max-width: 100% !important;
        }

        #view-list:checked~.main-content #product-container .product-card {
            flex-direction: row !important;
            /* Xếp ngang */
            /* align-items: center; */
            padding: 10px;
            min-height: auto;
        }

        /* Đảm bảo nút trên mobile luôn rộng 100% của cột bên phải */
        #view-list:checked~.main-content #product-container .card-footer-mobile {
            width: 100%;
            margin-top: 10px;
        }

        #view-list:checked~.main-content #product-container .product-img-wrapper {
            width: 100px !important;
            /* Ảnh nhỏ lại như mẫu */
            height: 100px !important;
            margin-right: 15px;
            margin-left: 0;
            flex-shrink: 0;
        }

        #view-list:checked~.main-content #product-container .card-body {
            text-align: left !important;
            padding: 0;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        #view-list:checked~.main-content #product-container .product-title {
            height: auto;
            font-size: 0.9rem;
            margin-bottom: 5px;
            -webkit-line-clamp: 2;
        }

        #view-list:checked~.main-content #product-container .product-price {
            position: static !important;
            /* Bỏ position absolute của desktop */
            font-size: 1rem;
            margin-bottom: 5px;
            width: auto;
            text-align: left;
        }

        #view-list:checked~.main-content #product-container .card-footer {
            position: static !important;
            width: 100%;
            padding: 0;
            margin-top: 5px;
        }

        /* Nút bấm trên mobile nhỏ gọn hơn */
        .btn-add-cart {
            padding: 6px 10px;
            font-size: 0.8rem;
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

    /* --- CATEGORY BANNER RESPONSIVE --- */
    .category-banner {
        background: #fff;
        padding: 20px;
        border: 1px solid #eee;
        margin-bottom: 25px;
        border-radius: 8px;
        text-align: center;
        /* Căn giữa nội dung trên mobile */
    }

    .category-banner img {
        width: 100%;
        max-height: 300px;
        /* Giới hạn chiều cao banner để không quá dài */
        object-fit: cover;
        /* Cắt ảnh vừa khung không bị móp */
        border-radius: 4px;
        margin-bottom: 15px;
    }

    .category-banner h3 {
        color: #166534;
        font-weight: bold;
        font-size: 1.5rem;
        margin-bottom: 10px;
    }

    .category-banner p {
        color: #666;
        font-size: 0.95rem;
        line-height: 1.6;
        text-align: justify;
        /* Cho mô tả căn đều 2 bên */
    }

    /* Điều chỉnh cho Desktop (Màn hình lớn) */
    @media (min-width: 992px) {
        .category-banner {
            text-align: left;
            /* Trên máy tính thì căn trái cho chuyên nghiệp */
            display: flex;
            flex-direction: column;
        }

        .category-banner h3 {
            font-size: 1.8rem;
        }
    }

    /* Điều chỉnh cho Mobile (Màn hình nhỏ) */
    @media (max-width: 768px) {
        .category-banner {
            padding: 10px;
            margin-bottom: 15px;
        }

        .category-banner h3 {
            font-size: 1.2rem;
        }

        .category-banner p {
            font-size: 0.85rem;
        }

        .category-banner img {
            max-height: 180px;
            /* Mobile ảnh thấp xuống cho đỡ chiếm chỗ */
        }
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
$keyword = isset($_GET['keyword']) ? trim($_GET['keyword']) : null;
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

                        <li><a href="<?= $backLink ?>">
                                < QUAY LẠI</a>
                        </li>

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
                        <li><a href="<?= $backToParentLink ?>">
                                < QUAY LẠI</a>
                        </li>
                        <li><a href="<?= $backToGeneralLink ?>">
                                < QUAY LẠI</a>
                        </li>

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
                            alt="<?= htmlspecialchars($currentCategory['name']) ?>" class="img-fluid"> <?php endif; ?>
                        <h3><?= htmlspecialchars($currentCategory['name']) ?></h3>
                        <?php if (!empty($currentCategory['description'])): ?>
                        <p><?= $currentCategory['description'] ?></p>
                        <?php endif; ?>
                    </div>
                    <?php endif; ?>
                    <div class="product-toolbar d-flex align-items-center justify-content-between gap-2">

                        <div class="fw-bold text-secondary d-none d-md-block">
                            <?= number_format($totalProducts) ?> sản phẩm
                        </div>

                        <button class="btn btn-sm btn-outline-success d-md-none" type="button"
                            data-bs-toggle="offcanvas" data-bs-target="#mobileFilterOffcanvas"
                            style="white-space: nowrap;">
                            <i class="bi bi-funnel"></i> Lọc
                        </button>

                        <div class="d-flex align-items-center gap-2 ms-auto">
                            <form method="GET" action="" id="sort-form" class="m-0">
                                <?php echo $hiddenInputs; ?>
                                <input type="hidden" name="view" id="current-view-mode"
                                    value="<?php echo htmlspecialchars($viewOption); ?>">

                                <select name="sort" class="form-select form-select-sm"
                                    style="width: auto; min-width: 170px;"
                                    onchange="document.getElementById('sort-form').submit()">
                                    <option value="default"
                                        <?php echo ($sortOption === 'default') ? 'selected' : ''; ?>>Thứ Tự Mặc định
                                    </option>
                                    <option value="popularity"
                                        <?php echo ($sortOption === 'popularity') ? 'selected' : ''; ?>>Phổ Biến
                                    </option>
                                    <option value="price_asc"
                                        <?php echo ($sortOption === 'price_asc') ? 'selected' : ''; ?>>Giá thấp đến cao
                                    </option>
                                    <option value="price_desc"
                                        <?php echo ($sortOption === 'price_desc') ? 'selected' : ''; ?>>Giá cao đến thấp
                                    </option>
                                </select>
                            </form>

                            <div class="user-select-none d-flex align-items-center border-start ps-2">
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
                        </div>
                        <?php else: ?>
                        <?php foreach($productsOnPage as $value): ?>
                        <div class="col">
                            <div class="product-card h-100 border-0 shadow-sm position-relative">
                                <?php 
        $productUrl = 'detailproduct.php?id=' . htmlspecialchars($value['id']);
        $finalPrice = ($value['discount_price'] !== null && $value['discount_price'] < $value['price']) ? $value['discount_price'] : $value['price'];
        $showSaleBadge = ($value['is_sale'] == 1 && $value['discount_price'] !== null && $value['price'] > $value['discount_price']);
        ?>

                                <a href="<?php echo $productUrl; ?>" class="product-img-wrapper">
                                    <?php if ($showSaleBadge): ?>
                                    <span class="badge bg-danger position-absolute top-0 end-0 m-1">Sale</span>
                                    <?php endif; ?>
                                    <img src="<?php echo htmlspecialchars($value['image_url']) ?>" alt="...">
                                </a>

                                <div class="card-body">
                                    <a href="<?php echo $productUrl; ?>" class="text-decoration-none">
                                        <h6 class="product-title"><?php echo htmlspecialchars($value['name']) ?></h6>
                                    </a>

                                    <div class="product-price">
                                        <span
                                            class="text-danger fw-bold"><?php echo Product::formatCurrency($finalPrice) ?></span>
                                    </div>

                                    <div class="card-footer-mobile">
                                        <?php if ($value['state'] == 'còn hàng'): ?>
                                        <button class="btn btn-add-cart js-add-to-cart btn-success"
                                            data-product-id="<?= $value['id'] ?>" data-name="<?= $value['name'] ?>"
                                            data-price="<?= $finalPrice ?>" data-image-url="<?= $value['image_url'] ?>">
                                            THÊM VÀO GIỎ HÀNG
                                        </button>
                                        <?php else: ?>
                                        <a href="<?= $productUrl ?>" class="btn btn-add-cart btn-outline-secondary">ĐỌC
                                            TIẾP</a>
                                        <?php endif; ?>
                                    </div>
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
                <li><a href="<?= $backLink ?>">
                        < QUAY LẠI</a>
                </li>

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
                <li><a href="<?= $backToParentLink ?>">
                        < QUAY LẠI</a>
                </li>
                <li><a href="<?= $backToGeneralLink ?>">
                        < QUAY LẠI</a>
                </li>

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
// ========================================================
// 1. HÀM CẬP NHẬT BADGE (Total Unique Products)
// Cần phải có element <span id="cart-count-badge"> trong header của bạn
// ========================================================
function updateCartCountBadge() {
    // Giả sử có element icon giỏ hàng trong header với id="cart-count-badge"
    const cartCountBadge = document.getElementById('cart-count-badge');
    if (!cartCountBadge) return;

    const cart = JSON.parse(localStorage.getItem('cart')) || [];

    // Lấy tổng số LOẠI sản phẩm độc lập (cart.length)
    let totalUniqueProducts = cart.length;

    cartCountBadge.textContent = totalUniqueProducts > 99 ? '99+' : totalUniqueProducts.toString();

    // Hiển thị/Ẩn badge (Ẩn nếu giỏ hàng trống)
    if (totalUniqueProducts === 0) {
        cartCountBadge.style.display = 'none';
    } else {
        cartCountBadge.style.display = 'block';
    }
}

// ========================================================
// 2. LOGIC CHẾ ĐỘ XEM (VIEW MODE)
// ========================================================
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
// 3. HÀM XỬ LÝ CHUNG LƯU GIỎ HÀNG VÀ CẬP NHẬT BADGE
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
// 4. GẮN SỰ KIỆN KHI DOM TẢI XONG
// ========================================================
document.addEventListener('DOMContentLoaded', function() {
    // A. CHẠY KHI TẢI TRANG LẦN ĐẦU
    updateCartCountBadge();

    // B. Logic Collapse/Expand Sidebar
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

    // C. GẮN SỰ KIỆN CHO NÚT ADD TO CART (.js-add-to-cart)
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
                this.textContent = 'Thêm vào giỏ hàng';
                this.disabled = false;
            }, 1500);
        });
    });
});
</script>

</html>