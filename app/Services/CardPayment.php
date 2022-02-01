<?php
namespace App\Services;

class CardPayment extends PayMob 
{
    static $products = [];
    public function __construct()
    {
        parent::requestAuth();
        parent::registerOrder($this->products);
        parent::requestPaymentKey();
    }



}