<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
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

    /**
     * Get All Records
     */
    public function index(Request $request)
    {
        try {
            if(isset($request->filter)){
                $records = Order::whereStatus($request->filter)->latest()->get();
            }else{
                $records = Order::latest()->get();
            }
            return response()->json([
                'success' => true,
                'data' => $records
            ]);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function payment()
    {
        $pay = new PayMob;
        return $pay->makeOrder($this->orderData);
    }


}
