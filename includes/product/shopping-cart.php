<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Giỏ Hàng Của Bạn</title>
    
    <style>
        /* Thiết lập cơ bản */
        body {
            font-family: Arial, sans-serif;
            margin: 0; 
            padding: 0; 
            background-color: #f8f8f8;
        }

        .cart-container {
            max-width: 100%;
            margin: 50px auto;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.05);
        }
        
        .full-cart-content {
            background-color: #ffffff;
        }

        /* 1. Phần tiêu đề bảng và chi tiết sản phẩm */
        .cart-header, .cart-item {
            display: flex;
            padding: 15px 0;
            align-items: center;
            border-bottom: 1px solid #eee;
        }

        .cart-header {
            font-weight: bold;
            color: #333; 
            font-size: 0.95rem;
            text-transform: uppercase;
        }

        /* Định nghĩa chiều rộng các cột */
        .col-product { flex: 4; }
        .col-price { flex: 1.5; text-align: right; }
        .col-quantity { flex: 1.5; text-align: center; }
        .col-subtotal { flex: 1.5; text-align: right; }
        .col-action { flex: 0.5; text-align: right; }

        .product-info {
            display: flex;
            align-items: center;
        }

        .product-image {
            width: 80px;
            height: 80px;
            margin-right: 15px;
            border: 1px solid #ddd;
            overflow: hidden;
            flex-shrink: 0;
        }

        .product-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .product-name a {
            color: #1e8738;
            text-decoration: none;
            font-weight: 600;
        }

        /* Nút tăng/giảm số lượng */
        .quantity-control {
            display: flex;
            border: 1px solid #ccc;
            width: 120px;
            margin: 0 auto;
            border-radius: 4px;
        }

        .quantity-control input {
            width: 40px;
            text-align: center;
            border: none;
            outline: none;
            padding: 8px 0;
            margin: 0 5px;
            font-weight: bold;
        }

        .quantity-control button {
            background-color: #fff;
            border: none;
            padding: 5px 11px;
            cursor: pointer;
            font-size: 26px;
            line-height: 1;
        }
        
        .remove-item {
            color: #aaa;
            cursor: pointer;
            font-size: 24px;
            margin-left: 10px;
            line-height: 1;
        }
        
        /* 2. KHỐI HÀNH ĐỘNG DƯỚI DANH SÁCH SẢN PHẨM (NÚT QUAY LẠI VÀ XÓA GIỎ) */
        .cart-footer-actions-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px 0;
            margin-top: 15px; /* Khoảng cách sau item cuối */
        }
        
        .btn-back-to-shop {
            background-color: #1e8738;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            text-decoration: none;
            font-weight: bold;
            display: flex;
            align-items: center;
            width: max-content;
        }
        
        .btn-back-to-shop::before {
            content: '\2190'; 
            margin-right: 8px;
        }
        
        .btn-empty {
            background-color: #fff;
            color: #333;
            border: 1px solid #ccc;
            padding: 10px 20px;
            cursor: pointer;
            border-radius: 4px;
            font-weight: bold;
        }


        /* 3. KHỐI TỔNG CỘNG VÀ COUPON (Bố cục 2 cột dưới) */
        .cart-actions-bottom {
            padding: 20px 0;
            display: flex;
            justify-content: space-between;
            align-items: flex-start; 
        }
        
        .cart-summary-box {
            width: 40%;
            border: 1px solid #eee;
            padding: 15px;
        }

        /* Tổng phụ (Tổng) */
        .cart-subtotal-row {
            display: flex;
            justify-content: space-between;
            padding-bottom: 10px;
            border-bottom: 1px solid #eee;
            margin-bottom: 10px;
            font-size: 1rem;
        }

        /* Tổng cộng (Grand Total) */
        .cart-grand-total {
            display: flex;
            justify-content: space-between;
            font-size: 1.2rem;
            font-weight: bold;
            padding-top: 10px;
        }
        
        .cart-grand-total .total-amount {
            color: #d70018; /* Màu đỏ cho số tiền */
        }
        
        .shipping-note {
            font-size: 0.85rem;
            color: #d70018;
            margin-top: 10px;
            line-height: 1.4;
        }

        .btn-checkout {
            background-color: #ff8c00; 
            color: #fff;
            padding: 15px 30px;
            border: none;
            border-radius: 4px;
            font-weight: bold;
            font-size: 1.1rem;
            cursor: pointer;
        }

        /* --------------------------------- */
        /* TRẠNG THÁI GIỎ HÀNG TRỐNG */
        /* --------------------------------- */

        .empty-cart-message {
            background-color: #fcfcfc;
            border: 1px solid #c9c9c9; 
            border-top: 3px solid #007bff; 
            padding: 25px;
            margin-bottom: 25px;
            color: #555;
            display: flex;
            align-items: center;
        }

        .btn-shop {
            display: inline-block;
            padding: 12px 25px;
            background-color: #1e8738; 
            color: #fff;
            text-decoration: none;
            font-weight: bold;
            border-radius: 4px;
        }
        
        .hidden {
            display: none !important;
        }
    </style>
</head>
<body>
    <div class="cart-container">
        <h1>Giỏ Hàng Của Bạn</h1>
        
        <div id="fullCart" class="full-cart-content hidden"> 
            
            <div class="cart-header">
                <div class="col-product">SẢN PHẨM</div>
                <div class="col-price">ĐƠN GIÁ</div>
                <div class="col-quantity">SỐ LƯỢNG</div>
                <div class="col-subtotal">THÀNH TIỀN</div>
                <div class="col-action"></div>
            </div>
            
            <div id="cart-footer-actions" class="cart-footer-actions-row">
                <a href="product.php" class="btn-back-to-shop">
                    Quay lại sản phẩm
                </a>
                <button class="btn-empty" id="btn-empty-cart-top">
                    Xóa giỏ hàng
                </button>
            </div>
            
        </div> 
        
        <div id="cart-actions" class="cart-actions-bottom hidden">
            
            <div class="cart-left-actions" style="width: 50%;">
                
                <div class="coupon-section">
                    <h3 style="font-size: 1.2rem; color: #333;">Mã giảm giá</h3>
                    <div style="border: 1px solid #ccc; padding: 10px; display: flex; gap: 10px;">
                         <input type="text" placeholder="Nhập mã giảm giá" style="flex-grow: 1; border: none;">
                         <button style="padding: 5px 15px; background: #eee; border: 1px solid #ccc;">Áp dụng</button>
                    </div>
                </div>
            </div>
            
            <div class="cart-summary-box">
                <div class="cart-subtotal-row">
                    <span>Tổng</span>
                    <span id="subTotalSummary">0₫</span>
                </div>
                
                <div class="cart-grand-total">
                    <span>Tổng cộng</span>
                    <span class="total-amount" id="grandTotalSummary">0₫</span>
                </div>
                
                <p class="shipping-note">Giá hàng hóa chưa bao gồm phí vận chuyển, nhân viên tư vấn sẽ gọi lại báo phí vận chuyển.</p>
                
                <button class="btn-checkout" id="btn-checkout" style="width: 100%;">THANH TOÁN</button>
            </div>
        </div>

        <div id="emptyCart" class="hidden">
            <div class="empty-cart-message">
                Chưa có sản phẩm nào trong giỏ hàng.
            </div>
            <a href="product.php" class="btn-shop">Quay trở lại cửa hàng</a>
        </div>

    </div>
    
    <script>
        // Thêm hàm định dạng tiền tệ (cần thiết cho client-side render)
        function formatCurrency(price) {
            price = isNaN(price) ? 0 : price;
            return new Intl.NumberFormat('vi-VN', { 
                style: 'currency', 
                currency: 'VND' 
            }).format(price); 
        }

        let cartData = [];

        // DOM Elements
        const fullCartElement = document.getElementById('fullCart');
        const emptyCartElement = document.getElementById('emptyCart');
        const cartActionsElement = document.getElementById('cart-actions'); 
        const subTotalSummary = document.getElementById('subTotalSummary');
        const grandTotalSummary = document.getElementById('grandTotalSummary');
        const btnEmptyCart = document.getElementById('btn-empty-cart-top'); // Nút Xóa mới
        const btnCheckout = document.getElementById('btn-checkout');

        // =======================================================
        // HÀM QUẢN LÝ DỮ LIỆU
        // =======================================================
        
        function removeItem(index) {
            cartData.splice(index, 1);
            updateCartView();
            // Cập nhật badge giỏ hàng trên header nếu hàm đó tồn tại
            if (typeof updateCartCountBadge === 'function') { updateCartCountBadge(); }
        }

        function clearCart() {
             cartData = [];
             updateCartView();
             if (typeof updateCartCountBadge === 'function') { updateCartCountBadge(); }
        }

        function changeQuantity(index, delta) {
            if (cartData[index]) {
                cartData[index].quantity += delta;
                if (cartData[index].quantity <= 0) {
                    removeItem(index);
                } else {
                    updateCartView();
                }
            }
        }
        
        function calculateGrandTotal() {
            let total = 0;
            cartData.forEach(item => {
                total += item.price * item.quantity;
            });
            return total;
        }


        // =======================================================
        // HÀM CHÍNH: RENDER VÀ CẬP NHẬT GIAO DIỆN
        // =======================================================

        function updateCartView() {
            const container = fullCartElement;
            
            // Lấy và xóa các sản phẩm cũ (chỉ xóa các div có class cart-item)
            let currentItems = container.querySelectorAll('.cart-item');
            currentItems.forEach(item => item.remove());

            let grandTotal = calculateGrandTotal();

            // --- QUYẾT ĐỊNH HIỂN THỊ ---
            if (cartData.length === 0) {
                fullCartElement.classList.add('hidden');
                cartActionsElement.classList.add('hidden');
                emptyCartElement.classList.remove('hidden');
                localStorage.removeItem('cart');
                return;
            }

            fullCartElement.classList.remove('hidden');
            cartActionsElement.classList.remove('hidden');
            emptyCartElement.classList.add('hidden');

            // Điểm chèn là ngay sau cart-header
            const headerElement = container.querySelector('.cart-header');
            let insertBeforeElement = container.querySelector('.cart-footer-actions-row');
            
            // Thêm các sản phẩm mới
            cartData.forEach((item, index) => {
                const itemElement = document.createElement('div');
                itemElement.className = 'cart-item';
                itemElement.dataset.productId = item.id;
                
                const subtotal = item.price * item.quantity;

                itemElement.innerHTML = `
                    <div class="col-product product-info">
                        <div class="product-image">
                            <img src="${item.imageUrl}" alt="${item.name}">
                        </div>
                        <div class="product-name">
                            <a href="detailproduct.php?id=${item.id}">${item.name}</a>
                        </div>
                    </div>
                    <div class="col-price">${formatCurrency(item.price)}</div>
                    <div class="col-quantity">
                        <div class="quantity-control">
                            <button class="quantity-decrease" data-index="${index}">-</button>
                            <input type="number" value="${item.quantity}" min="1" readonly>
                            <button class="quantity-increase" data-index="${index}">+</button>
                        </div>
                    </div>
                    <div class="col-subtotal">${formatCurrency(subtotal)}</div>
                    <div class="col-action">
                        <span class="remove-item" data-index="${index}">&times;</span>
                    </div>
                `;
                
                // Chèn sản phẩm sau header
                container.insertBefore(itemElement, insertBeforeElement);
                
                // Cập nhật điểm chèn cho lần lặp tiếp theo
                insertBeforeElement = itemElement.nextElementSibling;
            });
            
            // CẬP NHẬT TỔNG CỘNG
            if (subTotalSummary && grandTotalSummary) {
                subTotalSummary.textContent = formatCurrency(grandTotal);
                grandTotalSummary.textContent = formatCurrency(grandTotal);
            }

            // Sau khi render xong, gắn lại sự kiện cho các nút hành động (tăng/giảm, xóa)
            attachEventListeners();
            
            // Đồng bộ hóa LocalStorage
            localStorage.setItem('cart', JSON.stringify(cartData));
        }


        // =======================================================
        // GẮN SỰ KIỆN CHO CÁC NÚT (Sau khi Render)
        // =======================================================

        function attachEventListeners() {
            // 1. Nút Xóa Sản phẩm (x)
            document.querySelectorAll('.remove-item').forEach(button => {
                button.onclick = (e) => {
                    const index = parseInt(e.target.dataset.index); 
                    removeItem(index);
                };
            });

            // 2. Nút Tăng Số lượng (+)
            document.querySelectorAll('.quantity-increase').forEach(button => {
                button.onclick = (e) => {
                    const index = parseInt(e.target.dataset.index);
                    changeQuantity(index, 1);
                };
            });

            // 3. Nút Giảm Số lượng (-)
            document.querySelectorAll('.quantity-decrease').forEach(button => {
                button.onclick = (e) => {
                    const index = parseInt(e.target.dataset.index);
                    changeQuantity(index, -1);
                };
            });
            
            // 4. Nút Xóa Giỏ hàng (Clear All)
            if (btnEmptyCart) {
                 btnEmptyCart.onclick = () => {
                     if (confirm("Bạn có chắc chắn muốn xóa tất cả sản phẩm trong giỏ hàng không?")) {
                         clearCart();
                     }
                 };
            }
            
            // 5. Nút Thanh toán
            if (btnCheckout) {
                let grandTotal = calculateGrandTotal();
                btnCheckout.onclick = () => {
                    alert(`Tổng tiền: ${formatCurrency(grandTotal)}. Chuyển đến trang thanh toán...`);
                    // TODO: window.location.href = 'checkout.php'; 
                };
            }
        }

        // =======================================================
        // KHỞI TẠO (ĐỌC DỮ LIỆU TỪ LOCALSTORAGE)
        // =======================================================

        document.addEventListener('DOMContentLoaded', () => {
            
            // 1. Đọc dữ liệu giỏ hàng từ LocalStorage
            const storedCart = localStorage.getItem('cart');
            
            if (storedCart) {
                try {
                    const parsedCart = JSON.parse(storedCart);
                    cartData = Array.isArray(parsedCart) ? parsedCart : []; 
                } catch (e) {
                    console.error("Lỗi khi đọc giỏ hàng từ LocalStorage:", e);
                    cartData = [];
                }
            } else {
                cartData = [];
            }
            
            // 2. Update view lần đầu với dữ liệu đã đọc
            updateCartView();
            
            // Cập nhật badge giỏ hàng trên header nếu hàm đó tồn tại (từ các file khác)
            if (typeof updateCartCountBadge === 'function') {
                updateCartCountBadge();
            }
        });
    </script>
</body>
</html>