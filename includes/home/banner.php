<?php 
$banner = new Banner;
$banners = $banner->getAllBanner();

/*
// Nếu bạn muốn kiểm tra lỗi ảnh, hãy bật đoạn debug này
echo '<pre>';
print_r($banners);
echo '</pre>';
*/
?>

<section id="bannerCarousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="3000">
    
    <div class="container p-0"> 
        
        <div class="carousel-indicators">
            <?php foreach ($banners as $index => $url): ?>
                <button type="button" 
                        data-bs-target="#bannerCarousel" 
                        data-bs-slide-to="<?= $index ?>" 
                        class="<?= $index === 0 ? 'active' : '' ?>" 
                        aria-current="<?= $index === 0 ? 'true' : 'false' ?>" 
                        aria-label="Slide <?= $index + 1 ?>"></button>
            <?php endforeach; ?>
        </div>

        <div class="carousel-inner">
            <?php foreach ($banners as $index => $url): ?>
                <div class="carousel-item <?= $index === 0 ? 'active' : '' ?>">
                    <img src="<?= $url['image'] ?>" class="d-block w-100 banner-img" alt="Banner">
                </div>
            <?php endforeach; ?>
        </div>

        <button class="carousel-control-prev" type="button" data-bs-target="#bannerCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        
        <button class="carousel-control-next" type="button" data-bs-target="#bannerCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
</section>

<section class="policy-area py-4 bg-white border-bottom">
   <div class="container my-4">
    <div class="row g-4 text-start">
        
        <div class="col-6 col-lg-3 border-end">
            <div class="box-item">
                <div class="martfury-icon-box mf-icon-left d-flex align-items-center justify-content-center justify-content-lg-start ps-lg-3">
                    <div class="mf-icon box-icon me-3">
                        <i class="bi bi-rocket-takeoff" style="color: #fcbd12; font-size: 40px;"></i> 
                    </div>
                    <div class="box-wrapper">
                        <span class="box-title fw-bold text-dark d-block">Giao hàng</span>
                        <div class="desc text-muted small">Toàn quốc</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-6 col-lg-3 border-end">
            <div class="box-item">
                <div class="martfury-icon-box mf-icon-left d-flex align-items-center justify-content-center justify-content-lg-start ps-lg-3">
                    <div class="mf-icon box-icon me-3">
                        <i class="bi bi-arrow-repeat" style="color: #fcbd12; font-size: 40px;"></i>
                    </div>
                    <div class="box-wrapper">
                        <span class="box-title fw-bold text-dark d-block">Đổi trả</span>
                        <div class="desc text-muted small">Linh hoạt</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-6 col-lg-3 border-end">
            <div class="box-item">
                <div class="martfury-icon-box mf-icon-left d-flex align-items-center justify-content-center justify-content-lg-start ps-lg-3">
                    <div class="mf-icon box-icon me-3">
                        <i class="bi bi-credit-card-2-front" style="color: #fcbd12; font-size: 40px;"></i>
                    </div>
                    <div class="box-wrapper">
                        <span class="box-title fw-bold text-dark d-block">Nhận hàng</span>
                        <div class="desc text-muted small">Thanh toán</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-6 col-lg-3">
            <div class="box-item">
                <div class="martfury-icon-box mf-icon-left d-flex align-items-center justify-content-center justify-content-lg-start ps-lg-3">
                    <div class="mf-icon box-icon me-3">
                        <i class="bi bi-chat-left-text" style="color: #fcbd12; font-size: 40px;"></i>
                    </div>
                    <div class="box-wrapper">
                        <span class="box-title fw-bold text-dark d-block">Hỗ trợ</span>
                        <div class="desc text-muted small">Tư vấn kỹ thuật</div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
</section>