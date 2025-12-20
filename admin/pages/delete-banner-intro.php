<?php

require_once '../../config.php';
require_once '../models/db.php';
require_once '../models/banner_intro.php';

if (isset($_GET['id'])) {
    $introModel = new BannerIntro();
    $id = $_GET['id'];

    if ($introModel->delete($id)) {
        // Xóa thành công, quay về kèm thông báo
        header("Location: banner-intro.php?success=deleted");
    } else {
        // Thất bại
        header("Location: banner-intro.php?error=failed");
    }
} else {
    header("Location: banner-intro.php");
}
exit();