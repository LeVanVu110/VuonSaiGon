<?php

require_once '../../config.php';
require_once '../models/db.php';
require_once '../models/category.php';

if (isset($_GET['id'])) {
    $catModel = new Categories();
    // Lưu ý: Do ràng buộc ON DELETE CASCADE trong SQL, xóa cha sẽ tự xóa con
    if ($catModel->deleteCategory($_GET['id'])) {
        header("Location: category.php?success=deleted");
    } else {
        header("Location: category.php?error=failed");
    }
}
exit();