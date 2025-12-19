<?php
class ArticleTitles extends Db {
    
    // 1. Lấy danh sách kèm tìm kiếm, phân trang và tên bài viết gốc
    public function getArticleTitlesPage($page, $perPage, $keyword = "") {
        $firstLink = ($page - 1) * $perPage;
        $search = "%{$keyword}%";
        
        // Sử dụng JOIN để lấy post_name từ bảng posts
        $sql = self::$connection->prepare("SELECT a.*, p.title as post_name 
                                          FROM article_title a 
                                          JOIN posts p ON a.post_id = p.post_id 
                                          WHERE a.title LIKE ? 
                                          ORDER BY a.post_id DESC, a.article_title_id ASC 
                                          LIMIT ?, ?");
        $sql->bind_param("sii", $search, $firstLink, $perPage);
        $sql->execute();
        return $sql->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    // 2. Tính tổng số dòng (để phân trang)
    public function getTotal($keyword = "") {
        $search = "%{$keyword}%";
        $sql = self::$connection->prepare("SELECT COUNT(*) as total FROM article_title WHERE title LIKE ?");
        $sql->bind_param("s", $search);
        $sql->execute();
        return $sql->get_result()->fetch_assoc()['total'];
    }

    // 3. Lấy chi tiết một bản ghi bằng ID (để đổ dữ liệu vào form Sửa)
    public function getArticleTitleById($id) {
        $sql = self::$connection->prepare("SELECT * FROM article_title WHERE article_title_id = ?");
        $sql->bind_param("i", $id);
        $sql->execute();
        return $sql->get_result()->fetch_assoc();
    }

    // 4. Thêm mới mục lục
    public function add($title, $post_id, $content, $parent_id) {
        $sql = self::$connection->prepare("INSERT INTO article_title (title, post_id, content, parent_id) VALUES (?, ?, ?, ?)");
        // s: string, i: integer
        $sql->bind_param("sisi", $title, $post_id, $content, $parent_id);
        return $sql->execute();
    }

    // 5. Cập nhật mục lục
    public function update($id, $title, $post_id, $content, $parent_id) {
        $sql = self::$connection->prepare("UPDATE article_title SET title=?, post_id=?, content=?, parent_id=? WHERE article_title_id=?");
        $sql->bind_param("sisii", $title, $post_id, $content, $parent_id, $id);
        return $sql->execute();
    }

    // 6. Xóa mục lục
    public function delete($id) {
        $sql = self::$connection->prepare("DELETE FROM article_title WHERE article_title_id = ?");
        $sql->bind_param("i", $id);
        return $sql->execute();
    }
    // Lấy danh sách các mục cha (parent_id = 0) của một bài viết cụ thể
    public function getParentsByPost($post_id) {
        $sql = self::$connection->prepare("SELECT article_title_id, title FROM article_title WHERE post_id = ? AND parent_id = 0");
        $sql->bind_param("i", $post_id);
        $sql->execute();
        return $sql->get_result()->fetch_all(MYSQLI_ASSOC);
    }
}   