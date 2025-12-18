<?php
// Bắt buộc phải có lớp Db (được định nghĩa trong file Db.php và chứa self::$connection)

class Categories extends Db
{
    public function __construct()
    {
        parent::__construct(); 
    }

    public function get_categories_hierarchical() {
        $conn = self::$connection;
        if ($conn === null) return [];
        
        $sql = "SELECT id, name, slug, parent_id FROM categories ORDER BY sort_order ASC, id ASC";
        $result = $conn->query($sql);

        $categories = []; 
        $parent_categories = []; 

        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $categories[$row['id']] = $row;
                $categories[$row['id']]['children'] = [];

                if ($row['parent_id'] === NULL) {
                    $parent_categories[$row['id']] = &$categories[$row['id']];
                } else {
                    $parentId = $row['parent_id'];
                    // Kiểm tra và gán cho danh mục cha nếu nó tồn tại
                    if (isset($categories[$parentId])) {
                        $categories[$parentId]['children'][] = &$categories[$row['id']];
                    }
                }
            }
        }
        return $parent_categories;
    }

    /**
     * Hàm đệ quy tĩnh để xuất danh mục con ra HTML có thể thu gọn
     *
     * @param array $categories Mảng danh mục
     */
    // FILE: categories.php (Chỉ phần hàm display_categories_html)

// ... (logic chuẩn bị $extraParams giữ nguyên) ...

    public static function display_categories_html($categories) {
        if (empty($categories)) return;
        
        $currentQuery = $_GET;
        unset($currentQuery['category_slug']);
        unset($currentQuery['page']);
        unset($currentQuery['sort']);
        unset($currentQuery['view']);
        
        $extraParams = http_build_query($currentQuery);
        if (!empty($extraParams)) {
            $extraParams = '&' . $extraParams;
        }

        foreach ($categories as $cat) {
            $slug = !empty($cat['slug']) ? htmlspecialchars($cat['slug']) : '#';
            
            // THAY ĐỔI: Thẻ <a> luôn là liên kết (khi click sẽ chuyển trang)
            $link = "?category_slug=" . $slug . $extraParams; 
            
            $has_children = !empty($cat['children']);
            $target_id = 'cat-collapse-' . $cat['id']; 
            
            echo "<li>"; 
            
            // --- 1. Thẻ <a> (Chỉ là Liên kết Lọc sản phẩm) ---
            echo "<a href='{$link}' title='Danh mục " . htmlspecialchars($cat['name']) . "'>";
            echo htmlspecialchars($cat['name']);

            // --- 2. Vùng kích hoạt Collapse (Nếu có con) ---
            if ($has_children) {
                // Đặt các thuộc tính collapse vào <span> chứa icon
                echo "<span 
                        class='collapse-toggle' 
                        data-bs-toggle='collapse' 
                        data-bs-target='#{$target_id}' 
                        aria-expanded='false'
                        style='cursor: pointer;'
                        >";
                
                // Icon mũi tên
                echo "<i class='bi bi-chevron-right small collapse-icon'></i>"; 
                echo "</span>";
            }
            
            echo "</a>"; // Đóng thẻ <a>

            // --- 3. Khối <ul> con (Collapse Content) ---
            if ($has_children) {
                echo "<ul class='collapse' id='{$target_id}'>"; 
                self::display_categories_html($cat['children']); 
                echo "</ul>";
            }

            echo "</li>"; 
        }
    }
    public static function displays_categories_html($categories) {
    if (empty($categories)) return;
    
    // Xử lý tham số URL để giữ lại các bộ lọc khác nếu có
    $currentQuery = $_GET;
    unset($currentQuery['category_slug'], $currentQuery['page'], $currentQuery['sort'], $currentQuery['view'], $currentQuery['id']);
    $extraParams = http_build_query($currentQuery);
    $extraParams = !empty($extraParams) ? '&' . $extraParams : '';

    foreach ($categories as $cat) {
        $slug = !empty($cat['slug']) ? htmlspecialchars($cat['slug']) : '#';
        $link = "product.php?category_slug=" . $slug . $extraParams; 
        $has_children = !empty($cat['children']);
        // Sử dụng cat_id làm ID cho collapse
        $cat_id = isset($cat['cat_id']) ? $cat['cat_id'] : rand();
        $target_id = 'cat-collapse-' . $cat_id; 

        echo "<li class='cat-item-container'>"; 
            echo "<div class='cat-item-content d-flex justify-content-between align-items-center'>";
                // Tên danh mục
                echo "<a href='{$link}' class='cat-link'>" . mb_strtoupper(htmlspecialchars($cat['name']), 'UTF-8') . "</a>";

                // Icon mũi tên bên phải nếu có con
                if ($has_children) {
                    echo "<span class='collapse-toggle' data-bs-toggle='collapse' data-bs-target='#{$target_id}' aria-expanded='false'>";
                    echo "<i class='bi bi-chevron-right'></i>"; 
                    echo "</span>";
                }
            echo "</div>";

            // Hiển thị danh mục con
            if ($has_children) {
                echo "<ul class='collapse list-unstyled ps-3' id='{$target_id}'>"; 
                self::displays_categories_html($cat['children']); 
                echo "</ul>";
            }
        echo "</li>"; 
    }
}
    /**
 * Lấy ID của tất cả danh mục con của một danh mục cha.
 *
 * @param int $parentId ID danh mục cha.
 * @return array Mảng chứa ID của danh mục cha và tất cả danh mục con.
 */
public function get_child_ids($parentId) {
    $conn = self::$connection;
    if ($conn === null) return [$parentId]; // Trả về chính nó nếu không có kết nối

    // Đệ quy để lấy tất cả ID con
    $ids = [$parentId];
    $queue = [$parentId];

    while (!empty($queue)) {
        $currentId = array_shift($queue);
        
        $stmt = $conn->prepare("SELECT id FROM categories WHERE parent_id = ?");
        $stmt->bind_param("i", $currentId);
        $stmt->execute();
        $result = $stmt->get_result();

        while ($row = $result->fetch_assoc()) {
            $childId = $row['id'];
            if (!in_array($childId, $ids)) {
                $ids[] = $childId;
                $queue[] = $childId; // Thêm vào hàng đợi để tiếp tục tìm con
            }
        }
        $stmt->close();
    }
    return $ids;
}

/**
 * Lấy thông tin chi tiết của một danh mục dựa trên slug.
 *
 * @param string $slug Slug của danh mục.
 * @return array|null Thông tin danh mục hoặc null.
 */
public function get_category_by_slug($slug) {
    $conn = self::$connection;
    if ($conn === null) return null;

    $stmt = $conn->prepare("SELECT id, name, slug, parent_id, description, image_url FROM categories WHERE slug = ? LIMIT 1");
    $stmt->bind_param("s", $slug);
    $stmt->execute();
    $result = $stmt->get_result();

    return $result->fetch_assoc();
}

/**
 * Lấy thông tin chi tiết của danh mục cha dựa trên ID.
 */
public function get_category_by_id($id) {
    $conn = self::$connection;
    if ($conn === null) return null;

    $stmt = $conn->prepare("SELECT id, name, slug, parent_id, description, image_url FROM categories WHERE id = ? LIMIT 1");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    return $result->fetch_assoc();
}
/**
 * Lấy các danh mục con trực tiếp của một ID danh mục cha.
 *
 * @param int $parentId ID danh mục cha.
 * @return array Danh sách danh mục con.
 */
public function get_direct_children($parentId) {
    $conn = self::$connection;
    if ($conn === null) return [];

    $stmt = $conn->prepare("SELECT id, name, slug FROM categories WHERE parent_id = ? ORDER BY sort_order ASC, id ASC");
    $stmt->bind_param("i", $parentId);
    $stmt->execute();
    $result = $stmt->get_result();

    return $result->fetch_all(MYSQLI_ASSOC);
}
/**
 * Lấy thông tin một danh mục dựa trên tên của nó.
 *
 * @param string $name Tên danh mục cần tìm.
 * @return array|null Mảng thông tin danh mục hoặc null nếu không tìm thấy.
 */
// FILE: models/categories.php (Bổ sung vào Class Categories)

/**
 * Lấy thông tin một danh mục dựa trên tên của nó.
 *
 * @param string $name Tên danh mục cần tìm.
 * @return array|null Mảng thông tin danh mục hoặc null nếu không tìm thấy.
 */
public function get_category_by_name($name) {
    $conn = self::$connection;
    if ($conn === null) return null;

    // Sử dụng Prepared Statement
    $stmt = $conn->prepare("SELECT id, name, slug, parent_id, description, image_url FROM categories WHERE name = ? LIMIT 1");
    
    // Kiểm tra nếu prepare thành công
    if ($stmt === false) {
        // Có thể thêm logging lỗi kết nối/chuẩn bị tại đây
        return null;
    }
    
    // Bind tham số
    $stmt->bind_param("s", $name);
    
    // Thực thi
    $stmt->execute();
    
    // Lấy kết quả
    $result = $stmt->get_result();
    
    // Lấy hàng đầu tiên
    $category = $result->fetch_assoc();
    
    $stmt->close();

    return $category;
}
// FILE: models/product.php (Sử dụng Prepared Statements an toàn)

/**
 * Lấy danh sách sản phẩm thuộc một mảng các ID danh mục.
 *
 * @param array $categoryIds Mảng chứa các ID danh mục.
 * @return array Danh sách sản phẩm.
 */
public function get_products_by_category_ids(array $categoryIds) {
    $conn = self::$connection;
    if ($conn === null || empty($categoryIds)) return [];

    // 1. Tạo chuỗi placeholders cho IN clause (ví dụ: ?, ?, ?)
    $placeholders = implode(',', array_fill(0, count($categoryIds), '?'));
    
    // 2. Định nghĩa câu truy vấn: SỬ DỤNG CÂU TRUY VẤN MẢNG ID
    $sql = "
        SELECT DISTINCT p.* FROM products p
        INNER JOIN category_product cp ON p.id = cp.product_id
        WHERE cp.category_id IN ($placeholders)
        ORDER BY p.id DESC
    ";

    $stmt = $conn->prepare($sql);
    
    // ... (Phần bind_param và thực thi tương tự như phản hồi trước) ...
    // [Đây là đoạn code phức tạp nhất cho Prepared Statements với IN clause]
    
    if ($stmt === false) { return []; }

    // Logic Bind param cho IN clause:
    $types = str_repeat('i', count($categoryIds));
    $params = array_merge([$types], $categoryIds); 
    $refs = [];
    foreach ($params as $key => $value) { $refs[$key] = &$params[$key]; }
    call_user_func_array([$stmt, 'bind_param'], $refs);

    // Thực thi và lấy kết quả
    $stmt->execute();
    $result = $stmt->get_result();
    $products = $result->fetch_all(MYSQLI_ASSOC);

    $stmt->close();
    return $products;
}
}
?>