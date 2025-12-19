<?php
session_start();
// Bảo mật: Chỉ admin mới được xóa
if (!isset($_SESSION['user']) || $_SESSION['user']['role_name'] !== 'admin') {
    header("Location: sign-in.php");
    exit();
}

require_once '../../config.php';
require_once '../models/db.php';
require_once '../models/banner.php';

if (isset($_GET['id'])) {
    $bannerModel = new Banners();
    $id = $_GET['id'];

    if ($bannerModel->deleteBanner($id)) {
        // Xóa thành công quay về kèm thông báo
        header("Location: banner.php?success=deleted");
    } else {
        header("Location: banner.php?error=failed");
    }
    exit();
} else {
    header("Location: banner.php");
    exit();
}