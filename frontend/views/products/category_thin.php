<?php
declare(strict_types=1);
require __DIR__ . '/../layout/header.php';
require __DIR__ . '/../layout/navbar.php';

// $products được cung cấp bởi controller
?>

<div class="hero">
    <h1 style="font-size: 48px;">Laptop Mỏng nhẹ</h1>
    <p>Thiết kế mỏng, pin lâu — đồng hành mọi nơi.</p>
    <div class="hero-links">
        <a href="/WEBSITE_BANLAPTOP/">Trở về trang chủ</a>
    </div>
    <img src="https://cdn.tgdd.vn/Products/Images/42/304861/acer-swift-3-1-600x600.jpg" style="margin: 30px auto 0; width: 700px; max-width: 100%;">
</div>

<main class="container">
    <h2 class="section-title">Laptop Mỏng nhẹ</h2>
    <p style="text-align:center; color:#666;">Gọn nhẹ, thời trang, phù hợp công việc di động và học tập.</p>

    <div class="product-grid">
        <?php foreach ($products as $p): 
            $prodId = $p['id'] ?? $p['product_id'] ?? $p['productId'] ?? '';
            $prodName = $p['name'] ?? $p['product_name'] ?? $p['title'] ?? 'Không tên';
            $prodPrice = $p['price'] ?? $p['product_price'] ?? $p['price_vnd'] ?? '';
            $prodImg = $p['img'] ?? $p['product_image'] ?? $p['image'] ?? '';
            if (empty($prodImg)) $prodImg = 'https://via.placeholder.com/400x300?text=No+Image';
        ?>
            <div class="product-card">
                <img src="<?= htmlspecialchars($prodImg) ?>" class="product-img" alt="<?= htmlspecialchars($prodName) ?>">
                <div style="flex-grow: 1; display: flex; flex-direction: column; justify-content: space-between;">
                    <h3 class="product-name"><?= htmlspecialchars($prodName) ?></h3>
                    <div class="product-price"><?= htmlspecialchars($prodPrice) ?>₫</div>
                    <div class="product-actions">
                        <a href="/WEBSITE_BANLAPTOP/product?id=<?= htmlspecialchars((string)$prodId) ?>" class="btn btn-primary">Mua ngay</a>
                        <a href="#" class="btn btn-outline">Chi tiết</a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</main>

<?php require __DIR__ . '/../layout/footer.php'; ?>
