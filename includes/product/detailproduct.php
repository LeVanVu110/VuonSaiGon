<?php
// 1. Lấy ID sản phẩm từ URL
$productId = isset($_GET['id']) ? (int)$_GET['id'] : 0;

// 2. Khởi tạo Model và lấy dữ liệu sản phẩm
$productModel = new Product();
$categoriesModel = new Categories();

$product = $productModel->get_product_by_id($productId);

// 3. Xử lý nếu không tìm thấy sản phẩm
if (!$product) {
    http_response_code(404);
    echo "<p class='alert alert-danger'>Sản phẩm không tồn tại!</p>";
    exit(); 
}

// 4. Lấy thông tin phụ trợ
$categoryList = "";
$categoryInfo = $categoriesModel->get_category_by_id((int)$product['id']); 

if ($categoryInfo) {
    $categoryList = "<a href='product.php?category_slug=" . htmlspecialchars($categoryInfo['slug']) . "' class='text-decoration-none text-info'>" . htmlspecialchars($categoryInfo['name']) . "</a>";
} else {
    $categoryList = "Chưa phân loại";
}

// *** PHẦN ĐỘNG MỚI: Lấy dữ liệu Specs từ bảng product_specs ***
$productSpecs = [];

// BẠN CẦN ĐẢM BẢO HÀM get_product_specs_by_id TRUY VẤN TẤT CẢ ROWS DÙNG product_id
$specsResult = $productModel->get_product_specs_by_id($productId); 

// Chuyển kết quả truy vấn thành mảng Key/Value mà HTML cần
foreach ($specsResult as $spec) {
    if (isset($spec['spec_key']) && isset($spec['spec_value'])) {
        $productSpecs[$spec['spec_key']] = $spec['spec_value'];
    }
}
// *** END PHẦN SPECS ĐỘNG ***

// 7. Lấy sản phẩm liên quan (LOGIC CHÍNH XÁC VỚI BẢNG TRUNG GIAN)
// Hàm get_related_products PHẢI được sửa để JOIN qua category_product
$relatedProducts = $productModel->get_related_products($productId, 5); 

// 5. Chuẩn bị biến hiển thị
$productName = htmlspecialchars($product['name']);
$imageUrl = htmlspecialchars($product['image_url']);
$sku = htmlspecialchars($product['sku'] ?? 'N/A');
$price = (int)$product['price'];
$discountPrice = ($product['discount_price'] !== null && $product['discount_price'] < $price) ? (int)$product['discount_price'] : null;
$finalPrice = $discountPrice !== null ? $discountPrice : $price;
$priceDisplay = Product::formatCurrency($finalPrice);
$oldPriceDisplay = $discountPrice !== null ? '<del class="text-muted small ms-2">' . Product::formatCurrency($price) . '</del>' : '';
$status = ($product['state'] == 'còn hàng') ? 'CÒN HÀNG' : 'Hết hàng';
$statusClass = ($product['state'] == 'còn hàng') ? 'text-success' : 'out-of-stock';
$descriptionHtml = Product::parse_description_with_images($product['description']); 

?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $productName; ?> - Chi Tiết Sản Phẩm</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        /* [Các CSS Tùy Chỉnh Giữ Nguyên] */
        .green-header-bg {
            background-color: #28a645;
            color: white;
            padding: 10px 15px;
            text-align: center;
            font-size: 1.25rem;
            font-weight: bold;
            border-radius: 5px 5px 0 0;
            margin-bottom: 0;
        }

        .product-image-frame {
            border: 1px solid #dee2e6;
            border-radius: 5px;
        }

        .product-title-right {
            color: #28a645;
            font-size: 1.6rem;
            font-weight: normal;
            margin-bottom: 10px;
            border-bottom: 1px solid #eee;
            padding-bottom: 5px;
        }

        .price-text {
            color: black;
            font-weight: bold;
            font-size: 2rem;
        }

        .product-specs p {
            margin-bottom: 0.5rem;
            line-height: 1.4;
            font-size: 0.95rem;
        }

        .sku-category-info {
            font-size: 0.95rem;
            color: #495057;
            margin-bottom: 15px;
        }

        .km-product-img {
            max-width: 100%;
            height: auto;
            display: block;
        }

        .out-of-stock {
            color: red;
            font-weight: bold;
        }

        .social-share {
            margin-top: 15px;
        }

        .social-share a {
            display: inline-block;
            width: 42px;
            height: 42px;
            line-height: 42px;
            color: white;
            text-align: center;
            text-decoration: none;
            border-radius: 3px;
            font-size: 18px;
            margin-right: 5px;
        }

        .social-share a:last-child {
            margin-right: 0;
        }

        .social-share .facebook-bg {
            background-color: #3b5998;
        }

        .social-share .twitter-bg {
            background-color: #00acee;
        }

        .social-share .google-bg {
            background-color: #db4437;
        }

        .social-share .linkedin-bg {
            background-color: #0077b5;
        }

        .social-share .pinterest-bg {
            background-color: #bd081c;
        }

        .social-share .email-bg {
            background-color: #777;
        }

        .social-share i {
            font-size: 18px;
            vertical-align: middle;
        }
        /* Thêm vào phần style đã có */
    .product-description-full {
        max-width: 100%; /* Đảm bảo div mô tả không vượt quá container */
    }
    .product-description-full .description-image {
        /* Đảm bảo ảnh responsive, có thể giới hạn chiều rộng tối đa */
        max-width: 80%; /* Có thể chỉnh để phù hợp với hình mẫu */
        height: auto;
        border: 1px solid #f0f0f0; /* Thêm viền nhẹ giống hình mẫu */
        padding: 5px;
        border-radius: 5px;
    }
    .product-description-full .description-title {
        color: #5fa30f; /* Tùy chọn: Đổi màu tiêu đề con nếu muốn nổi bật */
        font-weight: bold;
        font-size: 1.2rem;
    }
    .product-description-full .content-body {
        /* Đảm bảo nội dung chữ có khoảng cách dễ đọc */
        line-height: 1.6;
    }
    </style>
</head>

<body>

    <main class="container py-5">
        <div class="row">
            <div class="col-lg-5 mb-4">
                <div class="product-image-frame">
                    <p class="green-header-bg"><?php echo $productName; ?></p>

                    <img style="width: 100%;" src="<?php echo $imageUrl; ?>" class="img-fluid rounded-bottom"
                        alt="<?php echo $productName; ?>" style="border-radius: 0 0 5px 5px;">

                    <div class="d-flex justify-content-center py-2">
                        <span class="d-inline-block mx-1"
                            style="width: 8px; height: 8px; background-color: #ccc; border-radius: 50%;"></span>
                        <span class="d-inline-block mx-1"
                            style="width: 8px; height: 8px; background-color: #666; border-radius: 50%;"></span>
                        <span class="d-inline-block mx-1"
                            style="width: 8px; height: 8px; background-color: #ccc; border-radius: 50%;"></span>
                        <span class="d-inline-block mx-1"
                            style="width: 8px; height: 8px; background-color: #ccc; border-radius: 50%;"></span>
                    </div>
                </div>
            </div>

            <div class="col-lg-7">
                <h1 class="product-title-right"><?php echo $productName; ?></h1>

                <p class="price-text mb-2">
                    <?php echo $priceDisplay; ?>
                    <?php echo $oldPriceDisplay; ?>
                </p>

                <p class="mb-3">
                    Tình trạng:
                    <span class="<?php echo $statusClass; ?>"><?php echo $status; ?></span>
                </p>

                <div class="product-specs mb-4">
                    <table class="table table-sm table-borderless">
                        <tbody class="product-specs-body">
                            <?php if (!empty($productSpecs)): ?>
                                <?php foreach ($productSpecs as $key => $value): ?>
                                    <tr>
                                        <td class="fw-bold" style="width: 30%; border-top: none;">•
                                            <?php echo htmlspecialchars($key); ?></td>
                                        <td style="border-top: none;"><?php echo htmlspecialchars($value); ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="2" class="text-muted">Thông số kỹ thuật đang được cập nhật.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>

                <div class="mb-4">
                    <img src="https://vuonsaigon.vn/wp-content/uploads/km-product.jpg" class="km-product-img"
                        alt="Khuyến mãi đặc biệt" loading="lazy">
                </div>

                <div class="sku-category-info">
                    <p class="mb-1"><strong>SKU:</strong> <?php echo $product['sku'] ?? 'N/A'; ?></p>
                    <p>
                        <strong>Danh mục:</strong>
                        <?php echo $categoryList; ?>
                    </p>
                </div>

                <div class="social-share">
                    <a href="#" class="facebook-bg" aria-label="Share on Facebook"><i class="bi bi-facebook"></i></a>
                    <a href="#" class="twitter-bg" aria-label="Share on Twitter"><i class="bi bi-twitter"></i></a>
                    <a href="#" class="google-bg" aria-label="Share on Google Plus"><i class="bi bi-google"></i></a>
                    <a href="#" class="linkedin-bg" aria-label="Share on LinkedIn"><i class="bi bi-linkedin"></i></a>
                    <a href="#" class="pinterest-bg" aria-label="Share on Pinterest"><i
                            class="bi bi-pin-angle-fill"></i></a>
                    <a href="#" class="email-bg" aria-label="Share via Email"><i class="bi bi-envelope-fill"></i></a>
                </div>
            </div>
        </div>
    </main>

    <div class="product-description-full p-4 ">
        <h3 class="text-success fw-bold border-bottom pb-2 mb-3">
            THÔNG TIN CHI TIẾT SẢN PHẨM
        </h3>

        <div id="descriptionContent" class="content-body">
            <?php echo $descriptionHtml; ?>
        </div>
    </div>

    <div class="product-description-full p-4 container">
    <h3 class="text-success fw-bold border-bottom pb-2 mb-3">
        Sản phẩm liên quan
    </h3>
    
    <div class="row row-cols-2 row-cols-md-3 row-cols-lg-5 g-3" id="product-container">
        
        <?php if (!empty($relatedProducts)): ?>
            <?php foreach ($relatedProducts as $value): 
                $relatedUrl = 'detailproduct.php?id=' . htmlspecialchars($value['id']);
            ?>
                <div class="col">
                    <div class="product-card h-100 border-0 shadow-sm position-relative">
                        
                        <a href="<?php echo $relatedUrl; ?>" class="text-decoration-none">
                            <div class="product-img-wrapper position-relative">
                                <?php 
                                $finalPrice = ($value['discount_price'] !== null && $value['discount_price'] < $value['price']) ? $value['discount_price'] : $value['price'];
                                $showSaleBadge = ($value['is_sale'] == 1 && $value['discount_price'] !== null && $value['price'] > $value['discount_price']);
                                
                                // Logic tính % giảm giá
                                if ($showSaleBadge): 
                                    $discount_amount = $value['price'] - $value['discount_price'];
                                    $discount_percent = round(($discount_amount / $value['price']) * 100);
                                ?>
                                    <span
                                        class="badge bg-danger position-absolute top-0 end-0 m-1">-<?php echo $discount_percent ?>%</span>
                                <?php endif; ?>

                                <img src="<?php echo htmlspecialchars($value['image_url']) ?>"
                                    alt="<?php echo htmlspecialchars($value['name']) ?>"
                                    class="img-fluid card-img-top p-2" 
                                    style="height: 150px; object-fit: contain;">
                            </div>
                        </a>

                        <div class="card-body p-2 text-center">
                            <h6 class="product-title fw-normal mb-1">
                                <a href="<?php echo $relatedUrl; ?>" class="text-decoration-none text-dark small">
                                    <?php echo htmlspecialchars($value['name']) ?>
                                </a>
                            </h6>

                            <div class="product-price">
                                <?php if ($showSaleBadge): ?>
                                    <span
                                        class="text-danger fw-bold me-2"><?php echo Product::formatCurrency($value['discount_price']) ?></span>
                                    <del
                                        class="text-muted small"><?php echo Product::formatCurrency($value['price']) ?></del>
                                <?php else: ?>
                                    <span
                                        class="text-danger fw-bold"><?php echo Product::formatCurrency($value['price']) ?></span>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="card-footer bg-white border-0 p-2 d-flex justify-content-center">
                            <?php 
                            $showAddToCart = ($value['state'] == 'còn hàng');
                            ?>

                            <?php if ($showAddToCart): ?>
                            <button class="btn btn-sm btn-success js-add-to-cart w-100"
                                data-product-id="<?= htmlspecialchars($value['id']) ?>"
                                data-name="<?= htmlspecialchars($value['name']) ?>"
                                data-price="<?= htmlspecialchars($finalPrice) ?>"
                                data-image-url="<?= htmlspecialchars($value['image_url']) ?>">
                                Thêm vào giỏ hàng
                            </button>
                            <?php else: ?>
                            <a href="<?php echo $relatedUrl; ?>"
                                class="btn btn-sm btn-outline-secondary w-100">Đọc tiếp</a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="col-12">
                <p class="alert alert-info">Không tìm thấy sản phẩm liên quan nào trong danh mục này.</p>
            </div>
        <?php endif; ?>
    </div>
</div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
    // ========================================================
    // LOGIC THÊM VÀO GIỎ HÀNG (SỬ DỤNG data-* attributes)
    // ========================================================
    function handleAddToCart(event) {
        event.preventDefault();
        const button = event.currentTarget;

        // 1. Lấy dữ liệu sản phẩm từ data attributes
        const productData = {
            id: button.dataset.productId,
            name: button.dataset.name,
            price: parseFloat(button.dataset.price),
            imageUrl: button.dataset.imageUrl,
            quantity: 1
        };

        // 2. Lưu trữ Giỏ hàng (Sử dụng LocalStorage)
        let cart = JSON.parse(localStorage.getItem('cart')) || [];
        const existingItem = cart.find(item => item.id === productData.id);

        if (existingItem) {
            existingItem.quantity += 1;
        } else {
            cart.push(productData);
        }

        localStorage.setItem('cart', JSON.stringify(cart));

        // 3. (Tùy chọn) Highlight nút để người dùng thấy có phản hồi
        button.textContent = 'ĐÃ THÊM';
        button.disabled = true;
        setTimeout(() => {
            button.textContent = 'Thêm vào giỏ hàng';
            button.disabled = false;
        }, 1500);

        // KHÔNG CÓ alert() hay confirm()
    }

    // Gắn sự kiện cho các nút "Thêm vào giỏ hàng"
    const addToCartButtons = document.querySelectorAll('.js-add-to-cart');
    addToCartButtons.forEach(button => {
        button.addEventListener('click', handleAddToCart);
    });
});

    </script>
</body>

</html>