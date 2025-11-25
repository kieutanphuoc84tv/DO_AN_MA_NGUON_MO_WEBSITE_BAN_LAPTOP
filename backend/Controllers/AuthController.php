<?php
require_once ROOT_PATH . '/vendor/autoload.php'; 
use Google\Client as Google_Client;
use Google\Service\Oauth2 as Google_Service_Oauth2;

require_once ROOT_PATH . '/backend/Models/UserModel.php';

class AuthController {
    
    // HÀM ĐĂNG KÝ
    public function register() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $fullname = $_POST['fullname'] ?? ($_POST['lastname'] . ' ' . $_POST['firstname']);
            $username = $_POST['username'] ?? $_POST['email'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $phone = $_POST['phone'];

            $userModel = new UserModel();
            if ($userModel->createUser($fullname, $username, $email, $password, $phone)) {
                echo "<script>alert('✅ Đăng ký thành công! Hãy đăng nhập.'); window.location='/WEBSITE_BANLAPTOP/login';</script>";
            } else {
                echo "<script>alert('❌ Tên đăng nhập hoặc Email đã tồn tại!'); window.history.back();</script>";
            }
        }
    }

    // HÀM ĐĂNG NHẬP THƯỜNG
    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'];
            $password = $_POST['password'];
            $remember = isset($_POST['remember']);

            $userModel = new UserModel();
            $user = $userModel->getUserByUsername($username);

            if ($user && $user['password'] == $password) {
                $_SESSION['user_id'] = $user['user_id'];
                $_SESSION['fullname'] = $user['fullname'];
                $_SESSION['role'] = $user['role'];

                if ($remember) {
                    setcookie('remember_user', $username, time() + (86400 * 30), "/");
                }

                header("Location: /WEBSITE_BANLAPTOP/");
                exit;
            } else {
                echo "<script>alert('Sai tài khoản hoặc mật khẩu!'); window.history.back();</script>";
            }
        }
    }

    // HÀM ĐĂNG XUẤT
    public function logout() {
        session_destroy();
        setcookie('remember_user', '', time() - 3600, "/");
        header("Location: /WEBSITE_BANLAPTOP/");
    }

    // --- HÀM GOOGLE (CHUYỂN HƯỚNG) ---
    public function redirectToGoogle() {
        $config = require ROOT_PATH . '/backend/Config/config.php';
        
        $client = new Google_Client();
        $client->setClientId($config['GOOGLE_CLIENT_ID']);
        $client->setClientSecret($config['GOOGLE_CLIENT_SECRET']);
        $client->setRedirectUri($config['GOOGLE_REDIRECT_URL']);
        $client->addScope('email');
        $client->addScope('profile');

        // Tạo link và chuyển hướng
        header('Location: ' . filter_var($client->createAuthUrl(), FILTER_SANITIZE_URL));
        exit;
    }

    // --- HÀM GOOGLE (XỬ LÝ KHI TRẢ VỀ) ---
    public function handleGoogleCallback() {
        $config = require ROOT_PATH . '/backend/Config/config.php';
        $client = new Google_Client();
        $client->setClientId($config['GOOGLE_CLIENT_ID']);
        $client->setClientSecret($config['GOOGLE_CLIENT_SECRET']);
        $client->setRedirectUri($config['GOOGLE_REDIRECT_URL']);
        
        try {
            if (isset($_GET['code'])) {
                $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
                $client->setAccessToken($token['access_token']);

                $google_oauth = new Google_Service_Oauth2($client);
                $google_account_info = $google_oauth->userinfo->get();
                
                $email = $google_account_info->email;
                $name = $google_account_info->name;
                $google_id = $google_account_info->id;

                $userModel = new UserModel();
                $user = $userModel->findOrCreateGoogleUser($google_id, $email, $name);

                $_SESSION['user_id'] = $user['user_id'];
                $_SESSION['fullname'] = $user['fullname'];
                $_SESSION['role'] = $user['role'];
                
                header("Location: /WEBSITE_BANLAPTOP/");
                exit;
            }
        } catch (Exception $e) {
            // Bắt lỗi và in ra để debug nếu cần
            echo "Lỗi đăng nhập Google: " . $e->getMessage();
            exit;
        }
    }
}
?>