<?php
namespace App\Services\PayMob\PaymentChannels;

use App\Services\PayMob\PayMob;
use Illuminate\Http\Response;
use App\Services\PayMob\Contracts\PaymentInterface;

class CardPayment extends PayMob implements PaymentInterface
{
    // public function __construct()
    // {
    //     parent::makeAuthWithPayMob();
    // }
    /**
     * {@inheritDoc}
     */
    public function pay($response, $orderId)
    {
        return [
            'iframeUrl' => static::BASE_URL .'/acceptance/iframes' .'/' .env('IFRAME_ID').'?payment_token=' .$response->token,
            'orderId' => $orderId
        ];
    }
}
