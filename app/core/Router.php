<?php

namespace app\Core;

class Router
{
    private static array $routes = [];

    public static function get(string $uri, string $action): void
    {
        self::$routes['GET'][$uri] = $action;
    }

    public static function post(string $uri, string $action): void
    {
        self::$routes['POST'][$uri] = $action;
    }

    public static function dispatch(string $uri, string $method): void
    {
        $uri = parse_url($uri, PHP_URL_PATH);

        $basePath = rtrim(
            str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME'])),
            '/'
        );

        if (
            !empty($basePath)
            && $basePath !== '/'
            && str_starts_with($uri, $basePath)
        ) {
            $uri = substr($uri, strlen($basePath));
        }

        $uri = $uri ?: '/';

        if (!isset(self::$routes[$method][$uri])) {
            http_response_code(404);
            echo '404 - Route Not Found';
            exit;
        }

        $action = self::$routes[$method][$uri];

        [$controller, $methodName] = explode('@', $action);

        $controllerClass = "\\app\\controllers\\" . $controller;

        if (!class_exists($controllerClass)) {
            die("Controller not found: {$controllerClass}");
        }

        $instance = new $controllerClass();

        if (!method_exists($instance, $methodName)) {
            die("Method not found: {$methodName}");
        }

        $instance->$methodName();
    }
}