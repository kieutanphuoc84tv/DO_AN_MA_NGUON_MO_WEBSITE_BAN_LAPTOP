<?php
require_once ROOT_PATH . '/backend/Models/Database.php';

class UserModel {
    private $conn;

    public function __construct() {
        $config = require ROOT_PATH . '/backend/Config/config.php';
        $db = new Database($config);
        $this->conn = $db->getConnection();
    }

    // 1. Đăng ký thường
    public function createUser($fullname, $username, $email, $password, $phone) {
        $stmt = $this->conn->prepare("SELECT user_id FROM tbl_user WHERE email = ? OR username = ?");
        $stmt->execute([$email, $username]);
        if($stmt->rowCount() > 0) return false; 

        $sql = "INSERT INTO tbl_user (fullname, username, email, password, phone, role) VALUES (?, ?, ?, ?, ?, 0)";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$fullname, $username, $email, $password, $phone]);
    }

    // 2. Đăng nhập thường
    public function getUserByUsername($input) {
        $stmt = $this->conn->prepare("SELECT * FROM tbl_user WHERE username = ? OR email = ?");
        $stmt->execute([$input, $input]);
        return $stmt->fetch();
    }

    // 3. HÀM MỚI: ĐĂNG NHẬP GOOGLE (Cái ông đang thiếu nè)
    public function findOrCreateGoogleUser($google_id, $email, $fullname) {
        // Kiểm tra xem email này đã có chưa
        $stmt = $this->conn->prepare("SELECT * FROM tbl_user WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch();

        if ($user) {
            return $user; // Có rồi thì trả về luôn
        } else {
            // Chưa có thì tạo mới
            $password = $google_id; // Mật khẩu ngầm
            $username = $email;
            
            $sql = "INSERT INTO tbl_user (fullname, username, email, password, phone, role) VALUES (?, ?, ?, ?, '', 0)";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([$fullname, $username, $email, $password]);

            $new_id = $this->conn->lastInsertId();
            $stmt = $this->conn->prepare("SELECT * FROM tbl_user WHERE user_id = ?");
            $stmt->execute([$new_id]);
            return $stmt->fetch();
        }
    }
}
?>