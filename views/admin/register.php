<?php
// views/admin/register.php
$pageTitle = 'Đăng Ký Quản Trị Viên';
include 'views/layout/header.php';
?>

<div class="container mt-5">
    <h2 class="text-center">Đăng Ký Quản Trị Viên</h2>
    <form action="/admin/register" method="post" class="mt-4">
        <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($_SESSION['csrf_token']) ?>">
        <div class="form-group">
            <label for="username">Tên đăng nhập</label>
            <input type="text" class="form-control" id="username" name="username" required autofocus>
        </div>
        <div class="form-group">
            <label for="password">Mật khẩu</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>
        <div class="form-group">
            <label for="confirm_password">Xác nhận mật khẩu</label>
            <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
        </div>
        <button type="submit" class="btn btn-primary btn-block">Đăng Ký</button>
    </form>
    <p class="text-center mt-3">Bạn đã có tài khoản? <a href="/admin/login">Đăng nhập ngay</a></p>
</div>

<?php include 'views/layout/footer.php'; ?>
