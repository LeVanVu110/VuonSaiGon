<?php
class Videos extends Db {
    // Lấy danh sách video có phân trang và tìm kiếm
    public function getVideosPage($page, $perPage, $keyword = "") {
        $firstLink = ($page - 1) * $perPage;
        $search = "%{$keyword}%";
        $sql = self::$connection->prepare("SELECT * FROM video WHERE title LIKE ? OR youtube_id LIKE ? LIMIT ?, ?");
        $sql->bind_param("ssii", $search, $search, $firstLink, $perPage);
        $sql->execute();
        return $sql->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    // Tính tổng số video để chia trang
    public function getTotal($keyword = "") {
        $search = "%{$keyword}%";
        $sql = self::$connection->prepare("SELECT COUNT(*) as total FROM video WHERE title LIKE ? OR youtube_id LIKE ?");
        $sql->bind_param("ss", $search, $search);
        $sql->execute();
        return $sql->get_result()->fetch_assoc()['total'];
    }

    public function getById($id) {
        $sql = self::$connection->prepare("SELECT * FROM video WHERE video_id = ?");
        $sql->bind_param("i", $id);
        $sql->execute();
        return $sql->get_result()->fetch_assoc();
    }

    public function add($youtube_id, $title, $image, $url) {
        $sql = self::$connection->prepare("INSERT INTO video (youtube_id, title, image, url) VALUES (?, ?, ?, ?)");
        $sql->bind_param("ssss", $youtube_id, $title, $image, $url);
        return $sql->execute();
    }

    public function update($id, $youtube_id, $title, $image, $url) {
        $sql = self::$connection->prepare("UPDATE video SET youtube_id = ?, title = ?, image = ?, url = ? WHERE video_id = ?");
        $sql->bind_param("ssssi", $youtube_id, $title, $image, $url, $id);
        return $sql->execute();
    }

    public function delete($id) {
        $sql = self::$connection->prepare("DELETE FROM video WHERE video_id = ?");
        $sql->bind_param("i", $id);
        return $sql->execute();
    }
}