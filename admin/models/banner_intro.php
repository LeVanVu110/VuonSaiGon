<?php
class BannerIntro extends Db {
    // Lấy danh sách có phân trang và tìm kiếm
    public function getBannerIntroPage($page, $perPage, $keyword = "") {
        $firstLink = ($page - 1) * $perPage;
        $search = "%{$keyword}%";
        $sql = self::$connection->prepare("SELECT * FROM banner_introduct WHERE image LIKE ? LIMIT ?, ?");
        $sql->bind_param("sii", $search, $firstLink, $perPage);
        $sql->execute();
        return $sql->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    public function getTotal($keyword = "") {
        $search = "%{$keyword}%";
        $sql = self::$connection->prepare("SELECT COUNT(*) as total FROM banner_introduct WHERE image LIKE ?");
        $sql->bind_param("s", $search);
        $sql->execute();
        return $sql->get_result()->fetch_assoc()['total'];
    }

    public function add($image, $is_view) {
        $sql = self::$connection->prepare("INSERT INTO banner_introduct (image, is_view) VALUES (?, ?)");
        $sql->bind_param("si", $image, $is_view);
        return $sql->execute();
    }

    public function update($id, $image, $is_view) {
        $sql = self::$connection->prepare("UPDATE banner_introduct SET image = ?, is_view = ? WHERE banner_id = ?");
        $sql->bind_param("sii", $image, $is_view, $id);
        return $sql->execute();
    }

    public function delete($id) {
        $sql = self::$connection->prepare("DELETE FROM banner_introduct WHERE banner_id = ?");
        $sql->bind_param("i", $id);
        return $sql->execute();
    }
}