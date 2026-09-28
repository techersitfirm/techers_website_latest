<?php

use App\Core\Router;

Router::get(
    '/team/login',
    'Team\\AuthController@login'
);

Router::post(
    '/team/login',
    'Team\\AuthController@loginPost'
);

Router::get(
    '/team/dashboard',
    'Admin\\DashboardController@team'
);

Router::get(
    '/team/logout',
    'Team\\AuthController@logout'
);
