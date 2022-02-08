<?php
namespace App\Services\PayMob\Contracts;

Interface PaymentInterface
{
    /**
     * Make last step based on type of payment channel.
     *
     * @param object $response
     * @param int    $orderId
     */
    public function pay($response, $orderId);
}
