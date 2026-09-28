<?php

require '../config/constants.php';

spl_autoload_register(function ($class) {

    $prefix = 'App\\';

    if (strpos($class, $prefix) !== 0) {
        return;
    }

    $relativeClass = substr($class, strlen($prefix));

    $file = APP_PATH . '/'
        . str_replace('\\', '/', $relativeClass)
        . '.php';

    if (file_exists($file)) {
        require $file;
    }
});

use App\Core\SessionManager;
use App\Core\Router;

SessionManager::start();

require APP_PATH . '/routes/index.php';

Router::dispatch(
    $_SERVER['REQUEST_URI'],
    $_SERVER['REQUEST_METHOD']
);