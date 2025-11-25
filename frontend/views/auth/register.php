<?php
declare(strict_types=1);
?>
<!doctype html>
<html lang="vi">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tạo Tài khoản - Laptop Store</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="/WEBSITE_BANLAPTOP/public/css/style.css">
</head>
<body class="register-page-body">

    <div style="max-width: 980px; margin: 0 auto; padding: 15px 20px;">
        <a href="/WEBSITE_BANLAPTOP/" style="font-size: 20px; color: #1d1d1f; font-weight: 600;">
            <i class="fas fa-laptop"></i> Laptop Store
        </a>
        <div style="float: right; font-size: 13px; margin-top: 5px;">
            <a href="/WEBSITE_BANLAPTOP/login" style="color: #1d1d1f;">Đăng nhập</a>
        </div>
    </div>

    <div class="register-container">
        <div class="reg-header">
            <h1>Tạo Tài khoản Laptop Store</h1>
            <p class="reg-subtext">Một tài khoản để truy cập tất cả dịch vụ.</p>
            <p class="reg-subtext" style="font-size: 14px; margin-top: 5px;">
                Bạn đã có Tài khoản? <a href="/WEBSITE_BANLAPTOP/login">Đăng nhập tại đây ›</a>
            </p>
        </div>

        <form action="/WEBSITE_BANLAPTOP/auth/register" method="POST">
            
            <div class="form-section">
                <div class="form-row-double">
                    <input type="text" name="lastname" class="input-apple" placeholder="Họ" required>
                    <input type="text" name="firstname" class="input-apple" placeholder="Tên" required>
                </div>
                
                <label class="label-apple">QUỐC GIA / VÙNG</label>
                <select class="input-apple" style="margin-bottom: 20px;">
                    <option>Việt Nam</option>
                </select>

                <label class="label-apple">NGÀY SINH</label>
                <input type="date" name="birthday" class="input-apple">
            </div>

            <div class="form-section">
                <input type="email" name="email" class="input-apple" placeholder="name@example.com (Dùng làm ID đăng nhập)" style="margin-bottom: 15px;" required>
                <p style="font-size: 12px; color: #666; margin-bottom: 20px;">Đây sẽ là ID Laptop Store mới của bạn.</p>
                
                <input type="password" name="password" class="input-apple" placeholder="Mật khẩu" style="margin-bottom: 15px;" required>
                <input type="password" name="re_password" class="input-apple" placeholder="Xác nhận mật khẩu" required>
            </div>

            <div class="form-section">
                <div class="form-row-double">
                    <select class="input-apple" style="width: 35%;">
                        <option>+84 (VN)</option>
                    </select>
                    <input type="text" name="phone" class="input-apple" placeholder="Số điện thoại" required>
                </div>
            </div>

            <div style="text-align: center; margin-top: 30px;">
                <button type="submit" class="btn btn-primary" style="padding: 12px 40px; font-size: 17px;">Tiếp tục</button>
            </div>
        </form>
    </div>
</body>
</html>