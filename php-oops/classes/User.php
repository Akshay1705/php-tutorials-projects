<?php
require_once __DIR__ . '/../config/db.php';

class User {
    private $conn;

    public function __construct() {
        $db = new Database();
        $this->conn = $db->connect();
    }

    public function getAllUsers() {
        $sql = "SELECT * FROM users";
        return $this->conn->query($sql);
    }

    public function getUser($id) {
        $sql = "SELECT * FROM users WHERE id=$id";
        return $this->conn->query($sql)->fetch_assoc();
    }

    public function addUser($name, $email) {
        $stmt = $this->conn->prepare("INSERT INTO users(name, email) VALUES (?, ?)");
        $stmt->bind_param("ss", $name, $email);
        return $stmt->execute();
    }

    public function updateUser($id, $name, $email) {
        $stmt = $this->conn->prepare("UPDATE users SET name=?, email=? WHERE id=?");
        $stmt->bind_param("ssi", $name, $email, $id);
        return $stmt->execute();
    }

    public function deleteUser($id) {
        $stmt = $this->conn->prepare("DELETE FROM users WHERE id=?");
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }
}
