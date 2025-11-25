<?php
require_once ROOT_PATH . '/backend/Models/CartModel.php';

class CartController {

    // Hàm này để HIỂN THỊ trang giỏ hàng
    public function index() {
        // 1. Kiểm tra xem ông đã đăng nhập chưa
        if (!isset($_SESSION['user_id'])) {
            // Chưa thì "cút" về trang login
            header("Location: /WEBSITE_BANLAPTOP/login");
            exit;
        }

        $user_id = $_SESSION['user_id'];
        $cartModel = new CartModel();
        
        // 2. Lấy tất cả sản phẩm trong giỏ
        $cart_items = $cartModel->getCartItems($user_id);
        
        // 3. Ném dữ liệu ra view
        require_once ROOT_PATH . '/frontend/views/cart.php';
    }

    // Hàm này để THÊM sản phẩm vào giỏ
    public function add() {
        if (!isset($_SESSION['user_id'])) {
            echo "<script>alert('Vui lòng đăng nhập để mua hàng!'); window.location='/WEBSITE_BANLAPTOP/login';</script>";
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['product_id'])) {
            $user_id = $_SESSION['user_id'];
            $product_id = $_POST['product_id'];

            $cartModel = new CartModel();
            $cartModel->addToCart($user_id, $product_id);

            // Thêm xong, ném thẳng qua trang giỏ hàng cho nó xem
            header("Location: /WEBSITE_BANLAPTOP/cart");
            exit;
        }
    }

    // Hàm này để XÓA sản phẩm
    public function remove() {
        if (!isset($_SESSION['user_id'])) {
            header("Location: /WEBSITE_BANLAPTOP/login");
            exit;
        }

        if (isset($_GET['cart_id'])) {
            $cart_id = $_GET['cart_id'];
            $user_id = $_SESSION['user_id'];
            
            $cartModel = new CartModel();
            $cartModel->removeFromCart($cart_id, $user_id);

            // Xóa xong, tải lại trang giỏ hàng
            header("Location: /WEBSITE_BANLAPTOP/cart");
            exit;
        }
    }
}
?>