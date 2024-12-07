<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/BTTH02/config/database.php';
class News {
    private $db;

    public function __construct() {
        $this->db = Database::connect();
    }

    public function getAll() {
        $stmt = $this->db->query("SELECT news.*, categories.name AS category_name FROM news LEFT JOIN categories ON news.category_id = categories.id ORDER BY created_at DESC");
        return $stmt->fetchAll();
    }

    public function getById($id) {
        $stmt = $this->db->prepare("SELECT news.*, categories.name AS category_name FROM news LEFT JOIN categories ON news.category_id = categories.id WHERE news.id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public function search($keyword) {
        $stmt = $this->db->prepare("SELECT news.*, categories.name AS category_name FROM news LEFT JOIN categories ON news.category_id = categories.id WHERE news.title LIKE ? OR news.content LIKE ? ORDER BY created_at DESC");
        $stmt->execute(['%'.$keyword.'%', '%'.$keyword.'%']);
        return $stmt->fetchAll();
    }

    public function create($title, $content, $image, $category_id) {
        $stmt = $this->db->prepare("INSERT INTO news (title, content, image, category_id) VALUES (?, ?, ?, ?)");
        return $stmt->execute([$title, $content, $image, $category_id]);
    }

    public function update($id, $title, $content, $image, $category_id) {
        $stmt = $this->db->prepare("UPDATE news SET title = ?, content = ?, image = ?, category_id = ? WHERE id = ?");
        return $stmt->execute([$title, $content, $image, $category_id, $id]);
    }

    public function delete($id) {
        $stmt = $this->db->prepare("DELETE FROM news WHERE id = ?");
        return $stmt->execute([$id]);
    }
}
?>
