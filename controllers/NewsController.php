<?php
require_once 'models/News.php';
require_once 'models/Category.php';

class NewsController {
    public function detail($id) {
        $newsModel = new News();
        $categoryModel = new Category();
        $news = $newsModel->getById($id);
        $categories = $categoryModel->getAll();
        include 'views/news/detail.php';
    }
}
?>
