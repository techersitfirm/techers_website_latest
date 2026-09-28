<?php

namespace App\Helpers;

class Validator
{
    public static function required(
        array $data,
        array $fields
    ): ?string {

        foreach ($fields as $field) {

            if (
                !isset($data[$field]) ||
                trim((string) $data[$field]) === ''
            ) {
                return ucfirst(
                    str_replace('_', ' ', $field)
                ) . ' is required.';
            }
        }

        return null;
    }

    public static function name(
        string $value
    ): bool {

        return (bool) preg_match(
            '/^[A-Za-z\s]+$/',
            $value
        );
    }

    public static function mobile(
        string $value
    ): bool {

        return (bool) preg_match(
            '/^[6-9][0-9]{9}$/',
            $value
        );
    }

    public static function email(
        string $value
    ): bool {

        return filter_var(
            $value,
            FILTER_VALIDATE_EMAIL
        ) !== false;
    }

    public static function url(
        ?string $value
    ): bool {

        return empty($value)
            || filter_var(
                $value,
                FILTER_VALIDATE_URL
            ) !== false;
    }

    public static function socialUrl(
        ?string $value,
        string $domain
    ): bool {

        if (empty($value)) {
            return true;
        }

        return filter_var(
            $value,
            FILTER_VALIDATE_URL
        ) !== false
        && (bool) preg_match(
            '/^https?:\/\/(www\.)?'
            . preg_quote($domain, '/')
            . '\//i',
            $value
        );
    }

    public static function inArray(
        string $value,
        array $allowed
    ): bool {

        return in_array(
            $value,
            $allowed,
            true
        );
    }
}