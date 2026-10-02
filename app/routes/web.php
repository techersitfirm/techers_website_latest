<?php

use app\core\Router;

Router::get(
    '/',
    'Customer\\HomeController@index'
);