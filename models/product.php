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
    // FILE: product.php (Thêm vào class Product)

    // FILE: product.php (Hàm được sửa)

    public static function parse_description_with_images($description) {
        if (empty($description)) {
            return '';
        }
        
        // 1. CHUYỂN src="..." thành thẻ <img> được bọc trong div (để căn giữa)
        $pattern = '/src="([^"]+)"/i';
        
        $html_content = preg_replace_callback($pattern, function($matches) {
            $image_url = $matches[1]; 
            
            // Bọc ảnh trong div.text-center và img-fluid để responsive và căn giữa
            return '<div class="image-wrapper text-center my-4">
                        <img src="' . htmlspecialchars($image_url) . '" class="img-fluid description-image" alt="Mô tả sản phẩm">
                    </div>';
        }, $description);

        // 2. Định dạng các tiêu đề có đánh số (ví dụ: "1. Vỏ trấu & bã mía...") thành thẻ <h4>
        // Biểu thức chính quy: tìm kiếm [số].[khoảng trắng][Chữ cái hoa] (hoặc chữ cái thường)
        $html_content = preg_replace('/(\d+\.\s+[A-ZÀÁÂÃÈÉÊÌÍÒÓÔÕÙÚŨÝĐ].*)/u', '<h4 class="description-title mt-4 mb-2">$1</h4>', $html_content);
        
        // 3. Chuyển đổi các ký tự xuống dòng thành thẻ <br>
        $html_content = nl2br($html_content);
        
        // 4. Loại bỏ các thẻ <br> ngay sau các thẻ tiêu đề <h4> (do nl2br tạo ra)
        $html_content = str_replace("</h4><br />", "</h4>", $html_content);

        // 5. Bọc toàn bộ nội dung trong thẻ <p> nếu chưa có
        // (Đây là bước phức tạp, thường nên xử lý ở database hoặc thủ công. Tạm thời bỏ qua bước này để tránh lỗi định dạng).
        
        return $html_content;
    }
        // FILE: product.php (Thêm vào class Product)

    /**
     * Lấy thông tin chi tiết của một sản phẩm dựa trên ID.
     *
     * @param int $id ID của sản phẩm.
     * @return array|null Thông tin sản phẩm hoặc null.
     */
    public function get_product_by_id($id) {
        $conn = self::$connection;
        if ($conn === null) return null;

        $stmt = $conn->prepare("SELECT * FROM products WHERE id = ? LIMIT 1");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_assoc();
    }
    // FILE: product.php (Hàm được sửa)

    /**
     * Lấy TẤT CẢ thông số kỹ thuật (spec_key, spec_value) của một sản phẩm.
     *
     * @param int $productId ID của sản phẩm.
     * @return array Mảng các hàng thông số kỹ thuật.
     */
    public function get_product_specs_by_id($productId) {
        $conn = self::$connection;
        if ($conn === null) return []; // Trả về mảng rỗng nếu lỗi kết nối

        // Truy vấn tất cả các hàng thông số liên quan đến product_id
        // Sắp xếp theo sort_order (nếu cột này tồn tại)
        $stmt = $conn->prepare("SELECT spec_key, spec_value 
                                FROM product_specs 
                                WHERE product_id = ? 
                                ORDER BY sort_order ASC"); 
        $stmt->bind_param("i", $productId);
        $stmt->execute();
        $result = $stmt->get_result();

        // Trả về TẤT CẢ các hàng dưới dạng mảng kết hợp
        return $result->fetch_all(MYSQLI_ASSOC); 
    }
    // FILE: product.php (Thêm vào class Product)

    /**
     * Lấy danh sách sản phẩm liên quan (cùng danh mục, loại trừ ID hiện tại).
     *
     * @param int $categoryId ID của danh mục sản phẩm.
     * @param int $currentProductId ID của sản phẩm đang xem (để loại trừ).
     * @param int $limit Số lượng sản phẩm cần lấy (mặc định 5).
     * @return array Danh sách sản phẩm liên quan.
     */
    // FILE: product.php (Hàm được sửa)

/**
 * Lấy danh sách sản phẩm liên quan (cùng danh mục, loại trừ ID hiện tại)
 * qua bảng trung gian category_product.
 *
 * @param int $currentProductId ID của sản phẩm đang xem.
 * @param int $limit Số lượng sản phẩm cần lấy (mặc định 5).
 * @return array Danh sách sản phẩm liên quan.
 */
    public function get_related_products($currentProductId, $limit = 5) {
        $conn = self::$connection;
        if ($conn === null) return [];

        // Lấy các category_id của sản phẩm hiện tại
        $sql_category_ids = "SELECT category_id FROM category_product WHERE product_id = ?";
        $stmt_cat = $conn->prepare($sql_category_ids);
        $stmt_cat->bind_param("i", $currentProductId);
        $stmt_cat->execute();
        $cat_result = $stmt_cat->get_result();
        $category_ids = $cat_result->fetch_all(MYSQLI_ASSOC);
        
        if (empty($category_ids)) {
            return []; // Không có danh mục nào được liên kết, không có sản phẩm liên quan
        }

        // Chuyển mảng kết quả thành chuỗi ID để sử dụng trong mệnh đề IN
        $category_id_list = implode(',', array_column($category_ids, 'category_id'));

        // Truy vấn sản phẩm liên quan:
        // 1. JOIN qua category_product
        // 2. Lọc theo các Category ID vừa lấy được
        // 3. Loại trừ sản phẩm đang xem
        // 4. GROUP BY p.id để tránh trùng lặp nếu sản phẩm có nhiều danh mục chung
        $sql = "SELECT p.* FROM products p 
                JOIN category_product cp ON p.id = cp.product_id 
                WHERE cp.category_id IN ($category_id_list) 
                    AND p.id != ? 
                GROUP BY p.id
                ORDER BY RAND() 
                LIMIT ?";
        
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ii", $currentProductId, $limit); 
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }
    // FILE: models/product.php (Bổ sung vào Class Product)

/**
 * Lấy danh sách sản phẩm thuộc một mảng các ID danh mục (sử dụng bảng category_product).
 *
 * @param array $categoryIds Mảng chứa các ID danh mục (bao gồm cả cha và con).
 * @return array Danh sách sản phẩm.
 */
public function get_products_by_category_ids(array $categoryIds) {
    $conn = self::$connection;
    if ($conn === null || empty($categoryIds)) return [];

    // 1. Tạo chuỗi placeholders cho IN clause (ví dụ: ?, ?, ?)
    $placeholders = implode(',', array_fill(0, count($categoryIds), '?'));
    
    // 2. Định nghĩa câu truy vấn: JOIN products với category_product
    $sql = "
        SELECT DISTINCT p.* FROM products p
        INNER JOIN category_product cp ON p.id = cp.product_id
        WHERE cp.category_id IN ($placeholders)
        ORDER BY p.id DESC
    ";

    $stmt = $conn->prepare($sql);
    
    if ($stmt === false) {
        // Ghi log lỗi nếu cần
        return [];
    }

    // 3. Bind tham số (chủ yếu là mảng ID danh mục)
    // Cần tạo chuỗi types: 'i' cho mỗi ID (ví dụ: 'iiii')
    $types = str_repeat('i', count($categoryIds));
    
    // Cần tạo mảng tham chiếu cho bind_param
    $params = array_merge([$types], $categoryIds); 
    
    // Gọi bind_param với các tham chiếu (sử dụng call_user_func_array)
    // Chuyển mảng tham số (types + values) thành tham chiếu
    $refs = [];
    foreach ($params as $key => $value) {
        $refs[$key] = &$params[$key];
    }

    call_user_func_array([$stmt, 'bind_param'], $refs);

    // 4. Thực thi và lấy kết quả
    $stmt->execute();
    $result = $stmt->get_result();
    $products = $result->fetch_all(MYSQLI_ASSOC);

    $stmt->close();
    return $products;
}
public function getTotalProducts($keyword) {
        $sql_parts = "SELECT COUNT(id) AS total FROM products WHERE name LIKE ? OR description LIKE ?";
        $sql = self::$connection->prepare($sql_parts);
        $search_keyword = "%" . $keyword . "%";
        $sql->bind_param("ss", $search_keyword, $search_keyword);
        
        $sql->execute();
        return $sql->get_result()->fetch_assoc()['total'];
    }

    // Lấy SẢN PHẨM theo từ khóa và phân trang
    public function getProductsByPage($keyword, $page, $perPage = 9) {
        $offset = ($page - 1) * $perPage;
        
        $sql = "SELECT id, name, price, discount_price, image_url, state, is_sale 
                FROM products 
                WHERE name LIKE ? OR description LIKE ?
                ORDER BY id DESC LIMIT ? OFFSET ?";
        
        $stmt = self::$connection->prepare($sql);
        $search_keyword = "%" . $keyword . "%";
        
        $stmt->bind_param("ssii", $search_keyword, $search_keyword, $perPage, $offset); 
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }
    

    // (Lưu ý: Nếu bạn muốn dùng slug, bạn cần tạo thêm hàm get_product_by_slug)
}

?>