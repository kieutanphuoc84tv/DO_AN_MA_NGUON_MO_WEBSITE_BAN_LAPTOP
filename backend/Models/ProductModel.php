<?php
// File: backend/Models/ProductModel.php
require_once ROOT_PATH . '/backend/Models/Database.php';

class ProductModel {
    private $conn;

    public function __construct() {
        $config = require ROOT_PATH . '/backend/Config/config.php';
        $db = new Database($config);
        $this->conn = $db->getConnection();
    }

    // 1. Lấy TẤT CẢ sản phẩm (cho trang chủ)
    public function getAllProducts() {
        $stmt = $this->conn->prepare("SELECT * FROM tbl_product ORDER BY product_id DESC");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    // 2. Lấy sản phẩm THEO DANH MỤC
    public function getProductsByCategoryID($cat_id) {
        $stmt = $this->conn->prepare("SELECT * FROM tbl_product WHERE cat_id = ? ORDER BY product_id DESC");
        $stmt->execute([$cat_id]);
        return $stmt->fetchAll();
    }

    // 3. Lấy 1 sản phẩm theo ID (Dành cho trang chi tiết)
    public function getProductByID($product_id) {
        $stmt = $this->conn->prepare("SELECT * FROM tbl_product WHERE product_id = ?");
        $stmt->execute([$product_id]);
        return $stmt->fetch();
    }
    
    // 4. Lấy tên danh mục theo ID (Cho trang danh mục)
    public function getCategoryNameByID($cat_id) {
        $stmt = $this->conn->prepare("SELECT cat_name FROM tbl_category WHERE cat_id = ?");
        $stmt->execute([$cat_id]);
        $result = $stmt->fetch();
        return $result ? $result['cat_name'] : null;
    }
}
?>