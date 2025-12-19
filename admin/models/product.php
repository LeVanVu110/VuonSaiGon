<?php
class Products extends Db {
    
    // 1. Lấy tất cả sản phẩm (Có phân trang)
    public function getAllProductsPage($page, $perPage) {
        $firstLink = ($page - 1) * $perPage;
        $sql = self::$connection->prepare("SELECT * FROM products LIMIT ?, ?");
        $sql->bind_param("ii", $firstLink, $perPage);
        $sql->execute();
        return $sql->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    // 2. Tính tổng số sản phẩm để chia trang
    public function getTotalProducts() {
        $sql = self::$connection->prepare("SELECT COUNT(*) as total FROM products");
        $sql->execute();
        $result = $sql->get_result()->fetch_assoc();
        return $result['total'];
    }

    // 3. Lấy chi tiết 1 sản phẩm theo ID
    public function getProductById($id) {
        $sql = self::$connection->prepare("SELECT * FROM products WHERE id = ?");
        $sql->bind_param("i", $id);
        $sql->execute();
        return $sql->get_result()->fetch_assoc();
    }

    // 4. Thêm sản phẩm mới
    public function addProduct($name, $price, $discount_price, $description, $quantity, $state, $image_url, $is_sale) {
        $sql = self::$connection->prepare("INSERT INTO products (name, price, discount_price, description, quantity, state, image_url, is_sale) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $sql->bind_param("sddsisss", $name, $price, $discount_price, $description, $quantity, $state, $image_url, $is_sale);
        return $sql->execute();
    }

    // 5. Cập nhật sản phẩm
    public function updateProduct($id, $name, $price, $discount_price, $description, $quantity, $state, $image_url, $is_sale) {
        $sql = self::$connection->prepare("UPDATE products SET name=?, price=?, discount_price=?, description=?, quantity=?, state=?, image_url=?, is_sale=? WHERE id=?");
        $sql->bind_param("sddsisssi", $name, $price, $discount_price, $description, $quantity, $state, $image_url, $is_sale, $id);
        return $sql->execute();
    }

    // 6. Xóa sản phẩm
    public function deleteProduct($id) {
        $sql = self::$connection->prepare("DELETE FROM products WHERE id = ?");
        $sql->bind_param("i", $id);
        return $sql->execute();
    }

    // 7. Tìm kiếm sản phẩm theo tên
    public function searchProducts($keyword) {
        $search = "%{$keyword}%";
        $sql = self::$connection->prepare("SELECT * FROM products WHERE name LIKE ?");
        $sql->bind_param("s", $search);
        $sql->execute();
        return $sql->get_result()->fetch_all(MYSQLI_ASSOC);
    }
}