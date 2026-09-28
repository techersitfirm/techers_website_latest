<?php

namespace App\Controllers\Team;

use App\Core\Controller;
use App\Middleware\TeamAuthMiddleware;

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
