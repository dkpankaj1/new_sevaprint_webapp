<?php 

namespace App\Services\Contracts;

interface NSDLServiceInterface
{
    public function sendRequest(string $method, string $endpoint, array $payload = [], array $headers = []);
    public function getAuthorization(array $payload);
    public function getTransactionStatus(string $orderId);
    public function getPanStatus(string $ackNo);
    public function decryptResponse(string $encryptedData, string $passphrase);
}