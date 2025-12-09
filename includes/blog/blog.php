<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog - Vườn Sài Gòn</title>

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
            text-transform: none; /* Giữ nguyên chữ hoa thường như ảnh */
            padding: 0.5rem 1rem;
            transition: color 0.3s;
        }

        .blog-nav .nav-link:hover,
        .blog-nav .nav-link.active {
            color: #000; /* Màu đen đậm khi active */
        }

        /* --- BLOG CARD --- */
        .blog-card {
            border: none; /* Bỏ viền card */
            background: transparent;
            margin-bottom: 30px;
        }

        .blog-img-wrapper {
            position: relative;
            overflow: hidden;
            border-radius: 4px;
            margin-bottom: 15px;
            aspect-ratio: 4/3; /* Tỉ lệ ảnh chữ nhật nằm ngang */
        }

        .blog-img-wrapper img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }

        /* Hiệu ứng zoom nhẹ khi di chuột vào ảnh */
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
            color: #166534; /* Màu xanh thương hiệu khi hover */
        }

        .blog-meta {
            font-size: 0.85rem;
            color: #999;
        }
        
        .blog-meta span {
            color: #555; /* Tên tác giả đậm hơn chút */
        }

        /* --- FOOTER / HEADER PLACEHOLDER --- */
        /* CSS cho phần Header giả lập để giống ngữ cảnh */
        header { border-bottom: 1px solid #eee; }
    </style>
</head>

<body>

   

    <div class="container">
        
        <div class="blog-nav">
            <ul class="nav justify-content-center flex-wrap gap-2 gap-md-4">
                <li class="nav-item">
                    <a class="nav-link active" href="#">Tất cả bài viết</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Blog</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Kỹ thuật nông nghiệp</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Phong thủy</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Hoạt động công ty</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Sức khỏe</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Thủy sinh</a>
                </li>
            </ul>
        </div>

        <div class="row g-4">
            
            <div class="col-12 col-md-6 col-lg-4">
                <article class="blog-card">
                    <div class="blog-img-wrapper">
                        <a href="#">
                            <img src="https://vuonsaigon.vn/wp-content/uploads/2025/11/Ky-thuat-trong-hoa-trieu-chuong-khoe-sac-dung-dip-Tet-nguyen-dan-4-510x321.png" alt="Hoa triệu chuông">
                        </a>
                    </div>
                    <div class="card-content">
                        <div class="blog-category">Kỹ thuật nông nghiệp</div>
                        <h3 class="blog-title">
                            <a href="#">Kỹ thuật trồng hoa triệu chuông khoe sắc đúng dịp Tết Nguyên Đán</a>
                        </h3>
                        <div class="blog-meta">
                            08/12/2025 bởi <span>Thuy Hoa</span>
                        </div>
                    </div>
                </article>
            </div>

            <div class="col-12 col-md-6 col-lg-4">
                <article class="blog-card">
                    <div class="blog-img-wrapper">
                        <a href="#">
                            <img src="https://vuonsaigon.vn/wp-content/uploads/2025/11/y-nghia-hoa-trieu-chuong-510x321.png" alt="Hoa triệu chuông phong thủy">
                        </a>
                    </div>
                    <div class="card-content">
                        <div class="blog-category">Kỹ thuật nông nghiệp</div>
                        <h3 class="blog-title">
                            <a href="#">HOA TRIỆU CHUÔNG LÀ HOA GÌ? Ý NGHĨA PHONG THỦY HOA TRIỆU CHUÔNG</a>
                        </h3>
                        <div class="blog-meta">
                            06/12/2025 bởi <span>Thuy Hoa</span>
                        </div>
                    </div>
                </article>
            </div>

            <div class="col-12 col-md-6 col-lg-4">
                <article class="blog-card">
                    <div class="blog-img-wrapper">
                        <a href="#">
                            <img src="https://vuonsaigon.vn/wp-content/uploads/2025/11/La-oi-co-tac-dung-gi-15-tac-dung-cua-la-oi-doi-voi-suc-khoe-510x321.png" alt="Lá ổi">
                        </a>
                    </div>
                    <div class="card-content">
                        <div class="blog-category">Kỹ thuật nông nghiệp</div>
                        <h3 class="blog-title">
                            <a href="#">Lá ổi có tác dụng gì? 15 tác dụng của lá ổi đối với sức khỏe</a>
                        </h3>
                        <div class="blog-meta">
                            04/12/2025 bởi <span>Thuy Hoa</span>
                        </div>
                    </div>
                </article>
            </div>

            <div class="col-12 col-md-6 col-lg-4">
                <article class="blog-card">
                    <div class="blog-img-wrapper">
                        <a href="#">
                            <img src="https://vuonsaigon.vn/wp-content/uploads/2023/09/su-dung-soi-trang-tri-ho-ca-va-ho-thuy-sinh-2-510x321.png" alt="Sỏi thủy sinh">
                        </a>
                    </div>
                    <div class="card-content">
                        <div class="blog-category">Thủy sinh, cá cảnh</div>
                        <h3 class="blog-title">
                            <a href="#">Sử dụng sỏi trong trang trí hồ cá và hồ thủy sinh</a>
                        </h3>
                        <div class="blog-meta">
                            21/09/2023 bởi <span>Thuy Hoa</span>
                        </div>
                    </div>
                </article>
            </div>

            <div class="col-12 col-md-6 col-lg-4">
                <article class="blog-card">
                    <div class="blog-img-wrapper">
                        <a href="#">
                            <img src="https://vuonsaigon.vn/wp-content/uploads/2023/07/Hoai-1-1-510x321.png" alt="Trang trí bể cá">
                        </a>
                    </div>
                    <div class="card-content">
                        <div class="blog-category">Blog, Thủy sinh, cá cảnh</div>
                        <h3 class="blog-title">
                            <a href="#">Thiết kế và trang trí bể cá cảnh</a>
                        </h3>
                        <div class="blog-meta">
                            07/08/2023 bởi <span>maietar</span>
                        </div>
                    </div>
                </article>
            </div>

            <div class="col-12 col-md-6 col-lg-4">
                <article class="blog-card">
                    <div class="blog-img-wrapper">
                        <a href="#">
                            <img src="https://vuonsaigon.vn/wp-content/uploads/2023/07/Han-1-510x321.png" alt="Cá cảnh nhỏ">
                        </a>
                    </div>
                    <div class="card-content">
                        <div class="blog-category">cá cảnh, Blog, Thủy sinh</div>
                        <h3 class="blog-title">
                            <a href="#">Loại cá phổ biến và phù hợp cho bể cá cảnh nhỏ</a>
                        </h3>
                        <div class="blog-meta">
                            05/08/2023 bởi <span>maietar</span>
                        </div>
                    </div>
                </article>
            </div>

        </div> <nav class="my-5">
            <ul class="pagination justify-content-center">
                <li class="page-item active"><a class="page-link bg-success border-success" href="#">1</a></li>
                <li class="page-item"><a class="page-link text-success" href="#">2</a></li>
                <li class="page-item"><a class="page-link text-success" href="#">3</a></li>
                <li class="page-item"><a class="page-link text-success" href="#">Next</a></li>
            </ul>
        </nav>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>