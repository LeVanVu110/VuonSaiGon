<?php
class FlashSales extends Db {
    // Lấy danh sách kèm tìm kiếm và phân trang
    public function getFlashSalesPage($page, $perPage, $keyword = "") {
        $firstLink = ($page - 1) * $perPage;
        $search = "%{$keyword}%";
        $sql = self::$connection->prepare("SELECT * FROM flash_sale_events WHERE name LIKE ? ORDER BY start_time DESC LIMIT ?, ?");
        $sql->bind_param("sii", $search, $firstLink, $perPage);
        $sql->execute();
        return $sql->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    public function getTotal($keyword = "") {
        $search = "%{$keyword}%";
        $sql = self::$connection->prepare("SELECT COUNT(*) as total FROM flash_sale_events WHERE name LIKE ?");
        $sql->bind_param("s", $search);
        $sql->execute();
        return $sql->get_result()->fetch_assoc()['total'];
    }

    public function getById($id) {
        $sql = self::$connection->prepare("SELECT * FROM flash_sale_events WHERE id = ?");
        $sql->bind_param("i", $id);
        $sql->execute();
        return $sql->get_result()->fetch_assoc();
    }

    public function add($name, $start, $end, $is_active) {
        $sql = self::$connection->prepare("INSERT INTO flash_sale_events (name, start_time, end_time, is_active) VALUES (?, ?, ?, ?)");
        $sql->bind_param("sssi", $name, $start, $end, $is_active);
        return $sql->execute();
    }

    public function update($id, $name, $start, $end, $is_active) {
        $sql = self::$connection->prepare("UPDATE flash_sale_events SET name = ?, start_time = ?, end_time = ?, is_active = ? WHERE id = ?");
        $sql->bind_param("sssii", $name, $start, $end, $is_active, $id);
        return $sql->execute();
    }

    public function delete($id) {
        $sql = self::$connection->prepare("DELETE FROM flash_sale_events WHERE id = ?");
        $sql->bind_param("i", $id);
        return $sql->execute();
    }
}