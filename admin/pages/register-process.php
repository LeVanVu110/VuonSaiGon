<?php
require_once '../../config.php'; // Chứa các hằng số DB_HOST, DB_USER...
require_once '../models/db.php';
require_once '../models/user.php';

$userModel = new Users();

if (isset($_POST['btn-register'])) {
    $gmail = $_POST['gmail'];
    $password = $_POST['password'];

    // 1. Kiểm tra email đã tồn tại chưa
    if ($userModel->checkEmailExists($gmail)) {
        header("Location: sign-up.php?error=exists");
        exit();
    }

    // 2. Tiến hành đăng ký
    if ($userModel->register($gmail, $password)) {
        // Đăng ký thành công, chuyển sang trang đăng nhập
        header("Location: sign-in.php?success=registered");
    } else {
        header("Location: sign-up.php?error=failed");
    }
    exit();
}