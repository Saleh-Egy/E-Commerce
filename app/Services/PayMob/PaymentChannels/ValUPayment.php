<?php
namespace App\Services\PayMob\PaymentChannels;

use App\Services\PayMob\PayMob;
use Illuminate\Http\Response;
use App\Services\PayMob\Contracts\PaymentInterface;

class ValUPayment extends PayMob implements PaymentInterface
{
    /**
     * {@inheritDoc}
     */
    public function pay($response, $orderId)
    {
        return [
            'iframeUrl' => static::BASE_URL .'/acceptance/iframes' .'/' .config('paymob.valU_iframe') .'?payment_token=' .$response->token,
            'orderId' => $orderId
        ];
    }
}


