<?php

namespace App\Repository;

use App\Config\Database;
use App\Interface\Service;
use App\Model\Item;

class ItemRepository implements Service
{
    private ?\PDO $db;

    public function __construct()
    {
        $database = new Database();
        $this->db = $database->getConnection();
    }

    public function index(): array|string
    {
        try {
            $query = "SELECT * FROM items";
            $stmt = $this->db->prepare($query);
            $stmt->execute();

            $items = [];
            while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
                $items[] = new Item($row['id'], $row['name'], $row['description']);
            }

            return $items;
        } catch (\PDOException $e) {
            return $e->getMessage();
        }
    }

    public function show($id): object|string
    {
        try {
            $query = "SELECT * FROM items WHERE id = :id";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':id', $id);
            $stmt->execute();

            $row = $stmt->fetch(\PDO::FETCH_ASSOC);
            return new Item($row['id'], $row['name'], $row['description']);
        } catch (\PDOException $e) {
            return $e->getMessage();
        }
    }

    public function store($data): bool|string
    {
        try {
            $query = "INSERT INTO items (name, description) VALUES (:name, :description)";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':name', $data->name);
            $stmt->bindParam(':description', $data->description);

            return $stmt->execute();
        } catch (\PDOException $e) {
            return $e->getMessage();
        }
    }

    public function update($id, $data): bool|string
    {
        try {
            $query = "UPDATE items SET name = :name, description = :description WHERE id = :id";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':id', $id);
            $stmt->bindParam(':name', $data->name);
            $stmt->bindParam(':description', $data->description);

            return $stmt->execute();
        } catch (\PDOException $e) {
            return $e->getMessage();
        }
    }

    public function destroy($id): bool|string
    {
        try {
            $query = "DELETE FROM items WHERE id = :id";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':id', $id);

            return $stmt->execute();
        } catch (\PDOException $e) {
            return $e->getMessage();
        }
    }
}