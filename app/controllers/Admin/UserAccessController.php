<?php

namespace app\controllers\Admin;

use app\core\Controller;
use app\core\Flash;
use app\helpers\Crypto;
use app\helpers\Csrf;
use app\middleware\AdminAuthMiddleware;
use app\models\PermissionModel;
use app\models\UserModel;
use app\models\UserPermissionModel;
use app\services\PermissionService;

class UserAccessController extends Controller
{
    private UserModel $userModel;
    private PermissionModel $permissionModel;
    private PermissionService $permissionService;
    private UserPermissionModel $userPermissionModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->permissionModel = new PermissionModel();
        $this->permissionService = new PermissionService();
        $this->userPermissionModel = new UserPermissionModel();
    }

    public function users(): void
    {
        AdminAuthMiddleware::handle('user.view');

        $users = $this->userModel->getAll();

        foreach ($users as &$user) {
            $user['token'] = Crypto::encryptId((int) $user['id']);
        }

        $this->renderAdmin('users/index', [
            'pageTitle' => 'User Management',
            'users' => $users
        ]);
    }

    public function profile(): void
    {
        AdminAuthMiddleware::handle('user.view');

        $user = $this->findUserOrRedirect();

        $this->renderAdmin('users/profile', [
            'pageTitle' => 'User Profile',
            'user' => $user,
            'token' => Crypto::encryptId((int) $user['id']),
            'effectivePermissions' => $this->permissionService->effectiveForUser((int) $user['id']),
            'history' => $this->permissionService->historyForUser((int) $user['id'])
        ]);
    }

    public function access(): void
    {
        AdminAuthMiddleware::handle('permission.assign');

        $user = $this->findUserOrRedirect();

        $this->renderAdmin('users/access', [
            'pageTitle' => 'Individual User Permission Management',
            'user' => $user,
            'token' => Crypto::encryptId((int) $user['id']),
            'permissions' => $this->permissionModel->getActive(),
            'effectivePermissions' => $this->permissionService->effectiveForUser((int) $user['id']),
            'history' => $this->permissionService->historyForUser((int) $user['id'])
        ]);
    }

    public function addAccess(): void
    {
        AdminAuthMiddleware::handle('permission.assign');

        if (!Csrf::validate($_POST['_csrf_token'] ?? null)) {
            Flash::error('Invalid token. Please try again.');
            $this->redirect(BASE_URL . '/admin/users');
        }

        $userId = Crypto::decryptId($_POST['user_token'] ?? '');
        $permissionId = (int) ($_POST['permission_id'] ?? 0);
        $activatedAt = trim($_POST['activated_at'] ?? '');
        $expiresAt = trim($_POST['expires_at'] ?? '');

        if (!$userId || $permissionId < 1 || $activatedAt === '') {
            Flash::error('User, permission and activation date are required.');
            $this->redirect(BASE_URL . '/admin/users');
        }

        if ($this->userAlreadyHasPermission($userId, $permissionId)) {
            Flash::warning('This user already has this access.');
            $this->redirect(BASE_URL . '/admin/users/access?token=' . urlencode(Crypto::encryptId($userId)));
        }

        $this->userPermissionModel->addOn([
            'user_id' => $userId,
            'permission_id' => $permissionId,
            'activated_at' => $this->toDateTime($activatedAt),
            'expires_at' => $expiresAt !== '' ? $this->toDateTime($expiresAt, true) : null,
            'assigned_by' => $_SESSION['user_id'] ?? null
        ])
            ? Flash::success('Add-On Access assigned successfully.')
            : Flash::error('Unable to assign Add-On Access.');

        $this->redirect(BASE_URL . '/admin/users/access?token=' . urlencode(Crypto::encryptId($userId)));
    }

    public function revokeAccess(): void
    {
        AdminAuthMiddleware::handle('permission.assign');

        if (!Csrf::validate($_POST['_csrf_token'] ?? null)) {
            Flash::error('Invalid token. Please try again.');
            $this->redirect(BASE_URL . '/admin/users');
        }

        $userId = Crypto::decryptId($_POST['user_token'] ?? '');
        $permissionId = (int) ($_POST['permission_id'] ?? 0);

        if (!$userId || $permissionId < 1) {
            Flash::error('User and permission are required.');
            $this->redirect(BASE_URL . '/admin/users');
        }

        $this->userPermissionModel->revoke($userId, $permissionId, $_SESSION['user_id'] ?? null)
            ? Flash::success('Access revoked successfully.')
            : Flash::error('Unable to revoke access.');

        $this->redirect(BASE_URL . '/admin/users/access?token=' . urlencode(Crypto::encryptId($userId)));
    }

    public function extendAccess(): void
    {
        AdminAuthMiddleware::handle('permission.assign');

        if (!Csrf::validate($_POST['_csrf_token'] ?? null)) {
            Flash::error('Invalid token. Please try again.');
            $this->redirect(BASE_URL . '/admin/users');
        }

        $userId = Crypto::decryptId($_POST['user_token'] ?? '');
        $recordId = (int) ($_POST['record_id'] ?? 0);
        $expiresAt = trim($_POST['expires_at'] ?? '');

        if (!$userId || $recordId < 1) {
            Flash::error('Access record not found.');
            $this->redirect(BASE_URL . '/admin/users');
        }

        $this->userPermissionModel->extend($recordId, $expiresAt !== '' ? $this->toDateTime($expiresAt, true) : null)
            ? Flash::success('Access end date updated successfully.')
            : Flash::error('Unable to update access end date.');

        $this->redirect(BASE_URL . '/admin/users/access?token=' . urlencode(Crypto::encryptId($userId)));
    }

    public function removeAccess(): void
    {
        AdminAuthMiddleware::handle('permission.assign');

        if (!Csrf::validate($_POST['_csrf_token'] ?? null)) {
            Flash::error('Invalid token. Please try again.');
            $this->redirect(BASE_URL . '/admin/users');
        }

        $userId = Crypto::decryptId($_POST['user_token'] ?? '');
        $recordId = (int) ($_POST['record_id'] ?? 0);

        if (!$userId || $recordId < 1) {
            Flash::error('Access record not found.');
            $this->redirect(BASE_URL . '/admin/users');
        }

        $this->userPermissionModel->deactivate($recordId, $_SESSION['user_id'] ?? null)
            ? Flash::success('Access removed and history preserved.')
            : Flash::error('Unable to remove access.');

        $this->redirect(BASE_URL . '/admin/users/access?token=' . urlencode(Crypto::encryptId($userId)));
    }

    private function findUserOrRedirect(): array
    {
        $id = $this->userIdFromRequest();

        if (!$id) {
            http_response_code(404);
            require VIEW_PATH . '/errors/404.php';
            exit;
        }

        $user = $this->userModel->findById($id);

        if (!$user) {
            Flash::error('User not found.');
            $this->redirect(BASE_URL . '/admin/users');
        }

        return $user;
    }

    private function userAlreadyHasPermission(int $userId, int $permissionId): bool
    {
        foreach ($this->permissionService->effectiveForUser($userId) as $permission) {
            if ((int) $permission['id'] === $permissionId) {
                return true;
            }
        }

        return false;
    }

    private function userIdFromRequest(): ?int
    {
        $tokenId = Crypto::decryptId($_GET['token'] ?? '');

        if ($tokenId) {
            return $tokenId;
        }

        $id = $_GET['id'] ?? null;

        if (is_string($id) && ctype_digit($id)) {
            return (int) $id;
        }

        return null;
    }

    private function toDateTime(string $date, bool $endOfDay = false): string
    {
        return $date . ($endOfDay ? ' 23:59:59' : ' 00:00:00');
    }
}
