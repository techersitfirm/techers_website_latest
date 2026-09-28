<?php

namespace App\Controllers\Admin;

use App\Core\Controller;
use App\Core\Flash;
use App\Middleware\AdminAuthMiddleware;
use App\Models\PermissionModel;

class PermissionController extends Controller
{
    private PermissionModel $permissionModel;

    public function __construct()
    {
        $this->permissionModel = new PermissionModel();
    }

    public function index(): void
    {
        AdminAuthMiddleware::handle('permission.manage');

        $this->renderAdmin(
            'permissions/index',
            [
                'pageTitle' => 'Permission Management',
                'permissions' => $this->permissionModel->getAll()
            ]
        );
    }

    public function create(): void
    {
        AdminAuthMiddleware::handle('permission.manage');

        $this->renderAdmin(
            'permissions/create',
            [
                'pageTitle' => 'Add Permission'
            ]
        );
    }

    public function store(): void
    {
        AdminAuthMiddleware::handle('permission.manage');

        $data = [
            'module' => trim($_POST['module'] ?? ''),
            'name' => trim($_POST['name'] ?? ''),
            'slug' => trim($_POST['slug'] ?? ''),
            'description' => trim($_POST['description'] ?? '')
        ];

        if ($data['module'] === '' || $data['name'] === '' || $data['slug'] === '') {
            Flash::error('Module, permission name and slug are required.');
            $this->redirect(BASE_URL . '/admin/permissions/create');
        }

        if (!preg_match('/^[a-z0-9]+([._-][a-z0-9]+)*$/', $data['slug'])) {
            Flash::error('Permission slug must use lowercase letters, numbers, dots, dashes or underscores.');
            $this->redirect(BASE_URL . '/admin/permissions/create');
        }

        $this->permissionModel->create($data)
            ? Flash::success('Permission added successfully.')
            : Flash::error('Unable to add permission.');

        $this->redirect(BASE_URL . '/admin/permissions');
    }

    public function toggleStatus(): void
    {
        AdminAuthMiddleware::handle('permission.manage');

        $id = (int) ($_POST['id'] ?? 0);

        if ($id < 1) {
            Flash::error('Permission not found.');
            $this->redirect(BASE_URL . '/admin/permissions');
        }

        $this->permissionModel->toggleStatus($id)
            ? Flash::success('Permission status updated successfully.')
            : Flash::error('Unable to update permission status.');

        $this->redirect(BASE_URL . '/admin/permissions');
    }
}
