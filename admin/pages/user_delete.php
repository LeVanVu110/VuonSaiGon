<?php
require_once '../../config.php';
require_once '../models/db.php';
require_once '../models/user.php';

// Kiểm tra quyền Admin (giống trang Dashboard)


if (isset($_GET['id'])) {
    $userModel = new Users(); // Sử dụng class Users từ file user.php của bạn
    $id = $_GET['id'];

    // Không cho phép Admin tự xóa chính mình (Tránh lỗi hệ thống)
    if ($id == $_SESSION['user']['user_id']) {
        header("Location: profile.php?error=self_delete");
        exit();
    }

    $result = $userModel->delete($id); // Gọi hàm delete đã viết trong model

    if ($result) {
        header("Location: profile.php?success=delete");
    } else {
        header("Location: profile.php?error=delete_failed");
    }
} else {
    header("Location: profile.php");
}
exit();