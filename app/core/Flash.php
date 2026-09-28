<?php

namespace App\Core;

class Flash
{
    public static function set(
        string $type,
        string $message
    ): void {
        $_SESSION['_flash'] = [
            'type'    => $type,
            'message' => $message
        ];
    }

    public static function get(): ?array
    {
        if (empty($_SESSION['_flash'])) {
            return null;
        }

        $flash = $_SESSION['_flash'];

        unset($_SESSION['_flash']);

        return $flash;
    }

    public static function success(
        string $message
    ): void {
        self::set(
            'success',
            $message
        );
    }

    public static function error(
        string $message
    ): void {
        self::set(
            'danger',
            $message
        );
    }

    public static function warning(
        string $message
    ): void {
        self::set(
            'warning',
            $message
        );
    }

    public static function info(
        string $message
    ): void {
        self::set(
            'info',
            $message
        );
    }
}