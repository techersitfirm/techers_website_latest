<?php

namespace app\models;

use app\core\Database;
use PDO;

class UserTypeModel
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
            FROM user_types
            ORDER BY id ASC
        ");

        return $stmt->fetchAll();
    }

    public function getActive(): array
    {
        $stmt = $this->db->query("
            SELECT *
            FROM user_types
            WHERE is_active = 1
            ORDER BY id ASC
        ");

        return $stmt->fetchAll();
    }

    public function findById(int $id): ?array
    {
        $stmt = $this->db->prepare("
            SELECT *
            FROM user_types
            WHERE id = ?
            LIMIT 1
        ");

        $stmt->execute([$id]);

        return $stmt->fetch() ?: null;
    }

    public function create(array $data): bool
    {
        $stmt = $this->db->prepare("
            INSERT INTO user_types
                (name, slug, description, is_active, created_at)
            VALUES
                (?, ?, ?, 1, NOW())
        ");

        return $stmt->execute([
            $data['name'],
            $data['slug'],
            $data['description'] ?: null
        ]);
    }

    public function update(int $id, array $data): bool
    {
        $stmt = $this->db->prepare("
            UPDATE user_types
            SET name = ?,
                slug = ?,
                description = ?,
                is_active = ?,
                updated_at = NOW()
            WHERE id = ?
        ");

        return $stmt->execute([
            $data['name'],
            $data['slug'],
            $data['description'] ?: null,
            (int) $data['is_active'],
            $id
        ]);
    }

    public function permissionIds(int $userTypeId): array
    {
        $stmt = $this->db->prepare("
            SELECT permission_id
            FROM user_type_permissions
            WHERE user_type_id = ?
            AND is_active = 1
            AND removed_at IS NULL
        ");

        $stmt->execute([$userTypeId]);

        return array_map('intval', $stmt->fetchAll(PDO::FETCH_COLUMN));
    }

    public function syncPermissions(int $userTypeId, array $permissionIds, ?int $adminId): bool
    {
        $this->db->beginTransaction();

        try {
            $remove = $this->db->prepare("
                UPDATE user_type_permissions
                SET is_active = 0,
                    removed_at = NOW(),
                    removed_by = ?,
                    updated_at = NOW()
                WHERE user_type_id = ?
                AND is_active = 1
                AND removed_at IS NULL
            ");
            $remove->execute([$adminId, $userTypeId]);

            $insert = $this->db->prepare("
                INSERT INTO user_type_permissions
                    (user_type_id, permission_id, is_active, assigned_by, created_at)
                VALUES
                    (?, ?, 1, ?, NOW())
                ON DUPLICATE KEY UPDATE
                    is_active = 1,
                    assigned_by = VALUES(assigned_by),
                    removed_at = NULL,
                    removed_by = NULL,
                    updated_at = NOW()
            ");

            foreach ($permissionIds as $permissionId) {
                $insert->execute([$userTypeId, (int) $permissionId, $adminId]);
            }

            $this->db->commit();

            return true;
        } catch (\Throwable $e) {
            $this->db->rollBack();

            return false;
        }
    }
}
