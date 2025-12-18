<?php
// Tên file: article.php (hoặc trang đích tìm kiếm bài viết)

// ----------------------------------------------------
// 1. INCLUDE CÁC FILE CẦN THIẾT
// ----------------------------------------------------
// Bạn cần đảm bảo các file này tồn tại và Class Db/kết nối hoạt động.
// Lưu ý: Cần chỉnh sửa class Blog để hỗ trợ tham số $keyword trong các hàm getTotalPosts và getPostsByPage
// (như đã hướng dẫn trong các câu trả lời trước đó).

// include "config.php"; 
// include "Models/db.php"; 
// include "Models/blog.php"; 

// --- MOCKING CÁC ĐỐI TƯỢNG CẦN THIẾT (SỬ DỤNG LẠI CHO MỤC ĐÍCH DEMO) ---

$blogModel = new Blog();
// --- END MOCKING ---


// ----------------------------------------------------
// 2. XỬ LÝ DỮ LIỆU TÌM KIẾM (CHỈ DÙNG 1 BÀI/TRANG)
// ----------------------------------------------------

$keyword = isset($_GET['keyword']) ? htmlspecialchars(trim($_GET['keyword'])) : '';
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$perPage = 9; // CHỈ HIỂN THỊ MỘT BÀI VIẾT LỚN MỖI TRANG

// Lấy tổng số bài viết
$totalPosts = $blogModel->getTotalPostss(null, $keyword);
$totalPages = ceil($totalPosts / $perPage);

// Lấy danh sách bài viết cho trang hiện tại (chỉ 1 bài)
$posts = $blogModel->getPostsByPages($page, $perPage, null, $keyword);


?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kết quả tìm kiếm - Bài viết</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        /* CSS CŨ ĐƯỢC GIỮ NGUYÊN */
        body { font-family: Arial, sans-serif; margin: 0; padding: 0; background-color: #ffffff; }
        .container { width: 90%; max-width: 1200px; margin: 0 auto; padding: 20px 0; }
        .search-result-title { color: #38761d; text-align: center; font-size: 36px; font-weight: bold; margin: 40px 0 20px 0; }
        .breadcrumb { font-size: 14px; color: #333; margin: 20px 0 30px 0; padding-left: 0; }
        .breadcrumb a { color: #4a86e8; text-decoration: none; }
        .breadcrumb a:hover { text-decoration: underline; }
        .content-wrapper { display: flex; gap: 100px; }
        .main-article-column { flex: 2; }
        .sidebar-column { flex: 1.23; }
        .article-card.main-article { background-color: white; box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1); border-radius: 5px; overflow: hidden; }
        .image-container { position: relative; width: 100%; }
        .article-image { width: 100%; height: auto; display: block; background-color: #eee; min-height: 250px; }
        .article-title-overlay { position: absolute; bottom: 20px; left: 50%; transform: translateX(-50%); background-color: rgba(255, 255, 255, 0.95); color: #333; padding: 15px 30px; font-size: 20px; font-weight: bold; text-align: center; border-radius: 10px; border: 3px solid #ff9900; white-space: nowrap; }
        .logo-overlay { position: absolute; top: 20px; left: 20px; background-color: rgba(255, 255, 255, 0.95); padding: 10px 15px; border-radius: 5px; }
        .logo-text { color: #38761d; font-weight: bold; font-size: 14px; }
        .article-info-box { background-color: #f7f7f7; padding: 65px; border-radius: 5px; border-left: 5px solid #d9d9d9; height: fit-content; }
        .article-info-box .category { color: #777; font-size: 13px; text-transform: uppercase; margin-bottom: 15px; }
        .article-info-box .title-small { color: #333; font-size: 18px; font-weight: bold; line-height: 1.4; margin: 0 0 10px 0; }
        .article-info-box .excerpt { color: #555; font-size: 17px; line-height: 1.6; }
        .live-chat-button { position: fixed; bottom: 20px; right: 20px; background-color: #38761d; color: white; padding: 10px 20px; border-radius: 50px; text-decoration: none; font-weight: bold; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); display: flex; align-items: flex-start; justify-content: center; font-size: 14px; z-index: 100; }
        .live-chat-button:before { content: '💬'; margin-right: 5px; font-size: 16px; }
        @media (max-width: 768px) {
            .content-wrapper { flex-direction: column; }
            .article-title-overlay { position: static; transform: none; width: auto; margin: 15px; font-size: 16px; }
        }
        /* CSS BỔ SUNG CHO DANH SÁCH DƯỚI (Mặc dù đã bị loại bỏ) */
        .other-posts-grid { display: none; }
        .no-results { text-align: center; color: #777; padding: 30px; border: 1px dashed #ddd; }
        .pagination { display: flex; justify-content: center; margin-top: 30px; }
        .pagination a, .pagination span { padding: 8px 15px; margin: 0 4px; border: 1px solid #ddd; text-decoration: none; color: #38761d; border-radius: 4px; }
        .pagination .current-page { background-color: #38761d; color: white; border-color: #38761d; font-weight: bold; }
        /* CSS MỚI: Dành cho danh sách kết quả tìm kiếm */
    /* Đảm bảo mỗi bài viết chiếm 100% chiều rộng container */
    .list-item-wrapper {
        border: 1px solid #ddd;
        margin-bottom: 25px; /* Khoảng cách giữa các bài viết */
        padding: 15px;
        display: flex; /* Dùng flex để xếp hình và nội dung */
        gap: 20px;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
        border-radius: 5px;
    }
    
    .list-item-image {
        flex-shrink: 0; /* Ngăn ảnh bị co lại */
        width: 250px; /* Chiều rộng cố định cho ảnh */
        height: 150px;
        overflow: hidden;
    }
    
    .list-item-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    
    .list-item-content {
        flex-grow: 1;
    }

    .list-item-content h2 {
        font-size: 22px;
        color: #38761d;
        margin: 0 0 10px 0;
    }

    .list-item-content p {
        font-size: 15px;
        color: #555;
        line-height: 1.5;
    }
    
    .list-item-content a {
        text-decoration: none;
    }

    /* Ẩn các cột cũ nếu bạn không muốn dùng chúng */
    .content-wrapper, .main-article-column, .sidebar-column, .article-card.main-article {
        display: block !important; /* Tránh xung đột flex */
        width: 100% !important;
        margin: 0;
        padding: 0;
        box-shadow: none;
    }
    /* --- CSS MỚI CHO BỐ CỤC DANH SÁCH GIỐNG ẢNH --- */
    .blog-item-container {
        display: flex; /* Dùng Flexbox để chia 2 cột (Ảnh và Nội dung) */
        margin-bottom: 40px; /* Khoảng cách giữa các bài viết */
        border: 1px solid #eee; /* Đường viền nhẹ */
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
        border-radius: 8px;
        overflow: hidden;
    }

    .image-and-title-column {
        flex: 2; /* Chiếm 2 phần (khoảng 60-70%) */
        position: relative;
    }

    .content-info-column {
        flex: 1.0; /* Chiếm 1.23 phần (khoảng 30-40%) */
        padding: 30px;
        background-color: #f7f7f7; /* Nền xám nhẹ cho cột thông tin */
        display: flex; /* Dùng flex để dễ dàng căn chỉnh nội dung */
        flex-direction: column;
        justify-content: start;
        padding-top: 55px;
        padding-left: 55px;
    }

    .item-image {
        width: 90%;
        height: 465px; /* Chiều cao cố định cho ảnh */
        object-fit: cover;
        display: block;
    }

    /* Style cho Tiêu đề lớn NẰM TRÊN ẢNH */
    .image-overlay-title {
        position: absolute;
        bottom: 20px;
        left: 50%;
        transform: translateX(-50%);
        background-color: rgba(255, 255, 255, 0.95);
        color: #333;
        padding: 15px 30px;
        font-size: 20px;
        font-weight: bold;
        text-align: center;
        border-radius: 10px;
        border: 3px solid #ff9900;
        white-space: nowrap;
        max-width: 90%; /* Giới hạn chiều rộng tiêu đề */
    }

    /* Style cột Nội dung */
    .item-category {
        color: #777;
        font-size: 14px;
        text-transform: uppercase;
        margin-bottom: 15px;
    }

    .item-title {
        font-size: 22px;
        font-weight: bold;
        color: #38761d; /* Màu xanh lá cây đậm */
        margin: 0 0 25px 0;
        line-height: 1.3;
    }
    
    .item-summary {
        font-size: 16px;
        color: #555;
        line-height: 1.5;
        margin-bottom: 25px;
    }

    .item-meta {
        font-size: 13px;
        color: #888;
    }
    /* --- CSS RESPONSIVE BỔ SUNG --- */

/* 1. Đối với màn hình máy tính bảng (Dưới 1024px) */
@media (max-width: 1024px) {
    .container {
        width: 95%; /* Mở rộng container để tận dụng không gian */
    }
    .item-image {
        height: 350px; /* Giảm chiều cao ảnh một chút */
    }
}

/* 2. Đối với màn hình điện thoại di động (Dưới 768px) */
@media (max-width: 768px) {
    .search-result-title {
        font-size: 28px; /* Giảm cỡ chữ tiêu đề chính */
        margin: 20px 0;
    }

    .blog-item-container {
        flex-direction: column; /* Chuyển từ hàng ngang thành hàng dọc */
        height: auto;
    }

    /* Cột ảnh */
    .image-and-title-column {
        width: 100%;
    }

    .item-image {
        width: 100%; /* Ảnh chiếm hết chiều rộng màn hình */
        height: 250px; /* Chiều cao ảnh nhỏ lại trên mobile */
    }

    /* Cột nội dung */
    .content-info-column {
        width: 100%;
        padding: 20px; /* Giảm padding cho đỡ chiếm diện tích */
        padding-top: 25px; /* Giảm khoảng cách phía trên */
        padding-left: 20px;
        background-color: #ffffff; /* Có thể đổi sang nền trắng trên mobile cho thoáng */
    }

    .item-title {
        font-size: 18px; /* Giảm cỡ chữ tiêu đề bài viết */
        margin-bottom: 15px;
    }

    .item-summary {
        font-size: 14px; /* Giảm cỡ chữ tóm tắt */
        margin-bottom: 15px;
    }

    /* Điều chỉnh tiêu đề đè trên ảnh (nếu bạn sử dụng lại) */
    .image-overlay-title {
        position: static; /* Không cho đè lên ảnh nữa */
        transform: none;
        width: 90%;
        margin: 10px auto;
        font-size: 16px;
        white-space: normal; /* Cho phép xuống dòng nếu tiêu đề dài */
        left: 0;
    }

    /* Phân trang mobile */
    .pagination a, .pagination span {
        padding: 5px 10px;
        margin: 0 2px;
        font-size: 13px;
    }
}

/* 3. Đối với màn hình cực nhỏ (iPhone 5/SE - Dưới 480px) */
@media (max-width: 480px) {
    .item-image {
        height: 180px; /* Ảnh cực nhỏ */
    }
    .live-chat-button {
        padding: 8px 15px;
        font-size: 12px;
    }
}
    </style>
</head>

<body>
    <div class="container">
        <h1 class="search-result-title">Kết quả tìm kiếm</h1>
        
        <p class="breadcrumb"> <a href="index.php">Trang chủ</a> / Tìm kiếm từ khóa "<?php echo $keyword; ?>" </p>
        
        <?php if (!empty($posts)): ?> 
        
        <h2 class="search-result-title" style="margin-top: 0;">Tìm thấy <?php echo $totalPosts; ?> bài viết cho từ khóa "<?php echo $keyword; ?>"</h2>

        <div class="articles-list-wrapper">
            
            <?php foreach ($posts as $post): 
                // Lấy tên danh mục (cần điều chỉnh nếu cấu trúc categories là mảng lồng)
                $categoryName = $post['categories'][0]['name'] ?? 'Kỹ thuật nông nghiệp';
            ?>
            
            <div class="blog-item-container">
                
                <div class="image-and-title-column">
                    <a href="post-detail.php?id=<?php echo $post['post_id']; ?>">
                        <img src="<?php echo $post['image']; ?>" alt="<?php echo $post['title']; ?>" class="item-image">
                    </a>
                    
                    <!-- <div class="image-overlay-title"> 
                        <a href="post-detail.php?slug=<?php echo $post['slug']; ?>" style="text-decoration: none; color: inherit;">
                            <?php echo $post['title']; ?>
                        </a>
                    </div> -->
                </div>
                
                <div class="content-info-column">
                    <p class="item-category"><?php echo $categoryName; ?></p>
                    
                    <h2 class="item-title">
                        <a href="post-detail.php?slug=<?php echo $post['slug']; ?>" style="text-decoration: none; color: inherit;">
                            <?php echo $post['title']; ?>
                        </a>
                    </h2>
                    
                    <p class="item-summary"><?php echo $post['summary']; ?></p>
                    
                    <p class="item-meta">
                        <?php echo date('d/m/Y', strtotime($post['created_at'])); ?> bởi <?php echo $post['author']; ?> 
                    </p>
                </div>
                
            </div>
            
            <?php endforeach; ?>
            
        </div> 

        <?php if ($totalPages > 1): ?> 
        <div class="pagination">
            <?php for ($i = 1; $i <= $totalPages; $i++): ?> 
                <a href="?keyword=<?php echo $keyword; ?>&search_type=blog&page=<?php echo $i; ?>" class="<?php echo ($i == $page) ? 'current-page' : ''; ?>"> 
                    <?php echo $i; ?> 
                </a> 
            <?php endfor; ?>
        </div> 
        <?php endif; ?>

        <?php else: ?> 
        <div class="no-results">
            <h2>Không tìm thấy bài viết nào</h2>
            <p>Không có kết quả nào phù hợp với từ khóa "<?php echo $keyword; ?>". Vui lòng thử từ khóa khác.</p>
        </div> 
        <?php endif; ?>
        
        <a href="#" class="live-chat-button"> Liên hệ </a>
    </div>
</body>
</html>