<?php
class Users extends Db {
    // Phương thức kiểm tra đăng nhập
    public function checkLogin($gmail, $password) {
        // SQL JOIN giữa bảng users và roles để lấy role_name
        $sql = self::$connection->prepare("SELECT u.*, r.role_name 
                                          FROM users u 
                                          JOIN roles r ON u.role_id = r.role_id 
                                          WHERE u.gmail = ? AND u.password = ?");
        $sql->bind_param("ss", $gmail, $password);
        $sql->execute();
        
        $result = $sql->get_result()->fetch_assoc();
        return $result; // Trả về mảng chứa thông tin user hoặc null nếu sai
    }

    public function GetAllUsers(){
        $sql = self::$connection->prepare("SELECT * FROM users");
        $sql->execute();
        return $sql->get_result()->fetch_all(MYSQLI_ASSOC);
    }
    public function register($gmail, $password) {
        // Mặc định role_id = 2 là customer
        $role_id = 2; 
        $sql = self::$connection->prepare("INSERT INTO users (gmail, password, role_id) VALUES (?, ?, ?)");
        $sql->bind_param("ssi", $gmail, $password, $role_id);
        return $sql->execute();
    }

    public function checkEmailExists($gmail) {
        $sql = self::$connection->prepare("SELECT * FROM users WHERE gmail = ?");
        $sql->bind_param("s", $gmail);
        $sql->execute();
        $result = $sql->get_result();
        return $result->num_rows > 0;
    }
    public function getUsersPage($page, $perPage, $keyword = "") {
        $firstLink = ($page - 1) * $perPage;
        $search = "%{$keyword}%";
        $sql = self::$connection->prepare("SELECT u.*, r.role_name 
                                          FROM users u 
                                          JOIN roles r ON u.role_id = r.role_id 
                                          WHERE u.gmail LIKE ? 
                                          LIMIT ?, ?");
        $sql->bind_param("sii", $search, $firstLink, $perPage);
        $sql->execute();
        return $sql->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    public function getTotal($keyword = "") {
        $search = "%{$keyword}%";
        $sql = self::$connection->prepare("SELECT COUNT(*) as total FROM users WHERE gmail LIKE ?");
        $sql->bind_param("s", $search);
        $sql->execute();
        return $sql->get_result()->fetch_assoc()['total'];
    }

    public function delete($id) {
        $sql = self::$connection->prepare("DELETE FROM users WHERE user_id = ?");
        $sql->bind_param("i", $id);
        return $sql->execute();
    }
    public function getUserById($id) {
    $sql = self::$connection->prepare("SELECT * FROM users WHERE user_id = ?");
    $sql->bind_param("i", $id);
    $sql->execute();
    return $sql->get_result()->fetch_assoc();
    }

    public function updateUser($id, $gmail, $password, $role_id) {
        $sql = self::$connection->prepare("UPDATE users SET gmail = ?, password = ?, role_id = ? WHERE user_id = ?");
        $sql->bind_param("ssii", $gmail, $password, $role_id, $id);
        return $sql->execute();
    }
    public function add($gmail, $password, $role_id) {
    $sql = self::$connection->prepare("INSERT INTO users (gmail, password, role_id) VALUES (?, ?, ?)");
    $sql->bind_param("ssi", $gmail, $password, $role_id);
    return $sql->execute();
}
}
?>