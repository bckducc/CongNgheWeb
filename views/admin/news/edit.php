<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Sửa Tin Tức - Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <?php include 'views/includes/admin_navbar.php'; ?>
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
    <?php include 'views/includes/footer.php'; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
