<?php
class CategoryPost extends Db {
    // Lấy danh sách có phân trang và tìm kiếm
    public function getCategoriesPage($page, $perPage, $keyword = "") {
        $firstLink = ($page - 1) * $perPage;
        $search = "%{$keyword}%";
        $sql = self::$connection->prepare("SELECT * FROM categories_post WHERE name LIKE ? OR slug LIKE ? ORDER BY sort_order ASC LIMIT ?, ?");
        $sql->bind_param("ssii", $search, $search, $firstLink, $perPage);
        $sql->execute();
        return $sql->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    // Tính tổng số danh mục bài viết
    public function getTotal($keyword = "") {
        $search = "%{$keyword}%";
        $sql = self::$connection->prepare("SELECT COUNT(*) as total FROM categories_post WHERE name LIKE ? OR slug LIKE ?");
        $sql->bind_param("ss", $search, $search);
        $sql->execute();
        return $sql->get_result()->fetch_assoc()['total'];
    }

    public function getById($id) {
        $sql = self::$connection->prepare("SELECT * FROM categories_post WHERE cat_id = ?");
        $sql->bind_param("i", $id);
        $sql->execute();
        return $sql->get_result()->fetch_assoc();
    }

    public function add($name, $slug, $sort_order) {
        $sql = self::$connection->prepare("INSERT INTO categories_post (name, slug, sort_order) VALUES (?, ?, ?)");
        $sql->bind_param("ssi", $name, $slug, $sort_order);
        return $sql->execute();
    }

    public function update($id, $name, $slug, $sort_order) {
        $sql = self::$connection->prepare("UPDATE categories_post SET name = ?, slug = ?, sort_order = ? WHERE cat_id = ?");
        $sql->bind_param("ssii", $name, $slug, $sort_order, $id);
        return $sql->execute();
    }

    public function delete($id) {
        $sql = self::$connection->prepare("DELETE FROM categories_post WHERE cat_id = ?");
        $sql->bind_param("i", $id);
        return $sql->execute();
    }
}