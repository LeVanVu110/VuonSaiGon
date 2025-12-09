<?php
// 1. Nhúng kết nối và Model
include 'config/db.php';
include 'models/product.php'; // Nhúng file model vừa tạo

// 2. Gọi hàm để lấy dữ liệu (Lấy Model)
$list_products = get_all_products($conn);

// 3. Nhúng giao diện Header
include 'includes/header.php'; 
include 'includes/home/banner.php';
include 'includes/home/flashsale.php';
include 'includes/home/content.php';
include 'includes/home/content_2.php';
include 'includes/home/content_3.php';
include 'includes/home/content_4.php';
include 'includes/home/content_5.php';
include 'includes/home/map.php';
?>

<?php include 'includes/footer.php'; ?>