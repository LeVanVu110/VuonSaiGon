<?php
require_once '../../config.php';
require_once '../models/db.php';
require_once '../models/article_title.php';

if (isset($_POST['post_id'])) {
    $post_id = (int)$_POST['post_id'];
    $titleModel = new ArticleTitles();
    $parents = $titleModel->getParentsByPost($post_id);

    echo '<option value="0">Mục Chính (Cấp 1)</option>';
    if (!empty($parents)) {
        foreach ($parents as $p) {
            echo '<option value="' . $p['article_title_id'] . '">' . htmlspecialchars($p['title']) . '</option>';
        }
    }
}
?>