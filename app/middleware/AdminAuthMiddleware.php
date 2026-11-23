<?php

namespace app\middleware;

use app\core\Flash;
use app\services\PermissionService;

class AdminAuthMiddleware
{
    public static function handle(?string $permission = null): void
    {
        if (empty($_SESSION['user_id'])) {
            Flash::error('Access denied. Please login to continue.');
            header('Location: ' . BASE_URL . '/auth/login');
            exit;
        }

        if ($permission === null || ($_SESSION['user_type'] ?? '') === 'super-admin') {
            return;
        }

        $permissionService = new PermissionService();

        if (!$permissionService->userHas((int) $_SESSION['user_id'], $permission)) {
            http_response_code(403);
            require VIEW_PATH . '/errors/403.php';
            exit;
        }
    }
}
