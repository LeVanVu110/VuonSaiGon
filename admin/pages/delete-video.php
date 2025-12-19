<?php
require_once '../../config.php';
require_once '../models/db.php';
require_once '../models/video.php';

if (isset($_GET['id'])) {
    $videoModel = new Videos();
    $videoModel->delete($_GET['id']);
    header("Location: video.php?success=deleted");
}