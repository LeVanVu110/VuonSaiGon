<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kỹ thuật trồng hoa triều chuông - Vườn Sài Gòn</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <style>
    /* ================================================= */
    /* THIẾT LẬP CHUNG VÀ BIẾN MÀU */
    /* ================================================= */
    :root {
        --primary-green: #1A5D2E;
        --banner-title-green: #B7FF5A;
        --toc-green: #449D47;
        --vsg-red: #C52928;

        --header-total-height: 90px;
        --banner-height: 600px;
    }

    body {
        margin: 0;
        padding: 0;
    }

    a {
        text-decoration: none;
        color: inherit;
    }

    /* ================================================= */
    /* HEADER CỐ ĐỊNH (Luôn nằm trên cùng) */
    /* ================================================= */
    .header-wrapper {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: var(--header-height);
        z-index: 9999 !important;
        background-color: #fff;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
    }

    .header-top {
        padding: 8px 0;
        border-bottom: 1px solid #eee;
    }

    .header-main {
        padding: 0;
        border-bottom: 1px solid #eee;
    }

    .logo-text {
        color: var(--primary-green);
        font-size: 20px;
        font-weight: bold;
        display: flex;
        align-items: center;
    }

    .logo-text img {
        height: 30px;
        margin-right: 5px;
    }

    .contact-info {
        font-size: 14px;
        color: var(--vsg-red);
        font-weight: bold;
    }

    .header-icons a {
        color: #777;
        margin-left: 15px;
        position: relative;
        font-size: 18px;
    }

    .main-menu .nav-link {
        padding: 12px 15px;
        font-weight: 500;
        color: #333;
        text-transform: uppercase;
        font-size: 14px;
    }

    .main-menu .nav-link:hover {
        color: var(--primary-green);
    }

    /* ================================================= */
    /* BANNER CHÍNH (Bắt đầu ngay dưới Header) */
    /* ================================================= */
    .main-header-banner {
        position: fixed;
        top: var(--header-total-height);
        left: 0;
        width: 100%;
        height: var(--banner-height);
        z-index: 1;

        /* THIẾT LẬP ĐỂ ẢNH LẶP LẠI (GIỐNG HÌNH BẠN GỬI) */

        /* 1. Cho phép ảnh lặp lại (Tile) */
        background-repeat: repeat-x;

        /* 2. KHÔNG dùng cover (vì cover sẽ ép ảnh to ra và mất hiệu ứng lặp) */
        /* Bạn có thể để 'contain' hoặc một kích thước % cố định để thấy rõ sự lặp lại */
        background-size: contain;

        /* 3. Căn ảnh gốc nằm ở giữa, phần thừa 2 bên sẽ tự lặp lại nửa đầu/nửa cuối ảnh */
        background-position: center center;

        /* Giữ cố định ảnh khi cuộn */
        background-attachment: fixed;

        display: flex;
        justify-content: center;
        align-items: center;
    }

    .main-header-banner::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(0, 0, 0, 0.25);
    }

    .banner-content {
        position: relative;
        z-index: 10;
        color: white;
        text-align: center;
        text-shadow: 2px 2px 6px rgba(0, 0, 0, 0.6);
        margin: 3px 355px 3px 355px;
    }

    .banner-category {
        font-size: 14px;
        font-weight: 500;
        letter-spacing: 2px;
        margin-bottom: 5px;
        color: #d1d1d1;
        background-color: rgba(0, 0, 0, 0.3);
        padding: 5px 10px;
        border-radius: 3px;
        display: inline-block;
    }

    /* ================================================= */
    /* NỘI DUNG CUỘN (Lấp đầy khoảng trống) */
    /* ================================================= */
    .main-content-wrapper {
        margin-top: calc(var(--header-total-height) + var(--banner-height));
        position: relative;
        z-index: 10;
        /* Đè lên Banner khi cuộn chuột */
        background-color: #fff;
        /* Nền trắng che banner */
    }

    .article-content-wrapper {
        background-color: #fff;
        padding: 40px 0;
    }

    /* ================================================= */
    /* CÁC THÀNH PHẦN NỘI DUNG */
    /* ================================================= */
    .content-index {
        border: 1px solid #ddd;
        padding: 15px;
        margin-bottom: 30px;
        background-color: #fff;
        border-radius: 5px;
    }

    .index-header {
        font-size: 18px;
        font-weight: bold;
        color: var(--toc-green);
        border-bottom: 1px solid #eee;
        padding-bottom: 10px;
        display: flex;
        justify-content: space-between;
        cursor: pointer;
    }

    .index-list {
        list-style: none;
        padding: 0;
        margin: 10px 0 0 0;
    }

    .index-list a:hover {
        color: var(--primary-green);
        text-decoration: underline;
    }

    .article-body h2 {
        color: var(--toc-green);
        font-size: 24px;
        font-weight: bold;
        margin-top: 35px;
        border-bottom: 2px solid #eee;
        padding-bottom: 8px;
    }

    .article-body p {
        line-height: 1.8;
        color: #333;
        margin-bottom: 18px;
    }

    .article-body img {
        max-width: 100%;
        height: auto;
        display: block;
        margin: 25px auto;
        border-radius: 4px;
    }

    .banner-title {
        font-family: 'Playfair Display', serif;
        font-weight: 900;
        color: #4E8A0E;
        text-transform: uppercase;
        line-height: 1.2;
        letter-spacing: -1px;
        padding-bottom: 40px;
        /* Tạo cảm giác khít như hình */
    }

    .banner-subtitle {
        font-size: 1.5rem;
        padding-bottom: 40px;
    }
    </style>
</head>
<?php
$blogModel = new Blog();
    // 2. Lấy ID từ URL
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

// 3. Truy vấn lấy 1 bài viết duy nhất (Giả sử bạn có hàm getPostById)
$result = $blogModel->getPostById($id);
$baiviet = $result['post'];    // Mảng 1 chiều chứa thông tin bài
$mucLuc   = $result['titles'];
?>

<body>

    <div class="main-header-banner" style="background-image: url('<?php echo $baiviet['image']; ?>');">
        <div class="banner-content">
            <h2 class="banner-subtitle"><?php echo $baiviet['category_name']; ?></h2>

            <h1 class="banner-title"><?php echo $baiviet['title']; ?></h1>
            <p class="banner-meta">
                <?php echo date('d/m/Y', strtotime($baiviet['created_at'])); ?> | Bởi <?php echo $baiviet['author']; ?>
            </p>
        </div>
    </div>

    <div class="main-content-wrapper">

        <div class="article-content-wrapper">

            <div class="container main-content">

                <div class="content-index shadow-sm">
                    <div class="index-header"
                        onclick="document.getElementById('indexList').classList.toggle('d-none');">
                        <span>
                            <i class="fas fa-list-ul me-2"></i>Nội dung chính
                        </span>
                        <i class="fas fa-chevron-down"></i>
                    </div>

                    <ul class="index-list" id="indexList">
                        <?php 
                            $i = 1; 
                            foreach($mucLuc as $parent) { 
                                // Kiểm tra nếu là mục chính (parent_id = 0)
                                if($parent['parent_id'] == 0) { 
                            ?>
                        <li>
                            <?php echo $i; ?>. <a href="#muc<?php echo $i; ?>"><?php echo $parent['title']; ?></a>

                            <ul class="index-list ps-3 mt-1">
                                <?php 
                                    $sub = 1;
                                    foreach($mucLuc as $child) {
                                        if($child['parent_id'] == $parent['article_title_id']) { 
                                    ?>
                                <li class="sub-item">
                                    <a href="#muc<?php echo $i . '-' . $sub; ?>">
                                        <?php echo $child['title']; ?>
                                    </a>
                                </li>
                                <?php $sub++; } } ?>
                            </ul>
                        </li>
                        <?php $i++; } } ?>
                    </ul>
                </div>

                <div class="article-body">
                    <?php 
    $u = 1; 
    foreach($mucLuc as $parent) {
        if($parent['parent_id'] == 0) { 
    ?>
                    <h2 id="muc<?php echo $u; ?>"><?php echo $u; ?>. <?php echo $parent['title']; ?></h2>
                    <div class="content-main"><?php echo $parent['content']; ?></div>

                    <?php 
        $sub = 1;
        foreach($mucLuc as $child) {
            if($child['parent_id'] == $parent['article_title_id']) { 
        ?>
                    <h3 id="muc<?php echo $u . '-' . $sub; ?>"
                        style="margin-left: 20px; font-size: 20px; color: var(--toc-green);">
                        <?php echo $u . "." . $sub; ?>. <?php echo $child['title']; ?>
                    </h3>
                    <div class="content-sub" style="margin-left: 20px;"><?php echo $child['content']; ?></div>
                    <?php $sub++; } } ?>

                    <?php $u++; } } ?>
                </div>
            </div>


            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
            <script>
            // Script để ẩn hiện mục lục (TOC)
            document.addEventListener('DOMContentLoaded', function() {
                const indexHeader = document.querySelector('.index-header');
                const indexList = document.getElementById('indexList');
                const chevronIcon = indexHeader.querySelector('.fa-chevron-down');

                indexHeader.addEventListener('click', function() {
                    indexList.classList.toggle('d-none');
                    chevronIcon.classList.toggle('fa-rotate-180'); // Xoay mũi tên khi ẩn/hiện
                });
            });
            </script>
</body>

</html>