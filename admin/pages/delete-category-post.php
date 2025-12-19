<?php
require_once '../../config.php';
require_once '../models/db.php';
require_once '../models/category_post.php';

if (isset($_GET['id'])) {
    $catPostModel = new CategoryPost();
    if($catPostModel->delete($_GET['id'])) {
        header("Location: category-post.php?success=deleted");
    }
}