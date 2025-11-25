<?php
require_once ROOT_PATH . '/backend/Models/Database.php';

class CartModel {
    private $conn;

    public function __construct() {
        $config = require ROOT_PATH . '/backend/Config/config.php';
        $db = new Database($config);
        $this->conn = $db->getConnection();
    }

    /**
     * Thêm sản phẩm vào giỏ hàng
     * Nếu có rồi thì tăng số lượng, chưa có thì thêm mới
     */
    public function addToCart($user_id, $product_id) {
        // 1. Kiểm tra xem user này đã thêm máy này vào giỏ chưa
        $stmt = $this->conn->prepare("SELECT * FROM tbl_cart WHERE user_id = ? AND product_id = ?");
        $stmt->execute([$user_id, $product_id]);
        $existing_item = $stmt->fetch();

        if ($existing_item) {
            // 2. Nếu có rồi -> Tăng số lượng (quantity) lên 1
            $sql = "UPDATE tbl_cart SET quantity = quantity + 1 WHERE cart_id = ?";
            $stmt = $this->conn->prepare($sql);
            return $stmt->execute([$existing_item['cart_id']]);
        } else {
            // 3. Nếu chưa có -> Thêm mới (INSERT)
            $sql = "INSERT INTO tbl_cart (user_id, product_id, quantity) VALUES (?, ?, 1)";
            $stmt = $this->conn->prepare($sql);
            return $stmt->execute([$user_id, $product_id]);
        }
    }

    /**
     * Lấy tất cả sản phẩm trong giỏ của 1 user
     * (JOIN với bảng product để lấy tên, giá, ảnh)
     */
    public function getCartItems($user_id) {
        $sql = "SELECT 
                    c.cart_id, 
                    c.quantity, 
                    p.product_id, 
                    p.product_name, 
                    p.product_price, 
                    p.product_image
                FROM 
                    tbl_cart c
                JOIN 
                    tbl_product p ON c.product_id = p.product_id
                WHERE 
                    c.user_id = ?";
        
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$user_id]);
        return $stmt->fetchAll();
    }

    /**
     * Xóa 1 sản phẩm khỏi giỏ hàng
     */
    public function removeFromCart($cart_id, $user_id) {
        $sql = "DELETE FROM tbl_cart WHERE cart_id = ? AND user_id = ?";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$cart_id, $user_id]);
    }
}
?>