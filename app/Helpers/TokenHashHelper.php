<?php
namespace App\Helpers;

class TokenHashHelper
{
    private static string $method = 'AES-256-CBC'; // Encryption method
    private static string $privateKey = 'aBcDeFgHiJkLmNoPqRsTuVwXyZ'; // Replace with your actual private key

    /**
     * Encrypt a string or array with private key encryption.
     *
     * @param mixed $data The data to encrypt (string or array).
     * @return string The encrypted data (URL-safe).
     */
    public static function encrypt($data): string
    {
        if (is_array($data)) {
            // Serialize array before encryption
            $data = serialize($data);
        }

        // Encrypt the data
        $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length(self::$method));
        $encryptedData = openssl_encrypt($data, self::$method, self::$privateKey, 0, $iv);

        // Return encrypted data with the IV, base64 encoded, and URL-safe
        return self::base64_url_encode($iv . '::' . $encryptedData);
    }

    /**
     * Decrypt an encrypted string or array back to the original format.
     *
     * @param string $encryptedData The encrypted data to decrypt.
     * @return mixed The decrypted data (string or array), or null if decryption fails.
     */
    public static function decrypt(string $encryptedData)
    {
        // Decode URL-safe base64
        $data = self::base64_url_decode($encryptedData);
        [$iv, $encrypted] = explode('::', $data, 2);

        // Decrypt data
        $decryptedData = openssl_decrypt($encrypted, self::$method, self::$privateKey, 0, $iv);

        // Check if the decrypted data is serialized
        if (self::isSerialized($decryptedData)) {
            return unserialize($decryptedData);
        }

        return $decryptedData;
    }

    /**
     * Check if a string is serialized.
     *
     * @param string $data The data to check.
     * @return bool True if the string is serialized, false otherwise.
     */
    private static function isSerialized($data): bool
    {
        return (@unserialize($data) !== false || $data === 'b:0;');
    }

    /**
     * URL-safe base64 encode.
     *
     * @param string $data The data to encode.
     * @return string The URL-safe base64 encoded string.
     */
    private static function base64_url_encode(string $data): string
    {
        return rtrim(strtr(base64_encode($data), '+/', '-_'), '=');
    }

    /**
     * URL-safe base64 decode.
     *
     * @param string $data The data to decode.
     * @return string The decoded string.
     */
    private static function base64_url_decode(string $data): string
    {
        return base64_decode(str_pad(strtr($data, '-_', '+/'), strlen($data) % 4, '=', STR_PAD_RIGHT));
    }
}
