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
            margin: 0;
            background-color: #ffffff;
            width: 100%; 
        }
        
        /* Đảm bảo toàn bộ nội dung giỏ hàng cũng full width */
        .full-cart-content {
            background-color: #ffffff;
        }

        /* 1. Phần tiêu đề bảng */
        .cart-header, .cart-item {
            display: flex;
            padding: 15px 20px;
            align-items: center;
            border-bottom: 1px solid #eee;
        }
        
        /* 3. Phần chân trang và hành động */
        .cart-footer {
            padding: 20px;
            border-top: 1px solid #ddd;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        /* Nếu bạn muốn thông báo giỏ hàng trống cũng sát lề */
        .empty-cart-message {
            margin: 0; 
            border-left: none; 
            border-right: none; 
        }

        /* Định nghĩa chiều rộng các cột */
        .col-product { flex: 4; }
        .col-price { flex: 1.5; text-align: right; }
        .col-quantity { flex: 1.5; text-align: center; }
        .col-subtotal { flex: 1.5; text-align: right; }
        .col-action { flex: 0.5; text-align: right; }

        /* 2. Phần chi tiết sản phẩm */
        .cart-item { color: #555; }

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
        }

        .product-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .product-name a {
            color: #1e8738;
            text-decoration: none;
        }

        /* Nút tăng/giảm số lượng */
        .quantity-control {
            display: flex;
            border: 1px solid #ccc;
            width: 120px;
            margin: 0 auto;
        }

        .quantity-control input {
            width: 40px;
            text-align: center;
            border: none;
            outline: none;
            padding: 8px 0;
            margin: 0 5px;
            justify-items: end;
        }

        .quantity-control button {
            background-color: #fff;
            border: none;
            padding: 5px 11px;
            cursor: pointer;
            font-size: 26px;
        }
        
        /* 3. Phần chân trang và hành động */
        .cart-footer {
            padding: 20px;
            border-top: 1px solid #ddd;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .btn-back, .btn-empty {
            padding: 10px 20px;
            cursor: pointer;
            border-radius: 4px;
            text-decoration: none;
            font-weight: bold;
        }

        .btn-back {
            background-color: #1e8738;
            color: #fff;
            border: none;
        }
        
        .btn-back::before {
            content: '\2190'; 
            margin-right: 8px;
        }

        .btn-empty {
            background-color: #fff;
            color: #333;
            border: 1px solid #ccc;
        }
        
        .remove-item {
            color: #aaa;
            cursor: pointer;
            font-size: 18px;
            margin-left: 10px;
        }
        
        /* --------------------------------- */
        /* TRẠNG THÁI GIỎ HÀNG TRỐNG */
        /* --------------------------------- */

        /* Hộp thông báo Giỏ hàng trống */
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

        /* Biểu tượng Checkbox (mô phỏng icon trong ảnh) */
        .empty-cart-message::before {
            content: '\2610'; 
            font-size: 1.2em;
            margin-right: 15px;
            color: #aaa; 
        }

        /* Nút chính cho giỏ hàng trống */
        .btn-shop {
            display: inline-block;
            padding: 12px 25px;
            background-color: #1e8738; 
            color: #fff;
            text-decoration: none;
            font-weight: bold;
            border-radius: 4px;
        }
        
        /* CSS cho việc ẩn/hiện */
        .hidden {
            display: none;
        }
    </style>
</head>
<body>
    <div class="cart-container">
        
        <div id="fullCart" class="full-cart-content hidden"> 
            <div class="cart-header">
                <div class="col-product">SẢN PHẨM</div>
                <div class="col-price">ĐƠN GIÁ</div>
                <div class="col-quantity">SỐ LƯỢNG</div>
                <div class="col-subtotal">THÀNH TIỀN</div>
                <div class="col-action"></div>
            </div>

            <div class="cart-footer">
                <a href="product.php" class="btn-back">Quay lại sản phẩm</a>
                <button class="btn-empty">Xóa giỏ hàng</button>
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
            // Sử dụng regex để đảm bảo định dạng ₫ cuối cùng, nếu cần
            return new Intl.NumberFormat('vi-VN', { 
                style: 'currency', 
                currency: 'VND' 
            }).format(price).replace('₫', '').trim() + '₫'; 
        }

        // 1. Cấu trúc dữ liệu giỏ hàng ảo (Cart State)
        let cartData = [];

        // 2. DOM Elements
        const fullCartElement = document.getElementById('fullCart');
        const emptyCartElement = document.getElementById('emptyCart');
        const cartHeaderElement = fullCartElement.querySelector('.cart-header');


        // =======================================================
        // HÀM CHÍNH: RENDER VÀ CẬP NHẬT GIAO DIỆN
        // =======================================================

        function updateCartView() {
            const container = fullCartElement;
            
            // Xóa các sản phẩm cũ (chỉ xóa các div có class cart-item)
            let currentItems = container.querySelectorAll('.cart-item');
            currentItems.forEach(item => item.remove());

            // --- QUYẾT ĐỊNH HIỂN THỊ ---
            if (cartData.length === 0) {
                fullCartElement.classList.add('hidden');
                emptyCartElement.classList.remove('hidden');
                // Đồng bộ hóa LocalStorage
                localStorage.removeItem('cart');
                return;
            }

            fullCartElement.classList.remove('hidden');
            emptyCartElement.classList.add('hidden');

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
                            <a href="#">${item.name}</a>
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
                
                // Chèn sản phẩm mới ngay sau header (Header là phần tử đầu tiên của fullCartElement)
                container.insertBefore(itemElement, container.querySelector('.cart-footer'));
            });

            // Sau khi render xong, gắn lại sự kiện cho các nút
            attachEventListeners();
            
            // Đồng bộ hóa LocalStorage
            localStorage.setItem('cart', JSON.stringify(cartData));
        }


        // =======================================================
        // HÀM QUẢN LÝ DỮ LIỆU
        // =======================================================
        
        function removeItem(index) {
            // Xóa phần tử khỏi mảng
            cartData.splice(index, 1);
            // Cập nhật lại giao diện và LocalStorage
            updateCartView();
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


        // =======================================================
        // GẮN SỰ KIỆN CHO CÁC NÚT (Sau khi Render)
        // =======================================================

        function attachEventListeners() {
            // 1. Nút Xóa Sản phẩm (x)
            document.querySelectorAll('.remove-item').forEach(button => {
                button.onclick = (e) => {
                    // Lấy index từ dataset (index được gán khi render)
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
            const clearCartButton = fullCartElement.querySelector('.btn-empty');
            if (clearCartButton) {
                 clearCartButton.onclick = () => {
                    if (confirm("Bạn có chắc chắn muốn xóa tất cả sản phẩm trong giỏ hàng không?")) {
                        cartData = [];
                        updateCartView();
                    }
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
            
            // Nếu bạn muốn bắt đầu test với giỏ hàng rỗng,
            // hãy bỏ comment dòng dưới đây (và xóa các dữ liệu cũ trong localStorage)
            // cartData = []; updateCartView(); 
        });
    </script>
</body>
</html>