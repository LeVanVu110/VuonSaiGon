<?php
require_once '../../config.php';
require_once '../models/db.php';
require_once '../models/article_title.php';

if (isset($_GET['id'])) {
    $titleModel = new ArticleTitles();
    $titleModel->delete($_GET['id']);
    header("Location: article-title.php?success=deleted");
}