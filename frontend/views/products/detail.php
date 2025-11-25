<?php
declare(strict_types=1);
require ROOT_PATH . '/frontend/views/layout/header.php';
require ROOT_PATH . '/frontend/views/layout/navbar.php';

// CHỈNH ĐƯỜNG DẪN ẢNH ĐÚNG
$img_name = htmlspecialchars($product['product_image'] ?? '');
$img_path = '/WEBSITE_BANLAPTOP/image/' . $img_name;
?>

<main class="container">
    <div class="detail-wrapper">
        <div class="detail-img">
            <img 
                src="<?= $img_path ?>" 
                onerror="this.src='https://via.placeholder.com/500x500?text=Anh+Laptop'" 
                alt="<?= htmlspecialchars($product['product_name'] ?? 'Sản phẩm') ?>"
            >
        </div>

        <div class="detail-info">
            <div class="detail-tag">Hàng chính hãng</div>
            
            <h1 class="detail-title"><?= htmlspecialchars($product['product_name'] ?? 'Tên sản phẩm') ?></h1>
            
            <p style="font-size: 18px; margin-bottom: 20px; line-height: 1.6;">
                <?= htmlspecialchars($product['product_desc'] ?? 'Sản phẩm đang được cập nhật mô tả chi tiết...') ?>
            </p>
            
            <div class="detail-price"><?= number_format((float)($product['product_price'] ?? 0)) ?>₫</div>

            <ul class="specs-list">
                <li><span>Loại CPU</span> <strong><?= htmlspecialchars($product['spec_cpu'] ?? 'Không rõ') ?></strong></li>
                <li><span>Card Đồ họa</span> <strong><?= htmlspecialchars($product['spec_gpu'] ?? 'Không rõ') ?></strong></li>
                <li><span>Dung lượng RAM</span> <strong><?= htmlspecialchars($product['spec_ram'] ?? 'Không rõ') ?></strong></li>
                <li><span>Ổ cứng</span> <strong><?= htmlspecialchars($product['spec_disk'] ?? 'Không rõ') ?></strong></li>
                <li><span>Màn hình</span> <strong><?= htmlspecialchars($product['spec_screen'] ?? 'Không rõ') ?></strong></li>
                <li><span>Hệ điều hành</span> <strong>Windows 11 Home / macOS (Tùy máy)</strong></li>
            </ul>

            <div style="margin-top: 30px;">
                <form action="/WEBSITE_BANLAPTOP/cart/add" method="POST">
                    <input type="hidden" name="product_id" value="<?= $product['product_id'] ?? 0 ?>">
                    <button type="submit" name="add_to_cart" class="btn btn-primary btn-buy-large">
                        <i class="fas fa-shopping-bag"></i> Thêm vào giỏ hàng
                    </button>
                </form>
            </div>
            
            <div style="text-align: center; margin-top: 15px; font-size: 13px; color: #666;">
                <i class="fas fa-truck"></i> Giao hàng miễn phí &bull; <i class="fas fa-undo"></i> Đổi trả dễ dàng
            </div>
        </div>
    </div>
</main>

<?php require __DIR__ . '/../layout/footer.php'; ?>