<?php 
// ----------------------------------------------------------------------------------
// PHẦN LOGIC CHÍNH: Lấy dữ liệu từ Class Product
// ----------------------------------------------------------------------------------

// 1. Khởi tạo đối tượng Product
$productModel = new Product(); 

// 2. Lấy TẤT CẢ sản phẩm từ DB bằng hàm getAllProduct()
$allProducts = $productModel->getAllProductSale(); 

// 3. Gọi hàm tiện ích qua tên class để chia sản phẩm thành các slide (6 sản phẩm/slide)
$productSlides = Product::chunkProductsForCarousel($allProducts, 6);

// 4. LẤY THỜI GIAN KẾT THÚC SALE TỪ DB
$endTime = $productModel->getActiveSaleEndTime();

// ----------------------------------------------------------------------------------
?>

<div class="container my-5 position-relative">
    <div class="d-flex flex-wrap justify-content-between align-items-center flash-header">
        <h3 class="text-uppercase title-text">SẢN PHẨM KHUYẾN MÃI</h3>
        <div class="mt-2 mt-md-0" style='margin-left:1%'>
            <div id="countdownTimer" class="countdown-box" data-end-time="<?= $endTime ?? '' ?>">
                Kết thúc trong &nbsp; Đang tải...
            </div>
        </div>
    </div>

    <div id="flashSaleCarousel" class="carousel slide" data-bs-interval="false">
        <div class="carousel-inner">

            <?php if (!empty($productSlides)): ?>
            <?php foreach ($productSlides as $slideIndex => $products): ?>
            <div class="carousel-item <?= $slideIndex === 0 ? 'active' : '' ?>">
                <div class="row g-3">

                    <?php foreach ($products as $product): 
$name = $product['name'] ?? 'Sản phẩm không tên';
$price = $product['price'] ?? 0;
$discountPrice = $product['discount_price'] ?? $price; 
$imageUrl = $product['image_url'] ?? $product['image'] ?? '#';
  ?>
                    <div class="col-6 col-md-4 col-lg-2">
                        <div class="card product-card">
                            <a href="#" class="card-img-wrapper">
                                <img src="<?= $imageUrl ?>" class="card-img-top" alt="<?= $name ?>">
                            </a>

                            <div class="card-body-custom">
                                <div>
                                    <span class="price-new"><?= Product::formatCurrency($discountPrice) ?></span>
                                    <span class="price-old"><?= Product::formatCurrency($price) ?></span>
                                </div>
                                <a href="#" class="product-title"><?= $name ?></a>
                            </div>

                            <div class="card-footer-custom"><a href="#" class="btn-action">Thêm vào giỏ</a></div>
                        </div>
                    </div>
                    <?php endforeach; ?>

                </div>
            </div>
            <?php endforeach; ?>
            <?php else: ?>
            <div class="carousel-item active">
                <p class="text-center text-muted py-5">Hiện không có sản phẩm nào để hiển thị.</p>
            </div>
            <?php endif; ?>

        </div>

        <button class="carousel-control-prev" type="button" data-bs-target="#flashSaleCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#flashSaleCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
</div>

<script>
// ... (Logic JavaScript giữ nguyên) ...
</script>
<script>
function initializeCountdown() {
    const timerElement = document.getElementById('countdownTimer');
    // Lấy thời gian kết thúc từ PHP
    const endTimeString = timerElement.getAttribute('data-end-time');

    // 1. Xử lý nếu không có dữ liệu sale
    if (!endTimeString || endTimeString.length === 0) {
        timerElement.innerHTML = 'Kết thúc trong &nbsp; Đang cập nhật';
        return;
    }

    const endTime = new Date(endTimeString).getTime();

    function updateCountdown() {
        const now = new Date().getTime();
        const distance = endTime - now;

        // Nếu thời gian đã hết
        if (distance < 0) {
            clearInterval(interval);
            timerElement.innerHTML = 'Kết thúc Sale!';
            return;
        }

        // Tính toán thời gian (Giờ, Phút, Giây)
        const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        const seconds = Math.floor((distance % (1000 * 60)) / 1000);

        // Hàm thêm số 0 vào trước
        const pad = (num) => String(num).padStart(2, '0');

        // Cập nhật HTML
        timerElement.innerHTML = `Kết thúc trong &nbsp; ${pad(hours)} : ${pad(minutes)} : ${pad(seconds)}`;
    }

    // Gọi hàm lần đầu và thiết lập lặp lại mỗi giây
    updateCountdown();
    const interval = setInterval(updateCountdown, 1000);
}

// Chạy hàm khi trang đã tải xong
document.addEventListener('DOMContentLoaded', initializeCountdown);
</script>