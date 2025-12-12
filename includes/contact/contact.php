<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liên hệ - Vườn Sài Gòn</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            font-family: Arial, sans-serif;
            color: #333;
            background-color: #fff;
        }

        /* --- MÀU CHỦ ĐẠO --- */
        :root {
            --primary-green: #166534; /* Xanh đậm (Logo/Nút) */
            --title-green: #65a30d;   /* Xanh lá mạ (Tiêu đề) */
        }

        .text-green { color: var(--primary-green) !important; }
        
        /* --- BREADCRUMB --- */
        .breadcrumb-bg { background-color: #f0f2f5; }
        .breadcrumb a { text-decoration: none; color: #09c; }
        .breadcrumb-item.active { color: #333; }

        /* --- MAP FULL WIDTH --- */
        .map-full-width {
            width: 100%;
            height: 450px;
            border-top: 1px solid #ddd;
            border-bottom: 1px solid #ddd;
        }
        .map-full-width iframe {
            width: 100%;
            height: 100%;
            border: 0;
            display: block;
        }

        /* --- CONSULTATION SECTION (3 Cột) --- */
        .consult-title {
            color: var(--title-green);
            font-weight: 700;
            text-transform: uppercase;
            font-size: 2.5rem;
            margin-bottom: 4rem;
            margin-top: 4rem;
        }
        .consult-col-title {
            color: var(--title-green);
            font-weight: 700;
            text-transform: uppercase;
            margin-bottom: 1rem;
            font-size: 1.2rem;
        }
        .consult-text a {
            text-decoration: none;
            color: #333;
        }
        .consult-text a:hover { color: var(--primary-green); }

        /* --- FORM LIÊN HỆ NHANH (Style giống ảnh) --- */
        .quick-contact-title {
            color: var(--title-green);
            font-weight: 700;
            text-transform: uppercase;
            font-size: 1.8rem;
            margin-bottom: 40px;
            text-align: center;
        }
        
        /* Label phía trên input */
        .form-label {
            font-weight: normal;
            color: #333;
            margin-bottom: 0.5rem;
        }

        /* Input style: Viền mỏng, nền trắng */
        .custom-input {
            border: 1px solid #e5e5e5; /* Viền xám rất nhạt */
            border-radius: 2px;
            padding: 10px 15px;
            background-color: #fff;
            color: #555;
            width: 100% !important;
        }
        .custom-input:focus {
            border-color: #ccc;
            box-shadow: none;
        }

        /* Nút Gửi đi */
        .btn-send {
            background-color: #195f2e; /* Xanh đậm giống ảnh */
            color: white;
            font-weight: bold;
            padding: 10px 30px;
            border: none;
            border-radius: 3px;
            min-width: 120px;
        }
        .btn-send:hover {
            background-color: #144a24;
            color: white;
        }

        /* --- HEADER PLACEHOLDER --- */
        header { border-bottom: 1px solid #eee; }
        
        /* Floating Phone */
        .floating-phone {
            position: fixed; bottom: 20px; right: 20px;
            background: #28a745; color: white;
            width: 50px; height: 50px; border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            font-size: 24px; box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
            z-index: 1000;
            text-decoration: none;
        }
    </style>
</head>

<body>

   

    <div class="container-fluid breadcrumb-bg py-4">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="#">Trang chủ</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Liên hệ</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="container-fluid p-0">
        <div class="map-full-width">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3918.924943417777!2d106.63935637480545!3d10.81705628933398!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x317529676e625555%3A0x733735956793732!2zMTcxIMSQLiBOZ3V54buFbiBWxINuIEto4buRaSwgUGjGsOG7nW5nIDgsIEfDsiBW4bqlcCwgSOG7kyBDaMOtIE1pbmgsIFZpZXRuYW0!5e0!3m2!1sen!2s!4v1700000000000!5m2!1sen!2s" allowfullscreen="" loading="lazy"></iframe>
        </div>
    </div>

    <div class="container py-5">
        <h2 class="text-center consult-title">LIÊN HỆ ĐỂ ĐƯỢC TƯ VẤN</h2>
        <div class="row text-center gy-4">
            <div class="col-md-4">
                <div class="mb-4 d-none d-md-block" style="height: 1.6rem;"></div> 
                <div class="consult-text">
                    <div class="mb-1"><a href="mailto:kinhdoanh@langhoagovap.com">kinhdoanh@langhoagovap.com</a></div>
                    <div><a href="tel:0909123409" class="fw-bold">0909 1234 09</a></div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="consult-col-title">CỬA HÀNG</div>
                <div class="consult-text">
                    171 Nguyễn Văn Khối, Phường 8, Gò Vấp, TP. HCM
                </div>
            </div>
            <div class="col-md-4">
                <div class="consult-col-title">Facebook</div>
                <div class="consult-text">
                    <div class="mb-1"><a href="#">https://www.facebook.com/sieuthinongnghiep</a></div>
                    <div><a href="#">p.vuonsaigon</a></div>
                </div>
            </div>
        </div>
    </div>

    <div class="container pb-5" style="
    padding: 49px;
    background-color: #f6f6f6;
">
        <h2 class="quick-contact-title" style="
    margin-top: 20px;
">LIÊN HỆ NHANH</h2>
        
        <div class="row justify-content-center">
            <div class="col-lg-10 col-12">
                <form>
                    <div class="mb-3">
                        <label class="form-label">Tên của bạn (*)</label>
                        <input type="text" class="form-control custom-input">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Địa chỉ Email (*)</label>
                        <input type="email" class="form-control custom-input">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Tiêu đề:</label>
                        <input type="text" class="form-control custom-input">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Nội dung</label>
                        <textarea class="form-control custom-input" rows="7"></textarea>
                    </div>

                    <div class="mt-4">
                        <button type="submit" class="btn btn-send">Gửi đi</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <a href="tel:0909123409" class="floating-phone">
        <i class="bi bi-telephone-fill"></i>
    </a>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>