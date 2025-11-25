<?php
declare(strict_types=1);
require ROOT_PATH . '/frontend/views/layout/header.php';
require ROOT_PATH . '/frontend/views/layout/navbar.php';

// Code này dùng để fix lỗi ảnh không hiện (Sẽ dùng link cục bộ /image/)
$current_path = '/WEBSITE_BANLAPTOP/image/';
?>

<div class="hero">
    <h1 style="font-size: 48px;"><?= htmlspecialchars($pageTitle ?? 'Sản phẩm') ?></h1>
    <p><?= htmlspecialchars($subTitle ?? 'Hiệu năng đỉnh cao. Thiết kế bứt phá.') ?></p>
    
    <div class="hero-links">
        <a href="#">Xem bộ sưu tập ></a>
        <a href="#">Săn Deal ngay ></a>
    </div>
    <img src="https://dlcdnwebimgs.asus.com/gain/7D63D608-6701-46C4-854A-88131E6C1996/w1000/fwebp" style="margin: 30px auto 0; width: 700px; max-width: 100%;">
</div>

<main class="container">
    <h2 class="section-title">Danh sách sản phẩm</h2>
    
    <div class="product-grid">
        
        <?php if (empty($products)): ?>
            <p style="font-size: 24px; text-align: center; grid-column: 1 / -1;">
                🚧 Không tìm thấy sản phẩm nào trong mục này.
            </p>
        <?php else: ?>
            
            <?php foreach ($products as $p): 
                // Xử lý hình ảnh
                $img_name = htmlspecialchars($p['product_image'] ?? '');
                $img_src = (strpos($img_name, 'http') === 0) 
                    ? $img_name 
                    : $current_path . $img_name; // Sử dụng đường dẫn cục bộ
            ?>
                <div class="product-card">
                    
                    <a href="/WEBSITE_BANLAPTOP/product?id=<?= $p['product_id'] ?>" title="<?= htmlspecialchars($p['product_name']) ?>">
                        <img 
                            src="<?= $img_src ?>" 
                            onerror="this.src='https://via.placeholder.com/300x300?text=Laptop'" 
                            class="product-img" 
                            alt="<?= htmlspecialchars($p['product_name'] ?? 'Sản phẩm') ?>"
                        >
                    </a>
                    
                    <div style="flex-grow: 1; display: flex; flex-direction: column; justify-content: space-between;">
                        <a href="/WEBSITE_BANLAPTOP/product?id=<?= $p['product_id'] ?>" style="text-decoration: none;">
                            <h3 class="product-name"><?= htmlspecialchars($p['product_name'] ?? 'Tên sản phẩm') ?></h3>
                        </a>
                        <div style="margin-top: 5px;">
                             <p class="product-specs" style="font-size: 14px; color: #666;">
                                <?= htmlspecialchars($p['spec_cpu'] ?? 'CPU') ?> | <?= htmlspecialchars($p['spec_ram'] ?? 'RAM') ?>
                            </p>
                        </div>
                        
                        <div class="product-price"><?= number_format((float)($p['product_price'] ?? 0)) ?>₫</div>
                        
                        <div class="product-actions">
                            
                            <form action="/WEBSITE_BANLAPTOP/cart/add" method="POST" style="flex: 1;">
                                <input type="hidden" name="product_id" value="<?= $p['product_id'] ?? 0 ?>">
                                <button type="submit" name="add_to_cart" class="btn btn-primary">Mua ngay</button>
                            </form>
                            
                            <a href="/WEBSITE_BANLAPTOP/product?id=<?= $p['product_id'] ?>" class="btn btn-outline">
                                Chi tiết
                            </a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>

    </div>
</main>

<?php require __DIR__ . '/../layout/footer.php'; ?>