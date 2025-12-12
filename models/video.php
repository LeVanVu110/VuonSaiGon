<?php
class Video extends Db{
    public function GetAllVideo(){
        $sql = self::$connection->prepare("SELECT *FROM video");
        $sql->execute(); //return an object
        $video = array();
        $video = $sql->get_result()->fetch_all(MYSQLI_ASSOC);
        return $video; //return an array
    }
    // Hàm MỚI: Lấy tổng số video (Dùng cho Phân trang)
    public function GetVideoCount(){
        $sql = self::$connection->prepare("SELECT COUNT(*) AS total FROM video");
        $sql->execute();
        return $sql->get_result()->fetch_assoc()['total'];
    }

    // Hàm MỚI: Lấy video theo Trang (9 video/trang)
    public function GetVideosByPage($page, $perPage = 9){
        $offset = ($page - 1) * $perPage;
        // Sử dụng youtube_id để loại trừ video chính nếu cần, nhưng truy vấn chính vẫn lấy tất cả
        $sql = self::$connection->prepare("SELECT * FROM video ORDER BY video_id DESC LIMIT ?, ?");
        // 'ii' nghĩa là hai tham số tiếp theo là integer (offset và perPage)
        $sql->bind_param("ii", $offset, $perPage); 
        $sql->execute();
        return $sql->get_result()->fetch_all(MYSQLI_ASSOC);
    }
    // Hàm Lấy Video chính theo youtube_id
    public function GetVideoByYoutubeId($youtubeId){
        $sql = self::$connection->prepare("SELECT * FROM video WHERE youtube_id = ?");
        $sql->bind_param("s", $youtubeId); 
        $sql->execute();
        return $sql->get_result()->fetch_assoc();
    }
}