<?php declare(strict_types=1); ?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Laptop Store</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        /* CSS RIÊNG CHO ADMIN */
        :root { --admin-dark: #1e1e2d; --admin-light: #f5f8fa; --admin-blue: #0071e3; }
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Segoe UI', sans-serif; }
        body { display: flex; background: var(--admin-light); min-height: 100vh; }
        
        /* Sidebar (Menu trái) */
        .sidebar { width: 250px; background: var(--admin-dark); color: #fff; display: flex; flex-direction: column; }
        .brand { padding: 20px; font-size: 20px; font-weight: bold; text-align: center; border-bottom: 1px solid #333; }
        .brand i { margin-right: 10px; color: var(--admin-blue); }
        .menu { list-style: none; margin-top: 20px; }
        .menu li a { display: block; padding: 15px 25px; color: #a2a3b7; text-decoration: none; transition: 0.3s; }
        .menu li a:hover, .menu li a.active { background: #1b1b28; color: #fff; border-left: 4px solid var(--admin-blue); }
        .menu li a i { margin-right: 10px; width: 20px; }

        /* Main Content (Nội dung phải) */
        .main-content { flex: 1; padding: 30px; }
        .header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px; }
        .header h2 { color: #333; }
        .user-info { display: flex; align-items: center; gap: 10px; }
        .btn-logout { padding: 8px 15px; background: #ff4757; color: #fff; text-decoration: none; border-radius: 5px; font-size: 14px; }

        /* Cards Thống kê */
        .stats-grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 20px; margin-bottom: 30px; }
        .card { background: #fff; padding: 20px; border-radius: 10px; box-shadow: 0 2px 10px rgba(0,0,0,0.05); display: flex; align-items: center; justify-content: space-between; }
        .card-info h3 { font-size: 28px; color: #333; margin-bottom: 5px; }
        .card-info p { color: #888; font-size: 14px; }
        .card-icon { font-size: 40px; color: var(--admin-blue); opacity: 0.2; }
    </style>
</head>
<body>

    <div class="sidebar">
        <div class="brand"><i class="fas fa-laptop-code"></i> Admin Panel</div>
        <ul class="menu">
            <li><a href="/WEBSITE_BANLAPTOP/admin" class="active"><i class="fas fa-chart-line"></i> Tổng quan</a></li>
            <li><a href="/WEBSITE_BANLAPTOP/admin/products"><i class="fas fa-box"></i> Quản lý Sản phẩm</a></li>
            <li><a href="#"><i class="fas fa-shopping-cart"></i> Quản lý Đơn hàng</a></li>
            <li><a href="#"><i class="fas fa-users"></i> Khách hàng</a></li>
            <li><a href="/WEBSITE_BANLAPTOP/"><i class="fas fa-globe"></i> Xem Trang web</a></li>
        </ul>
    </div>

    <div class="main-content">
        <div class="header">
            <h2>Tổng quan</h2>
            <div class="user-info">
                <span>Xin chào, <b><?= $_SESSION['fullname'] ?></b></span>
                <a href="/WEBSITE_BANLAPTOP/logout" class="btn-logout">Đăng xuất</a>
            </div>
        </div>

        <div class="stats-grid">
            <div class="card">
                <div class="card-info">
                    <h3><?= $total_products ?? 0 ?></h3>
                    <p>Tổng sản phẩm</p>
                </div>
                <div class="card-icon"><i class="fas fa-box"></i></div>
            </div>
            <div class="card">
                <div class="card-info">
                    <h3>12</h3>
                    <p>Đơn hàng mới</p>
                </div>
                <div class="card-icon"><i class="fas fa-shopping-cart"></i></div>
            </div>
            <div class="card">
                <div class="card-info">
                    <h3>5.2tr</h3>
                    <p>Doanh thu ngày</p>
                </div>
                <div class="card-icon"><i class="fas fa-dollar-sign"></i></div>
            </div>
            <div class="card">
                <div class="card-info">
                    <h3>85</h3>
                    <p>Khách hàng</p>
                </div>
                <div class="card-icon"><i class="fas fa-users"></i></div>
            </div>
        </div>

        <div style="background: #fff; padding: 20px; border-radius: 10px; height: 400px; display: flex; align-items: center; justify-content: center; color: #999;">
            Khu vực biểu đồ doanh thu (Sẽ cập nhật sau)
        </div>
    </div>

</body>
</html>