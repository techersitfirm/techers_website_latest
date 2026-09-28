<?php

namespace App\Controllers\Team;

use App\Core\Controller;
use App\Core\Flash;

class AuthController extends Controller
{
    public function login()
    {
        if (!empty($_SESSION['user_id'])) {
            header('Location: ' . BASE_URL . '/dashboard/team');

            exit;
        }

        $this->renderTeam(
            'auth/login',
            [
                'pageTitle' => 'Team Login'
            ],
            'auth'
        );
    }

    public function loginPost()
    {
        (new \App\Controllers\Admin\AuthController())->loginPost();
    }

    public function logout()
    {
        (new \App\Controllers\Admin\AuthController())->logout();
    }
}
