<?php
declare(strict_types=1);

return [
    // Cấu hình Database (Hồi nãy ông sửa đúng rồi)
    'DB_HOST' => 'localhost',
    'DB_NAME' => 'website_banlaptop', 
    'DB_USER' => 'root',
    'DB_PASS' => '',
    
    // Đường dẫn gốc dự án
    'BASE_URL' => '/WEBSITE_BANLAPTOP',

    // --- CẤU HÌNH GOOGLE (xem .env.example để set up) ---
    'GOOGLE_CLIENT_ID'     => $_ENV['GOOGLE_CLIENT_ID'] ?? '',
    'GOOGLE_CLIENT_SECRET' => $_ENV['GOOGLE_CLIENT_SECRET'] ?? '',
    
    // Link này phải trùng khớp 100% với cái ông khai báo trên Google
    'GOOGLE_REDIRECT_URL'  => $_ENV['GOOGLE_REDIRECT_URL'] ?? 'http://localhost/WEBSITE_BANLAPTOP/google-callback'
];