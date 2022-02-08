<?php
namespace App\Services\PayMob\PaymentChannels;

use App\Services\PayMob\PayMob;
use Illuminate\Http\Response;
use App\Services\PayMob\Contracts\PaymentInterface;

class KioskPayment extends PayMob implements PaymentInterface
{
    /**
     * Payment channel required request
     *
     * @const array
     */
    const PAYMENT_CHANNEL_REQUIRED_REQUEST = [
        'url' => 'acceptance/payments/pay',
        'method' => 'post',
        'headers' => [
            "content-type" => "application/json"
        ],
    ];

    /**
     * {@inheritDoc}
     */
    public function pay($response, $orderId)
    {
        $body = [
            'source' => [
                "identifier"=> "AGGREGATOR",
                "subtype"=> "AGGREGATOR"
            ],
            'payment_token' => $response->token,
        ];

        $response = $this->sendRequest(
            static::PAYMENT_CHANNEL_REQUIRED_REQUEST['url'],
            static::PAYMENT_CHANNEL_REQUIRED_REQUEST['method'],
            $body,
            static::PAYMENT_CHANNEL_REQUIRED_REQUEST['headers']
        );

        return [
            'billReference' =>  $response->data->bill_reference,
            'orderId' => $orderId
        ];
    }
}


