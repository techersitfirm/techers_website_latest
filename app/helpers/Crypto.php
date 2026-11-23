<?php

namespace app\helpers;

class Crypto
{
    private const CIPHER = 'AES-256-CBC';

    private static function key(): string
    {
        return hash(
            'sha256',
            APP_KEY,
            true
        );
    }

    public static function encrypt(
        string $value
    ): string {
        $iv = random_bytes(openssl_cipher_iv_length(self::CIPHER));
        $cipherText = openssl_encrypt(
            $value,
            self::CIPHER,
            self::key(),
            OPENSSL_RAW_DATA,
            $iv
        );

        $payload = $iv . $cipherText;
        $mac = hash_hmac('sha256', $payload, self::key(), true);

        return rtrim(
            strtr(base64_encode($mac . $payload), '+/', '-_'),
            '='
        );
    }

    public static function decrypt(
        string $value
    ): ?string {

        $decoded = base64_decode(
            strtr(urldecode($value), '-_', '+/'),
            true
        );

        if ($decoded === false || strlen($decoded) < 49) {
            return null;
        }

        $mac = substr($decoded, 0, 32);
        $payload = substr($decoded, 32);
        $expectedMac = hash_hmac('sha256', $payload, self::key(), true);

        if (!hash_equals($expectedMac, $mac)) {
            return null;
        }

        $ivLength = openssl_cipher_iv_length(self::CIPHER);
        $iv = substr($payload, 0, $ivLength);
        $cipherText = substr($payload, $ivLength);

        $decrypted = openssl_decrypt(
            $cipherText,
            self::CIPHER,
            self::key(),
            OPENSSL_RAW_DATA,
            $iv
        );

        return $decrypted ?: null;
    }

    public static function encryptId(int $id): string
    {
        return self::encrypt((string) $id);
    }

    public static function decryptId(string $value): ?int
    {
        $id = self::decrypt($value);

        if ($id === null || !ctype_digit($id)) {
            return null;
        }

        return (int) $id;
    }
}
