<?php

namespace App\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Support\Facades\Log;

class RoboticExchangeService
{
    protected $client;
    protected $apiUrl;
    protected $apimemberId;
    protected $apiPassword;

    public function __construct()
    {

        $this->apiUrl = 'https://api.roboticexchange.in/Robotics/webservice';
        $this->apimemberId = config('credentials.robotic.member_id');
        $this->apiPassword = config('credentials.robotic.password');
        $this->client = new Client();
    }

    /**
     * Mobile Recharge
     *
     * @param string $mobileNo
     * @param string $operatorCode
     * @param float $amount
     * @param string $transactionId
     * @param string $circle
     * @return array
     */
    public function mobileRecharge($mobileNo, $operatorCode, $amount, $transactionId, $circle)
    {
        $url = "{$this->apiUrl}/GetMobileRecharge";
        $params = [
            'query' => [
                'Apimember_id' => $this->apimemberId,
                'Api_password' => $this->apiPassword,
                'Mobile_no' => $mobileNo,
                'Operator_code' => $operatorCode,
                'Amount' => $amount,
                'Member_request_txnid' => $transactionId,
                'Circle' => $circle
            ]
        ];
        $response = $this->sendRequest($url, $params);
        Log::info(json_encode($response));
        return $response;
    }

    /**
     * Check Recharge Status
     *
     * @param string $transactionId
     * @return array
     */
    public function checkRechargeStatus($transactionId)
    {
        $url = "{$this->apiUrl}/GetStatus";
        $params = [
            'query' => [
                'Apimember_id' => $this->apimemberId,
                'Api_password' => $this->apiPassword,
                'Member_request_txnid' => $transactionId
            ]
        ];

        return $this->sendRequest($url, $params);
    }

    /**
     * Check Wallet Balance
     *
     * @return array
     */
    public function checkWalletBalance()
    {
        $url = "{$this->apiUrl}/GetWalletBalance";
        $params = [
            'query' => [
                'Apimember_id' => $this->apimemberId,
                'Api_password' => $this->apiPassword
            ]
        ];

        return $this->sendRequest($url, $params);
    }

    /**
     * Submit Recharge Complaint
     *
     * @param string $transactionId
     * @param string $ourRefTxnId
     * @param string $complaintReason
     * @return array
     */
    public function rechargeComplaint($transactionId, $ourRefTxnId, $complaintReason)
    {
        $url = "{$this->apiUrl}/RechargeComplaint";
        $params = [
            'query' => [
                'Apimember_id' => $this->apimemberId,
                'Api_password' => $this->apiPassword,
                'Member_request_txnid' => $transactionId,
                'OurRefTxnId' => $ourRefTxnId,
                'ComplaintReason' => $complaintReason
            ]
        ];

        return $this->sendRequest($url, $params);
    }

    /**
     * Send HTTP request to the API
     *
     * @param string $url
     * @param array $params
     * @return array
     */
    private function sendRequest($url, $params)
    {

        // return [
        //     'error' => false,
        //     'message' => 'API request success',
        //     'data' => [
        //         'ERROR' => 0,
        //         'STATUS' => 1,
        //     ]
        // ];

        try {
            $response = $this->client->get($url, $params);
            $body = $response->getBody();
            $data = json_decode($body, true);

            return [
                'error' => false,
                'message' => 'API request success',
                'data' => $data
            ];

        } catch (RequestException $e) {
            return [
                'error' => true,
                'message' => 'API request failed: ' . $e->getMessage(),
                'data' => []
            ];
        }
    }
}
