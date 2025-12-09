<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh mục Sản Phẩm - Vườn Sài Gòn</title>


    <style>
    
    </style>
</head>

<body>

    <div class="container my-5">
        <div class="row">

            <div class="col-lg-3 sidebar-area">

                <div class="sidebar-full-height">

                    <div class="sidebar-header">Chậu trồng cây</div>

                    <div class="sidebar-menu-static">
                        <ul class="sidebar-menu">
                            <li><a href="#">Đất sạch & Giá thể</a></li>
                            <li><a href="#">Phân bón hữu cơ</a></li>
                            
                        </ul>
                    </div>

                    <a href="#" class="sidebar-view-all">
                        Xem tất cả &raquo; </a>

                </div>
            </div>

            <div class="col-lg-9">
                <div class="row g-2">
                    <?php
                $products = [
                    ["img" => "https://vuonsaigon.vn/wp-content/uploads/2025/04/vo-trau-va-ba-mia-ep-banh-5-247x296.png", "name" => "Vỏ trấu và bã mía ép bánh", "price" => "12,000đ"],
                    ["img" => "https://vuonsaigon.vn/wp-content/uploads/2025/04/phan-bo-ep-banh-247x296.png", "name" => "Phân bò ép bánh", "price" => "15,000đ"],
                    ["img" => "https://vuonsaigon.vn/wp-content/uploads/2025/04/ba-mia-ep-banh-4-247x296.png", "name" => "Bã mía ép bánh", "price" => "10,000đ"],
                    ["img" => "https://vuonsaigon.vn/wp-content/uploads/2025/04/vo-dau-phong-ep-banh-247x296.png", "name" => "Vỏ đậu phộng ép bánh", "price" => "14,000đ"],
                    ["img" => "https://vuonsaigon.vn/wp-content/uploads/2025/04/xo-dua-ep-banh-1-247x296.png", "name" => "Xơ dừa ép bánh", "price" => "18,000đ"],
                    ["img" => "https://vuonsaigon.vn/wp-content/uploads/2025/04/gia-the-ep-banh-1-247x296.png", "name" => "Giá thể ép bánh đa năng", "price" => "25,000đ"],
                    ["img" => "https://vuonsaigon.vn/wp-content/uploads/2024/01/dat-sach-trong-mai-bonsai-cay-kieng-orgamix-light-soil-2-247x296.png", "name" => "Đất sạch Orgamix Light Soil", "price" => "45,000đ"],
                    ["img" => "https://vuonsaigon.vn/wp-content/uploads/2022/11/dem-gia-the-trong-rau-mam-247x296.png", "name" => "Đệm giá thể trồng rau mầm", "price" => "8,000đ"],
                    ["img" => "https://vuonsaigon.vn/wp-content/uploads/2022/06/dat-set-nung-1kadama-1-247x296.png", "name" => "Đất sét nung Akadama", "price" => "35,000đ"],
                    ["img" => "https://vuonsaigon.vn/wp-content/uploads/2022/04/orgamix-bazan-trong-hoa-va-cay-an-trai-1-247x296.png", "name" => "Orgamix Bazan trồng hoa", "price" => "55,000đ"],
                    ["img" => "https://vuonsaigon.vn/wp-content/uploads/2022/02/newzita-soil-new-mix-247x296.png", "name" => "Đất sạch Newzita Soil", "price" => "40,000đ"],
                    ["img" => "https://vuonsaigon.vn/wp-content/uploads/2021/11/sinh-khoi-trun-que-6-247x296.png", "name" => "Sinh khối trùn quế", "price" => "30,000đ"],
                    ["img" => "https://vuonsaigon.vn/wp-content/uploads/2021/05/dat-nung-soi-nhe-247x296.png", "name" => "Đất nung sỏi nhẹ", "price" => "22,000đ"],
                    ["img" => "https://vuonsaigon.vn/wp-content/uploads/2020/11/dat-do-badan-orgamix-plus-vang.png", "name" => "Đất đỏ Bazan Orgamix Plus", "price" => "60,000đ"],
                    ["img" => "https://vuonsaigon.vn/wp-content/uploads/2020/10/orgamix-3-in-1-247x296.png", "name" => "Đất sạch Orgamix 3 in 1", "price" => "50,000đ"]
                ];

                foreach ($products as $p): ?>

                    <div class="col-6 col-md-4 col-lg-custom-5">
                        <div class="product-box">
                            <a href="#" class="product-img-wrapper">
                                <img src="<?= $p['img'] ?>" class="product-img" alt="<?= $p['name'] ?>">
                            </a>
                            <div class="product-info">
                                <div class="product-name"><?= $p['name'] ?></div>
                                <div class="product-price"><?= $p['price'] ?></div>
                            </div>
                            <a href="#" class="btn-add-cart">Thêm vào giỏ</a>
                        </div>
                    </div>

                    <?php endforeach; ?>

                </div>
            </div>
        </div>
    </div>

</body>

</html>