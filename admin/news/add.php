<?php
// Sử dụng class Database để kết nối cơ sở dữ liệu
require_once '../../../config/Database.php'; // Đảm bảo đường dẫn chính xác

// Kết nối cơ sở dữ liệu thông qua Database class
$pdo = Database::connect();

// Lấy danh sách các danh mục từ cơ sở dữ liệu
$query = "SELECT id, name FROM categories";
$stmt = $pdo->prepare($query);
$stmt->execute();
$categories = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Xử lý khi người dùng gửi form
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Lấy thông tin từ form
    $title = $_POST['title'];
    $category_id = $_POST['category_id'];
    $content = $_POST['content'];

    // Xử lý upload hình ảnh
    $image = null;
    if (isset($_FILES['image']) && $_FILES['image']['error'] == UPLOAD_ERR_OK) {
        $image_tmp = $_FILES['image']['tmp_name'];
        $image_name = time() . '-' . $_FILES['image']['name'];
        $image_path = 'uploads/' . $image_name; // Đảm bảo thư mục uploads đã tồn tại
        move_uploaded_file($image_tmp, $image_path);
        $image = $image_path;
    }

    // Chèn dữ liệu vào bảng news
    $query = "INSERT INTO news (title, category_id, content, image, created_at) 
              VALUES (:title, :category_id, :content, :image, NOW())";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':title', $title);
    $stmt->bindParam(':category_id', $category_id);
    $stmt->bindParam(':content', $content);
    $stmt->bindParam(':image', $image);
    $stmt->execute();

    // Chuyển hướng về trang danh sách tin tức
    header('Location: index.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Thêm Tin Tức Mới - Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <?php include '../../includes/admin_navbar.php'; ?>
    <div class="container mt-5">
        <h1>Thêm Tin Tức Mới</h1>
        <form method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="title" class="form-label">Tiêu Đề</label>
                <input type="text" class="form-control" id="title" name="title" required>
            </div>
            <div class="mb-3">
                <label for="category_id" class="form-label">Danh Mục</label>
                <select class="form-select" id="category_id" name="category_id" required>
                    <option value="">-- Chọn Danh Mục --</option>
                    <?php foreach ($categories as $category): ?>
                        <option value="<?= $category['id'] ?>"><?= htmlspecialchars($category['name']) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="image" class="form-label">Hình Ảnh</label>
                <input type="file" class="form-control" id="image" name="image" accept="image/*">
            </div>
            <div class="mb-3">
                <label for="content" class="form-label">Nội Dung</label>
                <textarea class="form-control" id="content" name="content" rows="10" required></textarea>
            </div>
            <button type="submit" class="btn btn-success">Thêm Tin Tức</button>
        </form>
    </div>
    <?php include '../../includes/footer.php'; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
