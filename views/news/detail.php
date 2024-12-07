<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title><?= htmlspecialchars($news['title']) ?> - Tin Tức</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <?php include 'views/includes/navbar.php'; ?>
    <div class="container mt-5">
        <h1><?= htmlspecialchars($news['title']) ?></h1>
        <p><small class="text-muted"><?= $news['category_name'] ?> | <?= date('d/m/Y H:i', strtotime($news['created_at'])) ?></small></p>
        <?php if($news['image']): ?>
            <img src="<?= $news['image'] ?>" class="img-fluid mb-4" alt="<?= htmlspecialchars($news['title']) ?>">
        <?php endif; ?>
        <div>
            <?= nl2br(htmlspecialchars($news['content'])) ?>
        </div>
    </div>
    <?php include 'views/includes/footer.php'; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
