<?php
// Kết nối cơ sở dữ liệu
require_once '../../../config/Database.php';

// Kiểm tra xem có id của tin tức được truyền qua URL hay không
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $news_id = $_GET['id'];
    
    // Kết nối cơ sở dữ liệu
    $pdo = Database::connect();
    
    // Truy vấn thông tin tin tức cần sửa
    $query = "SELECT * FROM news WHERE id = ?";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$news_id]);
    $news = $stmt->fetch(PDO::FETCH_ASSOC);

    // Nếu không có tin tức nào thì chuyển hướng về trang danh sách tin tức
    if (!$news) {
        header('Location: index.php');
        exit();
    }

    // Lấy danh sách các danh mục
    $query_categories = "SELECT * FROM categories";
    $stmt_categories = $pdo->prepare($query_categories);
    $stmt_categories->execute();
    $categories = $stmt_categories->fetchAll(PDO::FETCH_ASSOC);

    // Xử lý khi người dùng submit form
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $title = $_POST['title'];
        $category_id = $_POST['category_id'];
        $content = $_POST['content'];
        $image_path = $news['image']; // Giữ nguyên ảnh cũ

        // Kiểm tra nếu có file ảnh mới
        if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            // Xóa ảnh cũ nếu có
            if (file_exists($image_path)) {
                unlink($image_path);
            }

            // Lưu ảnh mới
            $image_tmp = $_FILES['image']['tmp_name'];
            $image_name = $_FILES['image']['name'];
            $image_path = 'uploads/' . $image_name;
            move_uploaded_file($image_tmp, $image_path);
        }

        // Cập nhật thông tin tin tức
        $query_update = "UPDATE news SET title = ?, category_id = ?, content = ?, image = ? WHERE id = ?";
        $stmt_update = $pdo->prepare($query_update);
        $stmt_update->execute([$title, $category_id, $content, $image_path, $news_id]);

        // Chuyển hướng về trang danh sách tin tức
        header('Location: index.php');
        exit();
    }
} else {
    // Nếu không có id thì chuyển hướng về trang danh sách tin tức
    header('Location: index.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Sửa Tin Tức - Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<?php include '../../includes/admin_navbar.php'; ?>

    <div class="container mt-5">
        <h1>Sửa Tin Tức</h1>
        <form method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="title" class="form-label">Tiêu Đề</label>
                <input type="text" class="form-control" id="title" name="title" value="<?= htmlspecialchars($news['title']) ?>" required>
            </div>
            <div class="mb-3">
                <label for="category_id" class="form-label">Danh Mục</label>
                <select class="form-select" id="category_id" name="category_id" required>
                    <option value="">-- Chọn Danh Mục --</option>
                    <?php foreach ($categories as $category): ?>
                        <option value="<?= $category['id'] ?>" <?= ($news['category_id'] == $category['id']) ? 'selected' : '' ?>>
                            <?= htmlspecialchars($category['name']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <?php if ($news['image']): ?>
                <div class="mb-3">
                    <label class="form-label">Hình Ảnh Hiện Tại</label><br>
                    <img src="<?= $news['image'] ?>" alt="<?= htmlspecialchars($news['title']) ?>" class="img-thumbnail" width="200">
                </div>
            <?php endif; ?>
            <div class="mb-3">
                <label for="image" class="form-label">Thay Đổi Hình Ảnh</label>
                <input type="file" class="form-control" id="image" name="image" accept="image/*">
            </div>
            <div class="mb-3">
                <label for="content" class="form-label">Nội Dung</label>
                <textarea class="form-control" id="content" name="content" rows="10" required><?= htmlspecialchars($news['content']) ?></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Cập Nhật Tin Tức</button>
        </form>
    </div>
    <?php include '../../includes/footer.php'; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
