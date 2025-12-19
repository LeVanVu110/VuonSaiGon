<?php
class Categories extends Db {
    // 1. Lấy danh mục có phân trang và tìm kiếm
    public function getCategoriesPage($page, $perPage, $keyword = "") {
        $firstLink = ($page - 1) * $perPage;
        $search = "%{$keyword}%";
        
        $sql = self::$connection->prepare("SELECT c1.*, c2.name as parent_name 
                                          FROM categories c1 
                                          LEFT JOIN categories c2 ON c1.parent_id = c2.id 
                                          WHERE c1.name LIKE ? 
                                          ORDER BY COALESCE(c1.parent_id, c1.id), c1.parent_id IS NOT NULL
                                          LIMIT ?, ?");
        $sql->bind_param("sii", $search, $firstLink, $perPage);
        $sql->execute();
        return $sql->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    // 2. Tính tổng số danh mục (để chia trang) theo từ khóa
    public function getTotalCategories($keyword = "") {
        $search = "%{$keyword}%";
        $sql = self::$connection->prepare("SELECT COUNT(*) as total FROM categories WHERE name LIKE ?");
        $sql->bind_param("s", $search);
        $sql->execute();
        $result = $sql->get_result()->fetch_assoc();
        return $result['total'];
    }

    // 3. Lấy danh mục cha (giữ nguyên để dùng cho Form)
    public function getParentCategories() {
        $sql = self::$connection->prepare("SELECT * FROM categories WHERE parent_id IS NULL");
        $sql->execute();
        return $sql->get_result()->fetch_all(MYSQLI_ASSOC);
    }
    // Lấy thông tin 1 danh mục theo ID
    public function getCategoryById($id) {
        $sql = self::$connection->prepare("SELECT * FROM categories WHERE id = ?");
        $sql->bind_param("i", $id);
        $sql->execute();
        return $sql->get_result()->fetch_assoc();
    }

    // Thêm danh mục mới
    public function addCategory($name, $slug, $parent_id, $sort_order, $description, $image_url) {
        $sql = self::$connection->prepare("INSERT INTO categories (name, slug, parent_id, sort_order, description, image_url) VALUES (?, ?, ?, ?, ?, ?)");
        $parent_id = ($parent_id == 0) ? NULL : $parent_id; // Chuyển 0 thành NULL cho khóa ngoại
        $sql->bind_param("ssiiss", $name, $slug, $parent_id, $sort_order, $description, $image_url);
        return $sql->execute();
    }

    // Cập nhật danh mục
    public function updateCategory($id, $name, $slug, $parent_id, $sort_order, $description, $image_url) {
        $sql = self::$connection->prepare("UPDATE categories SET name=?, slug=?, parent_id=?, sort_order=?, description=?, image_url=? WHERE id=?");
        $parent_id = ($parent_id == 0) ? NULL : $parent_id;
        $sql->bind_param("ssiissi", $name, $slug, $parent_id, $sort_order, $description, $image_url, $id);
        return $sql->execute();
    }

    // Xóa danh mục
    public function deleteCategory($id) {
        $sql = self::$connection->prepare("DELETE FROM categories WHERE id = ?");
        $sql->bind_param("i", $id);
        return $sql->execute();
    }
}