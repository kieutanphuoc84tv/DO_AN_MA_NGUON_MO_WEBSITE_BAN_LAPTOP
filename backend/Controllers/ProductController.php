<?php
// File: backend/Controllers/ProductController.php
require_once ROOT_PATH . '/backend/Models/ProductModel.php'; 

class ProductController {
    
    // Hàm cho trang chủ (lấy TẤT CẢ)
    public function list() {
        $productModel = new ProductModel();
        $products = $productModel->getAllProducts(); // Lấy data thật
        
        $pageTitle = "Siêu Phẩm Công Nghệ 2025";
        $subTitle = "Hiệu năng đỉnh cao. Thiết kế bứt phá.";
        
        require_once ROOT_PATH . '/frontend/views/products/list.php';
    }

    // Hàm cho trang danh mục (lấy theo ID)
    public function listByCategory($cat_id) {
        $productModel = new ProductModel();
        $products = $productModel->getProductsByCategoryID($cat_id); 

        // Lấy tên hãng để đặt tiêu đề
        $categoryName = $productModel->getCategoryNameByID($cat_id); 
        $pageTitle = $categoryName ? "Laptop {$categoryName}" : "Sản phẩm theo danh mục";
        $subTitle = "Sản phẩm chính hãng - Giá tốt nhất";
        
        require_once ROOT_PATH . '/frontend/views/products/list.php';
    }

    // Hàm cho trang chi tiết (Đã hoàn thiện)
    public function detail() {
        if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
            // Xử lý nếu không có ID
            http_response_code(400);
            echo "Lỗi: Thiếu Product ID.";
            return;
        }

        $product_id = (int)$_GET['id'];
        $productModel = new ProductModel();
        $product = $productModel->getProductByID($product_id); // Lấy data chi tiết

        if (!$product) {
            // Xử lý nếu không tìm thấy sản phẩm
            http_response_code(404);
            echo "404 - Sản phẩm không tồn tại!";
            return;
        }

        // Truyền biến $product vào view
        require_once ROOT_PATH . '/frontend/views/products/detail.php';
    }
}
?>