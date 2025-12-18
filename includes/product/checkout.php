<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang Thanh Toán</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@1.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
    body {
        background-color: #fcfcfc;
        font-family: sans-serif;
    }

    .checkout-container {
        max-width: 1000px;
        margin-top: 50px;
    }

    .section-title {
        color: #7ab33e;
        font-weight: bold;
        margin-bottom: 20px;
    }

    .order-summary {
        border: 2px solid #eee;
        padding: 20px;
    }

    .btn-order {
        background-color: #1a5c31;
        color: white;
        border: none;
        width: 100%;
        padding: 10px;
        font-weight: bold;
    }

    .btn-order:hover {
        background-color: #134625;
        color: white;
    }

    .promo-banner {
        background-color: #f7f7f7;
        border: 1px dashed #ccc;
        padding: 10px;
        margin-bottom: 30px;
        font-size: 0.9rem;
    }

    .total-price {
        color: #d9534f;
        font-weight: bold;
    }

    .shipping-note {
        color: #d9534f;
        font-size: 0.85rem;
        font-style: italic;
        margin-top: 10px;
    }
    </style>
</head>

<body>

    <div class="container checkout-container">
        <div class="promo-banner mb-3">
            <i class="bi bi-chat-dots"></i>
            Bạn có mã giảm giá?
            <a href="#collapseCoupon" class="text-decoration-none text-info" data-bs-toggle="collapse" role="button"
                aria-expanded="false" aria-controls="collapseCoupon">
                Nhấn vào đây để nhập mã
            </a>
        </div>

        <div class="collapse mb-4" id="collapseCoupon">
            <div class="card card-body border-secondary-subtle">
                <p class="mb-2">If you have a coupon code, please apply it below.</p>
                <div class="row g-2">
                    <div class="col-12">
                        <input type="text" class="form-control mb-2" placeholder="Nhập mã giảm giá"
                            style="width: 100%!important;">
                    </div>
                    <div class="col-auto">
                        <button type="button" class="btn btn-danger px-4 fw-bold text-uppercase"
                            style="background-color: #ff0000;">
                            Apply coupon
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-7">
                <h4 class="section-title">Thông tin thanh toán</h4>
                <form>
                    <div class="mb-3">
                        <label class="form-label">Họ và Tên <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" style="width: 100%!important;
                            ">
                    </div>
                    <div class="mb-3">
                        <label class="form-label ">Địa chỉ <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" placeholder="Địa chỉ" style="width: 100%!important;">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Số điện thoại <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" style="width: 100%!important;">
                    </div>

                    <h4 class="section-title mt-4">Thông tin bổ sung</h4>
                    <div class="mb-3">
                        <label class="form-label">Ghi chú đơn hàng (tuỳ chọn)</label>
                        <textarea class="form-control" rows="4" style="width: 100%!important;"
                            placeholder="Ghi chú về đơn hàng, ví dụ: thời gian hay chỉ dẫn địa điểm giao hàng chi tiết hơn."></textarea>
                    </div>
                </form>
            </div>

            <div class="col-md-5">
                <h4 class="section-title">Thông tin đơn hàng</h4>
                <div class="order-summary bg-white">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>SẢN PHẨM</th>
                                <th class="text-end">TẠM TÍNH</th>
                            </tr>
                        </thead>
                        <tbody id="checkout-cart-items">
                        </tbody>
                        <tfoot>
                            <tr>
                                <td class="fw-bold">Tạm tính</td>
                                <td class="text-end total-price" id="checkout-subtotal">0₫</td>
                            </tr>
                            <tr>
                                <td class="fw-bold fs-5">Tổng</td>
                                <td class="text-end total-price fs-5" id="checkout-total">0₫</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>

                <div class="payment-method mb-3">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="payment" id="cod" checked>
                        <label class="form-check-label fw-bold" for="cod">
                            Trả tiền mặt khi nhận hàng
                        </label>
                    </div>
                    <div class="ms-4 text-muted small">
                        Trả tiền mặt khi giao hàng.
                    </div>
                </div>

                <button class="btn btn-order text-uppercase">Đặt hàng</button>
                <p class="shipping-note">
                    Giá hàng hóa chưa bao gồm phí vận chuyển, nhân viên tư vấn sẽ gọi lại báo phí vận chuyển.
                </p>
            </div>
        </div>
    </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/dist/js/bootstrap.bundle.min.js"></script>
</body>
<script>
    function formatCurrency(price) {
        return new Intl.NumberFormat('vi-VN', { 
            style: 'currency', 
            currency: 'VND' 
        }).format(price).replace('₫', '₫');
    }

    document.addEventListener('DOMContentLoaded', () => {
        const cartData = JSON.parse(localStorage.getItem('cart')) || [];
        const itemsContainer = document.getElementById('checkout-cart-items');
        const subtotalEl = document.getElementById('checkout-subtotal');
        const totalEl = document.getElementById('checkout-total');

        if (cartData.length === 0) {
            alert("Không có dữ liệu đơn hàng. Quay lại giỏ hàng.");
            window.location.href = 'shopping-cart.php';
            return;
        }

        let totalAmount = 0;
        let htmlContent = '';

        cartData.forEach(item => {
            const subtotal = item.price * item.quantity;
            totalAmount += subtotal;

            htmlContent += `
                <tr>
                    <td class="small">${item.name} <strong>× ${item.quantity}</strong></td>
                    <td class="text-end">${formatCurrency(subtotal)}</td>
                </tr>
            `;
        });

        // Đổ dữ liệu vào giao diện
        itemsContainer.innerHTML = htmlContent;
        subtotalEl.textContent = formatCurrency(totalAmount);
        totalEl.textContent = formatCurrency(totalAmount);
    });
</script>
</html>