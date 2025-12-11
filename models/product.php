<?php
class Product extends Db
{
    public function getAllProduct()
    {
        $sql = self::$connection->prepare("SELECT * FROM products");
        $sql->execute(); //return an object
        $banners = array();
        $banners = $sql->get_result()->fetch_all(MYSQLI_ASSOC);
        return $banners; //return an array
    }
    public function getAllProductSale()
    {
        $sql = self::$connection->prepare("SELECT * FROM `products` WHERE `is_sale`=1");
        $sql->execute(); //return an object
        $banners = array();
        $banners = $sql->get_result()->fetch_all(MYSQLI_ASSOC);
        return $banners; //return an array
    }
    /**
     * Hàm định dạng tiền tệ sang VND
     * @param int $price Giá tiền
     * @return string
     */
    public static function formatCurrency($price)
    {
        $price = is_numeric($price) ? $price : 0;
        return number_format($price, 0, ',', '.') . 'đ';
    }

    /**
     * Hàm chia mảng sản phẩm thành các nhóm nhỏ (chunk) cho Carousel Slide
     * @param array $products Mảng sản phẩm (Lấy từ DB)
     * @param int $size Kích thước mỗi nhóm (slide)
     * @return array Mảng chứa các mảng con
     */
    public static function chunkProductsForCarousel($products, $size = 6)
    {
        if (empty($products) || !is_array($products)) {
            return [];
        }
        return array_chunk($products, $size);
    }
    /**
     * Lấy thời gian kết thúc của sự kiện Flash Sale đang hoạt động.
     * @return string|null Thời gian kết thúc (format YYYY-MM-DD HH:MM:SS) hoặc null.
     */
    public function getActiveSaleEndTime()
    {
        // Lấy end_time của sự kiện active, và thời gian hiện tại chưa vượt quá end_time
        $sql = self::$connection->prepare("SELECT end_time FROM flash_sale_events WHERE is_active = 1 AND end_time > NOW() LIMIT 1");
        $sql->execute(); 
        $result = $sql->get_result()->fetch_assoc();
        
        // Trả về timestamp ISO 8601 để dễ dùng trong JavaScript
        return $result ? date('c', strtotime($result['end_time'])) : null; 
    }
}
