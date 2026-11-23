<?php

namespace app\controllers\Team;

use app\core\Controller;
use app\middleware\TeamAuthMiddleware;

class DashboardController extends Controller
{
    public function index()
    {
        TeamAuthMiddleware::handle('team.dashboard');

        $this->renderTeam(
            'dashboard/index',
            [
                'pageTitle' => 'Team Dashboard'
            ]
        );
    }
}
