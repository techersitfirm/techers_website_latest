<?php

namespace app\controllers\Admin;

use app\core\Controller;
use app\core\Flash;
use app\middleware\AdminAuthMiddleware;
use app\models\PermissionModel;
use app\models\UserTypeModel;

class UserTypeController extends Controller
{
    private UserTypeModel $userTypeModel;
    private PermissionModel $permissionModel;

    public function __construct()
    {
        $this->userTypeModel = new UserTypeModel();
        $this->permissionModel = new PermissionModel();
    }

    public function index(): void
    {
        AdminAuthMiddleware::handle('user-type.manage');

        $this->renderAdmin(
            'user-types/index',
            [
                'pageTitle' => 'User Type Management',
                'userTypes' => $this->userTypeModel->getAll()
            ]
        );
    }

    public function create(): void
    {
        AdminAuthMiddleware::handle('user-type.manage');

        $this->renderAdmin(
            'user-types/form',
            [
                'pageTitle' => 'Add User Type',
                'userType' => null
            ]
        );
    }

    public function store(): void
    {
        AdminAuthMiddleware::handle('user-type.manage');

        $data = $this->formData();

        if ($data['name'] === '') {
            Flash::error('User type name is required.');
            $this->redirect(BASE_URL . '/admin/user-types/create');
        }

        $this->userTypeModel->create($data)
            ? Flash::success('User type added successfully.')
            : Flash::error('Unable to add user type.');

        $this->redirect(BASE_URL . '/admin/user-types');
    }

    public function edit(): void
    {
        AdminAuthMiddleware::handle('user-type.manage');

        $userType = $this->userTypeModel->findById((int) ($_GET['id'] ?? 0));

        if (!$userType) {
            Flash::error('User type not found.');
            $this->redirect(BASE_URL . '/admin/user-types');
        }

        $this->renderAdmin(
            'user-types/form',
            [
                'pageTitle' => 'Edit User Type',
                'userType' => $userType
            ]
        );
    }

    public function update(): void
    {
        AdminAuthMiddleware::handle('user-type.manage');

        $id = (int) ($_POST['id'] ?? 0);
        $data = $this->formData();
        $data['is_active'] = isset($_POST['is_active']) ? 1 : 0;

        if ($id < 1 || $data['name'] === '') {
            Flash::error('Please enter a valid user type.');
            $this->redirect(BASE_URL . '/admin/user-types');
        }

        $this->userTypeModel->update($id, $data)
            ? Flash::success('User type updated successfully.')
            : Flash::error('Unable to update user type.');

        $this->redirect(BASE_URL . '/admin/user-types');
    }

    public function permissions(): void
    {
        AdminAuthMiddleware::handle('user-type.manage');

        $userType = $this->userTypeModel->findById((int) ($_GET['id'] ?? 0));

        if (!$userType) {
            Flash::error('User type not found.');
            $this->redirect(BASE_URL . '/admin/user-types');
        }

        $this->renderAdmin(
            'user-types/permissions',
            [
                'pageTitle' => 'User Type Permissions',
                'userType' => $userType,
                'permissions' => $this->permissionModel->getActive(),
                'selectedPermissionIds' => $this->userTypeModel->permissionIds((int) $userType['id'])
            ]
        );
    }

    public function permissionsUpdate(): void
    {
        AdminAuthMiddleware::handle('user-type.manage');

        $id = (int) ($_POST['id'] ?? 0);
        $permissionIds = $_POST['permissions'] ?? [];

        if ($id < 1) {
            Flash::error('User type not found.');
            $this->redirect(BASE_URL . '/admin/user-types');
        }

        $this->userTypeModel->syncPermissions(
            $id,
            is_array($permissionIds) ? $permissionIds : [],
            $_SESSION['admin_id'] ?? null
        )
            ? Flash::success('Default access updated successfully.')
            : Flash::error('Unable to update default access.');

        $this->redirect(BASE_URL . '/admin/user-types/permissions?id=' . $id);
    }

    private function formData(): array
    {
        return [
            'name' => trim($_POST['name'] ?? ''),
            'description' => trim($_POST['description'] ?? ''),
            'is_active' => 1
        ];
    }
}
