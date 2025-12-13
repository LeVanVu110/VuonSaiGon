<?php
class Product extends Db
{
    /**
     * Constructor: Đảm bảo gọi constructor lớp cha để khởi tạo kết nối tĩnh (self::$connection)
     */
    public function __construct()
    {
        // Bắt buộc gọi constructor lớp cha (Db) để kích hoạt kết nối Singleton.
        parent::__construct(); 
    }

    /**
     * Lấy TẤT CẢ sản phẩm.
     * @return array Danh sách sản phẩm (MYSQLI_ASSOC)
     */
    public function getAllCountProducts()
    {
       $sql = self::$connection->prepare("SELECT Count(*) FROM products");
        $sql->execute(); //return an object
        $banners = array();
        $banners = $sql->get_result()->fetch_all(MYSQLI_ASSOC);
        return $banners; //return an array
    }
    public function getAllProduct($sortType = 'default')
    {
        $conn = self::$connection;
    if ($conn === null) return [];

    $orderBy = "";
    switch ($sortType) {
        case 'price_asc':
            $orderBy = "ORDER BY price ASC"; // Thay 'price' bằng tên cột giá thực tế của bạn
            break;
        case 'price_desc':
            $orderBy = "ORDER BY price DESC";
            break;
        case 'popularity':
            $orderBy = "ORDER BY quantity DESC"; // Giả sử bạn có cột để đo lường độ phổ biến
            break;
        case 'default':
        default:
            $orderBy = "ORDER BY id DESC"; // Sắp xếp mặc định theo ID mới nhất hoặc thứ tự bạn muốn
            break;
    }

    $sql = $conn->prepare("SELECT * FROM products " . $orderBy);
    $sql->execute();
    $products = $sql->get_result()->fetch_all(MYSQLI_ASSOC);
    return $products;
    }
    
    /**
     * Lấy tất cả sản phẩm đang sale (is_sale=1).
     * @return array Danh sách sản phẩm
     */
    public function getAllProductSale()
    {
        $conn = self::$connection;
        if ($conn === null) return [];

        $sql = $conn->prepare("SELECT * FROM `products` WHERE `is_sale`=1");
        $sql->execute(); 
        $products = $sql->get_result()->fetch_all(MYSQLI_ASSOC);
        return $products; 
    }
    
    /**
     * Lấy tất cả sản phẩm không sale (is_sale=0).
     * @return array Danh sách sản phẩm
     */
    public function Receivealllandproducts()
    {
        $conn = self::$connection;
        if ($conn === null) return [];

        $sql = $conn->prepare("SELECT * FROM `products` WHERE `is_sale`=0");
        $sql->execute(); 
        $products = $sql->get_result()->fetch_all(MYSQLI_ASSOC);
        return $products; 
    }

    // Các hàm static (chunk, formatCurrency) giữ nguyên
    public static function chunkReceivealllandproductsForCarousel($products, $size = 6)
    {
        if (empty($products) || !is_array($products)) {
            return [];
        }
        return array_chunk($products, $size);
    }
    
    public static function formatCurrency($price)
    {
        $price = is_numeric($price) ? $price : 0;
        return number_format($price, 0, ',', '.') . 'đ';
    }

    public static function chunkProductsForCarousel($products, $size = 6)
    {
        if (empty($products) || !is_array($products)) {
            return [];
        }
        return array_chunk($products, $size);
    }
    
    /**
     * Lấy thời gian kết thúc của sự kiện Flash Sale đang hoạt động.
     * @return string|null Thời gian kết thúc (format ISO 8601) hoặc null.
     */
    public function getActiveSaleEndTime()
    {
        $conn = self::$connection;
        if ($conn === null) return null;

        $sql = $conn->prepare("SELECT end_time FROM flash_sale_events WHERE is_active = 1 AND end_time > NOW() LIMIT 1");
        $sql->execute(); 
        $result = $sql->get_result()->fetch_assoc();
        
        return $result ? date('c', strtotime($result['end_time'])) : null; 
    }

    // Code trong Product.php

/**
 * Lấy danh sách sản phẩm từ CSDL với chức năng phân trang.
 * @param string $category_slug Lấy sản phẩm theo danh mục (tùy chọn)
 * @param int $page Số trang hiện tại (mặc định 1)
 * @param int $products_per_page Số sản phẩm trên mỗi trang (mặc định 12)
 * @return array Danh sách sản phẩm cho trang hiện tại
 */
// FILE: product.php (Chỉ phần hàm get_products)

/**
 * Lấy danh sách sản phẩm từ CSDL với chức năng phân trang, lọc và sắp xếp.
 *
 * @param string $category_slug Slug của danh mục (cha hoặc con).
 * @param array $category_ids Mảng ID danh mục để lọc (dùng cho danh mục cha và con).
 */
// FILE: product.php (Chỉ phần hàm get_products)

/**
 * Lấy danh sách sản phẩm từ CSDL với chức năng phân trang, lọc và sắp xếp.
 * * Đã sửa đổi để thêm tham số $keyword.
 */
public function get_products($category_slug = null, $category_ids = [], $page = 1, $products_per_page = 12, $sortType = 'default', $keyword = null) // <-- THÊM $keyword
    {
        $conn = self::$connection;
        if ($conn === null) return [];
        
        $page = max(1, (int)$page); 
        $offset = ($page - 1) * $products_per_page;
        
        $products = [];
        $sql = "SELECT p.* FROM products p ";
        $where = "WHERE 1=1 "; // Bắt đầu WHERE clause

        if (!empty($category_ids)) {
            // Lọc theo danh mục (Giữ nguyên)
            $id_string = implode(',', array_map('intval', $category_ids)); 
            $sql .= "JOIN category_product cp ON p.id = cp.product_id ";
            $where .= "AND cp.category_id IN ({$id_string}) "; 
        }

        if (!empty($keyword)) {
            // Lọc theo từ khóa tìm kiếm
            $escaped_keyword = $conn->real_escape_string($keyword);
            $where .= "AND (p.name LIKE '%{$escaped_keyword}%' OR p.description LIKE '%{$escaped_keyword}%') ";
        }
        
        // LOGIC SẮP XẾP SẢN PHẨM (Giữ nguyên)
        $orderBy = "ORDER BY p.id DESC";
        switch ($sortType) {
            // ... (Logic switch case giữ nguyên) ...
            case 'price_asc':
                $orderBy = "ORDER BY p.price ASC";
                break;
            case 'price_desc':
                $orderBy = "ORDER BY p.price DESC";
                break;
            case 'popularity':
                $orderBy = "ORDER BY p.quantity DESC"; 
                break;
            case 'default':
            default:
                $orderBy = "ORDER BY p.id DESC"; 
                break;
        }
        
        $sql .= $where . " " . $orderBy . " LIMIT " . (int)$products_per_page . " OFFSET " . $offset;
        
        // ... (phần thực thi và trả về kết quả giữ nguyên) ...
        $result = $conn->query($sql);
        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $products[] = $row;
            }
        }
        return $products;
    }
    
    /**
     * Lấy tổng số sản phẩm khớp với điều kiện lọc (category_ids và keyword).
     */
    public function get_total_products($category_ids = [], $keyword = null) // <-- THÊM $keyword
    {
        $conn = self::$connection;
        if ($conn === null) return 0;
        
        $sql = "SELECT COUNT(DISTINCT p.id) AS total FROM products p ";
        $where = "WHERE 1=1 "; // Bắt đầu WHERE clause

        if (!empty($category_ids)) {
            // Lọc theo danh mục (Giữ nguyên)
            $id_string = implode(',', array_map('intval', $category_ids)); 
            $sql .= "JOIN category_product cp ON p.id = cp.product_id ";
            $where .= "AND cp.category_id IN ({$id_string}) "; 
        }

        if (!empty($keyword)) {
            // Lọc theo từ khóa tìm kiếm
            $escaped_keyword = $conn->real_escape_string($keyword);
            $where .= "AND (p.name LIKE '%{$escaped_keyword}%' OR p.description LIKE '%{$escaped_keyword}%') ";
        }
        
        $sql .= $where;
        
        // ... (phần thực thi và trả về kết quả giữ nguyên) ...
        $result = $conn->query($sql);
        if ($result) {
            return (int)$result->fetch_assoc()['total'];
        }
        return 0;
    }
}
?>