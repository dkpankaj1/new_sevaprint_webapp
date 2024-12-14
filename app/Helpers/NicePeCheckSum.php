<?php
namespace App\Helpers;
class NicePeCheckSum
{

    private static string $iv = "@@@@&&&&####$$$$";

    public static function encrypt(string $input, string $key): string
    {
        $key = html_entity_decode($key);
        return openssl_encrypt($input, "AES-128-CBC", $key, 0, self::$iv) ?: '';
    }

    public static function decrypt(string $encrypted, string $key): string
    {
        $key = html_entity_decode($key);
        return openssl_decrypt($encrypted, "AES-128-CBC", $key, 0, self::$iv) ?: '';
    }

    public static function generateSignature(array|string $params, string $key): string
    {
        if (is_array($params)) {
            $params = self::getStringByParams($params);
        }
        return self::generateSignatureByString($params, $key);
    }

    public static function verifySignature(array|string $params, string $key, string $checksum): bool
    {
        if (is_array($params)) {
            unset($params['CHECKSUMHASH']);
            $params = self::getStringByParams($params);
        }
        return self::verifySignatureByString($params, $key, $checksum);
    }

    public static function hashDecrypt(string $msgEncryptedBundle, string $password): string|false
    {
        $passwordHash = sha1($password);
        $components = explode(':', $msgEncryptedBundle);
        if (count($components) !== 3) {
            return false;
        }
        [$iv, $saltComponent, $encryptedMsg] = $components;
        $salt = hash('sha256', $passwordHash . $saltComponent);
        $decryptedMsg = openssl_decrypt($encryptedMsg, 'aes-256-cbc', $salt, 0, $iv);
        if ($decryptedMsg === false) {
            return false;
        }
        return $decryptedMsg;
    }

    private static function generateSignatureByString(string $params, string $key): string
    {
        $salt = self::generateRandomString(4);
        return self::calculateChecksum($params, $key, $salt);
    }

    private static function verifySignatureByString(string $params, string $key, string $checksum): bool
    {
        $decryptedHash = self::decrypt($checksum, $key);
        $salt = substr($decryptedHash, -4);
        return $decryptedHash === self::calculateHash($params, $salt);
    }

    private static function generateRandomString(int $length): string
    {
        $characters = "9876543210ZYXWVUTSRQPONMLKJIHGFEDCBAabcdefghijklmnopqrstuvwxyz!@#$&_";
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[random_int(0, strlen($characters) - 1)];
        }
        return $randomString;
    }

    private static function getStringByParams(array $params): string
    {
        ksort($params);
        return implode("|", array_map(fn($value) => $value !== null && strtolower($value) !== "null" ? $value : "", $params));
    }

    private static function calculateHash(string $params, string $salt): string
    {
        return hash("sha256", $params . "|" . $salt) . $salt;
    }

    private static function calculateChecksum(string $params, string $key, string $salt): string
    {
        $hashString = self::calculateHash($params, $salt);
        return self::encrypt($hashString, $key);
    }
}
