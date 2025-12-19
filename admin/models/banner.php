<?php
class Banners extends Db {
    // Lấy tất cả banner
    public function getAllBanners() {
        $sql = self::$connection->prepare("SELECT * FROM banner");
        $sql->execute();
        return $sql->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    // Lấy 1 banner theo ID
    public function getBannerById($id) {
        $sql = self::$connection->prepare("SELECT * FROM banner WHERE banner_id = ?");
        $sql->bind_param("i", $id);
        $sql->execute();
        return $sql->get_result()->fetch_assoc();
    }

    // Thêm banner mới
    public function addBanner($image_url) {
        $sql = self::$connection->prepare("INSERT INTO banner (image) VALUES (?)");
        $sql->bind_param("s", $image_url);
        return $sql->execute();
    }

    // Cập nhật banner
    public function updateBanner($id, $image_url) {
        $sql = self::$connection->prepare("UPDATE banner SET image = ? WHERE banner_id = ?");
        $sql->bind_param("si", $image_url, $id);
        return $sql->execute();
    }

    // Xóa banner
    public function deleteBanner($id) {
        $sql = self::$connection->prepare("DELETE FROM banner WHERE banner_id = ?");
        $sql->bind_param("i", $id);
        return $sql->execute();
    }
    public function getBannersPage($page, $perPage) {
        $firstLink = ($page - 1) * $perPage;
        $sql = self::$connection->prepare("SELECT * FROM banner LIMIT ?, ?");
        $sql->bind_param("ii", $firstLink, $perPage);
        $sql->execute();
        return $sql->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    // 2. Tính tổng số lượng banner
    public function getTotalBanners() {
        $sql = self::$connection->prepare("SELECT COUNT(*) as total FROM banner");
        $sql->execute();
        $result = $sql->get_result()->fetch_assoc();
        return $result['total'];
    }
}