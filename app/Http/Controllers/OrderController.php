<?php

namespace App\Http\Controllers;

use App\Payment\PaymentBasic;
use App\Services\PayMob\PayMob;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * orderData
     */
    protected $orderData = [
        'amount_cents' => '10000',
        'currency' => 'EGP',
        // 'merchantOrderId' => '',
        'billing_data' => [
            "apartment"=> "803", 
            "email"=> "claudette09@exa.com", 
            "floor"=> "42", 
            "first_name"=> "Clifford", 
            "street"=> "Ethan Land", 
            "building"=> "8028", 
            "phone_number"=> "+86(8)9135210487", 
            "shipping_method"=> "PKG", 
            "postal_code"=> "01898", 
            "city"=> "Jaskolskiburgh", 
            "country"=> "CR", 
            "last_name"=> "Nicolas", 
            "state"=> "Utah"
        ]
    ];
    public function payment()
    {
        $pay = new PaymentBasic;
        return $pay->makeOrder($this->orderData);
    }
}
