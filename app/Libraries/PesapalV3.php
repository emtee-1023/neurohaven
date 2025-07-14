<?php

namespace App\Libraries;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class PesapalV3
{
    /**
     * Registers the IPN URL with Pesapal and returns the notification_id (GUID).
     * @param string $ipnUrl
     * @return string|null
     */
    public function registerIpnUrl($ipnUrl)
    {
        Log::info('PesapalV3 registerIpnUrl called', [
            'ipnUrl' => $ipnUrl
        ]);
        $accessToken = $this->getAccessToken();
        $endpoint = 'https://pay.pesapal.com/v3/api/URLSetup/RegisterIPN';
        $payload = [
            'url' => $ipnUrl,
            'ipn_notification_type' => 'POST'
        ];

        $ch = curl_init($endpoint);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($payload));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Authorization: Bearer ' . $accessToken,
            'Content-Type: application/json'
        ]);

        $response = curl_exec($ch);
        if ($response === false) {
            Log::error('PesapalV3 registerIpnUrl cURL error', [
                'error' => curl_error($ch)
            ]);
        }
        curl_close($ch);

        $result = json_decode($response, true);
        Log::info('PesapalV3 registerIpnUrl response', [
            'response' => $response,
            'decoded' => $result
        ]);
        return $result['ipn_id'] ?? null;
    }

    protected $baseUrl;
    protected $consumerKey;
    protected $consumerSecret;
    protected $isSandbox;

    public function __construct($consumerKey, $consumerSecret, $isSandbox = false)
    {
        $this->consumerKey = $consumerKey;
        $this->consumerSecret = $consumerSecret;
        $this->isSandbox = $isSandbox;
        $this->baseUrl = $isSandbox
            ? 'https://cybqa.pesapal.com/pesapalv3'
            : 'https://pay.pesapal.com/v3';
    }

    public function getAccessToken()
    {
        $response = Http::post($this->baseUrl . '/api/Auth/RequestToken', [
            'consumer_key' => $this->consumerKey,
            'consumer_secret' => $this->consumerSecret,
        ]);
        Log::info('PesapalV3 getAccessToken raw response', [
            'status' => $response->status(),
            'body' => $response->body(),
            'json' => $response->json(),
            'consumer_key' => $this->consumerKey,
            'consumer_secret' => $this->consumerSecret,
        ]);
        if ($response->successful()) {
            return $response->json('token');
        } else {
            Log::error('PesapalV3 getAccessToken failed', [
                'status' => $response->status(),
                'body' => $response->body(),
            ]);
        }
        return null;
    }

    public function submitOrder($token, $orderData)
    {
        Log::info('PesapalV3 submitOrder request', [
            'endpoint' => $this->baseUrl . '/api/Transactions/SubmitOrderRequest',
            'token' => $token,
            'orderData' => $orderData,
        ]);
        $response = Http::withToken($token)
            ->acceptJson()
            ->asJson()
            ->post($this->baseUrl . '/api/Transactions/SubmitOrderRequest', $orderData);
        Log::info('PesapalV3 submitOrder raw response', [
            'status' => $response->status(),
            'body' => $response->body(),
            'json' => $response->json(),
        ]);
        if ($response->successful()) {
            return $response->json();
        } else {
            Log::error('PesapalV3 submitOrder failed', [
                'status' => $response->status(),
                'body' => $response->body(),
            ]);
        }
        return null;
    }

    public function getOrderStatus($token, $orderTrackingId)
    {
        $response = Http::withToken($token)
            ->get($this->baseUrl . '/api/Orders/GetStatus', [
                'orderTrackingId' => $orderTrackingId
            ]);
        if ($response->successful()) {
            return $response->json();
        }
        return null;
    }
}
