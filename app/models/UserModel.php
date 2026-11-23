<?php

namespace app\models;

use app\core\Database;
use PDO;

class UserModel
{
    private PDO $db;

    public function __construct()
    {
        $this->db = Database::getConnection();
    }

    public function getAll(): array
    {
        $stmt = $this->db->query("
            SELECT
                u.*,
                ut.name AS user_type_name,
                ut.slug AS user_type_slug
            FROM users u
            LEFT JOIN user_types ut ON ut.id = u.user_type_id
            WHERE u.is_deleted = 0
            ORDER BY u.id DESC
        ");

        return $stmt->fetchAll();
    }

    public function findById(int $id): ?array
    {
        $stmt = $this->db->prepare("
            SELECT
                u.*,
                ut.name AS user_type_name,
                ut.slug AS user_type_slug
            FROM users u
            LEFT JOIN user_types ut ON ut.id = u.user_type_id
            WHERE u.id = ?
            AND u.is_deleted = 0
            LIMIT 1
        ");

        $stmt->execute([$id]);

        return $stmt->fetch() ?: null;
    }

    public function findByEmail(string $email): ?array
    {
        $stmt = $this->db->prepare("
            SELECT
                u.*,
                ut.name AS user_type_name,
                ut.slug AS user_type_slug
            FROM users u
            LEFT JOIN user_types ut ON ut.id = u.user_type_id
            WHERE u.email = ?
            AND u.is_deleted = 0
            LIMIT 1
        ");

        $stmt->execute([$email]);

        return $stmt->fetch() ?: null;
    }

    public function create(array $data): ?int
    {
        $stmt = $this->db->prepare("
            INSERT INTO users
                (
                    user_unique_id,
                    name,
                    email,
                    mobile,
                    password,
                    user_type_id,
                    profile_pic,
                    post_id,
                    show_on_website,
                    address,
                    city,
                    state_id,
                    country,
                    instagram,
                    facebook,
                    linkedin,
                    is_active,
                    created_by,
                    created_at
                )
            VALUES
                (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 1, ?, NOW())
        ");

        $ok = $stmt->execute([
            $this->nextUniqueId(),
            $data['name'],
            $data['email'],
            $data['mobile'],
            password_hash($data['password'], PASSWORD_DEFAULT),
            $data['user_type_id'],
            $data['profile_pic'] ?? null,
            $data['post_id'] ?? null,
            $data['show_on_website'] ?? 0,
            $data['address'] ?? null,
            $data['city'] ?? null,
            $data['state_id'] ?? null,
            $data['country'] ?? null,
            $data['instagram'] ?: null,
            $data['facebook'] ?: null,
            $data['linkedin'] ?: null,
            $data['created_by'] ?? null
        ]);

        return $ok ? (int) $this->db->lastInsertId() : null;
    }

    public function update(int $id, array $data): bool
    {
        $sql = "
            UPDATE users
            SET
                name = ?,
                email = ?,
                mobile = ?,
                user_type_id = ?,
                profile_pic = ?,
                post_id = ?,
                show_on_website = ?,
                address = ?,
                city = ?,
                state_id = ?,
                country = ?,
                instagram = ?,
                facebook = ?,
                linkedin = ?,
                updated_by = ?,
                updated_at = NOW()
        ";

        $params = [
            $data['name'],
            $data['email'],
            $data['mobile'],
            $data['user_type_id'],
            $data['profile_pic'] ?? null,
            $data['post_id'] ?? null,
            $data['show_on_website'] ?? null,
            $data['address'] ?? null,
            $data['city'] ?? null,
            $data['state_id'] ?? null,
            $data['country'] ?? null,
            $data['instagram'] ?: null,
            $data['facebook'] ?: null,
            $data['linkedin'] ?: null,
            $data['updated_by'] ?? null
        ];

        if (!empty($data['password'])) {
            $sql .= ", password = ?";
            $params[] = password_hash($data['password'], PASSWORD_DEFAULT);
        }

        $sql .= " WHERE id = ? AND is_deleted = 0";
        $params[] = $id;

        $stmt = $this->db->prepare($sql);

        return $stmt->execute($params);
    }

    public function toggleStatus(int $id): bool
    {
        $stmt = $this->db->prepare("
            UPDATE users
            SET is_active = CASE WHEN is_active = 1 THEN 0 ELSE 1 END,
                updated_at = NOW()
            WHERE id = ?
            AND is_deleted = 0
        ");

        return $stmt->execute([$id]);
    }

    public function emailExists(string $email, ?int $excludeId = null): bool
    {
        $sql = "
            SELECT id
            FROM users
            WHERE email = ?
            AND is_deleted = 0
        ";
        $params = [$email];

        if ($excludeId !== null) {
            $sql .= " AND id != ?";
            $params[] = $excludeId;
        }

        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);

        return (bool) $stmt->fetch();
    }

    public function mobileExists(string $mobile, ?int $excludeId = null): bool
    {
        $sql = "
            SELECT id
            FROM users
            WHERE mobile = ?
            AND is_deleted = 0
        ";
        $params = [$mobile];

        if ($excludeId !== null) {
            $sql .= " AND id != ?";
            $params[] = $excludeId;
        }

        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);

        return (bool) $stmt->fetch();
    }

    public function updateLastLogin(int $id): void
    {
        $stmt = $this->db->prepare("
            UPDATE users
            SET last_login_at = NOW()
            WHERE id = ?
        ");

        $stmt->execute([$id]);
    }

    public function getActivePosts(): array
    {
        $stmt = $this->db->query("
            SELECT id, name
            FROM master_post
            WHERE is_active = 1
            ORDER BY name ASC
        ");

        return $stmt->fetchAll();
    }

    public function getActiveStates(): array
    {
        $stmt = $this->db->query("
            SELECT id, name
            FROM master_state
            WHERE is_active = 1
            ORDER BY name ASC
        ");

        return $stmt->fetchAll();
    }

    public function findPostById(int $id): ?array
    {
        $stmt = $this->db->prepare("
            SELECT id, name
            FROM master_post
            WHERE id = ?
            AND is_active = 1
            LIMIT 1
        ");

        $stmt->execute([$id]);

        return $stmt->fetch() ?: null;
    }

    public function findStateById(int $id): ?array
    {
        $stmt = $this->db->prepare("
            SELECT id, name
            FROM master_state
            WHERE id = ?
            AND is_active = 1
            LIMIT 1
        ");

        $stmt->execute([$id]);

        return $stmt->fetch() ?: null;
    }

    private function nextUniqueId(): string
    {
        return 'USR-' . date('ym') . '-' . strtoupper(bin2hex(random_bytes(3)));
    }
}
