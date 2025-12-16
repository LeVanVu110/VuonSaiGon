<?php
/**
 * Class Banner
 * Kế thừa từ class Db (Giả định rằng Db đã được định nghĩa và thiết lập kết nối CSDL)
 */
class Banner extends Db
{
    /**
     * Lấy tất cả các banner chung.
     */
    public function getAllBanner()
    {
        $sql = self::$connection->prepare("SELECT * FROM banner");
        $sql->execute(); //return an object
        $banners = array();
        $banners = $sql->get_result()->fetch_all(MYSQLI_ASSOC);
        return $banners; //return an array
    }

    /**
     * Lấy các banner giới thiệu đang được xem (is_view=1).
     */
    public function getintroductBanner()
    {
        $sql = self::$connection->prepare("SELECT * FROM banner_introduct Where is_view=1");
        $sql->execute(); //return an object
        $banners = array();
        $banners = $sql->get_result()->fetch_all(MYSQLI_ASSOC);
        return $banners; //return an array
    }

    /**
     * Lấy thông tin banner video.
     */
    public function getbannervideo()
    {
        $sql = self::$connection->prepare("SELECT * FROM banner_video");
        $sql->execute(); //return an object
        $banners = array();
        $banners = $sql->get_result()->fetch_all(MYSQLI_ASSOC);
        return $banners; //return an array
    }

    /**
     * Lấy các khối nội dung phụ cho trang giới thiệu.
     */
    public function getbannercontent()
    {
        $sql = self::$connection->prepare("SELECT * FROM banner_content");
        $sql->execute(); //return an object
        $banners = array();
        $banners = $sql->get_result()->fetch_all(MYSQLI_ASSOC);
        return $banners; //return an array
    }

    /**
     * Phân tích chuỗi nội dung từ CSDL (chứa tag src="..." xen kẽ) thành:
     * 1. Phần text đứng trước tag src="..." đầu tiên.
     * 2. Mảng các cặp [image_url, description] sau đó.
     * * @param string $content_string Chuỗi nội dung thô từ cột 'conntent'.
     * @return array Mảng có cấu trúc: ['text' => string, 'items' => [['image_url' => string, 'description' => string], ...]].
     */
    public function parse_content_data($content_string) {
        if (empty($content_string)) { return ['text' => '', 'items' => []]; }
        
        // Chuẩn hóa ngắt dòng và tách chuỗi
        $temp_content = str_replace(["\r\n", "\n", "\r"], "\n", $content_string);
        // Tách chuỗi, giữ lại delimiter 'src="'
        $segments = preg_split('/(src=")/', $temp_content, -1, PREG_SPLIT_DELIM_CAPTURE);
        
        $parsed_data = ['text' => '', 'items' => []];
        
        // 1. Lấy phần TEXT đầu tiên (nếu có)
        // Nếu phần tử đầu tiên không phải là 'src="'
        if (!empty($segments) && strpos($segments[0], 'src="') !== 0) {
            $parsed_data['text'] = trim($segments[0]);
            unset($segments[0]);
            $segments = array_values($segments); // Reset keys
        }

        // 2. Lặp qua các cặp src="..." và nội dung sau đó
        for ($i = 0; $i < count($segments); $i++) {
            if ($segments[$i] === 'src="') {
                $image_part = $segments[++$i]; // Phần tử kế tiếp là phần còn lại sau 'src="'
                $end_quote_pos = strpos($image_part, '"');
                
                if ($end_quote_pos !== false) {
                    $image_url = substr($image_part, 0, $end_quote_pos);
                    $content_text = trim(substr($image_part, $end_quote_pos + 1));
                    
                    // Xóa các dòng trống hoàn toàn sau khi trim
                    $content_text = preg_replace('/^\s*$/m', '', $content_text);
                    
                    if (!empty($image_url)) {
                        $parsed_data['items'][] = ['image_url' => $image_url, 'description' => $content_text];
                    }
                }
            }
        }
        return $parsed_data;
    }
}