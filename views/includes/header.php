<?php
// views/includes/header.php
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?= isset($pageTitle) ? htmlspecialchars($pageTitle) : 'TluNews' ?></title>

    <!-- Link đến các tệp CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
   
    

    <style>
        
    </style>
</head>
<body>

<!-- Phần header -->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="/index.php">TluNews</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" 
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="/admin/dashboard">Trang Quản Trị</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/admin/news">Quản lý Tin Tức</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/admin/logout">Đăng Xuất</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="/path/to/your/custom/script.js"></script>
</body>
</html>
<!-- Đặt thêm các phần tử HTML cho header ở đây nếu cần -->
