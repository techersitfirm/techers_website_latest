<?php

namespace app\models;

use app\core\Database;
use PDO;

class ProjectModel
{
    private PDO $db;

    public function __construct()
    {
        $this->db = Database::getConnection();
    }

    /**
     * Get all projects
     */
    public function getAll(): array
    {
        $stmt = $this->db->query("
            SELECT
                ID,
                name,
                project_type,
                ProfilePic,
                status,
                link
            FROM projects
            ORDER BY ID DESC
        ");

        return $stmt->fetchAll();
    }

    /**
     * Find project by ID
     */
    public function findById(int $id): ?array
    {
        $stmt = $this->db->prepare("
            SELECT
                ID,
                name,
                project_type,
                ProfilePic,
                status,
                link
            FROM projects
            WHERE ID = ?
            LIMIT 1
        ");

        $stmt->execute([$id]);

        return $stmt->fetch() ?: null;
    }

    /**
     * Create project
     */
    public function create(array $data): int
    {
        $stmt = $this->db->prepare("
            INSERT INTO projects
            (
                name,
                project_type,
                ProfilePic,
                status,
                link
            )
            VALUES
            (
                ?,
                ?,
                ?,
                ?,
                ?
            )
        ");

        $stmt->execute([
            $data['name'],
            $data['project_type'],
            $data['ProfilePic'],
            $data['status'],
            $data['link']
        ]);

        return (int) $this->db->lastInsertId();
    }

    /**
     * Update project
     */
    public function update(int $id, array $data): bool
    {
        $sql = "
            UPDATE projects
            SET
                name = ?,
                project_type = ?,
                status = ?,
                link = ?
        ";

        $params = [
            $data['name'],
            $data['project_type'],
            $data['status'],
            $data['link']
        ];

        if (
            isset($data['ProfilePic']) &&
            $data['ProfilePic'] !== ''
        ) {
            $sql .= ",
                ProfilePic = ?
            ";

            $params[] = $data['ProfilePic'];
        }

        $sql .= "
            WHERE ID = ?
        ";

        $params[] = $id;

        $stmt = $this->db->prepare($sql);

        return $stmt->execute($params);
    }

    /**
     * Toggle project status
     */
    public function toggleStatus(int $id): bool
    {
        $stmt = $this->db->prepare("
            UPDATE projects
            SET
                status = IF(status = 1, 0, 1)
            WHERE ID = ?
        ");

        return $stmt->execute([$id]);
    }

    /**
     * Delete project
     */
    public function delete(int $id): bool
    {
        $stmt = $this->db->prepare("
            DELETE FROM projects
            WHERE ID = ?
        ");

        return $stmt->execute([$id]);
    }
}