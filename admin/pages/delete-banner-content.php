<?php
require_once '../../config.php';
require_once '../models/db.php';
require_once '../models/banner_content.php';

if (isset($_GET['id'])) {
    $contentModel = new BannerContent();
    $contentModel->delete($_GET['id']);
    header("Location: banner-content.php?success=deleted");
}