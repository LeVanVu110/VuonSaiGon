<?php
class Statistics extends Db {
    public function getCount($table) {
        $sql = self::$connection->prepare("SELECT COUNT(*) as total FROM $table");
        $sql->execute();
        return $sql->get_result()->fetch_assoc()['total'];
    }

    public function getLatestProducts($limit = 5) {
        // Sắp xếp theo created_at mới nhất thay vì id
        $sql = self::$connection->prepare("SELECT * FROM products ORDER BY created_at DESC LIMIT ?");
        $sql->bind_param("i", $limit);
        $sql->execute();
        return $sql->get_result()->fetch_all(MYSQLI_ASSOC);
    }
}