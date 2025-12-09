<?php
// 1. Nhúng kết nối và Model
include 'config/db.php';
include 'models/product.php'; // Nhúng file model vừa tạo

// 2. Gọi hàm để lấy dữ liệu (Lấy Model)
$list_products = get_all_products($conn);

// 3. Nhúng giao diện Header
include 'includes/header.php'; 
include 'includes/banner.php';
?>

<?php include 'includes/footer.php'; ?>