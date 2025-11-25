<?php
require_once ROOT_PATH . '/backend/Models/Database.php';

class CategoryModel {
    private $conn;

    public function __construct() {
        $config = require ROOT_PATH . '/backend/Config/config.php';
        $db = new Database($config);
        $this->conn = $db->getConnection();
    }

    public function getAllCategories() {
        try {
            $stmt = $this->conn->prepare("SELECT * FROM tbl_category ORDER BY cat_id ASC");
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (\Exception $e) {
            // Nếu bảng không tồn tại hoặc lỗi, trả về mảng rỗng để không làm vỡ trang
            return [];
        }
    }

    public function getCategoryById($id) {
        try {
            $stmt = $this->conn->prepare("SELECT * FROM tbl_category WHERE cat_id = ? LIMIT 1");
            $stmt->execute([$id]);
            return $stmt->fetch();
        } catch (\Exception $e) {
            return null;
        }
    }
}
