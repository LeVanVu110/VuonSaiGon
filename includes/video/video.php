<?php
// BƯỚC 1: INCLUDE CÁC FILE CẦN THIẾT

// THIẾT LẬP PHÂN TRANG
$videoModel = new Video();
$perPage = 10; 
$currentPage = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;
$totalVideos = $videoModel->GetVideoCount();
$totalPages = ceil($totalVideos / $perPage);

// Lấy danh sách video cho trang hiện tại
$suggestedVideos = $videoModel->GetVideosByPage($currentPage, $perPage);

// THIẾT LẬP VIDEO CHÍNH
$defaultVideoId = isset($suggestedVideos[0]['youtube_id']) ? $suggestedVideos[0]['youtube_id'] : '7KzFRyDizOQ'; 
$currentYoutubeId = isset($_GET['v']) ? $_GET['v'] : $defaultVideoId;
$currentVideo = $videoModel->GetVideoByYoutubeId($currentYoutubeId);
$currentVideoTitle = $currentVideo ? $currentVideo['title'] : 'Video Đang Phát';

// Logic cho nút Prev/Next
$prevPage = $currentPage > 1 ? $currentPage - 1 : 1;
$nextPage = $currentPage < $totalPages ? $currentPage + 1 : $totalPages;

$prevLink = basename($_SERVER['PHP_SELF']) . '?page=' . $prevPage;
$nextLink = basename($_SERVER['PHP_SELF']) . '?page=' . $nextPage;

if (isset($_GET['v'])) {
    $prevLink .= '&v=' . htmlspecialchars($_GET['v']);
    $nextLink .= '&v=' . htmlspecialchars($_GET['v']);
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($currentVideoTitle); ?> - Trang Video</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    
    <style>
        .video-main-content-custom {
            max-width: 800px; 
            margin: 0 auto;
            position: relative; 
            overflow: hidden;
            border-radius: 4px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }
        .card-thumbnail-title {
            position: absolute; 
            bottom: 0; 
            left: 0;
            right: 0;
            width: 100%;
            padding: 8px;
            color: white;
            font-size: 0.8rem;
            background-color: rgba(0, 0, 0, 0.7);
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
            height: 40px; 
            line-height: 1.2;
        }
        .card-img-top {
            width: 100%;
            height: auto;
            display: block;
            min-height: 120px;
        }
    </style>
</head>
<body>

    <div class="container my-5">
        <div class="row justify-content-center">
            
            <div class="col-12">
                <h1 id="mainVideoTitle" class="fs-4 mb-3 fw-bold text-center">
                    <?php echo htmlspecialchars($currentVideoTitle); ?>
                </h1>
                
                <div class="video-main-content-custom">
                    <div class="ratio ratio-16x9">
                        <iframe 
                            id="mainVideoFrame"
                            src="https://www.youtube.com/embed/<?php echo $currentYoutubeId; ?>?rel=0&amp;autoplay=0" 
                            title="YouTube video player" 
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture;" 
                            allowfullscreen="false"
                            referrerpolicy="strict-origin-when-cross-origin" 
                            frameborder="0">
                        </iframe>
                    </div>
                </div>
            </div>
            
            <div class="col-12 text-center mt-3">
                <span class="text-muted small me-2">Video: <?php echo htmlspecialchars($currentVideo['video_id'] ?? 'N/A'); ?></span>
            </div>
            
        </div>
        
        <hr class="my-5"> 
        
        <div class="row mt-5 justify-content-start">
            
            <div class="col-12 text-start mb-3">
                <h3 class="fs-5 fw-bold" style="color: #155d27;">Các Video Khác (Trang <?php echo $currentPage; ?>)</h3>
            </div>

            <?php 
            // HIỂN THỊ CÁC VIDEO GỢI Ý (TỐI ĐA 10 VIDEO/TRANG)
            if (empty($suggestedVideos)) {
                echo '<div class="col-12"><p class="text-center text-danger">Không tìm thấy video nào trong trang này.</p></div>';
            } else {
                foreach ($suggestedVideos as $video) {
                    // Tùy chọn: Không hiển thị video đang phát
                    if ($video['youtube_id'] == $currentYoutubeId) {
                        continue;
                    }
                    
                    // Link mới sẽ là: video_page.php?v=[ID_VIDEO]&page=[SỐ_TRANG]
                    $videoLink = basename($_SERVER['PHP_SELF']) . '?v=' . $video['youtube_id'] . '&page=' . $currentPage;
            ?>
                    <div class="col-12 col-sm-6 col-md-4 col-lg-4 mb-4"> 
                        <div class="card h-100 border-0 shadow-sm">
                            <div class="position-relative overflow-hidden rounded">
                                <a href="<?php echo $videoLink; ?>" class="d-block">
                                    <img src="<?php echo htmlspecialchars($video['image']); ?>" class="card-img-top img-fluid" alt="<?php echo htmlspecialchars($video['title']); ?>">
                                    
                                    <i class="bi bi-play-circle-fill text-danger position-absolute top-50 start-50 translate-middle" style="font-size: 2rem;"></i>
                                </a>
                            </div>
                            <div class="card-body p-2">
                                <h5 class="card-title mb-0 fs-6 fw-bold" style="color: #155d27;">
                                    <?php echo htmlspecialchars($video['title']); ?>
                                </h5>
                            </div>
                        </div>
                    </div>
            <?php 
                }
            }
            ?>
            
            <div class="col-12 text-center mt-4">
                <?php 
                if ($totalPages > 1) { 
                ?>
                    <div class="d-inline-flex align-items-center">
                        <a 
                            href="<?php echo ($currentPage == 1) ? '#' : $prevLink; ?>" 
                            class="btn btn-outline-secondary px-4 py-2 me-3 <?php echo ($currentPage == 1) ? 'disabled' : ''; ?>"
                            aria-disabled="<?php echo ($currentPage == 1) ? 'true' : 'false'; ?>"
                        >
                            Prev
                        </a>
                        
                        <span class="text-muted fs-6 mx-2">
                            <?php echo $currentPage; ?> of <?php echo $totalPages; ?>
                        </span>
                        
                        <a 
                            href="<?php echo ($currentPage == $totalPages) ? '#' : $nextLink; ?>" 
                            class="btn btn-outline-secondary px-4 py-2 ms-3 <?php echo ($currentPage == $totalPages) ? 'disabled' : ''; ?>"
                            aria-disabled="<?php echo ($currentPage == $totalPages) ? 'true' : 'false'; ?>"
                        >
                            Next
                        </a>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div> 
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>