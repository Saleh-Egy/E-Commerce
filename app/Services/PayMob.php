<?php
namespace App\Services;

class PayMob 
{
    /**
     * step #1
     */
    public function requestAuth()
    {
       return $token = send_request(
            'https://accept.paymob.com/api/auth/tokens',
            'POST',
            [
                'Source'=>"Merchant's server",
                'Recipient'=>"Accept's server",
                'Content-Type'=> 'JSON'
            ],
            [
                'api_key'=> 'x',
            ]
        );
    }
    /**
     * step #2
     */
    public function registerOrder($products = [])
    {
        return $record = send_request(
            'https://accept.paymob.com/api/ecommerce/orders',
            'POST',
            [
                'Source'=>"Merchant's server",
                'Recipient'=>"Accept's server",
                'Content-Type'=> 'JSON'
            ],
            [
                    "auth_token"=>  $this->requestAuth(),
                    "delivery_needed"=> "false",
                    "amount_cents"=> "100",
                    "currency"=> "EGP",
                    "terminal_id"=> 23772,
                    "merchant_order_id"=> 5,
                    "items"=> [
                        [
                            "name"=> "ASC1515",
                            "amount_cents"=> "500000",
                            "description"=> "Smart Watch",
                            "quantity"=> "1"
                        ],
                        [
                            "name"=> "ERT6565",
                            "amount_cents"=> "200000",
                            "description"=> "Power Bank",
                            "quantity"=> "1"
                        ] 
                    ],
                    "shipping_data"=> [
                      "apartment"=> "803", 
                      "email"=> "claudette09@exa.com", 
                      "floor"=> "42", 
                      "first_name"=> "Clifford", 
                      "street"=> "Ethan Land", 
                      "building"=> "8028", 
                      "phone_number"=> "+86(8)9135210487", 
                      "postal_code"=> "01898", 
                       "extra_description"=> "8 Ram , 128 Giga",
                      "city"=> "Jaskolskiburgh", 
                      "country"=> "CR", 
                      "last_name"=> "Nicolas", 
                      "state"=> "Utah"
                    ],
                      "shipping_details"=> [
                          "notes" => " test",
                          "number_of_packages"=> 1,
                          "weight" => 1,
                          "weight_unit" => "Kilogram",
                          "length" => 1,
                          "width" =>1,
                          "height" =>1,
                          "contents" => "product of some sorts"
                      ]
            ]
        );
    }

    /**
     * step #3
     */
    public function requestPaymentKey()
    {
        return $record = send_request(
            'https://accept.paymob.com/api/ecommerce/orders',
            'POST',
            [
                'Source'=>"Merchant's server",
                'Recipient'=>"Accept's server",
                'Content-Type'=> 'JSON'
            ],
            [
                    "auth_token"=>  $this->requestAuth(),
                    "amount_cents"=> "100", 
                    "expiration"=> 3600, 
                    "order_id"=> $this->registerOrder()->id,
                    "billing_data"=> [
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
                    ], 
                    "currency"=> "EGP", 
                    "integration_id"=> 1,
                    "lock_order_when_paid"=> "false",
                ]
            );
    }

}









