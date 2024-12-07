<?php
// Bắt đầu phiên làm việc
session_start();

// Tự động tải các lớp controller
spl_autoload_register(function ($class_name) {
    $paths = ['controllers/', 'models/', 'config/'];
    foreach ($paths as $path) {
        $file = $path . $class_name . '.php';
        if (file_exists($file)) {
            require_once $file;
            return;
        }
    }
});

// Lấy controller và action từ URL
$controller = isset($_GET['controller']) ? $_GET['controller'] : 'home';
$action = isset($_GET['action']) ? $_GET['action'] : 'index';

// Tạo tên lớp controller
$controllerName = ucfirst($controller) . 'Controller';

// Kiểm tra xem lớp controller có tồn tại không
if (class_exists($controllerName)) {
    $controllerObject = new $controllerName();
    if (method_exists($controllerObject, $action)) {
        // Lấy các tham số bổ sung từ $_GET, loại bỏ 'controller' và 'action'
        $params = $_GET;
        unset($params['controller']);
        unset($params['action']);
        
        // Chuyển các giá trị tham số thành mảng có chỉ số số học
        $params = array_values($params);
        
        // Gọi phương thức với các tham số
        call_user_func_array([$controllerObject, $action], $params);
    } else {
        echo "Action không tồn tại.";
    }
} else {
    echo "Controller không tồn tại.";
}
?>
