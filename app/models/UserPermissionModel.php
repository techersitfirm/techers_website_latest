<?php

namespace App\Models;

use App\Core\Database;
use PDO;

class UserPermissionModel
{
    private PDO $db;

    public function __construct()
    {
        $this->db = Database::getConnection();
    }

    public function applyDefaultAccess(int $userId, int $userTypeId, ?int $adminId): bool
    {
        $this->db->beginTransaction();

        try {
            $removeOldDefaults = $this->db->prepare("
                UPDATE user_permissions
                SET is_active = 0,
                    removed_at = NOW(),
                    removed_by = ?,
                    updated_at = NOW()
                WHERE user_id = ?
                AND access_type = 'default'
                AND is_active = 1
                AND removed_at IS NULL
            ");
            $removeOldDefaults->execute([$adminId, $userId]);

            $defaultPermissions = $this->db->prepare("
                SELECT permission_id
                FROM user_type_permissions
                WHERE user_type_id = ?
                AND is_active = 1
                AND removed_at IS NULL
            ");
            $defaultPermissions->execute([$userTypeId]);

            $insert = $this->db->prepare("
                INSERT INTO user_permissions
                    (
                        user_id,
                        permission_id,
                        access_type,
                        activated_at,
                        expires_at,
                        is_active,
                        assigned_by,
                        created_at
                    )
                VALUES
                    (?, ?, 'default', NOW(), NULL, 1, ?, NOW())
            ");

            foreach ($defaultPermissions->fetchAll(PDO::FETCH_COLUMN) as $permissionId) {
                $insert->execute([$userId, (int) $permissionId, $adminId]);
            }

            $this->db->commit();

            return true;
        } catch (\Throwable $e) {
            $this->db->rollBack();

            return false;
        }
    }

    public function addOn(array $data): bool
    {
        $stmt = $this->db->prepare("
            INSERT INTO user_permissions
                (
                    user_id,
                    permission_id,
                    access_type,
                    activated_at,
                    expires_at,
                    is_active,
                    assigned_by,
                    created_at
                )
            VALUES
                (?, ?, 'addon', ?, ?, 1, ?, NOW())
        ");

        return $stmt->execute([
            $data['user_id'],
            $data['permission_id'],
            $data['activated_at'],
            $data['expires_at'] ?: null,
            $data['assigned_by']
        ]);
    }

    public function revoke(int $userId, int $permissionId, ?int $adminId): bool
    {
        $stmt = $this->db->prepare("
            INSERT INTO user_permissions
                (
                    user_id,
                    permission_id,
                    access_type,
                    activated_at,
                    expires_at,
                    is_active,
                    assigned_by,
                    created_at
                )
            VALUES
                (?, ?, 'revoked', NOW(), NULL, 1, ?, NOW())
        ");

        return $stmt->execute([$userId, $permissionId, $adminId]);
    }

    public function deactivate(int $id, ?int $adminId): bool
    {
        $stmt = $this->db->prepare("
            UPDATE user_permissions
            SET is_active = 0,
                removed_at = NOW(),
                removed_by = ?,
                updated_at = NOW()
            WHERE id = ?
        ");

        return $stmt->execute([$adminId, $id]);
    }

    public function extend(int $id, ?string $expiresAt): bool
    {
        $stmt = $this->db->prepare("
            UPDATE user_permissions
            SET expires_at = ?,
                updated_at = NOW()
            WHERE id = ?
            AND access_type = 'addon'
            AND is_active = 1
            AND removed_at IS NULL
        ");

        return $stmt->execute([$expiresAt ?: null, $id]);
    }
}
