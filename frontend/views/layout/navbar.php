<?php declare(strict_types=1); ?>
<header>
  <div class="navbar container">
    
    <a href="/WEBSITE_BANLAPTOP/" class="logo">
        <i class="fas fa-laptop"></i> LAPTOP STORE
    </a>

    <div class="search-box">
        <form action="/WEBSITE_BANLAPTOP/search" method="GET">
            <input type="text" name="keyword" placeholder="Bạn tìm laptop gì...">
            <button type="submit"><i class="fas fa-search"></i></button>
        </form>
    </div>
    
    <nav class="nav-links">
      <a href="/WEBSITE_BANLAPTOP/">Trang chủ</a>
      
      <div class="dropdown">
          <a href="#" class="dropbtn">Hãng Laptop <i class="fas fa-chevron-down" style="font-size: 12px;"></i></a>
          <div class="dropdown-content">
              <a href="/WEBSITE_BANLAPTOP/category/1">🍎 MacBook</a>
              <a href="/WEBSITE_BANLAPTOP/category/2">💻 Dell</a>
              <a href="/WEBSITE_BANLAPTOP/category/3">⚙️ Asus</a>
              <a href="/WEBSITE_BANLAPTOP/category/4">🐉 MSI</a>
              <a href="/WEBSITE_BANLAPTOP/category/5">🌿 Acer</a>
              <a href="/WEBSITE_BANLAPTOP/category/6">⚫ Lenovo</a>
              <a href="/WEBSITE_BANLAPTOP/category/7">⚪ HP</a>
          </div>
      </div>
    </nav>

    <div class="nav-icons">
      <a href="/WEBSITE_BANLAPTOP/cart" title="Giỏ hàng"><i class="fas fa-shopping-bag"></i></a>
      
      <?php if(isset($_SESSION['fullname'])): ?>
          <div class="user-dropdown">
              <span style="color: #e0e0e0; font-size: 14px; cursor: pointer;">
                  Hi, <?= htmlspecialchars($_SESSION['fullname']) ?>
              </span>
              <a href="/WEBSITE_BANLAPTOP/logout" title="Đăng xuất" style="margin-left: 10px; color: #ff6b6b;">
                <i class="fas fa-sign-out-alt"></i>
              </a>
          </div>
      <?php else: ?>
          <a href="/WEBSITE_BANLAPTOP/login" title="Đăng nhập"><i class="fas fa-user-circle"></i></a>
      <?php endif; ?>
    </div>

  </div>
</header>