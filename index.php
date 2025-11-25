<?php
// File: index.php (Thư mục gốc)
session_start();

// 1. ĐỊNH NGHĨA ĐƯỜNG DẪN GỐC
define('ROOT_PATH', __DIR__);

// 2. TỰ ĐỘNG LOGIN BẰNG COOKIE
if (!isset($_SESSION['user_id']) && isset($_COOKIE['remember_user'])) {
    require_once ROOT_PATH . '/backend/Models/UserModel.php';
    $userModel = new UserModel();
    $user = $userModel->getUserByUsername($_COOKIE['remember_user']);
    if ($user) {
        $_SESSION['user_id'] = $user['user_id'];
        $_SESSION['fullname'] = $user['fullname'];
        $_SESSION['role'] = $user['role'];
    }
}

// 3. GỌI CÁC FILE CẦN THIẾT
require_once ROOT_PATH . '/backend/Config/config.php';
require_once ROOT_PATH . '/backend/Controllers/ProductController.php';
require_once ROOT_PATH . '/backend/Controllers/AuthController.php';
require_once ROOT_PATH . '/backend/Controllers/CartController.php';
require_once ROOT_PATH . '/backend/Controllers/AdminController.php';

// 4. LẤY URL
$config = require ROOT_PATH . '/backend/Config/config.php';
$project_folder = $config['BASE_URL'] ?? '/WEBSITE_BANLAPTOP';
$request_uri = $_SERVER['REQUEST_URI'];
$router = str_replace($project_folder, '', $request_uri);

// 5. ROUTER CHÍNH
switch (true) { 
    
    // ===== TRANG SẢN PHẨM (FRONTEND) =====
    case ($router == '/' || $router == '' || $router == '/index.php' || $router == '/products'):
        $controller = new ProductController();
        $controller->list();
        break;
    case (strpos($router, '/category/') !== false):
        $parts = explode('/', $router);
        $cat_id = end($parts);
        $controller = new ProductController();
        $controller->listByCategory((int)$cat_id);
        break;
    case (strpos($router, '/search') !== false):
        $controller = new ProductController();
        $controller->listBySearch();
        break;
    case (strpos($router, '/product') !== false):
        $controller = new ProductController();
        $controller->detail();
        break;
    
    // ===== GIỎ HÀNG =====
    case $router == '/cart':
        $controller = new CartController();
        $controller->index();
        break;
    case $router == '/cart/add':
        $controller = new CartController();
        $controller->add();
        break;
    case (strpos($router, '/cart/remove') !== false):
        $controller = new CartController();
        $controller->remove();
        break;
    
    // ===== TÀI KHOẢN (AUTH) & GOOGLE API =====
    case $router == '/login':
        if (isset($_SESSION['user_id'])) { header("Location: " . $project_folder . "/"); exit; }
        require_once ROOT_PATH . '/frontend/views/auth/login.php';
        break;
    case $router == '/register':
        require_once ROOT_PATH . '/frontend/views/auth/register.php';
        break;
    case $router == '/logout':
        $auth = new AuthController();
        $auth->logout();
        break;
    case $router == '/auth/login':
        $auth = new AuthController();
        $auth->login();
        break;
    case $router == '/auth/register':
        $auth = new AuthController();
        $auth->register();
        break;
    
    case $router == '/google-login': // CHUYỂN HƯỚNG
        $auth = new AuthController();
        $auth->redirectToGoogle();
        break;

    case (strpos($router, '/google-callback') !== false): // XỬ LÝ KHI GOOGLE TRẢ VỀ
        $auth = new AuthController();
        $auth->handleGoogleCallback(); // <-- Gọi hàm xử lý
        break;

    // ===== TRANG QUẢN TRỊ (ADMIN) =====
    case ($router == '/admin' || $router == '/admin/dashboard'):
        $admin = new AdminController();
        $admin->dashboard();
        break;
    case $router == '/admin/products':
        $admin = new AdminController();
        $admin->productManager();
        break;

    // ===== LỖI 404 (CHỈ CÓ 1 CÁI DEFAULT NÀY THÔI) =====
    default:
        http_response_code(404);
        echo "404 - Trang không tồn tại!";
        break;
}
?>