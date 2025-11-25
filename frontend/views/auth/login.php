<?php
declare(strict_types=1);
require ROOT_PATH . '/frontend/views/layout/header.php';
require ROOT_PATH . '/frontend/views/layout/navbar.php';
?>

<div class="auth-wrapper" style="background: #fff; min-height: 80vh; align-items: flex-start; padding-top: 80px;">
  <div class="apple-login-box">
    
   <div class="apple-logo-login"><i class="fas fa-laptop"></i></div>
    
    <div id="step-username" class="login-step">
        <h1 class="auth-title" style="margin-bottom: 40px;">Đăng nhập vào Laptop Store</h1>
        
        <div class="input-wrapper">
            <input type="text" id="input-username" class="form-control" placeholder="Email hoặc Tên đăng nhập" style="padding-right: 40px; height: 56px; font-size: 17px;" autocomplete="off" onfocus="this.removeAttribute('readonly');" readonly>
            <button type="button" class="btn-arrow" onclick="nextStep()">
                <i class="fas fa-arrow-right"></i>
            </button>
        </div>

        <div style="margin-top: 20px; font-size: 14px; text-align: left; padding-left: 5px;">
            <label><input type="checkbox" name="remember" value="1" form="login-form"> Lưu tôi</label>
        </div>
        <div style="margin-top: 30px; font-size: 14px;">
            <a href="#" style="color: #0071e3;">Bạn đã quên mật khẩu?</a> <br><br>
            Bạn không có tài khoản? <a href="/WEBSITE_BANLAPTOP/register" style="color: #0071e3;">Tạo tài khoản ngay</a>
        </div>
    </div>

    <div id="step-password" style="display: none;">
        <h1 class="auth-title" style="margin-bottom: 10px;">Nhập mật khẩu</h1>
        
        <div class="user-preview" onclick="prevStep()" title="Quay lại">
            <span id="display-username">user@example.com</span> <i class="fas fa-edit" style="font-size: 14px; color: #0071e3;"></i>
        </div>

        <form action="/WEBSITE_BANLAPTOP/auth/login" method="POST" autocomplete="off" id="login-form">
            <input type="hidden" name="username" id="hidden-username">
            <div class="form-group">
                <input type="password" name="password" id="input-pass" class="form-control" placeholder="Mật khẩu" style="height: 56px;">
            </div>
            <button type="submit" class="btn btn-primary btn-block" style="border-radius: 12px; margin-top: 20px;">Đăng nhập</button>
        </form>
        
        <div style="text-align: center; margin: 25px 0 15px; color: #86868b; font-size: 13px;">HOẶC TIẾP TỤC VỚI</div>
        
        <a href="/WEBSITE_BANLAPTOP/google-login" class="btn btn-outline" style="width: 100%; border: 1px solid #d2d2d7; color: #1d1d1f; padding: 12px; font-size: 17px; border-radius: 12px; display: flex; align-items: center; justify-content: center; gap: 10px; text-decoration: none;">
            <img src="https://upload.wikimedia.org/wikipedia/commons/c/c1/Google_%22G%22_logo.svg" width="20" height="20">
            <span>Đăng nhập bằng Google</span>
        </a>
        
        <div style="margin-top: 25px;">
            <a href="#" onclick="prevStep()" style="color: #0071e3; font-size: 14px;">Quay lại bước trước</a>
        </div>
    </div>

  </div>
</div>

<script>
    function nextStep() {
        var userVal = document.getElementById('input-username').value;
        if(userVal.trim() === "") { alert("Vui lòng nhập Email hoặc tên đăng nhập!"); return; }
        document.getElementById('display-username').innerText = userVal;
        document.getElementById('hidden-username').value = userVal;
        document.getElementById('step-username').style.display = 'none';
        var step2 = document.getElementById('step-password');
        step2.style.display = 'block';
        setTimeout(function(){
            step2.style.opacity = '1';
            step2.style.transform = 'translateY(0)';
            document.getElementById('input-pass').focus();
        }, 50);
    }
    function prevStep() {
        document.getElementById('step-password').style.display = 'none';
        document.getElementById('step-password').style.opacity = '0';
        document.getElementById('step-username').style.display = 'block';
    }
    document.getElementById('input-username').addEventListener("keypress", function(event) {
        if (event.key === "Enter") { event.preventDefault(); nextStep(); }
    });
</script>

<?php require ROOT_PATH . '/frontend/views/layout/footer.php'; ?>