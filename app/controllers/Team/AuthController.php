<?php

namespace app\controllers\Team;

use app\core\Controller;
use app\core\Flash;

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
        (new \app\controllers\Admin\AuthController())->loginPost();
    }

    public function logout()
    {
        (new \app\controllers\Admin\AuthController())->logout();
    }
}
