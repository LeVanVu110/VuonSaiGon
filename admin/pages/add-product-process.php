<?php
session_start();
require_once '../../config.php';
require_once '../models/db.php';
require_once '../models/product.php';

if (isset($_POST['btn-add'])) {
    $productModel = new Products();

    // Lấy dữ liệu từ POST
    $name = $_POST['name'];
    $price = $_POST['price'];
    $discount_price = !empty($_POST['discount_price']) ? $_POST['discount_price'] : 0;
    $quantity = $_POST['quantity'];
    $state = $_POST['state'];
    $image_url = $_POST['image_url'];
    $description = $_POST['description'];
    
    // Xử lý checkbox is_sale
    $is_sale = isset($_POST['is_sale']) ? 1 : 0;

    // Gọi hàm addProduct từ model (Sử dụng đúng thứ tự tham số trong model bạn đã viết)
    $result = $productModel->addProduct($name, $price, $discount_price, $description, $quantity, $state, $image_url, $is_sale);

    if ($result) {
        // Thành công: Chuyển về trang danh sách sản phẩm
        header("Location: product.php?success=add");
    } else {
        // Thất bại: Thông báo lỗi
        echo "Lỗi: Không thể thêm sản phẩm!";
    }
    exit();
}