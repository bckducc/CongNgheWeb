<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Kết Quả Tìm Kiếm - Tin Tức</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="./style.css">
</head>
<body>

    <?php include $_SERVER['DOCUMENT_ROOT'] . '/TechWeb/BTTH/BTTH02/views/includes/navbar.php'; ?>

    <div class="container mt-5">
        <h1>Kết Quả Tìm Kiếm</h1>
        <div class="row">
            <?php if ($news): ?>
                <?php foreach ($news as $item): ?>
                    <div class="col-md-4">
                        <div class="card mb-4">
                            <?php if($item['image']): ?>
                                <img src="<?= $item['image'] ?>" class="card-img-top" alt="<?= htmlspecialchars($item['title']) ?>">
                            <?php endif; ?>
                            <div class="card-body">
                                <h5 class="card-title"><?= htmlspecialchars($item['title']) ?></h5>
                                <p class="card-text"><small class="text-muted"><?= $item['category_name'] ?> | <?= date('d/m/Y H:i', strtotime($item['created_at'])) ?></small></p>
                                <a href="index.php?controller=news&action=detail&id=<?= $item['id'] ?>" class="btn btn-primary">Xem Chi Tiết</a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>Không tìm thấy tin tức nào.</p>
            <?php endif; ?>
        </div>
    </div>
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/TechWeb/BTTH/BTTH02/views/includes/footer.php'; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
