<?php
require_once ROOT_PATH . '/backend/Models/ProductModel.php';

class AdminController { // <-- Tên class phải là AdminController

    // Hàm kiểm tra quyền Admin (Middleware)
    private function checkAdmin() {
        // Kiểm tra đăng nhập VÀ quyền role = 1
        if (!isset($_SESSION['user_id']) || !isset($_SESSION['role']) || $_SESSION['role'] != 1) {
            // Nếu không phải Admin thì đá về trang login
            echo "<script>alert('Bạn không có quyền truy cập Admin!'); window.location='/WEBSITE_BANLAPTOP/login';</script>";
            exit;
        }
    }

    // Trang Dashboard (Thống kê)
    public function dashboard() {
        $this->checkAdmin(); // Gọi hàm kiểm tra quyền
        
        // Lấy số liệu thống kê (Ví dụ đếm tổng sản phẩm)
        $productModel = new ProductModel();
        $products = $productModel->getAllProducts();
        $total_products = count($products);
        
        // Gọi giao diện Dashboard
        require_once ROOT_PATH . '/backend/admin/dashboard.php';
    }

    // Trang Quản lý sản phẩm
    public function productManager() {
        $this->checkAdmin();
        
        $productModel = new ProductModel();
        $products = $productModel->getAllProducts();
        
        // Gọi giao diện Quản lý sản phẩm
        require_once ROOT_PATH . '/backend/admin/product_manager.php';
    }
}
?>