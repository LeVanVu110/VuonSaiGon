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
    public static function display_categories_html($categories, $is_child = false) {
        if (empty($categories)) return;
        
        // Cấp cha (root) sẽ có class category-list. Cấp con sẽ không cần class này.
        // Cấp con (is_child = true) cũng không cần thẻ <ul> nếu nó được gọi từ bên ngoài 
        // Nhưng vì nó là đệ quy, ta vẫn cần <ul>
        $ul_classes = $is_child ? 'collapse' : 'category-list';
        
        // Nếu đây là lần gọi đệ quy (là danh mục con), ta cần thêm class 'collapse' và id cho nó
        // ID được tạo từ parent_id của phần tử con đầu tiên, nhưng cách đơn giản nhất là 
        // tạo ID duy nhất cho mỗi <ul>
        
        // Vì đây là hàm đệ quy, ta sẽ chỉ tạo <ul> với class 'collapse' cho cấp con (nếu không phải là cấp root)
        
        foreach ($categories as $cat) {
            $slug = !empty($cat['slug']) ? htmlspecialchars($cat['slug']) : '#';
            $link = "/category/" . $slug; 
            $has_children = !empty($cat['children']);
            
            // Tạo ID duy nhất cho phần tử con để liên kết với data-bs-target
            $target_id = 'cat-collapse-' . $cat['id']; 
            
            echo "<li>";
            
            // 1. Thay đổi thẻ <a> để có thể collapse nếu có con
            $link_attributes = "href='$link'";
            $icon_classes = 'bi bi-chevron-right small';
            
            if ($has_children) {
                // Thay đổi hành vi: dùng data-bs-toggle và data-bs-target để mở/đóng
                // Và giữ href="#" để không chuyển trang ngay lập tức
                $link_attributes = "href='#' data-bs-toggle='collapse' data-bs-target='#$target_id' aria-expanded='false'";
                $icon_classes = 'bi bi-chevron-down small collapse-icon'; // Dùng icon mũi tên xuống cho cấp cha
            }
            
            echo "<a {$link_attributes} title='Danh mục " . htmlspecialchars($cat['name']) . "'>";
            echo htmlspecialchars($cat['name']);
            
            if ($has_children) {
                 // Dùng icon mũi tên xuống và thêm CSS transition
                 echo " <i class='{$icon_classes}'></i>";
            }
            echo "</a>";

            // 2. Thêm logic Collapse cho danh mục con
            if ($has_children) {
                // Khối danh mục con, mặc định ẩn (collapse)
                echo "<ul class='category-list collapse' id='{$target_id}'>";
                self::display_categories_html($cat['children'], true); // Gọi đệ quy cho danh mục con
                echo "</ul>";
            }

            echo "</li>";
        }
        
        // KHÔNG CẦN DÙNG echo "<ul>" và echo "</ul>" ở đây nữa, 
        // vì chúng ta đã di chuyển việc tạo <ul>/</ul> vào trong vòng lặp đệ quy nếu cần thiết 
        // hoặc giả định rằng <ul> ngoài cùng sẽ được tạo ở file HTML chính.
        
        // Tuy nhiên, theo cấu trúc cũ của bạn (trong categories.php):
        /*
        public static function display_categories_html($categories) {
            if (empty($categories)) return;
            echo "<ul class='category-list'>"; // <--- DÒNG NÀY SẼ GÂY VẤN ĐỀ
            // ...
            echo "</ul>"; // <--- DÒNG NÀY SẼ GÂY VẤN ĐỀ
        }
        */
        
        // Để giữ tính năng đệ quy, chúng ta phải giữ <ul>/</ul>
        // -> Sửa lại cấu trúc của hàm như sau (phiên bản đầy đủ, dựa trên code gốc của bạn):
    }
}
?>