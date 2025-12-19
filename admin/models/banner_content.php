<?php
class BannerContent extends Db {
    // Lấy danh sách kèm tìm kiếm và phân trang
    public function getBannerContentPage($page, $perPage, $keyword = "") {
        $firstLink = ($page - 1) * $perPage;
        $search = "%{$keyword}%";
        $sql = self::$connection->prepare("SELECT * FROM banner_content WHERE tile LIKE ? OR conntent LIKE ? LIMIT ?, ?");
        $sql->bind_param("ssii", $search, $search, $firstLink, $perPage);
        $sql->execute();
        return $sql->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    public function getTotal($keyword = "") {
        $search = "%{$keyword}%";
        $sql = self::$connection->prepare("SELECT COUNT(*) as total FROM banner_content WHERE tile LIKE ? OR conntent LIKE ?");
        $sql->bind_param("ss", $search, $search);
        $sql->execute();
        return $sql->get_result()->fetch_assoc()['total'];
    }

    public function getById($id) {
        $sql = self::$connection->prepare("SELECT * FROM banner_content WHERE bannercontent_id = ?");
        $sql->bind_param("i", $id);
        $sql->execute();
        return $sql->get_result()->fetch_assoc();
    }

    public function add($title, $content) {
        $sql = self::$connection->prepare("INSERT INTO banner_content (tile, conntent) VALUES (?, ?)");
        $sql->bind_param("ss", $title, $content);
        return $sql->execute();
    }

    public function update($id, $title, $content) {
        $sql = self::$connection->prepare("UPDATE banner_content SET tile = ?, conntent = ? WHERE bannercontent_id = ?");
        $sql->bind_param("ssi", $title, $content, $id);
        return $sql->execute();
    }

    public function delete($id) {
        $sql = self::$connection->prepare("DELETE FROM banner_content WHERE bannercontent_id = ?");
        $sql->bind_param("i", $id);
        return $sql->execute();
    }
}