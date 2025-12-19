<?php
session_start();
require_once '../../config.php';
require_once '../models/db.php';
require_once '../models/post.php';

if (isset($_GET['id'])) {
    $postModel = new Posts();
    if ($postModel->delete($_GET['id'])) {
        header("Location: post.php?success=deleted");
    } else {
        header("Location: post.php?error=failed");
    }
}
exit();