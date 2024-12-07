<?php
// Sử dụng class Database để kết nối cơ sở dữ liệu
require_once '../../../config/Database.php'; // Đảm bảo đường dẫn chính xác

// Kết nối cơ sở dữ liệu thông qua Database class
$pdo = Database::connect();

// Truy vấn dữ liệu tin tức
$query = "SELECT n.id, n.title, n.created_at, c.name as category_name 
          FROM news n 
          JOIN categories c ON n.category_id = c.id";
$stmt = $pdo->prepare($query);
$stmt->execute();

// Lấy tất cả tin tức
$news = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Quản Lý Tin Tức - Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<?php include '../../includes/admin_navbar.php'; ?>
    <div class="container mt-5">
        <h1>Quản Lý Tin Tức</h1>
        <a href="add.php" class="btn btn-success mb-3">Thêm Tin Tức Mới</a> <!-- Thêm liên kết đến trang thêm tin tức -->
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Tiêu Đề</th>
                    <th>Danh Mục</th>
                    <th>Ngày Tạo</th>
                    <th>Hành Động</th>
                </tr>
            </thead>
            <tbody>
    <?php if (isset($news) && !empty($news)): ?>
        <?php foreach ($news as $item): ?>
            <tr>
                <td><?= $item['id'] ?></td>
                <td><?= htmlspecialchars($item['title']) ?></td>
                <td><?= htmlspecialchars($item['category_name']) ?></td>
                <td><?= date('d/m/Y H:i', strtotime($item['created_at'])) ?></td>
                <td>
                <a href="edit.php?id=<?= $item['id'] ?>" class="btn btn-primary btn-sm">Sửa</a>

                    <a href="index.php?controller=admin&action=deleteNews&id=<?= $item['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Bạn có chắc muốn xóa?')">Xóa</a>
                </td>
            </tr>
        <?php endforeach; ?>
    <?php else: ?>
        <tr>
            <td colspan="5">Không có tin tức nào.</td>
        </tr>
    <?php endif; ?>
</tbody>
        </table>
    </div>
    <?php include '../../includes/footer.php'; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
