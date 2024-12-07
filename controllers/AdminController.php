<?php
require_once 'models/User.php';
require_once 'models/News.php';
require_once 'models/Category.php';

class AdminController {
<<<<<<< HEAD
=======

    private function generateCSRFToken() {
        if (!isset($_SESSION['csrf_token'])) {
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        }
        return $_SESSION['csrf_token'];
    }

    private function validateCSRFToken($token) {
        return isset($_SESSION['csrf_token']) && hash_equals($_SESSION['csrf_token'], $token);
    }

>>>>>>> 329e451 (cap nhat vao main)
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
<<<<<<< HEAD
        session_destroy();
=======
        session_unset();  // Hủy tất cả các session
        session_destroy();  // Hủy session
>>>>>>> 329e451 (cap nhat vao main)
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
<<<<<<< HEAD
=======
        if (!$news) {
            $error = "Không có tin tức nào.";
        }
>>>>>>> 329e451 (cap nhat vao main)
        include 'views/admin/news/index.php';
    }

    public function addNews() {
        $this->checkLogin();
        $categoryModel = new Category();
        $categories = $categoryModel->getAll();

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
<<<<<<< HEAD
            $title = $_POST['title'];
            $content = $_POST['content'];
            $category_id = $_POST['category_id'];
            
            // Handle image upload
            if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
=======
            // Kiểm tra CSRF token
            if (!isset($_POST['csrf_token']) || !$this->validateCSRFToken($_POST['csrf_token'])) {
                die('Invalid CSRF token');
            }

            $title = $_POST['title'];
            $content = $_POST['content'];
            $category_id = $_POST['category_id'];

            // Kiểm tra upload ảnh
            if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
                $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
                $maxSize = 5 * 1024 * 1024; // 5MB

                if (!in_array($_FILES['image']['type'], $allowedTypes)) {
                    $error = "File phải là ảnh JPEG, PNG hoặc GIF.";
                }

                if ($_FILES['image']['size'] > $maxSize) {
                    $error = "Ảnh không được vượt quá 5MB.";
                }

>>>>>>> 329e451 (cap nhat vao main)
                $image = 'assets/images/' . basename($_FILES['image']['name']);
                move_uploaded_file($_FILES['image']['tmp_name'], $image);
            } else {
                $image = '';
            }

<<<<<<< HEAD
            $newsModel = new News();
            $newsModel->create($title, $content, $image, $category_id);
            header('Location: index.php?controller=admin&action=newsList');
            exit();
=======
            if (empty($error)) {
                $newsModel = new News();
                $newsModel->create($title, $content, $image, $category_id);
                header('Location: index.php?controller=admin&action=newsList');
                exit();
            }
        }

        // Tạo CSRF token nếu chưa có
        if (empty($_SESSION['csrf_token'])) {
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
>>>>>>> 329e451 (cap nhat vao main)
        }

        include 'views/admin/news/add.php';
    }

    public function editNews() {
        $this->checkLogin();
        $newsModel = new News();
        $categoryModel = new Category();
        $categories = $categoryModel->getAll();

<<<<<<< HEAD
        if (!isset($_GET['id'])) {
=======
        if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
>>>>>>> 329e451 (cap nhat vao main)
            header('Location: index.php?controller=admin&action=newsList');
            exit();
        }

        $id = $_GET['id'];
        $news = $newsModel->getById($id);

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
<<<<<<< HEAD
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
=======
            // Kiểm tra CSRF token
            if (!isset($_POST['csrf_token']) || !$this->validateCSRFToken($_POST['csrf_token'])) {
                die('Invalid CSRF token');
            }

            $title = $_POST['title'];
            $content = $_POST['content'];
            $category_id = $_POST['category_id'];

            // Kiểm tra upload ảnh
            if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
                $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
                $maxSize = 5 * 1024 * 1024; // 5MB

                if (!in_array($_FILES['image']['type'], $allowedTypes)) {
                    $error = "File phải là ảnh JPEG, PNG hoặc GIF.";
                }

                if ($_FILES['image']['size'] > $maxSize) {
                    $error = "Ảnh không được vượt quá 5MB.";
                }

                $image = 'assets/images/' . basename($_FILES['image']['name']);
                move_uploaded_file($_FILES['image']['tmp_name'], $image);
            } else {
                $image = $news['image'];  // Sử dụng ảnh cũ nếu không có ảnh mới
            }

            if (empty($error)) {
                $newsModel->update($id, $title, $content, $image, $category_id);
                header('Location: index.php?controller=admin&action=newsList');
                exit();
            }
>>>>>>> 329e451 (cap nhat vao main)
        }

        include 'views/admin/news/edit.php';
    }

    public function deleteNews() {
        $this->checkLogin();
<<<<<<< HEAD
        if (isset($_GET['id'])) {
=======

        if (isset($_GET['id']) && is_numeric($_GET['id'])) {
>>>>>>> 329e451 (cap nhat vao main)
            $id = $_GET['id'];
            $newsModel = new News();
            $newsModel->delete($id);
        }
<<<<<<< HEAD
=======

>>>>>>> 329e451 (cap nhat vao main)
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
<<<<<<< HEAD
=======

    public function register() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Kiểm tra CSRF token
            if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
                die('Invalid CSRF token');
            }

            $username = trim($_POST['username']);
            $password = $_POST['password'];
            $confirm_password = $_POST['confirm_password'];

            // Kiểm tra mật khẩu
            if ($password !== $confirm_password) {
                $error = "Mật khẩu không khớp.";
            } else {
                if (strlen($password) < 6) {
                    $error = "Mật khẩu phải có ít nhất 6 ký tự.";
                }

                $userModel = new User();
                // Kiểm tra xem tên đăng nhập đã tồn tại chưa
                if ($userModel->findByUsername($username)) {
                    $error = "Tên đăng nhập đã tồn tại.";
                } else {
                    $userModel->create($username, md5($password), 1); // role = 1 cho admin
                    header('Location: index.php?controller=admin&action=login');
                    exit();
                }
            }
        }

        // Tạo CSRF token nếu chưa tồn tại
        if (empty($_SESSION['csrf_token'])) {
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        }

        include 'views/admin/register.php';
    }
>>>>>>> 329e451 (cap nhat vao main)
}
?>
