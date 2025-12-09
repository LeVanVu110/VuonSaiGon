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
        .breadcrumb-bg { background-color: #f0f2f5; }
        .breadcrumb a { color: #0d6efd; }

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
        .category-list { list-style: none; padding-left: 0; }
        .category-list li { margin-bottom: 12px; }
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
        .category-list a:hover { color: #2e7d32; }

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
            height: 100%; /* Giữ chiều cao đều nhau trong Grid */
            display: flex;
            flex-direction: column;
        }
        
        .product-card:hover {
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
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
            flex-grow: 1; /* Để đẩy footer xuống đáy nếu cần */
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
            width: 100%; /* QUAN TRỌNG: Mặc định là 100% chiều rộng */
            border: none;
            padding: 8px 15px;
            transition: background 0.3s;
            display: block; /* Đảm bảo nút là khối */
        }
        .btn-add-cart:hover { background-color: #144a24; color: #fff; }

        /* Nút gọi nổi */
        .floating-phone {
            position: fixed; bottom: 20px; right: 20px;
            background: #28a745; color: white;
            width: 50px; height: 50px; border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            font-size: 24px; box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
            z-index: 1000;
        }

        /* ==========================================================
           LOGIC CHUYỂN ĐỔI GRID/LIST
           ========================================================== */
        
        #view-grid:checked ~ .main-content .view-btn-grid { color: #166534; }
        #view-grid:checked ~ .main-content .view-btn-list { color: #6c757d; }
        #view-list:checked ~ .main-content .view-btn-list { color: #166534; }
        #view-list:checked ~ .main-content .view-btn-grid { color: #6c757d; }

        /* --- DESKTOP LIST VIEW STYLES (Màn hình lớn) --- */
        @media (min-width: 769px) {
            
            /* Bung cột ra 100% */
            #view-list:checked ~ .main-content #product-container .col {
                width: 100% !important;
                flex: 0 0 100% !important;
                max-width: 100% !important;
            }

            /* Thẻ Card nằm ngang */
            #view-list:checked ~ .main-content #product-container .product-card {
                display: flex;
                flex-direction: row;
                align-items: flex-start;
                border: 1px solid #eee;
                padding: 15px;
                min-height: 200px;
            }

            /* Ảnh cố định size */
            #view-list:checked ~ .main-content #product-container .product-img-wrapper {
                width: 180px !important;
                height: 180px !important;
                flex-shrink: 0;
                margin-right: 25px;
                margin-left: 0;
                aspect-ratio: auto;
            }

            /* Body */
            #view-list:checked ~ .main-content #product-container .card-body {
                flex-grow: 1;
                padding: 0;
                padding-right: 200px;
            }

            #view-list:checked ~ .main-content #product-container .product-title {
                font-size: 1.1rem;
                text-align: left;
                margin-top: 10px;
                max-width: 100%;
                height: auto;
                -webkit-line-clamp: unset;
            }

            /* Giá tiền: Bay lên góc phải */
            #view-list:checked ~ .main-content #product-container .product-price {
                position: absolute;
                top: 15px;
                right: 20px;
                font-size: 1.4rem;
                text-align: right;
                width: 160px;
            }

            /* Footer chứa nút */
            #view-list:checked ~ .main-content #product-container .card-footer {
                position: absolute;
                top: 55px;
                right: 20px;
                padding: 0;
                background: transparent;
                border: none;
                width: auto;
            }
            
            /* NÚT BẤM DESKTOP LIST VIEW: Cố định 160px để đều nhau */
            #view-list:checked ~ .main-content #product-container .btn-add-cart {
                width: 160px !important;
            }
        }

        /* ==========================================================
           RESPONSIVE MOBILE (Màn hình nhỏ < 769px)
           ========================================================== */
        @media (max-width: 768px) {
            .product-toolbar { font-size: 0.9rem; }
            
            /* Dù chọn List hay Grid, trên mobile đều hiển thị dạng dọc (Grid nhỏ) */
            #view-list:checked ~ .main-content #product-container .product-card {
                flex-direction: row;
                flex-wrap: wrap;
                padding: 10px;
            }

            /* Reset ảnh mobile */
            #view-list:checked ~ .main-content #product-container .product-img-wrapper {
                width: 100px !important; 
                height: 100px !important; 
                margin-right: 15px;
            }

            #view-list:checked ~ .main-content #product-container .card-body {
                width: calc(100% - 115px);
                padding-right: 0; 
            }

            #view-list:checked ~ .main-content #product-container .product-title {
                font-size: 0.95rem;
            }

            /* Giá & Nút về vị trí tự nhiên */
            #view-list:checked ~ .main-content #product-container .product-price {
                position: static;
                font-size: 1rem;
                margin-top: 5px;
                text-align: left;
                width: auto;
            }

            #view-list:checked ~ .main-content #product-container .card-footer {
                position: static;
                width: 100%; /* Footer chiếm hết chiều ngang */
                margin-top: 5px;
                background: transparent;
                border: none;
                padding: 0;
            }
            
            /* --- SỬA LỖI NÚT BẤM MOBILE --- */
            /* Ép nút luôn rộng 100% trên mobile để bằng nhau tăm tắp */
            #view-list:checked ~ .main-content #product-container .btn-add-cart,
            .btn-add-cart {
                width: 100% !important; 
                display: block;
                font-size: 0.85rem;
                padding: 6px 0;
            }
        }

    </style>
</head>

<body>

    <input type="radio" name="view-switch" id="view-grid" checked hidden>
    <input type="radio" name="view-switch" id="view-list" hidden>

    <div class="main-content">

        <div class="container-fluid breadcrumb-bg py-4 mb-4">
            <div class="container">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="#" class="text-decoration-none text-info">Trang chủ</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Sản phẩm</li>
                    </ol>
                </nav>
            </div>
        </div>

        <div class="container">
            <div class="row">
                
                <div class="col-lg-3 d-none d-lg-block">
                    <div class="sidebar-title">DANH MỤC SẢN PHẨM</div>
                    <ul class="category-list">
                        <li><a href="#">THỦY SINH VÀ CÁ CẢNH</a></li>
                        <li><a href="#">HÀNG RÀO NHỰA</a></li>
                        <li><a href="#">KHUYẾN MÃI & VOUCHER 2024</a></li>
                        <li><a href="#">SỎI TRANG TRÍ</a></li>
                        <li><a href="#">THÁP TRỒNG – TRỤ TRỒNG</a></li>
                        <li><a href="#">ĐẤT SẠCH VÀ GIÁ THỂ <i class="bi bi-chevron-down small"></i></a></li>
                        <li><a href="#">HỆ THỐNG TƯỚI TỰ ĐỘNG <i class="bi bi-chevron-down small"></i></a></li>
                        <li><a href="#">DỤNG CỤ TRANG TRÍ SÂN VƯỜN</a></li>
                        <li><a href="#">ỐNG THÉP BỌC NHỰA</a></li>
                        <li><a href="#">CHẬU TRỒNG CÂY <i class="bi bi-chevron-down small"></i></a></li>
                    </ul>
                </div>

                <div class="col-lg-9 col-12">
                    
                    <div class="product-toolbar d-flex flex-wrap justify-content-between align-items-center gap-2">
                        <button class="btn btn-outline-success d-lg-none btn-sm" type="button" data-bs-toggle="offcanvas" data-bs-target="#mobileFilter">
                            <i class="bi bi-funnel"></i> Danh mục
                        </button>

                        <div class="fw-bold text-secondary d-none d-md-block">652 sản phẩm</div>
                        
                        <div class="d-flex align-items-center gap-2 ms-auto">
                            <select class="form-select form-select-sm" style="width: auto;">
                                <option>Mặc định</option>
                                <option>Giá thấp đến cao</option>
                                <option>Giá cao đến thấp</option>
                            </select>
                            
                            <div class="user-select-none d-flex align-items-center">
                                <span class="me-1 d-none d-md-inline small text-muted">Xem</span>
                                <label for="view-grid" class="view-btn-grid cursor-pointer p-1" style="cursor: pointer;">
                                    <i class="bi bi-grid-3x3-gap-fill fs-5"></i>
                                </label>
                                <label for="view-list" class="view-btn-list cursor-pointer p-1 ms-1" style="cursor: pointer;">
                                    <i class="bi bi-list-ul fs-5"></i>
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 g-3" id="product-container">

                        <div class="col">
                            <div class="product-card">
                                <div class="product-img-wrapper">
                                    <img src="https://vuonsaigon.vn/wp-content/uploads/2019/12/thuoc-tru-sau-actara.png" alt="Actara">
                                </div>
                                <div class="card-body">
                                    <h6 class="product-title">Actara 25 WG – thuốc trừ sâu thế hệ mới</h6>
                                    <div class="product-price">9,000đ</div>
                                </div>
                                <div class="card-footer">
                                    <button class="btn btn-add-cart">Đọc tiếp</button>
                                </div>
                            </div>
                        </div>

                        <div class="col">
                            <div class="product-card">
                                <div class="product-img-wrapper">
                                    <img src="https://vuonsaigon.vn/wp-content/uploads/2019/12/thuoc-tru-benh-antracol-6.png" alt="Antracol">
                                </div>
                                <div class="card-body">
                                    <h6 class="product-title">Antracol 70WP 100g Áo giáp kẽm</h6>
                                    <div class="product-price">50,000đ</div>
                                </div>
                                <div class="card-footer">
                                    <button class="btn btn-add-cart">Thêm vào giỏ</button>
                                </div>
                            </div>
                        </div>

                        <div class="col">
                            <div class="product-card">
                                <div class="product-img-wrapper">
                                    <img src="https://vuonsaigon.vn/wp-content/uploads/2025/04/ba-mia-ep-banh-4.png" alt="Bã mía">
                                </div>
                                <div class="card-body">
                                    <h6 class="product-title">Bã Mía Vụn Ép Bánh Orgamix – Giá Thể Hữu Cơ</h6>
                                    <div class="product-price">12,000đ</div>
                                </div>
                                <div class="card-footer">
                                    <button class="btn btn-add-cart">Thêm vào giỏ</button>
                                </div>
                            </div>
                        </div>

                        <div class="col">
                            <div class="product-card">
                                <div class="product-img-wrapper border-0 p-0">
                                    <img src="https://vuonsaigon.vn/wp-content/uploads/2022/08/khuyen-mai-freeship-247x296.png" alt="Bảng giá" style="width:100%; height:100%; object-fit:cover;">
                                </div>
                                <div class="card-body">
                                    <h6 class="product-title">Bảng giá ship hàng tháng 8/2022</h6>
                                    <div class="product-price" style="opacity: 0;">.</div>
                                </div>
                                <div class="card-footer">
                                    <button class="btn btn-add-cart">Đọc tiếp</button>
                                </div>
                            </div>
                        </div>

                        <div class="col">
                            <div class="product-card">
                                <div class="product-img-wrapper">
                                    <img src="https://vuonsaigon.vn/wp-content/uploads/2019/05/bat-dia-chat-mau-den-2.png" alt="Demo">
                                </div>
                                <div class="card-body">
                                    <h6 class="product-title">Sản phẩm Demo mẫu tên siêu dài để kiểm tra layout khi xuống dòng</h6>
                                    <div class="product-price">99,000đ</div>
                                </div>
                                <div class="card-footer">
                                    <button class="btn btn-add-cart">Thêm vào giỏ</button>
                                </div>
                            </div>
                        </div>

                    </div> 
                    
                    <nav class="mt-4">
                        <ul class="pagination justify-content-center">
                            <li class="page-item disabled"><a class="page-link" href="#">Trước</a></li>
                            <li class="page-item active"><a class="page-link bg-success border-success" href="#">1</a></li>
                            <li class="page-item"><a class="page-link text-success" href="#">2</a></li>
                            <li class="page-item"><a class="page-link text-success" href="#">3</a></li>
                            <li class="page-item"><a class="page-link text-success" href="#">Sau</a></li>
                        </ul>
                    </nav>

                </div>
            </div>
        </div>
    </div> 

    <div class="offcanvas offcanvas-start" tabindex="-1" id="mobileFilter">
        <div class="offcanvas-header bg-success text-white">
            <h5 class="offcanvas-title">DANH MỤC</h5>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <ul class="category-list">
                <li><a href="#">THỦY SINH VÀ CÁ CẢNH</a></li>
                <li><a href="#">HÀNG RÀO NHỰA</a></li>
                <li><a href="#">KHUYẾN MÃI & VOUCHER 2024</a></li>
                </ul>
        </div>
    </div>

    <a href="tel:0909123409" class="floating-phone text-decoration-none">
        <i class="bi bi-telephone-fill"></i>
    </a>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>