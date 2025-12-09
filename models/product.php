<?php
// File: models/product.php

/**
 * Lấy tất cả sản phẩm
 * @param mysqli $conn Biến kết nối CSDL
 * @return array Mảng chứa danh sách sản phẩm
 */
function get_all_products($conn) {
    // 1. Viết câu lệnh SQL
    $sql = "SELECT * FROM products ORDER BY created_at DESC";
    
    // 2. Thực thi câu lệnh
    $result = mysqli_query($conn, $sql);
    
    // 3. Tạo mảng rỗng để chứa dữ liệu
    $data = [];
    
    // 4. Lặp qua kết quả và đưa vào mảng
    if (mysqli_num_rows($result) > 0) {
        // Cách 1: Dùng fetch_all (Nhanh gọn, nhưng cần PHP driver native)
        // $data = mysqli_fetch_all($result, MYSQLI_ASSOC);
        
        // Cách 2: Dùng vòng lặp (An toàn nhất cho mọi phiên bản)
        while ($row = mysqli_fetch_assoc($result)) {
            $data[] = $row;
        }
    }
    
    // 5. Trả về dữ liệu
    return $data;
}

/**
 * Lấy 1 sản phẩm theo ID (Dùng cho trang chi tiết)
 */
function get_product_by_id($conn, $id) {
    $sql = "SELECT * FROM products WHERE product_id = $id";
    $result = mysqli_query($conn, $sql);
    return mysqli_fetch_assoc($result);
}
?>