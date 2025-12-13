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
                    if (isset($categories[$parentId])) {
                        $categories[$parentId]['children'][] = &$categories[$row['id']];
                    }
                }
            }
        }
        return $parent_categories;
    }

    /**
     * Hàm đệ quy tĩnh để xuất danh mục con ra HTML
     */
    /**
     * Hàm đệ quy tĩnh để xuất danh mục con ra HTML có thể thu gọn
     */
    // TẠI FILE: models/categories.php (Bên trong Class Categories)

/**
 * Hàm đệ quy tĩnh để xuất danh mục con ra HTML có thể thu gọn
 *
 * @param array $categories Mảng danh mục
 */
public static function display_categories_html($categories) {
    if (empty($categories)) return;
    
    foreach ($categories as $cat) {
        $slug = !empty($cat['slug']) ? htmlspecialchars($cat['slug']) : '#';
        $link = "/category/" . $slug; 
        $has_children = !empty($cat['children']);
        
        // Tạo ID duy nhất cho phần tử con để liên kết với data-bs-target
        $target_id = 'cat-collapse-' . $cat['id']; 
        
        echo "<li>"; // Mở thẻ <li> cho mục hiện tại
        
        // --- 1. Thẻ <a> (Nút kích hoạt/Liên kết) ---
        $link_attributes = "href='$link'";
        $icon_html = '';
        
        if ($has_children) {
            // Nếu có con, thay đổi thành nút kích hoạt collapse (href='#')
            // data-bs-toggle='collapse' sẽ làm Bootstrap tự động thêm/bỏ aria-expanded
            $link_attributes = "href='#' 
                                data-bs-toggle='collapse' 
                                data-bs-target='#$target_id' 
                                aria-expanded='false'"; // Mặc định là false
            
            // Icon mũi tên xuống (sẽ xoay bằng CSS khi mở)
            $icon_html = " <i class='bi bi-chevron-right small collapse-icon'></i>"; 
        }
        
        // In thẻ <a>
        echo "<a {$link_attributes} title='Danh mục " . htmlspecialchars($cat['name']) . "'>";
        echo htmlspecialchars($cat['name']);
        echo $icon_html;
        echo "</a>";

        // --- 2. Khối <ul> con (Collapse Content) ---
        if ($has_children) {
            // Tạo <ul> con với class 'collapse' và id (KHÔNG DÙNG class 'category-list' ở đây)
            // Lần đầu tải trang, nó phải là 'collapse' để ẩn đi.
            echo "<ul class='collapse' id='{$target_id}'>"; 
            
            // Gọi đệ quy cho các danh mục con
            self::display_categories_html($cat['children']); 
            
            echo "</ul>";
        }

        echo "</li>"; // Đóng thẻ <li> cho mục hiện tại
    }
}
}
?>