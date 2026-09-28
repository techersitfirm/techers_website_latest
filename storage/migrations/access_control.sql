CREATE TABLE IF NOT EXISTS user_types (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL UNIQUE,
    slug VARCHAR(100) NOT NULL UNIQUE,
    description VARCHAR(255) NULL,
    is_active TINYINT(1) NOT NULL DEFAULT 1,
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
);

ALTER TABLE user_types
    ADD COLUMN IF NOT EXISTS slug VARCHAR(100) NULL AFTER name;

UPDATE user_types
SET slug = LOWER(REPLACE(REPLACE(name, ' ', '-'), '_', '-'))
WHERE slug IS NULL
OR slug = '';

CREATE TABLE IF NOT EXISTS permissions (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    module VARCHAR(100) NOT NULL,
    name VARCHAR(150) NOT NULL,
    slug VARCHAR(150) NOT NULL UNIQUE,
    description VARCHAR(255) NULL,
    is_active TINYINT(1) NOT NULL DEFAULT 1,
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS user_type_permissions (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    user_type_id BIGINT UNSIGNED NOT NULL,
    permission_id BIGINT UNSIGNED NOT NULL,
    is_active TINYINT(1) NOT NULL DEFAULT 1,
    assigned_by BIGINT UNSIGNED NULL,
    removed_at DATETIME NULL,
    removed_by BIGINT UNSIGNED NULL,
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
    UNIQUE KEY uq_user_type_permission (user_type_id, permission_id)
);

CREATE TABLE IF NOT EXISTS user_permissions (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    user_id BIGINT UNSIGNED NOT NULL,
    permission_id BIGINT UNSIGNED NOT NULL,
    access_type ENUM('default', 'addon', 'revoked') NOT NULL DEFAULT 'addon',
    activated_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    expires_at DATETIME NULL,
    is_active TINYINT(1) NOT NULL DEFAULT 1,
    assigned_by BIGINT UNSIGNED NULL,
    removed_at DATETIME NULL,
    removed_by BIGINT UNSIGNED NULL,
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
    KEY idx_user_permissions_user (user_id),
    KEY idx_user_permissions_permission (permission_id)
);

ALTER TABLE user_permissions
    MODIFY access_type ENUM('default', 'addon', 'revoked') NOT NULL DEFAULT 'addon';

ALTER TABLE users
    ADD COLUMN IF NOT EXISTS user_type_id BIGINT UNSIGNED NULL AFTER id,
    ADD COLUMN IF NOT EXISTS user_unique_id VARCHAR(50) NULL AFTER user_type_id,
    ADD COLUMN IF NOT EXISTS name VARCHAR(150) NULL AFTER user_unique_id,
    ADD COLUMN IF NOT EXISTS email VARCHAR(150) NULL AFTER name,
    ADD COLUMN IF NOT EXISTS mobile VARCHAR(20) NULL AFTER email,
    ADD COLUMN IF NOT EXISTS password VARCHAR(255) NULL AFTER mobile,
    ADD COLUMN IF NOT EXISTS profile_pic VARCHAR(255) NULL,
    ADD COLUMN IF NOT EXISTS post_id BIGINT UNSIGNED NULL,
    ADD COLUMN IF NOT EXISTS post VARCHAR(150) NULL,
    ADD COLUMN IF NOT EXISTS address TEXT NULL,
    ADD COLUMN IF NOT EXISTS city VARCHAR(100) NULL,
    ADD COLUMN IF NOT EXISTS state_id BIGINT UNSIGNED NULL,
    ADD COLUMN IF NOT EXISTS state VARCHAR(100) NULL,
    ADD COLUMN IF NOT EXISTS country VARCHAR(100) NULL,
    ADD COLUMN IF NOT EXISTS instagram VARCHAR(255) NULL,
    ADD COLUMN IF NOT EXISTS facebook VARCHAR(255) NULL,
    ADD COLUMN IF NOT EXISTS linkedin VARCHAR(255) NULL,
    ADD COLUMN IF NOT EXISTS is_active TINYINT(1) NOT NULL DEFAULT 1,
    ADD COLUMN IF NOT EXISTS is_deleted TINYINT(1) NOT NULL DEFAULT 0,
    ADD COLUMN IF NOT EXISTS last_login_at DATETIME NULL,
    ADD COLUMN IF NOT EXISTS created_by BIGINT UNSIGNED NULL,
    ADD COLUMN IF NOT EXISTS updated_by BIGINT UNSIGNED NULL,
    ADD COLUMN IF NOT EXISTS created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    ADD COLUMN IF NOT EXISTS updated_at DATETIME NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP;

ALTER TABLE users
    ADD UNIQUE KEY IF NOT EXISTS uq_users_email (email),
    ADD UNIQUE KEY IF NOT EXISTS uq_users_mobile (mobile);

INSERT INTO user_types (id, name, slug, description, is_active)
VALUES
    (1, 'Team', 'team', 'Default team user access', 1),
    (2, 'Super Admin', 'super-admin', 'Access to all pages', 1),
    (3, 'HR', 'hr', 'Team and attendance access', 1),
    (4, 'Account', 'account', 'Salary access', 1),
    (5, 'SEO Manager', 'seo-manager', 'SEO page access', 1)
ON DUPLICATE KEY UPDATE
    name = VALUES(name),
    slug = VALUES(slug),
    description = VALUES(description),
    is_active = VALUES(is_active);

UPDATE user_types
SET slug = CONCAT('type-', id)
WHERE slug IS NULL
OR slug = '';

ALTER TABLE user_types
    MODIFY slug VARCHAR(100) NOT NULL,
    ADD UNIQUE KEY IF NOT EXISTS uq_user_types_slug (slug);

INSERT INTO permissions (module, name, slug, description, is_active)
VALUES
    ('Dashboard', 'Team Dashboard', 'team.dashboard', 'Access the team dashboard', 1),
    ('Dashboard', 'HR Dashboard', 'hr.dashboard', 'Access the HR dashboard', 1),
    ('Dashboard', 'Account Dashboard', 'account.dashboard', 'Access the account dashboard', 1),
    ('Dashboard', 'SEO Dashboard', 'seo.dashboard', 'Access the SEO dashboard', 1),
    ('Team Management', 'View Team Members', 'team.view', 'View team members', 1),
    ('Team Management', 'Create Team Members', 'team.create', 'Create team members', 1),
    ('Team Management', 'Edit Team Members', 'team.edit', 'Edit team members', 1),
    ('Team Management', 'Remove Team Members', 'team.remove', 'Activate or deactivate team members', 1),
    ('Attendance Management', 'Attendance Management', 'attendance.manage', 'Manage attendance records', 1),
    ('Salary Management', 'Salary Management', 'salary.manage', 'Manage salary records', 1),
    ('SEO Management', 'SEO Pages', 'seo.pages.manage', 'Manage SEO pages', 1),
    ('User Management', 'View Users', 'user.view', 'View user access details', 1),
    ('User Management', 'Manage User Types', 'user-type.manage', 'Manage user types and default access', 1),
    ('Permission Management', 'Permission Management', 'permission.manage', 'Manage permission definitions', 1),
    ('Permission Management', 'Assign User Permissions', 'permission.assign', 'Manage add-on and revoked user access', 1)
ON DUPLICATE KEY UPDATE
    module = VALUES(module),
    name = VALUES(name),
    description = VALUES(description),
    is_active = VALUES(is_active);

INSERT INTO user_type_permissions (user_type_id, permission_id, assigned_by)
SELECT ut.id, p.id, NULL
FROM user_types ut
INNER JOIN permissions p ON p.slug IN ('team.dashboard')
WHERE ut.slug = 'team'
ON DUPLICATE KEY UPDATE is_active = 1, removed_at = NULL, removed_by = NULL, updated_at = NOW();

INSERT INTO user_type_permissions (user_type_id, permission_id, assigned_by)
SELECT ut.id, p.id, NULL
FROM user_types ut
INNER JOIN permissions p ON p.slug IN (
    'hr.dashboard',
    'team.view',
    'team.create',
    'team.edit',
    'team.remove',
    'attendance.manage'
)
WHERE ut.slug = 'hr'
ON DUPLICATE KEY UPDATE is_active = 1, removed_at = NULL, removed_by = NULL, updated_at = NOW();

INSERT INTO user_type_permissions (user_type_id, permission_id, assigned_by)
SELECT ut.id, p.id, NULL
FROM user_types ut
INNER JOIN permissions p ON p.slug IN ('account.dashboard', 'salary.manage')
WHERE ut.slug = 'account'
ON DUPLICATE KEY UPDATE is_active = 1, removed_at = NULL, removed_by = NULL, updated_at = NOW();

INSERT INTO user_type_permissions (user_type_id, permission_id, assigned_by)
SELECT ut.id, p.id, NULL
FROM user_types ut
INNER JOIN permissions p ON p.slug IN ('seo.dashboard', 'seo.pages.manage')
WHERE ut.slug = 'seo-manager'
ON DUPLICATE KEY UPDATE is_active = 1, removed_at = NULL, removed_by = NULL, updated_at = NOW();

INSERT INTO users
    (user_unique_id, name, email, mobile, password, user_type_id, is_active, is_deleted, created_at)
VALUES
    ('USR-SEED-SUPER', 'Super Admin', 'superadmin@techers.local', '9000000001', '$2y$10$iBr8858BznCXDyc/yosIGONEU1DUSo8r.CUTwaQXheLWwjRd5RLgq', 2, 1, 0, NOW()),
    ('USR-SEED-TEAM', 'Team User', 'team@techers.local', '9000000002', '$2y$10$iBr8858BznCXDyc/yosIGONEU1DUSo8r.CUTwaQXheLWwjRd5RLgq', 1, 1, 0, NOW()),
    ('USR-SEED-HR', 'HR User', 'hr@techers.local', '9000000003', '$2y$10$iBr8858BznCXDyc/yosIGONEU1DUSo8r.CUTwaQXheLWwjRd5RLgq', 3, 1, 0, NOW()),
    ('USR-SEED-ACCOUNT', 'Account User', 'account@techers.local', '9000000004', '$2y$10$iBr8858BznCXDyc/yosIGONEU1DUSo8r.CUTwaQXheLWwjRd5RLgq', 4, 1, 0, NOW()),
    ('USR-SEED-SEO', 'SEO Manager', 'seo@techers.local', '9000000005', '$2y$10$iBr8858BznCXDyc/yosIGONEU1DUSo8r.CUTwaQXheLWwjRd5RLgq', 5, 1, 0, NOW())
ON DUPLICATE KEY UPDATE
    name = VALUES(name),
    password = VALUES(password),
    user_type_id = VALUES(user_type_id),
    is_active = 1,
    is_deleted = 0,
    updated_at = NOW();
