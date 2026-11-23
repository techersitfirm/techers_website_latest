<?php

namespace app\core;

use app\services\PermissionService;

class Auth
{
    public static function loggedIn(): bool
    {
        return !empty($_SESSION['user_id']);
    }

    public static function id(): ?int
    {
        return $_SESSION['user_id'] ?? null;
    }

    public static function name(): ?string
    {
        return $_SESSION['user_name'] ?? null;
    }

    public static function email(): ?string
    {
        return $_SESSION['user_email'] ?? null;
    }

    public static function type(): ?string
    {
        return $_SESSION['user_type'] ?? null;
    }

    public static function typeName(): ?string
    {
        return $_SESSION['user_type_name'] ?? null;
    }

    public static function can(string $permission): bool
    {
        if (!self::loggedIn()) {
            return false;
        }

        if (self::type() === 'super-admin') {
            return true;
        }

        return (new PermissionService())->userHas((int) self::id(), $permission);
    }
}
