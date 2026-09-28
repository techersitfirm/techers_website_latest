<?php

namespace App\Core;

class SessionManager
{
    private static bool $started = false;

    public static function start(): void
    {
        if (self::$started) {
            return;
        }

        $config = require ROOT_PATH . '/config/session.php';

        session_set_cookie_params([
            'lifetime' => 0,
            'path' => '/',
            'secure' => $config['cookie_secure'],
            'httponly' => $config['cookie_httponly'],
            'samesite' => $config['cookie_samesite']
        ]);

        session_start();

        self::$started = true;

        self::validateSession();
    }

    private static function validateSession(): void
    {
        $config = require ROOT_PATH . '/config/session.php';

        if (!isset($_SESSION['created_at'])) {
            return;
        }

        $now = time();

        // Idle Timeout
        if (
            isset($_SESSION['last_activity']) &&
            ($now - $_SESSION['last_activity']) > $config['idle_timeout']
        ) {
            self::destroy();
        }

        // Absolute Timeout
        if (
            isset($_SESSION['created_at']) &&
            ($now - $_SESSION['created_at']) > $config['absolute_timeout']
        ) {
            self::destroy();
        }

        // IP Validation
        if (
            isset($_SESSION['ip_address']) &&
            $_SESSION['ip_address'] !== $_SERVER['REMOTE_ADDR']
        ) {
            self::destroy();
        }

        // User Agent Validation
        if (
            isset($_SESSION['user_agent']) &&
            $_SESSION['user_agent'] !== $_SERVER['HTTP_USER_AGENT']
        ) {
            self::destroy();
        }

        $_SESSION['last_activity'] = $now;
    }

    public static function login(array $data): void
    {
        session_regenerate_id(true);

        $_SESSION['created_at'] = time();
        $_SESSION['last_activity'] = time();

        $_SESSION['ip_address'] = $_SERVER['REMOTE_ADDR'];
        $_SESSION['user_agent'] = $_SERVER['HTTP_USER_AGENT'];

        foreach ($data as $key => $value) {
            $_SESSION[$key] = $value;
        }
    }

    public static function get(string $key, $default = null)
    {
        return $_SESSION[$key] ?? $default;
    }

    public static function has(string $key): bool
    {
        return isset($_SESSION[$key]);
    }

    public static function set(string $key, $value): void
    {
        $_SESSION[$key] = $value;
    }

    public static function remove(string $key): void
    {
        unset($_SESSION[$key]);
    }

    public static function destroy(): void
    {
        $_SESSION = [];

        if (session_status() === PHP_SESSION_ACTIVE) {
            session_destroy();
        }

        header('Location: /');
        exit;
    }

    public static function isLoggedIn(string $key): bool
    {
        return isset($_SESSION[$key]);
    }
}