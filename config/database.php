<?php
class Database {
    private static $instance = null;
    private $conn;

<<<<<<< HEAD
    private $host = 'localhost';
=======
    private $host = '127.0.0.1';
>>>>>>> 329e451 (cap nhat vao main)
    private $db = 'tintuc';
    private $user = 'root';
    private $pass = '';
    private $charset = 'utf8mb4';

    private function __construct() {
        $dsn = "mysql:host=$this->host;dbname=$this->db;charset=$this->charset";
        $options = [
<<<<<<< HEAD
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
=======
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
>>>>>>> 329e451 (cap nhat vao main)
        ];
        try {
            $this->conn = new PDO($dsn, $this->user, $this->pass, $options);
        } catch (PDOException $e) {
<<<<<<< HEAD
            die('Connection failed: ' . $e->getMessage());
=======
            error_log('Database connection error: ' . $e->getMessage());
            throw new Exception('Lỗi kết nối cơ sở dữ liệu');
>>>>>>> 329e451 (cap nhat vao main)
        }
    }

    public static function connect() {
        if (self::$instance === null) {
            self::$instance = new Database();
        }
        return self::$instance->conn;
    }
}
<<<<<<< HEAD
?>
=======
?>
>>>>>>> 329e451 (cap nhat vao main)
