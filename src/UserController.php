<?php
namespace App;

class UserController {
    private \PDO $db;

    public function __construct() {
        $this->db = new \PDO("mysql:host=mysql;port=3306;dbname=cruddb", "root", "root");
    }

    public function getAllUsers(): string {
        $stmt = $this->db->query("SELECT * FROM users");
        return json_encode($stmt->fetchAll(\PDO::FETCH_ASSOC));
    }

    public function getUser(int $id): string {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE id = ?");
        $stmt->execute([$id]);
        return json_encode($stmt->fetch(\PDO::FETCH_ASSOC));
    }

    public function createUser(string $name, string $email): string {
        $stmt = $this->db->prepare("INSERT INTO users (name, email) VALUES (?, ?)");
        $stmt->execute([$name, $email]);
        return json_encode(["id" => $this->db->lastInsertId(), "name" => $name, "email" => $email]);
    }

    public function updateUser(int $id, string $name, string $email): string {
        $stmt = $this->db->prepare("UPDATE users SET name = ?, email = ? WHERE id = ?");
        $stmt->execute([$name, $email, $id]);
        return json_encode(["id" => $id, "name" => $name, "email" => $email]);
    }

    public function deleteUser(int $id): string {
        $stmt = $this->db->prepare("DELETE FROM users WHERE id = ?");
        $stmt->execute([$id]);
        return json_encode(["deleted" => true, "id" => $id]);
    }
}
