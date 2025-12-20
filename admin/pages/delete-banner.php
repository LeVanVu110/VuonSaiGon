<?php

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