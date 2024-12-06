<?php
require_once 'models/User.php';
require_once 'models/News.php';
require_once 'models/Category.php';

class AdminController {
    public function login() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $username = $_POST['username'];
            $password = md5($_POST['password']);

            $userModel = new User();
            $user = $userModel->findByUsername($username);

            if ($user && $user['password'] == $password && $user['role'] == 1) {
                session_start();
                $_SESSION['user'] = $user;
                header('Location: index.php?controller=admin&action=dashboard');
                exit();
            } else {
                $error = "Tên đăng nhập hoặc mật khẩu không đúng.";
            }
        }
        include 'views/admin/login.php';
    }

    public function logout() {
        session_start();
        session_destroy();
        header('Location: index.php?controller=admin&action=login');
        exit();
    }

    public function dashboard() {
        $this->checkLogin();
        include 'views/admin/dashboard.php';
    }

    public function newsList() {
        $this->checkLogin();
        $newsModel = new News();
        $news = $newsModel->getAll();
        include 'views/admin/news/index.php';
    }

    public function addNews() {
        $this->checkLogin();
        $categoryModel = new Category();
        $categories = $categoryModel->getAll();

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $title = $_POST['title'];
            $content = $_POST['content'];
            $category_id = $_POST['category_id'];
            
            // Handle image upload
            if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
                $image = 'assets/images/' . basename($_FILES['image']['name']);
                move_uploaded_file($_FILES['image']['tmp_name'], $image);
            } else {
                $image = '';
            }

            $newsModel = new News();
            $newsModel->create($title, $content, $image, $category_id);
            header('Location: index.php?controller=admin&action=newsList');
            exit();
        }

        include 'views/admin/news/add.php';
    }

    public function editNews() {
        $this->checkLogin();
        $newsModel = new News();
        $categoryModel = new Category();
        $categories = $categoryModel->getAll();

        if (!isset($_GET['id'])) {
            header('Location: index.php?controller=admin&action=newsList');
            exit();
        }

        $id = $_GET['id'];
        $news = $newsModel->getById($id);

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $title = $_POST['title'];
            $content = $_POST['content'];
            $category_id = $_POST['category_id'];
            
            // Handle image upload
            if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
                $image = 'assets/images/' . basename($_FILES['image']['name']);
                move_uploaded_file($_FILES['image']['tmp_name'], $image);
            } else {
                $image = $news['image'];
            }

            $newsModel->update($id, $title, $content, $image, $category_id);
            header('Location: index.php?controller=admin&action=newsList');
            exit();
        }

        include 'views/admin/news/edit.php';
    }

    public function deleteNews() {
        $this->checkLogin();
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $newsModel = new News();
            $newsModel->delete($id);
        }
        header('Location: index.php?controller=admin&action=newsList');
        exit();
    }

    private function checkLogin() {
        session_start();
        if (!isset($_SESSION['user']) || $_SESSION['user']['role'] != 1) {
            header('Location: index.php?controller=admin&action=login');
            exit();
        }
    }
}
?>
