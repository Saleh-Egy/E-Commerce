<?php

namespace App\Services\PayMob;

use App\Services\PayMob\PaymentChannels\KioskPayment;
use App\Services\PayMob\PaymentChannels\WalletPayment;
use App\Services\PayMob\PaymentChannels\CardPayment;
use App\Services\PayMob\PaymentChannels\SymplPayment;
use App\Services\PayMob\PaymentChannels\ValUPayment;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class PayMob
{
    /**
     * Base url of payMob API
     *
     * @var string
     */
    const BASE_URL = 'https://accept.paymobsolutions.com/api/';

    /**
     * Available payment channels
     *
     * @const array
     */
    const AVAILABLE_PAYMENTS_CHANNELS = [
        'card' =>  CardPayment::class,
        'valU' =>  ValUPayment::class,
        'kiosk' => KioskPayment::class,
        'wallet' => WalletPayment::class,
        'symple' => SymplPayment::class
    ];

    /**
     * Required requests for all payment channels
     *
     * @const array
     */
    const REQUIRED_REQUESTS = [
        'authentication' => [
            'url' => 'auth/tokens',
            'method' => 'post',
            'headers' => [
                "content-type" => "application/json"
            ],
        ],
        'orderCreation' => [
            'url' => 'ecommerce/orders',
            'method' => 'post',
            'headers' => [
                "content-type" => "application/json"
            ],
        ],
        'paymentKeyGeneration' => [
            'url' => 'acceptance/payment_keys',
            'method' => 'post',
            'headers' => [
                "content-type" => "application/json"
            ],
        ],
    ];

    /**
     * Client object of guzzle
     *
     * @var \GuzzleHttp\Client
     */
    protected $client;

    /**
     * Authentication Generated key
     *
     * @var string $authKey
     */
    protected $authToken;

    /**
     * Payment Key
     *
     * @var string $paymentKey
     */
    protected $paymentKey;

    /**
     * Make the pre requests of main action
     *
     * @return void
     */
    public function __construct()
    {
        $this->client = new Client();

        $this->makeAuthWithPayMob();
    }

    /**
     * Make first step of make transaction with payMob
     *
     * @return void
     */
    public function makeAuthWithPayMob()
    {
        $authRequest = static::REQUIRED_REQUESTS['authentication'];
        // $body = [
        //     'api_token' => config('APP_KEY'),
        //     'username' => env('PAYMOB_USERNAME'),
        //     'password' => env('PAYMOB_PASSWORD')
        // ];
        $body = [
            'api_key' => env('PAYMOB_API_KEY'),
            'username' => env('PAYMOB_USERNAME'),
            'password' => env('PAYMOB_PASSWORD'),
        ];
        $response = $this->sendRequest(
            $authRequest['url'],
            $authRequest['method'],
            $body,
            $authRequest['headers']
        );
        $this->authToken = $response->token;
    }

    /**
     * Make a order
     *
     * @param array $orderData
     * @param string $orderType
     * @return
     */
    public function makeOrder($orderData, $orderType = 'card')
    {
        $orderCreation = static::REQUIRED_REQUESTS['orderCreation'];

        $body = [
            'auth_token' => $this->authToken,
            'delivery_needed' => false,
            'merchant_id' => env('PAYMOB_MERCHANT_ID'),
            'amount_cents' => $orderData['amount_cents'],
            'currency' => $orderData['currency'],
            'merchant_order_id' => $orderData['merchantOrderId'],
            'items' => [],
        ];

        $response = $this->sendRequest(
            $orderCreation['url'],
            $orderCreation['method'],
            $body,
            $orderCreation['headers']
        );
        $orderData['orderId'] = $response->id;
        $orderData['orderType'] = $orderType;
        return $this->getPaymentKey($orderData);
    }

    /**
     * Get payment key
     *
     * @param array $orderData
     * @return string $paymentKey
     */
    protected function getPaymentKey($orderData)
    {
        $paymentKeyGeneration = static::REQUIRED_REQUESTS['paymentKeyGeneration'];
        $paymentChannel = $orderData['orderType'];

        $body = [
            'auth_token' => $this->authToken,
            'delivery_needed' => false,
            'integration_id' => config('paymob.' .$paymentChannel .'_integration_id'),
            'amount_cents' => $orderData['amount_cents'],
            'currency' => $orderData['currency'],
            'order_id' => $orderData['orderId'],
            'billing_data' => $orderData['billing_data'],
            'lock_order_when_paid'=> false
        ];
        $response = $this->sendRequest(
            $paymentKeyGeneration['url'],
            $paymentKeyGeneration['method'],
            $body,
            $paymentKeyGeneration['headers']
        );
        $orderTypeClass = static::AVAILABLE_PAYMENTS_CHANNELS[$paymentChannel];
        $orderTypeClass = new $orderTypeClass;

        return $orderTypeClass->pay($response, $orderData['orderId']);
    }

    /**
     * Send Request
     *
     * @param string $url
     * @param string $method
     * @param array $body
     * @param array $headers
     *
     * @return object
     */
    public function sendRequest($url, $httpMethod, $body, $headers)
    {
        $url = static::BASE_URL .$url;
        $response = $this->client->$httpMethod($url, [
            'body'    =>   json_encode($body, JSON_PRESERVE_ZERO_FRACTION),
            'headers' =>   $headers
        ]);
        return json_decode($response->getBody());
    }
}
