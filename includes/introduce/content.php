<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Giới Thiệu - Vườn Sài Gòn</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* CSS cho bố cục ảnh lớn dưới text */
        .team-image img {
            max-width: 100%;
            height: auto;
        }
        @media(min-width: 768px){
            .col-md-4{
            flex: 0 0 auto;
            width: 100%!important;
            }
        }
        .intro-section{
            text-align: left;
        }
        .team-section{
            margin: 13%;
        }
        .mb-3{
            margin-bottom: 2.5rem !important;
        }
        p{
            margin-top:0.5rem;
        }
    </style>
</head>
<body>
<?php  
// Giả sử class Banner đã được include (ví dụ: include 'banner.php';)

$bannerModel = new Banner(); 

// ----------------------------------------------------
// 2. KHỞI TẠO DỮ LIỆU CHUNG 
// ----------------------------------------------------
$banners = $bannerModel->getbannervideo();
$bannercontents = $bannerModel->getbannercontent();

// Lấy dữ liệu banner/video chính
$main_title = $banners[0]['title'] ?? 'Giới Thiệu';
$main_content = $banners[0]['content'] ?? 'Nội dung giới thiệu chung không tìm thấy.';
$main_video_url = $banners[0]['url_video'] ?? 'https://www.youtube.com/embed/placeholder';
?>

<div class="container intro-section mb-5">
    
    <h2 class="intro-title text-center fw-bold py-4" style="color: #1a5d2e;">
        <?php echo htmlspecialchars($main_title); ?>
    </h2>

    <p class="intro-text" style="text-align: justify; line-height: 1.8; font-size: 16px;">
        <?php echo $main_content ?>
    </p>

    <div class="video-container mt-4 ">
        <div class="ratio ratio-16x9">
            <iframe src="<?php echo htmlspecialchars($main_video_url); ?>" 
                    title="Video Giới Thiệu Vườn Sài Gòn" 
                    allowfullscreen>
            </iframe>
        </div>
    </div>


    <?php 
    // Lặp qua các khối nội dung phụ từ banner_content
    foreach($bannercontents as $bannercontent) {
        $section_title = $bannercontent['title'] ?? $bannercontent['tile'] ?? 'Tiêu đề';
        
        $parsed_data = $bannerModel->parse_content_data($bannercontent['conntent'] ?? '');
        $intro_text = $parsed_data['text'] ?? '';
        $items = $parsed_data['items'] ?? [];
        
        // ===============================================
        // BỐ CỤC LẶP 2 CỘT CHO TẤT CẢ KHỐI
        // (Đây là cách hiển thị nội dung theo thứ tự đã nhập)
        // ===============================================
    ?>
        <div class="team-section mt-5">
            <h3 class="text-center text-uppercase fw-bold mb-3" style="color: #1a5d2e;">
                <?php echo htmlspecialchars($section_title); ?>
            </h3>
            
            <?php if (!empty($intro_text)): ?>
            <p class="text-justify mb-4" style="line-height: 1.8; font-size: 19px; color: #333;">
                <?php echo nl2br(htmlspecialchars($intro_text)); ?>
            </p>
            <?php endif; ?>

            <?php foreach ($items as $index => $item): ?>
                <div class="product-item row align-items-center">
                    
                    <div class="col-md-4 item-image text-center">
                        <img src="<?php echo htmlspecialchars($item['image_url']); ?>" 
                            alt="Hình ảnh <?php echo htmlspecialchars($section_title); ?> <?php echo $index + 1; ?>" 
                            class="img-fluid shadow-sm rounded">
                    </div>
                    
                    <div class="col-md-8 item-description">
                        <p class="text-justify" style="line-height: 1.8; font-size: 16px; color: #333;">
                            <?php echo nl2br(htmlspecialchars($item['description'])); ?>
                        </p>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php
    } // Kết thúc foreach $bannercontents
    ?>
</div>



<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>