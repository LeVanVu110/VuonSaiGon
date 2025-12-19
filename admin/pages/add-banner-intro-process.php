<?php
session_start();
require_once '../../config.php';
require_once '../models/db.php';
require_once '../models/banner_intro.php';

if (isset($_POST['btn-add'])) {
    $introModel = new BannerIntro();

    $image = $_POST['image'];
    
    // Logic cho nút Switch: Nếu check thì lấy 1, không check thì lấy 0
    $is_view = isset($_POST['is_view']) ? 1 : 0;

    // Gọi hàm add từ Model banner_intro.php
    $result = $introModel->add($image, $is_view);

    if ($result) {
        // Chuyển về trang danh sách kèm thông báo thành công
        header("Location: banner-intro.php?success=added");
    } else {
        // Thông báo nếu có lỗi xảy ra
        echo "Lỗi: Không thể thêm dữ liệu vào bảng banner_introduct.";
    }
    exit();
}