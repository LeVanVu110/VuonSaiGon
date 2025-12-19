<?php
session_start();
require_once '../../config.php';
require_once '../models/db.php';
require_once '../models/banner_content.php';

if (isset($_POST['btn-add'])) {
    $contentModel = new BannerContent();

    // Lấy dữ liệu từ form (Lưu ý tên cột tile và conntent trong SQL của bạn)
    $title = $_POST['tile'];
    $content = $_POST['conntent'];

    // Thực hiện thêm vào database
    $result = $contentModel->add($title, $content);

    if ($result) {
        // Thành công: Chuyển hướng về trang danh sách
        header("Location: banner-content.php?success=added");
    } else {
        // Thất bại
        echo "Lỗi: Không thể lưu nội dung banner.";
    }
    exit();
}