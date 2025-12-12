<?php
// Giả sử class Db đã được include và kết nối CSDL thành công

class Blog extends Db{
    // --- 1. LẤY TẤT CẢ DANH MỤC BLOG (Cho thanh điều hướng) ---
    public function getAllCategories() {
        $sql = self::$connection->prepare("SELECT cat_id, name, slug FROM categories_post ORDER BY sort_order ASC");
        $sql->execute();
        return $sql->get_result()->fetch_all(MYSQLI_ASSOC);
    }
    
    // --- 2. LẤY TỔNG SỐ BÀI VIẾT (Cho phân trang) ---
    public function getTotalPosts($cat_id = null) {
        $sql_parts = "SELECT COUNT(DISTINCT p.post_id) AS total FROM posts p ";
        
        if ($cat_id !== null) {
            $sql_parts .= "JOIN post_categories pc ON p.post_id = pc.post_id WHERE pc.cat_id = ?";
            $sql = self::$connection->prepare($sql_parts);
            $sql->bind_param("i", $cat_id);
        } else {
            $sql = self::$connection->prepare($sql_parts);
        }
        
        $sql->execute();
        return $sql->get_result()->fetch_assoc()['total'];
    }

    // --- 3. LẤY BÀI VIẾT VÀ DANH MỤC LIÊN KẾT (Cho trang chính) ---
    // Sắp xếp bài viết theo created_at (ngày tạo)
   // Trong models/Blog.php
public function getPostsByPage($page, $perPage = 9, $cat_id = null) {
    // 1. Tính toán OFFSET
    $offset = ($page - 1) * $perPage;
    
    // 2. Lấy POST IDs cho trang hiện tại
    // Sử dụng SELECT p.post_id để đảm bảo tính duy nhất
    $id_sql = "SELECT DISTINCT p.post_id 
               FROM posts p
               LEFT JOIN post_categories pc ON p.post_id = pc.post_id ";
    
    $params = [];
    $types = "";

    if ($cat_id !== null) {
        $id_sql .= "WHERE pc.cat_id = ? ";
        // Tham số thứ 1 (cho cat_id)
        $params[] = $cat_id;
        $types .= "i";
    }
    
    // Thêm LIMIT và OFFSET vào cuối
    $id_sql .= "ORDER BY p.created_at DESC LIMIT ? OFFSET ?"; 
    
    // Tham số thứ 2 (cho LIMIT) và thứ 3 (cho OFFSET)
    $params[] = $perPage;
    $params[] = $offset;
    $types .= "ii";
    
    $stmt_id = self::$connection->prepare($id_sql);
    // Lưu ý: Cú pháp bind_param yêu cầu kiểu dữ liệu (types) đi trước các tham số
    $stmt_id->bind_param($types, ...$params); 
    $stmt_id->execute();
    $post_ids_raw = $stmt_id->get_result()->fetch_all(MYSQLI_ASSOC);
    
    if (empty($post_ids_raw)) {
        return [];
    }

    // Chuyển kết quả sang chuỗi ID: (1, 2, 3...)
    $post_ids = array_map(function($item) { return $item['post_id']; }, $post_ids_raw);
    // Dùng chuỗi IN, không thể dùng bind_param cho IN (MySQLi limit)
    $id_list = implode(',', $post_ids); 
    
    // 3. Lấy chi tiết bài viết và danh mục liên quan
    $detail_sql = "SELECT p.*, c.name AS cat_name, c.slug AS cat_slug 
                   FROM posts p
                   LEFT JOIN post_categories pc ON p.post_id = pc.post_id
                   LEFT JOIN categories_post c ON pc.cat_id = c.cat_id
                   WHERE p.post_id IN ($id_list)
                   ORDER BY p.created_at DESC, p.post_id DESC";
    
    $stmt_detail = self::$connection->prepare($detail_sql);
    $stmt_detail->execute();
    $results = $stmt_detail->get_result()->fetch_all(MYSQLI_ASSOC);
    
    // 4. Gộp các danh mục vào chung một bài viết
    $formatted_posts = [];
    foreach ($results as $row) {
        $post_id = $row['post_id'];
        
        // Khởi tạo bài viết nếu chưa tồn tại
        if (!isset($formatted_posts[$post_id])) {
            $formatted_posts[$post_id] = [
                'post_id' => $row['post_id'],
                'title' => $row['title'],
                'slug' => $row['slug'],
                'image' => $row['image'],
                'summary' => $row['summary'],
                'author' => $row['author'],
                'created_at' => $row['created_at'],
                'categories' => [] // Khởi tạo mảng danh mục
            ];
        }
        
        // Thêm danh mục vào bài viết
        if ($row['cat_name']) {
            $formatted_posts[$post_id]['categories'][] = [
                'name' => $row['cat_name'],
                'slug' => $row['cat_slug']
            ];
        }
    }

    // Trả về mảng các bài viết đã được định dạng
    return array_values($formatted_posts);
}
}
?>