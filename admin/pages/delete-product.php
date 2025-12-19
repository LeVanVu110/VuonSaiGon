<?php
session_start();
// Bảo mật: Chỉ admin mới được xóa
if (!isset($_SESSION['user']) || $_SESSION['user']['role_name'] !== 'admin') {
    header("Location: sign-in.php");
    exit();
}

require_once '../../config.php';
require_once '../models/db.php';
require_once '../models/product.php';

if (isset($_GET['id'])) {
    $productModel = new Products();
    $id = $_GET['id'];

    if ($productModel->deleteProduct($id)) {
        header("Location: product.php?success=deleted");
    } else {
        header("Location: product.php?error=delete_failed");
    }
    exit();
}