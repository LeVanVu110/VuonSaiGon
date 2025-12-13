<?php
// BƯỚC 1: INCLUDE CÁC FILE CẦN THIẾT
// Đảm bảo các file này tồn tại và được đặt đúng đường dẫn

// --- KHỞI TẠO VÀ XỬ LÝ ĐẦU VÀO ---
$blogModel = new Blog();
$perPage = 9; // 3 cột * 3 hàng = 9 bài viết mỗi trang
$currentPage = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;
$currentSlug = isset($_GET['cat']) ? $_GET['cat'] : null; // Lấy slug từ URL


// Lấy tất cả danh mục
$allCategories = $blogModel->getAllCategories();
$currentCatId = null;
$currentCategoryName = 'Tất cả bài viết';

// Tìm cat_id và tên danh mục đang được chọn
if ($currentSlug) {
    foreach ($allCategories as $cat) {
        if ($cat['slug'] === $currentSlug) {
            $currentCatId = $cat['cat_id'];
            $currentCategoryName = $cat['name'];
            break;
        }
    }
}


// --- LẤY DỮ LIỆU VÀ PHÂN TRANG ---
$totalPosts = $blogModel->getTotalPosts($currentCatId);
$totalPages = ceil($totalPosts / $perPage);

// Lấy danh sách bài viết cho trang và danh mục hiện tại
$posts = $blogModel->getPostsByPage($currentPage, $perPage, $currentCatId);

// Logic cho nút Next/Prev (Phần phân trang)
$nextPage = $currentPage < $totalPages ? $currentPage + 1 : $totalPages;

// Hàm tạo URL phân trang
function buildPaginationUrl($page, $currentSlug) {
    $url = basename($_SERVER['PHP_SELF']) . '?page=' . $page;
    if ($currentSlug) {
        $url .= '&cat=' . htmlspecialchars($currentSlug);
    }
    return $url;
}
?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #fff;
            color: #333;
        }
        /* --- BLOG NAVIGATION --- */
        .blog-nav {
            padding: 20px 0;
            margin-bottom: 20px;
        }

        .blog-nav .nav-link {
            color: #777;
            font-weight: 600;
            text-transform: none;
            padding: 0.5rem 1rem;
            transition: color 0.3s;
        }

        .blog-nav .nav-link:hover,
        .blog-nav .nav-link.active {
            color: #000;
        }
        /* --- BLOG CARD --- */
        .blog-card {
            border: none;
            background: transparent;
            margin-bottom: 30px;
        }

        .blog-img-wrapper {
            position: relative;
            overflow: hidden;
            border-radius: 4px;
            margin-bottom: 15px;
            aspect-ratio: 4/3;
        }

        .blog-img-wrapper img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }

        .blog-card:hover .blog-img-wrapper img {
            transform: scale(1.05);
        }

        .blog-category {
            font-size: 0.85rem;
            color: #555;
            margin-bottom: 8px;
        }

        .blog-title {
            font-size: 1.1rem;
            font-weight: bold;
            line-height: 1.4;
            margin-bottom: 10px;
        }

        .blog-title a {
            text-decoration: none;
            color: #000;
            transition: color 0.2s;
        }

        .blog-title a:hover {
            color: #166534;
        }

        .blog-meta {
            font-size: 0.85rem;
            color: #999;
        }
        
        .blog-meta span {
            color: #555;
        }
        
        header { border-bottom: 1px solid #eee; }
    </style>
</head>

<body>
    
    

    <div class="container">
        
        <div class="blog-nav">
            <ul class="nav justify-content-center flex-wrap gap-2 gap-md-4">
                <li class="nav-item">
                    <a class="nav-link <?php echo $currentSlug == null ? 'active' : ''; ?>" 
                       href="blog.php">Tất cả bài viết</a>
                </li>
                
                <?php foreach ($allCategories as $cat): ?>
                <li class="nav-item">
                    <a class="nav-link <?php echo $currentSlug === $cat['slug'] ? 'active' : ''; ?>" 
                       href="blog.php?cat=<?php echo htmlspecialchars($cat['slug']); ?>">
                        <?php echo htmlspecialchars($cat['name']); ?>
                    </a>
                </li>
                <?php endforeach; ?>
            </ul>
        </div>
        
       

        <div class="row g-4">
            
            <?php 
            // HIỂN THỊ CÁC BÀI VIẾT TỪ CSDL
            if (empty($posts)) {
                echo '<div class="col-12"><p class="text-center text-muted">Không tìm thấy bài viết nào trong danh mục này.</p></div>';
            } else {
                foreach ($posts as $post) {
                    $postLink = 'single_post.php?slug=' . urlencode($post['slug']);
                    
                    // Gộp tên danh mục thành chuỗi (ví dụ: Thủy sinh, cá cảnh)
                    $categoryNames = array_map(function($c) { return $c['name']; }, $post['categories']);
                    $categoryList = implode(', ', $categoryNames);
            ?>
                <div class="col-12 col-md-6 col-lg-4">
                    <article class="blog-card">
                        <div class="blog-img-wrapper">
                            <a href="<?php echo $postLink; ?>">
                                <img src="<?php echo htmlspecialchars($post['image']); ?>" alt="<?php echo htmlspecialchars($post['title']); ?>">
                            </a>
                        </div>
                        <div class="card-content">
                            <div class="blog-category"><?php echo htmlspecialchars($categoryList); ?></div>
                            
                            <h3 class="blog-title">
                                <a href="<?php echo $postLink; ?>">
                                    <?php echo htmlspecialchars($post['title']); ?>
                                </a>
                            </h3>
                            <div class="blog-meta">
                                <?php echo date('d/m/Y', strtotime($post['created_at'])); ?> bởi <span><?php echo htmlspecialchars($post['author']); ?></span>
                            </div>
                        </div>
                    </article>
                </div>
            <?php
                }
            }
            ?>
        </div> 

        <nav class="my-5">
            <?php if ($totalPages > 1): ?>
            <ul class="pagination justify-content-center">
                <li class="page-item <?php echo $currentPage == 1 ? 'disabled' : ''; ?>">
                    <a class="page-link text-success" href="<?php echo buildPaginationUrl($currentPage - 1, $currentSlug); ?>">Prev</a>
                </li>

                <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                <li class="page-item <?php echo $i == $currentPage ? 'active' : ''; ?>">
                    <a class="page-link <?php echo $i == $currentPage ? 'bg-success border-success' : 'text-success'; ?>" 
                       href="<?php echo buildPaginationUrl($i, $currentSlug); ?>">
                        <?php echo $i; ?>
                    </a>
                </li>
                <?php endfor; ?>

                <li class="page-item <?php echo $currentPage == $totalPages ? 'disabled' : ''; ?>">
                    <a class="page-link text-success" href="<?php echo buildPaginationUrl($currentPage + 1, $currentSlug); ?>">Next</a>
                </li>
            </ul>
            <?php endif; ?>
        </nav>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>