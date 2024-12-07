<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="index.php">TluNews</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" 
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <?php
                // Optionally, list categories in the navbar
                require_once 'models/Category.php';
                $categoryModel = new Category();
                $categories = $categoryModel->getAll();
                foreach ($categories as $category):
                ?>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?controller=home&action=index&category=<?= $category['id'] ?>">
                            <?= htmlspecialchars($category['name']) ?>
                        </a>
                    </li>
                <?php endforeach; ?>
                <li class="nav-item">
                    <form class="d-flex" method="GET" action="index.php">
                        <input type="hidden" name="controller" value="home">
                        <input type="hidden" name="action" value="search">
                        <input class="form-control me-2" type="search" placeholder="Tìm kiếm" aria-label="Search" name="keyword">
                        <button class="btn btn-outline-success" type="submit">Tìm</button>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</nav>
