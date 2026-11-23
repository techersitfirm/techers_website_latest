<?php

namespace app\core;

class View
{
    private static array $sections = [];

    private static ?string $currentSection = null;

    public static function startSection(string $name): void
    {
        self::$currentSection = $name;

        ob_start();
    }

    public static function endSection(): void
    {
        if (self::$currentSection === null) {
            throw new \RuntimeException(
                'No active section started.'
            );
        }

        self::$sections[self::$currentSection] =
            (self::$sections[self::$currentSection] ?? '')
            . ob_get_clean();

        self::$currentSection = null;
    }

    public static function section(string $name): string
    {
        return self::$sections[$name] ?? '';
    }

    public static function clearSections(): void
    {
        self::$sections = [];
    }
    
}