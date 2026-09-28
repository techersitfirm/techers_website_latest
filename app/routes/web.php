<?php

use App\Core\Router;

Router::get(
    '/',
    'Customer\\HomeController@index'
);