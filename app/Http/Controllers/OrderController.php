<?php

namespace App\Http\Controllers;

use App\Services\PayMob\PayMob;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function payment()
    {
        $pay = new PayMob;
        return $pay->makeAuthWithPayMob();
    }
}
