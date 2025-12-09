<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Vườn Sài Gòn</title>

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <link rel="stylesheet" href="/VuonSaiGons/assets/css/style.css">
</head>

<body>
    <header class="container-fluid border-bottom bg-white sticky-top">
    <div class="row align-items-center py-2">
        
        <div class="col-2 col-lg-2 logo text-center text-md-start px-1 px-md-3 ps-lg-5">
            <a href="#">
                <img src="https://vuonsaigon.vn/wp-content/uploads/2020/11/Logo-vsg-web.png" height="40" class="img-fluid">
            </a>
        </div>

        <div class="col-6 col-lg-5 px-1 search-mobile" style="padding-left: 10% !important">
            <div class="input-group">
                <select class="form-select d-none d-md-block bg-light border-end-0" style="max-width:130px;">
                    <option>Sản phẩm</option>
                    <option>Bài viết</option>
                </select>
                
                <input type="text" class="form-control" placeholder="Tìm kiếm...">
                
                <button class="btn btn-success">
                    <i class="bi bi-search d-md-none"></i>
                    <span class="d-none d-md-inline">Tìm kiếm</span>
                </button>
            </div>
        </div>

        <div class="col-4 col-lg-5 text-end icon-group px-1 px-md-3">
            <div class="d-flex justify-content-end align-items-center gap-2 gap-md-3 pe-lg-5">
                
                <a href="tel:0909123409" class="text-danger fw-bold text-decoration-none d-none d-lg-block" style="font-size: 15px; font-size: 15px; padding-right: 10%;" >
                    <i class="bi bi-telephone me-1"></i> 0909 1234 09 - 082 799 7777
                </a>
                <a href="#" class="text-dark position-relative text-decoration-none">
                    <i class="bi bi-heart fs-5"></i>
                    <span class="position-absolute top-0 start-100 translate-middle badge bg-success rounded-pill d-none d-md-block" style="font-size:0.6rem">0</span>
                </a>
                
                <a href="#" class="text-dark position-relative text-decoration-none me-1">
                    <i class="bi bi-cart fs-5"></i>
                    <span class="position-absolute top-0 start-100 translate-middle badge bg-success rounded-pill" style="font-size:0.6rem">2</span>
                </a>

                <button class="btn p-0 border-0 d-md-none" data-bs-toggle="offcanvas" data-bs-target="#menuCanvas">
                    <i class="bi bi-list fs-2 text-success"></i>
                </button>
            </div>
        </div>

    </div>
</header>
    <!-- ===== MENU BAR ===== -->
    <div class="container-fluid border-bottom d-none d-md-block" style="padding: 1%;">

        <div class="container py-2 d-flex align-items-center gap-4">
            <!-- DANH MỤC (DESKTOP DROPDOWN) -->
            <div class="cat-wrapper">
                <button class="cat-btn-desktop">
                    <i class=""></i> DANH MỤC SẢN PHẨM
                    <i class="bi bi-chevron-down"></i>
                </button>
                <!-- Dropdown giống ảnh -->

                <div class="cat-dropdown-desktop">
                    <div class="cat-item">KHUYẾN MÃI & VOUCHER 2024</div>
                    <div class="cat-item">THÁP TRỒNG – TRỤ TRỒNG – VƯỜN TƯỜNG</div>
                    <div class="cat-item">SỎI TRANG TRÍ</div>
                    <div class="cat-item">HÀNG RÀO NHỰA</div>
                    <div class="cat-item">ỐNG THÉP BỌC NHỰA – DAIM JAPAN</div>
                    <div class="cat-item">
                        THIẾT BỊ – HỆ THỐNG TƯỚI TỰ ĐỘNG <i class="bi bi-chevron-right"></i>
                    </div>
                    <div class="cat-item">
                        CHẬU TRỒNG CÂY <i class="bi bi-chevron-right"></i>
                    </div>
                    <div class="cat-item">
                        CÂY GIỐNG VÀ HOA CHẬU <i class="bi bi-chevron-right"></i>
                    </div>
                    <div class="cat-item">
                        DỤNG CỤ LÀM VƯỜN <i class="bi bi-chevron-right"></i>
                    </div>
                    <div class="cat-item">
                        ĐẤT SẠCH VÀ GIÁ THỂ <i class="bi bi-chevron-right"></i>
                    </div>
                    <div class="cat-item">HẠT GIỐNG RAU HOA</div>
                    <div class="cat-item">VẬT TƯ TRỒNG LAN</div>
                    <div class="cat-item">THUỐC BẢO VỆ THỰC VẬT</div>
                    <div class="cat-item">PHÂN BÓN</div>
                </div>
            </div>
            <!-- Menu links -->
            <a href="introduce.php" class="fw-bold text-success text-decoration-none">GIỚI THIỆU</a>
            <a href="product.php" class="fw-bold text-success text-decoration-none">SẢN PHẨM</a>
            <a href="#" class="fw-bold text-success text-decoration-none">VIDEO</a>
            <a href="#" class="fw-bold text-success text-decoration-none">BLOG</a>
            <a href="#" class="fw-bold text-success text-decoration-none">LIÊN HỆ</a>
        </div>
    </div>
    <!-- ===== MOBILE OFFCANVAS ===== -->

    <div class="offcanvas offcanvas-start" id="menuCanvas">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title">DANH MỤC</h5>
            <button class="btn-close btn-close-white" data-bs-dismiss="offcanvas"></button>
        </div>
        <div class="offcanvas-body p-0">
            <ul class="list-group list-group-flush">
                <li class="list-group-item">KHUYẾN MÃI & VOUCHER 2024</li>
                <li class="list-group-item">THÁP TRỒNG – TRỤ TRỒNG – VƯỜN TƯỜNG</li>
                <li class="list-group-item">SỎI TRANG TRÍ</li>
                <li class="list-group-item">HÀNG RÀO NHỰA</li>
                <li class="list-group-item">ỐNG THÉP BỌC NHỰA – DAIM JAPAN</li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    THIẾT BỊ – HỆ THỐNG TƯỚI TỰ ĐỘNG <span>›</span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    CHẬU TRỒNG CÂY <span>›</span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    CÂY GIỐNG VÀ HOA CHẬU <span>›</span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    DỤNG CỤ LÀM VƯỜN <span>›</span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    ĐẤT SẠCH VÀ GIÁ THỂ <span>›</span>
                </li>
                <li class="list-group-item">HẠT GIỐNG RAU HOA</li>

                <li class="list-group-item">VẬT TƯ TRỒNG LAN</li>
            </ul>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>