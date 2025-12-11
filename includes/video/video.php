<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang Video Mô Phỏng</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    
    <link rel="stylesheet" href="style.css"> 

    <style>
        /* 1. Wrapper chứa Video (Đảm bảo căn giữa và giới hạn độ rộng) */
        .video-main-content-custom {
            max-width: 800px; 
            margin: 0 auto;
            position: relative; 
            overflow: hidden;
            border-radius: 4px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        /* 2. Style chung cho các lớp phủ (header & footer) */
        .video-page-overlay {
            position: absolute;
            left: 0;
            right: 0;
            z-index: 10;
            padding: 8px 15px;
            color: #fff;
            font-size: 14px;
        }

        /* 3. Lớp phủ trên cùng (Header: Logo, Xem sau, Chia sẻ) */
        .video-page-overlay-top {
            top: 0;
            background-color: rgba(0, 0, 0, 0.5); 
        }

        /* 4. Lớp phủ dưới cùng (Footer: Xem trên YouTube) */
        .video-page-overlay-bottom {
            bottom: 0;
            background-color: rgba(0, 0, 0, 0.7); 
        }

        /* 5. Thumbnail cho Video Gợi Ý */
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
        }
    </style>
</head>
<body>

    <div class="container my-5">
        <div class="row justify-content-center">
            
            <div class="col-12">
                <div class="video-main-content-custom">
                    
                    
                    
                    <div class="ratio ratio-16x9">
                        <iframe 
                            id="mainVideoFrame"
                            src="https://www.youtube.com/embed/7KzFRyDizOQ?rel=0&amp;autoplay=0" 
                            title="YouTube video player" 
                            /* Đã loại bỏ 'fullscreen' khỏi allow để ngăn chặn quyền phóng to */
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture;" 
                            allowfullscreen="false"
                            referrerpolicy="strict-origin-when-cross-origin" 
                            frameborder="0">
                        </iframe>
                    </div>
                    
                   
                </div>
            </div>
            
            <div class="col-12 text-center mt-3">
                <span class="text-muted small me-2">1 of 25</span>
                <button class="btn btn-outline-secondary btn-sm">Next</button>
            </div>
            
        </div>
        
        <hr class="my-5"> 
        
        <div class="row mt-5 justify-content-start">
            
            <div class="col-12 text-start mb-3">
                <h3 class="fs-5 fw-bold" style="color: #155d27;">Các Video Khác</h3>
            </div>

            <div class="col-12 col-sm-6 col-md-4 mb-4">
                <div class="card h-100 border-0 shadow-sm">
                    <div class="position-relative overflow-hidden rounded">
                        <a href="#" class="d-block" 
                           onclick="loadVideo('VUIPoh_cJhM', 'Để có rau gia vị ăn quanh năm thì hãy thử mẹo này nhé! #raugiavi #vu...'); return false;">
                            <img src="https://img.youtube.com/vi/VUIPoh_cJhM/hqdefault.jpg" class="card-img-top img-fluid" alt="Rau gia vị" style="opacity: 0.7;">
                            
                            <p class="card-thumbnail-title">
                                Để có rau gia vị ăn quanh năm thì hãy thử mẹo này nhé! #raugiavi #vu...
                            </p>
                            <i class="bi bi-play-circle-fill text-danger position-absolute top-50 start-50 translate-middle" style="font-size: 2rem;"></i>
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-12 col-sm-6 col-md-4 mb-4">
                <div class="card h-100 border-0 shadow-sm">
                    <div class="position-relative overflow-hidden rounded">
                        <a href="#" class="d-block"
                           onclick="loadVideo('ccDH9hB3kZw', 'Những loại hoa Tết được nhiều người ưa chuộng #hạtgiống #hạtdi...'); return false;">
                            <img src="https://img.youtube.com/vi/ccDH9hB3kZw/hqdefault.jpg" class="card-img-top img-fluid" alt="Hạt giống Tết">
                            
                            <p class="card-thumbnail-title">
                                Những loại hoa Tết được nhiều người ưa chuộng #hạtgiống #hạtdi...
                            </p>
                            <i class="bi bi-play-circle-fill text-danger position-absolute top-50 start-50 translate-middle" style="font-size: 2rem;"></i>
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-12 col-sm-6 col-md-4 mb-4">
                <div class="card h-100 border-0 shadow-sm">
                    <div class="position-relative overflow-hidden rounded">
                        <a href="#" class="d-block"
                           onclick="loadVideo('1AqlY0hDM8o', 'Cây giống quýt đường đang có trái #vuonsaigonvn #quytduong #ca...'); return false;">
                            <img src="https://img.youtube.com/vi/1AqlY0hDM8o/hqdefault.jpg" class="card-img-top img-fluid" alt="Cây quýt">
                            
                            <p class="card-thumbnail-title">
                                Cây giống quýt đường đang có trái #vuonsaigonvn #quytduong #ca...
                            </p>
                            <i class="bi bi-play-circle-fill text-danger position-absolute top-50 start-50 translate-middle" style="font-size: 2rem;"></i>
                        </a>
                    </div>
                </div>
            </div>

        </div> </div> <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        /**
         * Hàm tải video mới lên khung chính và cuộn lên đầu trang.
         * @param {string} videoId - ID của video YouTube mới.
         * @param {string} title - Tiêu đề của video mới.
         */
        function loadVideo(videoId, title) {
            const iframe = document.getElementById('mainVideoFrame');
            const titleElement = document.getElementById('mainVideoTitle');
            
            if (iframe) {
                // Thiết lập URL mới, thêm 'autoplay=1' để video tự động phát
                iframe.src = `https://www.youtube.com/embed/${videoId}?rel=0&autoplay=1`;
            }
            
            if (titleElement) {
                // Cập nhật tiêu đề video
                titleElement.textContent = title;
            }

            // Cuộn lên đầu trang
            window.scrollTo({
                top: 0,
                behavior: 'smooth' 
            });
        }
    </script>
</body>
</html>