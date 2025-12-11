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
    public function getAllProduct()
    {
        $conn = self::$connection;
        if ($conn === null) return [];

        // Sử dụng Prepared Statement (tốt cho bảo mật, dù không có tham số bên ngoài)
        $sql = $conn->prepare("SELECT * FROM products");
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
public function get_products($category_slug = null, $page = 1, $products_per_page = 12)
    {
        $conn = self::$connection;
        if ($conn === null) return [];
        
        $page = max(1, (int)$page); 
        $offset = ($page - 1) * $products_per_page;
        
        $products = [];
        $sql = "SELECT p.* FROM products p ";
        $where = "";

        if ($category_slug) {
            $sql .= "JOIN category_product cp ON p.id = cp.product_id
                     JOIN categories c ON cp.category_id = c.id ";
            
            $escaped_slug = $conn->real_escape_string($category_slug);
            $where .= "WHERE c.slug = '{$escaped_slug}'"; 
        }
        
        $sql .= $where . " ORDER BY p.id DESC LIMIT " . (int)$products_per_page . " OFFSET " . $offset;

        $result = $conn->query($sql);

        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $products[] = $row;
            }
        }
        return $products;
    }
    
    /**
     * Lấy tổng số sản phẩm khớp với điều kiện lọc.
     */
    public function get_total_products($category_slug = null)
    {
        $conn = self::$connection;
        if ($conn === null) return 0;
        
        $sql = "SELECT COUNT(p.id) AS total FROM products p ";
        $where = "";

        if ($category_slug) {
            $sql .= "JOIN category_product cp ON p.id = cp.product_id
                     JOIN categories c ON cp.category_id = c.id ";
            
            $escaped_slug = $conn->real_escape_string($category_slug);
            $where .= "WHERE c.slug = '{$escaped_slug}'"; 
        }
        
        $sql .= $where;
        
        $result = $conn->query($sql);
        
        if ($result) {
            return (int)$result->fetch_assoc()['total'];
        }
        return 0;
    }

    
}
?>