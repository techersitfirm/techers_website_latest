<?php

namespace app\models;

use app\core\Database;
use PDO;

class PermissionModel
{
    private PDO $db;

    public function __construct()
    {
        $this->db = Database::getConnection();
    }

    public function getAll(): array
    {
        $stmt = $this->db->query("
            SELECT *
            FROM permissions
            ORDER BY module ASC, name ASC
        ");

        return $stmt->fetchAll();
    }

    public function getActive(): array
    {
        $stmt = $this->db->query("
            SELECT *
            FROM permissions
            WHERE is_active = 1
            ORDER BY module ASC, name ASC
        ");

        return $stmt->fetchAll();
    }

    public function create(array $data): bool
    {
        $stmt = $this->db->prepare("
            INSERT INTO permissions
                (module, name, slug, description, is_active, created_at)
            VALUES
                (?, ?, ?, ?, 1, NOW())
        ");

        return $stmt->execute([
            $data['module'],
            $data['name'],
            $data['slug'],
            $data['description'] ?: null
        ]);
    }

    public function toggleStatus(int $id): bool
    {
        $stmt = $this->db->prepare("
            UPDATE permissions
            SET is_active = CASE WHEN is_active = 1 THEN 0 ELSE 1 END,
                updated_at = NOW()
            WHERE id = ?
        ");

        return $stmt->execute([$id]);
    }
}
