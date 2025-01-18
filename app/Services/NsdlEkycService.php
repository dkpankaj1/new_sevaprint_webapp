<?php

namespace App\Services;

use App\Services\Contracts\NSDLServiceInterface;
use GuzzleHttp\Client;
use Exception;


class NsdlEkycService implements NSDLServiceInterface
{
    private $client;
    private $baseUrl;
    private $clientId;
    private $clientSecret;

    private $encryptionKey;

    public function __construct()
    {
        $this->baseUrl = 'https://instantpanmitra.com';
        $this->clientId = config('credentials.panmitra.client_id');
        $this->clientSecret = config('credentials.panmitra.client_secret');
        $this->encryptionKey = config('credentials.panmitra.encryption_key');
        $this->client = new Client();
    }

    private function getAuthorizationHeader()
    {
        $credentials = base64_encode("{$this->clientId}:{$this->clientSecret}");
        return "Basic $credentials";
    }

    public function getEncryptionKey()
    {
        return $this->encryptionKey;
    }

    public function sendRequest(string $method, string $endpoint, array $payload = [], array $headers = [])
    {
        $url = "$this->baseUrl$endpoint";
        $defaultHeaders = [
            'Content-Type' => 'application/json',
            'Authorization' => $this->getAuthorizationHeader(),
        ];
        $headers = array_merge($defaultHeaders, $headers);

        try {
            $response = $this->client->request($method, $url, [
                'headers' => $headers,
                'json' => $payload,
                'curl' => [
                    CURLOPT_IPRESOLVE => CURL_IPRESOLVE_V4,
                ],
            ]);

            return json_decode($response->getBody(), true);
        } catch (Exception $e) {
            throw new Exception('Error sending request: ' . $e->getMessage());
        }
    }

    public function getAuthorization(array $payload)
    {
        return $this->sendRequest('POST', '/api/nsdl/get_authorization', $payload);
    }

    public function getTransactionStatus(string $orderId)
    {
        return $this->sendRequest('POST', '/api/nsdl/txn_status', ['order_id' => $orderId]);
    }

    public function getPanStatus(string $ackNo)
    {
        return $this->sendRequest('POST', '/api/nsdl/pan_status', ['ack_no' => $ackNo]);
    }

    public function decryptResponse(string $encryptedData, string $passphrase)
    {
        $encrypted = base64_decode($encryptedData);
        if (substr($encrypted, 0, 8) !== 'Salted__') {
            throw new Exception('Invalid encrypted data format');
        }

        $salt = substr($encrypted, 8, 8);
        $encrypted = substr($encrypted, 16);
        $keyIv = hash_pbkdf2('sha256', $passphrase, $salt, 1000, 48, true);
        $key = substr($keyIv, 0, 32);
        $iv = substr($keyIv, 32, 16);

        return openssl_decrypt($encrypted, 'aes-256-cbc', $key, OPENSSL_RAW_DATA, $iv);
    }
}
