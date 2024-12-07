<?php
require_once 'models/News.php';
require_once 'models/Category.php';

class HomeController {
    public function index() {
        $newsModel = new News();
        $categoryModel = new Category();
        $news = $newsModel->getAll();
        $categories = $categoryModel->getAll();
        include 'views/home/index.php';
    }

    public function search() {
        if (isset($_GET['keyword'])) {
            $keyword = $_GET['keyword'];
            $newsModel = new News();
            $news = $newsModel->search($keyword);
            include 'views/home/search.php';
        } else {
            header('Location: index.php');
        }
    }
}
?>
