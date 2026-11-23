<?php

namespace app\services;

use app\core\Database;
use PDO;

class PermissionService
{
    private const IMPLIED_PERMISSIONS = [
        'team.manage' => [
            'team.view',
            'team.create',
            'team.edit',
            'team.remove',
        ],
    ];

    private PDO $db;

    public function __construct()
    {
        $this->db = Database::getConnection();
    }

    public function effectiveForUser(int $userId): array
    {
        $permissions = [];

        foreach ($this->validUserTypePermissions($userId) as $permission) {
            $permissions[$permission['slug']] = $permission;
        }

        foreach ($this->validUserPermissions($userId, 'addon') as $permission) {
            $permissions[$permission['slug']] = $permission;
        }

        $permissions = $this->withImpliedPermissions($permissions);

        foreach ($this->activeRevokedPermissions($userId) as $permission) {
            unset($permissions[$permission['slug']]);
        }

        return array_values($permissions);
    }

    public function userHas(int $userId, string $slug): bool
    {
        foreach ($this->effectiveForUser($userId) as $permission) {
            if ($permission['slug'] === $slug) {
                return true;
            }
        }

        return false;
    }

    private function withImpliedPermissions(array $permissions): array
    {
        $impliedSlugs = [];

        foreach (array_keys($permissions) as $slug) {
            foreach (self::IMPLIED_PERMISSIONS[$slug] ?? [] as $impliedSlug) {
                if (!isset($permissions[$impliedSlug])) {
                    $impliedSlugs[$impliedSlug] = $slug;
                }
            }
        }

        if ($impliedSlugs === []) {
            return $permissions;
        }

        foreach ($this->permissionsBySlug(array_keys($impliedSlugs)) as $permission) {
            $sourceSlug = $impliedSlugs[$permission['slug']];
            $sourcePermission = $permissions[$sourceSlug];

            $permissions[$permission['slug']] = array_merge($permission, [
                'record_id' => null,
                'access_type' => 'included',
                'activated_at' => $sourcePermission['activated_at'] ?? null,
                'expires_at' => $sourcePermission['expires_at'] ?? null,
                'assigned_by_name' => $sourcePermission['assigned_by_name'] ?? null,
                'status' => 'Included',
                'included_by' => $sourceSlug,
            ]);
        }

        return $permissions;
    }

    private function permissionsBySlug(array $slugs): array
    {
        $placeholders = implode(',', array_fill(0, count($slugs), '?'));

        $stmt = $this->db->prepare("
            SELECT
                id,
                module,
                name,
                slug,
                description
            FROM permissions
            WHERE slug IN ($placeholders)
            AND is_active = 1
        ");

        $stmt->execute($slugs);

        return $stmt->fetchAll();
    }

    public function historyForUser(int $userId): array
    {
        $stmt = $this->db->prepare("
            SELECT
                up.*,
                p.name AS permission_name,
                p.slug,
                p.module,
                assigned.name AS assigned_by_name,
                removed.name AS removed_by_name
            FROM user_permissions up
            INNER JOIN permissions p ON p.id = up.permission_id
            LEFT JOIN users assigned ON assigned.id = up.assigned_by
            LEFT JOIN users removed ON removed.id = up.removed_by
            WHERE up.user_id = ?
            ORDER BY up.created_at DESC, up.id DESC
        ");

        $stmt->execute([$userId]);

        return $stmt->fetchAll();
    }

    private function validUserPermissions(int $userId, string $accessType): array
    {
        $stmt = $this->db->prepare("
            SELECT
                up.id AS record_id,
                up.access_type,
                up.activated_at,
                up.expires_at,
                p.id,
                p.module,
                p.name,
                p.slug,
                p.description,
                assigned.name AS assigned_by_name,
                'Active' AS status
            FROM user_permissions up
            INNER JOIN permissions p ON p.id = up.permission_id
            LEFT JOIN users assigned ON assigned.id = up.assigned_by
            WHERE up.user_id = ?
            AND up.access_type = ?
            AND up.is_active = 1
            AND up.removed_at IS NULL
            AND up.activated_at <= NOW()
            AND (up.expires_at IS NULL OR up.expires_at >= NOW())
            AND p.is_active = 1
            ORDER BY p.module ASC, p.name ASC
        ");

        $stmt->execute([$userId, $accessType]);

        return $stmt->fetchAll();
    }

    private function validUserTypePermissions(int $userId): array
    {
        $stmt = $this->db->prepare("
            SELECT
                utp.id AS record_id,
                'default' AS access_type,
                utp.created_at AS activated_at,
                NULL AS expires_at,
                p.id,
                p.module,
                p.name,
                p.slug,
                p.description,
                assigned.name AS assigned_by_name,
                'Active' AS status
            FROM users u
            INNER JOIN user_type_permissions utp ON utp.user_type_id = u.user_type_id
            INNER JOIN permissions p ON p.id = utp.permission_id
            LEFT JOIN users assigned ON assigned.id = utp.assigned_by
            WHERE u.id = ?
            AND u.is_deleted = 0
            AND utp.is_active = 1
            AND utp.removed_at IS NULL
            AND p.is_active = 1
            ORDER BY p.module ASC, p.name ASC
        ");

        $stmt->execute([$userId]);

        return $stmt->fetchAll();
    }

    private function activeRevokedPermissions(int $userId): array
    {
        $stmt = $this->db->prepare("
            SELECT p.slug
            FROM user_permissions up
            INNER JOIN permissions p ON p.id = up.permission_id
            WHERE up.user_id = ?
            AND up.access_type = 'revoked'
            AND up.is_active = 1
            AND up.removed_at IS NULL
            AND up.activated_at <= NOW()
            AND (up.expires_at IS NULL OR up.expires_at >= NOW())
        ");

        $stmt->execute([$userId]);

        return $stmt->fetchAll();
    }
}
