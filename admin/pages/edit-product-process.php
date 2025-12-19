<?php
session_start();
require_once '../../config.php';
require_once '../models/db.php';
require_once '../models/product.php';

if (isset($_POST['btn-edit'])) {
    $productModel = new Products();

    $id = $_POST['id'];
    $name = $_POST['name'];
    $price = $_POST['price'];
    $discount_price = $_POST['discount_price'];
    $image_url = $_POST['image_url'];
    $state = $_POST['state'];
    $is_sale = isset($_POST['is_sale']) ? 1 : 0;
    $description = "Cập nhật sản phẩm"; // Bạn có thể thêm textarea description vào form nếu cần

    // Chú ý: Thứ tự tham số phải khớp với hàm updateProduct trong Model của bạn
    $result = $productModel->updateProduct($id, $name, $price, $discount_price, $description, 0, $state, $image_url, $is_sale);

    if ($result) {
        header("Location: product.php?success=updated");
    } else {
        echo "Lỗi khi cập nhật sản phẩm!";
    }
    exit();
}