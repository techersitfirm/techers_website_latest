<?php

namespace App\Models;

use App\Core\Database;
use PDO;

class TestimonialModel
{
    private PDO $db;

    public function __construct()
    {
        $this->db = Database::getConnection();
    }

    /**
     * Get all testimonials
     */
    public function getAll(): array
    {
        $stmt = $this->db->query("
            SELECT
                ID,
                name,
                type,
                ProfilePic,
                status,
                content
            FROM techers_testimonial
            ORDER BY ID DESC
        ");

        return $stmt->fetchAll();
    }

    /**
     * Get testimonial by ID
     */
    public function findById(int $id): ?array
    {
        $stmt = $this->db->prepare("
            SELECT
                ID,
                name,
                type,
                ProfilePic,
                status,
                content
            FROM techers_testimonial
            WHERE ID = ?
            LIMIT 1
        ");

        $stmt->execute([$id]);

        return $stmt->fetch() ?: null;
    }

    /**
     * Create testimonial
     */
    public function create(array $data): int
    {
        $stmt = $this->db->prepare("
            INSERT INTO techers_testimonial
            (
                name,
                type,
                ProfilePic,
                status,
                content
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
            $data['type'],
            $data['ProfilePic'],
            $data['status'],
            $data['content']
        ]);

        return (int) $this->db->lastInsertId();
    }

    /**
     * Update testimonial
     */
    public function update(int $id, array $data): bool
    {
        $sql = "
            UPDATE techers_testimonial
            SET
                name = ?,
                type = ?,
                status = ?,
                content = ?
        ";

        $params = [
            $data['name'],
            $data['type'],
            $data['status'],
            $data['content']
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
     * Toggle testimonial status
     */
    public function toggleStatus(int $id): bool
    {
        $stmt = $this->db->prepare("
            UPDATE techers_testimonial
            SET
                status = IF(status = 1, 0, 1)
            WHERE ID = ?
        ");

        return $stmt->execute([$id]);
    }

    /**
     * Delete testimonial
     */
    public function delete(int $id): bool
    {
        $stmt = $this->db->prepare("
            DELETE FROM techers_testimonial
            WHERE ID = ?
        ");

        return $stmt->execute([$id]);
    }
}