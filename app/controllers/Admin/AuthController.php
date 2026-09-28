<?php

namespace App\Controllers\Admin;

use App\Core\Controller;
use App\Core\Flash;
use App\Core\SessionManager;
use App\Models\UserModel;

class AuthController extends Controller
{
    public function login(): void
    {
        if (!empty($_SESSION['user_id'])) {
            header('Location: ' . BASE_URL . $this->dashboardPathForUserType($_SESSION['user_type'] ?? null));
            exit;
        }

        $this->renderAdmin('auth/login', [], 'auth');
    }

    public function loginPost(): void
    {
        $email = trim($_POST['email'] ?? '');
        $password = trim($_POST['password'] ?? '');

        if ($email === '' || $password === '') {
            Flash::error('Email and Password are required');
            header('Location: ' . BASE_URL . '/auth/login');
            exit;
        }

        $model = new UserModel();
        $user = $model->findByEmail($email);

        if (!$user || !password_verify($password, $user['password'])) {
            Flash::error('Invalid credentials');
            header('Location: ' . BASE_URL . '/auth/login');
            exit;
        }

        if ((int) $user['is_active'] !== 1) {
            Flash::error('Account is inactive');
            header('Location: ' . BASE_URL . '/auth/login');
            exit;
        }

        SessionManager::login([
            'user_id' => $user['id'],
            'user_name' => $user['name'],
            'user_email' => $user['email'],
            'user_type_id' => $user['user_type_id'],
            'user_type' => $user['user_type_slug'],
            'user_type_name' => $user['user_type_name']
        ]);

        $model->updateLastLogin((int) $user['id']);

        header('Location: ' . BASE_URL . $this->dashboardPathForUserType($user['user_type_slug'] ?? null));
        exit;
    }

    public function logout(): void
    {
        unset(
            $_SESSION['user_id'],
            $_SESSION['user_name'],
            $_SESSION['user_email'],
            $_SESSION['user_type_id'],
            $_SESSION['user_type'],
            $_SESSION['user_type_name']
        );

        header('Location: ' . BASE_URL . '/auth/login');
        exit;
    }

    private function dashboardPathForUserType(?string $userType): string
    {
        return '/admin/dashboard';
    }
}
