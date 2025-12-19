<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Vườn Sài Gòn</title>

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <link rel="stylesheet" href="../VuonSaiGons/assets/css/style.css">

    <style>
    /* 2. Ảnh Banner */
    .banner-image-box {
        width: 90%;
        overflow: hidden;
        /* Nếu muốn banner có chiều cao cố định và cắt ảnh dư, hãy bỏ comment dòng dưới */
        /* max-height: 500px; */
    }

    .img-fluid-banner {
        width: 90%;
        /* Chiếm hết chiều ngang màn hình */
        height: auto;
        /* Chiều cao tự động theo tỉ lệ */
        display: block;
        /* Xóa khoảng trắng thừa dưới chân ảnh */
        object-fit: cover;
        /* Đảm bảo ảnh đẹp nếu set chiều cao cố định */
    }

    .cat-wrapper {
        position: relative;
        overflow: visible !important;
    }

    .cat-btn-desktop {
        background: transparent;
        border: none;
        font-weight: 600;
        color: #1f7a2f;
        display: flex;
        align-items: center;
        gap: 5px;
        padding: 10px 0;
        cursor: pointer;
    }

    .cat-dropdown-desktop {
        display: none;
        position: absolute;
        top: 100%;
        left: 0;
        width: 300px;
        background: #fff;
        border: 1px solid #e5e5e5;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        z-index: 1000001;
    }

    /* Từng dòng danh mục */
    .cat-item {
        padding: 10px 20px;
        /* Khoảng cách chữ so với lề */
        font-size: 15px;
        /* Kích thước chữ theo hình */
        color: #333;
        /* Màu chữ chính */
        font-weight: 500;
        text-transform: uppercase;
        /* Chữ in hoa giống mẫu */
        display: flex;
        justify-content: space-between;
        /* Đẩy tên sang trái, mũi tên sang phải */
        align-items: center;
        border-bottom: 1px solid #f1f1f1;
        /* Đường kẻ mờ giữa các mục */
        transition: all 0.2s ease;
    }

    /* Bỏ đường kẻ cho mục cuối cùng */
    .cat-item:last-child {
        border-bottom: none;
    }

    /* Hiệu ứng khi di chuột vào (Hover) */
    .cat-item:hover {
        background: #f8f9fa;
        color: #1A5D2E;
        /* Màu xanh thương hiệu khi hover */
        padding-left: 25px;
        /* Hiệu ứng dịch chuyển nhẹ sang phải */
    }

    /* Định dạng icon mũi tên bên phải */
    .cat-item i.bi-chevron-right {
        font-size: 12px;
        color: #999;
    }

    /* Định dạng thẻ liên kết bên trong */
    .cat-item a {
        text-decoration: none;
        color: inherit;
        display: block;
        width: 100%;
    }

    /* 2. Định dạng danh sách danh mục */
    .cat-item-container {
        list-style: none;
        border-bottom: 1px solid #eee;
        /* Đường kẻ giữa các mục */
    }

    .cat-item-container:last-child {
        border-bottom: none;
    }

    .cat-item-content {
        padding: 12px 20px;
        transition: all 0.2s ease;
    }

    .cat-item-content:hover {
        background-color: #f9f9f9;
    }

    /* 3. Kiểu chữ in hoa và icon */
    .cat-link {
        text-decoration: none;
        color: #333;
        font-size: 14px;
        font-weight: 600;
        /* Chữ đậm hơn */
        display: block;
        flex-grow: 1;
    }

    .cat-item-content:hover .cat-link {
        color: #1f7a2f;
        /* Màu xanh khi hover */
    }

    .collapse-toggle {
        cursor: pointer;
        color: #888;
        font-size: 12px;
    }

    /* Xoay mũi tên khi mở menu con (Tùy chọn) */
    .collapse-toggle[aria-expanded="true"] i {
        transform: rotate(90deg);
        display: inline-block;
    }

    /* Hiển thị dropdown khi hover vào wrapper */
    .cat-wrapper:hover .cat-dropdown-desktop {
        display: block;
    }

    .cat-item {
        padding: 12px 15px;
        border-bottom: 1px solid #f1f1f1;
        font-size: 14px;
        font-weight: 500;
        display: flex;
        justify-content: space-between;
        align-items: center;
        cursor: pointer;
    }

    .cat-item:hover {
        background: #f8f9fa;
        color: #1f7a2f;
    }

    /* hover blog  */
    /* Style cho Menu Blog */
    .blog-wrapper {
        position: relative;
        /* Đảm bảo menu con xuất hiện so với BLOG */
    }

    .blog-dropdown-desktop {
        display: none;
        position: absolute;
        /* Đặt menu con ngay dưới BLOG */
        top: 100%;
        left: 0;
        min-width: 250px;
        /* Độ rộng tối thiểu cho menu con */
        background: #fff;
        border: 1px solid #e5e5e5;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        z-index: 9998;
        /* Dưới danh mục chính 9999 */
        padding: 5px 0;
        /* Khoảng cách đệm bên trong */
    }

    /* Hiển thị dropdown khi hover vào wrapper */
    .blog-wrapper:hover .blog-dropdown-desktop {
        display: block;
    }

    .blog-item {
        padding: 8px 15px;
        font-size: 15px;
        font-weight: 500;
        color: #333;
        /* Màu chữ bình thường */
        text-decoration: none;
        /* Xóa gạch chân */
        display: block;
        /* Đảm bảo cả khu vực là clickable */
    }

    .blog-item:hover {
        background: #f8f9fa;
        color: #155d27;
        /* Màu xanh lá cây khi hover */
    }

    /* Thêm Mũi Tên Nhọn (Caret) */
    .blog-wrapper:hover .blog-dropdown-desktop::before {
        content: "";
        position: absolute;
        top: -8px;
        /* Di chuyển lên trên dropdown 10px */
        left: 20px;
        /* Căn chỉnh vị trí mũi tên (điều chỉnh theo ý bạn) */

        /* Kỹ thuật tạo hình tam giác */
        width: 0;
        height: 0;
        border-left: 10px solid transparent;
        border-right: 10px solid transparent;
        border-bottom: 10px solid #fff;
        /* Màu nền của mũi tên (trắng) */
        z-index: 9999;
    }

    .blog-wrapper:hover .blog-dropdown-desktop::after {
        content: "";
        position: absolute;
        top: -8px;
        /* Lên cao hơn một chút so với ::before */
        left: 20px;
        /* Cùng vị trí với ::before */

        /* Kỹ thuật tạo hình tam giác (Border ngoài) */
        width: 0;
        height: 0;
        border-left: 10px solid transparent;
        border-right: 10px solid transparent;
        border-bottom: 10px solid #e5e5e5;
        /* Màu border của dropdown */
        z-index: 9998;
    }

    /* Thêm vào thẻ <style> trong header.php */

    /* Wrapper cho phép Mini Cart định vị tương đối */
    .cart-wrapper-icon {
        display: grid;
        /* Quan trọng: Giữ wrapper vừa với nội dung */
    }

    /* CSS cho Mini Cart */
    .mini-cart {
        position: absolute;
        top: 100%;
        right: -10px;
        /* Di chuyển sang phải một chút để khớp icon */
        width: 480px;
        background: #fff;
        border: 1px solid #ccc;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        z-index: 9999;
        padding: 15px;
        transform: translateY(10px);
        /* Ngăn Mini Cart bị ẩn bởi Overflow */
        overflow: visible;
    }

    .mini-cart.hidden {
        display: none;
    }

    .mini-cart-item {
        display: flex;
        align-items: center;
        padding: 10px 0;
        border-bottom: 1px dotted #eee;
        font-size: 0.95rem;
    }

    .mini-cart-item:last-child {
        border-bottom: none;
    }

    .mini-item-img {
        width: 100px;
        height: 110px;
        margin-right: 10px;
        border: 1px solid #ddd;
        flex-shrink: 0;
    }

    .mini-item-name {
        flex-grow: 1;
        line-height: 1.3;
        font-weight: 500;
        color: #1e8738;
    }

    .mini-item-price {
        font-size: 0.9rem;
        color: #d70018;
        font-weight: bold;
        flex-shrink: 0;
    }

    .mini-cart-summary {
        padding-top: 15px;
        border-top: 1px solid #ccc;
        margin-top: 10px;
    }

    .sub-total-row {
        display: flex;
        justify-content: space-between;
        font-weight: bold;
        color: #333;
    }

    .sub-total-amount {
        color: #d70018 !important;
        font-size: 1.1rem;
    }

    .mini-cart-btn {
        padding: 10px 5px !important;
        font-size: 0.9rem !important;
        font-weight: bold !important;
    }

    /* Thêm vào khối CSS chính của bạn */

    /* --- CSS BỔ SUNG CHO MŨI TÊN TAM GIÁC (Nối icon và Mini Cart) --- */

    /* 1. Container Mini Cart */
    .mini-cart {
        position: absolute;
        /* Đã có, giữ nguyên */
        top: 100%;
        /* ... */
    }

    /* 2. Tạo mũi tên (Màu nền trắng) */
    .mini-cart::before {
        content: "";
        position: absolute;
        /* Điều chỉnh top: -11px để đặt mũi tên ngay trên border của pop-up */
        top: -10px;
        /* Điều chỉnh right: 35px để căn giữa với icon giỏ hàng */
        right: 12px;

        /* Kỹ thuật tạo hình tam giác */
        border-width: 0 10px 11px 10px;
        border-style: solid;
        border-color: transparent transparent #fff transparent;
        /* #fff là màu nền của pop-up */
        z-index: 1001;
    }

    /* 3. Tạo đường viền cho mũi tên (Màu xám nhạt) */
    /* Cần làm cho nó hơi lớn hơn ::before và nằm dưới một lớp */
    .mini-cart::after {
        content: "";
        position: absolute;
        /* Điều chỉnh top: -12px để bao quanh mũi tên trắng */
        top: -12px;
        right: 12px;

        /* Kỹ thuật tạo hình tam giác (Border Trick) */
        border-width: 0 10px 12px 10px;
        border-style: solid;
        border-color: transparent transparent #ccc transparent;
        /* #ccc là màu border của pop-up */
        z-index: 1000;
    }

    /* Trạng thái mặc định */
    #main-header {
        width: 100%;
        z-index: 1000;
        transition: all 0.3s ease;
    }

    /* Trạng thái khi LĂN CHUỘT XUỐNG (Sticky) */
    #main-header.is-sticky {
        position: fixed;
        top: 0;
        left: 0;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        animation: slideDown 0.4s ease;

    }

    /* 2. SỬA LẠI: Navigation Bar mặc định phải hiển thị */
    .navigation-bar {
        background: #fff;
        position: relative;
        z-index: 99999;
        /* Đảm bảo luôn hiện lúc đầu */
        display: block;
        max-height: 100px;
        opacity: 1;
        overflow: visible !important;
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    }

    /* Khi sticky: Ẩn bớt phần Menu bên dưới (như hình 3 bạn muốn) */
    /* Nếu bạn muốn ẩn dòng Menu khi cuộn, hãy dùng dòng dưới */
    #main-header.is-sticky .navigation-bar {
        display: none !important;
        max-height: 0;
        /* Thu nhỏ chiều cao về 0 */
        opacity: 0;
        /* Làm mờ dần */
        border-top: none;
        pointer-events: none;
        /* Ngăn người dùng click khi đang ẩn */
    }

    /* Đảm bảo nội dung trang không bị đẩy lên đột ngột */
    body.has-sticky {
        padding-top: 150px;
        /* Điều chỉnh con số này bằng chiều cao header của bạn */
    }

    @keyframes slideDown {
        from {
            transform: translateY(-100%);
            opacity: 0;
        }

        to {
            transform: translateY(0);
            opacity: 1;
        }
    }

    /* Mobile vẫn giữ 70px (Menu Danh mục đã bị ẩn d-none d-md-block) */
    @media (max-width: 991.98px) {
        body {
            padding-top: 70px !important;
        }
    }


    .header-wrapper-fixed {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        z-index: 9999999 !important;
        /* Cao nhất để không bị banner đè */
        background: #fff;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
    }

    #main-header {
        width: 100%;
        background: #fff;
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    }
    </style>
</head>
<?php  
 include "config.php";
 include "Models/db.php";
 include "Models/banner.php";
include 'models/product.php'; // Nhúng file model vừa tạo
include 'models/categories.php'; // Nhúng file model vừa tạo
include 'models/video.php'; // Nhúng file model vừa tạo
include 'models/blog.php'; // Nhúng file model vừa tạo
// === BỔ SUNG: KHAI BÁO BIẾN CƠ SỞ CHO ĐƯỜNG DẪN ===
$APP_BASE_PATH = '/VuonSaiGons/'; 

// === KHỞI TẠO BIẾN TRƯỚC KHI DÙNG (CỰC KỲ QUAN TRỌNG) ===
$mainBlogCategories = [];

// Lấy dữ liệu danh mục HỆ THỐNG
$categoriesModel = new Categories();
$allCategoriesHierarchical = $categoriesModel->get_categories_hierarchical();

// Lấy dữ liệu danh mục Blog
$blogModels = new Blog();
$blogHeaderCategories = $blogModels->getAllCategories();
// Lọc chỉ giữ các danh mục chính cho menu dropdown (ví dụ: Phong thủy, Kỹ thuật nông nghiệp, Hoạt động công ty)
// Giả sử các danh mục có sort_order nhỏ hơn (10, 20, 30) là các danh mục chính.
// Trong trường hợp này, chúng ta sẽ lọc 3 danh mục đầu tiên: Kỹ thuật nông nghiệp (1), Hoạt động công ty (2), Phong thủy (3)
$mainBlogCategorie = array_slice($blogHeaderCategories, 0, 3);
if (!is_array($blogHeaderCategories)) {
    $blogHeaderCategories = [];
}
if (!is_array($mainBlogCategories)) {
    $mainBlogCategories = [];
}
 

?>

<body>
    <div class="header-wrapper-fixed ">
        <div id="main-header">
            <header class="container-fluid border-bottom bg-white top-bar">
                <div class="row align-items-center py-2">

                    <div class="col-2 col-lg-2 logo text-center text-md-start px-1 px-md-3 ps-lg-5">
                        <a href="index.php">
                            <img src="https://vuonsaigon.vn/wp-content/uploads/2020/11/Logo-vsg-web.png" height="40"
                                class="img-fluid">
                        </a>
                    </div>

                    <div class="col-6 col-lg-5 px-1 search-mobile" style="padding-left: 10% !important">
                        <form **action="" ** method="GET" class="input-group" id="searchForm">
                            <select name="search_type" class="form-select d-none d-md-block bg-light border-end-0"
                                style="max-width:130px;" id="searchTypeSelect">
                                <option value="product">Sản phẩm</option>
                                <option value="blog">Bài viết</option>
                            </select>

                            <input type="text" name="keyword" class="form-control" placeholder="Tìm kiếm...">

                            <button class="btn btn-success" type="submit">
                                <i class="bi bi-search d-md-none"></i>
                                <span class="d-none d-md-inline">Tìm kiếm</span>
                            </button>
                        </form>
                    </div>

                    <div class="col-4 col-lg-5  icon-group px-1 px-md-3">
                        <div class="d-flex justify-content-end align-items-center gap-2 gap-md-3 pe-lg-5">

                            <a href="tel:0909123409" class="text-danger fw-bold text-decoration-none d-none d-lg-block"
                                style="font-size: 15px; font-size: 15px; padding-right: 10%;">
                                <i class="bi bi-telephone me-1"></i> 0909 1234 09 - 082 799 7777
                            </a>
                            <a href="#" class="text-dark position-relative text-decoration-none">
                                <i class="bi bi-heart fs-5"></i>
                                <span
                                    class="position-absolute top-0 start-100 translate-middle badge bg-success rounded-pill d-none d-md-block"
                                    style="font-size:0.6rem">0</span>
                            </a>

                            <div class="cart-wrapper-icon position-relative">
                                <a href="shopping-cart.php" id="cart-icon"
                                    class="text-dark position-relative text-decoration-none me-1">
                                    <i class="bi bi-cart fs-5"></i>
                                    <span id="cart-count-badge"
                                        class="position-absolute top-0 start-100 translate-middle badge bg-success rounded-pill"
                                        style="font-size:0.6rem">0</span>
                                </a>

                                <div id="mini-cart-dropdown" class="mini-cart hidden">
                                    <div id="mini-cart-items">
                                    </div>
                                    <div class="mini-cart-summary">
                                        <div class="sub-total-row">
                                            <span>Tổng số phụ:</span>
                                            <span id="mini-cart-subtotal"
                                                class="sub-total-amount text-danger fw-bold">0₫</span>
                                        </div>
                                        <div class="d-flex justify-content-between gap-2 mt-3">
                                            <a href="shopping-cart.php"
                                                class="btn btn-success btn-sm flex-fill mini-cart-btn">Xem giỏ hàng</a>
                                            <a href="checkout.php"
                                                class="btn btn-dark btn-sm flex-fill mini-cart-btn">Thanh
                                                toán</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <button class="btn btn-danger"><a style="color: white; text-decoration: none;"
                                        href="admin/pages/logout.php">Sign In</a></button>
                            </div>

                            <button class="btn p-0 border-0 d-md-none" data-bs-toggle="offcanvas"
                                data-bs-target="#menuCanvas">
                                <i class="bi bi-list fs-2 text-success"></i>
                            </button>
                        </div>
                    </div>

                </div>
            </header>
            <div class="container-fluid border-bottom d-none d-md-block navigation-bar" style="padding: 1%;">

                <div class="container py-2 d-flex align-items-center gap-4">
                    <div class="cat-wrapper">
                        <button class="cat-btn-desktop">
                            <i class=""></i> DANH MỤC SẢN PHẨM
                            <i class="bi bi-chevron-down"></i>
                        </button>
                        <div class="cat-dropdown-desktop">
                            <ul class="p-0 m-0">
                                <?php Categories::displays_categories_html($allCategoriesHierarchical); ?>
                            </ul>
                        </div>
                    </div>

                    <a href="introduce.php" class="fw-bold text-success text-decoration-none ms-5" style="
                padding-left: 5%;">GIỚI THIỆU</a>

                    <a href="product.php" class="fw-bold text-success text-decoration-none">SẢN PHẨM</a>
                    <a href="video.php" class="fw-bold text-success text-decoration-none">VIDEO</a>

                    <div class="blog-wrapper">
                        <a href="blog.php" class="fw-bold text-success text-decoration-none blog-toggle">
                            BLOG <i class="bi bi-chevron-down ms-1" style="font-size: 0.8em;"></i>
                        </a>

                        <div class="blog-dropdown-desktop">
                            <?php 
        if (!empty($mainBlogCategories)) {
            foreach ($mainBlogCategories as $cat) {
                // Đường dẫn động
                $link = 'blog.php?cat=' . urlencode($cat['slug']);
                echo '<a href="' . $link . '" class="blog-item">' . htmlspecialchars($cat['name']) . '</a>';
            }
        } else {
            // Đường dẫn tĩnh, sử dụng biến APP_BASE_PATH đã định nghĩa
            echo '<a href="' . $APP_BASE_PATH . 'blog.php?cat=ky-thuat-nong-nghiep" class="blog-item">Kỹ thuật nông nghiệp</a>';
            echo '<a href="' . $APP_BASE_PATH . 'blog.php?cat=hoat-dong-cong-ty" class="blog-item">Hoạt động công ty</a>';
            echo '<a href="' . $APP_BASE_PATH . 'blog.php?cat=phong-thuy" class="blog-item">Phong thủy</a>';
        }
        ?>
                        </div>
                    </div>
                    <a href="contact.php" class="fw-bold text-success text-decoration-none">LIÊN HỆ</a>
                </div>
            </div>
        </div>
    </div>



    <div class="offcanvas offcanvas-start" id="menuCanvas" style="width: 300px;">
        <div class="offcanvas-header bg-success text-white">
            <h5 class="offcanvas-title">DANH MỤC</h5>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas"></button>
        </div>
        <div class="offcanvas-body p-0">
            <div class="p-3 border-bottom d-md-none">
                <form action="<?php echo $APP_BASE_PATH; ?>product.php" method="GET" class="input-group">
                    <input type="text" name="keyword" class="form-control form-control-sm"
                        placeholder="Tìm sản phẩm...">
                    <button class="btn btn-success btn-sm" type="submit"><i class="bi bi-search"></i></button>
                </form>
            </div>

            <ul class="list-group list-group-flush">
                <a href="index.php" class="list-group-item list-group-item-action fw-bold text-success">TRANG CHỦ</a>

                <div class="fw-bold p-3 bg-light text-secondary" style="font-size: 0.8rem;">DANH MỤC SẢN PHẨM</div>

                <?php 
            // Hàm đệ quy hiển thị danh mục cho Offcanvas
            function renderMobileCategories($categories, $basePath) {
                foreach ($categories as $index => $cat) {
                    $hasChild = !empty($cat['children']);
                    $targetId = "mob-cat-" . $cat['id'];
                    
                    echo '<li class="list-group-item p-0">';
                    echo '<div class="d-flex align-items-center justify-content-between w-100">';
                    
                    // Link dẫn tới trang sản phẩm theo danh mục
                    echo '<a href="' . $basePath . 'product.php?cat=' . $cat['id'] . '" class="flex-grow-1 py-3 ps-3 text-decoration-none text-dark" style="font-size: 14px;">' . htmlspecialchars($cat['name']) . '</a>';
                    
                    // Nếu có con thì hiện nút mũi tên để xổ xuống
                    if ($hasChild) {
                        echo '<span class="px-3 py-3 border-start collapse-toggle" data-bs-toggle="collapse" data-bs-target="#' . $targetId . '">
                                <i class="bi bi-chevron-right"></i>
                              </span>';
                    }
                    echo '</div>';

                    // Khối menu con
                    if ($hasChild) {
                        echo '<div class="collapse bg-light" id="' . $targetId . '">';
                        echo '<ul class="list-group list-group-flush ps-3">';
                        renderMobileCategories($cat['children'], $basePath); // Đệ quy
                        echo '</ul>';
                        echo '</div>';
                    }
                    echo '</li>';
                }
            }

            if (!empty($allCategoriesHierarchical)) {
                renderMobileCategories($allCategoriesHierarchical, $APP_BASE_PATH);
            }
            ?>

                <div class="fw-bold p-3 bg-light text-secondary" style="font-size: 0.8rem;">THÔNG TIN</div>
                <a href="introduce.php" class="list-group-item list-group-item-action">GIỚI THIỆU</a>
                <a href="blog.php" class="list-group-item list-group-item-action">BLOG</a>
                <a href="video.php" class="list-group-item list-group-item-action">VIDEO</a>
                <a href="contact.php" class="list-group-item list-group-item-action border-bottom-0">LIÊN HỆ</a>
            </ul>
        </div>
    </div>
</body>
<script>
window.addEventListener('scroll', function() {
    const header = document.getElementById('main-header');
    const body = document.body;

    // Khi cuộn xuống quá 150px
    if (window.scrollY > 100) {
        header.classList.add('is-sticky');
        body.classList.add('has-sticky');
    } else {
        header.classList.remove('is-sticky');
        body.classList.remove('has-sticky');
    }
});
// ----------------------------------------------------------------------
// HÀM TIỆN ÍCH
// ----------------------------------------------------------------------

// Định nghĩa hàm formatCurrency (cần thiết cho Mini Cart)
function formatCurrency(price) {
    price = isNaN(price) ? 0 : price;
    return new Intl.NumberFormat('vi-VN', {
        style: 'currency',
        currency: 'VND'
    }).format(price);
}

// ----------------------------------------------------------------------
// HÀM CẬP NHẬT BADGE (Total Unique Products)
// ----------------------------------------------------------------------
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

// ----------------------------------------------------------------------
// HÀM XỬ LÝ XÓA SẢN PHẨM TRONG GIỎ (GLOBAL)
// ----------------------------------------------------------------------
window.removeProductFromCart = function(productIdToRemove) {
    let cart = JSON.parse(localStorage.getItem('cart')) || [];

    // Lọc ra sản phẩm muốn xóa
    cart = cart.filter(item => item.id != productIdToRemove);

    localStorage.setItem('cart', JSON.stringify(cart));

    // Cập nhật cả Mini Cart và Badge
    updateCartCountBadge();
    renderMiniCart(); // Render lại Mini Cart ngay lập tức
};


// ----------------------------------------------------------------------
// HÀM RENDER MINI CART
// ----------------------------------------------------------------------
function renderMiniCart() {
    const miniCart = document.getElementById('mini-cart-dropdown');
    const miniCartItemsContainer = document.getElementById('mini-cart-items');
    const miniCartSubtotalDisplay = document.getElementById('mini-cart-subtotal');

    if (!miniCart || !miniCartItemsContainer || !miniCartSubtotalDisplay) return;

    const cart = JSON.parse(localStorage.getItem('cart')) || [];

    miniCartItemsContainer.innerHTML = ''; // Xóa nội dung cũ

    let subTotal = 0;
    const maxItemsToShow = 3;
    let itemsToDisplay = cart.slice(0, maxItemsToShow);

    if (cart.length === 0) {
        // Giỏ hàng trống
        miniCartItemsContainer.innerHTML =
            '<p style="text-align: center; margin: 10px 0; color: #666;">Giỏ hàng trống.</p>';
        miniCartSubtotalDisplay.textContent = formatCurrency(0);
        return;
    }

    // 1. Render các sản phẩm (tối đa 3)
    itemsToDisplay.forEach(item => {
        const itemSubtotal = item.price * item.quantity;
        subTotal += itemSubtotal;

        const itemElement = document.createElement('div');
        itemElement.className = 'mini-cart-item';
        itemElement.innerHTML = `
            <div class="mini-item-img">
                <img src="${item.imageUrl}" alt="${item.name}" style="width: 100%; height: 100%; object-fit: contain;">
            </div>
            <div class="mini-item-name">
                <a href="detailproduct.php?id=${item.id}" style="color: #0066cf;text-decoration: none;">${item.name}</a>
                <p style="margin: 0; font-size: 1rem; color: #555;text-align: justify;">${item.quantity} &times; ${formatCurrency(item.price)}</p>
            </div>
            <span class="remove-from-mini-cart" data-product-id="${item.id}" style="cursor: pointer; color: #ccc;">&times;</span>
        `;
        miniCartItemsContainer.appendChild(itemElement);
    });

    // 2. Hiển thị thông báo nếu có nhiều hơn 3 sản phẩm
    if (cart.length > maxItemsToShow) {
        const moreInfo = document.createElement('p');
        moreInfo.style.textAlign = 'center';
        moreInfo.style.fontSize = '0.9rem';
        moreInfo.style.marginTop = '5px';
        moreInfo.style.marginBottom = '0';
        moreInfo.textContent = `Và ${cart.length - maxItemsToShow} sản phẩm khác...`;
        miniCartItemsContainer.appendChild(moreInfo);
    }

    // 3. Cập nhật Tổng số phụ
    miniCartSubtotalDisplay.textContent = formatCurrency(subTotal);

    // 4. Gắn lại sự kiện xóa sản phẩm trong Mini Cart
    document.querySelectorAll('.remove-from-mini-cart').forEach(button => {
        button.addEventListener('click', function() {
            // Gọi hàm xóa sản phẩm (đã định nghĩa ở phạm vi toàn cục)
            window.removeProductFromCart(this.dataset.productId);
        });
    });
}


// ----------------------------------------------------------------------
// LOGIC SỰ KIỆN DOM CONTENT LOADED
// ----------------------------------------------------------------------

document.addEventListener('DOMContentLoaded', function() {
    // 1. Chạy ngay khi trang tải xong
    updateCartCountBadge();

    // ----------------------------------------------------------------------
    // 2. LOGIC HOVER MINI CART
    // ----------------------------------------------------------------------
    const cartWrapper = document.querySelector('.cart-wrapper-icon');
    const miniCart = document.getElementById('mini-cart-dropdown');

    let timeout;

    if (cartWrapper && miniCart) {
        // Xử lý khi di chuột VÀO (Hover In)
        cartWrapper.addEventListener('mouseenter', () => {
            clearTimeout(timeout);
            renderMiniCart(); // Render nội dung Mini Cart
            miniCart.classList.remove('hidden');
        });

        // Xử lý khi di chuột RA (Hover Out)
        cartWrapper.addEventListener('mouseleave', () => {
            // Đặt timeout để ẩn sau một khoảng thời gian ngắn (vd: 300ms)
            timeout = setTimeout(() => {
                miniCart.classList.add('hidden');
            }, 300);
        });
    }

    // ----------------------------------------------------------------------
    // 3. LOGIC XỬ LÝ NÚT ADD TO CART (Giữ nguyên logic cập nhật badge)
    // ----------------------------------------------------------------------

    // Hàm giả lập logic AddToCart cơ bản để đảm bảo updateCartCountBadge được gọi
    window.simulateAddToCartLogic = function(event) {
        // [Logic AddToCart sẽ nằm ở các file khác]
        // Sau khi logic của các file khác thực thi và lưu LocalStorage:
        updateCartCountBadge();
        // Mini Cart sẽ được cập nhật khi hover tiếp theo
    }

    // Ví dụ: Gắn lại sự kiện cho các nút có class .js-add-to-cart (nếu cần cho file header test)
    const addToCartButtons = document.querySelectorAll('.js-add-to-cart');
    addToCartButtons.forEach(button => {
        button.addEventListener('click', window.simulateAddToCartLogic);
    });

    const bigAddToCartButton = document.getElementById('btn-add-to-cart-detail');
    if (bigAddToCartButton) {
        bigAddToCartButton.addEventListener('click', function(event) {
            // [Logic AddToCart sẽ nằm ở các file khác]
            // Giả định logic processAddToCart đã được thực thi và gọi updateCartCountBadge()
        });
    }

    // START: LOGIC CHUYỂN ACTION FORM TÌM KIẾM (ĐÃ CẢI THIỆN)
    const selectElement = document.getElementById('searchTypeSelect');
    const formElement = document.getElementById('searchForm');

    // **ĐỊNH NGHĨA ĐƯỜNG DẪN GỐC CỦA ỨNG DỤNG**
    // Sử dụng path tuyệt đối để tránh lỗi submit về trang gốc (/)
    const APP_BASE_PATH = '/VuonSaiGons/';

    if (selectElement && formElement) {

        // Hàm cập nhật thuộc tính action của form
        function updateFormAction() {
            const selectedValue = selectElement.value; // Lấy giá trị đang chọn

            if (selectedValue === 'blog') {
                // Đặt URL tuyệt đối cho Bài viết: /VuonSaiGons/article.php
                formElement.action = APP_BASE_PATH + 'article.php';
            } else {
                // Đặt URL tuyệt đối cho Sản phẩm: /VuonSaiGons/product.php
                formElement.action = APP_BASE_PATH + 'product.php';
            }
        }

        // 1. Gắn sự kiện change để cập nhật action khi người dùng thay đổi
        selectElement.addEventListener('change', updateFormAction);

        // 2. Cực kỳ quan trọng: Gọi hàm ngay khi DOM tải xong để thiết lập action ban đầu
        updateFormAction();
    }
    // END: LOGIC CHUYỂN ACTION FORM TÌM KIẾM
});
</script>

</html>