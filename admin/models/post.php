<?php
class Posts extends Db {
    // 1. Lấy danh sách bài viết kèm danh mục (Phân trang + Tìm kiếm)
    public function getPostsPage($page, $perPage, $keyword = "") {
        $firstLink = ($page - 1) * $perPage;
        $search = "%{$keyword}%";
        $sql = self::$connection->prepare("SELECT p.*, GROUP_CONCAT(c.name SEPARATOR ', ') as category_names 
                                          FROM posts p 
                                          LEFT JOIN post_categories pc ON p.post_id = pc.post_id 
                                          LEFT JOIN categories_post c ON pc.cat_id = c.cat_id 
                                          WHERE p.title LIKE ? 
                                          GROUP BY p.post_id 
                                          ORDER BY p.created_at DESC 
                                          LIMIT ?, ?");
        $sql->bind_param("sii", $search, $firstLink, $perPage);
        $sql->execute();
        return $sql->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    public function getTotal($keyword = "") {
        $search = "%{$keyword}%";
        $sql = self::$connection->prepare("SELECT COUNT(*) as total FROM posts WHERE title LIKE ?");
        $sql->bind_param("s", $search);
        $sql->execute();
        return $sql->get_result()->fetch_assoc()['total'];
    }

    // 2. Thêm bài viết mới và các danh mục liên quan
    public function add($title, $slug, $image, $summary, $content, $author, $cat_ids) {
        $sql = self::$connection->prepare("INSERT INTO posts (title, slug, image, summary, content, author) VALUES (?, ?, ?, ?, ?, ?)");
        $sql->bind_param("ssssss", $title, $slug, $image, $summary, $content, $author);
        if ($sql->execute()) {
            $post_id = self::$connection->insert_id;
            $this->updatePostCategories($post_id, $cat_ids);
            return true;
        }
        return false;
    }

    // 3. Hàm phụ cập nhật bảng trung gian post_categories
    private function updatePostCategories($post_id, $cat_ids) {
        // Xóa danh mục cũ
        $del = self::$connection->prepare("DELETE FROM post_categories WHERE post_id = ?");
        $del->bind_param("i", $post_id);
        $del->execute();
        // Thêm danh mục mới
        foreach ($cat_ids as $cat_id) {
            $ins = self::$connection->prepare("INSERT INTO post_categories (post_id, cat_id) VALUES (?, ?)");
            $ins->bind_param("ii", $post_id, $cat_id);
            $ins->execute();
        }
    }

    public function delete($id) {
        $sql = self::$connection->prepare("DELETE FROM posts WHERE post_id = ?");
        $sql->bind_param("i", $id);
        return $sql->execute();
    }
    // Lấy chi tiết 1 bài viết kèm danh sách ID các danh mục đã chọn
    public function getById($id) {
        $sql = self::$connection->prepare("SELECT p.*, GROUP_CONCAT(pc.cat_id) as selected_cats 
                                          FROM posts p 
                                          LEFT JOIN post_categories pc ON p.post_id = pc.post_id 
                                          WHERE p.post_id = ? 
                                          GROUP BY p.post_id");
        $sql->bind_param("i", $id);
        $sql->execute();
        return $sql->get_result()->fetch_assoc();
    }

    // Cập nhật bài viết
    public function update($id, $title, $slug, $image, $summary, $content, $author, $cat_ids) {
        $sql = self::$connection->prepare("UPDATE posts SET title=?, slug=?, image=?, summary=?, content=?, author=? WHERE post_id=?");
        $sql->bind_param("ssssssi", $title, $slug, $image, $summary, $content, $author, $id);
        
        if ($sql->execute()) {
            // Cập nhật lại bảng trung gian post_categories
            $this->updatePostCategories($id, $cat_ids);
            return true;
        }
        return false;
    }
}